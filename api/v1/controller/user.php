<?php

require_once('db.php');
require_once('../model/User.php');
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
            $sql = "select * from user";
            $query = $connectDB->prepare($sql);
            $query->execute();

            $rowCount = $query->rowCount();
            $userArray = [];

            if ($rowCount === 0) {
                $response = new Response(404, false, "user not found");
                $response->send();
                exit();
            }

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $user = new User($row['id']);
                $userArray[] = $user->returnUserAsArray();
            }

            $returnData = array();
            $returnData['rows_returned'] = $rowCount;
            $returnData['users'] = $userArray;

            $response = new Response(200, true, "", $returnData);
            $response->send();
            exit();
        } catch (UserException $ex) {
            $response = new Response(400, false, $ex->getMessage());
            $response->send();
            exit();
        } catch (PDOException $ex) {
            error_log("Database query error -" . $ex, 0);
            $response = new Response(500, false, "Failed to get user");
            $response->send();
            exit();
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    } else {
        $response = new Response(405, false, "Method Not Allowed");
        $response->send();
        exit();
    }
} elseif (array_key_exists("user_id", $_GET)) {
    $user_id = $_GET["user_id"];
}
