<?php
header('Access-Control-Allow-Origin: *');
require 'class.phpmailer.php';



// ეს ბლოკი /uploads ფოლდერში ტვირთავს ფაილს
if ( $_FILES['file']['error'] > 0 ){
  echo 'Error: ' . $_FILES['file']['error'] . '<br>';
}
else {
if(move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']))
  {
    echo "File Uploaded Successfully";
  }
}




$path = 'uploads/' . $_FILES["file"]["name"];
$mail = new PHPMailer;
$mail->IsSMTP();								//Sets Mailer to send message using SMTP
$mail->Host = 'smtp.gmail.com';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
$mail->Port = '587';								//Sets the default SMTP server port
$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
$mail->Username = 'mdivnika@gmail.com';					//Sets SMTP username
$mail->Password = 'Mkmgmk113!';					//Sets SMTP password
$mail->SMTPSecure = 'ssl';							//Sets connection prefix. Options are "", "ssl" or "tls"
$mail->From = $_POST["email"];					//Sets the From email address for the message
//$mail->FromName = $_POST["name"];				//Sets the From name of the message
$mail->AddAddress('giorgi_mdivnishvili@yahoo.com', 'sheldon.ge satesto');		//Adds a "To" address
$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
$mail->IsHTML(true);							//Sets message type to HTML
$mail->AddAttachment($path);					//Adds an attachment from a path on the filesystem
$mail->Subject = 'meilis subject-i';				//Sets the Subject of the message
$mail->Body = '<div class="alert alert-success">File attachment</div>';							//An HTML or plain text message body
if($mail->Send())								//Send an Email. Return true on success or false on error
{
  //თუ გაიგზავნა დაწეროს success და წაშალოს ფაილი
  echo 'success';
  unlink($path);
}
else
{
  //თუ არ გაიგზავნა დაწეროს fail
  echo 'sending failed';
}


?>