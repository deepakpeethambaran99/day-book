<?php
	if($this->session->userdata('user_name','passowrd')){ $loggedin = true;}
	else{$loggedin = false;}
	if($this->session->flashdata('message')){ $flashdata = true;}
	else{ $flashdata=false;}
?>