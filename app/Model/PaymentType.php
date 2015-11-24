<?php

App::uses('AppModel', 'Model');

class PaymentType extends AppModel {
  
  public $hasMany = array(
    'JournalEntry'
  );
  
}