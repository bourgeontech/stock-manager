<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->date=date('Y-m-d');
    }


	//ABOUT US
	
	public function addContent($data)
      {

	$res=$this->db->insert("aboutus",$data);
	return $res;
	
  }	

  public function getcontent(){
	$this->db->select('*');
	$this->db->from('aboutus');
	$this->db->where('is_delete !=', 1);
	$this->db->order_by('abtId', 'desc');
	$this->db->limit(1);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array();
	}
	else {
		return 0;
	}
}
public function getContentData($id){
	$this->db->select('*');
	$this->db->from('aboutus');
	$this->db->where('abtId', $id);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array();
	}
	else {
		return 0;
	}
}

public function updateContent($id,$table,$data){
	$this->db->where('abtId', $id);
	$result=$this->db->update($table,$data);
	return $result;
}

public function deleteContent($id){

	$data = array(
		'is_delete'         =>1,

	);
	$this->db->where('abtId', $id);
	$result=$this->db->update('aboutus',$data);
	return $result;
}

//BANNER
	
public function addBanner($data)
{

$res=$this->db->insert("banner",$data);
return $res;

}	

public function getBanner(){
$this->db->select('*');
$this->db->from('banner');
$this->db->where('is_delete !=', 1);
$this->db->order_by('display_order', 'desc');
$query = $this->db->get();
if ($query->num_rows() > 0) {
  return $query->result_array();
}
else {
  return 0;
}
}

public function deleteBanner($id){

	$data = array(
		'is_delete'         =>1,

	);
	$this->db->where('id', $id);
	$result=$this->db->update('banner',$data);
	return $result;
}

//GALLERY
public function getgal_category(){
	$this->db->select('*');
	$this->db->from('gallery');
	$this->db->order_by('gal_Id');
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array();
	}
	else {
		return 0;
	}
}

  public function addGallery($data)
      {

	$res=$this->db->insert("gallery",$data);
	return $res;
	
  }	
  public function getGallery(){
	$this->db->select('*');
	$this->db->from('gallery');
	$this->db->where('is_delete !=', 1);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array();
	}
	else {
		return 0;
	}
}

	public function getImageCategories(){
		$this->db->select('*');
		$this->db->from('image_categories');
		$query = $this->db->get();
    
    	return $query->result();
	}

	public function getImageCategory($id){
		$this->db->select('*');
		$this->db->from('image_categories');
    	$this->db->where('id', $id);
		$query = $this->db->get();
    
    	return $query->row();
	}

public function getGalleryData($id){
	$this->db->select('*');
	$this->db->from('gallery');
	$this->db->where('gal_Id', $id);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array();
	}
	else {
		return 0;
	}
}

public function updateGallery($id,$table,$data){

	$this->db->where('gal_Id', $id);
	$result=$this->db->update($table,$data);
	return $result;
}
public function deleteGallery($id){

	$data = array(
		'is_delete'         =>1,

	);
	$this->db->where('gal_Id', $id);
	$result=$this->db->update('gallery',$data);
	return $result;
}


//VIDEO 

  public function addVideo($data)
      {

	$res=$this->db->insert("video",$data);
	return $res;
	
  }	

  public function getVideo(){
	$this->db->select('*');
	$this->db->from('video');
	$this->db->where('is_delete !=', 1);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array();
	}
	else {
		return 0;
	}
}
public function getVideoData($id){
	$this->db->select('*');
	$this->db->from('video');
	$this->db->where('vid_Id', $id);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array();
	}
	else {
		return 0;
	}
}

public function deleteVideo($id){

	$data = array(
		'is_delete'         =>1,

	);
	$this->db->where('vid_Id', $id);
	$result=$this->db->update('video',$data);
	return $result;
}

//CONTACT
public function addContact($data)
      {

    $this->db->select('*');
	$this->db->from('contact');
	$this->db->order_by('c_Id');
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
        $this->db->update('contact', $data);
	}
	else {
		$res=$this->db->insert("contact",$data);
	return $res;
    }
    
	// $res=$this->db->insert("contact",$data);
	// return $res;
	
  }	

public function getContact(){
	$this->db->select('*');
	$this->db->from('contact');
	$this->db->order_by('c_Id');
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array();
	}
	else {
		return 0;
	}
}

public function editContact($data){

	$result=$this->db->update('contact',$data);
	return $result;
}


	// PRIEST
	
	public function addPriest($data)
      {

	$res=$this->db->insert("priest",$data);
	return $res;
	
  }	
  public function getPriest(){
	$this->db->select('*');
	$this->db->from('priest');
	$this->db->where('is_delete !=', 1);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array();
	}
	else {
		return 0;
	}
}

public function getPriestData($id){
	$this->db->select('*');
	$this->db->from('priest');
	$this->db->where('priestId', $id);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array();
	}
	else {
		return 0;
	}
}

public function updatePriest($id,$table,$data){
	$this->db->where('priestId', $id);
	$result=$this->db->update($table,$data);
	return $result;
}


public function deletePriest($id){

	$data = array(
		'is_delete'         =>1,

	);
	$this->db->where('priestId', $id);
	$result=$this->db->update('priest',$data);
	return $result;
}

	// TRUSTEE
	
	public function addTrustee($data)
      {

	$res=$this->db->insert("trustee",$data);
	return $res;
	
  }	
  public function getTrustee(){
	$this->db->select('*');
	$this->db->from('trustee');
	$this->db->where('is_delete !=', 1);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array();
	}
	else {
		return 0;
	}
}

public function getTrusteeData($id){
	$this->db->select('*');
	$this->db->from('trustee');
	$this->db->where('trid', $id);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array();
	}
	else {
		return 0;
	}
}

public function updateTrustee($id,$table,$data){
	$this->db->where('trid', $id);
	$result=$this->db->update($table,$data);
	return $result;
}


public function deleteTrustee($id){

	$data = array(
		'is_delete'         =>1,

	);
	$this->db->where('priestId', $id);
	$result=$this->db->update('priest',$data);
	return $result;
}

	// FESTIVAL COMMITTEE
	
	public function addFestivalCommittee($data)
      {

	$res=$this->db->insert("festivalCommittee",$data);
	return $res;
	
  }	
  public function getFestivalCommittee(){
	$this->db->select('*');
	$this->db->from('festivalCommittee');
	$this->db->where('is_delete !=', 1);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array();
	}
	else {
		return 0;
	}
}

public function getFestivalCommitteeData($id){
	$this->db->select('*');
	$this->db->from('festivalCommittee');
	$this->db->where('id', $id);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array();
	}
	else {
		return 0;
	}
}

public function updateFestivalCommittee($id,$table,$data){
	$this->db->where('id', $id);
	$result=$this->db->update($table,$data);
	return $result;
}


public function deleteFestivalCommittee($id){

	$data = array(
		'is_delete'         =>1,

	);
	$this->db->where('id', $id);
	$result=$this->db->update('festivalCommittee',$data);
	return $result;
}

// PARIPALANA SAMITHI
	
public function addParipalanaSamithi($data)
{

$res=$this->db->insert("paripalanaSamithi",$data);
return $res;

}	
public function getParipalanaSamithi(){
$this->db->select('*');
$this->db->from('paripalanaSamithi');
$this->db->where('is_delete !=', 1);
$query = $this->db->get();
if ($query->num_rows() > 0) {
  return $query->result_array();
}
else {
  return 0;
}
}

public function getParipalanaSamithiData($id){
$this->db->select('*');
$this->db->from('paripalanaSamithi');
$this->db->where('id', $id);
$query = $this->db->get();
if ($query->num_rows() > 0) {
  return $query->result_array();
}
else {
  return 0;
}
}

public function updateParipalanaSamithi($id,$table,$data){
$this->db->where('id', $id);
$result=$this->db->update($table,$data);
return $result;
}


public function deleteParipalanaSamithi($id){

$data = array(
  'is_delete'         =>1,

);
$this->db->where('id', $id);
$result=$this->db->update('paripalanaSamithi',$data);
return $result;
}

//EVENT FESTIVAL

public function addEventFestival($data)
      {

	$res=$this->db->insert("event",$data);
	return $res;
	
  }	
  public function getEventFestival(){
	$this->db->select('*');
	$this->db->from('event');
	$this->db->where('is_delete !=', 1);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array();
	}
	else {
		return 0;
	}
}

public function getEventFestivalData($id){
	$this->db->select('*');
	$this->db->from('event');
	$this->db->where('id', $id);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array();
	}
	else {
		return 0;
	}
}

public function updateEventFestival($id,$table,$data){

	$this->db->where('id', $id);
	$result=$this->db->update($table,$data);
	return $result;
}

public function deleteEventFestival($id){

	$data = array(
		'is_delete'         =>1,

	);
	$this->db->where('id', $id);
	$result=$this->db->update('event',$data);
	return $result;
}

//NEWS

public function addNews($data)
      {

	$res=$this->db->insert("news",$data);
	return $res;
	
  }	
  public function getNews(){
	$this->db->select('*');
	$this->db->from('news');
	$this->db->where('is_delete !=', 1);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array();
	}
	else {
		return 0;
	}
}
public function getNewsData($id){
	$this->db->select('*');
	$this->db->from('news');
	$this->db->where('id', $id);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array();
	}
	else {
		return 0;
	}
}
public function deleteNews($id){

	$data = array(
		'is_delete'         =>1,

	);
	$this->db->where('id', $id);
	$result=$this->db->update('news',$data);
	return $result;
}

public function updateNews($id,$table,$data){

	$this->db->where('id', $id);
	$result=$this->db->update($table,$data);
	return $result;
}

//ANNOUNCEMENTS

public function addAnnouncements($data)
      {

	$res=$this->db->insert("announcements",$data);
	return $res;
	
  }	
  public function getAnnouncements(){
	$this->db->select('*');
	$this->db->from('announcements');
	$this->db->where('is_delete !=', 1);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array();
	}
	else {
		return 0;
	}
}

public function getAnnouncementData($id){
	$this->db->select('*');
	$this->db->from('announcements');
	$this->db->where('id', $id);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array();
	}
	else {
		return 0;
	}
}

public function updateAnnouncements($id,$table,$data){

	$this->db->where('id', $id);
	$result=$this->db->update($table,$data);
	return $result;
}

public function deleteAnnouncements($id){

	$data = array(
		'is_delete'         =>1,

	);
	$this->db->where('id', $id);
	$result=$this->db->update('news',$data);
	return $result;
}

//TEMPLE RULES

public function addTempleRules($data)
      {
		$this->db->select('*');
		$this->db->from('rules');
		$this->db->order_by('id');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$this->db->update('rules', $data);
		}
		else {
			$res=$this->db->insert("rules",$data);
		return $res;
		}

	// $res=$this->db->insert("rules",$data);
	// return $res;
	
  }	
  public function getTempleRules(){
	$this->db->select('*');
	$this->db->from('rules');
	$this->db->where('is_delete !=', 1);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array();
	}
	else {
		return 0;
	}
}
public function editTempleRules($data){

	$result=$this->db->update('rules',$data);
	return $result;
}

public function deleteTempleRules($id){

	$data = array(
		'is_delete'         =>1,

	);
	$this->db->where('id', $id);
	$result=$this->db->update('rules',$data);
	return $result;
}
//TEMPLE TIME
public function gettemple_time()
{
	$query=$this->db->query("SELECT * FROM `temple_timing`");
	return $query->result_array();

}

public function addTempleTiming($data)
      {
    $this->db->select('*');
	$this->db->from('temple_timing');
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
	    $id="1";
	    $this->db->where('id',$id);
		$this->db->update('temple_timing', $data);
	}
	else {
		$res=$this->db->insert("temple_timing",$data);
	    return $res;
	}
  }	
  public function updatePoojaTime($id,$data)
{
	$this->db->where('id',$id);
		$this->db->update("temple_timing",$data);
		return true;
}
//ADVERTISEMENT
	
public function addAdvertisement($data)
{

$res=$this->db->insert("advertisement",$data);
return $res;

}	

public function getAdvertisement(){
	$this->db->select('*');
	$this->db->from('advertisement');
	$this->db->where('is_delete !=', 1);
	$this->db->order_by('display_order', 'desc');
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
	  return $query->result_array();
	}
	else {
	  return 0;
	}
	}
	
	public function deleteAdvertisement($id){
	
		$data = array(
			'is_delete'         =>1,
	
		);
		$this->db->where('id', $id);
		$result=$this->db->update('advertisement',$data);
		return $result;
	}
 //CMS
 
	public function getSitesettings(){
        $this->db->select('site_settings.*');
        $this->db->from('site_settings');
        // $this->db->join('payment_gateway', 'site_settings.payment_gateway=payment_gateway.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function updateBgimage($file_name)
    {
        $data = array(
            'bgimage' => $file_name
        );
        $this->db->where('id', 1);
        $this->db->update('site_settings', $data);
    }
    
        public function updateSong($file_name)
    {
        $data = array(
            'opening_song' => $file_name
        );
        $this->db->where('id', 1);
        $this->db->update('site_settings', $data);
    }

    public function updateAsideimage($file_path)
    {
        $data = array(
            'asideimage' => $file_path
        );
        $this->db->where('id', 1);
        $this->db->update('site_settings', $data);
    }
    
    public function updateSmallbanner($file_path)
    {
        $data = array(
            'small_banner' => $file_path
        );
        $this->db->where('id', 1);
        $this->db->update('site_settings', $data);
    }
    public function updateVideolink($video_link){
        $data = array(
            'video_link' => $video_link
        );
        $this->db->where('id', 1);
        $this->db->update('site_settings', $data);
    }
    
    public function updateTypingtext($typing_text){
        $data = array(
            'typing_text' => $typing_text
        );
        $this->db->where('id', 1);
        $this->db->update('site_settings', $data);
    }

   

    
    // Payment Gatways
    public function getPaymentGatwayById($id){
        $this->db->select('*');
        $this->db->from('payment_gateway');
    	$this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
			return $query->result();
		}
		else {
			return 0;
		}
    }

    public function getPaymentGatway(){
        $this->db->select('*');
        $this->db->from('payment_gateway');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function updatePaymengateway($gateway, $credentials){
        $this->db->where('id', 1);
        $this->db->update('site_settings', $gateway);

        if ($gateway['payment_gateway'] == 1) {
            $query = $this->db->get('razorpay');

            if ($query->num_rows() > 0) {
                // Record exists, perform update
                $this->db->set($credentials);
                $this->db->update('razorpay');
            } else {
                // No record exists, perform insert
                $this->db->insert('razorpay', $credentials);
            }
            // $this->db->update('razorpay', $credentials);
        } else if ($gateway['payment_gateway'] == 2) {
            $query = $this->db->get('eazypay');

            if ($query->num_rows() > 0) {
                // Record exists, perform update
                $this->db->set($credentials);
                $this->db->update('eazypay');
            } else {
                // No record exists, perform insert
                $this->db->insert('eazypay', $credentials);
            }
        } else if ($gateway['payment_gateway'] == 3) {
            $query = $this->db->get('worldline');

            if ($query->num_rows() > 0) {
                // Record exists, perform update
                $this->db->set($credentials);
                $this->db->update('worldline');
            } else {
                // No record exists, perform insert
                $this->db->insert('worldline', $credentials);
            }
        }
        
    }
    
    public function getCurrencies(){
        $this->db->select('*');
        $this->db->from('currency_codes');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getWorldlineCredentials(){
        $this->db->select('*');
        $this->db->from('worldline');
        $query = $this->db->get();
        return $query->result();
    }

    public function getEazypayCredentials(){
        $this->db->select('*');
        $this->db->from('eazypay');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getRazorpayCredentials(){
        $this->db->select('*');
        $this->db->from('razorpay');
        $query = $this->db->get();
        return $query->result();
    }

	public function updateSmsSettings($sms_settings){
        $this->db->where('id', 1);
        $this->db->update('site_settings', $sms_settings);
        
    }

	// SLIDER
	public function addSlider($data) {
		$res=$this->db->insert("slider", $data);
		return $res;
	}

	public function getSlider() {
		$this->db->select('*');
		$this->db->from('slider');
		$this->db->where('is_delete !=', 1);
		$this->db->order_by('display_order', 'desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return 0;
		}
	}

	public function getSliderData($id) {
		$this->db->select('*');
		$this->db->from('slider');
		$this->db->where('id', $id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return 0;
		}
	}

	public function updateSlider($id, $data) {
		$this->db->where('id', $id);
		$result = $this->db->update('slider', $data);
		return $result;
	}

	public function deleteSlider($id) {
		$data = array(
			'is_delete' => 1,
		);
		$this->db->where('id', $id);
		$result = $this->db->update('slider', $data);
		return $result;
	}
}