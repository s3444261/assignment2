<?php
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
		<form class="form-inline" action="">
			<div class="row marginTop20">
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">Account:</div>
				<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
					<select class="form-control" id="account">
						<option>Kinkead Family Trust/083-006 45-333-3232</option>
						<option>Kinkead Murphy Unit Trust/083-006 45-214-8745</option>
						<option>Kinkead Superannuation Fundt/083-006 45-546-3298</option>
					</select>
				</div>
			</div>
			<div class="collapse" id="filter">
				<div class="row marginTop20">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">Search
						Details:</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
						<input type="text" class="form-control" id="searchDetails"
							placeholder="Search Details">
					</div>
				</div>
				<div class="row marginTop20">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">From Amount:</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
						<input type="text" class="form-control" id="fromAmount"
							placeholder="$">
					</div>
				</div>
				<div class="row marginTop20">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">To Amount:</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
						<input type="text" class="form-control" id="toAmount"
							placeholder="$">
					</div>
				</div>
				<div class="row marginTop20">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">From Date:</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
						<input type="date" class="form-control" id="fromDate"
							placeholder="From Date">
					</div>
				</div>
				<div class="row marginTop20">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">To Date:</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
						<input type="date" class="form-control" id="toDate"
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
				04/04/15 to 13/07/15</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">Found: 3
				Transactions</div>
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
						<tr>
							<td>30 Jun 15</td>
							<td><table>
									<tr>
										<td>FEE ACCOUNT 083006 866784433</td>
									</tr>
									<tr>
										<td>FEES</td>
									</tr>
								</table></td>
							<td class="accountBalance">1.00 DR</td>
							<td class="accountBalance"></td>
							<td class="accountBalance">58.47 CR</td>
						</tr>
						<tr>
							<td>22 Jun 15</td>
							<td><table>
									<tr>
										<td>TT40W444234 IB Ref D2343244 TRANSFER</td>
									</tr>
									<tr>
										<td>MISCELLANEOUS DEBIT</td>
									</tr>
								</table></td>
							<td class="accountBalance">2022.00 DR</td>
							<td class="accountBalance"></td>
							<td class="accountBalance">59.47 CR</td>
						</tr>
						<tr>
							<td>19 Jun 15</td>
							<td><table>
									<tr>
										<td>Transfer BANKVIC</td>
									</tr>
									<tr>
										<td>INTER-BANK CREDIT</td>
									</tr>
								</table></td>
							<td class="accountBalance"></td>
							<td class="accountBalance">2000.00 CR</td>
							<td class="accountBalance">2081.477 CR</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row topBorder topPadding">
			<div class="col-xs-3 col-sm-3 col-md-3 historyTotals">Debits</div>
			<div class="col-xs-3 col-sm-3 col-md-3 textRight">2022 DR</div>
		</div>
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3 historyTotals">+ Fees</div>
			<div class="col-xs-3 col-sm-3 col-md-3 textRight">1.00 DR</div>
		</div>
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3 historyTotals">- Credits</div>
			<div class="col-xs-3 col-sm-3 col-md-3 textRight">2000 CR</div>
		</div>
		<div class="row bottomBorder bottomPadding">
			<div class="col-xs-3 col-sm-3 col-md-3 historyTotals">= Net Cash Flow</div>
			<div class="col-xs-3 col-sm-3 col-md-3 textRight">23 DR</div>
		</div>
		<div class="row topPadding bottomPadding">
			<div class="col-xs-12 col-sm-12 col-md-12">To view transactions
				beyond the dates displayed, adjust your filter settings.</div>
		</div>
	</div>
</div>

