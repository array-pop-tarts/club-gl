<?php

App::uses('AppController', 'Controller');

class JournalEntriesController extends AppController {
  
  public function admin_index() {
    
    $data = $this->JournalEntry->find('all', array(
      'contain' => array(
        'JournalEntryItem' => array(
          'GlAccount',
          'Event'
        ),
        'PaymentType'
      )
    ));
    
    $this->set(compact('data'));
  }
  
  public function admin_add() {
    $this->JournalEntry->create();
    
    if (! $this->request->is(['post', 'put'])) {
      $this->request->data['JournalEntryItem'] = [
        0 => [],
        1 => []
      ];
    }
    
    $this->_admin_form();
  }
  
  public function admin_edit($id) {
    
    if (! $this->JournalEntry->exists($id)) {
      $this->Session->flash('Invalid entry.');
      return $this->redirect(['action' => 'index']);
    }
    
    $journalEntry = $this->JournalEntry->find('first', [
      'contain' => [
        'JournalEntryItem'
      ],
      'conditions' => [
        'JournalEntry.id' => $id
      ]
    ]);
    
    if (! $this->request->is(['post', 'put'])) {
      $this->request->data = $journalEntry;
    }
    
    $this->_admin_form();
  }
  
  private function _admin_form() {
    
    $ledgerAccounts = $this->JournalEntry->JournalEntryItem->GlAccount->find('all');
    
    $paymentTypes = $this->JournalEntry->PaymentType->find('list');
    $accountNumbers = $this->JournalEntry->JournalEntryItem->GlAccount->find('list', array(
      'fields' => array(
        'id',
        'full_name',
      )
    ));
    $events = $this->JournalEntry->JournalEntryItem->Event->find('list', array(
      'conditions' => array(
        'year' => $this->JournalEntry->JournalEntryItem->Event->eventYears()
      ),
      'fields' => array(
        'id',
        'dated_name'
      )
    ));
    
    if ($this->request->is(array('post', 'put'))) {
      
      $this->request->data['JournalEntry']['user_id'] = $this->Auth->user('id');
      
      pr($this->request->data);
      
      //$ledgerEntries = array();
      //foreach ($this->request->data['JournalEntryItem'] as $key => $item) {
      //  
      //  $recordTypes = $this->JournalEntry->recordTypes();
      //  $amounts = array();
      //  foreach ($recordTypes as $type => $name) {
      //    $amounts[$type] = $item[strtolower($type) . '_amount'];
      //  }
      //  
      //  foreach ($amounts as $type => $amount) {
      //    if (!empty($amount)) {
      //      $this->request->data['JournalEntryItem'][$key]['amount'] = $this->request->data['JournalEntryItem'][$key]['LedgerEntry'][$key]['amount'] = $amount;
      //      $this->request->data['JournalEntryItem'][$key]['type'] = $this->request->data['JournalEntryItem'][$key]['LedgerEntry'][$key]['type'] = $type;
      //    }
      //  }
      //  $this->request->data['JournalEntryItem'][$key]['LedgerEntry'][$key]['date'] = $this->request->data['JournalEntry']['date'];
      //}
      //
      //if ($this->JournalEntry->saveAll($this->request->data, array('deep' => true))) {
      //  
      //  $this->Session->setFlash('Entry saved', 'success');
      //  $this->redirect(array('action' => 'index'));
      //}
      //else {
      //  $this->Session->setFlash('Entry could not be saved', 'danger');
      //}
    }
    
    $this->set(compact('ledgerAccounts', 'paymentTypes', 'accountNumbers', 'events'));
    $this->render('_admin_form');
  }
  
}