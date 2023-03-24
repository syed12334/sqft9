<?php
			$package = $this->session->userdata('payment');
			$newpack = $package['package'];
			//echo "<pre>";print_r();exit;
			$pacid = implode(",", $newpack);
			//echo $pacid;exit;
?>
<?= $header; ?>
<br /><br /><br /><br /><br /><br /><br /><br /><br />
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h2 style="text-align: center;">Thank you for registering on Sqft9.com</h2>
				<?php
					if($pacid =="2,13" || $pacid =="2" || $pacid =="13") {
						?>
						<h3 style="text-align: center;">Your account is now active please login.</h3>

						<?php
					}else {
						?>
						<h3 style="text-align: center;">Your Application is being reviewed at the moment. We shall get back to you with a confirmation mail shortly.</h3>
						<?php
					}
				?>
<h3 style="text-align: center;">Meanwhile should you have any queries regarding your registeration please write a mail to : support@sqft9.com.</h3>
<h5 style="text-align: center;">Regards<br />Team Sqft9</h5>
<br />
<center><a href="<?= base_url().'home/login'; ?>" style="background: #0e183c;padding:10px 30px;color:#fff;margin-top:20px">Sign In</a></center>
			</div>
		</div>
	</div>
<br /><br /><br />
<?= $footer; ?>