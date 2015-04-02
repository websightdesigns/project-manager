<?php
/**
 * Projects Controller
 *
 * This file is the controller for the Projects page.
 *
 * PHP 5
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

/**
 * Projects Controller
 *
 * @property Project $Project
 */
class ProjectsController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();

		$this->loadModel('User');
		$this->set('users', $this->User->find('all'));

	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$limit = (Configure::read('AppSettings.itemsperpage') ? Configure::read('AppSettings.itemsperpage'): '10');
		$this->paginate = array(
			'limit' => $limit
		);
		$this->set('projects', $this->paginate('Project'));
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}
		$this->set('project', $this->Project->read(null, $id));
		$this->set('projects', $this->Project->find('all'));
	}

	/**
	 * add method
	 *
	 * @todo add related info that every project will need to get started, i.e. global template
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			if ($project = $this->Project->save($this->request->data)) {
				// $this->createDefaultData($project['Project']['id']);
				$this->Session->setFlash(__('The project has been saved.'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'), 'error');
			}
		}
		$this->set('projects', $this->Project->find('all'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('The project has been saved.'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->Project->read(null, $id);
		}

		$this->set('project_id', $this->Project->id);
	}

	/**
	 * delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}
		if ($this->Project->delete()) {
			$this->Session->setFlash(__('Project deleted.'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Project was not deleted.'), 'error');
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * getProjects method
	 *
	 * @return array
	 */
	public function getProjects() {
		return $this->Project->find('all');
	}

	/**
	 * @name ajax
	 *  returns the json array for the knockout request
	 *
	 * @param string $id the id of the project to fetch
	 *
	 * @return string    the json response
	 */
	public function ajax() {
		//setup a switch for the command
		$response = array('NOTHING');
		switch ($this->request->params['pass'][0]) {
			case NULL:
				break;
			case 'fetch':
				$id = $this->request->params['pass'][1];
				$response = $this->Project->find('first', array('conditions' => array('id' => $id)));
				break;
		}
		$this->_returnJSON($response);
	}
}
