<?php

if (empty($_POST)) exit();

require_once ("include/PHPMailer/class.phpmailer.php");
define ('MAIL_HOST', "smtps.aruba.it");
define ('MAIL_PORT', "465");
define ('MAIL_SMTPSECURE', 'ssl');
define ('MAIL_USERNAME', "form@autodemolizionediroma.it");
define ('MAIL_PASSWORD', "2aleare6");
// define ('MAIL_SPA', "ricambiautodiroma@gmail.com"); 
define ('MAIL_SPA', "sberz666@gmail.com"); 
    
extract($_POST); //nome, email, maker, model, anno, cilindrata, alimentazione, colore, note

// formattazione mail con due titoli e intestazioni diverse (una per cliente, una per servprot)
$titolo_cli="Riepilogo Richiesta informazioni ricambio su www.autodemolizionediroma.it";
$titolo_spa="Richiesta informazioni ricambio";
$head_cli="Salve, $nome.<br />
		   Abbiamo ricevuto la sua richiesta di informazioni per la disponibilit&agrave; di un pezzo di ricambio.<br />
		   Di seguito il riepilogo della Sua richiesta:<br /><br />
";
$head_spa="&Egrave; stata effettuata una richiesta di informazioni per la disponibilità di un pezzo di ricambio.<br />
		   Di seguito i dettagli della richiesta: <br /><br />
";
$body_spa="<strong>Nome: </strong>$nome<br />
		   <strong>Email: </strong>$email<br />
";
$body="<strong>Costruttore: </strong>$maker<br />
       <strong>Modello: </strong>$model<br />
";
if (!empty($anno)) $body.="<strong>Anno: </strong>$anno<br />";
if (!empty($cilindrata)) $body.="<strong>Cilindrata: </strong>$cilindrata<br />";
if (!empty($alimentazione)) $body.="<strong>Alimentazione: </strong>$alimentazione<br />";
if (!empty($colore)) $body.="<strong>Colore: </strong>$colore<br />";
if (!empty($note)) $body.="<strong>Note: </strong>$note<br />";

$footer_cli="Grazie per averci contattato. Provvederemo alla verifica della disponibilità del ricambio da Lei richiesto e le risponderemo il più presto possibile.";
$footer_spa="<strong>Richiesta effettuata il: </strong>".date("d-m-Y, H:i:s");

// invio mail a cliente
$mail = new PHPMailer;
$mail->isSMTP();                                      
$mail->Host = MAIL_HOST;  
$mail->SMTPAuth = true;                               
$mail->Username = MAIL_USERNAME;                 
$mail->Password = MAIL_PASSWORD;                          
$mail->SMTPSecure = MAIL_SMTPSECURE;                           
$mail->Port = MAIL_PORT;    

$mail->From = MAIL_USERNAME;
$mail->FromName = 'Servizi Protezione Ambiente';
$mail->addAddress($email);   
$mail->isHTML(true);                                 

$mail->Subject = $titolo_cli;
$mail->Body    = $head_cli.$body.$footer_cli;
$mail->send();

// invio mail a servprot
$mail = new PHPMailer;
try {
	$mail->isSMTP();                                      
	$mail->Host = MAIL_HOST;  
	$mail->SMTPAuth = true;                               
	$mail->Username = MAIL_USERNAME;                 
	$mail->Password = MAIL_PASSWORD;                          
	$mail->SMTPSecure = MAIL_SMTPSECURE;                           
	$mail->Port = MAIL_PORT;    

	$mail->From = MAIL_USERNAME;
	$mail->FromName = 'Servizi Protezione Ambiente';
	$mail->addAddress(MAIL_SPA);   
	$mail->isHTML(true);                                 

	$mail->Subject = $titolo_spa;
	$mail->Body    = $head_spa.$body_spa.$body.$footer_spa;
	if (!$mail->send()) $footer_cli="Mail non inviata"; 
	$out=$footer_cli;
} catch (phpmailerException $e) {
	$out=$e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
	$out=$e->getMessage(); //Boring error messages from anything else!
}

// echo messaggio di alert
$output=array("mess"=>$out);
echo json_encode($output);




?>
