<?php

App::uses('AppModel', 'Model');

class EventType extends AppModel {
  
  public $hasMany = array(
    'Event'
  );
  
}