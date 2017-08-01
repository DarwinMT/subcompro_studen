<?php
/**
* 
*/
class Producto_model extends CI_Model
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


	public function saveProducto($data)
	{
		$query=$this->db->insert('producto', $data);
		return $this->db->insert_id();
	}
	public function getlistproductos($filtro)
	{
		$sql=" SELECT  ";
		$sql.=" * ";
		$sql.=" FROM producto "; 
		$sql.=" WHERE producto.estado_prod='".$filtro->estado."' ";
		if($filtro->buscar!=""){
			$sql.="  AND ( producto.nombre_prod LIKE '%".$filtro->buscar."%' ";
			$sql.=" OR  producto.precio_prod LIKE '%".$filtro->buscar."%'";
			$sql.=" OR  producto.codigo_prod LIKE '%".$filtro->buscar."%'";
			$sql.=")";
		}
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function estadoProducto($data)
	{
		$update = array(
            'estado_prod' => $data->estado_prod,
            );
        $this->db->where('id_prod',$data->id_prod);
        return $this->db->update('producto', $update);
	}

	public function updataPersona($data)
	{
        $this->db->where('id_per',$data->id_per);
        return $this->db->update('persona', $data);
	}

	public function updataProducto($data)
	{
        $this->db->where('id_prod',$data->id_prod);
        return $this->db->update('producto', $data);
	}
}