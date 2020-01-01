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

		$deviceToken = 'cesVwwuCbZ8:APA91bF_S10oTGN60uOF-gaggORzrImpWKOr_IHanxe8-dwasvXiN7amN11JIG_ME-S4MF_JewUYsAzvyelQLgRpUQVNsPfxI8Z8zJzIL6kF_f0_hRFJq2pvVwPmKLAYKWsbpO5oNkB0';
		$message = CloudMessage::withTarget('token', $deviceToken)
    ->withNotification(Notification::create('Informasi kehadiran hari ini', 'Fiqri belum melakukan scan fingerprint'))
		->withData(['key' => 'ISI']);

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
