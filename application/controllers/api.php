<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	
	function index(){
		$response['code'] 		= 200;
		$response['error']		= FALSE;
		$response['message']	= 'Success';
		$response['result'] 	= "ini echo index";
		echo json_encode($response);
	}

	function hitung_knn(){
		// if ($this->input->server('REQUEST_METHOD') == 'POST'){
		// $teks 				 = $this->input->post('teks');		
		// $pilih_fitur		 = $this->input->post('pilih_fitur');
		$pilih_fitur		 = array('0','1','4');
		$teks = file_get_contents("./assets/test_error.txt");
		$hasil_segementasi   = $this->segmentasi($teks); //FIXED
		$caseFolding 		 = $this->caseFolding($hasil_segementasi);// FIXED
		$stopword 			 = $this->stopword($caseFolding); //FIXED
		$stemming 			 = $this->stemming($stopword);//FIXED
		$hasil_preprocessing = $this->gabung_kalimat($stemming);

		/*Hitung Kata kunci*/
		$countkey 			 = call_user_func_array('array_merge', $stemming); //merge menjadi 2 dimensi array
		$countkey 			 = call_user_func_array('array_merge', $countkey); //merge lagi jdi 1 dimensi array
		$countkey 			 = array_count_values($countkey); //menghitung jumlah kata yang sama
		arsort($countkey); 	  //mengurutkan nilai dari terbesar
		$countkey 			 = array_slice($countkey, 0,3); // ambil 3 kata kunci yg jumlahnya paling banyak

		$countkey_baru 		 = array(); //menampung kata kunci menjadi index 0,1,2
		foreach ($countkey as $key => $value) {
			array_push($countkey_baru, $key);
		}

		$extract_fitur		 = $this->extract_fitur($hasil_preprocessing,$countkey_baru); //mengambil data paragraf, total kalimat, kalimat, posisi kalimat, data judul

		// Hitung fitur 1 sampai 6 data uji
		$fitur1_uji			 = $this->fitur_1($extract_fitur);
		$fitur2_uji 		 = $this->fitur_2($extract_fitur);
		$fitur3_uji			 = $this->fitur_3($extract_fitur);
		$fitur4_uji			 = $this->fitur_4($extract_fitur);
		$fitur5_uji 		 = $this->fitur_5($extract_fitur);
		$fitur6_uji 		 = $this->fitur_6($extract_fitur);

		// print_r($caseFolding);
		// die();

		$fitur1_latih		 = array();
		$fitur2_latih		 = array();
		$fitur3_latih		 = array();
		$fitur4_latih 		 = array();
		$fitur5_latih		 = array();
		$fitur6_latih		 = array();

		// Menentukan jumlah kelas yang nantinya diambil
		$k = 3;

		// Hitung fitur 1 sampai 6 data latih
		$data_latih 		 = $this->db->query("SELECT * FROM tb_hasil_ekstraksi")->result_array();
		foreach ($data_latih as $key => $value) {
			$f1_latih = $value['fitur_1'];
			$f2_latih = $value['fitur_2'];
			$f3_latih = $value['fitur_3'];
			$f4_latih = $value['fitur_4'];
			$f5_latih = $value['fitur_5'];
			$f6_latih = $value['fitur_6'];

			array_push($fitur1_latih, $f1_latih);
			array_push($fitur2_latih, $f2_latih);
			array_push($fitur3_latih, $f3_latih);
			array_push($fitur4_latih, $f4_latih);
			array_push($fitur5_latih, $f5_latih);
			array_push($fitur6_latih, $f6_latih);
		}

		//Hitung jarak euclid berdasar fitur yg dipilih user
		$hasil_jarak = array();
		for ($i=0; $i <count($fitur1_uji) ; $i++) {
			$temp = array();
			for ($j=0; $j <count($fitur1_latih) ; $j++) { 
				$arr = array(
							(pow($fitur1_uji[$i]-$fitur1_latih[$j],2)),
							(pow($fitur2_uji[$i]-$fitur2_latih[$j],2)),
							(pow($fitur3_uji[$i]-$fitur3_latih[$j],2)),
							(pow($fitur4_uji[$i]-$fitur4_latih[$j],2)),
							(pow($fitur5_uji[$i]-$fitur5_latih[$j],2)),
							(pow($fitur6_uji[$i]-$fitur6_latih[$j],2))

						);
				$x = 0;
				foreach ($pilih_fitur as $key => $value) {
					$x = $x + $arr[$value]; //Akumulasi fitur yg dipilih
				}

				$euclid = sqrt($x); //hitung euclidian distance nya
				array_push($temp, $euclid);			
			}
			array_push($hasil_jarak, $temp);
		}

		// Urutkan dari jarak terkecil dan ambil 3
		$hasil_jarak = array_map(function($v){
			asort($v);
			return array_slice($v, 0, 3, true);
		}, $hasil_jarak); 

		//Meyimpan key index kalimat
		$simpan_key = array();
		foreach ($hasil_jarak as $key => $value) {
			$total_key = count($value); //total key sejumlah k
			$temp = array();
			foreach ($value as $key2=>$value2) {
				array_push($temp, $key2+1); //untuk mengakses posisi dalam tabel dimulai id 1, misal key kalimat 201 brarti yg diambil di tabel id 202 karna key kalimat indexnya array dimulai dari 0
			}				
			array_push($simpan_key, $temp);
		}

		// Melakukan pengecekan ke dalam kelas data latih apakah kelas ringkasan / bukan
		$hasil_kelas = array();
		for ($i=0; $i <count($simpan_key) ; $i++) { 
			$tampung_kelas=array();
			for ($j=0; $j <$total_key ; $j++) { 
				$key_cek=$simpan_key[$i][$j];
				$data_cek=$this->db->query(" SELECT kelas FROM tb_hasil_ekstraksi WHERE 
				 id='$key_cek' ")->row_array();
				$lihat_kelas= $data_cek['kelas'];
				array_push($tampung_kelas, $lihat_kelas);
			}
			array_push($hasil_kelas, $tampung_kelas);
		}

		//Penentuan kalimat ringkasan 
		$kalimat_ringkasan = array(); //output berupa index value ringkasan
			foreach ($hasil_kelas as $key => $value) { 
				$mayoritas = array_count_values($value);
				if(isset($mayoritas['ringkasan']) && $mayoritas['ringkasan']>1){
	 	      	    array_push($kalimat_ringkasan,$key); //masukkan key sbagai value ringkasan	
		        }
			}

		// merge kalimat hasil segmentasi awal utk dibandingkan dengan hasil ringkasan
		$pecah_arr = call_user_func_array('array_merge', $caseFolding);
		$hasil_ringkasan = array(); //output kalimat ringkasan
    	foreach ($pecah_arr as $key2 => $value2) {
        	if(in_array($key2,$kalimat_ringkasan)){ //jika value $kalimat_ringkasan sama dengan $key2 hasil segmentasi awal maka
            	array_push($hasil_ringkasan, $value2); //push kalimatnya
        	}
		}
		$hasil_ringkasan = array_slice($hasil_ringkasan, 0, count($pecah_arr)/2); // potong ringkasan menjadi 50% dari total kalimat awal sebelum diringkas
		for ($z=0; $z <count($hasil_ringkasan) ; $z++) { 
				$fixing[] = trim($hasil_ringkasan[$z]);
		}
			$fix_hasil = implode('. ', $fixing);
			$fix_hasil.=".";

			// JSON
			$response['code'] 		= 200;
			$response['error']		= FALSE;
			$response['message']	= 'Success';
			$response['result']		= $fix_hasil;
			echo json_encode($response);
		// }else{
		// 	$response['code'] 		= 405;
		// 	$response['error']		= TRUE;
		// 	$response['message']	= 'Failed';
		// 	echo json_encode($response);
		// }
		
	}

 

	function segmentasi($string)
	{
		$data 			= array();
		$string			= trim($string);
		$pecahparagraf 	= preg_replace("/[\r\n]+/", "\n", $string);
		$pecahparagraf	= explode("\n",$pecahparagraf);

		foreach ($pecahparagraf as $key => $value) {
			$regex 		  	= '/“[^“”]+”(*SKIP)(*FAIL)|\.\s]*/';// Prioritaskan tanda koma terbalik
			// $pecah_titik 	= substr($value, 0, -1); // Ambil kalimat dari index-ke 0 sampai akhir kecuali 1 karakter terakhir
			$pecah_titik 	= preg_split($regex, $value); //Pecah berdasarkan titik
			$pecah_titik 	= preg_replace("/ {2,}/", " ", $pecah_titik); //hilangkan double space
			$pecah_titik	= preg_replace("/[.]/", " ", $pecah_titik);//output tidak ada titik
			$pecah_titik 	= array_filter($pecah_titik); //element kosong buang
			$pecah_titik 	= array_values($pecah_titik); //reset index
			array_push($data, $pecah_titik); //simpan ke variable data
		}
		return $data;
	}

	function caseFolding($string)
	{
		$data_return = array();
		foreach ($string as $key => $value) { //Looping element array pertama(paragraf)

			$data2 = array();
			foreach ($value as $key => $value2) { //Looping element array ke 2(kalimat)
				$data = strtolower($value2); // jadikan lowercase
				$data = preg_replace('/[^a-z^0-9^“”]/',' ',$data); //selain karakter a-z, 0-9 dan double quotes ganti spasi
				$data = preg_replace("/ {2,}/", " ", $data); //remove double space
				$data = trim($data); //remove white space krn dalam remove diatas masih ada space yg tersisa
				array_push($data2 ,$data);
			}
			$data2 = array_filter($data2);
			array_push($data_return,$data2);
		}
		return array_filter($data_return);
	}

	function stopword($string)
	{
		$data = array();
		foreach ($string as $key => $value) { //Looping element pertama (paragraf)
			$data2 = array();
			foreach ($value as $key2 => $value2) {//Looping element kedua (kalimat)
			$data3 		= array();
			$pecah_kata	= array_unique(explode(" ",$value2)); //kalimat dipecah berdasar spasi sekaligus dihilangkan kata yg duplikat
				foreach ($pecah_kata as $key3 => $value3) { // looping kata hasil explode
				$this->db->where('kata',$value3); 
				$cek=$this->db->get('stopword')->result();
					if (empty($cek)) { //pengecekan apabila kata inputan tidak ada di stopword maka masukkan ke variable data3
						array_push($data3,$value3);
					}
		
				}
				array_push($data2, $data3); //masukkan ke data2
			}
			array_push($data, $data2); // masukkan ke data
		}
		return $data;
	}

	function stemming($sentence)
	{
		require_once __DIR__.'/vendor/autoload.php';
		// create stemmer
		// cukup dijalankan sekali saja, biasanya didaftarkan di service container
		$stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
		$stemmer  = $stemmerFactory->createStemmer();

		// stem
		// $output   = $stemmer->stem($sentence);	
		$data=array();
		foreach ($sentence as $key => $value) {
			$data2=array();
			foreach ($value as $key2 => $value2) {
				$data3=array();
				foreach ($value2 as $key3 => $value3) { 
					$output   = $stemmer->stem($value3); //stemming per kata	
					array_push($data3, $output);
				}
			array_push($data2, $data3);
			}
		array_push($data, $data2);
		}
		return $data;
	}

	function gabung_kalimat($string){
		$data = array();
		foreach ($string as $key => $value) {
			$data2 = array();
			foreach ($value as $key2 => $value2) {
				$gabung = implode(" ", $value2);
				array_push($data2, $gabung);
			}
			array_push($data, $data2);
		}
		return $data;
	}

	function extract_fitur($string, $judul){
		$data_total_kalimat=array();
		$data_kalimat=array();
		$data_posisi_kalimat=array();
		$data_paragraf=array();
		foreach ($string as $key => $value) {
			$kalimat=$value;
			$total_kalimat=count($value);
			$data_posisi=array();
			$data_kata2=array();

			foreach ($value as $key2 =>$value2) {
				$data_kata=array();
				$pecah_kata=explode(" ", $value2);	
				foreach ($pecah_kata as $key3 => $value3) {
					array_push($data_kata, $value3);

				}
				array_push($data_kata2, $data_kata);
				array_push($data_posisi, $key2);
			}

				array_push($data_paragraf, $data_kata2);
				array_push($data_posisi_kalimat, $data_posisi);
				array_push($data_total_kalimat, $total_kalimat);
				array_push($data_kalimat, $kalimat);
		}

			$return_variable = array();
		    $return_variable['data_paragraf'] = $data_paragraf;
		    $return_variable['data_total_kalimat'] = $data_total_kalimat;
		    $return_variable['data_kalimat'] = $data_kalimat;
		    $return_variable['data_posisi_kalimat'] = $data_posisi_kalimat;
		    $return_variable['data_judul'] = $judul;
	    return $return_variable;

	}


	function fitur_1($extract_fitur){
		$data_posisi_kalimat=$extract_fitur['data_posisi_kalimat'];
		$data_total_kalimat =$extract_fitur['data_total_kalimat'];
		$fitursatu=array();
	 		$no=1;
			for ($i=0; $i<count($data_posisi_kalimat); $i++) {
				for ($j=0; $j <$data_total_kalimat[$i]; $j++) {
				$fitur1=(($data_total_kalimat[$i])-($data_posisi_kalimat[$i][$j]+1))/$data_total_kalimat[$i];			
				array_push($fitursatu, $fitur1);
				}
			}
		return $fitursatu;

	}

	function fitur_2($extract_fitur){
			$fiturdua=array();
			$data_total_kalimat=$extract_fitur['data_total_kalimat'];
			$tot_kalimat_dokumen= array_sum($data_total_kalimat); //total keseluruhan kalimat 
			for ($j=0; $j<$tot_kalimat_dokumen; $j++) { 
				$kalimat_ke=$j+1;
				$fitur2=($tot_kalimat_dokumen-$kalimat_ke)/$tot_kalimat_dokumen;			
				array_push($fiturdua, $fitur2);
			}
			return $fiturdua;

	}

	function fitur_3($extract_fitur){
		$fiturtiga=array();
		$data_paragraf=$extract_fitur['data_paragraf'];
		$data_total_kalimat=$extract_fitur['data_total_kalimat'];
		$data_kalimat=$extract_fitur['data_kalimat'];

		for ($i=0; $i<count($data_paragraf) ; $i++) { 
			for ($j=0; $j<$data_total_kalimat[$i]; $j++) { 
					$total_numerik=0;
					$kata=explode(" ", $data_kalimat[$i][$j]);
					$tot_kata=count($kata);
					$simpan_numerik=array();
				for($k=0; $k<$tot_kata; $k++){
					if(is_numeric($kata[$k])){
						$total_numerik+1;
						$data_numerik=count($total_numerik);
						array_push($simpan_numerik, $data_numerik);
					}	
				}	
				$fitur3= array_sum($simpan_numerik)/$tot_kata;							
				array_push($fiturtiga, $fitur3);								
			}
		}
		return $fiturtiga;
	}

	function fitur_4($extract_fitur){
		$data_paragraf=$extract_fitur['data_paragraf'];
		$data_total_kalimat=$extract_fitur['data_total_kalimat'];
		$data_kalimat=$extract_fitur['data_kalimat'];
		$fiturempat=array();
			for ($i=0; $i<count($data_paragraf) ; $i++) { 
				$temp=array();
				for ($j=0; $j<$data_total_kalimat[$i]; $j++) { 
					$start='“';
					if(strpos($data_kalimat[$i][$j], $start)!==false){
						$kata=explode(" ", $data_kalimat[$i][$j]);
						$tot_kata=count($kata);
						$end ='”';
						$pos = stripos($data_kalimat[$i][$j], $start);
						$str = substr($data_kalimat[$i][$j], $pos);
						$str_two = substr($str, strlen($start));
						$second_pos = stripos($str_two, $end);//hitung per karakter
						$str_three = substr($str_two, 0, $second_pos);//kata dalam petik dua
						$unit = trim($str_three); // remove whitespaces
						$pecah_unit=explode(" ",$unit);
						$tot_petik=count($pecah_unit);
						$fitur4= $tot_petik/$tot_kata;
						array_push($temp, $fitur4);
					}else{
						 $temp[]=0;

					}

				}
				array_push($fiturempat, $temp);
			}
		$fiturempat = call_user_func_array('array_merge', $fiturempat);
		return $fiturempat;


	}


	function fitur_5($extract_fitur){
		$fiturlima=array();
		$data_paragraf=$extract_fitur['data_paragraf'];
		$data_total_kalimat=$extract_fitur['data_total_kalimat'];
		$data_kalimat=$extract_fitur['data_kalimat'];
		for ($i=0; $i<count($data_paragraf) ; $i++) { 
			$simpan_kata=array();
			for ($j=0; $j<$data_total_kalimat[$i]; $j++) { 
				$kata=explode(" ", $data_kalimat[$i][$j]);
				$tot_kata=count($kata);
				array_push($simpan_kata, $tot_kata);
				if(($j+1)==$data_total_kalimat[$i]){
					for ($k=0; $k <$data_total_kalimat[$i] ; $k++) { 
						$fitur5=$simpan_kata[$k]/max($simpan_kata);
						array_push($fiturlima, $fitur5);
					}
				}
			}

		}
		return $fiturlima;
	}


	function fitur_6($extract_fitur){
		$fiturenam=array();
		$data_paragraf=$extract_fitur['data_paragraf'];
		$data_total_kalimat=$extract_fitur['data_total_kalimat'];
		$data_kalimat=$extract_fitur['data_kalimat'];
		$judul=$extract_fitur['data_judul'];

		for ($i=0; $i<count($data_paragraf) ; $i++) { 
			for ($j=0; $j<$data_total_kalimat[$i]; $j++) { 
				$kata=explode(" ", $data_kalimat[$i][$j]);
				$tot_kata=count($kata);
				$simpan_keyword=array(); 				
				for ($k=0; $k <count($judul) ; $k++) {
					$keyword=0;
					$cari=$judul[$k];
					$kalimat=$data_kalimat[$i][$j];
					$cek=strpos($kalimat, $cari);
					if($cek !== false){	
						$keyword+1;
						$jumlah_key=count($keyword);
						array_push($simpan_keyword, $jumlah_key);
					}else{
						//nothing gonna change
					}
				}
				$fitur6=array_sum($simpan_keyword)/$tot_kata;
				array_push($fiturenam, $fitur6);
			}				

		}

		return $fiturenam;
	}
}
