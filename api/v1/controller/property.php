<?php

require_once('db.php');
require_once('../model/Property.php');
require_once('../model/Response.php');

try {
    $connectDB = DB::connectDB();
} catch (PDOException $ex) {
    error_log("Connection error -" . $ex, 0);
    $response = new Response(500, false, "Database connection error");
    $response->send();
    exit();
}


if (empty($_GET)) {

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        try {
            $sql = "select * from property";
            $query = $connectDB->prepare($sql);
            $query->execute();

            $rowCount = $query->rowCount();
            $propertyArray = [];

            if ($rowCount === 0) {
                $response = new Response(404, false, "Aucune propriété correspondante");
                $response->send();
                exit();
            }

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $property = new Property($row['id'], $row['title'], $row['description'], $row['type'], $row['address'], $row['area'], $row['price'], $row['shower'], $row['bedroom'], $row['picture'], $row['post_date'], $row['etat'], $row['_userId'], $row['raison']);
                $property->setView($row['view']);
                $propertyArray[] = $property->returnPropertyAsArray();
            }

            $returnData = array();
            $returnData['rows_returned'] = $rowCount;
            $returnData['properties'] = $propertyArray;

            $response = new Response(200, true, "", $returnData);
            $response->send();
            exit();
        } catch (PropertyException $ex) {
            $response = new Response(400, false, $ex->getMessage());
            $response->send();
            exit();
        } catch (PDOException $ex) {
            error_log("Database query error -" . $ex, 0);
            $response = new Response(500, false, "Echec de la récupération de la propriété");
            $response->send();
            exit();
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            // On vérifie d'abord que le content type est application/json
            if ($_SERVER["CONTENT_TYPE"] !== "application/json") {
                $response = new Response(400, false, "Content type header is not set to json");
                $response->send();
                exit();
            }

            // On récupère les données postées
            $rawPOSTData = file_get_contents('php://input');

            // On vérifie si les données postées sont sous le format json
            if (!$jsonData = json_decode($rawPOSTData)) {
                $response = new Response(400, false, "Request body is not a valid JSON");
                $response->send();
                exit();
            }

            // On vérifie si les champs requis sont présents
            if (!isset($jsonData->title) || !isset($jsonData->description) || !isset($jsonData->type) || !isset($jsonData->address) || !isset($jsonData->area) || !isset($jsonData->price) || !isset($jsonData->shower) || !isset($jsonData->bedroom)) {
                $response = new Response(400, false, "");
                $response->setSuccess(false);
                !isset($jsonData->title) ? $response->addMessage("Le titre est requis et doit être rempli") : false;
                !isset($jsonData->description) ? $response->addMessage("La description est requise et doit être rempli") : false;
                !isset($jsonData->type) ? $response->addMessage("Le type est requis et doit être rempli") : false;
                !isset($jsonData->address) ? $response->addMessage("L' adresse est requise et doit être rempli") : false;
                !isset($jsonData->area) ? $response->addMessage("La superficie est requise et doit être rempli") : false;
                !isset($jsonData->price) ? $response->addMessage("Le prix est requis et doit être rempli") : false;
                !isset($jsonData->shower) ? $response->addMessage("Le nombre de douche est requis et doit être rempli") : false;
                !isset($jsonData->bedroom) ? $response->addMessage("Le nombre de chambre est requis et doit être rempli") : false;
                $response->send();
                exit();
            }

            // On crée une nouvelle propriété
            $newProperty = new Property(null, $jsonData->title, $jsonData->description, $jsonData->type, $jsonData->address, $jsonData->area, $jsonData->price, $jsonData->shower, $jsonData->bedroom, $jsonData->picture ?? null, null, null, $jsonData->userId ?? null, $jsonData->raison ?? null);

            $title = $newProperty->getTitle();
            $description = $newProperty->getDescription();
            $type = $newProperty->getType();
            $address = $newProperty->getAddress();
            $area = $newProperty->getArea();
            $price = $newProperty->getPrice();
            $shower = $newProperty->getShower();
            $bedroom = $newProperty->getBedroom();
            $picture = $newProperty->getpicture();
            $post_date = $newProperty->getPostDate();
            $userId = $newProperty->getUserId();
            $raison = $newProperty->getRaison();

            // On vérifie s'il n'y a pas une propriété avec le m$me titre
            $sql = "select * from property where title = :title";
            $query = $connectDB->prepare($sql);
            $query->bindValue(':title', $title, PDO::PARAM_STR);
            $query->execute();

            $rowCount = $query->rowCount();

            if ($rowCount === 1) {
                $response = new Response(403, false, "Une propriété avec le même titre existe");
                $response->send();
                exit();
            }

            // Insertion de la propriété dans la base de donnée
            $sql = "insert into property (title, description, type, address, area, price, shower, bedroom, picture, _userId, raison) values(:title, :description, :type, :address, :area, :price, :shower, :bedroom, :picture, :userId, :raison)";
            $query = $connectDB->prepare($sql);
            $query->bindValue(':title', $title, PDO::PARAM_STR);
            $query->bindValue(':description', $description, PDO::PARAM_STR);
            $query->bindValue(':type', $type, PDO::PARAM_STR);
            $query->bindValue(':address', $address, PDO::PARAM_STR);
            $query->bindValue(':area', $area, PDO::PARAM_INT);
            $query->bindValue(':price', $price, PDO::PARAM_INT);
            $query->bindValue(':shower', $shower, PDO::PARAM_INT);
            $query->bindValue(':bedroom', $bedroom, PDO::PARAM_INT);
            $query->bindValue(':picture', $picture, PDO::PARAM_STR);
            $query->bindValue(':userId', $userId, PDO::PARAM_INT);
            $query->bindValue(':raison', $raison, PDO::PARAM_STR);
            $query->execute();

            $rowCount = $query->rowCount();
            if ($rowCount === 0) {
                $response = new Response(500, false, "Ajout de la propriété echoué");
                $response->send();
                exit();
            }

            //On récupère la propriété ajoutée
            $lastPropertyID = $connectDB->lastInsertId();

            $sql = "select * from property where id = :id";
            $query = $connectDB->prepare($sql);
            $query->bindValue(':id', $lastPropertyID, PDO::PARAM_INT);
            $query->execute();

            $rowCount = $query->rowCount();
            $propertyArray = [];

            if ($rowCount === 0) {
                $response = new Response(500, false, "Echec de la récupération des données de la propriété");
                $response->send();
                exit();
            }

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $property = new Property($row['id'], $row['title'], $row['description'], $row['type'], $row['address'], $row['area'], $row['price'], $row['shower'], $row['bedroom'], $row['picture'], $row['post_date'], $row['etat'], $row['_userId'], $row['raison']);
                $property->setView($row['view']);
                $propertyArray[] = $property->returnPropertyAsArray();
            }

            $returnData = array();
            $returnData['rows_returned'] = $rowCount;
            $returnData['properties'] = $propertyArray;

            $response = new Response(201, true, "Propriété ajoutée", $returnData);
            $response->send();
            exit();
        } catch (PropertyException $ex) {
            $response = new Response(400, false, $ex->getMessage());
            $response->send();
            exit();
        } catch (PDOException $ex) {
            error_log("Database query error -" . $ex, 0);
            $response = new Response(500, false, "Echec de l'ajout de la propriété");
            $response->send();
            exit();
        }
    } else {
        $response = new Response(405, false, "La méthode n'est pas permise");
        $response->send();
        exit();
    }
} elseif (array_key_exists("property_id", $_GET)) {
    $property_id = $_GET["property_id"];

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        try {
            $sql = "select * from property where id = :id";
            $query = $connectDB->prepare($sql);
            $query->bindValue(':id', $property_id, PDO::PARAM_INT);
            $query->execute();

            $rowCount = $query->rowCount();
            $propertyArray = [];

            if ($rowCount === 0) {
                $response = new Response(404, false, "Aucune propriété correspondante");
                $response->send();
                exit();
            }

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $property = new Property($row['id'], $row['title'], $row['description'], $row['type'], $row['address'], $row['area'], $row['price'], $row['shower'], $row['bedroom'], $row['picture'], $row['post_date'], $row['etat'], $row['_userId'], $row['raison']);
                $property->setView($row['view']);
                $propertyArray[] = $property->returnPropertyAsArray();
            }

            $returnData = array();
            $returnData['rows_returned'] = $rowCount;
            $returnData['properties'] = $propertyArray;

            $response = new Response(200, true, "", $returnData);
            $response->send();
            exit();
        } catch (PropertyException $ex) {
            $response = new Response(400, false, $ex->getMessage());
            $response->send();
            exit();
        } catch (PDOException $ex) {
            error_log("Database query error -" . $ex, 0);
            $response = new Response(500, false, "Echec de la récupération de la propriété");
            $response->send();
            exit();
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

        try {
            $sql = "delete from property where id = :id";
            $query = $connectDB->prepare($sql);
            $query->bindValue(':id', $property_id, PDO::PARAM_INT);
            $query->execute();

            $rowCount = $query->rowCount();
            $propertyArray = [];

            if ($rowCount === 0) {
                $response = new Response(404, false, "Aucune propriété correspondante");
                $response->send();
                exit();
            }

            $response = new Response(200, true, "Propriété supprimée");
            $response->send();
            exit();
        } catch (PropertyException $ex) {
            $response = new Response(400, false, $ex->getMessage());
            $response->send();
            exit();
        } catch (PDOException $ex) {
            error_log("Database query error -" . $ex, 0);
            $response = new Response(500, false, "Echec de la suppression de la propriété");
            $response->send();
            exit();
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    }
} elseif (array_key_exists("property_type", $_GET)) {
    $property_type = strtolower($_GET["property_type"]);

    if ($property_type !== 'location' && $property_type !== 'vendre') {
        $response = new Response(400, false, "Le type de la propriété doit être 'location' ou 'vendre'");
        $response->send();
        exit();
    }

    // Si la methode est en GET
    if ($_SERVER["REQUEST_METHOD"] === "GET") {

        try {
            $query = $connectDB->prepare('select * from property where type = :type');
            $query->bindParam('type', $property_type, PDO::PARAM_STR);
            $query->execute();

            $rowCount = $query->rowCount();
            $propertyArray = [];

            if ($rowCount === 0) {
                $response = new Response(404, false, "Aucune propriété correspondante");
                $response->send();
                exit();
            }

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $property = new Property($row['id'], $row['title'], $row['description'], $row['type'], $row['address'], $row['area'], $row['price'], $row['shower'], $row['bedroom'], $row['picture'], $row['post_date'], $row['etat'], $row['_userId'], $row['raison']);
                $property->setView($row['view']);
                $propertyArray[] = $property->returnPropertyAsArray();
            }

            $returnData = array();
            $returnData['rows_returned'] = $rowCount;
            $returnData['properties'] = $propertyArray;

            $response = new Response(200, true, "", $returnData);
            $response->send();
            exit();
        } catch (PropertyException $ex) {
            $response = new Response(400, false, $ex->getMessage());
            $response->send();
            exit();
        } catch (PDOException $ex) {
            error_log("Database query error -" . $ex, 0);
            $response = new Response(500, false, "Echec de la récupération de la propriété");
            $response->send();
            exit();
        }
    } else {
        $response = new Response(405, false, "La méthode n'est pas permise");
        $response->send();
        exit();
    }
}
