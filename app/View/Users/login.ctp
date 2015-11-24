<div class="row">
  <div class="col-xs-offset-5 col-xs-2">
    <?php echo $this->Form->create(); ?>
    <?php
      echo $this->Form->input('email', array(
        'class' => 'form-control',
        'div' => array('class' => 'form-group')
      ));
    ?>
    <?php
      echo $this->Form->input('password', array(
        'class' => 'form-control',
        'div' => array('class' => 'form-group'),
        'type' => 'password'
      ));
    ?>
    <?php
      echo $this->Form->submit('Log In', array(
        'class' => 'btn'
      ));
    ?>
    <?php echo $this->Form->end(); ?>
  </div>
</div>