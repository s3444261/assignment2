<?php
?>
<h1>New Bill Payment - Bank Acknowledgement</h1>

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
					<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['payStatus'])){ echo $_SESSION['payStatus']; } ?></div>
					<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">Confirmation
						Number:</div>
					<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['payConf'])){ echo $_SESSION['payConf']; } ?></div>
					<div class="hidden-xs col-sm-3 col-md-2 col-lg-2 clear">Created:</div>
					<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['payCreated'])){ echo $_SESSION['payCreated']; } ?></div>
				</div>
				<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">From Account:</div>
				<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['payAccount'])){ echo $_SESSION['payAccount']; } ?></div>
				<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">Biller Code:</div>
				<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['payBillerCode'])){ echo $_SESSION['payBillerCode']; } ?></div>
				<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">Biller Name:</div>
				<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['payBillerName'])){ echo $_SESSION['payBillerName']; } ?></div>
				<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">Biller Nickname:</div>
				<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['payBillerNickname'])){ echo $_SESSION['payBillerNickname']; } ?></div>
				<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">Customer Ref:</div>
				<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['payCustomerRef'])){ echo $_SESSION['payCustomerRef']; } ?></div>
				<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">Amount:</div>
				<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['payAmount'])){ echo '$' . number_format($_SESSION['payAmount'], 2); } ?></div>
				<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">Payment Date:</div>
				<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['payDate'])){ echo $_SESSION['payDate']; } ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 textRight marginTop20">
					<form class="form-inline" method="post" action="Bill-Payment-List">
						<button type="submit" name="payPaymentList"
							class="btn btn-primary">Return To List</button>
					</form>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 marginTop20">
					<form class="form-inline" method="post" action="New-Bill-Payment">
						<button type="submit" name="payNewBillPayment"
							class="btn btn-primary">Pay Another Bill</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>