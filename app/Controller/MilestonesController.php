<?php
/**
 * Milestones Controller
 *
 * This file is the controller for the Milestones page.
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
 * @link          http://cakephp.org CakePHP(tm) Milestone
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * Milestones Controller
 *
 * @property Milestone $Milestone
 */
class MilestonesController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();

		$this->loadModel('Project');
		$this->set('projects', $this->Project->find('all'));

		$this->loadModel('Ticket');
		$this->set('tickets', $this->Ticket->find('all'));

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
		$this->set('milestones', $this->paginate('Milestone'));
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		// set the milestone id
		$this->Milestone->id = $id;
		// set the parent project into a variable
		$project_id = $this->Milestone->project_id;
		$this->set('project', $this->Milestone->read(null, $project_id));
		// set the milestone tickets into a variable
		$tickets = $this->Ticket->find('all', array(
			'conditions' => array('Ticket.milestone_id' => $this->Milestone->id)
		));
		// thrown an exception error if milestone id is invalid
		if (!$this->Milestone->exists()) {
			throw new NotFoundException(__('Invalid milestone.'));
		}
		// set the milestone variable
		$this->set('milestone', $this->Milestone->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @todo add related info that every milestones will need to get started, i.e. global template
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			if ($milestones = $this->Milestone->save($this->request->data)) {
				// $this->createDefaultData($milestones['Milestone']['id']);
				$this->Session->setFlash(__('The milestone has been saved.'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The milestone could not be saved. Please, try again.'), 'error');
			}
		}
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$this->Milestone->id = $id;
		if (!$this->Milestone->exists()) {
			throw new NotFoundException(__('Invalid milestones'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Milestone->save($this->request->data)) {
				$this->Session->setFlash(__('The milestones has been saved.'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The milestone could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->Milestone->read(null, $id);
		}

		$this->set('milestones_id', $this->Milestone->id);
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
		$this->Milestone->id = $id;
		if (!$this->Milestone->exists()) {
			throw new NotFoundException(__('Invalid milestone'));
		}
		if ($this->Milestone->delete()) {
			$this->Session->setFlash(__('Milestone deleted.'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Milestone was not deleted.'), 'error');
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * @name ajax
	 *  returns the json array for the knockout request
	 *
	 * @param string $id the id of the milestones to fetch
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
				$response = $this->Milestone->find('first', array('conditions' => array('id' => $id)));
				break;
		}
		$this->_returnJSON($response);
	}
}
