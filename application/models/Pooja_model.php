<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Pooja_model extends CI_Model {

		public function getCategories() {
        	$this->db->select('id, name, name_mal');
        	$this->db->from('cat');
        	$query = $this->db->get();
            $result = $query->result();
            return $result;
        }

		public function getBlockedPooja() {
        	$this->db->select('diety_pooja.*,pooja.name as pooja,pooja.id as pooja_id,diety.name as deity,pooja.name_mal as pooja_mal,pooja.rate as rate,pooja.code,pooja.time as time');
            $this->db->from('diety_pooja');
            $this->db->join('pooja','pooja.id = diety_pooja.pooja_id');
        	$this->db->join('diety','diety.id = diety_pooja.temple_id');
        	$this->db->where('pooja.block=1');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }

		public function getPooja() {
        	$this->db->select('diety_pooja.*,pooja.name as name,pooja.id as id,diety.name as deity,pooja.name_mal as name_mal,pooja.rate as rate,pooja.code,pooja.time as time, pooja.allowed_qty as allowed_qty, pooja.block as block, pooja.isImp as important');
            $this->db->from('diety_pooja');
            $this->db->join('pooja','pooja.id = diety_pooja.pooja_id');
        	$this->db->join('diety','diety.id = diety_pooja.temple_id');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }

		public function getbills($from_date, $to_date, $deity_id, $pooja_id) {
        	$this->db->select('billing.id as bill_no, billing.date as bill_date, billing_dtls.name as name, stars.name_eng as star_eng, stars.name_mal as star_mal, billing_dtls.date as pooja_date, SUM(billing_dtls.amount) as amount');
        	$this->db->from('billing_dtls');
        	$this->db->join('billing', 'billing_dtls.bill_id = billing.id');
        	$this->db->join('diety', 'billing_dtls.diety_id = diety.id');
        	$this->db->join('pooja', 'billing_dtls.pooja = pooja.id');
        	$this->db->join('stars', 'billing_dtls.star = stars.id');
        	$this->db->where('billing_dtls.pooja', $pooja_id);
        	$this->db->where('billing.date >=', $from_date);
			$this->db->where('billing.date <=', $to_date);
        	$this->db->where('billing.deleted = 0');
        	$this->db->group_by('billing_dtls.bill_id');
        	$query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }

		public function getPoojaById($id) {
        	$this->db->select('name, name_mal');
        	$this->db->from('pooja');
        	$this->db->where('id', $id);
        	$query = $this->db->get();
            if ($query->num_rows() > 0) {
            	$result = $query->row();
                return $result->name_mal;
            }
            else {
                return 0;
            }
        }

		public function getDeityById($id) {
        	$this->db->select('name, name_mal');
        	$this->db->from('diety');
        	$this->db->where('id', $id);
        	$query = $this->db->get();
            if ($query->num_rows() > 0) {
            	$result = $query->row();
                return $result->name_mal;
            }
            else {
                return 0;
            }
        }

		public function getParentPooja() {
        	$this->db->select('pooja.name as name,pooja.id as id,pooja.name_mal as name_mal,pooja.rate as rate,pooja.code,pooja.time as time, pooja.allowed_qty as allowed_qty, pooja.block as block');
            $this->db->from('pooja');
            $this->db->where('parent_id', NULL);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }

		public function getUnassignedPooja($id) {
        	$this->db->select('pooja.name as name,pooja.id as id,pooja.name_mal as name_mal,pooja.rate as rate,pooja.code,pooja.time as time, pooja.allowed_qty as allowed_qty, pooja.block as block');
            $this->db->from('pooja');
            $this->db->where('id != ', $id);
        	$this->db->where('parent_id', NULL);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }

		public function getPoojaByParentId($id) {
        	$this->db->select('pooja.name as name,pooja.id as id,pooja.name_mal as name_mal,pooja.rate as rate,pooja.code,pooja.time as time, pooja.allowed_qty as allowed_qty, pooja.block as block');
            $this->db->from('pooja');
        	$this->db->where('parent_id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }

		public function getPoojaByKeyword($keyword, $date) {
        	$this->db->select('pooja.name as name,pooja.id as id,pooja.name_mal as name_mal,pooja.rate as rate,pooja.code,pooja.time as time, pooja.allowed_qty as allowed_qty');
        	$this->db->from('pooja');
        	$this->db->where('code', $keyword);
        	// $this->db->where('parent_id', $id);

            $query = $this->db->get();
            if ($query->num_rows() > 0) {
            	$pooja_data = $query->result_array();
            	$pooja_id   = $pooja_data[0]['id'];

            	return $pooja_data;
            }
            else {
                return 0;
            }
        }

		

		public function getParentByPoojaId($id) {
        	// $this->db->select('parent_id');
        	// $this->db->from('pooja');
        	// $this->db->where('id', $id);
        	// $query = $this->db->get();
        	// if ($query->num_rows() > 0) {
        	// $parent_id = $query->row()->parent_id;
        	// $this->db->select('pooja.name as name,pooja.id as id,pooja.name_mal as name_mal,pooja.rate as rate,pooja.code,pooja.time as time, pooja.allowed_qty as allowed_qty, pooja.block as block');
        	// $this->db->from('pooja');
        	// 	$this->db->where('parent_id', $id);
        	// $query = $this->db->get();
        	// if ($query->num_rows() > 0) {
        	// return $query->result_array();
        	// }
        	// else {
        	// return 0;
        	// }
        	// }
        	// else {
        	// return 0;
        	// }
        	// 
        	$this->db->select('*');
        	$this->db->from('pooja p1');
        	$this->db->join('pooja p2', 'p1.parent_id= p2.id');
        	$this->db->where('p1.id', $id);
        	$query = $this->db->get();
        	if ($query->num_rows() > 0) {
        		return $query->result_array();
        	}
        	else {
        		return 0;
        	}
        }

		public function getparentpoojas($deity_id=null) {
        	$this->db->select('pooja.id as id, pooja.name as pooja,pooja.name_mal as pooja_mal,pooja.rate as pooja_rt,pooja.code');
            $this->db->from('pooja');
        	$this->db->join('pooja AS p', 'pooja.id = p.parent_id', 'INNER');
        	$this->db->join('diety_pooja', 'pooja.id = diety_pooja.pooja_id');
        	$this->db->join('diety', 'diety.id=diety_pooja.temple_id');
            $this->db->where('pooja.parent_id', NULL);
        	// if($deity_id) {
        	// $this->db->where('diety.id', $deity_id);
        	// }
        	
        	$this->db->group_by('pooja.id');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }

		public function getotherpoojas($deity_id=null) {
        	$this->db->select('pooja.id as id, pooja.name as pooja,pooja.name_mal as pooja_mal,pooja.rate as pooja_rt,pooja.code');
            $this->db->from('pooja');
        	// $this->db->join('pooja AS p', 'pooja.id = p.parent_id', 'INNER');
        	$this->db->join('diety_pooja', 'pooja.id = diety_pooja.pooja_id');
        	$this->db->join('diety', 'diety.id=diety_pooja.temple_id');
        	// $this->db->where('pooja.parent_id', NULL);
        	// $this->db->or_where('pooja.parent_id', 60);
        	if($deity_id) {
            	$this->db->where('diety.id', $deity_id);
            }
        	
        	$this->db->group_by('pooja.id');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }

		public function getPoojaProducts($pooja_id) {
        	$this->db->select('*');
        	$this->db->from('pooja_products');
        	$this->db->where('pooja_id', $pooja_id);
        	$query = $this->db->get();
        
        	if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }



		public function getImportantPooja() {
        	$this->db->select('pooja.name as name,pooja.id as id,pooja.name_mal as name_mal,pooja.rate as rate,pooja.code,pooja.time as time, pooja.allowed_qty as allowed_qty, pooja.block as block');
            $this->db->from('pooja');
            $this->db->where('isImp', 1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }
            else {
                return 0;
            }
        }

		public function getDeityPoojaById($id) {
        	$this->db->select('*');
        	$this->db->from('pooja');
        	$this->db->where('id', $id);
        	$query = $this->db->get();
            if ($query->num_rows() > 0) {
            	$pooja = $query->row();
                
                $this->db->select('temple_id');
                    $this->db->from('diety_pooja');
                    $this->db->where('pooja_id', $pooja->id);
                    $deity_id = $this->db->get()->row()->temple_id;
                
                return [
                        'name'=> $pooja->name,
                        'name_mal'=> $pooja->name_mal,
                        'rate'=> $pooja->rate,
                        'time'=> $pooja->time,
                		'row_count' => $pooja->rowcount,
                        'deity_id'=> $deity_id ?? 4
                     ];
            }
            else {
                return 0;
            }
        }

		public function getpoojacat($pooja_id) {
        	$this->db->select('*');
        	$this->db->from('pooja');
        	$this->db->where('id', $pooja_id);
        	$query = $this->db->get();
        
        	return $query->row()->pooja_cat;
        }
	
}
