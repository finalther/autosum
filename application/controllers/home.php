<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

	}
	public function index()
	{
		$this->load->view('header');		
		$this->load->view('index');		
		$this->load->view('footer');		
	}

	function ringkas(){
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			$teks 				 = $this->input->post('teks');		
			$pilih_fitur		 = $this->input->post('pilih_fitur');

			$data 				 = array(
						'teks'			=> $teks,
						'pilih_fitur'	=> $pilih_fitur
						);

			$str 				 = http_build_query($data);
			$ch 				 = curl_init();
			$url 				 = base_url(). 'Api/hitung_knn';
			curl_setopt($ch, CURLOPT_URL, $url);	
			curl_setopt($ch, CURLOPT_POST,1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $str);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$output = curl_exec($ch);
			$output = json_decode($output, true);
			$output = $output['result']; 
			curl_close($ch);
			echo $output;
		}else{
			echo "gagal";
		}
	}

	function aboutApp(){
		$this->load->view('header');		
		$this->load->view('about_app');		
		$this->load->view('footer');			
	}

	function aboutMe(){
		$this->load->view('header');		
		$this->load->view('about_me');		
		$this->load->view('footer');			
	}

	function test_post(){
			//Url api yang akan menerima request 
			$url = "http://www.carimakna.com/Api/hitung_knn";
			$teks = file_get_contents("./assets/test_error.txt");
			$pilih_fitur = array('0', '1', '4');
			// Data yang akan dikirim
			$data 		 = array(
						'teks'			=> $teks,
						'pilih_fitur'	=> $pilih_fitur
						);
			// Http build query membuat form yang dikirim menjadi application/x-www-form-urlencoded
			$data = http_build_query($data);
			// inisialisasi curl
			$ch = curl_init();
			// Definisikan proxy karena memakai proxy
			$proxy = '192.168.160.239:800';	
			curl_setopt($ch, CURLOPT_PROXY, $proxy);
			//Masukkan konfigurasi url 
			curl_setopt($ch, CURLOPT_URL, $url);
			// Hasil transfer, 1 true
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			// Request method post, true
			curl_setopt($ch, CURLOPT_POST, 1);
			// Melakukan send data POST
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			// Mengetahui info curl
			$info  	= curl_getinfo($ch);			
			//Hasil kembalian dari request 
			$output = curl_exec($ch);

			if($output === FALSE ){
				// Mengetahui error nya apa
				echo "curl error : " . curl_error($curl);
				echo "INFO: ";
				echo $info;
			}
			//Curl close
			curl_close($ch);
			// Decode Hasil json, kalo ada param true maka result_Array(), kl tidak result()
			$output = json_decode($output, true);

			$output = $output['result'];
			print_r($output);
	}

	function test_get(){
		// Get cURL resource
		$url = "https://newsapi.org/v2/top-headlines?sources=bbc-news&apiKey=c45c412021ed4711b4a11396a29da34f";
		$curl = curl_init();
		$proxy = '192.168.160.239:800';	
		curl_setopt($curl, CURLOPT_URL ,$url);
		curl_setopt($curl, CURLOPT_PROXY, $proxy);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER ,1);
		curl_setopt($curl, CURLOPT_HEADER ,0);
		$output = curl_exec($curl);

		if($output === FALSE ){
			echo "curl error : " . curl_error($curl);
		}
		curl_close($curl);	
		$content = json_decode($output, true);
		// $content = $content['articles'][0]['source']['id'];
		$total    = $content['totalResults'];
		$articles = $content['articles'];

		$data['content'] = $articles;

		$this->load->view('header');
		$this->load->view('v_Api', $data);
		$this->load->view('footer');

	}
}
