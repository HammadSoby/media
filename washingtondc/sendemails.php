<?
function SendEmail($E_mail,  $DocText,  $DocTitle)
{

	if ($E_mail <> "temp_login@blacklinksuk.com")
	{
	
		$message = "<html xmlns='http://www.w3.org/1999/xhtml'>
		<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
		<title>Your Message Subject or Title</title>
		<style type='text/css'>
			/* Based on The MailChimp Reset INLINE: Yes. */  
			/* Client-specific Styles */
			#outlook a {padding:0;} /* Force Outlook to provide a 'view in browser' menu link. */
			body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;} 
			/* Prevent Webkit and Windows Mobile platforms from changing default font sizes.*/ 
			.ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */  
			.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
			/* Forces Hotmail to display normal line spacing.  More on that: http://www.emailonacid.com/forum/viewthread/43/ */ 
			#backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
			/* End reset */
	
			/* Some sensible defaults for images
			Bring inline: Yes. */
			img {outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;} 
			a img {border:none;} 
			.image_fix {display:block;}
	
			/* Yahoo paragraph fix
			Bring inline: Yes. */
			p {margin: 1em 0;}
	
			/* Hotmail header color reset
			Bring inline: Yes. */
			h1, h2, h3, h4, h5, h6 {color: black !important;}
	
			h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {color: blue !important;}
	
			h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {
			color: red !important; /* Preferably not the same color as the normal header link color.  There is limited support for psuedo classes in email clients, this was added just for good measure. */
			}
	
			h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {
			color: purple !important; /* Preferably not the same color as the normal header link color. There is limited support for psuedo classes in email clients, this was added just for good measure. */
			}
	
			/* Outlook 07, 10 Padding issue fix
			Bring inline: No.*/
			table td {border-collapse: collapse;}
	
			/* Remove spacing around Outlook 07, 10 tables
			Bring inline: Yes */
			table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
	
			/* Styling your links has become much simpler with the new Yahoo.  In fact, it falls in line with the main credo of styling in email and make sure to bring your styles inline.  Your link colors will be uniform across clients when brought inline.
			Bring inline: Yes. */
			a {color: orange;}
	
	
			/***************************************************
			****************************************************
			MOBILE TARGETING
			****************************************************
			***************************************************/
			@media only screen and (max-device-width: 480px) {
				/* Part one of controlling phone number linking for mobile. */
				a[href^='tel'], a[href^='sms'] {
							text-decoration: none;
							color: blue; /* or whatever your want */
							pointer-events: none;
							cursor: default;
						}
	
				.mobile_link a[href^='tel'], .mobile_link a[href^='sms'] {
							text-decoration: default;
							color: orange !important;
							pointer-events: auto;
							cursor: default;
						}
	
			}
	
			/* More Specific Targeting */
	
			@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
			/* You guessed it, ipad (tablets, smaller screens, etc) */
				/* repeating for the ipad */
				a[href^='tel'], a[href^='sms'] {
							text-decoration: none;
							color: blue; /* or whatever your want */
							pointer-events: none;
							cursor: default;
						}
	
				.mobile_link a[href^='tel'], .mobile_link a[href^='sms'] {
							text-decoration: default;
							color: orange !important;
							pointer-events: auto;
							cursor: default;
						}
			}
	
			@media only screen and (-webkit-min-device-pixel-ratio: 2) {
			/* Put your iPhone 4g styles in here */ 
			}
	
			/* Android targeting */
			@media only screen and (-webkit-device-pixel-ratio:.75){
			/* Put CSS for low density (ldpi) Android layouts in here */
			}
			@media only screen and (-webkit-device-pixel-ratio:1){
			/* Put CSS for medium density (mdpi) Android layouts in here */
			}
			@media only screen and (-webkit-device-pixel-ratio:1.5){
			/* Put CSS for high density (hdpi) Android layouts in here */
			}
			/* end Android targeting */
	
		</style>
	
		<!-- Targeting Windows Mobile -->
		<!--[if IEMobile 7]>
		<style type='text/css'>
		
		</style>
		<![endif]-->   
	
		<!-- ***********************************************
		****************************************************
		END MOBILE TARGETING
		****************************************************
		************************************************ -->
	
		<!--[if gte mso 9]>
			<style>
			/* Target Outlook 2007 and 2010 */
			</style>
		<![endif]-->
	</head>
	<body>
	<!-- Wrapper/Container Table: Use a wrapper table to control the width and the background color consistently of your email. Use this approach instead of setting attributes on the body tag. -->
	<table cellpadding='0' cellspacing='0' border='0' id='backgroundTable'>
		<tr>
			<td valign='top'> 
			<!-- Tables are the most common way to format your email consistently. Set your table widths inside cells and in most cases reset cellpadding, cellspacing, and border to zero. Use nested tables as a way to space effectively in your message. -->
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td width='500' valign='top'>
				
					
					</td>
				</tr>
				
				<tr>
					<td align='left' width='200' valign='top'><br/> <br/>  <br/> 

					" . $DocText . "
					
					</td>
				</tr>
				
				<tr><td>
				 <br/>	
				Yours sincerely  <br/>
				Admin@mediaunited.co.uk  <br/>
				Media United  <br/>					
					

					
					</td>
				</tr>
			</table>
			<!-- End example table -->
	
			<!-- Yahoo Link color fix updated: Simply bring your link styling inline. -->
	
			</td>
		</tr>
	</table>  
	<!-- End of wrapper table -->
	</body>
	</html>";

		//	$to = "bovell_d@hotmail.com"; //Payer_email - Change back when live sEmailTo
			$sEnquiry = " Media United  - " .  $DocTitle;
		//	$Message = "Dear " . $sCustomername . "," .  "\r\n" . " Thank you for your order! " . "\r\n" . $sMesDetails . "\r\n" . "Kind regurds" . "\r\n" . "AKOG";
			
			
			$subject = $sEnquiry;
			
		
		
	//	$to = "davidb@informationconsultancyservices.co.uk"; //"admin@executortrustee.com";
	//	$to = "davidb.cap@gmail.com"; //"admin@executortrustee.com";
		
		
		
		

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Europe/London');

require_once 'PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
//$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = "ip-104-238-103-231.secureserver.net";
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 465;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
//Username to use for SMTP authentication
$mail->Username = "admin@theunited.media";
//Password to use for SMTP authentication
$mail->Password = "117YGHG49ej";
//Set who the message is to be sent from
$mail->setFrom('admin@theunited.media', 'Admin');
//Set an alternative reply-to address
$mail->addReplyTo('admin@theunited.media','Admin');
//Set who the message is to be sent to
$mail->addAddress($E_mail, $CName);
//Set the subject line
$mail->Subject =  $subject;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($message);
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file


if ($Att1 <>"0")
{
//	$mail->AddAttachment("/home/black/public_html/" . $Att1 ); 
}


//send the message, check for errors
if (!$mail->send()) {
  //  echo "Mailer Error: " . $mail->ErrorInfo;
  $Sent = "No";
} else {
 //   echo "Message sent!";
	$Sent = "Yes";
}


	
	
	}
	else
	{
		$Sent = "No";
	}

	return $Sent;
}
?>
