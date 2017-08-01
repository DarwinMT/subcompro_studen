<?php
/**
* 
*/
class Marca_model extends CI_Model
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


	public function saveMarca($data)
	{
		$query=$this->db->insert('marca', $data);
		return $this->db->insert_id();
	}
	public function getlistmarcas($filtro)
	{
		$sql=" SELECT  ";
		$sql.=" * ";
		$sql.=" FROM marca "; 
		$sql.=" WHERE marca.estado_mar='".$filtro->estado."' ";
		if($filtro->buscar!=""){
			$sql.="  AND ( marca.descripcion_mar LIKE '%".$filtro->buscar."%' ";
			$sql.=")";
		}
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function estadoMarca($data)
	{
		$update = array(
            'estado_mar' => $data->estado_mar,
            );
        $this->db->where('id_mar',$data->id_mar);
        return $this->db->update('marca', $update);
	}

	public function updataPersona($data)
	{
        $this->db->where('id_per',$data->id_per);
        return $this->db->update('persona', $data);
	}

	public function updataMarca($data)
	{
        $this->db->where('id_mar',$data->id_mar);
        return $this->db->update('marca', $data);
	}
}