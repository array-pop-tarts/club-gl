<?php

App::uses('AppModel', 'Model');

class LedgerEntry extends AppModel {
  
  public $belongsTo = array(
    'JournalEntryItem'
  );
  
  public $order = array(
    'date DESC'
  );
  
  public function afterFind($results, $primary = false) {
    $recordTypes = $this->recordTypes();
    foreach ($results as $key => $result) {
      
      foreach ($recordTypes as $typeKey => $type) {
        if ($result['LedgerEntry']['type'] == $typeKey)
          $results[$key]['LedgerEntry'][strtolower($typeKey)] = $result['LedgerEntry']['amount'];
        else
          $results[$key]['LedgerEntry'][strtolower($typeKey)] = 0;
      }
      
      $results[$key]['LedgerEntry']['balance'] = $this->__currentBalance($result);
    }
    return $results;
  }
  
  private function __currentBalance($result) {
    $data = $this->JournalEntryItem->GlAccount->find('first', array(  
      'contain' => array(
        'OpeningBalance'
      ),
      'conditions' => array(
        'GlAccount.id' => $result['JournalEntryItem']['gl_account_id']
      )
    ));
    $openingBalance = $data['OpeningBalance'][0]['amount'];
    
    if ($result['LedgerEntry']['type'] == $data['GlAccount']['type'])
      return $openingBalance + $result['LedgerEntry']['amount'];
    else
      return $openingBalance - $result['LedgerEntry']['amount'];
  }
  
}