<?php
  $this->Js->buffer('
    $(".datepicker").datepicker();
  ');
?>

<?php echo $this->Form->create('JournalEntry', array('inputDefaults' => array('label' => false))); ?>

  <?php echo $this->Form->input('id'); ?>
  
  <div class="row">
    <div class="col-xs-5">
      <?php
        echo $this->Form->input('date', array(
          'div' => array('class' => 'form-group'),
          'class' => 'form-control datepicker',
          'type' => 'text',
          'default' => date('Y-m-d')
        ));
      ?>
    </div>
    <div class="col-xs-7">
      <?php
        echo $this->Form->input('payment_type_id', array(
          'div' => array('class' => 'form-group'),
          'class' => 'form-control',
          'options' => $paymentTypes,
          'empty' => '-- Method --'
        ));
      ?>
    </div>
    <div class="col-xs-5">
      <?php
        echo $this->Form->input('reference', array(
          'div' => array('class' => 'form-group'),
          'class' => 'form-control',
          'placeholder' => 'Ref. #'
        ));
      ?>
    </div>
  </div>
  
  <?php
    echo $this->Form->input('name', array(
      'div' => array('class' => 'form-group'),
      'class' => 'form-control',
      'placeholder' => 'Description'
    ));
  ?>
  
  <?php foreach($this->request->data['JournalEntryItem'] as $key => $item): ?>
  
    <div class="row">
      
      <?php echo $this->Form->input("JournalEntryItem.$key.id"); ?>
    
      <div class="col-xs-5">
        <?php
          echo $this->Form->input("JournalEntryItem.$key.gl_account_id", array(
            'div' => array('class' => 'form-group'),
            'class' => 'form-control',
            'options' => $accountNumbers,
            'empty' => '-- Account --'
          ));
        ?>
      </div>
      <div class="col-xs-3">
        <?php
          echo $this->Form->input("JournalEntryItem.$key.dr_amount", array(
            'div' => array('class' => 'form-group'),
            'class' => 'form-control text-right',
            'placeholder' => 'DR',
            'addon' => '$'
          ));
        ?>
      </div>
      <div class="col-xs-3">
        <?php
          echo $this->Form->input("JournalEntryItem.$key.cr_amount", array(
            'div' => array('class' => 'form-group'),
            'class' => 'form-control text-right',
            'placeholder' => 'CR'
          ));
        ?>
      </div>
      <div class="col-xs-6">
        <?php
          echo $this->Form->input("JournalEntryItem.$key.from_to", array(
            'div' => array('class' => 'form-group'),
            'class' => 'form-control',
            'placeholder' => 'Payer / Payee'
          ));
        ?>
      </div>
      <div class="col-xs-5">
        <?php
          echo $this->Form->input("JournalEntryItem.$key.event_id", array(
            'div' => array('class' => 'form-group'),
            'class' => 'form-control',
            'options' => $events,
            'empty' => '-- Event --',
          ));
        ?>
      </div>
      <div class="col-xs-2">
        <?php
          echo $this->Html->link('<i class="fa fa-minus"></i>', 
            '#',
            array(
              'id' => "JournalEntryItem-$key-remove_record",
              'class' => 'btn btn-default remove-record',
              'escape' => false,
              'title' => 'Remove'
            )
          );
        ?>
      </div>
    </div>
  
  <?php endforeach ?>
  
  <div class="row">
    <div class="col-xs-22">
      <?php echo $this->Html->link(
        '<i class="fa fa-plus"></i>',
        array('#'),
        array(
          'class' => 'btn btn-default pull-right add-record',
          'escape' => false,
          'title' => 'Add Record'
        )
      ); ?>
    </div>
  </div>
  
  <div class="row">
    <div class="col-xs-offset-5 col-xs-3">
      <?php
        echo $this->Form->input('dr_total', array(
          'div' => array('class' => 'form-group'),
          'class' => 'form-control text-right',
          'readonly' => true,
          'tabindex' => '-1',
          'default' => '0.00'
        ));
      ?>
    </div>
    <div class="col-xs-3">
      <?php
        echo $this->Form->input('cr_total', array(
          'div' => array('class' => 'form-group'),
          'class' => 'form-control text-right',
          'readonly' => true,
          'tabindex' => '-1',
          'default' => '0.00'
        ));
      ?>
    </div>
  </div>
  
  <div class="pull-right">
    <?php echo $this->Form->submit('Save', array('class' => 'btn btn-primary')); ?>
  </div>

<?php echo $this->Form->end(); ?>