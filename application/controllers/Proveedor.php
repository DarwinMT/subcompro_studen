<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedor extends CI_Controller {

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
	public function save_proveedor()
	{
		$this->load->model('Proveedor_model');
		$data =  json_decode(file_get_contents("php://input"));
		$id_persona=$this->Proveedor_model->savePersona($data->Persona);
	
		$data->Proveedor->id_per=$id_persona;	
		$aux_idproveedor= $this->Proveedor_model->saveProveedor($data->Proveedor);
		echo $aux_idproveedor;

	}
	public function get_proveedores()
	{
		$this->load->model('Proveedor_model');
		$filtro =  json_decode(file_get_contents("php://input"));
		echo json_encode($this->Proveedor_model->getlistproveedor($filtro));
	}

	public function edit_estado()
	{
		$this->load->model('Proveedor_model');
		$data =  json_decode(file_get_contents("php://input"));
		echo $this->Proveedor_model->estadoProveedor($data);
	}
}
