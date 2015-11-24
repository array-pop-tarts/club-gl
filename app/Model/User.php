<?php

App::uses('AppModel', 'Model');

class User extends AppModel {
  
  public function beforeSave($options = array()) {
    if (isset($this->data['User']['password']))
      $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
  }
  
  public $hasMany = array(
    'JournalEntry' => array(
      'foreignKey' => 'modified_user_id'
    ),
    'OpeningBalance' => array(
      'foreignKey' => 'modified_user_id'
    ),
  );
  
  public $validate = array(
    'first_name' => array(
      'notEmpty' => array(
        'rule' => 'notEmpty',
        'message' => 'Please provide your first name'
      )
    ),
    'last_name' => array(
      'notEmpty' => array(
        'rule' => 'notEmpty',
        'message' => 'Please provide your last name'
      )
    ),
    'email' => array(
      'email' => array(
        'rule' => 'email',
        'message' => 'Invalid email'
      ),
      'unique' => array(
        'rule' => 'isUnique',
        'message' => 'This email address is already in use'
      )
    ),
    'password' => array(
      'min6' => array(
        'rule' => array('minLength', 6),
        'message' => 'Password must be minimum 6 characters',
      ),
    ),
    'password2' => array(
      'match' => array(
        'rule' => array('compareWithField', '==', 'password'),
        'message' => 'Passwords do not match',
        'on' => 'update'
      ),
    ),
  );
  
  public function roles() {
    return array(
      'A' => 'Admin',
      'U' => 'User'
    );
  }
  
  public function statuses() {
    return array(
      'A' => 'Active',
      'D' => 'Deleted'
    );
  }
  
}