<?php

namespace Drupal\produse\Model;

class ProduseHomePageModel {
	
	private $input;
	
	public function __construct($a){
		
		$this->input = $a;
		
	}
	
	public function filtreaza(){
		
		if(!$this->input){
			
			return 'Va rugam sa introduceti date numerice in formular si sa apasati "Filtreaza"!!';
			
		}else{
			
			$pretm = (float)$this->input['pretmax'];

			
			$db_conn = \Drupal::database();
			$select_obj = $db_conn->select('produse','a');
			$select_obj->condition('a.id',0,'>');
			$select_obj->condition('a.pret',$pretm,'<=');
			$select_obj->fields('a',array('denumire','descriere','pret'));
			$select_obj->range(0,100);
		
			$results1 = $select_obj->execute();
			return $results1;
			
			
		}
		
	}
	
	
	public function get_produse(){
		
		$db_conn = \Drupal::database();
		
		$select_obj = $db_conn->select('produse','a');
		$select_obj->condition('a.id',0,'>');
		$select_obj->fields('a',array('denumire','descriere','pret'));
		$select_obj->range(0,100);
		
		$results = $select_obj->execute();

		return $results;
		
	}
	
	
}