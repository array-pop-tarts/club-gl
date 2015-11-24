<?php

App::uses('AppModel', 'Model');

class Event extends AppModel {
  
  public $hasMany = array(
    'JournalEntryItem'
  );
  
  public $belongsTo = array(
    'EventType'
  );
  
  public $order = array(
    'year DESC',
    'event_type_id'
  );
  
  public $virtualFields = array(
    'dated_name' => 'CONCAT(name, " - ", year)'
  );
  
  public function eventYears() {
    $years = $this->find('list', array(
      'fields' => array('year'),
      'order' => 'year ASC'
    ));
    $years = array_unique($years);
    $years[] = max($years) + 1;
    return $years;
  }
  
}