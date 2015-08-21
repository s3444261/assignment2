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
<h1>New Funds Transfer - Bank Acknowledgement</h1>

<div class="row">
	<div class="bluestripe"></div>
</div>
<div class="row">
	<div
		class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 details">
		<div class="row">
			<div class="col-md-12 padding20">
				<div class="ackWell">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bold">Acknowledgement
						Details:</div>
					<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">Status Report:</div>
					<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['transferStatus'])){ echo $_SESSION['transferStatus']; } ?></div>
					<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">Confirmation
						Number:</div>
					<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['transferConf'])){ echo $_SESSION['transferConf']; } ?></div>
					<div class="hidden-xs col-sm-3 col-md-2 col-lg-2 clear">Created:</div>
					<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['transferCreated'])){ echo $_SESSION['transferCreated']; } ?></div>
				</div>
				<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">From Account:</div>
				<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['transferAccount'])){ echo $_SESSION['transferAccount']; } ?></div>
				<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">To Account:</div>
				<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['transferAccountPayee'])){ echo $_SESSION['transferAccountPayee']; } ?></div>
				<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">Description:</div>
				<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['transferDescription'])){ echo $_SESSION['transferDescription']; } ?></div>
				<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">Remitter:</div>
				<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['transferRemitter'])){ echo $_SESSION['transferRemitter']; } ?></div>
				<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">Amount:</div>
				<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['transferAmount'])){ echo '$' . number_format($_SESSION['transferAmount'], 2); } ?></div>
				<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">Payment Date:</div>
				<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
				<?php
				if (isset ( $_SESSION ['transferDate'] )) {
					$date = date_create ( $_SESSION ['transferDate'] );
					$date = date_format ( $date, 'j F Y' );
					echo $date;
				}
				?></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div
					class="col-xs-9 col-sm-9 col-md-9 col-lg-9 textRight marginTop20">
					<form class="form-inline" method="post"
						action="Funds-Transfer-Payment-List">
						<button type="submit" name="transferPaymentList"
							class="btn btn-primary">Return To List</button>
					</form>
				</div>
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 marginTop20">
					<form class="form-inline" method="post" action="New-Funds-Transfer">
						<button type="submit" name="transferNewFundsTransfer"
							class="btn btn-primary">Make Another Funds Transfer</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>