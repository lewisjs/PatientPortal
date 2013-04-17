<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
/**
 * @var array
 */
    public $components = array(
        'Acl',
        'Auth' => array(
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers'),
            ),
        	'loginAction' => array('controller' => 'users', 'action' => 'login'),
        	
        	'loginRedirect' => array('controller' => 'pages', 'action' => 'home'),
        	'logoutRedirect' => array('controller' => 'users', 'action' => 'login')
        ),
        'Session'
    );

/**
 * @var array
 */
    public $helpers = array('Html', 'Form', 'Session');
    

/**
 * (non-PHPdoc)
 * @see Controller::beforeFilter()
 */
    public function beforeRedirect($url) {
    	$this->put_referer();
    }
    public function afterFilter() {
    	$this->put_referer();
    }
    
    
/**
 * 	Accesses the array of site pages through which the user has passed to determine which page was the last unique page visited by the user. Maintains array as a stack, recording the history as expected, with the top of the stack as the page from which the user arrived.
 * 
 * 	Returns NULL if there is no previous unique page in the stack.
 * 
 * @return mixed|NULL
 */
    protected function get_referer() {
    	$history = array();    	
    	
    	if ($this->Session->check('Auth.Referer.history')) {
    		$history = unserialize($this->Session->read('Auth.Referer.history'));
    	}
    	
    	while (0 != count($history)) {
    		$pageBack = array_pop($history);
    		
    		if ($this->name == $pageBack['controller']
    		&& $this->action == $pageBack['action']
    		&& $this->passedArgs == $pageBack[0]) {
    			continue;
    		} else {
    			return $pageBack;
    		}
    	}
    	
    	return NULL;
    }
    
    
    protected function put_referer() {
    	$history = array();
    	
    	if ($this->Session->check('Auth.Referer.history')) {
    		$history = unserialize($this->Session->read('Auth.Referer.history'));
    	}
    	
    	if (9 < count($history)) {
    		array_shift($history);
    	}
    	
    	$pageBack = array('controller' => $this->name, 'action' => $this->action, $this->params);
    	foreach ($this->passedArgs as $arg) {
    		$pageBack[] = $arg;
    	}
    	
    	array_push($history, $pageBack);
    	$this->Session->write('Auth.Referer.history', serialize($history));
    }
    
    protected function delete_history() {
    	$this->Session->write('Auth.Referer.history', serialize(array()));    	
    }
}
