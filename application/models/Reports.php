<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}



	public function ordenes($desde, $hasta){
		$data = array();
		
		$sql="
			SELECT o.`*`,a.firstname,a.lastname,c.razon_social 
			FROM ordenes AS o 
			LEFT JOIN afiliados AS a ON o.afiliado_id=a.id 
			LEFT JOIN comercios AS c ON o.comercio_id=c.id ";

		if($desde < $hasta){
			$sql.=" WHERE o.date_added>='".$desde."' && o.date_added<='".$hasta."' ";
		}
		$query = $this->db->query($sql);

		if ($query->num_rows()!=0){
			$data['moves'] = $query->result_array();
		}else{
			$data['moves'] = array();
		}
		
		return $data;
	}

	public function comercios($desde, $hasta){

		$this->db->select('id, razon_social');
		$query= $this->db->get('comercios');
		$result=array();

		if ($query->num_rows()!=0){

			$comercios=$query->result_array();

			foreach ($comercios as $key => $value) {
				$this->db->select('COUNT(*) as total_ordenes, IFNULL(SUM(monto), 0)  as total_importe');
				$this->db->where("comercio_id",$value['id']);
				$this->db->where("date_added >=",$desde);
				$this->db->where("date_added <=",$hasta);

				$query=$this->db->get('ordenes');	
				$totales= $query->row_array();

				$temp=$value;
				$temp['total_ordenes']=$totales['total_ordenes'];
				$temp['total_importe']=$totales['total_importe'];
				
				$result[]=$temp;
			}

			$data['moves'] = $result;
		}else{
			$data['moves'] = array();
		}

		return $data;
	}

	function Assistence($desde, $hasta){
		//Armar las columnas necesarias para el informe
		$data = array();
		/*$query = $this->db->query('
			Select 
				DATE_FORMAT(date_added, \'%m-%Y\') as columna FROM asistencias 
			WHERE 
				date_added >= \''.$desde.'\' AND date_added <= \''.$hasta.'\' GROUP BY DATE_FORMAT(date_added, \'%m-%Y\') order by date_added asc' );
		
		//log_message('info', __CLASS__."_".__METHOD__."_".__LINE__."". $this->db->last_query());	
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
			join adherents as ad on ad.nro = a.adherent_nro 
			where a.date_added >= \''.$desde.'\' and a.date_added <= \''.$hasta.'\'  and (a.status!=2)
			order by a.id ASC');
		
		//echo $this->db->last_query()."<br>";
		
		if ($query->num_rows()!=0)
		{
			$data['moves'] = $query->result_array();
		}
		else
		{
			$data['moves'] = array();
		}*/
		//--------------------------------------------
		$data=array();
		return $data;
	}

	function Devolution($desde, $hasta){
		//Armar las columnas necesarias para el informe
		$data = array();
		$query = $this->db->query('
			Select 
				DATE_FORMAT(date_added, \'%m-%Y\') as columna FROM asistencias_cuotas 
			WHERE 
				date_added >= \''.$desde.'\' AND date_added <= \''.$hasta.'\' GROUP BY DATE_FORMAT(date_added, \'%m-%Y\') order by date_added asc' );
		//log_message('info', __CLASS__."_".__METHOD__."_".__LINE__."". $this->db->last_query());	
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
			select a.id, a.asistencia_id, ad.id aderente, ad.firstname, ad.lastname, a.monto monto, DATE_FORMAT(a.date_added,\'%m-%Y\') columna from asistencias_cuotas as  a
			join asistencias as asi on asi.id = a.asistencia_id
			join adherents as ad on ad.nro = asi.adherent_nro  
			where a.date_added >= \''.$desde.'\' and a.date_added <= \''.$hasta.'\'  and (asi.status!=2)
			order by asi.id ASC   ');
		echo $this->db->last_query();
		//log_message('info', __CLASS__."_".__METHOD__."_".__LINE__."". $this->db->last_query());
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

	function Compensation($desde, $hasta){
		//Armar las columnas necesarias para el informe
		$data = array();
		$query = $this->db->query('
			Select 
				DATE_FORMAT(date_added, \'%m-%Y\') as columna FROM asistencias_cuotas 
			WHERE 
				date_added >= \''.$desde.'\' AND date_added <= \''.$hasta.'\' GROUP BY DATE_FORMAT(date_added, \'%m-%Y\') order by date_added asc' );
		//echo $this->db->last_query()."<br>";
		//log_message('info', __CLASS__."_".__METHOD__."_".__LINE__."". $this->db->last_query());	
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
			select a.id, a.asistencia_id, ad.id aderente, ad.firstname, ad.lastname, a.compensacion monto, DATE_FORMAT(a.date_added,\'%m-%Y\') columna from asistencias_cuotas as  a
			join asistencias as asi on asi.id = a.asistencia_id
			join adherents as ad on ad.nro = asi.adherent_nro 
			where a.date_added >= \''.$desde.'\' and a.date_added <= \''.$hasta.'\' and (asi.status!=2)
			order by asi.id ASC  ');
		//echo $this->db->last_query()."<br>";
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

	public function Balances($filter=null){
		
		if(!isset($filter['from']) && !isset($filter['to'])){

			$year = new DateTime();			
			$from=date('Y-m-d',strtotime("-6 months"));
			$to=date('Y').'-12-31';

		}


		$start    = (new DateTime('2017-12-01'))->modify('first day of this month');
		$end      = (new DateTime())->modify('first day of next month');
		$interval = DateInterval::createFromDateString('1 month');
		$period   = new DatePeriod($start, $interval, $end);

		



		
		$result=array();
		$saldo_previo=0;
		$plazo_fijo=0;


		foreach ($period as $dt) {
			$date= $dt->format("Y-m-01 00:00:00");
			//var_dump($date);
			//$date=date('Y-m-01',strtotime("-".$i." months"));
			//Aportes
			$query=$this->db->query("select  IFNULL(sum(apc.monto),0) total FROM aporte_cuotas AS apc INNER JOIN aportes AS ap ON apc.aporte_id=ap.id INNER JOIN adherents ad ON ap.adherent_nro=ad.nro  WHERE  YEAR(apc.date_added) = YEAR('".$date."') AND   MONTH(apc.date_added) =  MONTH('".$date."') and ad.status!=2 ;");
			//echo $this->db->last_query()."<br>";
			$aportes=$query->row_array();
			$result[$date]['aportes']=$aportes['total'];

			//Asistencias
			$query=$this->db->query("select  IFNULL(sum(monto),0) total from asistencias  WHERE  YEAR(date_added) = YEAR('".$date."') AND   MONTH(date_added) =  MONTH('".$date."') and status!=2 ;");
			//echo $this->db->last_query()."<br>";
			$asistencias=$query->row_array();
			$result[$date]['asistencias']=$asistencias['total'];

			//Asistencias Cuotas Compensacion
			$query=$this->db->query("select  IFNULL(sum(compensacion),0) total from asistencias_cuotas WHERE YEAR(date_added) = YEAR('".$date."') AND   MONTH(date_added) =  MONTH('".$date."') and status!=2 ;");
			$interes=$query->row_array();
			$result[$date]['interes']=$interes['total'];

			//Asistencias Cuotas Monto
			$query=$this->db->query("select IFNULL(sum(monto),0) total from asistencias_cuotas WHERE   YEAR(date_added) = YEAR('".$date."') AND   MONTH(date_added) =  MONTH('".$date."') and status!=2 ;");
			
			$devolucion=$query->row_array();
			
			$result[$date]['devolucion']=$devolucion['total'];

			$query=$this->db->query("select ( import) AS total  from earnings WHERE   YEAR(date_imputation) = YEAR('".$date."') AND   MONTH(date_imputation) =  MONTH('".$date."') and status!=2 ;");
			$plazo_fijo=$query->row_array();
			$result[$date]['inversion']=$plazo_fijo['total'];

			$result[$date]['saldo']= floatval($interes['total'])+floatval($plazo_fijo['total'])-floatval($asistencias['total'])+floatval($devolucion['total'])+floatval($aportes['total'])+floatval($saldo_previo);
			$saldo_previo=$result[$date]['saldo'];

		}	
		//die();
		/*
		//Asistencias
		$query=$this->db->query("select  IFNULL(sum(monto),0) total from asistencias  WHERE  YEAR(date_added) = YEAR('".$date." 00:00:00') AND   MONTH(date_added) =  MONTH('".$date." 00:00:00') and status!=2 ;");
		//echo $this->db->last_query()."<br>";
		$asistencias=$query->row_array();
		$result[$date]['asistencias']=$asistencias['total'];

		//Asistencias Cuotas Compensacion
		$query=$this->db->query("select  IFNULL(sum(compensacion),0) total from asistencias_cuotas WHERE YEAR(date_added) = YEAR('".$date." 00:00:00') AND   MONTH(date_added) =  MONTH('".$date." 00:00:00') and status!=2 ;");
		$interes=$query->row_array();
		$result[$date]['interes']=$interes['total'];

		//Asistencias Cuotas Monto
		$query=$this->db->query("select IFNULL(sum(monto),0) total from asistencias_cuotas WHERE   YEAR(date_added) = YEAR('".$date." 00:00:00') AND   MONTH(date_added) =  MONTH('".$date." 00:00:00') and status!=2 ;");
		
		$devolucion=$query->row_array();
		
		$result[$date]['devolucion']=$devolucion['total'];

		$query=$this->db->query("select ( import) AS total  from earnings WHERE   YEAR(date_imputation) = YEAR('".$date." 00:00:00') AND   MONTH(date_imputation) =  MONTH('".$date." 00:00:00') and status!=2 ;");
		$plazo_fijo=$query->row_array();
		$result[$date]['inversion']=$plazo_fijo['total'];

		$result[$date]['saldo']= floatval($interes['total'])+floatval($plazo_fijo['total'])-floatval($asistencias['total'])+floatval($devolucion['total'])+floatval($aportes['total'])+floatval($saldo_previo);
		$saldo_previo=$result[$date]['saldo'];
			*/

		return $result;
	}
}