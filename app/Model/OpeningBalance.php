<?php

App::uses('AppModel', 'Model');

class OpeningBalance extends AppModel {
  
  public $belongsTo = array(
    'GlAccount',
    'User' => array(
      'foreignKey' => 'modified_user_id'
    )
  );
  
}