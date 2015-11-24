<div class="list-group">
  <?php foreach ($ledgerAccounts as $account): ?>
    <?php $account = $account['GlAccount']; ?>
    <?php
      echo $this->Html->link($account['num'] . ' - ' . $account['name'],
        array('controller' => 'ledgerentries', 'action' => 'index', $account['id']),
        array('class' => 'list-group-item')
      );
    ?>
  <?php endforeach ?>
</div>
