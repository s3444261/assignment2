<?php
$driver = Driver::getInstance ();

?>
<h1>Transaction History</h1>

<div class="row">
	<div class="bluestripe"></div>
</div>
<div class="row">
	<div
		class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 history">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 note">* Balances
				shown on this transaction history may include transactions that are
				not yet completed and may vary from the blanaces shown on your
				account statements</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 textRight">
				Refine transactions: &nbsp; &nbsp;
				<button class="btn btn-primary" type="button" data-toggle="collapse"
					data-target="#filter" aria-expanded="false" aria-controls="filter">
					Filter</button>
			</div>
		</div>
		<form class="form-inline" method="post" action="Transaction-History">
			<div class="row marginTop20">
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">Account:</div>
				<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
					<select class="form-control" name="account" id="account">
<?php
if (isset ( $_SESSION ['accounts'] )) {
	foreach ( $_SESSION ['accounts'] as $account ) {
		echo '<option value="' . $account ['accountID'] . '" ';
		if(isset($_SESSION ['selectedAccount' . $account ['accountID']])){ echo $_SESSION ['selectedAccount' . $account ['accountID']]; }
		echo ' >' . $account ['accountName'] . '</option>';
	}
}
?>
					</select>
				</div>
			</div>
			<div class="collapse" id="filter">
				<div class="row marginTop20">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">Search
						Details:</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
						<input type="text" class="form-control" name="searchDetails"
							id="searchDetails" placeholder="Search Details">
					</div>
				</div>
				<div class="row marginTop20">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">From Amount:</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
						<input type="text" class="form-control" name="fromAmount"
							id="fromAmount" placeholder="$">
					</div>
				</div>
				<div class="row marginTop20">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">To Amount:</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
						<input type="text" class="form-control" name="toAmount"
							id="toAmount" placeholder="$">
					</div>
				</div>
				<div class="row marginTop20">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">From Date:</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
						<input type="date" class="form-control" name="fromDate"
							id="fromDate" placeholder="From Date">
					</div>
				</div>
				<div class="row marginTop20">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">To Date:</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
						<input type="date" class="form-control" name="toDate" id="toDate"
							placeholder="To Date">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 marginTop20">
					<button type="submit" class="btn btn-primary">View Transactions</button>
				</div>
			</div>
		</form>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 marginTop20">Period:
				<?php if(isset($_SESSION['period'])){echo $_SESSION['period'];} ?></div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">Found: <?php if(isset($_SESSION['found'])){ echo $_SESSION['found'];} ?></div>
		</div>
		<div class="row">
			<div
				class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 marginTop20 table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Date</th>
							<th>Transaction Details</th>
							<th class="accountBalance">Debit</th>
							<th class="accountBalance">Credit</th>
							<th class="accountBalance">Balance *</th>
						</tr>
					</thead>
					<tbody>
<?php
if (isset ( $_SESSION ['history'] )) {
	foreach ( $_SESSION ['history'] as $history ) {
		echo '<tr>
				<td>' . $history ['date'] . '</td>
				<td><table>
						<tr>
							<td>' . $history ['transaction'] . '</td>
						</tr>
						<tr>
							<td>' . $history ['type'] . '</td>
						</tr>
					</table></td>
				<td class="accountBalance">' . $history ['debit'] . '</td>
				<td class="accountBalance">' . $history ['credit'] . '</td>
				<td class="accountBalance">' . $history ['balance'] . '</td>
			</tr>';
	}
}
?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row topBorder topPadding">
			<div class="col-xs-3 col-sm-3 col-md-3 historyTotals">Debits</div>
			<div class="col-xs-3 col-sm-3 col-md-3 textRight"><?php if(isset($_SESSION['historyNet'])){ echo $_SESSION['historyDebit']; } ?></div>
		</div>
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3 historyTotals">+ Fees</div>
			<div class="col-xs-3 col-sm-3 col-md-3 textRight"><?php if(isset($_SESSION['historyNet'])){ echo $_SESSION['historyFee']; } ?></div>
		</div>
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3 historyTotals">- Credits</div>
			<div class="col-xs-3 col-sm-3 col-md-3 textRight"><?php if(isset($_SESSION['historyNet'])){ echo $_SESSION['historyCredit']; } ?></div>
		</div>
		<div class="row bottomBorder bottomPadding">
			<div class="col-xs-3 col-sm-3 col-md-3 historyTotals">= Net Cash Flow</div>
			<div class="col-xs-3 col-sm-3 col-md-3 textRight"><?php if(isset($_SESSION['historyNet'])){ echo $_SESSION['historyNet']; } ?></div>
		</div>
		<div class="row topPadding bottomPadding">
			<div class="col-xs-12 col-sm-12 col-md-12">To view transactions
				beyond the dates displayed, adjust your filter settings.</div>
		</div>
	</div>
</div>

