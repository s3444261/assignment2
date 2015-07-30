<?php
?>
<h1>Account Details</h1>

<div class="row">
	<div class="bluestripe"></div>
</div>
<div class="row">
	<div
		class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 details">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<form class="form-inline" method="post" action="Account-Details">
					<div class="form-group">
						<label for="account">Account: &nbsp; &nbsp;</label> <select
							class="form-control" id="account" name="account">
<?php
if (isset ( $_SESSION ['accounts'] )) {
	foreach ( $_SESSION ['accounts'] as $account ) {
		echo '<option value="' . $account ['accountID'] . '" ';
		if(isset($_SESSION ['detSelectedAccount' . $account ['accountID']])){ echo $_SESSION ['detSelectedAccount' . $account ['accountID']]; }
		echo ' >' . $account ['accountName'] . '</option>';
	}
}
?>
						</select>
					</div>
					<button type="submit" class="btn btn-primary">View Account Details</button>
				</form>
			</div>
		</div>
		<div class="row">
			<div
				class="col-xs-12 col-sm-12 col-md-12 col-lg-12 marginTop20">
				<div class="col-xs-6 col-md-4">Account Nickname:</div>
				<div class="col-xs-6 col-md-3 textRight"><?php if(isset($_SESSION['detAccountNickname'])){ echo $_SESSION['detAccountNickname']; } ?></div>
				<div class="col-xs-hidden col-md-5">&nbsp;</div>
				<div class="col-xs-6 col-md-4">Account Number:</div>
				<div class="col-xs-6 col-md-3 textRight"><?php if(isset($_SESSION['detAccountNumber'])){ echo $_SESSION['detAccountNumber']; } ?></div>
				<div class="col-xs-hidden col-md-5">&nbsp;</div>
				<div class="col-xs-6 col-md-4">Product Name:</div>
				<div class="col-xs-6 col-md-3 textRight"><?php if(isset($_SESSION['detProductName'])){ echo $_SESSION['detProductName']; } ?></div>
				<div class="col-xs-hidden col-md-5">&nbsp;</div>
				<div class="col-xs-6 col-md-4">Recorded Limit:</div>
				<div class="col-xs-6 col-md-3 textRight"><?php if(isset($_SESSION['detRecordedLimit'])){ echo $_SESSION['detRecordedLimit']; } ?></div>
				<div class="col-xs-hidden col-md-5">&nbsp;</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 marginTop20">
				<div class="col-xs-12 col-md-12 accountDetails">Interest</div>
				<div class="col-xs-6 col-md-4">Accrued Debit Interest:</div>
				<div class="col-xs-6 col-md-3 textRight"><?php if(isset($_SESSION['detAccruedDebitInterest'])){ echo $_SESSION['detAccruedDebitInterest']; } ?></div>
				<div class="col-xs-hidden col-md-5">&nbsp;</div>
				<div class="col-xs-6 col-md-4">Accrued Credit Interest:</div>
				<div class="col-md-3 textRight"><?php if(isset($_SESSION['detAccruedCreditInterest'])){ echo $_SESSION['detAccruedCreditInterest']; } ?></div>
				<div class="col-xs-hidden col-md-5">&nbsp;</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 marginTop20">
				<div class="col-xs-12 col-md-12 accountDetails">Credit Interest
					Details</div>
				<div class="col-xs-6 col-md-4">Credit interest earned last financial
					year was:</div>
				<div class="col-xs-6 col-md-3 textRight"><?php if(isset($_SESSION['detInterestEarned'])){ echo $_SESSION['detInterestEarned']; } ?></div>
				<div class="col-xs-hidden col-md-5">&nbsp;</div>
			</div>
		</div>
	</div>
</div>