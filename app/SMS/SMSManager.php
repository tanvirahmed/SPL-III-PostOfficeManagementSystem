<?php

namespace App\SMS;

use Nexmo;

class SMSManager
{

	public function sendSMS($to, $body){

		Nexmo::message()->send([
	    	'to'   => '+88'.$to,
	    	'from' => 'POMS',
	    	'text' => $body
		]);
	}

}

?>