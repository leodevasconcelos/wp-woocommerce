<?php
/**********************************
 * P/ o envio correto preencher as
 * informa��es abaixo, mudar nome
 * do site no email de retorno e
 * verificar * a vari�vel '$mail->AddAddress'
 * para c�pias. O formato deve ser:
 * $mail->AddAddress("mail@example.com", utf8_decode("Subject"));
 * *******************************/

 
// $host="smtp.tecnelsa.com.br";
// $port=587;
// $user="site@tecnelsa.com.br";
// $pass="Tecnelsa@2019";
// $name_user="TecNelsa";
// $subject="Contato";          
// $site_name="TecNelsa";


require_once('PHPMailer/class.phpmailer.php');

  		$email_body_retorno = "
  		  <table width='100%' border='0' cellpadding='20' cellspacing='4' bgcolor='#c5c5c5'>
  		  <tr>
  		  <td align='center'>
  		  <table width='550' border='0' cellpadding='4' cellspacing='4' bgcolor='#FFFFFF'>
  		  <tr>
  		  <td  style='padding:5px;' align='center' colspan='2'>
  		  <font size='4'>
  		  <b>Contato</b>
  		  </font>
  		  </td>
  		  </tr>
  		";

  		$email_body_retorno  .="
  		  <tr >
  		  <td style='padding:14px;' colspan='2'>
  		  Olá ".$_POST['nome']."!<br /><br />
		  Formulário enviado com sucesso! Entraremos em contato o mais breve possível. <br /><br />
		  ".$site_name."
  		  </td>
  		  </tr>
  		";

  		$email_body_retorno  .= "
  		  </table>
  		  <br />
  		  <span style='width:450px;color:#FFF;font-size:10px;'>Este email é de disparo automático, por favor não responda.</span>
  		  </td>
  		  </tr>
  		  </table>
  		";

  		$email_body = "
  		  <table width='100%' border='0' cellpadding='20' cellspacing='4' bgcolor='#c5c5c5'>
  		  <tr>
  		  <td align='center'>
  		  <table width='550' border='0' cellpadding='4' cellspacing='4' bgcolor='#FFFFFF'>
  		  <tr>
  		  <td  style='padding:5px;' align='center' colspan='2'>
  		  <font size='4'>
  		  <b>Formulário de contato - Hipercor</b>
  		  </font>
  		  </td>
  		  </tr>
  		";
      
  		foreach($_POST as $i => $v){
  		  
  			if($i!= "g-recaptcha-response" && $i!="hideit" && $i!="view" && $i!="option" && $i!="x" && $i!="y"):
  			  $email_body .="
  			  <tr >
  			  <td style='padding:14px;' width='100' align='left'><b>".str_replace("_", " ", $i).":</b></td>
  			  <td style='padding:14px;'>".$_POST[$i]."</td>
  			  </tr>
  			  ";
  			endif;
  		}
      
  		$email_body .= "
  		  </table>
  		  <br />
  		  <span style='width:450px;color:#FFF;font-size:10px;'>Este email é de disparo automático, por favor não responda. </span>
  		  </td>
  		  </tr>
  		  </table>
			";
			
require_once "../libs/recaptcha/recaptchalib.php";
$secret = "my secret key";

$reCaptcha = new ReCaptcha($secret);

if ($_POST["g-recaptcha-response"]) {
	$resp = $reCaptcha->verifyResponse(
			$_SERVER["REMOTE_ADDR"],
			$_POST["g-recaptcha-response"]
	);
}

if ($resp != null && $resp->success) {

	$mail = new PHPMailer();
					
	$mail->IsSMTP();

	$mail->SMTPAuth = true;
	$mail->SMTPKeepAlive = true;
	$mail->Host = $host;
	$mail->Port = $port;
	$mail->Username = $user;
	$mail->Password = $pass;
	$mail->SetFrom($user,$name_user);
	$mail->SMTPDebug = 1; 
	$body_retorno = $email_body_retorno;
	$mail->MsgHTML(utf8_decode($email_body));
	$mail->Subject = utf8_decode($subject);
	$mail->AddAddress($user, $site_name);

	if($mail->Send()) {
		
		$mail->ClearAddresses();
		$mail->Subject       = utf8_decode("Formulário de contato");
		$mail->MsgHTML($body_retorno);
		$mail->AddAddress($_POST['email'], $_POST['nome']);
		$mail->Send();
		$mail->ClearAddresses();	  
		
		$_SESSION["msg_to_display"] = "Formulário enviado com sucesso!";
		$_SESSION["success"] = 1;
					
		echo '
		<script type="text/javascript">
		alert(\''.utf8_decode('').'Formulário enviado com sucesso! Entraremos em contato o mais breve possível.\');window.location=\''.$_SERVER["HTTP_REFERER"].'\';
		</script>
		';
		exit();
	} else {
		echo "Mailer Error (" . str_replace("@", "&#64;", $_POST["email"]) . ') ' . $mail->ErrorInfo . '<br />';
	}
} else {
	echo '
		<script type="text/javascript">
		alert(\''.utf8_decode('').'Marque o captcha para termos certeza que você não é um robô!\');window.location=\''.$_SERVER["HTTP_REFERER"].'\';
		</script>
		';
		exit();
}

?>