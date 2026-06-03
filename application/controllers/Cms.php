<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		
        $this->load->helper( array( 'form', 'url' ) );
        $this->load->library( 'form_validation' );
        $this->load->model( 'Cms_model' );
        $this->load->library( 'session' );
        $this->load->library( 'pagination' );
		$this->load->database();
		
		if(empty($this->session->admin)){
            redirect('index.php/admin/','refresh');
         }	
	    $this->loggedIn=$this->session->admin;
	}
	

	// ABOUT US

	public function addContent(){
	    $this->form_validation->set_rules('content', 'Content', 'required');
	    if ($this->form_validation->run() === FALSE){
	        $this->load->view('admin/layouts/admin_header');
	        $this->load->view('admin/aboutus/addContent');
	        $this->load->view('admin/layouts/admin_footer');
		}
		else{

			date_default_timezone_set( 'Asia/Calcutta' );
            $date = date( 'Y-m-d H:i:s' );

            $config['upload_path'] = 'uploads/aboutus/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']    = 1024;

            $this->load->library( 'upload', $config );
            $this->upload->do_upload( 'file' );

            $data = array( 'upload_data'=> $this->upload->data() );
            $file = $this->upload->data( 'file_name' );

            $data = array(
                'title'      =>$this->input->post('title'),
	            'image'     =>$file,
	            'short_content' =>$this->input->post('short_content'),
				'content'   =>$this->input->post('content'),

                'created'         =>$date,

			);
			
	        $res=$this->Cms_model->addContent($data);
	        $msg="Content Saved";
	        redirect('cms/viewContent');
	    }
	    
	}

	public function viewContent(){
	    $data['content']=$this->Cms_model->getcontent();
	    $this->load->view('admin/layouts/admin_header');
	    $this->load->view('admin/aboutus/viewContent',$data);
	    $this->load->view('admin/layouts/admin_footer');
	}

	public function editContent($id){
	    $data['content']=$this->Cms_model->getContentData($id);
	    $this->load->view('admin/layouts/admin_header');
	    $this->load->view('admin/aboutus/editContent',$data);
	    $this->load->view('admin/layouts/admin_footer');
	}

	public function updateContent($id){
		$this->form_validation->set_rules('content', 'Content', 'required');
	    if ($this->form_validation->run() === FALSE){
	        $this->load->view('admin/layouts/admin_header');
	        $this->load->view('admin/aboutus/viewContent');
	        $this->load->view('admin/layouts/admin_footer');
		}
		else{
			
			date_default_timezone_set( 'Asia/Calcutta' );
            $date = date( 'Y-m-d H:i:s' );

			$config['upload_path'] = 'uploads/aboutus/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']    = 1024;
			
            $this->load->library( 'upload', $config );
            $this->upload->do_upload( 'file' );

            $data = array( 'upload_data'=> $this->upload->data() );
            $file = $this->upload->data( 'file_name' );

			if($file!=''){
            $data = array(
                'title'      =>$this->input->post('title'),
	            'image'     =>$file,
	            'short_content' =>$this->input->post('short_content'),
				'content'   =>$this->input->post('content'),

			);
		}
		else 
		{
			$data = array(
				'title'      =>$this->input->post('title'),
	            // 'image'     =>$file,
	            'short_content' =>$this->input->post('short_content'),
				'content'   =>$this->input->post('content'),

			);

		}
	        $res=$this->Cms_model->updateContent($id,'aboutus',$data);
	        $msg="Content Saved";
	        redirect('cms/viewContent');
	    }
	    
	}	
	
	
	public function deleteContent($id){
	    $result=$this->Cms_model->deleteContent($id);
	    $msg="Deleted";
	    redirect('cms/viewContent');
	}
	
	//BANNER
		
		public function addBanner(){
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() === FALSE){
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/banner/addBanner');
				$this->load->view('admin/layouts/admin_footer');
			}
			else{
	
				date_default_timezone_set( 'Asia/Calcutta' );
				$date = date( 'Y-m-d H:i:s' );
	
				$config['upload_path'] = 'uploads/banner/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']    = 1024;
	
				$this->load->library( 'upload', $config );
				$this->upload->do_upload( 'file' );
	
				$data = array( 'upload_data'=> $this->upload->data() );
				$file = $this->upload->data( 'file_name' );
	
				$data = array(
					'title'      =>$this->input->post('title'),
					'image'     =>$file,
                	'display_order' =>$this->input->post('display_order'),
					'created'         =>$date,
	
				);
				
				$res=$this->Cms_model->addBanner($data);
				$msg="Content Saved";
				redirect('cms/viewBanner');
			}
			
		}
		
		public function viewBanner(){
			$data['banner']=$this->Cms_model->getBanner();
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/banner/viewBanner',$data);
			$this->load->view('admin/layouts/admin_footer');
		}
		
		public function deleteBanner($id){
			$result=$this->Cms_model->deleteBanner($id);
			$msg="Deleted";
			redirect('cms/viewBanner');
		}

//ADVERTISEMENT
		
		public function addAdvertisement(){
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() === FALSE){
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/advertisement/addAdvertisement');
				$this->load->view('admin/layouts/admin_footer');
			}
			else{
	
				date_default_timezone_set( 'Asia/Calcutta' );
				$date = date( 'Y-m-d H:i:s' );
	
				$config['upload_path'] = 'uploads/advertisement/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']    = 1024;
	
				$this->load->library( 'upload', $config );
				$this->upload->do_upload( 'file' );
	
				$data = array( 'upload_data'=> $this->upload->data() );
				$file = $this->upload->data( 'file_name' );
	
				$data = array(
					'title'      =>$this->input->post('title'),
					'image'     =>$file,
					'display_order' =>$this->input->post('display_order'),
					'expiry_date' =>$this->input->post('expiry_date'),
					'created'         =>$date,
	
				);
				
				$res=$this->Cms_model->addAdvertisement($data);
				$msg="Content Saved";
				redirect('cms/viewAdvertisement');
			}
			
		}
		
		public function viewAdvertisement(){
			$data['advertisement']=$this->Cms_model->getAdvertisement();
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/advertisement/viewAdvertisement',$data);
			$this->load->view('admin/layouts/admin_footer');
		}
		
		public function deleteAdvertisement($id){
			$result=$this->Cms_model->deleteAdvertisement($id);
			$msg="Deleted";
			redirect('cms/viewAdvertisement');
		}


	//GALLERY

	public function addGallery(){
	    $this->form_validation->set_rules('category', 'Category', 'required');
	    if ($this->form_validation->run() === FALSE){
			$data['gal_category']=$this->Cms_model->getgal_category();
	        $this->load->view('admin/layouts/admin_header');
	        $this->load->view('admin/gallery/addGallery',$data);
	        $this->load->view('admin/layouts/admin_footer');
		}
		else{

			date_default_timezone_set( 'Asia/Calcutta' );
            $date = date( 'Y-m-d H:i:s' );

            $config['upload_path'] = 'uploads/gallery/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']    = 1024;

            $this->load->library( 'upload', $config );
            $this->upload->do_upload( 'file' );

            $data = array( 'upload_data'=> $this->upload->data() );
            $file = $this->upload->data( 'file_name' );

            $data = array(
                'category'      =>$this->input->post('category'),
	            'image'     =>$file,
				'description'   =>$this->input->post('description'),

                'created'         =>$date,

			);
			
	        $res=$this->Cms_model->addGallery($data);
	        $msg="Content Saved";
	        redirect('cms/viewGallery');
	    }
	    
	}

public function addMultipleImagesGallery(){
    $this->form_validation->set_rules('category', 'Category', 'required');
    if ($this->form_validation->run() === FALSE){
        $data['gal_category']=$this->Cms_model->getgal_category();
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/gallery/addGallery',$data);
        $this->load->view('admin/layouts/admin_footer');
    }
    else{
        date_default_timezone_set('Asia/Calcutta');
        $date = date('Y-m-d H:i:s');

        $config['upload_path'] = 'uploads/gallery/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 1024;

        $this->load->library('upload', $config);

        $file_names = array();
        $files = $_FILES['files'];
        $count = count($files['name']);

        for($i = 0; $i < $count; $i++) {
            $_FILES['userfile']['name'] = $files['name'][$i];
            $_FILES['userfile']['type'] = $files['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['error'][$i];
            $_FILES['userfile']['size'] = $files['size'][$i];

            if (!$this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $file_names[] = $this->upload->data('file_name');
            }
        }

        $data = array(
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'created' => $date,
        );

        foreach ($file_names as $file_name) {
            $data['image'] = $file_name;
            $res = $this->Cms_model->addGallery($data);
        }

        $msg = "Content Saved";
        redirect('cms/viewGallery');
    }
}

	public function viewImageCategories(){
	    $data['categories']=$this->Cms_model->getImageCategories();
	    $this->load->view('admin/layouts/admin_header');
	    $this->load->view('admin/gallery/imageCategories',$data);
	    $this->load->view('admin/layouts/admin_footer');
	}

	public function addImageCategory(){
    	$this->form_validation->set_rules('category', 'Category', 'required');
    	if ($this->form_validation->run() === FALSE){
        	$this->load->view('admin/layouts/admin_header');
	    	$this->load->view('admin/gallery/addImageCategory');
	    	$this->load->view('admin/layouts/admin_footer');
    	}
    	else{
	    	$category = $this->input->post('category');
        	$this->db->insert('image_categories', array('name'=> $category));
        
        	redirect('cms/viewImageCategories');
        }
	    
	}

	public function editImageCategory($id){
    	$this->form_validation->set_rules('category', 'Category', 'required');
    	if ($this->form_validation->run() === FALSE){
        	$data['category']=$this->Cms_model->getImageCategory($id);
        	$this->load->view('admin/layouts/admin_header');
	    	$this->load->view('admin/gallery/editImageCategory',$data);
	    	$this->load->view('admin/layouts/admin_footer');
    	}
    	else{
	    	$category = $this->input->post('category');
        	$this->db->where('id', $id);
        	$this->db->update('image_categories', array('name'=> $category));
        
        	redirect('cms/viewImageCategories');
        }
	}
	
	public function viewGallery(){
	    $data['gallery']=$this->Cms_model->getGallery();
	    $this->load->view('admin/layouts/admin_header');
	    $this->load->view('admin/gallery/viewGallery',$data);
	    $this->load->view('admin/layouts/admin_footer');
	}

	public function editGallery($id){
	    $data['gallery']=$this->Cms_model->getGalleryData($id);
	    $this->load->view('admin/layouts/admin_header');
	    $this->load->view('admin/gallery/editGallery',$data);
	    $this->load->view('admin/layouts/admin_footer');
	}
	
	public function updateGallery($id){
	    $this->form_validation->set_rules('category', 'Category', 'required');
	    if ($this->form_validation->run() === FALSE){
	        $this->load->view('admin/layouts/admin_header');
	        $this->load->view('admin/gallery/editGallery');
	        $this->load->view('admin/layouts/admin_footer');
		}
		else{

			date_default_timezone_set( 'Asia/Calcutta' );
            $date = date( 'Y-m-d H:i:s' );

            $config['upload_path'] = 'uploads/gallery/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']    = 1024;

            $this->load->library( 'upload', $config );
            $this->upload->do_upload( 'file' );

            $data = array( 'upload_data'=> $this->upload->data() );
            $file = $this->upload->data( 'file_name' );

			if($file!=''){
            $data = array(
				'category'      =>$this->input->post('category'),
	            'image'        =>$file,
				'description'   =>$this->input->post('description'),

                'created'         =>$date,

			);
		}
		else 
		{
			$data = array(
				'category'      =>$this->input->post('category'),
	            // 'image'        =>$file,
				'description'   =>$this->input->post('description'),

			);

		}
	        $res=$this->Cms_model->updateGallery($id,'gallery',$data);
	        $msg="Content Saved";
	        redirect('cms/viewGallery');
	    }
	    
	}	
	
	public function deleteGallery($id){
	    $result=$this->Cms_model->deleteGallery($id);
	    $msg="Deleted";
	    redirect('cms/viewGallery');
	}


	//VIDEO

public function addVideo() {
	$this->form_validation->set_rules('link', 'Link', 'required');
    if ($this->form_validation->run() === FALSE) {
        $this->load->view('admin/layouts/admin_header');
        $this->load->view('admin/video/addVideo');
        $this->load->view('admin/layouts/admin_footer');
    } else {
        // Set timezone and get current date and time
        date_default_timezone_set('Asia/Calcutta');
        $date = date('Y-m-d H:i:s');

        // Prepare data to insert into the database
        $data = array(
            'link'    => $this->input->post('link'),
        	'description'    => $this->input->post('description'),
            'created' => $date,
        );

        // Insert video data into the database
        $res = $this->Cms_model->addVideo($data);

        if ($res) {
            // If insertion is successful
            $msg = "Content Saved";
        } else {
            // If insertion fails
            $msg = "Failed to save content";
        }

        // Redirect to viewVideo page
        redirect('cms/viewVideo');
    }
}


	
	public function viewVideo(){
	    $data['video']=$this->Cms_model->getVideo();
	    $this->load->view('admin/layouts/admin_header');
	    $this->load->view('admin/video/viewVideo',$data);
	    $this->load->view('admin/layouts/admin_footer');
	}

	
	public function deleteVideo($id){
	    $result=$this->Cms_model->deleteVideo($id);
	    $msg="Deleted";
	    redirect('cms/viewVideo');
	}


	//Contact

	public function addContact(){
	    $this->form_validation->set_rules('email', 'Email', 'required');
	    if ($this->form_validation->run() === FALSE){
			$data['contact']=$this->Cms_model->getContact();
	        $this->load->view('admin/layouts/admin_header');
	        $this->load->view('admin/contact/addContact',$data);
	        $this->load->view('admin/layouts/admin_footer');
		}
		else{

	

            $data = array(
                'temp_name' =>$this->input->post('temp_name'),
                'land_ph'      =>$this->input->post('land_ph'),
	            'mob_ph'   =>$this->input->post('mob_ph'),
				'email'   =>$this->input->post('email'),

                'address'       =>$this->input->post('address'),
					'location'  =>$this->input->post('location'),

			);
		    $res=$this->Cms_model->addContact($data);
	        $msg="Contact Saved";
	        redirect('cms/editContact');
	    }
	    
	}

	public function editContact(){
	    $this->form_validation->set_rules('email', 'Email', 'required');
	    if ($this->form_validation->run() === FALSE){
			$data['contact']=$this->Cms_model->getContact();
	        $this->load->view('admin/layouts/admin_header');
	        $this->load->view('admin/contact/editContact',$data);
	        $this->load->view('admin/layouts/admin_footer');
		}
		else{

	
            $data = array(
                'temp_name' =>$this->input->post('temp_name'),
                'land_ph'      =>$this->input->post('land_ph'),
	            'mob_ph'   =>$this->input->post('mob_ph'),
				'email'   =>$this->input->post('email'),

                'address'       =>$this->input->post('address'),
					'location'  =>$this->input->post('location'),

			);
		    $res=$this->Cms_model->editContact($data);
	        $msg="Contact Saved";
	        redirect('cms/editContact');
	    }
	    
	}


	// PRIEST

	public function addPriest(){
	    $this->form_validation->set_rules('name', 'Name', 'required');
	    if ($this->form_validation->run() === FALSE){
	        $this->load->view('admin/layouts/admin_header');
	        $this->load->view('admin/priest/addPriest');
	        $this->load->view('admin/layouts/admin_footer');
		}
		else{

			date_default_timezone_set( 'Asia/Calcutta' );
            $date = date( 'Y-m-d H:i:s' );

            $config['upload_path'] = 'uploads/priest/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']    = 1024;

            $this->load->library( 'upload', $config );
            $this->upload->do_upload( 'file' );

            $data = array( 'upload_data'=> $this->upload->data() );
            $file = $this->upload->data( 'file_name' );

            $data = array(
                'name'      =>$this->input->post('name'),
	            'image'     =>$file,
				'designation'   =>$this->input->post('designation'),
				'displayOrder'   =>$this->input->post('displayOrder'),
                'priestCreated'         =>$date,

			);
			
	        $res=$this->Cms_model->addPriest($data);
	        $msg="Content Saved";
	        redirect('cms/viewPriest');
	    }
	    
	}	

	public function viewPriest(){
	    $data['priest']=$this->Cms_model->getPriest();
	    $this->load->view('admin/layouts/admin_header');
	    $this->load->view('admin/priest/viewPriest',$data);
	    $this->load->view('admin/layouts/admin_footer');
	}

	public function editPriest($id){
	    $data['priest']=$this->Cms_model->getPriestData($id);
	    $this->load->view('admin/layouts/admin_header');
	    $this->load->view('admin/priest/editPriest',$data);
	    $this->load->view('admin/layouts/admin_footer');
	}

	public function updatePriest($id){
	    $this->form_validation->set_rules('name', 'Name', 'required');
	    if ($this->form_validation->run() === FALSE){
	        $this->load->view('admin/layouts/admin_header');
	        $this->load->view('admin/priest/editPriest');
	        $this->load->view('admin/layouts/admin_footer');
		}
		else{

			date_default_timezone_set( 'Asia/Calcutta' );
            $date = date( 'Y-m-d H:i:s' );

            $config['upload_path'] = 'uploads/priest/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']    = 1024;

            $this->load->library( 'upload', $config );
            $this->upload->do_upload( 'file' );

            $data = array( 'upload_data'=> $this->upload->data() );
            $file = $this->upload->data( 'file_name' );

			if($file!=''){
            $data = array(
                'name'          =>$this->input->post('name'),
	            'image'         =>$file,
				'designation'   =>$this->input->post('designation'),
				'displayOrder'   =>$this->input->post('displayOrder'),
                // 'priestCreated'  =>$date,

			);
		}
		else 
		{
			$data = array(
                'name'          =>$this->input->post('name'),
	            // 'image'         =>$file,
				'designation'   =>$this->input->post('designation'),
				'displayOrder'   =>$this->input->post('displayOrder'),
                // 'priestCreated'  =>$date,

			);

		}
	        $res=$this->Cms_model->updatePriest($id,'priest',$data);
	        $msg="Content Saved";
	        redirect('cms/viewPriest');
	    }
	    
	}	
	
	public function deletePriest($id){
	    $result=$this->Cms_model->deletePriest($id);
	    $msg="Deleted";
	    redirect('cms/viewPriest');
	}
	
		// TRUSTEE

		public function addTrustee(){
			$this->form_validation->set_rules('name', 'Name', 'required');
			if ($this->form_validation->run() === FALSE){
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/trustee/addTrustee');
				$this->load->view('admin/layouts/admin_footer');
			}
			else{
	
				date_default_timezone_set( 'Asia/Calcutta' );
				$date = date( 'Y-m-d H:i:s' );
	
				$config['upload_path'] = 'uploads/trustee/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']    = 1024;
	
				$this->load->library( 'upload', $config );
				$this->upload->do_upload( 'file' );
	
				$data = array( 'upload_data'=> $this->upload->data() );
				$file = $this->upload->data( 'file_name' );
	
				$data = array(
					'name'      =>$this->input->post('name'),
					'image'     =>$file,
					'designation'   =>$this->input->post('designation'),
					'displayOrder'   =>$this->input->post('displayOrder'),
					'tr_created'         =>$date,
	
				);
				
				$res=$this->Cms_model->addTrustee($data);
				$msg="Saved";
				redirect('cms/viewTrustee');
			}
			
		}	
	
		public function viewTrustee(){
			$data['trustee']=$this->Cms_model->getTrustee();
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/trustee/viewTrustee',$data);
			$this->load->view('admin/layouts/admin_footer');
		}
	
		public function editTrustee($id){
			$data['trustee']=$this->Cms_model->getTrusteeData($id);
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/trustee/editTrustee',$data);
			$this->load->view('admin/layouts/admin_footer');
		}
	
		public function updateTrustee($id){
			$this->form_validation->set_rules('name', 'Name', 'required');
			if ($this->form_validation->run() === FALSE){
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/trustee/editTrustee');
				$this->load->view('admin/layouts/admin_footer');
			}
			else{
	
				date_default_timezone_set( 'Asia/Calcutta' );
				$date = date( 'Y-m-d H:i:s' );
	
				$config['upload_path'] = 'uploads/trustee/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']    = 1024;
	
				$this->load->library( 'upload', $config );
				$this->upload->do_upload( 'file' );
	
				$data = array( 'upload_data'=> $this->upload->data() );
				$file = $this->upload->data( 'file_name' );
	
				if($file!=''){
				$data = array(
					'name'          =>$this->input->post('name'),
					'image'         =>$file,
					'designation'   =>$this->input->post('designation'),
					'displayOrder'   =>$this->input->post('displayOrder'),
					// 'priestCreated'  =>$date,
	
				);
			}
			else 
			{
				$data = array(
					'name'          =>$this->input->post('name'),
					// 'image'         =>$file,
					'designation'   =>$this->input->post('designation'),
					'displayOrder'   =>$this->input->post('displayOrder'),
					// 'priestCreated'  =>$date,
	
				);
	
			}
				$res=$this->Cms_model->updateTrustee($id,'trustee',$data);
				$msg="Saved";
				redirect('cms/viewTrustee');
			}
			
		}	
		
		public function deleteTrustee($id){
			$result=$this->Cms_model->deleteTrustee($id);
			$msg="Deleted";
			redirect('cms/viewTrustee');
		}

		// FESTIVAL COMMITTEE
		
		public function addFestivalCommittee(){
			$this->form_validation->set_rules('name', 'Name', 'required');
			if ($this->form_validation->run() === FALSE){
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/festivalCommittee/addFestivalCommittee');
				$this->load->view('admin/layouts/admin_footer');
			}
			else{
	
				date_default_timezone_set( 'Asia/Calcutta' );
				$date = date( 'Y-m-d H:i:s' );
	
				$config['upload_path'] = 'uploads/festivalCommittee/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']    = 1024;
	
				$this->load->library( 'upload', $config );
				$this->upload->do_upload( 'file' );
	
				$data = array( 'upload_data'=> $this->upload->data() );
				$file = $this->upload->data( 'file_name' );
	
				$data = array(
					'name'      =>$this->input->post('name'),
					'image'     =>$file,
					'designation'   =>$this->input->post('designation'),
					'displayOrder'   =>$this->input->post('displayOrder'),
					'festcom_created'         =>$date,
	
				);
				
				$res=$this->Cms_model->addFestivalCommittee($data);
				$msg="Saved";
				redirect('cms/viewFestivalCommittee');
			}
			
		}	
	
		public function viewFestivalCommittee(){
			$data['festCom']=$this->Cms_model->getFestivalCommittee();
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/festivalCommittee/viewFestivalCommittee',$data);
			$this->load->view('admin/layouts/admin_footer');
		}
	
		public function editFestivalCommittee($id){
			$data['festCom']=$this->Cms_model->getFestivalCommitteeData($id);
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/festivalCommittee/editFestivalCommittee',$data);
			$this->load->view('admin/layouts/admin_footer');
		}
	
		public function updateFestivalCommittee($id){
			$this->form_validation->set_rules('name', 'Name', 'required');
			if ($this->form_validation->run() === FALSE){
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/festivalCommittee/editFestivalCommittee');
				$this->load->view('admin/layouts/admin_footer');
			}
			else{
	
				date_default_timezone_set( 'Asia/Calcutta' );
				$date = date( 'Y-m-d H:i:s' );
	
				$config['upload_path'] = 'uploads/festivalCommittee/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']    = 1024;
	
				$this->load->library( 'upload', $config );
				$this->upload->do_upload( 'file' );
	
				$data = array( 'upload_data'=> $this->upload->data() );
				$file = $this->upload->data( 'file_name' );
	
				if($file!=''){
				$data = array(
					'name'          =>$this->input->post('name'),
					'image'         =>$file,
					'designation'   =>$this->input->post('designation'),
					'displayOrder'   =>$this->input->post('displayOrder'),
	
				);
			}
			else 
			{
				$data = array(
					'name'          =>$this->input->post('name'),
					'designation'   =>$this->input->post('designation'),
					'displayOrder'   =>$this->input->post('displayOrder'),
					
				);
	
			}
				$res=$this->Cms_model->updateFestivalCommittee($id,'festivalCommittee',$data);
				$msg="Saved";
				redirect('cms/viewFestivalCommittee');
			}
			
		}	
		
		public function deleteFestivalCommittee($id){
			$result=$this->Cms_model->deleteFestivalCommittee($id);
			$msg="Deleted";
			redirect('cms/viewFestivalCommittee');
		}

		// PARIPALANA SAMITHI
		
		public function addParipalanaSamithi(){
			$this->form_validation->set_rules('name', 'Name', 'required');
			if ($this->form_validation->run() === FALSE){
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/paripalanaSamithi/addParipalanaSamithi');
				$this->load->view('admin/layouts/admin_footer');
			}
			else{
	
				date_default_timezone_set( 'Asia/Calcutta' );
				$date = date( 'Y-m-d H:i:s' );
	
				$config['upload_path'] = 'uploads/paripalanaSamithi/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']    = 1024;
	
				$this->load->library( 'upload', $config );
				$this->upload->do_upload( 'file' );
	
				$data = array( 'upload_data'=> $this->upload->data() );
				$file = $this->upload->data( 'file_name' );
	
				$data = array(
					'name'      =>$this->input->post('name'),
					'image'     =>$file,
					'designation'   =>$this->input->post('designation'),
					'displayOrder'   =>$this->input->post('displayOrder'),
					'created'         =>$date,
	
				);
				
				$res=$this->Cms_model->addParipalanaSamithi($data);
				$msg="Saved";
				redirect('cms/viewParipalanaSamithi');
			}
			
		}	
	
		public function viewParipalanaSamithi(){
			$data['pari_samithi']=$this->Cms_model->getParipalanaSamithi();
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/paripalanaSamithi/viewParipalanaSamithi',$data);
			$this->load->view('admin/layouts/admin_footer');
		}
	
		public function editParipalanaSamithi($id){
			$data['pari_samithi']=$this->Cms_model->getParipalanaSamithiData($id);
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/paripalanaSamithi/editParipalanaSamithi',$data);
			$this->load->view('admin/layouts/admin_footer');
		}
	
		public function updateParipalanaSamithi($id){
			$this->form_validation->set_rules('name', 'Name', 'required');
			if ($this->form_validation->run() === FALSE){
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/paripalanaSamithi/editParipalanaSamithi');
				$this->load->view('admin/layouts/admin_footer');
			}
			else{
	
				date_default_timezone_set( 'Asia/Calcutta' );
				$date = date( 'Y-m-d H:i:s' );
	
				$config['upload_path'] = 'uploads/paripalanaSamithi/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']    = 1024;
	
				$this->load->library( 'upload', $config );
				$this->upload->do_upload( 'file' );
	
				$data = array( 'upload_data'=> $this->upload->data() );
				$file = $this->upload->data( 'file_name' );
	
				if($file!=''){
				$data = array(
					'name'          =>$this->input->post('name'),
					'image'         =>$file,
					'designation'   =>$this->input->post('designation'),
					'displayOrder'   =>$this->input->post('displayOrder'),
	
				);
			}
			else 
			{
				$data = array(
					'name'          =>$this->input->post('name'),
					'designation'   =>$this->input->post('designation'),
					'displayOrder'   =>$this->input->post('displayOrder'),
					
				);
	
			}
				$res=$this->Cms_model->updateParipalanaSamithi($id,'paripalanaSamithi',$data);
				$msg="Saved";
				redirect('cms/viewParipalanaSamithi');
			}
			
		}	
		
		public function deleteParipalanaSamithi($id){
			$result=$this->Cms_model->deleteParipalanaSamithi($id);
			$msg="Deleted";
			redirect('cms/viewParipalanaSamithi');
		}

		//EVENT FESTIVAL

	/**public function addEventFestival(){
	    $this->form_validation->set_rules('title', 'Event Title', 'required');
	    if ($this->form_validation->run() === FALSE){
	        $this->load->view('admin/layouts/admin_header');
	        $this->load->view('admin/event/addEventFestival');
	        $this->load->view('admin/layouts/admin_footer');
		}
		else{

			date_default_timezone_set( 'Asia/Calcutta' );
            $date = date( 'Y-m-d H:i:s' );

            $config['upload_path'] = 'uploads/events/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']    = 1024;

            $this->load->library( 'upload', $config );
            $this->upload->do_upload( 'file' );

            $data = array( 'upload_data'=> $this->upload->data() );
            $file = $this->upload->data( 'file_name' );

            $data = array(
                'title'      =>$this->input->post('title'),
	            'image'     =>$file,
				'description'   =>$this->input->post('description'),

                'created'         =>$date,

			);
			
	        $res=$this->Cms_model->addEventFestival($data);
	        $msg="Content Saved";
	        redirect('cms/viewEventFestival');
	    }
	    
	}
    */
	
	public function viewEventFestival(){
	    $data['event']=$this->Cms_model->getEventFestival();
	    $this->load->view('admin/layouts/admin_header');
	    $this->load->view('admin/event/viewEventFestival',$data);
	    $this->load->view('admin/layouts/admin_footer');
	}
	public function editEventFestival($id){
	    $data['event']=$this->Cms_model->getEventFestivalData($id);
    	$data['poojas'] = $this->db->select('*')->from('pooja')->get()->result();
    
	    $this->load->view('admin/layouts/admin_header');
	    $this->load->view('admin/event/editEventFestival',$data);
	    $this->load->view('admin/layouts/admin_footer');
	}
	
	/*public function updateEventFestival($id){
	    $this->form_validation->set_rules('title', 'Event Title', 'required');
	    if ($this->form_validation->run() === FALSE){
	        $this->load->view('admin/layouts/admin_header');
	        $this->load->view('admin/event/viewEventFestival');
	        $this->load->view('admin/layouts/admin_footer');
		}
		else{

			date_default_timezone_set( 'Asia/Calcutta' );
            $date = date( 'Y-m-d H:i:s' );

            $config['upload_path'] = 'uploads/events/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']    = 1024;

            $this->load->library( 'upload', $config );
            $this->upload->do_upload( 'file' );

            $data = array( 'upload_data'=> $this->upload->data() );
            $file = $this->upload->data( 'file_name' );

			if($file!=''){
            $data = array(
				'title'      =>$this->input->post('title'),
	            'image'     =>$file,
				'description'   =>$this->input->post('description'),

			);
		}
		else 
		{
			$data = array(
				'title'      =>$this->input->post('title'),
	            // 'image'     =>$file,
				'description'   =>$this->input->post('description'),

			);

		}
	        $res=$this->Cms_model->updateEventFestival($id,'event',$data);
	        $msg="Content Saved";
	        redirect('cms/viewEventFestival');
	    }
	    
	}	
	
*/

public function addEventFestival(){
        $this->form_validation->set_rules('title', 'Event Title', 'required');
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/event/addEventFestival');
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            date_default_timezone_set('Asia/Calcutta');
            $date = date('Y-m-d H:i:s');
            // Upload image file
            $config['upload_path'] = 'uploads/events/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 1024;
            $this->load->library('upload', $config);
            $this->upload->do_upload('file');
            $data = array('upload_data' => $this->upload->data());
            $file = $this->upload->data('file_name');
            // Upload PDF file
            $config_pdf['upload_path'] = 'uploads/pdfs/';
            $config_pdf['allowed_types'] = 'pdf';
            $config_pdf['max_size'] = 2048; // Set maximum file size to 2MB
            $this->load->library('upload', $config_pdf);
            $this->upload->do_upload('pdffile');
            $data_pdf = array('upload_data' => $this->upload->data());
            $pdffile = $this->upload->data('file_name');
            $data = array(
                'title' => $this->input->post('title'),
                'image' => $file,
                'pdf_file' => $pdffile, // Add the PDF file name to the data array
                'description' => $this->input->post('description'),
                'created' => $date,
            );
        
        	if($this->db->field_exists('event_date', 'event')) {
            	$data['event_date'] = $this->input->post('event_date');
            }
        
            $res = $this->Cms_model->addEventFestival($data);
            $msg = "Content Saved";
            redirect('cms/viewEventFestival');
        }
    }

public function addEventBrochure(){
        $this->form_validation->set_rules('file', 'Event Brochure', 'required');
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/event/addEventBrochure');
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            date_default_timezone_set('Asia/Calcutta');
            $date = date('Y-m-d H:i:s');
			$title = $this->input->post('title');
        	
            // Upload PDF file
            $config_pdf['upload_path'] = 'uploads/events/pdfs/';
$config_pdf['allowed_types'] = 'pdf';
$config_pdf['max_size'] = 2048; // Set maximum file size to 2MB
$custom_file_name = 'event_brochure_' . time() . '.pdf'; // Example custom file name

// Set the custom file name in the upload configuration
$config_pdf['file_name'] = $custom_file_name;

$this->load->library('upload', $config_pdf);

// Perform the file upload
if (!$this->upload->do_upload('pdffile')) {
    // Handle upload error
    $error = $this->upload->display_errors();
    // You can log the error or display it to the user
    log_message('error', 'File upload error: ' . $error);
    // Load a view with the error message
    print_r($error);
} else {
    // Upload was successful
    $data_pdf = $this->upload->data();
    $file_name = $config_pdf['upload_path'] . $data_pdf['file_name']; // Full path to the uploaded file

    // Check if an entry already exists in the event_brochure table
    $this->db->select('*');
    $this->db->from('event_brochure');
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        // Update the existing entry
        $id = $query->row()->id;
        $this->db->where('id', $id);
        $this->db->update('event_brochure', ['brochure' => $file_name, 'title'=> $title]);
    } else {
        // Insert a new entry
        $this->db->insert('event_brochure', ['brochure' => $file_name, 'title'=> $title]);
    }

    
}

        
            $msg = "Content Saved";
            redirect('cms/addEventBrochure');
        }
    }

	public function downloadEventBrochure() {
    		$this->load->helper('download');
    
    		$this->db->select('*');
      		$this->db->from('event_brochure');
      		$query = $this->db->get();
      
      		if($query->num_rows() > 0) { 
            	$row = $query->row();
            	$brochure = $row->brochure;
            	if (file_exists($brochure)) {
            		// Force download the file
            		force_download($brochure, NULL);
        		} else {
            		show_404();
        		}
            }
    }

public function updateEventFestival($id){
        $this->form_validation->set_rules('title', 'Event Title', 'required');
        if ($this->form_validation->run() === FALSE){
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/event/viewEventFestival');
            $this->load->view('admin/layouts/admin_footer');
        }
        else{
            date_default_timezone_set( 'Asia/Calcutta' );
            $date = date( 'Y-m-d H:i:s' );
            $config['upload_path'] = 'uploads/events/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $config['max_size']    = 2048; // 2 MB
            $this->load->library( 'upload', $config );
            if ($this->upload->do_upload('pdffile')) {
                $data = array( 'upload_data'=> $this->upload->data() );
                $pdf = $this->upload->data('file_name');
            } else {
                $pdf = $this->input->post('pdf');
            }
            $config['upload_path'] = 'uploads/events/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']    = 1024;
            $this->load->library( 'upload', $config );
            $this->upload->do_upload( 'file' );
            $data = array( 'upload_data'=> $this->upload->data() );
            $image = $this->upload->data( 'file_name' );
            if($image != ''){
                $data = array(
                    'title'      => $this->input->post('title'),
                    'image'      => $image,
                    'pdf_file'        => $pdf,
                    'description'=> $this->input->post('description'),
                );
            }
            else {
                $data = array(
                    'title'      => $this->input->post('title'),
                    'pdf_file'        => $pdf,
                    'description'=> $this->input->post('description'),
                );
            }
        
        	if($this->db->field_exists('event_date', 'event')) {
            	$data['event_date'] = $this->input->post('event_date');
            }
            $res = $this->Cms_model->updateEventFestival($id, 'event', $data);
            $msg = "Content Saved";
            redirect('cms/viewEventFestival');
        }
    }
	public function deleteEventFestival($id){
	    $result=$this->Cms_model->deleteEventFestival($id);
	    $msg="Deleted";
	    redirect('cms/viewEventFestival');
	}

		//NEWS

		public function addNews(){
			$this->form_validation->set_rules('title', 'News Title', 'required');
			if ($this->form_validation->run() === FALSE){
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/news/addNews');
				$this->load->view('admin/layouts/admin_footer');
			}
			else{
	
				date_default_timezone_set( 'Asia/Calcutta' );
				$date = date( 'Y-m-d H:i:s' );
	
				$config['upload_path'] = 'uploads/news/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']    = 1024;
	
				$this->load->library( 'upload', $config );
				$this->upload->do_upload( 'file' );
	
				$data = array( 'upload_data'=> $this->upload->data() );
				$file = $this->upload->data( 'file_name' );
	
				$data = array(
					'title'      =>$this->input->post('title'),
					'image'     =>$file,
					'description'   =>$this->input->post('description'),
	
					'created'         =>$date,
	
				);
				
				$res=$this->Cms_model->addNews($data);
				$msg="Content Saved";
				redirect('cms/viewNews');
			}
			
		}
		
		public function viewNews(){
			$data['news']=$this->Cms_model->getNews();
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/news/viewNews',$data);
			$this->load->view('admin/layouts/admin_footer');
		}
		
		public function editNews($id){
	    $data['news']=$this->Cms_model->getNewsData($id);
	    $this->load->view('admin/layouts/admin_header');
	    $this->load->view('admin/news/editNews',$data);
	    $this->load->view('admin/layouts/admin_footer');
	}
	
	public function updateNews($id){
	    $this->form_validation->set_rules('title', 'News Title', 'required');
	    if ($this->form_validation->run() === FALSE){
	        $this->load->view('admin/layouts/admin_header');
	        $this->load->view('admin/news/viewNews');
	        $this->load->view('admin/layouts/admin_footer');
		}
		else{

			date_default_timezone_set( 'Asia/Calcutta' );
            $date = date( 'Y-m-d H:i:s' );

            $config['upload_path'] = 'uploads/news/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']    = 1024;

            $this->load->library( 'upload', $config );
            $this->upload->do_upload( 'file' );

            $data = array( 'upload_data'=> $this->upload->data() );
            $file = $this->upload->data( 'file_name' );

			if($file!=''){
            $data = array(
				'title'      =>$this->input->post('title'),
					'image'     =>$file,
					'description'   =>$this->input->post('description'),

			);
		}
		else 
		{
			$data = array(
				'title'      =>$this->input->post('title'),
	            // 'image'     =>$file,
				'description'   =>$this->input->post('description'),

			);

		}
	        $res=$this->Cms_model->updateNews($id,'news',$data);
	        $msg="Content Saved";
	        redirect('cms/viewNews');
	    }
	    
	}	
	
	
		public function deleteNews($id){
			$result=$this->Cms_model->deleteNews($id);
			$msg="Deleted";
			redirect('cms/viewNews');
		}
	
		
		//ANNOUNCEMENTS

		public function addAnnouncements(){
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() === FALSE){
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/announcements/addAnnouncements');
				$this->load->view('admin/layouts/admin_footer');
			}
			else{
	
				date_default_timezone_set( 'Asia/Calcutta' );
				$date = date( 'Y-m-d H:i:s' );
	
				$data = array(
					'title'      =>$this->input->post('title'),
					'description'   =>$this->input->post('description'),
	
					'created'         =>$date,
	
				);
				
				$res=$this->Cms_model->addAnnouncements($data);
				$msg="Content Saved";
				redirect('cms/viewAnnouncements');
			}
			
		}
		
		public function viewAnnouncements(){
			$data['announcements']=$this->Cms_model->getAnnouncements();
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/announcements/viewAnnouncements',$data);
			$this->load->view('admin/layouts/admin_footer');
		}
		
		public function editAnnouncements($id){
			$data['announcements']=$this->Cms_model->getAnnouncementData($id);
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/announcements/editAnnouncements',$data);
			$this->load->view('admin/layouts/admin_footer');
		}
		
		public function updateAnnouncements($id){
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() === FALSE){
				$this->load->view('admin/layouts/admin_header');
				$this->load->view('admin/announcements/viewAnnouncements');
				$this->load->view('admin/layouts/admin_footer');
			}
			else{
	
				date_default_timezone_set( 'Asia/Calcutta' );
				$date = date( 'Y-m-d H:i:s' );
	
				$data = array(
					'title'      =>$this->input->post('title'),
					'description'   =>$this->input->post('description'),
	
	
				);
	
				
			}
			
				$res=$this->Cms_model->updateAnnouncements($id,'announcements',$data);
				$msg="Content Saved";
				redirect('cms/viewAnnouncements');
			}
			
			
		public function deleteAnnouncements($id){
			$result=$this->Cms_model->deleteAnnouncements($id);
			$msg="Deleted";
			redirect('cms/viewAnnouncements');
		}

			//TEMPLE RULES
			
			public function addTempleRules(){
				$this->form_validation->set_rules('title', 'Title', 'required');
				if ($this->form_validation->run() === FALSE){
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/rules/addTempleRules');
					$this->load->view('admin/layouts/admin_footer');
				}
				else{
		
					date_default_timezone_set( 'Asia/Calcutta' );
					$date = date( 'Y-m-d H:i:s' );
		
					$data = array(
						'title'      =>$this->input->post('title'),
						'rules'   =>$this->input->post('rules'),
		
						'created'         =>$date,
		
					);
					
					$res=$this->Cms_model->addTempleRules($data);
					$msg="Content Saved";
					redirect('cms/viewTempleRules');
				}
				
			}
			public function viewTempleRules(){
				$this->form_validation->set_rules('title', 'Title', 'required');
				if ($this->form_validation->run() === FALSE){
					$data['rules']=$this->Cms_model->getTempleRules();
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/rules/editTempleRules',$data);
					$this->load->view('admin/layouts/admin_footer');
				}
				else{
		
			
					$data = array(
						'title'      =>$this->input->post('title'),
						'rules'   =>$this->input->post('rules'),
		
					);
					$res=$this->Cms_model->editTempleRules($data);
					$msg="Content Saved";
					redirect('cms/viewTempleRules');
				}
				
			}
		
			
			public function deleteTempleRules($id){
				$result=$this->Cms_model->deleteTempleRules($id);
				$msg="Deleted";
				redirect('cms/viewTempleRules');
			}
			
			
		public function addTempleTiming()
	    {
		$this->form_validation->set_rules('title', 'Title', 'required');
	    if ($this->form_validation->run() === FALSE){
    	    $data['temple_time']=$this->Cms_model->gettemple_time();
    		$this->load->view('admin/layouts/admin_header');
    		$this->load->view('admin/templeTiming/addTempleTiming',$data);
    		$this->load->view('admin/layouts/admin_footer');
		}
		else{
            date_default_timezone_set( 'Asia/Calcutta' );
			$date = date( 'Y-m-d H:i:s' );
			$data = array(
				'title'      =>$this->input->post('title'),
				'rules'      =>$this->input->post('rules'),
				'created'    =>$date,
			);
	        $res=$this->Cms_model->addTempleTiming($data);
	        $msg="Content Saved";
	        redirect('cms/addTempleTiming');
	    }
       
	}
	
	public function updatePoojaTime()
    {
	$this->form_validation->set_Rules("name2","Group Name","required");
	$this->form_validation->set_Rules("pdtp_id","ID","required");

				if($this->form_validation->Run()==false)
					{
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/templeTiming/addTempleTiming',$data);
		$this->load->view('admin/layouts/admin_footer');
					}
					else
					{
	$id=$this->input->post('pdtp_id');
	$data=array(
		'pooja_name'      =>$this->input->post('name2'),
		'pooja_time'      =>$this->input->post('time2'),
	   );
	$this->Cms_model->updatePoojaTime($id,$data);
	redirect('cms/addTempleTiming');
					}

}

public function deletePoojaTime($id)
{

	$data=array(
	'is_delete'  =>1,
	);	
	
	$res=$this->Cms_model->updatePoojaTime($id,$data);
	redirect('cms/addTempleTiming');

}

	
		// Site Settings

		public function viewSitesetting(){
		    $data['site_settings'] = $this->Cms_model->getSitesettings();
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/sitesetting/viewSiteSetting',$data);
			$this->load->view('admin/layouts/admin_footer');
		}

		public function updatePaymentgateway()
        {
            $data['payment_gateways'] = $this->Cms_model->getPaymentGatway();
            $site_settings = $this->Cms_model->getSitesettings();

            $data['payment_gateway'] = $this->Cms_model->getPaymentGatwayById($site_settings[0]->payment_gateway);
            $data['razorpay'] = $this->Cms_model->getRazorpayCredentials();
            $data['eazypay'] = $this->Cms_model->getEazypayCredentials();
            $data['worldline'] = $this->Cms_model->getWorldlineCredentials();
            $data['currencies'] = $this->Cms_model->getCurrencies();
            
            $this->load->view('admin/layouts/admin_header');
    		$this->load->view('admin/sitesetting/addPaymentgateway', $data);
    		$this->load->view('admin/layouts/admin_footer');
    
        }
        
        
        public function addPaymentgateway(){ 
            
            $credentials = array();
            
            $payment_gateway = $this->input->post('payment_gateway');
            
            $gateway = array(
                    'payment_gateway' => $payment_gateway
                );
            
            if($payment_gateway == 1) {
                $key_id = $this->input->post('key_id');
                $key_secret = $this->input->post('key_secret');
                
                $credentials['key_id'] = $key_id;
                $credentials['key_secret'] = $key_secret;
            } else if($payment_gateway == 2) {
                $encryption_key = $this->input->post('e_encryption_key');
                $merchant_id = $this->input->post('e_merchant_id');
                $sub_merchant_id = $this->input->post('e_sub_merchant_id');
                $paymode = $this->input->post('e_paymode');
                $return_url = $this->input->post('e_return_url');

                $credentials['encryption_key'] = $encryption_key;
                $credentials['merchant_id'] = $merchant_id;
                $credentials['sub_merchant_id'] = $sub_merchant_id;
                $credentials['paymode'] = $paymode;
                $credentials['return_url'] = $return_url;
            } else if($payment_gateway == 3) {
                $encryption_key = $this->input->post('encryption_key');
                $merchant_id = $this->input->post('merchant_id');
                $transaction_type = $this->input->post('transaction_type');
                $currency = $this->input->post('currency');
                $return_url = $this->input->post('return_url');
                
                $credentials['encryption_key'] = $encryption_key;
                $credentials['merchant_id'] = $merchant_id;
                $credentials['transaction_type'] = $transaction_type;
                $credentials['currency'] = $currency;
                $credentials['return_url'] = $return_url;
            }
            
            $this->Cms_model->updatePaymengateway($gateway, $credentials);
            redirect('cms/viewSitesetting');
		}


		public function updateSmsSettings()
        {
        	$this->form_validation->set_Rules("sms_settings","SMS Settings","required");
            $site_settings = $this->Cms_model->getSitesettings();
            $data['site_settings'] = $site_settings;
        	if($this->form_validation->Run()==false)
			{
            	$this->load->view('admin/layouts/admin_header');
    			$this->load->view('admin/sitesetting/smsSettings', $data);
    			$this->load->view('admin/layouts/admin_footer');
            } else {
            	if ($this->input->post('sms_settings') == 'yes') {
                	$status = 1;
                } else {
                	$status = 0;
                }
            
            	$settings = array('sms_notification'=> $status);
            	$this->Cms_model->updateSmsSettings($settings);
            	redirect('cms/viewSitesetting');
            }
        }

			//SITE SETTINGS
	
	
	public function uploadImage()
    {
        $this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/sitesetting/addBgimage');
		$this->load->view('admin/layouts/admin_footer');

    }

		public function addBgimage(){ 
	
			$config['upload_path'] = 'uploads/bgimg/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			$this->load->library( 'upload', $config );
			$this->upload->do_upload( 'file' );


		    $data = $this->upload->data();
    		$file_name = '/uploads/bgimg/' . $data['file_name']; 

            
           $this->Cms_model->updateBgimage($file_name);
            redirect('cms/viewSitesetting');
		}
		
		

		
	
    	public function uploadSong()
        {
            $this->load->view('admin/layouts/admin_header');
    		$this->load->view('admin/sitesetting/addSong');
    		$this->load->view('admin/layouts/admin_footer');
    
        }

		
public function addSong() {
    $config['upload_path'] = 'uploads/openingsong/';
    $config['allowed_types'] = 'mp3|wav|ogg|aac';


    $this->load->library('upload', $config);
    $this->upload->do_upload('file');

    $data = $this->upload->data();
    $file_name = '/uploads/openingsong/' . $data['file_name']; 

    $this->Cms_model->updateSong($file_name);
    redirect('cms/viewSitesetting');
}
		public function uploadAsideimage()
        {
            $this->load->view('admin/layouts/admin_header');
    		$this->load->view('admin/sitesetting/addAsideimage');
    		$this->load->view('admin/layouts/admin_footer');
    
        }

		
		public function addAsideimage(){ 
	
			$config['upload_path'] = 'uploads/asideimg/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			$this->load->library( 'upload', $config );
			$this->upload->do_upload( 'file' );


		    $data = $this->upload->data();
    		$file_name = '/uploads/asideimg/' . $data['file_name']; 

    		$this->Cms_model->updateAsideimage($file_name);
    		redirect('cms/viewSitesetting');
		}

		public function uploadSmallbanner()
        {
            $this->load->view('admin/layouts/admin_header');
    		$this->load->view('admin/sitesetting/addSmallbanner');
    		$this->load->view('admin/layouts/admin_footer');
    
        }

		public function addSmallbanner(){ 
	
			$config['upload_path'] = 'uploads/smallbanner/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			$this->load->library( 'upload', $config );
			$this->upload->do_upload( 'file' );


		    $data = $this->upload->data();
    		$file_name = '/uploads/smallbanner/' . $data['file_name']; 

    		$this->Cms_model->updateSmallbanner($file_name);
    		redirect('cms/viewSitesetting');
		}

		public function uploadVideolink()
        {
            $this->load->view('admin/layouts/admin_header');
    		$this->load->view('admin/sitesetting/addVideolink');
    		$this->load->view('admin/layouts/admin_footer');
    
        }

		
        public function addVideolink(){ 
            $video_link = $this->input->post('video_link');
        
            $this->Cms_model->updateVideolink($video_link);
        
            redirect('cms/viewSitesetting');
        }
        
        public function uploadTypingtext()
        {
            $this->load->view('admin/layouts/admin_header');
    		$this->load->view('admin/sitesetting/addTypingtext');
    		$this->load->view('admin/layouts/admin_footer');
    
        }

		
        public function addTypingtext(){ 
            $typing_text = $this->input->post('typing_text');
        
            $this->Cms_model->updateTypingtext($typing_text);
        
            redirect('cms/viewSitesetting');
        }

		public function database_backup($logout=null) {
        	date_default_timezone_set("Asia/Kolkata");
        	$NAME=$this->db->database;
			$this->load->dbutil();
        	$date = date('dMYHis');
        
			$prefs = array(
				'format' => 'zip',
				'filename' => $NAME.$date.'.sql'
			);
			$backup =& $this->dbutil->backup($prefs);
			$db_name = $NAME.$date.'.zip';
			// $save = 'assets/backups/databases/'.$db_name;
			// $this->load->helper('file');
			// write_file($save, $backup);
			$this->load->helper('download');
			force_download($db_name, $backup); 
            
        	if($logout) {
            	redirect('admin/admin/logout');
            } 
        }

		public function database_backup_ajax() {
        	date_default_timezone_set("Asia/Kolkata");
        	$NAME=$this->db->database;
			$this->load->dbutil();
        	$date = date('dMYHis');
        
			$prefs = array(
				'format' => 'zip',
				'filename' => $NAME.$date.'.sql'
			);
			$backup =& $this->dbutil->backup($prefs);
			$db_name = $NAME.$date.'.zip';
			// $save = 'assets/backups/databases/'.$db_name;
			// $this->load->helper('file');
			// write_file($save, $backup);
			$this->load->helper('download');
			force_download($db_name, $backup);

   			$this->session->sess_destroy();
        	redirect('admin/','refresh');
        }

	// SLIDER

	public function addSlider() {
		$this->form_validation->set_rules('title', 'Title', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/slider/addSlider');
			$this->load->view('admin/layouts/admin_footer');
		} else {
			date_default_timezone_set('Asia/Calcutta');
			$date = date('Y-m-d H:i:s');
			$type = $this->input->post('type'); // 'image' or 'video'

			$data = array(
				'title' => $this->input->post('title'),
				'type' => $type,
				'description' => $this->input->post('description'),
				'display_order' => $this->input->post('display_order'),
				'created' => $date,
			);

			if ($type === 'video') {
				$data['video_url'] = $this->input->post('video_url');
				$data['image'] = null;
			} else {
				$config['upload_path'] = 'uploads/slider/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('file')) {
					$data['image'] = $this->upload->data('file_name');
				}
				$data['video_url'] = null;
			}

			$res = $this->Cms_model->addSlider($data);
			redirect('cms/viewSlider');
		}
	}
	
	public function viewSlider() {
		$data['slider'] = $this->Cms_model->getSlider();
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/slider/viewSlider', $data);
		$this->load->view('admin/layouts/admin_footer');
	}
	
	public function editSlider($id) {
		$data['slider'] = $this->Cms_model->getSliderData($id);
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/slider/editSlider', $data);
		$this->load->view('admin/layouts/admin_footer');
	}
	
	public function updateSlider($id) {
		$this->form_validation->set_rules('title', 'Title', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/layouts/admin_header');
			$this->load->view('admin/slider/editSlider');
			$this->load->view('admin/layouts/admin_footer');
		} else {
			date_default_timezone_set('Asia/Calcutta');
			$type = $this->input->post('type');

			$data = array(
				'title' => $this->input->post('title'),
				'type' => $type,
				'description' => $this->input->post('description'),
				'display_order' => $this->input->post('display_order'),
			);

			if ($type === 'video') {
				$data['video_url'] = $this->input->post('video_url');
				$data['image'] = null;
			} else {
				$config['upload_path'] = 'uploads/slider/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('file')) {
					$data['image'] = $this->upload->data('file_name');
				}
				$data['video_url'] = null;
			}

			$res = $this->Cms_model->updateSlider($id, $data);
			redirect('cms/viewSlider');
		}
	}	
	
	public function deleteSlider($id) {
		$result = $this->Cms_model->deleteSlider($id);
		redirect('cms/viewSlider');
	}

}