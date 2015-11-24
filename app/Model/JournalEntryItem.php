<?php

App::uses('AppModel', 'Model');

class JournalEntryItem extends AppModel {
  
  public $hasMany = array(
    'LedgerEntry'
  );
  
  public $belongsTo = array(
    'GlAccount',
    'Event',
    'JournalEntry'
  );
  
}