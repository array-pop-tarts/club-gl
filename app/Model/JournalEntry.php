<?php

App::uses('AppModel', 'Model');

class JournalEntry extends AppModel {
  
  public $hasMany = array(
    'JournalEntryItem'
  );
  
  public $belongsTo = array(
    'PaymentType',
    'User' => array(
      'foreignKey' => 'modified_user_id'
    )
  );
  
  public $order = array(
    'trx_date DESC',
    'created DESC'
  );
  
  public $virtualFields = array(
    'trx' => 'JournalEntry.id + 10000'
  );
  
}