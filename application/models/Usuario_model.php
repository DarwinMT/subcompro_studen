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

	public function savePersona($data)
	{
		$query=$this->db->insert('persona', $data);
		return $this->db->insert_id();
	}

	public function saveUsuario($data)
	{
		$query=$this->db->insert('usuario', $data);
		return $this->db->insert_id();
	}

	public function getlistusuario($filtro)
	{
		$sql=" SELECT  ";
		$sql.=" *,  ";
		$sql.="  IFNULL((SELECT rol.permiso_modulo FROM rol WHERE rol.id_usu=usuario.id_usu),'') AS Permisos_usuario, ";
		$sql.="  IFNULL((SELECT rol.descripcion_rol FROM rol WHERE rol.id_usu=usuario.id_usu),'') AS Name_permiso, ";
		$sql.="  IFNULL((SELECT rol.id_rol FROM rol WHERE rol.id_usu=usuario.id_usu),'') AS id_rol ";
		$sql.=" FROM usuario "; 
		$sql.=" INNER JOIN persona ON persona.id_per=usuario.id_per ";
		$sql.=" WHERE persona.estado_per='".$filtro->estado."' ";
		if($filtro->buscar!=""){
			$sql.="  AND ( persona.dni_per LIKE '%".$filtro->buscar."%' ";
			$sql.=" OR CONCAT(persona.apellido_per,' ',persona.nombre_per) LIKE '%".$filtro->buscar."%'";
			$sql.=" OR  usuario.usuario_usu LIKE '%".$filtro->buscar."%'";
			$sql.=")";
		}
		$query=$this->db->query($sql);
		return $query->result_array();
	}

	public function getlistMenu()
	{
		$sql = " SELECT * FROM menu; ";
		$query=$this->db->query($sql);
		return $query->result_array();
	}

	public function savePermisos($data)
	{
		$query=$this->db->insert('rol', $data);
		return $this->db->insert_id();
	}
	public function editPermisos($data)
	{
		$this->db->where('id_rol',$data->id_rol);
        return $this->db->update('rol', $data);
	}

	public function updataPersona($data)
	{
        $this->db->where('id_per',$data->id_per);
        return $this->db->update('persona', $data);
	}

	public function updateUsuario($data)
	{
		$this->db->where('id_usu',$data->id_usu);
        return $this->db->update('usuario', $data);
	}
}