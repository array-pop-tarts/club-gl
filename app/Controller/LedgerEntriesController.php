<?php

App::uses('AppController', 'Controller');

class LedgerEntriesController extends AppController {
  
  public function admin_index($accountId) {
    
    if (! $this->LedgerEntry->JournalEntryItem->GlAccount->exists($accountId))
      throw new InvalidArgumentException('This is not a valid Ledger Account');
    
    $glAccount = $this->LedgerEntry->JournalEntryItem->GlAccount->find('first', array(
      'contain' => array(
        'OpeningBalance'
      ),
      'conditions' => array(
        'GlAccount.id' => $accountId
      )
    ));
    
    $data = $this->LedgerEntry->find('all', array(
      'contain' => array(
        'JournalEntryItem' => array(
          'JournalEntry'
        )
      ),
      'conditions' => array(
        'JournalEntryItem.gl_account_id' => $accountId
      )
    ));
    
    $this->set(compact('glAccount', 'data'));
  }
  
}