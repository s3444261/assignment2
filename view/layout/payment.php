<?php
?>
<h1>New Bill Payment</h1>

<div class="row">
	<div class="bluestripe"></div>
</div>
<div class="row">
	<div
		class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 details padding20">
		<form class="form-inline" method="post" action="Bill-Payment-Amount">
			<div class="row marginTop20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
						<label for="account">Account: &nbsp; &nbsp;</label> <select
							class="form-control" name="account" id="account">
<?php
if (isset ( $_SESSION ['accounts'] )) {
	foreach ( $_SESSION ['accounts'] as $account ) {
		echo '<option value="' . $account ['accountID'] . '" ';
		if(isset($_SESSION ['paySelectedAccount' . $account ['accountID']])){ echo $_SESSION ['paySelectedAccount' . $account ['accountID']]; }
		echo ' >' . $account ['accountName'] . '</option>';
	}
} 
?>
						</select>
					</div>
				</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">Select the
					biller you wish to pay from your Biller List. Additional Billers
					may be added through the Payee List.</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
						<label for="biller">Biller: &nbsp; &nbsp;</label> <select
							class="form-control" name="biller" id="biller">
<?php
if (isset ( $_SESSION ['billers'] )) {
	foreach ( $_SESSION ['billers'] as $biller ) {
		echo '<option value="' . $biller ['billerID'] . '" ';
		if(isset($_SESSION ['paySelectedBiller' . $biller ['billerID']])){ echo $_SESSION ['paySelectedBiller' . $biller ['billerID']]; }
		echo ' >' . $biller ['billerNickname'] . '</option>';
	}
}
?>
						</select>
					</div>
				</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 textRight">
					<a href="Biller-Add" class="btn btn-primary btn-md" role="button">Add Biller</a>
					<button type="submit" class="btn btn-primary">Next</button>
				</div>
			</div>
		</form>
	</div>
</div>