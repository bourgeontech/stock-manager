<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require_once __DIR__ . '/vendor/autoload.php';
class Pooja extends CI_Controller {
    public function __construct(){
        parent::__construct();
        date_default_timezone_set("Asia/Calcutta");
        if(empty($this->session->admin)){
            redirect('admin/','refresh');
        }

        $this->loggedIn=$this->session->admin;
    	$this->load->model('general_model');
    }
	
	public function pooja_muthalkootu(){
        $this->form_validation->set_rules('from_date', 'Date', 'required');
    	$this->form_validation->set_rules('to_date', 'Date', 'required');
        $this->form_validation->set_rules('reference_no', 'Reference Number', 'required');


        if ($this->form_validation->run() === FALSE){
            $data['temple_list']=$this->general_model->gettemples();
            $data['pooja_list']=$this->general_model->getpoojas();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/pooja/pooja_muthalkootu',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $ref_no=$this->input->post('reference_no');
            $fdate=$this->input->post('from_date');
            $tdate=$this->input->post('to_date');
            $pooja_id=$this->input->post('pooja_id');
            $rates=$this->input->post('rate');
        	$pooja_costs=$this->input->post('pooja_cost');
        	$allocated_rates=$this->input->post('allocated_rate');
        	
            $this->db->query("INSERT INTO muthalkootu(`reference_no`,`from_date`,`to_date`) VALUES ('$ref_no','$fdate', '$tdate')");
            $muthalkootu_id=$this->db->insert_id();
            $i=0;
            while ($i<sizeof($pooja_id)){
                $pooja=$pooja_id[$i];
                $rate=$rates[$i];
                $pooja_cost=$pooja_costs[$i];
            	$allocated_rate=$allocated_rates[$i];
                $this->db->query("INSERT INTO muthalkootu_poojas(`muthalkootu_id`,`pooja_id`,`rate`,`pooja_cost`, `allocated_rate`) VALUES ('$muthalkootu_id','$pooja','$rate','$pooja_cost', '$allocated_rate')");
                $i++;
            }
            redirect('admin/pooja/pooja_muthalkootu');
        }
    }

    public function muthalkootu_view($id){
        $data['temple_list'] = $this->general_model->gettemples();
        $data['muthalkootu'] = $this->general_model->getMuthalkootuById($id);           
        $data['muthalkootu_poojas'] = $this->general_model->getPoojasByMuthalkootuId($id);
    
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/pooja/muthalkootu_view', $data);
        $this->load->view('admin/layouts/admin_footer');
    }

	public function muthalkootu_edit($id){
        $data['temple_list'] = $this->general_model->gettemples();
        $data['muthalkootu'] = $this->general_model->getMuthalkootuById($id);           
        $data['muthalkootu_poojas'] = $this->general_model->getPoojasByMuthalkootuId($id);
    
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/pooja/muthalkootu_edit', $data);
        $this->load->view('admin/layouts/admin_footer');
    }

	public function muthalkootu_update() {
    	$ref_no  = $this->input->post('reference_no');
    	$fdate    = $this->input->post('start_date');
    	$tdate      = $this->input->post('end_date');

    	$this->db->select('id');
    	$this->db->from('muthalkootu');
    	$this->db->where('reference_no', $ref_no);
    	$this->db->where('from_date', $fdate);
    	$this->db->where('to_date', $tdate);
    	$muthalkoottu_id = $this->db->get()->row()->id;
    
    	$this->db->where('muthalkootu_id', $muthalkoottu_id);
		$this->db->delete('muthalkootu_poojas');
    	$this->db->where('id', $muthalkoottu_id);
		$this->db->delete('muthalkootu');
    
    		$pooja_id=$this->input->post('pooja_id');
            $rates=$this->input->post('rate');
        	$pooja_costs=$this->input->post('pooja_cost');
        	$allocated_rates=$this->input->post('allocated_rate');
        	
            $this->db->query("INSERT INTO muthalkootu(`reference_no`,`from_date`,`to_date`) VALUES ('$ref_no','$fdate', '$tdate')");
            $muthalkootu_id=$this->db->insert_id();
            $i=0;
            while ($i<sizeof($pooja_id)){
                $pooja=$pooja_id[$i];
                $rate=$rates[$i];
                $pooja_cost=$pooja_costs[$i];
            	$allocated_rate=$allocated_rates[$i];
                $this->db->query("INSERT INTO muthalkootu_poojas(`muthalkootu_id`,`pooja_id`,`rate`,`pooja_cost`, `allocated_rate`) VALUES ('$muthalkootu_id','$pooja','$rate','$pooja_cost', '$allocated_rate')");
                $i++;
            }
            redirect('admin/pooja/muthalkootu_list');
    }

	public function muthalkootu_list(){
        $data['temple_list']=$this->general_model->gettemples();
        $data['muthalkootu_list']=$this->general_model->getmuthalkootu();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/pooja/muthalkootu_list',$data);
        $this->load->view('admin/layouts/admin_footer');
    }

	public function muthalkootu_report(){
        $this->form_validation->set_rules('datef', 'Date From', 'required');
        $this->form_validation->set_rules('datet', 'Date To', 'required');
        $data['temple_list']=$this->general_model->gettemples();
    	$today = date('Y-m-d');
        $data['muthalkootu_list']=$this->general_model->getmuthalkootusummary($today,$today);
        $data['pooja_list']=$this->general_model->getpoojas();
    	$data['pooja_cat'] = $this->general_model->getpoojacategories();
        if ($this->form_validation->run() === FALSE){
            $data['datef']=$today;
            $data['datet']=$today;
        	$this->load->view('admin/layouts/admin_header');
        	$this->load->view('admin/pooja/muthalkootu_report',$data);
        	$this->load->view('admin/layouts/admin_footer');
        }else {
            $from=$this->input->post('datef');
            $to=$this->input->post('datet');
        	
            $diety="0";
            $type=null;
            $data['datef']=$from;
            $data['datet']=$to;
        	
        	if($this->input->post('pooja_category_id'))
        	{
            	$category_id = $this->input->post('pooja_category_id');
        		$data['category_id']=$category_id;
            	$data['muthalkootu_list']=$this->general_model->getmuthalkootusummary($from,$to, $category_id);
        	} else {
            	$data['muthalkootu_list']=$this->general_model->getmuthalkootusummary($from,$to);
            }
            
        	//print_r($this->db->last_query());
            if($this->input->post('serch')=="serch"){
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/pooja/muthalkootu_report',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
                $this->load->view('admin/pooja/report_print',$data);
            }
        }
    }

	public function bill_report_poojawise(){

        $this->form_validation->set_rules('keyword', 'Date', 'required');
        $this->form_validation->set_rules('temple', 'Diety', 'required');
   
        if ($this->form_validation->run() === FALSE){
            $data['diety_list']=$this->general_model->getdietys();
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/billing/report_poojawise',$data);
            $this->load->view('admin/layouts/admin_footer');
        }else{
            $keyword=$this->input->post('keyword');
            $dateto=$this->input->post('dateto');
            $bill=$this->input->post('temple');
            $type=$this->input->post('billtype');
            $ampm=$this->input->post('ampm');

            $pooja=$this->input->post('pooja');
            $data['dateto']=$dateto;
            $data['diety']=$bill;
            $data['ampm']=$ampm;
        	$data['keyword']=$keyword;
        	$data['pooja']=$pooja;
            $data['type']=$type;
        
            if($this->input->post('serch')=="serch"){
                $data['diety_list']=$this->general_model->getdietys();
                $data['bill_list']=$this->general_model->getbillreport_poojawise($keyword,$dateto,$bill,$type,$ampm,$pooja);

                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/billing/report_poojawise',$data);
                $this->load->view('admin/layouts/admin_footer');
            }elseif($this->input->post('serch')=="print"){
               $data['bill_list']=$this->general_model->getbillreport_poojawise($keyword,$dateto,$bill,$type,$ampm,$pooja);
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/pooja_wise_print_single',$data);
            }elseif($this->input->post('serch')=="pooja_wise"){
               $data['bill_list']=$this->general_model->getbillreport_poojawise($keyword,$dateto,$bill,$type,$ampm,$pooja);
                $data['temple_list']=$this->general_model->gettemples();
                $this->load->view('admin/billing/pooja_wise_print_single',$data);
            }
        }
    }

	public function getPoojaByDeity() {
    	$deity_id = $this->input->post('deity_id');
    	
    	$this->db->select('pooja.id as id, pooja.name as pooja,pooja.name_mal as pooja_mal,pooja.rate as pooja_rt,pooja.code');
    	$this->db->from('diety_pooja');
    	$this->db->join('pooja', 'pooja.id=diety_pooja.pooja_id');
    	$this->db->where('diety_pooja.temple_id', $deity_id);
    	$query = $this->db->get();
    	$pooja = $query->result();
    
    	echo json_encode($pooja);
    }
}