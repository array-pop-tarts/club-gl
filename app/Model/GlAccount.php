<?php

App::uses('AppModel', 'Model');

class GlAccount extends AppModel {
  
  public $hasMany = array(
    'JournalEntryItem',
    'OpeningBalance'
  );
  
  public $virtualFields = array(
    'full_name' => 'CONCAT(GlAccount.num, " - ", GlAccount.name)'
  );
}