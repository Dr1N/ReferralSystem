<?php
class Mailer
{
	private static $_subjects = array(
		'registration' => 'Confirm you Registration in Referral System',
		'invitation' => 'You have been Invited to Referral System',
		'restore' => 'Restore Password for Referral System',
		'referral' => 'You have been Invited to #campaign_name#',
	);	
	
	private static function getHeader()
	{
		$headers = "MIME-Version: 1.0\r\n";
   		$headers .= "Content-type: text/html; charset=utf-8\r\n";
	   	$headers .= 'From: ' . Yii::app()->params['adminName'] . ' <' . Yii::app()->params['adminEmail'] . '>';
	   	return $headers;
	}

    public static function sendRegistration($user, $password)
	{
		$subject = self::$_subjects['registration'];
		$message = '<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			</head>
			<body>
				You have been registered in the Referral System.<br /><br />
            	The new password was generated for you.<br />
            	To login in the site please take your new password and enter it in the corresponding field in the registration form.<br /><br />
				Your login: <b>' . $user->mail . '</b><br />
            	Your new password: <b>' . $password . '</b>
            </body>
            </html>';
        return mail($user->mail, $subject, $message, self::getHeader());
	}

	public static function sendInvitation($model, $code, $password = null)
	{
		$subject = self::$_subjects['invitation'];
		
		$password ? $userInfo = '<br /><br />
        	Your personal data:<br />
        	Login: ' . $model->mail . '<br />
        	Password: ' . $password . '<br />
        	First name: ' . $model->first_name . '<br />
        	Last name: ' . $model->last_name . '<br />
        	Country: ' . $model->country->name . '<br />
        	City: ' . $model->city . '<br />
        	Adress: ' . $model->address . '<br />
        	Phone: ' . $model->phone . '<br />
        	Birthday: ' . DateHandler::dateView($model->birthday) . '<br />'
        	: ' '; 

		$message = '<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			</head>
			<body>
				You have been invited in the Referral System.<br /><br />
             	To confirm the registration user the link: ' 
            	. Yii::app()->createAbsoluteUrl('user/verify', array('id'=>$model->id, 'code'=>$code)) .
            	$userInfo . 
            '</body>
            </html>';
        return mail($model->mail, $subject, $message, self::getHeader());
	}

	/*public static function sendInvitation($user_id, $email, $code)
	{
		$subject = self::$_subjects['invitation'];
		$message = '<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			</head>
			<body>
				You have been invited in the Referral System.<br /><br />
             	To confirm the registration user the link: ' 
            	. Yii::app()->createAbsoluteUrl('user/verify', array('id'=>$user_id, 'code'=>$code)) . '
            </body>
            </html>';
        return mail($email, $subject, $message, self::getHeader());
	}

	public static function sendInvitationNewUser($user_id, $email, $code, $password)
	{
		$subject = self::$_subjects['invitation'];
		$message = '<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			</head>
			<body>
				You have been invited in the Referral System.<br /><br />
             	To confirm the registration user the link: ' 
            	. Yii::app()->createAbsoluteUrl('user/verify', array('id'=>$user_id, 'code'=>$code)) . '
            	<br /><br />
            	Your personal data:<br />
            	Login: ' . $email . '<br />
            	Password: ' . $password . '
            </body>
            </html>';
        return mail($email, $subject, $message, self::getHeader());
	}*/

	public static function sendRestorePassword($user, $password)
	{
		$subject = self::$_subjects['restore'];
		$message = '<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			</head>
			<body>
				You have restored password in the Referral System.<br /><br />
            	You new password: <b>' .  $password . '</b>
            </body>
            </html>';
        return mail($user->mail, $subject, $message, self::getHeader());
	}

	public static function sendReferral($email, $user_message, $user, $campaign)
	{
		$subject = self::$_subjects['referral'];
		$campaigLink = '<a href="' . $campaign->site_url .'">' . $campaign->name . '</a>';
		$message = '<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			</head>
			<body>
				You have been Invited to ' . $campaigLink .
				' by ' . $user->first_name . ' ' . $user->last_name . '<br />' .
				$user_message  .
			'</body>
            </html>';
        
        $headers = "MIME-Version: 1.0\r\n";
   		$headers .= "Content-type: text/html; charset=utf-8\r\n";
	   	$headers .= 'From: ' . $user->first_name . ' ' . $user->last_name . ' <' . $user->mail . '>';
        
        return mail($email, $subject, $message, $headers);
	}

	public static function sendContact($model)
	{
		$headers = "MIME-Version: 1.0\r\n";
   		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers .= "From: {$model->email}\r\nReply-To: {$model->email}";
		$email = Yii::app()->params['adminEmail'];
		$subject = $model->subject;
		$message = '<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			</head>
			<body>' .
			$model->body .
			'</body>
            </html>';

        return mail($email, $subject, $message, $headers);
	}
}