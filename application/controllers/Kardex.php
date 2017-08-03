<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kardex extends CI_Controller {

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
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
	}

	public function index()
	{
		# code...
	}
	public function list_permisos()
	{
		if(isset($_SESSION['user'])){
			$aux_data_user=$_SESSION['user'];
			echo $aux_data_user[0]["permiso_modulo"];
		}else{
			session_destroy();
			redirect(base_url());
		}
	}
	public function save_kardex()
	{
		$this->load->model('Kardex_model');
		$data =  json_decode(file_get_contents("php://input"));
		$id=$this->Kardex_model->buscarproductobodega($data->dataproductobodega);
		if($id==0){ // nuevo producto en bodega
			$id_pd=$this->Kardex_model->saveproductobodega($data->dataproductobodega);
			$data->datakardex->id_pd=$id_pd;
			$id_kardex=$this->Kardex_model->savekardex($data->datakardex);
			echo $id_kardex;
		}else{ // producto existente
			$data->datakardex->id_pd=$id;
			$id_kardex=$this->Kardex_model->savekardex($data->datakardex);
			echo $id_kardex;
		}
	}
	public function kardex_producto()
	{
		$this->load->model('Kardex_model');
		$filtro =  json_decode(file_get_contents("php://input"));
		echo json_encode($this->Kardex_model->kardexproducto($filtro));
	}

	public function edit_estado()
	{
		$this->load->model('Kardex_model');
		$data =  json_decode(file_get_contents("php://input"));
		echo $this->Kardex_model->estadoBodega($data);
	}

	public function edit_bodega()
	{
		$this->load->model('Kardex_model');
		$data =  json_decode(file_get_contents("php://input"));
		echo $this->Kardex_model->updataBodega($data);
	}
}
