

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php


// $admin="From:sectabear@gmail.com" . "r\n" .
// "Reply-To: sectabear@gmail.com" . "r\n" .
// "X-Mailer: PHP/" . phpversion();

// if (mail($destino,$asunto,$mensaje,$admin)) {
//    echo "Correo enviado";
// } else {
//     echo "Caca";
// }

$destino=$_POST['email'];
$asunto=$_POST['asunto'];
$mensaje=$_POST['mensaje'];



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPmailer/Exception.php';
require 'PHPmailer/PHPMailer.php';
require 'PHPmailer/SMTP.php';



$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'hectorjimenezrafael18@gmail.com';                     //SMTP username
    $mail->Password   = 'jbpz isbp kpoj oxtl';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('hectorjimenezrafael18@gmail.com', 'Hector');
    $mail->addAddress($destino);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = $mensaje;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
   
        ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function aviso(url) {
                swal.fire ({
                    title: 'Correo enviado correctamente',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Volver'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                })
            }
        
            aviso('form_correo.php');
        </script>
       
<?php
    
} catch (Exception $e) {
    ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function aviso(url) {
            swal.fire ({
                title: 'Fallo al enviar el correo',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Volver'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            })
        }
    
        aviso('form_correo.php');
    </script>
   
<?php
}


?>



</body>
</html>


