<?php
// Client ID of Imgur App
$IMGUR_CLIENT_ID = "b126d99ed6ef1d2";


$statusMsg = $valErr = '';
$status = 'danger';
$imgurData = array();

// If the form is submitted
if(isset($_POST['submit'])){
    // validate file input field
    if(empty($_FILES["image"]["name"])){
        $valErr .= 'Please select a file to upload'.'<br/>';
    }

    // check whether user inputs are empty
    if(empty($valErr)){
        // Get file info
        $fileName = basename($_FILES["image"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        // Allow certain file format
        $allowTypes = array('jpg','png','jpeg','gif');
        if(in_array($fileType, $allowTypes)){
            // Source image
            $image_source = file_get_contents($_FILES["image"]["tmp_name"]);

            // API post parameters
            $postFields = array('image' => base64_encode($image_source));

            if(!empty($_POST["title"])){
                $postFields["title"] = $_POST["title"];
            }

            // Post image to Imgur via API
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image');
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID '.$IMGUR_CLIENT_ID));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            $response = curl_exec($ch);
            curl_close($ch);

            // Decode API response to array
            $responseArr = json_decode($response);

            // Check image upload status
            if(!empty($responseArr)){
                $imgurData = $responseArr;

                $status = 'success';
                $statusMsg = "Image uploaded to Imgur";
            }else{
                $statusMsg = "Image not uploaded";
            }
        }else{
            $statusMsg = "Sorry, only image file is allowed to upload";
        }
    }else{
    $statusMsg = "<p>Fill all the mandatory fields:</p>".trim($valErr, '<br/>');
}
}