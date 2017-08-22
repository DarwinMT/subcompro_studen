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

	public function savemarcaproductop($data)
	{
		$query=$this->db->insert('marca_producto_proveedor', $data);
		return $this->db->insert_id();
	}

	public function getlistproductos($filtro)
	{
		$sql=" SELECT  ";
		$sql.=" *, ";
		$sql.=" (SELECT  mpp.id_mar FROM marca_producto_proveedor mpp WHERE mpp.id_prod=producto.id_prod) AS id_mar, ";
		$sql.=" (SELECT  mpp.id_pro FROM marca_producto_proveedor mpp WHERE mpp.id_prod=producto.id_prod) AS id_pro, ";
		$sql.=" (SELECT m.descripcion_mar FROM marca m WHERE m.id_mar= (SELECT  mpp.id_mar FROM marca_producto_proveedor mpp WHERE mpp.id_prod=producto.id_prod) ) as desri_marca ";
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
		$sql=" SELECT  ";
		$sql.=" (SUM(kardex.cant_entrada_kar)-SUM(cant_salida_kar)) AS Cantidad ";
		$sql.=" FROM ";
		$sql.=" producto_bodega  ";
		$sql.=" INNER JOIN kardex ON producto_bodega.id_pd=kardex.id_pd ";
		$sql.=" WHERE producto_bodega.id_prod=".$data->id_prod." ";
		$sql.=" ORDER BY kardex.fecha_kar ";
		$query=$this->db->query($sql);
		$aux= $query->result_array();
		if( (int) $aux[0]["Cantidad"]>0){
			$update = array(
	            'estado_prod' => $data->estado_prod,
	            );
	        $this->db->where('id_prod',$data->id_prod);
	        return $this->db->update('producto', $update);
		}else{
			return "El producto tien kardex";
		}

		
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

	public function updatamarcapp($data)
	{
        $this->db->where('id_prod',$data->id_prod);
        return $this->db->update('marca_producto_proveedor', $data);
	}
	
	public function getStockNotificacionProducto($filtro)
	{
		$sql=" SELECT  ";
		$sql.=" *, ";
		$sql.=" IFNULL( ";
		$sql.=" (SELECT SUM(aux_k.cant_entrada_kar)-SUM(aux_k.cant_salida_kar)  ";
		$sql.=" FROM producto_bodega aux_p, kardex aux_k  ";
		$sql.=" WHERE aux_k.id_pd=aux_p.id_pd AND aux_p.id_prod=aux_prod.id_prod AND aux_k.fecha_kar<='".$filtro->Hoy."'),0) AS Cantidad ";
		$sql.=" FROM producto aux_prod WHERE aux_prod.estado_prod='1' ";
		$sql.=" ORDER BY aux_prod.nombre_prod; ";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
}