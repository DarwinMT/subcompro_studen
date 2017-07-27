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
		$s_get_user.=" INNER JOIN rol ON usuario.id_usu=rol.id_usu ";
		$s_get_user.=" WHERE ";
		$s_get_user.=" usuario.usuario_usu='".$user."' ;";
		$query=$this->db->query($s_get_user);
		return $query->result_array();
	}
}