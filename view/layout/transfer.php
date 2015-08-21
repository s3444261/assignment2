<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
?>
<h1>New Funds Transfer</h1>

<div class="row">
	<div class="bluestripe"></div>
</div>
<div class="row">
	<div
		class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 details">
		<form class="form-inline" method="post" action="Check-Transfer">
			<div class="row marginTop20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 transferHeader">
					1. From Account</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bold textRight">Select
					Account:</div>
				<div class="form-group col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<select class="form-control" name="account" id="account"
						placeholder="--- Select Account ---" required>
<?php
if (isset ( $_SESSION ['accounts'] )) {
	foreach ( $_SESSION ['accounts'] as $account ) {
		echo '<option value="' . $account ['accountID'] . '" ';
		if (isset ( $_SESSION ['transferSelectedAccount' . $account ['accountID']] )) {
			echo $_SESSION ['transferSelectedAccount' . $account ['accountID']];
		}
		echo ' >' . $account ['accountName'] . ' ( $' . $account ['currentBalance'] . ' )</option>';
	}
}
?>
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
					<select class="form-control" name="accountPayee" id="accountPayee"
						required>
<?php
if (isset ( $_SESSION ['accountPayee'] )) {
	foreach ( $_SESSION ['accountPayee'] as $accountPayee ) {
		echo '<option value="' . $accountPayee ['toID'] . '" ';
		if (isset ( $_SESSION ['transferSelectedAccountPayee' . $accountPayee ['toID']] )) {
			echo $_SESSION ['transferSelectedAccountPayee' . $accountPayee ['toID']];
		}
		echo ' >' . $accountPayee ['accountName'] . '</option>';
	}
}
?>
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
					<input type="text" class="form-control" name="transferAmount"
						id="transferAmount" placeholder="0.00"
						value="<?php if(isset($_SESSION['transferAmount'])){ echo $_SESSION['transferAmount']; } ?>"
						pattern="\d+(\.\d{2})?" required>
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
					<input type="text" class="form-control" name="transferDescription"
						id="transferDescription" placeholder="Description"
						value="<?php if(isset($_SESSION['transferDescription'])){ echo $_SESSION['transferDescription']; } ?>"
						required>
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
					<input type="text" class="form-control" name="transferRemitter"
						id="transferRemitter" placeholder="Remitter"
						value="<?php if(isset($_SESSION['transferRemitter'])){ echo $_SESSION['transferRemitter']; } ?>"
						required>
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
					<input type="date" class="form-control" name="transferDate"
						id="transferDate" placeholder="Transfer Date"
						value="<?php if(isset($_SESSION['transferDate'])){ echo $_SESSION['transferDate']; } ?>"
						required>
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
					<button type="submit" name="cancel" class="btn btn-primary">Cancel</button>
					<button type="submit" name="next" class="btn btn-primary">Next</button>
				</div>
			</div>
		</form>
	</div>
</div>