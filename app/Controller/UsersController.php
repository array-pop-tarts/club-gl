<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {
  
  public function beforeFilter() {
    parent::beforeFilter();
    
    $this->Auth->allow('register');
  }
  
  public function register() {
    
    if ($this->request->is(array('post', 'put'))) {
      
      $this->User->create();
      $this->request->data['User']['status'] = 'A';
      $this->request->data['User']['role'] = 'A';
      
      if ($this->User->save($this->request->data)) {
        $user = $this->User->findById($this->User->id);
        $this->Auth->login($user['User']);
        $this->redirect(array('action' => 'index', 'admin' => true));
      }
      else
        $this->Session->setFlash('You could not be registered, please try again', 'danger');
    }
    
  }
  
  public function login() {
    
    if ($this->request->is(array('post', 'put'))) {
      if ($this->Auth->login()) {
        
        if($this->Auth->user('role') == 'A')
          $this->redirect(array('controller' => 'journalentries', 'action' => 'index', 'admin' => true));
        elseif($this->Auth->user('role') == 'U')
          $this->redirect(array('controller' => 'journalentries', 'action' => 'index', 'user' => true));
      }
      else
        $this->Session->setFlash('Invalid Login', 'danger');
    }
    
  }
  
  public function index() {
    
  }
  
}