<?php

require_once './vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\ServiceAccount\Discoverer;
use Kreait\Firebase\Messaging\Notification;

class FirebaseTest extends CI_Controller {

	public function test()
	{
		$factory = (new Factory)
    ->withServiceAccount('./secret/sipsen-b51ba-firebase-adminsdk-iitq6-f4ac9ac94a.json')
    ->withDatabaseUri('https://sipsen-b51ba.firebaseio.com/');

		$database = $factory->createDatabase();

		$messaging = $factory->createMessaging();

		$deviceToken = 'e2AAPiJdFC8:APA91bH7vA4xiavgBVXOzb1oaJQOVfk4JiILuv2JbYyB-HNcz3bpPqpCPolzC-GSyA6brDz9WX-cWEbfnpGP2EQBNjPxj2C8wEYDyFUdsH5vWyrpyrjXH0TwRJdd9DC877F9QuFBtLSD';
		$message = CloudMessage::withTarget('token', $deviceToken)
    ->withNotification(Notification::create('Informasi kehadiran hari ini', 'Fiqri belum melakukan scan fingerprint'));

		try{
			$messaging->send($message);
		}catch(Exception $e){
			echo $e->getMessage();
		}


		// $database->getReference('website')
   // ->set([
   //     'name' => 'My Application',
   //     'emails' => [
   //         'support' => 'support@domain.tld',
   //         'sales' => 'sales@domain.tld',
   //     ],
   //     'website' => 'https://app.domain.tld',
   //    ]);
	 //
		// 	$database->getReference('config/website/name')->set('New name');

	}
}
