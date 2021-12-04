<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daybook_model extends CI_Model {

	public function insert($tab,$arr){
		$this->db->insert($tab,$arr);
		if($this->db->affected_rows()>=1)
			return true;
		else
			return false;
	}


	public function check_user($tab,$condition){
		$this->db->select("*");
		$this->db->from($tab);
		$this->db->where($condition); 
		
		$q=$this->db->get();
		if($q->num_rows()>0){ return $q->result();}
		else{return false;}
	}

	public function fetch_user($tab,$condition){
		$this->db->select("*");
		$this->db->from($tab); //select * from table_name where condition;

		$this->db->where($condition); 
		$q = $this->db->get();
		
		return $q->result();
	}

	public function update($tab,$data,$condition){
		$this->db->update($tab,$data,$condition);
		if($this->db->affected_rows()>=1)
			return true;
		else
			return false;
	}

	//function to save entry in database
	public function insert_entry($tab,$arr,$condition){

		//condition 1 check entry is already present or not
		$this->db->select("*");
		$this->db->from($tab); //select * from table_name where condition;
		$this->db->where($condition);
		$q=$this->db->get();
		if($q->num_rows()>0){ 
			//update query;
			$recieve = $this->update($tab,$arr,$condition);
			if($recieve){
				$respo = array("response"=>true);
				return $respo;
			}
			else{
				return false;	
			}
		}
		else
		{	$this->db->insert($tab,$arr);
			$last_id =  $this->db->insert_id();
			if($this->db->affected_rows()>=1)
			{	
				$respo = array("response"=>true,"row"=>$last_id);
				return $respo;
			}
			else
				return false;
		}
	}


	public function delete($tab,$condition){
		$this->db->where($condition);
		$this->db->delete($tab);
		if($this->db->affected_rows()>=1)
			return true;
		else
			return false;
	}


	public function filter_by_day($tab,$condition,$day){
		$this->db->select("*");
		$this->db->from($tab); //select * from table_name where condition;
		if($day == 't'){
			$this->db->where("NOW() and user_name = '".$this->session->userdata('user_name')."'");
		} 
		elseif ($day == 'y') {
			$this->db->where(" created = CURRENT_DATE()-1 and user_name = '".$this->session->userdata('user_name')."'");
		}
		$q = $this->db->get();
		//echo $this->db->last_query();
		return $q->result();
	}
	
}