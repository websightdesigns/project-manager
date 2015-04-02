<?php
/**
 * Actions Controller
 *
 * This file is the controller for the Actions page.
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
 * @link          http://cakephp.org CakePHP(tm) Action
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * Actions Controller
 *
 * @property Action $Action
 */
class ActionsController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();

		// projects model
		$this->loadModel('Project');
		$options = [
			'conditions' => [
				'Project.user_id' => $this->Auth->user('id')
			]
		];
		$this->set('projects', $this->Project->find('all', $options));

	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$limit = (Configure::read('AppSettings.itemsperpage') ? Configure::read('AppSettings.itemsperpage'): '10');
		$this->paginate = array(
			'fields' => array(
				'Action.id',
				'Action.status',
				'Action.action',
				'Action.user_id',
				'Action.ticket_id',
				'Action.project_id',
				'Action.file_id',
				'Action.created',
				'User.id',
				'User.name',
				'Ticket.id',
				'Ticket.title',
				'Project.id',
				'Project.title'
			),
			'limit' => $limit,
			'recursive' => 2,
			'conditions' => array(
				'User.id = Action.user_id',
				'Ticket.id = Action.ticket_id',
				'Project.id = Action.project_id'
			),
			'order' => array('Action.created' => 'desc')
		);
		$this->set('actions', $this->paginate('Action'));
	}

}
