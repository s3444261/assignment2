<?php
?>
<h1>Add Payee Details</h1>

<div class="row">
	<div class="bluestripe"></div>
</div>
<div class="row">
	<div
		class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 details padding20">
		<form class="form-inline" method="post" action="New-Funds-Transfer">
			<div class="row marginTop20">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">Account Name:</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><input type="text" class="form-control" name="addPayeeAccountName" id="addPayeeAccountName"
						placeholder="Account Name" required></div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">Account Nickname:</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><input type="text" class="form-control" name="addPayeeAccountNickname" id="addPayeeAccountNickname"
						placeholder="Account Nickname" required></div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">BSB:</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
					<input type="text" class="form-control" name="addPayeeBSB" id="addPayeeBSB"
						placeholder="BSB" required>
				</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">Account Number:</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
					<input type="text" class="form-control" name="addPayeeAccountNumber" id="addPayeeAccountNumber"
						placeholder="Account No" required>
				</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-12 textRight">
					<a href="New-Funds-Transfer" class="btn btn-primary" role="button">Cancel</a>
					<button type="submit" name="addPayee" class="btn btn-primary">Add</button>
				</div>
			</div>
		</form>
	</div>
</div>