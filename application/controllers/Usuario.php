<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

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
	public function save_usuario() //pendiente xD
	{
		$this->load->model('Usuario_model');
		$data =  json_decode(file_get_contents("php://input"));
		$id_persona=$this->Usuario_model->savePersona($data->Persona);
	
		$data->Usuario->id_per=$id_persona;	
		///encritptar clave con MD5 /* POSDATA ESTE METODO ES ANTIGUO XD YA NO SE USA XD*/
		$data->Usuario->password_usu=MD5($data->Usuario->password_usu);

		$aux_idusuario= $this->Usuario_model->saveUsuario($data->Usuario);
		echo $aux_idusuario;

	}
	public function get_usuario()
	{
		$this->load->model('Usuario_model');
		$filtro =  json_decode(file_get_contents("php://input"));
		$aux_data=$this->Usuario_model->getlistusuario($filtro);
		echo json_encode($this->Usuario_model->getlistusuario($filtro));
	}

	public function edit_estado()
	{
		$this->load->model('Proveedor_model');
		$data =  json_decode(file_get_contents("php://input"));
		echo $this->Proveedor_model->estadoProveedor($data);
	}

	public function edit_usuario()
	{
		$this->load->model('Usuario_model');
		$data =  json_decode(file_get_contents("php://input"));
		echo $this->Usuario_model->updataPersona($data->Persona);
		//$data->Usuario->password_usu=MD5($data->Usuario->password_usu);
		//echo $this->Usuario_model->updateUsuario($data->Usuario);
	}

	public function list_menu()
	{
		$this->load->model('Usuario_model');
		echo json_encode($this->Usuario_model->getlistMenu());
	}

	public function save_permisos()
	{
		$this->load->model('Usuario_model');
		$data =  json_decode(file_get_contents("php://input"));
		$data->permiso_modulo=json_encode($data->permiso_modulo);

		echo $this->Usuario_model->savePermisos($data);
	}

	public function edit_permisos()
	{
		$this->load->model('Usuario_model');
		$data =  json_decode(file_get_contents("php://input"));
		$data->permiso_modulo=json_encode($data->permiso_modulo);

		echo $this->Usuario_model->editPermisos($data);
	}
}
