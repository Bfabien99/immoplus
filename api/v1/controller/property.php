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
