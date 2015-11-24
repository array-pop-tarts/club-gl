<?php

App::uses('Model', 'Model');

class AppModel extends Model {
  
  public $recursive = -1;
  
  public $actsAs = array(
    'Containable'
  );
  
  public function compareWithField($validationFields = array(), $operator = null, $compareFieldName = '') {
    
    if (!isset($this->data[$this->name][$compareFieldName])) {
        throw new CakeException(sprintf('Can\'t compare to the non-existing field "%s" of model %s.'), $compareFieldName, $this->name);
    }

    $compareTo = $this->data[$this->name][$compareFieldName];
    foreach ($validationFields as $key => $value) {
        if (!Validation::comparison($value, $operator, $compareTo)) {
            return false;
        }
    }
    return true;    
    
  }
  
  public function recordTypes() {
    return array(
      'DR' => 'Debit',
      'CR' => 'Credit'
    );
  }
  
}
