<?php
?>
<h1>Delete Payee</h1>

<div class="row">
	<div class="bluestripe"></div>
</div>
<div class="row">
	<div
		class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 details pupdateing20">
		<form class="form-inline" method="post"
			action="Payee-List">
			<div class="row marginTop20">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">Account Name:</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><?php if(isset($_SESSION['accountName'])){ echo $_SESSION['accountName']; } ?></div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">Account Nickname:</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><?php if(isset($_SESSION['accountNickname'])){ echo $_SESSION['accountNickname']; } ?></div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">BSB:</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><?php if(isset($_SESSION['bsb'])){ echo $_SESSION['bsb']; } ?></div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">Account Number:</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><?php if(isset($_SESSION['accountNumber'])){ echo $_SESSION['accountNumber']; } ?></div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 textCentre">Are
					you sure you want to delete this payee?</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 textCentre">
					<a href="Funds-Transfer-Payee-List" class="btn btn-primary"
						role="button">Cancel</a>
					<button type="submit" name="deletePayee" class="btn btn-primary">Delete</button>
				</div>
			</div>
		</form>
	</div>
</div>