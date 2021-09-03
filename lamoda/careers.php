<?php
    $filenameee =  $_FILES['file']['name'];
    $fileName = $_FILES['file']['tmp_name']; 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $usermessage = $_POST['subject1'];
    $comment = $_POST['comment'];
    
    
    $message ="Name = ". $name . "\r\n  Email = " . $email . "\r\n Subject =" . $usermessage . "\r\n Comment =" . $comment; 
    
    $subject ="careers page";
     //if u dont have an email create one on your cpanel
    $mailto = 'Sreekalangl@gmail.com';  //the email which u want to recv this email
    $content = file_get_contents($fileName);
    $content = chunk_split(base64_encode($content));
    // a random hash will be necessary to send mixed content
    $separator = md5(time());
    // carriage return type (RFC)
    $eol = "\r\n";
    // main header (multipart mandatory)
    $headers = "From: ".$email;
    $headers .= "" . $eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
    $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
    $headers .= "This is a MIME encoded message." . $eol;
    // message
    $body = "--" . $separator . $eol;
    $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
    $body .= "Content-Transfer-Encoding: 8bit" . $eol;
    $body .= $message . $eol;
    // attachment
    $body .= "--" . $separator . $eol;
    $body .= "Content-Type: application/octet-stream; name=\"" . $filenameee . "\"" . $eol;
    $body .= "Content-Transfer-Encoding: base64" . $eol;
    $body .= "Content-Disposition: attachment" . $eol;
    $body .= $content . $eol;
    $body .= "--" . $separator . "--";
    //SEND Mail
    if (mail($mailto, $subject, $body, $headers)) {

         // do what you want after sending the email
        header("location:blog.html");
        echo "mail send ... OK";
        
    } else {
        echo "mail send ... ERROR!";
        print_r( error_get_last() );
    }