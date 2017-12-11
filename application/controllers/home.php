<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		require_once(APPPATH.'controllers/api.php');

	}
	public function index()
	{
		$this->load->view('index');		
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
			$url 				 = base_url(). 'api/hitung_knn';
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

}
