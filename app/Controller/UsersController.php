<?php
/**
 * Users Controller
 *
 * This file is the controller for the Users page.
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

class UsersController extends AppController {

    public $components = array(
        'Paginator',
        'RequestHandler'
    );

    public function beforeFilter() {
        parent::beforeFilter();

        // projects model
        $this->loadModel('Project');
        $this->set('projects', $this->Project->find('all'));

        // users model
        $this->loadModel('User');
        $this->set('users', $this->User->find('all'));

        // teams model
        $this->loadModel('Team');
        $teams = $this->Team->find('all');
        foreach ($teams AS $team) {
            $id = $team['Team']['id'];
            $team_names[$id] = $team['Team']['name'];
        }
        if(!empty($teams)) $this->set('teams', $teams);
        if(!empty($team_names)) $this->set('team_names', $team_names);

        // roles model
        $this->loadModel('Role');
        $roles = $this->Role->find('all');
        foreach ($roles AS $role) {
            $id = $role['Role']['keyname'];
            $role_names[$id] = $role['Role']['name'];
        }
        if(!empty($roles)) $this->set('roles', $roles);
        if(!empty($role_names)) $this->set('role_names', $role_names);

        // // only admins can manage users
        // if ($this->Session->read('Auth.User')) {
        //     if(isset($this->params->pass[0])) $pass = $this->params->pass[0];
        //     else $pass = 0;
        //     if($this->Session->read('Auth.User.role') != "admin" && $this->Session->read('Auth.User.id') != $pass) {
        //        return $this->redirect('/');
        //     }
        // }

        // pr( $this->Session->read($this->Auth->sessionKey) );

    }

    public function login() {
        $this->set('title_for_layout', "Please Sign In");
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {

                if (!empty($this->request->data)) {
                    if (empty($this->request->data['User']['rememberme'])) {
                        $this->Cookie->delete('User');
                    } else {
                        $cookie = array();
                        $cookie['username'] = $this->request->data['User']['username'];
                        $cookie['token']    = $this->request->data['User']['password'];
                        $this->Cookie->write('User', $cookie, true, '+2 weeks');
                    }
                    unset($this->request->data['User']['rememberme']);
                }

                $this->redirect($this->Auth->redirectUrl('/'));
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again'), 'flash/error', array('heading' => 'Invalid Login'));
            }
        }
    }

    public function logout() {
        $this->Cookie->delete('User');
        // $this->Session->destroy();
        $this->redirect($this->Auth->logout());
    }

    public function index() {
        $limit = (Configure::read('AppSettings.itemsperpage') ? Configure::read('AppSettings.itemsperpage'): '10');
        $this->paginate = array(
            'limit' => $limit
        );
        $this->set('users', $this->paginate('User'));
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'), 'flash/success', array('heading' => 'User Saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'flash/error', array('heading' => 'User Not Saved'));
            }
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'), 'flash/success', array('heading' => 'User Saved'));
                // $this->redirect(array('action' => 'index'));
                $this->set('user', $this->User->read(null, $id));
            } else {
                $this->set('user', $this->User->read(null, $id));
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'flash/error', array('heading' => 'User Not Saved'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            $this->set('user', $this->User->read(null, $id));
            unset($this->request->data['User']['password']);
            unset($this->request->data['User']['pwd']);
            unset($this->request->data['User']['pwd2']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('The user was deleted'), 'flash/error', array('heading' => 'User Deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('The user was not deleted'), 'flash/error', array('heading' => 'User Not Deleted'));
        $this->redirect(array('action' => 'index'));
    }

}