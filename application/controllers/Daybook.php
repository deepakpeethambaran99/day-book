<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daybook extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
			parent::__construct();
			$this->load->helper('form');
			$this->load->helper('url');
			$this->load->database();
			$this->load->Model('Daybook_model');
			$this->load->library('form_validation');
		   $this->load->library('upload');
		   $this->load->library('session');
		   $this->load->helper('date');
	}

	public function index()
	{
		$this->load->view('diary/index');
	}


	public function error(){
		$this->load->view('diary/includes/entry');
	}

	public function login()
	{
		$this->load->view('diary/loginsignup');
	}

	public function about()
	{
		$this->load->view('diary/about');
	}


	//method to load journal page--------------------------------------------------------------------
	public function journal()
	{	
		$id = $this->input->get('id');
		if(isset($id)){
			$condition = array("user_name"=>$this->session->userdata('user_name'),"d_id"=>$id);
			$recieve['data'] = $this->Daybook_model->check_user('entries',$condition);
			if($recieve){
				$this->load->view('diary/journal',$recieve);
			}
		}
		else{ $this->load->view('diary/journal'); }
	}

	//to load entries page
	public function entries()
	{
		if($this->session->userdata("user_name")){
			$condition = array("user_name"=>$this->session->userdata("user_name"));
			$data['entries'] = $this->Daybook_model->fetch_user("entries",$condition);
			if($data){
				$this->load->view('diary/entries',$data);
			}
			else{
				$this->load->view('diary/entries', $data);
			}
		}
		else{
			$this->load->view('diary/loginsignup');
		}
	}

	//method to filter table--------------------------------------------------------------

	public function filter(){
		$opt = $this->input->get('opt');
		$condition = array("user_name"=>$this->session->userdata("user_name"));
		if($opt == 'a'){
			echo "all";
			redirect(site_url('entries'));
		}
		else{
			$data['entries'] = $this->Daybook_model->filter_by_day("entries",$condition,$opt);
			if($data){
					
			}
			else{
				$data['entries'] ="none";
			}
		}
	}


	//method to  load profile-----------------------------------------------------------------

	public function profile(){
		if($this->session->userdata('user_name')){
			$userdata = array('user_name'=>$this->session->userdata('user_name'));
			$recieve['user'] = $this->Daybook_model->fetch_user("users",$userdata);
			$this->load->view('diary/profile',$recieve);
		}
		else{
			redirect(site_url('Login-Register'));
		}
	}

	public function loginuser(){
		//for registration

		if($this->input->post('submit') == 'register'){
			$username=$this->input->post('user_name');
	        $pass=$this->input->post('regpassword');
	        $name=$this->input->post('name');
	        $cpassword=$this->input->post('cpassword');
	        $email=$this->input->post('emailid');
	        //validation
	        $this->form_validation->set_rules('regpassword', 'Password', 'required');
	        $this->form_validation->set_rules('name', 'Full Name', 'required');
	        $this->form_validation->set_rules('user_name', 'Username', 'required|is_unique[users.user_name]',array('is_unique' => 'This username is already occupied' ));
	        $this->form_validation->set_rules('cpassword', 'Comfirm Password', 'required|matches[regpassword]');
			$this->form_validation->set_rules('emailid', 'Email', 'required|is_unique[users.email_id]',array("is_unique"=>"You already have an account on this email id"));

	        if ($this->form_validation->run() == FALSE)
			{
				$data['pres']= true;
				$this->load->view('diary/loginsignup',$data);
			}
	        else{
	        	$path = base_url()."css/img/profile-default.png";
		        $user_data = array('user_name'=>$username,'name'=>$name, 'password'=>$pass,'email_id'=>$email,'avatar'=>$path);
		       	$recieve = $this->Daybook_model->insert('users',$user_data);
		       	if($recieve){
					 $data['message']= "Registration successful";
					 $session_data = array('user_name'=>$username,'name'=>$name);
					 $this->session->set_userdata($session_data);
					 $this->session->set_flashdata($data);
					 redirect(site_url('Index'));
		       	}
		       	else{
		       		 $data['response']= "registration failed";
					 $data['message']= "Registration unsuccessful! please try again.";
					 $this->load->view('diary/loginsignup',$data);
		       	}
		    }
		}

		//for login
		elseif($this->input->post('submit') == 'login'){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			//validation
	        $this->form_validation->set_rules('username', 'Username', 'required');
	        $this->form_validation->set_rules('password', 'Password', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('diary/loginsignup');
			}
			else{
				$user_data = array('user_name'=>$username,'password'=>$password);
				$recieve = $this->Daybook_model->check_user('users',$user_data);
				if($recieve){
					$session_data = array('user_name'=>$username,'avatar'=>$recieve[0]->avatar,'name'=>$recieve[0]->name);
					$this->session->set_userdata($session_data);
					redirect(site_url('Index'));
				}
				else{
					$data['response'] = "login-failed";
					$data['message'] = "Incorrect Username or Password";
					$this->load->view('diary/loginsignup',$data);	
				}
			}

		}
	}

	//user data
	public function user(){

	}


	//session unset
	public function logout(){
		$this->session->unset_userdata('user_name','password','email_id');
		redirect(site_url('Index'));
	}


	//update profile
	public function updateprofile(){
		echo "profile";
		if($this->input->post('submit') == 'save')
		{
			$fullname = $this->input->post('fullname');
			$username = $this->input->post('username');
			$email_id = $this->input->post('email');
			
			$this->form_validation->set_rules('fullname', 'Full Name', 'required');
	        $this->form_validation->set_rules('username', 'User Name', 'required');
	        $this->form_validation->set_rules('email', 'Email Id', 'required');
			
	        if ($this->form_validation->run() == FALSE)
			{
				redirect(site_url('Profile'));
			}
			else{
				$avatar = uniqid().$this->input->post('avatar');
				$user_data = array('user_name'=>$username, 'name'=>$fullname, 'email_id'=>$email_id);
				$condition = array('user_name'=>$this->session->userdata('user_name'));
		
				$recieve = $this->Daybook_model->update('users',$user_data,$condition);
		
				if($recieve){
					$data['message'] = "Profile Updated !";
					$data['disable'] = true;
					$session_data = array('user_name'=>$username,'name'=>$fullname);
					$this->session->set_userdata($session_data);
					$this->session->set_flashdata($data);
					redirect(site_url('Profile'));
				}
		
				else{
					redirect(site_url('Profile'));
				}
			}
		}

		
	}

	//method to upload avatar
	public function uploadAvatar(){
		$config['upload_path'] = 'upload/avatars';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']     = 0;
		$config['max_width'] = 0;
		$config['max_height'] = 0;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('avatar')) {
	            $error = array('message' => $this->upload->display_errors());
	            echo $error["message"]; 
	            $this->session->set_flashdata($error);
	            redirect(site_url('Profile'));
	        } 
        else {
            $data = $this->upload->data();
            $path = base_url()."upload/avatars/".$data['raw_name'].$data['file_ext'];
            $user_data = array('avatar'=>$path);
            $error['message'] = 'successful' ;
            $this->session->set_userdata('avatar',$path);
            $condition = array('user_name'=>$this->session->userdata('user_name'));
			$recieve = $this->Daybook_model->update('users',$user_data,$condition);
            $this->session->set_flashdata($error);
            redirect(site_url('Profile'));
        }
	}

	//save entry
	public function saveEntry(){
		$title = $this->input->post("title");
		$title = $title == Null?"Title":$title;
		$content = $this->input->post("content");
		$rowid = $this->input->post("rowid");
		$username = $this->session->userdata('user_name');
		$condition = array("user_name"=>$username,"d_id"=>$rowid);
		$userdata = array("title"=>$title,"user_name"=>$username,"content"=>$content);
		$recieve = $this->Daybook_model->insert_entry("entries",$userdata,$condition);
		if($recieve['response']){ 
			$data = array('row' => isset($recieve['row'])?$recieve['row']:$rowid ,'repo'=>" | Saved." );
			echo json_encode($data);

		}
		else {echo "not saved";}
	}

	public function getDateTime()
    {
        //load date helper
        $this->load->helper('date');

        $format = "%Y-%m-%d %h:%i %a";
        echo @mdate($format);
    }

	//method to upload image

	public function uploadImage(){
		$config['upload_path'] = 'upload/userupload';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']     = 0;
		$config['max_width'] = 0;
		$config['max_height'] = 0;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('avatar')) {
	            $error = array('message' => $this->upload->display_errors());
	            echo $error["message"]; 
	        } 
        else {
            $data = $this->upload->data();
            $path = base_url()."upload/userupload/".$data['raw_name'].$data['file_ext'];
            $user_data = array('image'=>$path,"user_name"=>$this->session->userdata('user_name'));
            $error['message'] = 'successful' ;
            $condition = array('user_name'=>$this->session->userdata('user_name'));
			$recieve = $this->Daybook_model->insert('uploads',$user_data,$condition);
			return $path;
        }
	}

	//method to delete entry
	public function deleteEntry(){
		$id = $this->input->get('d');

		$condition = array("user_name"=>$this->session->userdata('user_name'),"d_id"=>$id);
		$recieve = $this->Daybook_model->delete("entries",$condition);
		if($recieve){
			redirect(site_url('entries'));
		}
		else{
			echo "<h1 style='text-align: center; margin-top: 100px;'>[Error] while deletion!</h1>";
			echo "<a href='".site_url('entries')."'>Click here to go back</a>";
		}
	}
	
}