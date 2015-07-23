<?php
?>
<h1>New Bill Payment</h1>

<div class="row">
	<div class="bluestripe"></div>
</div>
<div class="row">
	<div
		class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 details padding20">
		<form class="form-inline" action="Bill-Payment-Amount">
			<div class="row marginTop20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
						<label for="account">Account: &nbsp; &nbsp;</label> <select
							class="form-control" id="account">
							<option>Kinkead Family Trust/083-006 45-333-3232 ($33,453.98)</option>
							<option>Kinkead Murphy Unit Trust/083-006 45-214-8745 ($2,400.33)</option>
							<option>Kinkead Superannuation Fundt/083-006 45-546-3298
								($14,342.33)</option>
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
							class="form-control" id="biller">
							<option>Select Biller</option>
							<option>blah</option>
							<option>blah blah</option>
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