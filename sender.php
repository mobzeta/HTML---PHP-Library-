<?php
/**
 * Start email template sender
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require ('lib/Exception.php');
require ('lib/PHPMailer.php');
require ('lib/SMTP.php');

require ('temp.php');

$temp = new mailTemp();
$mail = new PHPMailer(true);

$getBody = $_POST['mail_body'];
$getTopTitle = $_POST['mail_top_title'];
$getTitle = $_POST['mail_title'];
$getButton = $_POST['mail_button'];
$getMailFrom = $_POST['mail_from'];
$getSubj = $_POST['mail_subject'];

//Set MailInline;

$temp->setTitle($getTitle);
$temp->setTitleTwo($getTopTitle);
$temp->setButton($getButton);
$temp->setBody($getBody);

$sendTo = $_POST['mail_to'];
if(empty($sendTo)){
    $sendTo = 'nusktecsoft@gmail.com';
}

$file = $_POST['mail_file'];

try{

    // TCP port to connect to

    //Recipients
    $mail->setFrom($getMailFrom, 'MobZeta Network | ');
    $mail->addAddress($sendTo);     // Add a recipient
    //$mail->addReplyTo('voidvoidburst@gmail.com', 'Reply From ZetaWorld');
    $mail->addCC('info@mobzeta.com','MobZeta Mail');

    if(!empty($file)){
        //Attachments
        $mail->addAttachment($file,'Attached File - MobZeta');         // Add attachments
    }

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $getSubj;
    $mail->Body    = $temp->getHtmlEmail();
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo '1';

}catch (Exception $ex){
    echo '0';
}

?>