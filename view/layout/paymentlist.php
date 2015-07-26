<?php

?>
<h1>Payment List</h1>

<div class="row">
	<div class="bluestripe"></div>
</div>
<div class="row">
	<div
		class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 history">
		<div class="row">
			<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 textRight">
				Refine transactions: &nbsp; &nbsp;
				<button class="btn btn-primary" type="button" data-toggle="collapse"
					data-target="#filter" aria-expanded="false" aria-controls="filter">
					Filter</button>
			</div>
			<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
				<form class="form-inline" method="post" action="
<?php 
if(isset($_SESSION['AllPaymentList'])){
	echo 'All-Payment-List';
} else if(isset($_SESSION['BillPaymentList'])){
	echo 'Bill-Payment-List';
} else if(isset($_SESSION['fundsTransferPaymentList'])){
	echo 'Funds-Transfer-Payment-List';
}
?>">
					<button class="btn btn-primary" type="submit" name="clearFilter">Clear Filter</button>
				</form>
			</div>
		</div>
		<form class="form-inline" method="post" action="Bill-Payment-List">
			<div class="row marginTop20">
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">Payment Type:</div>
				<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
					<select class="form-control" name="paymentType" id="paymentType">
						<option
							<?php if(isset($_SESSION['AllPaymentList'])){ echo $_SESSION['AllPaymentList']; } ?>>All
							Payment Types</option>
						<option
							<?php if(isset($_SESSION['billPaymentList'])){ echo $_SESSION['billPaymentList']; } ?>>Bill
							Payment</option>
						<option
							<?php if(isset($_SESSION['fundsTransferPaymentList'])){ echo $_SESSION['fundsTransferPaymentList']; } ?>>Funds
							Transfer</option>
					</select>
				</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">Account:</div>
				<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
					<select class="form-control" name="account" id="account">
<?php
if (isset ( $_SESSION ['accounts'] )) {
	foreach ( $_SESSION ['accounts'] as $account ) {
		echo '<option value="' . $account ['accountID'] . '" ';
		if (isset ( $_SESSION ['payListSelectedAccount' . $account ['accountID']] )) {
			echo $_SESSION ['payListSelectedAccount' . $account ['accountID']];
		}
		echo ' >' . $account ['accountName'] . '</option>';
	}
}
?>
					</select>
				</div>
			</div>
			<div class="collapse" id="filter">
				<div class="row marginTop20">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">Payees:</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
						<select class="form-control" name="payees" id="payees">
							<option>--- Select a Payee ---</option>
<?php
if (isset ( $_SESSION ['payees'] )) {
	foreach ( $_SESSION ['payees'] as $payee ) {
		echo '<option value="' . $payee ['payeeID'] . '" ';
		if (isset ( $_SESSION ['payListSelectedPayee' . $payee ['payeeID']] )) {
			echo $_SESSION ['payListSelectedPayee' . $payee ['payeeID']];
		}
		echo ' >' . $payee ['payeeNickname'] . '</option>';
	}
}
?>
						</select>
					</div>
				</div>
				<div class="row marginTop20">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">Status:</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
						<select class="form-control" name="status" id="status">
							<option>--- Select Status ---</option>
							<option
								<?php if(isset($_SESSION['paidSelected'])){ echo $_SESSION['paidSelected']; } ?>>Paid</option>
							<option
								<?php if(isset($_SESSION['pendingSelected'])){ echo $_SESSION['pendingSelected']; } ?>>Pending</option>
						</select>
					</div>
				</div>
				<div class="row marginTop20">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">From Amount:</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
						<input type="text" class="form-control" name="fromAmount"
							id="fromAmount" placeholder="$"
							value="<?php if(isset($_SESSION['payListFromAmount'])){ echo $_SESSION['payListFromAmount']; } ?>">
					</div>
				</div>
				<div class="row marginTop20">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">To Amount:</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
						<input type="text" class="form-control" name="toAmount"
							id="toAmount" placeholder="$"
							value="<?php if(isset($_SESSION['payListToAmount'])){ echo $_SESSION['payListToAmount']; } ?>">
					</div>
				</div>
				<div class="row marginTop20">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">From Date:</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
						<input type="date" class="form-control" name="fromDate"
							id="fromDate" placeholder="From Date"
							value="<?php if(isset($_SESSION['payListFromDate'])){ echo $_SESSION['payListFromDate']; } ?>">
					</div>
				</div>
				<div class="row marginTop20">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">To Date:</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
						<input type="date" class="form-control" name="toDate" id="toDate"
							placeholder="To Date"
							value="<?php if(isset($_SESSION['payListToDate'])){ echo $_SESSION['payListToDate']; } ?>">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 marginTop20">
					<button type="submit" class="btn btn-primary">Display</button>
				</div>
			</div>
		</form>
		<div class="row">
			<div
				class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 marginTop20 table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Date</th>
							<th>Type</th>
							<th>Pay From</th>
							<th>Pay To</th>
							<th>Status</th>
							<th class="accountBalance">Amount</th>
						</tr>
					</thead>
					<tbody>
<?php
if (isset ( $_SESSION ['billPaymentList'] )) {
	foreach ( $_SESSION ['payeeTransactions'] as $pt )
		echo '<tr>
							<td>' . $pt ['payeeDate'] . '</td>
							<td>' . $pt ['payeeType'] . '</td>
							<td>' . $pt ['payeePayFrom'] . '</td>
							<td>' . $pt ['payeePayTo'] . '</td>
							<td>' . $pt ['payeeStatus'] . '</td>
							<td class="accountBalance">' . $pt ['payeeAmount'] . '</td>
						</tr>'; 
} 
?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

