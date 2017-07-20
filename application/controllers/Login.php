<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		$this->load->view('home/home');
	}
	public function start_login()
	{
		$this->load->model('Usuario_model');
		$usuario=$this->input->post("txt_user",TRUE);
		$password=$this->input->post("txt_password",TRUE);
		$aux_data_user=$this->Usuario_model->getUser($usuario);
		
		if(count($aux_data_user)){
			if($aux_data_user[0]["password_usu"]==md5($password) ){
				$_SESSION['user_name']=$aux_data_user[0]["nombre_per"]." ".$aux_data_user[0]["apellido_per"];
				$_SESSION['user']=$aux_data_user;
				redirect(base_url()."/Main");
			}else{
				$aux["Error"]="Contraseña Incorrecta";
				$this->load->view('home/home',$aux);
			}
		}else{
			$aux["Error"]="Usuario Incorrecto";
			$this->load->view('home/home',$aux);
		}
		
	}
	public function end_session()
	{
		session_destroy();
		redirect(base_url());
	}

}
