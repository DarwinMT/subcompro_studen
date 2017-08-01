<?php
/**
* 
*/
class Bodega_model extends CI_Model
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


	public function saveBodega($data)
	{
		$query=$this->db->insert('bodega', $data);
		return $this->db->insert_id();
	}
	public function getlistbodegas($filtro)
	{
		$sql=" SELECT  ";
		$sql.=" * ";
		$sql.=" FROM bodega "; 
		$sql.=" WHERE bodega.estado_bod='".$filtro->estado."' ";
		if($filtro->buscar!=""){
			$sql.="  AND ( bodega.descripcion_bod LIKE '%".$filtro->buscar."%' ";
			$sql.=" OR  bodega.direccion_bod LIKE '%".$filtro->buscar."%'";
			$sql.=")";
		}
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function estadoBodega($data)
	{
		$update = array(
            'estado_bod' => $data->estado_bod,
            );
        $this->db->where('id_bod',$data->id_bod);
        return $this->db->update('bodega', $update);
	}

	public function updataPersona($data)
	{
        $this->db->where('id_per',$data->id_per);
        return $this->db->update('persona', $data);
	}

	public function updataBodega($data)
	{
        $this->db->where('id_bod',$data->id_bod);
        return $this->db->update('bodega', $data);
	}
}