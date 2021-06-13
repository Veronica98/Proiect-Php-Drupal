<?php

namespace Drupal\produse\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

use Drupal\produse\Model\ProduseHomePageModel;

class ProduseHomePageController extends ControllerBase {
	
	private $input;
    
    public function __construct() {
        
		$this->input = empty($_REQUEST) ? false : $_REQUEST;
        
    }

    public function display() {
		
		
		$model_obj = new ProduseHomePageModel($this->input);
		$produse = $model_obj->get_produse();
		$results1 =$model_obj->filtreaza();
		
		
		$params = array(
			'input' => $this->input,
			'produse'=> $produse,
			'results1'=> $results1,
		);
    
        return array(
            '#theme' => 'produsehomepage',
			'#params' => $params,
			'#cache' => array('max-age' => 0),
            '#attached' => array(
                'library' => array(
                    'produse/produse-css'
                ),
            )
        );
    
    }
    
    public function access(AccountInterface $account) {
		
		$roles = $account->getRoles();
		
		if (in_array('authenticated', $roles)) {
			
			return AccessResult::allowed();
		
		} else {
		
			return AccessResult::forbidden();
		
		}
		
    }
    
}
