<?php
?>
<h1>New Funds Transfer</h1>

<div class="row">
	<div class="bluestripe"></div>
</div>
<div class="row">
	<div
		class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 details">
		<form class="form-inline" action="">
			<div class="row marginTop20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 transferHeader">
					1. From Account</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bold textRight">Select
					Account:</div>
				<div class="form-group col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<select class="form-control" id="account">
						<option>Select Account</option>
						<option>Kinkead Family Trust/083-006 45-333-3232 ($33,453.98)</option>
						<option>Kinkead Murphy Unit Trust/083-006 45-214-8745 ($2,400.33)</option>
						<option>Kinkead Superannuation Fund/083-006 45-546-3298
							($14,342.33)</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bold textRight">&nbsp;</div>
				<div class="form-group col-xs-8 col-sm-8 col-md-8 col-lg-8 note">Funds
					available to transfer are displayed next to the account</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 transferHeader">
					2. To Account</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bold textRight">My
					FAB Account/My Payee:</div>
				<div class="form-group col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<select class="form-control" id="toaccount">
						<option>Select Account</option>
						<option>M Kinkead/701-583 45-333-2121</option>
						<option>Kinkead Family Trust/083-006 45-333-3232</option>
						<option>Kinkead Murphy Unit Trust/083-006 45-214-8745</option>
						<option>Kinkead Superannuation Fund/083-006 45-546-3298</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 textRight">
					<a href="Payee-Add" class="btn btn-primary btn-md" role="button">Add
						Payee</a>
				</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 transferHeader">
					3. Transaction Details</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bold textRight">Amount:</div>
				<div class="form-group col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<input type="text" class="form-control" id="amount"
						placeholder="Amount">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bold textRight">&nbsp;</div>
				<div class="form-group col-xs-8 col-sm-8 col-md-8 col-lg-8 note">Daily
					transfer limits apply for payments outside of your own accounts</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bold textRight">Description:</div>
				<div class="form-group col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<input type="text" class="form-control" id="description"
						placeholder="Description">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bold textRight">&nbsp;</div>
				<div class="form-group col-xs-8 col-sm-8 col-md-8 col-lg-8 note">This
					will appear on your and the payee's statement</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bold textRight">Remitter
					Name:</div>
				<div class="form-group col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<input type="text" class="form-control" id="remitter"
						placeholder="Remitter">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bold textRight">&nbsp;</div>
				<div class="form-group col-xs-8 col-sm-8 col-md-8 col-lg-8 note">This
					will appear on the payee's statement</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 transferHeader">
					4. Transfer Schedule</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bold textRight">Transfer
					Date:</div>
				<div class="form-group col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<input type="date" class="form-control" id="transferDate"
						placeholder="Transfer Date">
				</div>
			</div>
			<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bold textRight">&nbsp;</div>
				<div class="form-group col-xs-8 col-sm-8 col-md-8 col-lg-8 note">Please
					ensure your payment does not exceed your daily transfer limit and
					you have available funds on the due date</div>
			</div>

			<div class="row marginTop20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 textRight">
					<a href="Payee-List" class="btn btn-primary btn-md" role="button">Cancel</a>
					<button type="submit" class="btn btn-primary">Next</button>
				</div>
			</div>
		</form>
	</div>
</div>