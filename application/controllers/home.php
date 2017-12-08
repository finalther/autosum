<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_index extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('v_header');
		$this->load->view('index');
	}
	function list_dataset(){
		$this->load->view('v_header');
		$this->load->view('v_list_dataset');

	}

	function artikel_ori(){
		$data['artikel']=$this->db->get('artikel_ori')->result();
        $this->load->view('v_header');
		$this->load->view('v_artikel_ori',$data);
	}

	function get_artikel($id){
		$this->db->where('id',$id);
		$data=$this->db->get('artikel_ori')->row();
		$judul=$data->judul;
		$get=file_get_contents('./assets/dataset/'.$data->file);
		echo json_encode( array("judul"=>$judul, "file"=>$get) );

	}

	function hasil_preprocessing(){
		$data['artikel']=$this->db->get('artikel_ori')->result();
		$this->load->view('v_header');
		$this->load->view('v_hasil_preprocessing',$data);
	}

	function hitung_preprocessing($id=null){
		//$data_return=array();
		$this->db->where('id',$id);
		$data_artikel=$this->db->get('artikel_ori')->row();
		$get_files=file_get_contents("./assets/dataset/".$data_artikel->file);
		$judul =$data_artikel->judul;

		$hasil_segementasi=$this->segmentasi($get_files);
		// print_r($hasil_segementasi);
		$caseFolding=$this->caseFolding($hasil_segementasi);
		// print_r($caseFolding );
		$stopword=$this->stopword($caseFolding);
		// print_r($stopword);
		$stemming =$this ->stemming($stopword);
		// print_r($stemming);
		/* hasil preprocessing */
		$hasil_preprocessing=$this->gabung_kalimat($stemming);
		// print_r($hasil_preprocessing);		

		echo '<table class="table table-striped 
	      		table-bordered" style="width:100%;font-size:12px" >
					<thead style="background-color:#337ab7; color:#fff">
			<tr>
				<td style="width:100px;">kalimat ke -i</td>
				<td>Hasil preprocessing</td>
			</tr>
			</thead>';
		$i=1;
		foreach ($hasil_preprocessing as $key => $value) {
			foreach ($value as $key2 => $value2) {
				// $this->db->query("INSERT INTO tb_sementara (id,doc_id,isi) VALUES ('','','$value2')");
				// echo "sukses";
		echo'<tbody>
				<tr>
					<td style="width:80px;">doc '.$i++.'</td>
					<td>'.$value2.'</td>
				</tr>
			</tbody>';
			}
		}
		echo '</table>';
	}

	function hasil_ekstraksi(){
		$data['artikel']=$this->db->get('artikel_ori')->result();
		$this->load->view('v_header');
		$this->load->view('v_hasil_ekstraksi',$data);
	}

	function hitung_ekstraksi($id=null){
		$this->db->where('id',$id);
		$data_artikel=$this->db->get('artikel_ori')->row();
		$get_files=file_get_contents("./assets/dataset/".$data_artikel->file);
		$judul =$data_artikel->judul;
		$hasil_segementasi=$this->segmentasi($get_files);
		$caseFolding=$this->caseFolding($hasil_segementasi);
		$stopword=$this->stopword($caseFolding);
		$stemming =$this ->stemming($stopword);
		/* hasil preprocessing */
		$hasil_preprocessing=$this->gabung_kalimat($stemming);
		$extract_fitur=$this->extract_fitur($hasil_preprocessing,$judul);
		// echo"============== FITUR 1 POSISI KALIMAT DALAM PARAGRAF =============="."\n";
		$fitursatu=$this->fitur_1($extract_fitur);
		// print_r($fitursatu);
		// echo "\n";
		// echo"============== FITUR 2 POSISI KALIMAT DALAM DOKUMEN ==============="."\n";
		$fiturdua=$this->fitur_2($extract_fitur);
		// print_r($fiturdua);
		// echo "\n";
		// echo"============== FITUR 3 DATA NUMERIK ==============================="."\n";
		$fiturtiga=$this->fitur_3($extract_fitur);
		// print_r($fiturtiga);
		// echo "\n";
		// echo"============== FITUR 4 TANDA KOMA TERBALIK ========================"."\n";
		$fiturempat=$this->fitur_4($extract_fitur);
		// print_r($fiturempat);
		// echo "\n";
		// echo"============== FITUR 5 PANJANG KALIMAT DALAM PARAGRAF =============="."\n";
		$fiturlima=$this->fitur_5($extract_fitur);
		// print_r($fiturlima);
		// echo "\n";
		// echo"============== FITUR 6 KATA KUNCI =================================="."\n";
		$fiturenam=$this->fitur_6($extract_fitur);
		// print_r($fiturenam);
		echo '<table class="table table-striped 
	      		table-bordered" style="width:100%; font-size:12px">
			<thead style="background-color:#337ab7; color:#fff">
			<tr>
				<td> Kalimat ke -i</td>
				<td> Fitur 1 </td>
				<td> Fitur 2 </td>
				<td> Fitur 3 </td>
				<td> Fitur 4 </td>
				<td> Fitur 5 </td>
				<td> Fitur 6 </td>
			</tr>
			</thead> 
			';
		$nomor=1;
		for ($i=0; $i <count($fitursatu) ; $i++) { 
		echo'
			<tbody>
			<tr>
				<td> kalimat ke -'.$nomor++.'</td>
				<td> '.number_format($fitursatu[$i], 2).'</td>
				<td> '.number_format($fiturdua[$i], 2).'</td>
				<td> '.number_format($fiturtiga[$i], 2).'</td>
				<td> '.number_format($fiturempat[$i], 2).'</td>
				<td> '.number_format($fiturlima[$i], 2).'</td>
				<td> '.number_format($fiturenam[$i], 2).'</td>
			</tr>
			</tbody>
			';
			}			
		echo '	</table>';

	}

	function hitung_knn(){
		$teks=$_POST['teks'];		
		$pilih_fitur=$_POST['pilih_fitur'];
		$get_files= $teks;
		$hasil_segementasi=$this->segmentasi($get_files);
		// print_r($hasil_segementasi);
		$caseFolding=$this->caseFolding($hasil_segementasi);
		// print_r($caseFolding);
		$stopword=$this->stopword($caseFolding);
		$stemming =$this ->stemming($stopword);
		/* hasil preprocessing */
		$hasil_preprocessing=$this->gabung_kalimat($stemming);
		// print_r($hasil_preprocessing);		
		/*Count keyword*/
		$countkey=call_user_func_array('array_merge', $stemming);
		$countkey=call_user_func_array('array_merge', $countkey);
		//print_r($countkey);
		$countkey=array_count_values($countkey);
		arsort($countkey);
		$countkey=array_slice($countkey, 0,3);
		$countkey_baru=array();
		foreach ($countkey as $key => $value) {
			array_push($countkey_baru, $key);
		}

		$extract_fitur=$this->extract_fitur($hasil_preprocessing,$countkey_baru);
		$fitur1_uji=$this->fitur_1($extract_fitur);
		$fitur2_uji=$this->fitur_2($extract_fitur);
		$fitur3_uji=$this->fitur_3($extract_fitur);
		$fitur4_uji=$this->fitur_4($extract_fitur);
		$fitur5_uji=$this->fitur_5($extract_fitur);
		$fitur6_uji=$this->fitur_6($extract_fitur);

		$fitur1_latih=array();
		$fitur2_latih=array();
		$fitur3_latih=array();
		$fitur4_latih=array();
		$fitur5_latih=array();
		$fitur6_latih=array();

		$k=3;
	
		$data_latih=$this->db->query("SELECT * FROM tb_hasil_ekstraksi")->result_array();
		foreach ($data_latih as $key => $value) {
			$f1_latih=$value['fitur_1'];
			$f2_latih=$value['fitur_2'];
			$f3_latih=$value['fitur_3'];
			$f4_latih=$value['fitur_4'];
			$f5_latih=$value['fitur_5'];
			$f6_latih=$value['fitur_6'];

			array_push($fitur1_latih, $f1_latih);
			array_push($fitur2_latih, $f2_latih);
			array_push($fitur3_latih, $f3_latih);
			array_push($fitur4_latih, $f4_latih);
			array_push($fitur5_latih, $f5_latih);
			array_push($fitur6_latih, $f6_latih);
		}

		$hasil_jarak=array();
		for ($i=0; $i <count($fitur1_uji) ; $i++) {
			$temp=array();
			for ($j=0; $j <count($fitur1_latih) ; $j++) { 

				$arr= array(
					(pow($fitur1_uji[$i]-$fitur1_latih[$j],2)),
					(pow($fitur2_uji[$i]-$fitur2_latih[$j],2)),
					(pow($fitur3_uji[$i]-$fitur3_latih[$j],2)),
					(pow($fitur4_uji[$i]-$fitur4_latih[$j],2)),
					(pow($fitur5_uji[$i]-$fitur5_latih[$j],2)),
					(pow($fitur6_uji[$i]-$fitur6_latih[$j],2))

				);
				$x=0;
				foreach ($_POST['pilih_fitur'] as $key => $value) {
					$x=$x+$arr[$value];
				}
				$euclid=sqrt($x);
				array_push($temp, $euclid);			
			}
			array_push($hasil_jarak, $temp);
		}

		$hasil_jarak=array_map(function($v){
			asort($v);
			return array_slice($v, 0, 3, true);
		}, $hasil_jarak); 

		$simpan_key=array();
		foreach ($hasil_jarak as $key => $value) {
			$total_key=count($value); //total key sejumlah k
			$temp=array();

			foreach ($value as $key2=>$value2) {
				array_push($temp, $key2+1); //untuk mengakses posisi dalam tabel dimulai id 1
			}				

			array_push($simpan_key, $temp);
		}

		$hasil_kelas=array();
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

		$kalimat_ringkasan=array();
		foreach ($hasil_kelas as $key => $value) { 
				$mayoritas = array_count_values($value);
				if(isset($mayoritas['ringkasan']) && $mayoritas['ringkasan']>1){
	       	     array_push($kalimat_ringkasan,$key); //masukkan key sbagai value ringkasan
		
		        }

		}

		$pecah_arr = call_user_func_array('array_merge', $hasil_segementasi);


	$hasil_ringkasan=array();
	$bkn_ringkasan=array();
    foreach ($pecah_arr as $key2 => $value2) {
        if(in_array($key2,$kalimat_ringkasan)){
            $no_doc=$key2+1;
            array_push($hasil_ringkasan, $value2);
            // //INSERT KE DB untuk Learning
            // $q=$this->db->query("INSERT INTO tb_sementara 
            // VALUES('','$no_doc','$fitur1_uji[$key2]','$fitur2_uji[$key2]',
            //     '$fitur3_uji[$key2]','$fitur4_uji[$key2]','$fitur5_uji[$key2]','$fitur6_uji[$key2]','ringkasan')");

            // }else{
            // array_push($bkn_ringkasan, $value2);
            // $bkn_doc=$key2+1;
            // $q=$this->db->query("INSERT INTO tb_sementara 
            // VALUES('','$bkn_doc','$fitur1_uji[$key2]','$fitur2_uji[$key2]',
            //     '$fitur3_uji[$key2]','$fitur4_uji[$key2]','$fitur5_uji[$key2]',
            //     '$fitur6_uji[$key2]','bukan')");
        }

}

		$hasil_ringkasan=array_slice($hasil_ringkasan, 0, count($pecah_arr)/2);		
		for ($z=0; $z <count($hasil_ringkasan) ; $z++) { 
			$o=$z+1;
			echo $hasil_ringkasan[$z]."."."\n";
		}

	}

 

	function segmentasi($string)
	{

			$data=array();
			$string=trim($string);
			$pecahparagraf = preg_replace("/[\r\n]+/", "\n", $string);
			$pecahparagraf=explode("\n",$pecahparagraf);
			foreach ($pecahparagraf as $key => $value) {
				# looks for strings in double quotes
				# throws them away
				# matches a dot literally, followed by whitespaces eventually
				$regex 		 = '/“[^“”]+”(*SKIP)(*FAIL)|\.\s]*/';
				
				$pecah_titik=substr($value, 0, -1);
				$pecah_titik = preg_split($regex, $pecah_titik);
				$pecah_titik=preg_replace("/ {2,}/", " ", $pecah_titik);
				//$pecah_titik=preg_replace("/[.]/", " ", $pecah_titik);//output tidak ada titik
				$pecah_titik=array_filter($pecah_titik); //empty element throw
				$pecah_titik=array_values($pecah_titik); //reset index
				array_push($data, $pecah_titik);		    
				
			}
			return $data;
	}

	function caseFolding($string)
	{
		$data_return=array();
		foreach ($string as $key => $value) {
			$data2=array();
			foreach ($value as $key => $value2) {
				$data=strtolower($value2);
				$data=preg_replace('/[^a-z^0-9^“”]/',' ',$data);
				$data=preg_replace("/ {2,}/", " ", $data);
				$data = trim($data);
				array_push($data2,$data);
			}
			array_push($data_return,$data2);
		}
		return $data_return;
	}

	function stopword($string)
	{

		$data=array();
		foreach ($string as $key => $value) {
			$data2= array();
			foreach ($value as $key2 => $value2) {
			$data3=array();
			$pecah_kata=array_unique(explode(" ",$value2));
				foreach ($pecah_kata as $key3 => $value3) {
				$this->db->where('kata',$value3);
				$cek=$this->db->get('stopword')->result();
					if (empty($cek)) {
						array_push($data3,$value3);
					}
		
				}
				array_push($data2, $data3);
			}
			array_push($data, $data2);			
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
					$output   = $stemmer->stem($value3);	
					array_push($data3, $output);
				}
			array_push($data2, $data3);
			}
		array_push($data, $data2);
		}
		return $data;
	}

	function gabung_kalimat($string){
		$data=array();
		foreach ($string as $key => $value) {
			$data2=array();
			foreach ($value as $key2 => $value2) {
				$gabung= implode(" ", $value2);
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
				// echo "Nilai Fitur 1 kalimat index [".$i."][".$j."] = ".$fitur1."\n";
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
				// echo "Nilai Fitur 2 kalimat ke [".$ke."] = ".$fitur2;
				// echo "\n";
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
				// echo "kalimat index ke [".$i."][".$j."]= ".$fitur3;
				// echo "\n";
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
						// echo "kalimat index ke [".$i."][".$j."]= ".$fitur4;
						// echo"\n";
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
						// echo "kalimat index ke [".$i."][".$k."]= ".$fitur5;
						// echo "\n";
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

//		$data_judul=array();
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
				// echo "kalimat index ke [".$i."][".$j."]= ".$fitur6;
				// echo "\n";
				array_push($fiturenam, $fitur6);
			}				

		}

		return $fiturenam;
	}

	
	function ringkas(){
		$data['artikel_uji']=$this->db->get('tb_artikel_uji')->result();
		$this->load->view('v_data_uji',$data);		
	}

	function get_data_uji($id){
		$this->db->where('id',$id);
		$data=$this->db->get('tb_artikel_uji')->row();
		$judul=$data->judul;
		$get=file_get_contents('./assets/data_uji/'.$data->file);
		echo json_encode( array("judul"=>$judul, "file"=>$get) );
	}


}
