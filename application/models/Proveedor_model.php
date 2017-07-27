<?php
/**
* 
*/
class Proveedor_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function savePersona($data)
	{
		$query=$this->db->insert('persona', $data);
		return $this->db->insert_id();
	}


	public function saveProveedor($data)
	{
		$query=$this->db->insert('proveedor', $data);
		return $this->db->insert_id();
	}
	public function getlistproveedor($filtro)
	{
		$sql=" SELECT  ";
		$sql.=" * ";
		$sql.=" FROM proveedor "; 
		$sql.=" INNER JOIN persona ON persona.id_per=proveedor.id_per ";
		$sql.=" WHERE persona.estado_per='".$filtro->estado."' ";
		if($filtro->buscar!=""){
			$sql.="  AND ( persona.dni_per LIKE '%".$filtro->buscar."%' ";
			$sql.=" OR CONCAT(persona.apellido_per,' ',persona.nombre_per) LIKE '%".$filtro->buscar."%'";
			$sql.=")";
		}
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function estadoProveedor($data)
	{
		$update = array(
            'estado_per' => $data->estado_per,
            );
        $this->db->where('id_per',$data->id_per);
        return $this->db->update('persona', $update);
	}
}