<?php

// Echaper les données saisies
function escape($data)
{
    $data = strip_tags(trim($data));
    return $data;
}

// Appel à l'api de Imgur
function callApiImgur($postFields)
{
    // Client ID of Imgur App
    $IMGUR_CLIENT_ID = "b126d99ed6ef1d2";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image');
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $IMGUR_CLIENT_ID));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

// Recevoir les données de mon API
function GetDataFromMyApi($url)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

// Posté des données vers mon API
function PostToMyApi($data, $url)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
}

// fonction pour obtenir la different entre deux date
function datediff($date)
{
    date_default_timezone_set('UTC');
    $date1 = new DateTime($date);
    $date2 = new DateTime();

    if ($date1 > $date2) {
        return "Erreur sur la date";
        exit();
    }
    $diff = date_diff($date2, $date1);

    if ($diff->y > 0) {
        if ($diff->y == 1) {
            $date = "Il y a 1 an";
            return $date;
            exit();
        } else {
            $date = "Il y a $diff->y ans";
            return $date;
            exit();
        }
    }

    if ($diff->m > 0) {
        if ($diff->m == 1) {
            $date = "Il y a 1 mois";
            return $date;
            exit();
        } else {
            $date = "Il y a $diff->m mois";
            return $date;
            exit();
        }
    }


    if ($diff->d > 0) {
        if ($diff->d == 1) {
            $date = "Il y a 1 jour";
            return $date;
            exit();
        } else {
            $date = "Il y a $diff->d jours";
            return $date;
            exit();
        }
    }

    if ($diff->h > 0) {
        if ($diff->h == 1) {
            $date = "Il y a 1 heure";
            return $date;
            exit();
        } else {
            $date = "Il y a $diff->h heures";
            return $date;
            exit();
        }
    }

    if ($diff->i > 0) {
        if ($diff->i == 1) {
            $date = "Il y a 1 minute";
            return $date;
            exit();
        } else {
            $date = "Il y a $diff->i minutes";
            return $date;
            exit();
        }
    }

    if ($diff->d == 0 && $diff->h == 0 && $diff->i == 0) {
        $date = "Maintenant";
    }

    return $date;
}
