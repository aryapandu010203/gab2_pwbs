<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/server.php";

class Mahasiswa extends Server
{
	//Buat fungsi "GET"
	function service_get()
	{
		//Panggil model mahasiswa
		$this->load->model("Mmahasiswa", "mdl", TRUE);
		//Panggil fungsi "get_data"
		$hasil = $this->mdl->get_data();
		$this->response($hasil, 200);
	}

	//Buat fungsi "POS"
	function service_post()
	{
		// panggil model mahasiswa
		$this->load->model("Mmahasiswa", "mdl", TRUE);
		// ambil parameter data yang akan diisi
		$data = array(
			"npm"=> $this->post("npm"),
			"nama"=>$this->post("nama"),
			"telepon"=>$this->post("telepon"),
			"jurusan"=>$this->post("jurusan"),
			"token" => base64_encode($this->post("npm")),
		);
		// panggil methode save_data
		$hasil = $this->mdl->save_data($data ["npm"],$data ["nama"],$data ["telepon"],$data ["jurusan"],$data["token"]);
		// jika hasil = 0
		if($hasil == 0)
		{
			$this->response(array("status" => "Data Berhasil Disimpan"),200);
		}
		// jika hasil !=0
		else
		{
			$this->response(array("status" => "Data gagal disimpan"),200);
		}
	}

	//Buat fungsi "PUT"
	function service_put()
	{

	}

	//Buat fungsi "DELETE"
	function service_delete()
	{
		// panggil mdoel mahasiswa

		$this->load->model("Mmahasiswa","mdl",TRUE);
		// panggil fungsi delete data
		$token = $this->delete("npm");
		// ambil parameter token "(npm)"
		$hasil = $this->mdl->delete_data(base64_encode($token));
		// jika proses delete berhasil
		if($hasil == 1)
		{
			$this->response(array("status" =>"Data mahasiswa berhasil dihapus" ),200);
		}
		// jika proses delete gagal 
		else
		{
			$this->response(array(" " => "Data mahasiswa Gagal Di hapus"),200);
		}
	}
}
