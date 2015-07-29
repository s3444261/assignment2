<?php
?>
<h1>Modify Payee Details</h1>

<div class="row">
	<div class="bluestripe"></div>
</div>
<div class="row">
	<div
		class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 details pupdateing20">
		<form class="form-inline" method="post" action="Funds-Transfer-Payee-List">
			<div class="row marginTop20">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">Account Name:</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><input type="text" class="form-control" name="updatePayeeAccountName" id="updatePayeeAccountName"
						placeholder="Account Name" value="G. Kinkead Cheque Account"></div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">Account Nickname:</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><input type="text" class="form-control" name="updatePayeeAccountNickname" id="updatePayeeAccountNickname"
						placeholder="Account Nickname" value="G. Kinkead Cheque Account"></div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">BSB:</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
					<input type="text" class="form-control" name="updatePayeeBSB" id="updatePayeeBSB"
						placeholder="BSB" value="086547">
				</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">Account Number:</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
					<input type="text" class="form-control" name="updatePayeeAccountNumber" id="updatePayeeAccountNumber"
						placeholder="Account No" value="55478862">
				</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 textCentre">
					<a href="Funds-Transfer-Payee-List" class="btn btn-primary" role="button">Cancel</a>
					<button type="submit" name="updatePayee" class="btn btn-primary">Update</button>
				</div>
			</div>
		</form>
	</div>
</div>