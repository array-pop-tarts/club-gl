<div class="row">
  
  <div class="col-xs-6">
    <?php echo $this->element('board/financial/ledger_accounts'); ?>
  </div>
  
  <div class="col-xs-18">
    
    <div class="row">
      <div class="col-xs-24">
        <h1>General Ledger</h1>
        <h2><?php echo $glAccount['GlAccount']['num'] . ' - ' . $glAccount['GlAccount']['name']; ?></h2>
      </div>
    </div>
    
    <div class="row">
      <div class="col-xs-6">
        FYE
      </div>
      <div class="col-xs-6">
        2014-12-31
      </div>
      <div class="col-xs-6">
        Opening Balance
      </div>
      <div class="col-xs-6">
        <?php echo $glAccount['OpeningBalance'][0]['amount']; ?>
      </div>
    </div>
    
    <table class="table">
      <?php
        $headers = array(
          'TRX',
          'Date',
          'DR',
          'CR',
          'Balance'
        );
        echo $this->Html->tableHeaders($headers);
        
        $rows = array();
        foreach ($data as $d) {
          
          $balanceClass = $d['LedgerEntry']['balance'] < 0 ? 'negative-amount' : '';
          
          $row = array(
            $this->Html->link($d['JournalEntryItem']['JournalEntry']['trx'], array(
              'controller' => 'journalentries',
              'action' => 'index',
              '#' => $d['JournalEntryItem']['JournalEntry']['id']
            )),
            $d['LedgerEntry']['date'],
            $this->Number->currency($d['LedgerEntry']['dr']),
            $this->Number->currency($d['LedgerEntry']['cr']),
            array($this->Number->currency($d['LedgerEntry']['balance']), array(
              'class' => $balanceClass
            ))
          );
          $rows[] = $row;
        }
        echo $this->Html->tableCells($rows);
      ?>
    </table>
    
  </div>
  
</div>