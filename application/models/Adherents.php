<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Adherents extends CI_Model {

    public function __construct(){
        
        $this->create_tables();

        
        
    }

    public function create_tables(){
        $this->load->dbforge();    
        $this->dbforge->add_field('id');
        $this->dbforge->add_field(array(
            'nro' => array(
                'type' => 'INT',
                'constraint' => 2,
                'DEFAULT' =>0
            ),
            
            'firstname' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'DEFAULT' =>''
            ),
            'lastname' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'DEFAULT' =>''
            ),
            'dni' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'DEFAULT' =>''
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '15',
                'DEFAULT' =>''
            ),
            'legajo' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'DEFAULT' =>''
            ),
            'observation' => array(
                'type' => 'TEXT',
                'DEFAULT' =>NULL
            ),    
            'municipality_code' => array(
                'type' => 'char',
                'constraint' => 3,
                'DEFAULT' =>0
            ),/*
            'work_status' => array(
                'type' => 'INT',
                'constraint' => 2,
                'DEFAULT' =>1
            ),*/
            'date_added' => array(
                'type' => 'DATETIME',
            ),
            'date_activation' => array(
                'type' => 'DATETIME',
                'DEFAULT' =>NULL
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 2,
                'DEFAULT' =>1
            ),
        ));
        
        $this->dbforge->create_table('adherents',true);

        if (!$this->db->field_exists('nro_cuotas', 'adherents')){
            $fields = array(
                'nro_cuotas' => array('type' => 'int','constraint' => 3,'DEFAULT' =>6),
                'monto_cuota' => array('type' => 'DECIMAL','constraint' => '15,4','DEFAULT' =>0),
                'renovacion' => array('type' => 'int','constraint' => '1','DEFAULT' =>0),
            );
            $this->dbforge->add_column('adherents', $fields);            
        }

        if (!$this->db->field_exists('address', 'adherents')){
            $fields = array(
                'address' => array('type' => 'VARCHAR','constraint' => 200, 'AFTER' => 'dni', 'DEFAULT' =>NULL),
            );
            $this->dbforge->add_column('adherents', $fields);            
        }

        if (!$this->db->field_exists('email', 'adherents')){
            $fields = array(
                'email'   => array('type' => 'VARCHAR','constraint' => 200, 'AFTER' => 'phone', 'DEFAULT' =>NULL),
            );
            $this->dbforge->add_column('adherents', $fields);            
        }

        if (!$this->db->field_exists('monto_aporte_inicial', 'adherents')){
            $fields = array(
                'monto_aporte_inicial'   => array('type' => 'DECIMAL','constraint' => '15,2', 'BEFORE' => 'nro_cuotas', 'DEFAULT' =>0),
            );
            $this->dbforge->add_column('adherents', $fields);            
        }
        if (!$this->db->field_exists('monto_contado', 'adherents')){
            $fields = array(
                'monto_contado'   => array('type' => 'DECIMAL','constraint' => '15,2    ', 'BEFORE' => 'nro_cuotas', 'DEFAULT' =>0),
            );
            $this->dbforge->add_column('adherents', $fields);            
        }
        if (!$this->db->field_exists('monto_total_cuotas', 'adherents')){
            $fields = array(
                'monto_total_cuotas'   => array('type' => 'DECIMAL','constraint' => '15,2', 'BEFORE' => 'nro_cuotas', 'DEFAULT' =>0),
            );
            $this->dbforge->add_column('adherents', $fields);            
        }


        
        
        $this->dbforge->add_field('id');
        $this->dbforge->add_field(array(
            'code' => array(
                'type' => 'CHAR',
                'constraint' => 3,
                'DEFAULT' =>0
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'DEFAULT' =>''
            ),
            'description' => array(
                'type' => 'TEXT',
                'DEFAULT' =>NULL
            ),            
            'status' => array(
                'type' => 'INT',
                'constraint' => 2,
                'DEFAULT' =>0
            )
        ));
        $this->dbforge->create_table('municipality',true);

        if($this->db->count_all_results('municipality')==0){
            $rows=array(
                array('01','CAPITAL'),
                array('15','JUBILADOS'),
                array('32','RAWSON'),
                array('34','RIVADAVIA'),
                array('36','CHIMBAS'),
                array('37','SANTA LUCIA'),
                array('40','ZONDA'),
                array('41','9 DE JULIO'),
                array('42','POCITO'),
                array('46','ALBARDON'),
                array('45','SARMIENTO'),
                array('47','ANGACO'),
                array('48','ULLUN'),
                array('49','25 DE MAYO'),
                array('54','CALINGASTA'),
                array('55','VALLE FERTIL'),
                array('56','JACHAL'),
                array('57','CAUCETE'),
                array('59','IGLESIA'),
                array('60','SAN MARTÍN'),
                array('99','SUOEM'),
            );
            /*    array('code'=>0,'description'=>''),
                'Albardón','Angaco','Calingasta','Capital','Caucete','Chimbas','Iglesia','Jáchal','9 de Julio','Pocito',
                        'Rawson','Rivadavia','San Martin','Santa Lucia','Sarmiento','Ullúm','Valle Fértil','25 de Mayo','Zonda');
            */
            foreach($rows as $key=>$item){
                //var_dump($item);
                $this->db->insert('municipality',array('code'=>$item[0],'name'=>utf8_encode( $item[1]),'description'=>'','status'=>1));
            }
        }
    }

    public function totals(){

        $this->db->where('status !=',2);
        $query = $this->db->get('adherents');
        
		return $query->num_rows();
    }


    public function getTotalFiltered($data = null){
       
		$response = array();
		$this->db->select(' a.* , m.name as muni_code');
        $this->db->from('adherents as a');

        $this->db->join('municipality as m','a.municipality_code=m.code');
        
		$this->db->where('a.status!= ',2);	
		if($data['search']['value']!=''){
            $this->db->or_where('a.nro ',$data['search']['value']);	
			$this->db->or_like('a.firstname ',$data['search']['value']);	
			$this->db->or_like('a.lastname ',$data['search']['value']);
			$this->db->or_like('a.legajo ',$data['search']['value']);
			$this->db->or_like('a.dni ',$data['search']['value']);
            $this->db->or_like('m.name ',$data['search']['value']);
            $this->db->or_like('DATE_FORMAT(a.date_added, "%d-%m-%Y %H:%i")',$data['search']['value']);

			//$this->db->limit($data['length'],$data['start']);
		}		
        $query = $this->db->get();
        
		return $query->num_rows();
    }
    
    public function getFiltered( $data = null){

        $this->db->select(' a.* ,
         m.name as muni_code,DATE_FORMAT(a.date_added, "%d-%m-%Y") as added,CONCAT(a.lastname," ",a.firstname) as fullname,
         DATE_FORMAT(a.date_activation, "%d-%m-%Y") as actived,
         (select IF( date_cancelation IS NOT NULL and date_cancelation <= NOW(), 1,0) from aportes  where adherent_nro=a.nro) as renew
         ');
        $this->db->from('adherents as a');
        $this->db->join('municipality as m','a.municipality_code=m.code');

        //var_dump($data['order']);
        switch($data['order'][0]['column']){
            case 0:{
                $this->db->order_by('a.nro',$data['order'][0]['dir']);                
                break;
            }
            case 1:{
                $this->db->order_by('a.firstname',$data['order'][0]['dir']);                
                $this->db->order_by('a.lastname',$data['order'][0]['dir']);                
                break;
            }
            case 2:{
                $this->db->order_by('a.legajo',$data['order'][0]['dir']);               
                break;
            }
            case 3:{
                $this->db->order_by('m.name',$data['order'][0]['dir']);               
                break;
            }
            case 4:{
                $this->db->order_by('m.date_added',$data['order'][0]['dir']);               
                break;
            }
            case 5:{
                $this->db->order_by('m.date_activation',$data['order'][0]['dir']);               
                break;
            }
            default:{
                $this->db->order_by('a.nro',$data['order'][0]['dir']);
            }
        }
        
		if($data['search']['value']!=''){
            $this->db->or_like('a.nro ',$data['search']['value']);	
			$this->db->or_like('a.firstname ',$data['search']['value']);	
			$this->db->or_like('a.lastname ',$data['search']['value']);
			$this->db->or_like('a.legajo ',$data['search']['value']);
			$this->db->or_like('a.dni ',$data['search']['value']);
            $this->db->or_like('m.name ',$data['search']['value']);
            $this->db->or_like('DATE_FORMAT(a.date_added, "%d-%m-%Y %H:%i")',$data['search']['value']);

        }
        
        $this->db->where('a.status!= ',2);	
		$this->db->limit($data['length'],$data['start']);
        $query = $this->db->get();
        //die($this->db->last_query());
        log_message('info', __CLASS__."_".__METHOD__."_".__LINE__."". $this->db->last_query());
		return $query->result_array();
	}

    public function getMunicipalidad(){
        $this->db->select('id,code,name');
        $this->db->order_by('id','asc');
        $query = $this->db->get('municipality');	
		return $query->result_array();
    }

    public function getNext(){
        $this->db->select('(nro+1) as next_nro');
        $this->db->order_by('nro','desc');
        $this->db->limit('1');
        $query = $this->db->get('adherents');	        
        return ($query->num_rows()!=0)? $query->row_array()['next_nro']:1;
    }

    public function getById($id=null){
        if(!$id){
            return false;
        }
        $this->db->select('*,DATE_FORMAT(date_activation, "%Y-%m-%d") as activation');
        $query = $this->db->get_where('adherents',array('id'=>$id));
        //echo $this->db->last_query()."<br>";
        $result = $query->row_array();
        
        return $result;
    }

    public function getByName($name=''){
        if(!$name){
            return array();
        }

        $this->db->select("ad.nro as id, CONCAT(ad.lastname,' ',ad.firstname) as text ");
        $this->db->from('adherents ad');
        //$this->db->join('aportes as ap','ap.adherent_nro=ad.nro','left');
        //$this->db->where('ap.nro IS NULL');
        $this->db->like('LOWER(ad.lastname)',$name);
        $this->db->or_like('LOWER(ad.firstname)',$name);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return  $query->result_array();
    }
    function add($data=null){
        $this->db->trans_off();
        $this->db->trans_start(TRUE);
        $this->db->trans_strict(TRUE);
        if($this->input->post()==null && $data==null){
            return false;
        }
        //var_dump($this->input->post());
        //die();
        $params=$this->input->post();

      
        
        $params['date_added']     = date('Y-m-d H:i:s');
        $params['date_activation']= date('Y-m-d H:i:s',strtotime($params['date_activation']));
        $params['status']         = 0;
        //var_dump($params);
        //$monto=  floatval($params['monto_aporte_inicial']);  //(int)$params['monto_cuota']*(int)$params['nro_cuotas'];
        
      
        if($this->db->insert('adherents',$params)){

            $aporte_data=array(
                'adherent_nro'=>$params['nro'],
                'monto'=>floatval($params['monto_aporte_inicial']),
                'cuotas'=>$params['nro_cuotas'],
                'monto_abonado'=>floatval($params['monto_aporte_inicial']),
                'monto_contado'=>floatval($params['monto_contado']),
                'cuotas_pagas'=>$params['nro_cuotas'],
                'date_added'=>$params['date_activation'],
                //'date_activation'=>$params['date_activation'],
            );
            
            $this->db->insert('aportes',$aporte_data);
            if($aporte_id=$this->db->insert_id()){
                for($i=0;$i<$aporte_data['cuotas'];$i++){     
                    $date_temp=strtotime($params['date_activation']);
                    $date_added = date("Y-m-d", strtotime("+".$i." month", $date_temp));
                    $cuotas_data=array(
                        'aporte_id'=>$aporte_id,
                        'monto'=>$params['monto_cuota'],//$aporte_data['monto']/$aporte_data['cuotas'],
                        'date_added'=>$date_added
                    );
                    $this->db->insert('aporte_cuotas',$cuotas_data);            
                }
            }

             $this->db->trans_complete();    
            return $this->db->insert_id();
        }else{
            $this->db->trans_complete();
            return false;
        }

    }
    function update($id , $params = false)
    {       
        if($params){
            return $this->db->update('adherents', $params, array('id' => $id));
        }else{
            return false;
        }
    }

    public function delete($id=false){
        return $this->db->update('adherents',array('status'=>2),array('id' => $id));
        
    }

    public function checkActivation(){

        $query=$this->db->get_where('adherents',array('date_activation'=>null));

        if($query->num_rows()){
            return false;
        }

        foreach($query->result_array() as $key => $item){
            $query_aporte=$this->db->get_where('aportes',array('adherent_nro'=>$item['nro']));
            if($query_aporte->num_rows()>0){
                $aporte= $query_aporte->row_array();
                $this->db->update('adherents',array('date_activation'=>$aporte['date_added']),array('id'=>$item['id']));
            }
        }
    }


    public function lastest($limit=10){
        $this->db->select('*, CONCAT(lastname," ",firstname) as fullname ,DATE_FORMAT(date_added, "%d-%m-%Y") as added,DATE_FORMAT(date_activation, "%d-%m-%Y") as actived');
        $this->db->order_by('date_added','desc');
        $this->db->limit($limit);
        $query = $this->db->get('adherents');
		return $query->result_array();
    }


    public function recents(){
        $query = $this->db->query('(select adherent_nro as nro ,(select CONCAT(a.lastname," ",firstname)from adherents as a where a.nro=adherent_nro) as fullname , date_added , 0 as tipo from aportes order by date_added desc limit 5)
        UNION
        (select adherent_nro as nro ,(select CONCAT(a.lastname," ",firstname)from adherents as a where a.nro=adherent_nro) as fullname,  date_added, 1 as tipo from asistencias order by date_added desc limit 5);');
    
		return $query->result_array();
    }

    public function getInfo($id=null){
        if(!$id){
            return false;
        }
        #Adherente
        $this->db->select('adherents.*,DATE_FORMAT(date_added, "%d-%m-%Y") as added, DATE_FORMAT(date_activation, "%d-%m-%Y") as activation, municipality.name');
        $this->db->from('adherents');
        $this->db->join('municipality','municipality.code = adherents.municipality_code');
        $this->db->where(array('adherents.id'=>$id));
        $query = $this->db->get();
        $result['adherente'] = $query->row_array();
        #Aportes
        $this->db->select('*,DATE_FORMAT(date_added, "%d-%m-%Y") as added,DATE_FORMAT(date_cancelation, "%d-%m-%Y") as cancelation');
        $this->db->from('aportes');
        $this->db->where(array('adherent_nro' => $result['adherente']['nro']));
        $this->db->where_in('status', array(1,0));
        $query = $this->db->get();
        $aportes = $query->result_array();
        #Cuotas Aporte
        foreach ($aportes as $item) {
            $this->db->select('*, DATE_FORMAT(date_added, "%d-%m-%Y") as added');
            $this->db->from('aporte_cuotas');
            $this->db->where(array('aporte_id' => $item['id'], 'date_added < ' => 'NOW()'));
            $query = $this->db->get();
            $item['cuotas'] = $query->result_array();
            $result['aportes'][] = $item;
        }
        #Asistencias
        $this->db->select('*,DATE_FORMAT(date_added, "%d-%m-%Y") as added');
        $this->db->from('asistencias');
        $this->db->where(array('adherent_nro' => $result['adherente']['nro']));
        $this->db->where_in('status', array(1,0));
        $query = $this->db->get();
        $asistencias = $query->result_array();
        #Cuotas Asistencia
        foreach ($asistencias as $item) {
            $this->db->select('*, DATE_FORMAT(date_added, "%d-%m-%Y") as added');
            $this->db->from('asistencias_cuotas');
            $this->db->where(array('asistencia_id' => $item['id'], 'date_added < ' => 'NOW()'));
            $query = $this->db->get();
            $item['cuotasd'] = $query->result_array();
            $result['asistencias'][] = $item;
        }
        return $result;
    }    

    public function imprimirinfo($data = null, $html){
        $adhId = $data['id'];
        //$html = 'hola mundo !!'.$adhId;
        //se incluye la libreria de dompdf
        require_once("assets/plugin/HTMLtoPDF/dompdf/dompdf_config.inc.php");
        //se crea una nueva instancia al DOMPDF
        $dompdf = new DOMPDF();
        //se carga el codigo html
        $dompdf->load_html(utf8_decode($html));
        //aumentamos memoria del servidor si es necesario
        ini_set("memory_limit","300M");
        //Tamaño de la página y orientación
        $dompdf->set_paper('a4','portrait');
        //lanzamos a render
        $dompdf->render();
        //guardamos a PDF
        //$dompdf->stream("TrabajosPedndientes.pdf");
        $output = $dompdf->output();
        file_put_contents('assets/reports/'.$adhId.'.pdf', $output);

        //Eliminar archivos viejos ---------------
        $dir = opendir('assets/reports/');
        while($f = readdir($dir))
        {
            if((time()-filemtime('assets/reports/'.$f) > 3600*24*1) and !(is_dir('assets/reports/'.$f)))
            unlink('assets/reports/'.$f);
        }
        closedir($dir);
        //----------------------------------------
        return $adhId.'.pdf';
    }


    public function print_contrato($data = null, $html){
        require_once("assets/plugin/HTMLtoPDF/dompdf/dompdf_config.inc.php");
        $dompdf = new DOMPDF();

      
        $dompdf->load_html(utf8_decode($html));
        //aumentamos memoria del servidor si es necesario
        ini_set("memory_limit","300M");
        //Tamaño de la página y orientación
        $dompdf->set_paper('a4','portrait');
        //lanzamos a render
        $dompdf->render();
        //guardamos a PDF
        $dompdf->stream("SolicitudAdmision_".date("dmY").".pdf");
        //$dompdf->output();
        /*
        $output = $dompdf->output();
        file_put_contents('assets/reports/'.rand(1,10).'.pdf', $output);*/

        
    }

}

