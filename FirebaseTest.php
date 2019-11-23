<?php

require_once './vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\ServiceAccount\Discoverer;
use Kreait\Firebase\Messaging\Notification;

class FirebaseTest {

	public function index()
	{
		$factory = (new Factory)
    ->withServiceAccount('./secret/sipsen-b51ba-firebase-adminsdk-iitq6-f4ac9ac94a.json')
    ->withDatabaseUri('https://sipsen-b51ba.firebaseio.com/');

		$database = $factory->createDatabase();

		$messaging = $factory->createMessaging();

		$deviceToken = 'fZp207ZmmMk:APA91bG2hzmUeImDrGSMordkVVgzuN5zHUOdJ8JO7gBG3SDJLgo2eg8_Qc4Tpjd_y-PSI2jLUYCw4Gymi7aG3_KIjUwG8U1jpNaO3HKlOTDYYmLV2idjtPpaBndAjOL5QvIHFh3K1114';
		$message = CloudMessage::withTarget('token', $deviceToken)
    ->withNotification(Notification::create('Informasi kehadiran hari ini', 'Fiqri belum melakukan scan fingerprint'))
    ->withData(['key' => 'value']);

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
