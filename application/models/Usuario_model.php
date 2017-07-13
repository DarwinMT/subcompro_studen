<?php
/**
* 
*/
class Usuario_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}



	public function getUser($user)
	{
		$s_get_user=" SELECT ";
		$s_get_user.=" * ";
		$s_get_user.=" FROM usuario ";
		$s_get_user.=" INNER JOIN persona ON usuario.id_per=persona.id_per";
		$s_get_user.=" WHERE ";
		//$s_get_user.=" usuario.usuario_usu='".$user."' AND usuario.password_usu=(SELECT MD5('".$pass."')) ;";
		$s_get_user.=" usuario.usuario_usu='".$user."' ;";
		$query=$this->db->query($s_get_user);
		return $query->result_array();
	}
	/*public function Get_datosusuario($user,$pass)
	{
		$this->db->select("*");
		$this->db->from("usuario");
		$this->db->join("persona", "persona.id_pe= usuario.id_pe");
		$this->db->where("usuario.username",$user);
		$this->db->where("usuario.password",$pass);
		$this->db->where("usuario.estado",1);
		$data=$this->db->get();
		//return $data->result();
		//return $data->result_array();
		return $data->row();
	}*/
}