<?php

require_once './vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\ServiceAccount\Discoverer;
use Kreait\Firebase\Messaging\Notification;

class NotifikasiModel extends CI_Model {


	public function notif($token, $isi)
	{
		$factory = (new Factory)
    ->withServiceAccount('./secret/sipsen-b51ba-firebase-adminsdk-iitq6-f4ac9ac94a.json')
    ->withDatabaseUri('https://sipsen-b51ba.firebaseio.com/');

		$database = $factory->createDatabase();

		$messaging = $factory->createMessaging();

		//$deviceToken = 'fZp207ZmmMk:APA91bG2hzmUeImDrGSMordkVVgzuN5zHUOdJ8JO7gBG3SDJLgo2eg8_Qc4Tpjd_y-PSI2jLUYCw4Gymi7aG3_KIjUwG8U1jpNaO3HKlOTDYYmLV2idjtPpaBndAjOL5QvIHFh3K1114';
		$message = CloudMessage::withTarget('token', $token)
    ->withNotification(Notification::create('Informasi kehadiran hari ini', $isi));

		try{
			$messaging->send($message);
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	public function notifBimbingan($token)
	{
		$factory = (new Factory)
    ->withServiceAccount('./secret/sipsen-b51ba-firebase-adminsdk-iitq6-f4ac9ac94a.json')
    ->withDatabaseUri('https://sipsen-b51ba.firebaseio.com/');

		$database = $factory->createDatabase();

		$messaging = $factory->createMessaging();

		//$deviceToken = 'fZp207ZmmMk:APA91bG2hzmUeImDrGSMordkVVgzuN5zHUOdJ8JO7gBG3SDJLgo2eg8_Qc4Tpjd_y-PSI2jLUYCw4Gymi7aG3_KIjUwG8U1jpNaO3HKlOTDYYmLV2idjtPpaBndAjOL5QvIHFh3K1114';
		$message = CloudMessage::withTarget('token', $token)
    ->withNotification(Notification::create('Informasi bimbingan', 'Anda baru saja mendapatkan saran'));

		try{
			$messaging->send($message);
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

  public function notifMultipleSiswa($deviceToken, $judul, $isi){
    $factory = (new Factory)
    ->withServiceAccount('./secret/sipsen-b51ba-firebase-adminsdk-iitq6-f4ac9ac94a.json')
    ->withDatabaseUri('https://sipsen-b51ba.firebaseio.com/');
		$database = $factory->createDatabase();
		$messaging = $factory->createMessaging();
    //array kumpulan pesan notifikasi
    $messages = array();

    foreach($deviceToken as $token){
      $message = CloudMessage::withTarget('token', $token)
      ->withNotification(Notification::create($judul, $isi));

      $messages[]=$message;
    }

		try {
			$sendReport = $messaging->sendAll($messages);
		} catch (\Exception $e) { }
  }

	public function notifMultipleWali($dataWali){
    $factory = (new Factory)
    ->withServiceAccount('./secret/sipsen-b51ba-firebase-adminsdk-iitq6-f4ac9ac94a.json')
    ->withDatabaseUri('https://sipsen-b51ba.firebaseio.com/');
		$database = $factory->createDatabase();
		$messaging = $factory->createMessaging();
    //array kumpulan pesan notifikasi
    $messages = array();

    foreach($dataWali as $data){
			$isi = $data['isi'];
			$judul = $data['judul'];
      $message = CloudMessage::withTarget('token', $data['token'])
      ->withNotification(Notification::create($judul, $isi));

      $messages[]=$message;
    }

		try {
			$sendReport = $messaging->sendAll($messages);
		} catch (\Exception $e) { }
  }



}
