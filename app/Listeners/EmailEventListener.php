<?php
/**
 * Created by PhpStorm.
 * User: austi_000
 * Date: 5/31/2016
 * Time: 8:43 AM
 */

namespace App\Listeners;

use Log;
use Swift_Message;

class EmailEventListener
{
	public function onMailerSending(Swift_Message $message){
		Log::info("Sent message with subject ".$message->getSubject() ." to: ".collect($message->getTo())->first());
	}
	/**
	 * Register the listeners for the subscriber.
	 *
	 * @return void
	 */
	public function subscribe($events) {
		$events->listen ( 'mailer.sending', 'App\Listeners\EmailEventListener@onMailerSending' );
	}
}
//mailer.sending
