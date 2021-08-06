<?php
   
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject1 = $_POST['subject1'];
    $usermessage = $_POST['message'];
   
    $message ="Name = ". $name . "\r\n  Email = " . $email . "\r\n Subject =" . $subject1 . "\r\n Message =" . $usermessage; 
    
    $subject ="Contact page";
     //if u dont have an email create one on your cpanel
    $mailto = 'Sreekalangl@gmail.com';  //the email which u want to recv this email
    
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
    
    //SEND Mail
    if (mail($mailto, $subject, $body, $headers)) {

        echo "mail send ... OK"; // do what you want after sending the email
        header("location:index.html");
        
    } else {
        echo "mail send ... ERROR!";
        print_r( error_get_last() );
    }