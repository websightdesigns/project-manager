<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	var $uses = array('User', 'Setting');

	public $components = array(
		'Session',
		'Cookie',
		'Auth' => array(
			'loginAction' => array('controller' => 'users', 'action' => 'login'),
			'loginRedirect' => array('controller' => 'actions', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
			'authError' => 'You must be signed in to view this page.'
		)
	);

	public function beforeFilter() {
		parent::beforeFilter();

		// allow the login page to be viewed without auth required
		$this->Auth->allow('login', 'logout');

		// reads the site-wide config values from the DB and puts them through the Configure::write method
		$this->Setting->getcfg();

		// set the user role into a variable
		if($this->Auth->user('role')) {
			$this->set("role", $this->Auth->user('role'));
		}

		// set the user id into a variable
		if($this->Auth->user('id')) {
			$this->set("userid", $this->Auth->user('id'));
		}
	}

	function afterFilter(){
		// retrieves the site-wide configurations from Configure::read($key) and puts it back into the db if new
		$this->Setting->writecfg();
	}

	/**
	 * getUserName method
	 *
	 * @return array
	 */
	// public function getUserName($user_id) {
	// 	$this->loadModel('User');
	// 	$user = $this->User->find('first', array(
	// 		'conditions' => array('User.id' => $user_id)
	// 	));
	// 	return $user['User']['first_name'] . ' ' . substr($user['User']['last_name'], 0, 1);
	// }

}
