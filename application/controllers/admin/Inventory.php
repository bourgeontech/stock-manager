<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require_once __DIR__ . '/vendor/autoload.php';
class Inventory extends CI_Controller {
    public function __construct(){
        parent::__construct();
        date_default_timezone_set("Asia/Calcutta");
        if(empty($this->session->admin)){
            redirect('admin/','refresh');
        }

        $this->loggedIn=$this->session->admin;
    	$this->load->model('general_model');
    
    	$site_settings 	= $this->db->select('*')->from('site_settings')->get()->row();
    
    	/***
    	 * Language Settings
    	 ***/
      	$language_settings = $this->db->field_exists('language', 'site_settings');
    
    	if($language_settings && $site_settings->language != null) {
           $this->load->language('main', $site_settings->language);
        }
    }

	public function assign_products_to_pooja() {
    	$data['deities'] = $this->general_model->getdietys();
    	$data['products'] = $this->general_model->getinv_product();
    	
    	$this->form_validation->set_rules('product_id', 'Product', 'required');
    	$this->form_validation->set_rules('pooja_id', 'Pooja', 'required');
    
        if ($this->form_validation->run() === FALSE){
        	$this->load->view('admin/layouts/admin_header');
        	$this->load->view('admin/inventory/assign_products_to_pooja', $data);
        	$this->load->view('admin/layouts/admin_footer');
        } else {
        	$entry = array(
            			'pooja_id'=> $this->input->post('pooja_id'),
            		    'product_id'=> $this->input->post('product_id'),
            		 );
        	$this->db->insert('pooja_products', $entry);
        	redirect('admin/inventory/assign_products_to_pooja');
        }
    	
    	
    }
}