<?php
/**
 * Reports Controller
 *
 * This file is the controller for the Reports page.
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
 * @link          http://cakephp.org CakePHP(tm) Report
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * Reports Controller
 *
 * @property Report $Report
 */
class ReportsController extends AppController {

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		// $this->Report->recursive = 0;
		$this->set('reports', $this->Report->find('all'));
	}

	/**
	 * tickets method
	 *
	 * @return void
	 */
	public function tickets() {
		// $this->Report->recursive = 0;
		$this->set('reports', $this->Report->find('all'));
	}

	/**
	 * time method
	 *
	 * @return void
	 */
	public function time() {
		// $this->Report->recursive = 0;
		$this->set('reports', $this->Report->find('all'));
	}

	/**
	 * billed method
	 *
	 * @return void
	 */
	public function billed() {
		// $this->Report->recursive = 0;
		$this->set('reports', $this->Report->find('all'));
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->Report->id = $id;
		if (!$this->Report->exists()) {
			throw new NotFoundException(__('Invalid report'));
		}
		$this->set('report', $this->Report->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @todo add related info that every report will need to get started, i.e. global template
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			if ($report = $this->Report->save($this->request->data)) {
				// $this->createDefaultData($report['Report']['id']);
				$this->Session->setFlash(__('The report has been saved.'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The report could not be saved. Please, try again.'), 'error');
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
		$this->Report->id = $id;
		if (!$this->Report->exists()) {
			throw new NotFoundException(__('Invalid report'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Report->save($this->request->data)) {
				$this->Session->setFlash(__('The report has been saved.'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The report could not be saved. Please, try again.'), 'error');
			}
		} else {
			$this->request->data = $this->Report->read(null, $id);
		}

		$this->set('report_id', $this->Report->id);
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
		$this->Report->id = $id;
		if (!$this->Report->exists()) {
			throw new NotFoundException(__('Invalid report'));
		}
		if ($this->Report->delete()) {
			$this->Session->setFlash(__('Report deleted.'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Report was not deleted.'), 'error');
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * @name ajax
	 *  returns the json array for the knockout request
	 *
	 * @param string $id the id of the report to fetch
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
				$response = $this->Report->find('first', array('conditions' => array('id' => $id)));
				break;
		}
		$this->_returnJSON($response);
	}
}
