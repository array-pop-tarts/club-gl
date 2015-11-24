<div class="row">
  
  <div class="col-xs-6">
    <?php echo $this->element('board/financial/ledger_accounts'); ?>
  </div>
  
  <div class="col-xs-18">
    
    <div class="row">
      <div class="col-xs-18">
        <h1>Journal</h1>
      </div>
      <div class="col-xs-6">
        <?php
          echo $this->Html->link('Add',
            array('action' => 'add'),
            array('class' => 'btn btn-default')
          );
        ?>
      </div>
    </div>
    
    <table class="table">
      <?php
        $headers = array(
          'TRX',
          'Date',
          'Description',
          'Payment Type',
          'Reference'
        );
        echo $this->Html->tableHeaders($headers);
        
        $rows = array();
        
        foreach ($data as $entry) {
          
          $journalEntry = $entry['JournalEntry'];
          
          $row = array(
            $journalEntry['trx'],
            $journalEntry['trx_date'],
            $journalEntry['name'],
            $entry['PaymentType']['name'],
            $journalEntry['reference']
          );
          $rows[] = $row;
          
          foreach ($entry['JournalEntryItem'] as $item) {
            
            $drAmount = ($item['type'] == 'DR' ? $this->Number->currency($item['amount']) : '');
            $crAmount = ($item['type'] == 'CR' ? $this->Number->currency($item['amount']) : '');
            
            $event = (!empty($item['Event']) ? $item['Event']['dated_name'] : '');
          
            $row = array(
              array($item['GlAccount']['num'], array('colspan' => 2)),
              $item['GlAccount']['name'],
              $drAmount,
              $crAmount,
              $item['from_to'],
              $event
            );
            $rows[] = $row;
          }
        }
        echo $this->Html->tableCells($rows);
      ?>
    </table>
  </div>

</div>