<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function Assistence(){
		//Armar las columnas necesarias para el informe
		$data = array();
		$query = $this->db->query('
			select 
				DATE_FORMAT(m1, \'%m-%Y\') as columna
			from
			(
				select 
			((select min(date_added) from asistencias) - INTERVAL DAYOFMONTH((select min(date_added) from asistencias))-1 DAY) 
			+INTERVAL m MONTH as m1
			from
			(
			select @rownum:=@rownum+1 as m from
			(select 1 union select 2 union select 3 union select 4) t1,
			(select 1 union select 2 union select 3 union select 4) t2,
			(select 1 union select 2 union select 3 union select 4) t3,
			(select 1 union select 2 union select 3 union select 4) t4,
			(select @rownum:=-1) t0
			) d1
			) d2 
			where m1<=(select max(date_added) from asistencias)
			order by m1');

		if ($query->num_rows()!=0)
		{
			$data['dates'] = $query->result_array();
		}
		else
		{
			$data['dates'] = array();
		}
		//--------------------------------------------
		//Buscar las Asistencias 
		$query = $this->db->query('
			select a.id, a.adherent_nro, ad.firstname, ad.lastname, a.monto, DATE_FORMAT(a.date_added,\'%m-%Y\') columna from asistencias as  a
			join adherents as ad on ad.id = a.adherent_nro order by columna');
		if ($query->num_rows()!=0)
		{
			$data['moves'] = $query->result_array();
		}
		else
		{
			$data['moves'] = array();
		}
		//--------------------------------------------

		return $data;
	}
}