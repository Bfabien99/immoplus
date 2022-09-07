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
                $response = new Response(404, false, "Property not found");
                $response->send();
                exit();
            }

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $property = new Property($row['id'], $row['title'], $row['description'], $row['type'], $row['post_date']);
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
            $response = new Response(500, false, "Failed to get task");
            $response->send();
            exit();
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try{
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
            if (!isset($jsonData->title) || !isset($jsonData->description) || !isset($jsonData->type)) {
                $response = new Response(400, false, "");
                $response->setSuccess(false);
                !isset($jsonData->title) ? $response->addMessage("Title field is mandatory and must be provided") : false;
                !isset($jsonData->description) ? $response->addMessage("Description field is mandatory and must be provided") : false;
                !isset($jsonData->type) ? $response->addMessage("Type field is mandatory and must be provided") : false;
                $response->send();
                exit();
            }
            
            // On crée une nouvelle propriété
            $newProperty = new Property(null, $jsonData->title, $jsonData->description, $jsonData->type);

            $title = $newProperty->getTitle();
            $description = $newProperty->getDescription();
            $type = $newProperty->getType();
            $post_date = $newProperty->getPostDate();

            // Insertion de la propriété dans la base de donnée
            $sql = "insert into property (title, description, type) values(:title, :description, :type)";
            $query = $connectDB->prepare($sql);
            $query->bindValue(':title', $title, PDO::PARAM_STR);
            $query->bindValue(':description', $description, PDO::PARAM_STR);
            $query->bindValue(':type', $type, PDO::PARAM_STR);
            $query->execute();

            $rowCount = $query->rowCount();
            if ($rowCount === 0) {
                $response = new Response(500, false, "Failed to add property");
                $response->send();
                exit();
            }

            //On récupère la propriété ajoutée
            $lastTaskID = $connectDB->lastInsertId();

            $sql = "select * from property where id = :id";
            $query = $connectDB->prepare($sql);
            $query->bindValue(':id',$lastTaskID, PDO::PARAM_INT);
            $query->execute();

            $rowCount = $query->rowCount();
            $propertyArray = [];

            if ($rowCount === 0) {
                $response = new Response(500, false, "Failed to retrieve property after added");
                $response->send();
                exit();
            }

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $property = new Property($row['id'], $row['title'], $row['description'], $row['type'], $row['post_date']);
                $propertyArray[] = $property->returnPropertyAsArray();
            }

            $returnData = array();
            $returnData['rows_returned'] = $rowCount;
            $returnData['properties'] = $propertyArray;

            $response = new Response(201, true, "Property added successfully", $returnData);
            $response->send();
            exit();

        }catch (PropertyException $ex) {
            $response = new Response(400, false, $ex->getMessage());
            $response->send();
            exit();
        } catch (PDOException $ex) {
            error_log("Database query error -" . $ex, 0);
            $response = new Response(500, false, "Failed to get task");
            $response->send();
            exit();
        }
    } else {
        $response = new Response(405, false, "Method Not Allowed");
        $response->send();
        exit();
    }
} elseif (array_key_exists("property_id", $_GET)) {
    $property_id = $_GET["property_id"];

    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        try {
            $sql = "select * from property where id = :id";
            $query = $connectDB->prepare($sql);
            $query->bindValue(':id',$property_id, PDO::PARAM_INT);
            $query->execute();

            $rowCount = $query->rowCount();
            $propertyArray = [];

            if ($rowCount === 0) {
                $response = new Response(404, false, "Property not found");
                $response->send();
                exit();
            }

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $property = new Property($row['id'], $row['title'], $row['description'], $row['type'], $row['post_date']);
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
            $response = new Response(500, false, "Failed to get task");
            $response->send();
            exit();
        }
    }if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){

    }if ($_SERVER['REQUEST_METHOD'] == 'PATCH'){

    }
}
