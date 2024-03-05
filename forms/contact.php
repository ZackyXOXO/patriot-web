<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../assets/vendor/smtpmail/librarysmtp/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {

        $name = isset($_POST['name']) ? $_POST['name'] : 'none';
        $email = isset($_POST['email']) ? $_POST['email'] : 'none';
        $subject = isset($_POST['subject']) ? $_POST['subject'] : 'none';
        $message = isset($_POST['message']) ? $_POST['message'] : 'none';

        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //hostname/domain yang dipergunakan untuk setting smtp
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'seven.sixerz@gmail.com';                     //SMTP username
        $mail->Password   = 'nooahzhapbritqgr';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('zackysaktiawan.person@gmail.com');     //email tujuan
        // $mail->addReplyTo('emailtujuan@domainaddreply.com', 'Information'); //email tujuan add reply (bila tidak dibutuhkan bisa diberi pagar)
        // $mail->addCC('emailtujuan@domaincc.com'); // email cc (bila tidak dibutuhkan bisa diberi pagar)
        // $mail->addBCC('emailtujuan@domainbcc.com'); // email bcc (bila tidak dibutuhkan bisa diberi pagar)
    
        //Attachments
        #$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        #$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'New email from '. $email;
        $mail->Body    = 'Subject :  '. $subject . '<br><br> Message : <br>' . $message;
        $mail->AltBody = '';
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Please try again later.";
    }
}
