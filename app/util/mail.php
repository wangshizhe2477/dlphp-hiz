<?php
/**
 * 发送邮件
 * 
 * require_once APP_UTIL . 'mail.php';
 * send_mail('111111', '22222222222');
 */
function send_mail($subject, $body, $re_nmail) {
	require (LIB . 'PHPMailer/PHPMailer.php');
	$mail = new PHPMailer ();
	$address = $re_nmail;
	$mail->IsSMTP (); // set mailer to use SMTP 
	$mail->Host = 'smtp.qq.com'; // specify main and backup server 
	$mail->SMTPAuth = true; // turn on SMTP authentication 
	$mail->Username = "tech@dlphp.com"; // SMTP username 
	$mail->Password = 'wang0003'; // SMTP password 
	$mail->From = "tech@dlphp.com";
	$mail->FromName = "tech";
	$mail->AddAddress ( $address, "" );
	//$mail->AddReplyTo("", ""); 
	//$mail->WordWrap = 50; // set word wrap to 50 characters 
	//$mail->AddAttachment("/var/tmp/file.tar.gz"); // add attachments 
	//$mail->AddAttachment("/tmp/image.jpg", "new.jpg"); // optional name 
	//$mail->IsHTML(true); // set email format to HTML 
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
	if (! $mail->Send ()) {
		echo "Message could not be sent. <p>";
		echo "Mailer Error: " . $mail->ErrorInfo;
		return false;
	}
	return true;
}
?>