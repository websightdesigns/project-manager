<?php
/**
 * Tickets Controller
 *
 * This file is the controller for the Tickets page.
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
 * @link          http://cakephp.org CakePHP(tm) Ticket
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * Tickets Controller
 *
 * @property Ticket $Ticket
 */
class TicketsController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();

		$this->loadModel('Project');
		$this->set('projects', $this->Project->find('all'));

		$this->loadModel('User');
		$this->set('users', $this->User->find('all'));

	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->set('tickets', $this->Ticket->find('all'));
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->Ticket->id = $id;
		if (!$this->Ticket->exists()) {
			throw new NotFoundException(__('Invalid ticket'));
		}
		$this->set('ticket', $this->Ticket->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @todo add related info that every ticket will need to get started, i.e. global template
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			if ($ticket = $this->Ticket->save($this->request->data)) {
				// $this->createDefaultData($ticket['Ticket']['id']);
				$this->Session->setFlash(__('The ticket has been saved.'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ticket could not be saved. Please, try again.'), 'error');
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
		$this->Ticket->id = $id;
		if (!$this->Ticket->exists()) {
			throw new NotFoundException(__('Invalid ticket'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Ticket->save($this->request->data)) {
				$this->Session->setFlash(__('The ticket has been saved.'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ticket could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->Ticket->read(null, $id);
		}

		$this->set('ticket_id', $this->Ticket->id);
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
		$this->Ticket->id = $id;
		if (!$this->Ticket->exists()) {
			throw new NotFoundException(__('Invalid ticket'));
		}
		if ($this->Ticket->delete()) {
			$this->Session->setFlash(__('Ticket deleted.'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Ticket was not deleted.'), 'error');
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * @name ajax
	 *  returns the json array for the knockout request
	 *
	 * @param string $id the id of the ticket to fetch
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
				$response = $this->Ticket->find('first', array('conditions' => array('id' => $id)));
				break;
		}
		$this->_returnJSON($response);
	}
}
