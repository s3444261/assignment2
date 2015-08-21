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
<h1>Check Your Funds Transfer</h1>

<div class="row">
	<div class="bluestripe"></div>
</div>
<div class="row">
	<div
		class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 details">
		<form class="form-inline" method="post"
			action="Funds-Transfer-Acknowledgement">
			<div class="row marginTop20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 transferHeader">
					Account Details</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bold textRight">From
					Account:</div>
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"><?php if(isset($_SESSION['transferAccount'])){ echo $_SESSION['transferAccount']; } ?></div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bold textRight">To
					Account:</div>
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"><?php if(isset($_SESSION['transferAccountPayee'])){ echo $_SESSION['transferAccountPayee']; } ?></div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bold textRight">&nbsp;</div>
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 note">Warning:
					Please ensure all details are correct. FAB cannot check the account
					name matches the BSB or account number.</div>
			</div>
			<div class="row">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bold textRight">&nbsp;</div>
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 note">An incorrect
					BSB or account number will result in your money being paid to the
					wrong account and may result in the loss of your funds.</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 transferHeader">
					Transaction Details</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bold textRight">Amount:</div>
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"><?php if(isset($_SESSION['transferAmount'])){ echo '$' . number_format($_SESSION['transferAmount'], 2); } ?></div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bold textRight">Description:</div>
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"><?php if(isset($_SESSION['transferDescription'])){ echo $_SESSION['transferDescription']; } ?></div>
			</div>

			<div class="row marginTop20">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bold textRight">Remitter
					Name:</div>
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"><?php if(isset($_SESSION['transferRemitter'])){ echo $_SESSION['transferRemitter']; } ?></div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 transferHeader">
					Transfer Schedule</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bold textRight">Transfer
					Date:</div>
				<div class="form-group col-xs-8 col-sm-8 col-md-8 col-lg-8">
				<?php
				if (isset ( $_SESSION ['transferDate'] )) {
					$date = date_create ( $_SESSION ['transferDate'] );
					$date = date_format ( $date, 'j F Y' );
					echo $date;
				}
				?></div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 transferHeader">
					Authorisation</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bold textRight">FAB
					ID:</div>
				<div class="form-group col-xs-8 col-sm-8 col-md-8 col-lg-8"><?php if(isset($_SESSION['fabid'])){ echo $_SESSION['fabid']; } ?></div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bold textRight">Internet
					Banking Password:</div>
				<div class="form-group col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<input type="password" class="form-control" name="password"
						id="password" placeholder="Password">
				</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 textRight">
					<a href="New-Funds-Transfer" class="btn btn-primary btn-md"
						role="button">Back</a>
					<button type="submit" name="cancel" class="btn btn-primary">Cancel</button>
					<button type="submit" name="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</form>
	</div>
</div>