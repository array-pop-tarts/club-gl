<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {
  
  public function beforeFilter() {
    parent::beforeFilter();
    
    $authUser = $this->Auth->user();
    
    $this->loadModel('User');
    $userRoles = $this->User->roles();
    
    if (!empty($this->params['prefix']))
      $this->layout = $this->params['prefix'];
    else
      $this->Auth->allow();
    
    //---- GL ACCOUNTS ----
    
    $this->loadModel('GlAccount');
    $ledgerAccounts = $this->GlAccount->find('all');
    
    $this->set(compact('authUser', 'ledgerAccounts'));
  }
  
  public $components = array(
    'DebugKit.Toolbar',
    'Session',
    'Paginator',
    'Auth' => array(
      'authenticate' => array(
        'Form' => array(
          'fields' => array(
            'username' => 'email'
          )
        )
      ),
      'authorize' => array(
        'Controller'
      ),
      'unauthorizedRedirect' => array(
        'controller' => 'users',
        'action' => 'login',
        'admin' => false,
        'user' => false
      ),
      'loginAction' => array(
        'controller' => 'users',
        'action' => 'login',
        'admin' => false,
        'user' => false
      )
    )
  );
  
  public $helpers = array(
    'Html',
    'Text',
    'Form',
    'Number',
    'Time',
    'Paginator',
    'Session',
    'Js'
  );

  public function isAuthorized($user) {
    
    if ($user['role'] == 'U' && $this->params['prefix'] == 'user')
      return true;
    elseif ($user['role'] == 'A' && $this->params['prefix'] == 'admin')
      return true;
    
    return false;
  }
  
}
