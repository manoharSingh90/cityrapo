<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Footer extends CI_Controller {

	 function __construct()
	{
		parent::__construct();	
	}

	public function contact(){
		$this->load->view('footer_page/contact');
	}
	
	public function policies(){
		$this->load->view('footer_page/policies');
	}
	public function cancellation(){
		$this->load->view('footer_page/cancellation');
	}
	public function terms_and_conditions(){
		$this->load->view('footer_page/terms&conditions');
	}
	public function legal(){
		$this->load->view('footer_page/legal');
	}
	public function about(){
		$this->load->view('footer_page/about');
	}
	public function advertisement(){
		$this->load->view('footer_page/advertising');
	}
	public function copyright(){
		$this->load->view('footer_page/copyright');
	}
	public function photo_credites(){
		$this->load->view('footer_page/photo_credits');
	}
	
	public function soon(){
		$this->load->view('footer_page/soon');
	}
	public function media(){
		$this->load->view('footer_page/media');
	}
	public function why_host(){
		$this->load->view('footer_page/why_host');
	}
	public function knowmore_india(){
		$this->load->view('footer_page/knowmore_india');
	}
// NORTH INDIA	
	public function knowmore_north(){
		$this->load->view('footer_page/knowmore_north');
	}
	public function knowmore_north_culture(){
		$this->load->view('footer_page/knowmore_north_culture');
	}
	public function knowmore_north_food(){
		$this->load->view('footer_page/knowmore_north_food');
	}
	public function knowmore_north_heritage(){
		$this->load->view('footer_page/knowmore_north_heritage');
	}
	public function knowmore_north_people(){
		$this->load->view('footer_page/knowmore_north_people');
	}
//NORTH EAST INDIA	
	public function knowmore_north_east(){
		$this->load->view('footer_page/knowmore_north_east');
	}
	public function knowmore_north_east_culture(){
		$this->load->view('footer_page/knowmore_north_east_culture');
	}
	public function knowmore_north_east_food(){
		$this->load->view('footer_page/knowmore_north_east_food');
	}
	public function knowmore_north_east_heritage(){
		$this->load->view('footer_page/knowmore_north_east_heritage');
	}
	public function knowmore_north_east_people(){
		$this->load->view('footer_page/knowmore_north_east_people');
	}
//EAST INDIA	
	public function knowmore_east(){
		$this->load->view('footer_page/knowmore_east');
	}
	public function knowmore_east_culture(){
		$this->load->view('footer_page/knowmore_east_culture');
	}
	public function knowmore_east_food(){
		$this->load->view('footer_page/knowmore_east_food');
	}
	public function knowmore_east_heritage(){
		$this->load->view('footer_page/knowmore_east_heritage');
	}
	public function knowmore_east_people(){
		$this->load->view('footer_page/knowmore_east_people');
	}
//WEST INDIA	
	public function knowmore_west(){
		$this->load->view('footer_page/knowmore_west');
	}
	public function knowmore_west_culture(){
		$this->load->view('footer_page/knowmore_west_culture');
	}
	public function knowmore_west_food(){
		$this->load->view('footer_page/knowmore_west_food');
	}
	public function knowmore_west_heritage(){
		$this->load->view('footer_page/knowmore_west_heritage');
	}
	public function knowmore_west_people(){
		$this->load->view('footer_page/knowmore_west_people');
	}
//SOUTH INDIA	
	public function knowmore_south(){
		$this->load->view('footer_page/knowmore_south');
	}
	public function knowmore_south_culture(){
		$this->load->view('footer_page/knowmore_south_culture');
	}
	public function knowmore_south_food(){
		$this->load->view('footer_page/knowmore_south_food');
	}
	public function knowmore_south_heritage(){
		$this->load->view('footer_page/knowmore_south_heritage');
	}
	public function knowmore_south_people(){
		$this->load->view('footer_page/knowmore_south_people');
	}
//CENTRAL INDIA	
	public function knowmore_central(){
		$this->load->view('footer_page/knowmore_central');
	}
	public function knowmore_central_culture(){
		$this->load->view('footer_page/knowmore_central_culture');
	}
	public function knowmore_central_food(){
		$this->load->view('footer_page/knowmore_central_food');
	}
	public function knowmore_central_heritage(){
		$this->load->view('footer_page/knowmore_central_heritage');
	}
	public function knowmore_central_people(){
		$this->load->view('footer_page/knowmore_central_people');
	}
	// public function knowmore_south(){
	// 	$this->load->view('footer_page/knowmore_south');
	// }
	
}