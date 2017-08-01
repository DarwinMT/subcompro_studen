<?php
/**
* 
*/
class Empleado_model extends CI_Model
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


	public function saveEmpleado($data)
	{
		$query=$this->db->insert('empleado', $data);
		return $this->db->insert_id();
	}
	public function getlistempleado($filtro)
	{
		$sql=" SELECT  ";
		$sql.=" * ";
		$sql.=" FROM empleado "; 
		$sql.=" INNER JOIN persona ON persona.id_per=empleado.id_per ";
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

	public function updataPersona($data)
	{
        $this->db->where('id_per',$data->id_per);
        return $this->db->update('persona', $data);
	}

	public function updataEmpleado($data)
	{
        $this->db->where('id_empl',$data->id_empl);
        return $this->db->update('empleado', $data);
	}
}