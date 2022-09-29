<?php
require 'vendor/autoload.php';
function sendMail($objet,$message,$to){
        try{
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587,'tls'))
        ->setUsername('fabienbrou99@gmail.com')
        ->setPassword('trrursxiujswvodt');
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message($objet))// Objet
            ->setFrom(['fabienbrou99@gmail.com' => 'Immoplus'])// Le nom
            ->setTo([$to])
            ->setBody($message)
            ->setContentType("text/html");

        // Send the message
        $result = $mailer->send($message);
            return $result;
        } 
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }