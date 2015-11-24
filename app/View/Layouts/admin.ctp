<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array(
			'jquery-ui.min',
			'jquery-ui.structure.min',
			'jquery-ui.theme.min',
			'template'
		));
		echo $this->Html->script(array(
			'jquery-1.11.2.min',
			'jquery-ui.min',
			'bootstrap.min'
		));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
		echo $this->Js->writeBuffer();
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<?php
							echo $this->Html->link(
								'TOC',
								array('controller' => 'journalentries', 'action' => 'index'),
								array('class' => 'navbar-brand')
							);
						?>
					</div> <!-- END navbar-header -->
					
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<li>
								<?php echo $this->Html->link('Journal', array('controller' => 'journalentries', 'action' => 'index')); ?>
							</li>
							<li>
								<?php echo $this->Html->link('Users', array('controller' => 'users', 'action' => 'index')); ?>
							</li>
							<li class="dropdown">
								<?php
									echo $this->Html->link(
											$authUser['email'] . ' <span class="caret"></span>',
										array('#'),
										array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'role' => 'button', 'escape' => false));
								?>
								<ul class="dropdown-menu" role="menu">
									<li>
										<?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout', 'admin' => false)); ?>
									</li>
									<li>
										<?php echo $this->Html->link('Change Password', array('controller' => 'users', 'action' => 'password', $authUser['id'])); ?>
									</li>
								</ul>
							</li>
						</ul>
						
					</div>
						
				</div> <!-- END container-fluid -->
			</nav>

		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
		</div>
	</div>
</body>
</html>
