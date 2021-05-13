<?php


namespace app\components;

use app\models\DataAntrian;
use app\models\JenisLayanan;
use app\models\Keterangan;
use app\models\Stakeholder;
use Codeception\Lib\Actor\Shared\Retry;
use yii\helpers\ArrayHelper;

class HelperKppnBukitTinggi
{
	const JENIS_NOTIFIKASI = [
		'Konfirmasi Setoran' => 'Konfirmasi Setoran',
		'LPJ Bendahara' => 'LPJ Bendahara',
		'Penolakan SPM' => 'Penolakan SPM',
		'RETUR SP2D' => 'RETUR SP2D',
		'SKPP' => 'SKPP'
	];

	const Status_Tolakan = [
		'Ditolak' => 'Ditolak',
		'Selesai' => 'Selesai',
		'Proses' => 'Proses'
	];

	const Aktifkan = [
		'Aktifkan' => 'Aktifkan',
		'Non' => 'Non',
	];

	const TampilanAntrian = [
		'tampilan_depan' => 'Tampilan Depan',
		'tampilan_panggil' => 'Tampilan Panggil',

	];

	static function getStakeholder()
	{
		$data = Stakeholder::find()->all();
		$array = [];
		foreach ($data as $item) {
			$l['nama_stakeholder'] = $item->nama_stakeholder . "( " . $item->kode_stakeholder . " )";
			$l['kode'] = $item->kode_stakeholder;

			array_push($array, $l);
		}
		return $array;
	}

	static function getJenisLayanan()
	{
		$data = JenisLayanan::find()->all();
		return ArrayHelper::map($data, 'id_jns', 'nama_layanan');
	}

	static function getKeteranganSebab()
	{
		$data = Keterangan::find()->all();

		return ArrayHelper::map($data, 'keterangan', 'keterangan');
	}

	static function hari_ini()
	{
		$hari = date("D");

		switch ($hari) {
			case 'Sun':
				$hari_ini = "Minggu";
				break;

			case 'Mon':
				$hari_ini = "Senin";
				break;

			case 'Tue':
				$hari_ini = "Selasa";
				break;

			case 'Wed':
				$hari_ini = "Rabu";
				break;

			case 'Thu':
				$hari_ini = "Kamis";
				break;

			case 'Fri':
				$hari_ini = "Jumat";
				break;

			case 'Sat':
				$hari_ini = "Sabtu";
				break;

			default:
				$hari_ini = "Tidak di ketahui";
				break;
		}

		return "<b>" . $hari_ini . "</b>";
	}

	public static function getCountAntrian()
	{
		$date = date('Y-m-d');
		$data = DataAntrian::find()
			->select("*")
			->where(['DATE(waktu)' => $date])
			->groupBy(["id"])
			->count("id");
		return $data;
	}

	public static function getCountSisaAntrian()
	{
		$date = date('Y-m-d');
		$data = DataAntrian::find()
			->select("*")
			->where(['DATE(waktu)' => $date, "status" => "Menunggu Antrian"])
			->groupBy(["id"])
			->count("id");
		return $data;
	}

	public static function getCurrentAntrian()
	{
		$date = date('Y-m-d');
		$data = DataAntrian::find()
			->select("*")
			->where(['DATE(waktu)' => $date, "status" => "Sedang Dilayani"])
			->orderBy(["id" => SORT_ASC])
			->one();
		return $data;
	}

	public static function getAntrianBerikutnya()
	{
		$date = date('Y-m-d');
		$data = DataAntrian::find()
			->select("*")
			->where(['DATE(waktu)' => $date, "status" => "Menunggu Antrian"])
			->orderBy(["id" => SORT_ASC])
			->one();
		return $data;
	}


	public static function send_notification($tokens, $message)
	{
		$url = 'https://fcm.googleapis.com/fcm/send';
		$fields = array(
			'registration_ids' => $tokens,
			'data' => $message
		);
		$server_key = 'AAAAsBr0yKA:APA91bG16D_587riRbYkykckkr81hfbJ6M9oZE382nwApAVXHeVwPoQO7z9gcvsGHIGaElYDcy-YoENH2vfiySvJcYMunQijmuNzJf5ENZZbNeujCdIR8Y_UhBmGqFq8A9ibP4pB-Zpl';
		$headers = array(
			'Authorization:key =' . $server_key,
			'Content-Type: application/json'
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		if ($result === FALSE) {
			die('Oops! FCM Send Error: ' . curl_error($ch));
		}
		curl_close($ch);
		print_r($result);
	}


	public static function role($role)
	{
		$status = null;
		if ($role == 'stakeholder') {
			$status = 'Stakeholder';
		} else if ($role == 'admin') {
			$status = 'Admin';
		} else if ($role == 'super') {
			$status = 'Super Admin';
		} else if ($role == 'ASeksiPd') {
			$status = 'Admin Seksi Pd';
		} else if ($role == 'ASeksiMSKI') {
			$status = 'Admin Seksi MSKI';
		} else if ($role == 'ASeksiBank') {
			$status = 'Admin Seksi Bank';
		} else if ($role == 'ASeksiVera') {
			$status = 'Admin Seksi Vera';
		} else if ($role == 'ASBU') {
			$status = 'Admin SBU';
		}

		return $status;
	}


	public static function getRole()
	{
		$data = [
			'stakeholder' => 'Stakeholder',
			'admin' => 'Admin',
			'super' => 'Super',
			'ASeksiPd' => 'Admin Seksi Pd',
			'ASeksiMSKI' => 'Admin Seksi MSKI',
			'ASeksiBank' => 'Admin Seksi Bank',
			'ASeksiVera' => 'Admin Seksi Vera',
			'ASBU' => 'Admin SBU'
		];
		return $data;
	}
}
