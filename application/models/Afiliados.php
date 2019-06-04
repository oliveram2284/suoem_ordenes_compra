<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Afiliados extends CI_Model {

    public function __construct(){
        
        $this->create_tables();

        
        
    }

    public function create_tables(){
        $this->load->dbforge();    
        $this->dbforge->add_field('id');
        $this->dbforge->add_field(array(           
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
            'legajo' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'DEFAULT' =>''
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '15',
                'DEFAULT' =>''
            ),
            'observation' => array(
                'type' => 'TEXT',
                'DEFAULT' =>NULL
            ),    
            'municipio_id' => array(
                'type' => 'INT',
                'DEFAULT' =>0
            ),
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
        
        $this->dbforge->create_table('afiliados',true);

        /*
        if (!$this->db->field_exists('nro_cuotas', 'afiliados')){
            $fields = array(
                'nro_cuotas' => array('type' => 'int','constraint' => 3,'DEFAULT' =>6),
                'monto_cuota' => array('type' => 'DECIMAL','constraint' => '15,4','DEFAULT' =>0),
                'renovacion' => array('type' => 'int','constraint' => '1','DEFAULT' =>0),
            );
            $this->dbforge->add_column('afiliados', $fields);            
        }
        */

        if (!$this->db->field_exists('address', 'afiliados')){
            $fields = array(
                'address' => array('type' => 'VARCHAR','constraint' => 200, 'AFTER' => 'dni', 'DEFAULT' =>NULL),
            );
            $this->dbforge->add_column('afiliados', $fields);            
        }

        if (!$this->db->field_exists('email', 'afiliados')){
            $fields = array(
                'email'   => array('type' => 'VARCHAR','constraint' => 200, 'AFTER' => 'phone', 'DEFAULT' =>NULL),
            );
            $this->dbforge->add_column('afiliados', $fields);            
        }

        if (!$this->db->field_exists('cupo', 'afiliados')){
            $fields = array(
                'cupo'   => array('type' => 'DECIMAL','constraint' => '15,2    ', 'BEFORE' => 'email', 'DEFAULT' =>0),
            );
            $this->dbforge->add_column('afiliados', $fields);            
        }
        
    }

    public function totals(){

        $this->db->where('status !=',-1);
        $query = $this->db->get('afiliados');
        
		return $query->num_rows();
    }


    public function getTotalFiltered($data = null){
       
		$response = array();
		$this->db->select(' a.* , m.nombre as muni_nombre');
        $this->db->from('afiliados as a');

        $this->db->join('municipios as m','a.municipio_id=m.id');
        
		$this->db->where('a.status!= ',-1);	
		if($data['search']['value']!=''){
            //$this->db->or_where('a.nro ',$data['search']['value']);	
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
         m.nombre as muni_code,DATE_FORMAT(a.date_added, "%d-%m-%Y") as added,CONCAT(a.lastname," ",a.firstname) as fullname,
         DATE_FORMAT(a.date_activation, "%d-%m-%Y") as actived');
        $this->db->from('afiliados as a');
        $this->db->join('municipios as m','a.municipio_id=m.id');

        //var_dump($data['order']);
        switch($data['order'][0]['column']){
            case 0:{
                $this->db->order_by('a.id',$data['order'][0]['dir']);                
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
                $this->db->order_by('m.nombre',$data['order'][0]['dir']);               
                break;
            }
            case 4:{
                $this->db->order_by('m.date_added',$data['order'][0]['dir']);               
                break;
            }
            case 5:{
                $this->db->order_by('a.status',$data['order'][0]['dir']);               
                break;
            }
            default:{
                $this->db->order_by('a.id',$data['order'][0]['dir']);
            }
        }
        
		if($data['search']['value']!=''){
            //$this->db->or_like('a.nro ',$data['search']['value']);	
			$this->db->or_like('a.firstname ',$data['search']['value']);	
			$this->db->or_like('a.lastname ',$data['search']['value']);
			$this->db->or_like('a.legajo ',$data['search']['value']);
			$this->db->or_like('a.dni ',$data['search']['value']);
            $this->db->or_like('m.name ',$data['search']['value']);
            $this->db->or_like('DATE_FORMAT(a.date_added, "%d-%m-%Y %H:%i")',$data['search']['value']);

        }
        
        $this->db->where('a.status!= ',-2);	
		$this->db->limit($data['length'],$data['start']);
        $query = $this->db->get();
        //die($this->db->last_query());
        log_message('info', __CLASS__."_".__METHOD__."_".__LINE__."". $this->db->last_query());
		return $query->result_array();
	}

    public function getById($id=null){
        if(!$id){
            return false;
        }
        $this->db->select('*,DATE_FORMAT(date_activation, "%Y-%m-%d") as activation');
        $query = $this->db->get_where('afiliados',array('id'=>$id));
        //echo $this->db->last_query()."<br>";
        $result = $query->row_array();
        
        return $result;
    }

    public function getByName($name=''){
        if(!$name){
            return array();
        }

        $this->db->select("ad.id as id, CONCAT(ad.lastname,' ',ad.firstname) as text ");
        $this->db->from('afiliados ad');
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
        
      
        if($this->db->insert('afiliados',$params)){

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
            return $this->db->update('afiliados', $params, array('id' => $id));
        }else{
            return false;
        }
    }

    public function delete($id=false){
        return $this->db->update('afiliados',array('status'=>2),array('id' => $id));
        
    }
    /*
    public function checkActivation(){

        $query=$this->db->get_where('afiliados',array('date_activation'=>null));

        if($query->num_rows()){
            return false;
        }

        foreach($query->result_array() as $key => $item){
            $query_aporte=$this->db->get_where('aportes',array('adherent_nro'=>$item['nro']));
            if($query_aporte->num_rows()>0){
                $aporte= $query_aporte->row_array();
                $this->db->update('afiliados',array('date_activation'=>$aporte['date_added']),array('id'=>$item['id']));
            }
        }
    }
    */

    /*
    public function lastest($limit=10){
        $this->db->select('*, CONCAT(lastname," ",firstname) as fullname ,DATE_FORMAT(date_added, "%d-%m-%Y") as added,DATE_FORMAT(date_activation, "%d-%m-%Y") as actived');
        $this->db->order_by('date_added','desc');
        $this->db->limit($limit);
        $query = $this->db->get('afiliados');
		return $query->result_array();
    }


    public function recents(){
        $query = $this->db->query('(select adherent_nro as nro ,(select CONCAT(a.lastname," ",firstname)from afiliados as a where a.nro=adherent_nro) as fullname , date_added , 0 as tipo from aportes order by date_added desc limit 5)
        UNION
        (select adherent_nro as nro ,(select CONCAT(a.lastname," ",firstname)from afiliados as a where a.nro=adherent_nro) as fullname,  date_added, 1 as tipo from asistencias order by date_added desc limit 5);');
    
		return $query->result_array();
    }

    public function getInfo($id=null){
        if(!$id){
            return false;
        }
        #Adherente
        $this->db->select('afiliados.*,DATE_FORMAT(date_added, "%d-%m-%Y") as added, DATE_FORMAT(date_activation, "%d-%m-%Y") as activation, municipality.name');
        $this->db->from('afiliados');
        $this->db->join('municipality','municipality.code = afiliados.municipality_code');
        $this->db->where(array('afiliados.id'=>$id));
        $query = $this->db->get();
        $result['afiliado'] = $query->row_array();
        #Aportes
        $this->db->select('*,DATE_FORMAT(date_added, "%d-%m-%Y") as added,DATE_FORMAT(date_cancelation, "%d-%m-%Y") as cancelation');
        $this->db->from('aportes');
        $this->db->where(array('adherent_nro' => $result['afiliado']['nro']));
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
        $this->db->where(array('adherent_nro' => $result['afiliado']['nro']));
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
        
        //$output = $dompdf->output();
        //file_put_contents('assets/reports/'.rand(1,10).'.pdf', $output);

        
    }
    */

}

