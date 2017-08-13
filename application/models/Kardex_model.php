<?php
/**
* 
*/
class Kardex_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function buscarproductobodega($data)
	{
		$sql=" SELECT * FROM producto_bodega WHERE  id_prod='".$data->id_prod."' AND id_bod='".$data->id_bod."';";
		$query=$this->db->query($sql);
		$data=$query->result_array();
		if (count($data)>0) {
			return $data[0]["id_pd"];
		}else{
			return 0;
		}
	}


	public function saveproductobodega($data)
	{
		$query=$this->db->insert('producto_bodega', $data);
		return $this->db->insert_id();
	}

	public function savekardex($data)
	{
		$query=$this->db->insert('kardex', $data);
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
	public function reporteKardexProducto($filtro)
	{	
		$aux_bodega="";
		if($filtro->id_bod!=null && $filtro->id_bod!=""){
			$aux_bodega=" AND  producto_bodega.id_bod='".$filtro->id_bod."' ";
		}
		$sql=" SELECT  ";
		$sql.=" * ";
		$sql.=" FROM producto_bodega "; 
		$sql.=" INNER JOIN producto ON producto.id_prod=producto_bodega.id_prod ";
		$sql.=" INNER JOIN kardex ON kardex.id_pd=producto_bodega.id_pd ";
		$sql.=" INNER JOIN bodega ON bodega.id_bod=producto_bodega.id_bod ";

		$sql.=" WHERE producto.id_prod='".$filtro->id_prod."' ";
		$sql.=" AND kardex.fecha_kar<='".$filtro->fecha."' ";
		$sql.=$aux_bodega;
		$sql.=" ORDER BY kardex.fecha_kar ASC ";
		$query=$this->db->query($sql);
		return $query->result_array();

	}

	public function kardexproducto($filtro)
	{
		$sql=" SELECT  ";
		$sql.=" * ";
		$sql.=" FROM producto_bodega "; 
		$sql.=" INNER JOIN producto ON producto.id_prod=producto_bodega.id_prod ";
		$sql.=" INNER JOIN kardex ON kardex.id_pd=producto_bodega.id_pd ";
		$sql.=" INNER JOIN bodega ON bodega.id_bod=producto_bodega.id_bod ";

		$sql.=" WHERE producto.id_prod='".$filtro->buscar."' ";
		$sql.=" AND kardex.fecha_kar<='".$filtro->fecha."' ";
		$sql.=" ORDER BY kardex.fecha_kar ASC ";
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