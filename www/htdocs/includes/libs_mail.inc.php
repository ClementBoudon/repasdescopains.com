<?php

function envoi_mail_code($email,$nom,$pass){

    require_once 'includes/PHPMailer-master/PHPMailerAutoload.php';

    $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
    $nom_exp = 'Clement - Repas des copains';
    $email_exp = 'clement@repasdescopains.com';
    $titre_mail = 'Tirage au sort - Repas de Noel';
    $contenu_mail = '<html>
          <head>
           <title>'.$titre_mail.'</title>
          </head>
          <body>
          <p>Salut toi,<br><br>pour savoir à qui tu dois offrir un cadeau cette année, <br>
            clique ici : <a href="<--host-->noel.php?c=<--pass-->"><--host-->noel.php?c=<--pass--></a>. <br>
    <br>
    Tu peux également utiliser le code : <b><--pass--></b> directement sur le site.
    <br>
    <br>
    A Plus.
    </p>
           </body>
           </html>';

    $contenu_mail_txt ='Salut toi,\r\npour savoir à qui tu dois offrir un cadeau cette année, \r\nclique ici : <a href="<--host-->noel.php?c=<--pass-->"><--host-->noel.php?c=<--pass--></a>. \r\n\r\nTu peux également utiliser le code : <b><--pass--></b> directement sur le site.\r\n\r\nA Plus.';

    $contenu_mail = str_replace('<--host-->',$host,$contenu_mail);
    $contenu_mail_txt = str_replace('<--host-->',$host,$contenu_mail_txt);

    //Headers Mail
    $headers  = 'MIME-Version: 1.0' . "\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\n";

    // Additional headers
    $headers .= 'From: '.$nom_exp.' <'.$email_exp.'>' . "\n";
    $headers .= 'Reply-To: '.$email_exp.''."\n";
    /*$headers .= 'To: '.$nom.' <'.$email.'>' . "\r\n";*/

    $contenu_mail = str_replace('<--pass-->',$pass,$contenu_mail);
    $contenu_mail_txt = str_replace('<--pass-->',$pass,$contenu_mail_txt);
    // smtp.repasdescopains.com port 587 //SSL :  ssl0.ovh.net 465

    /** Version PHPMailer
    $mail = new PHPMailer;

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'ssl0.ovh.net';                         // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'clement@repasdescopains.com';      // SMTP username
    $mail->Password = 'Fg56DyU3AZ56';                     // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;


    $mail->From = $email_exp;
    $mail->FromName = $nom_exp;
    $mail->addAddress($email, $nom);                    // Add a recipient
    $mail->addReplyTo('clement@repasdescopains.com', 'Clement - Repas des copains');

    $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $titre_mail;
    $mail->Body    = $contenu_mail;
    $mail->AltBody = $contenu_mail_txt;

    if(!$mail->send()) {
        echo 'Erreur mail : '.$mail->ErrorInfo.'<br>';
        $retour_mail = false;
    } else {
       $retour_mail = true;
    }
    */

    /** Version mail local

    $retour_mail = mail($email,$titre_mail,$contenu_mail,$headers);

    */

    /** Version Mailjet */
    $retour_mail = sendEmailMailjet($email,$titre_mail,$contenu_mail,$headers,$email_exp,$contenu_mail_txt);

    return $retour_mail;
}

function sendEmailMailjet($email,$titre_mail,$contenu_mail,$headers,$email_exp,$contenu_mail_txt)
{

    if(!isset($mailjet_apiKey)) include 'config.php';
    require_once 'includes/php-mailjet-v3-simple.class.php';

    $mj = new Mailjet($mailjet_apiKey,$mailjet_secretKey);

    $params = array(
        "method" => "POST",
        "from" => $email_exp,
        "to" => $email,
        "subject" => $titre_mail,
        "text" => $contenu_mail_txt,
        "html" => $contenu_mail
    );

    $result = $mj->sendEmail($params);


    if ($mj->_response_code == 200)
       $result = true;
    else
       $result = false;

    return $result;
}
