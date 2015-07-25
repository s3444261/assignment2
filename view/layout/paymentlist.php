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
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 textRight">
				Refine transactions: &nbsp; &nbsp;
				<button class="btn btn-primary" type="button" data-toggle="collapse"
					data-target="#filter" aria-expanded="false" aria-controls="filter">
					Filter</button>
			</div>
		</div>
		<form class="form-inline" action="">
			<div class="row marginTop20">
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">Payment Type:</div>
				<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
					<select class="form-control" id="paymentType">
						<option>All Payment Types</option>
						<option <?php if(isset($_SESSION['paymentTypeBillSelected'])){ echo $_SESSION['paymentTypeBillSelected']; } ?> >Bill Payment</option>
						<option <?php if(isset($_SESSION['paymentTypeTransferSelected'])){ echo $_SESSION['paymentTypeTransferSelected']; } ?> >Funds Transfer</option>
					</select>
				</div>
			</div>
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
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">Payees:</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
						<select class="form-control" id="payees">
							<option>CITY WEST WATER LIMITED</option>
							<option>STATE REVENUE OFFICE VIC LAND TAX</option>
							<option>YARRA CITY COUNCIL RATES</option>
						</select>
					</div>
				</div>
				<div class="row marginTop20">
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">Status:</div>
					<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
						<select class="form-control" id="status">
							<option>Paid</option>
							<option>Pending</option>
						</select>
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
						<tr>
							<td>13 Jul 15</td>
							<td>Bill Payment</td>
							<td>Kinkead Family Trust/083-006 45-333-3232</td>
							<td>CITY WEST WATER LIMITED</td>
							<td>Paid</td>
							<td class="accountBalance">198.48</td>
						</tr>
						<tr>
							<td>29 May 15</td>
							<td>Bill Payment</td>
							<td>Kinkead Family Trust/083-006 45-333-3232</td>
							<td>YARRA CITY COUNCIL RATES</td>
							<td>Paid</td>
							<td class="accountBalance">410.00</td>
						</tr>
						<tr>
							<td>26 May 15</td>
							<td>Bill Payment</td>
							<td>Kinkead Family Trust/083-006 45-333-3232</td>
							<td>STATE REVENUE OFFICE VIC LAND TAX</td>
							<td>Paid</td>
							<td class="accountBalance">626.81</td>
						</tr>
						<tr>
							<td>22 May 15</td>
							<td>Bill Payment</td>
							<td>Kinkead Family Trust/083-006 45-333-3232</td>
							<td>RACV INSURANCE PTY LTD</td>
							<td>Paid</td>
							<td class="accountBalance">159.48</td>
						</tr>
						<tr>
							<td>19 May 15</td>
							<td>Bill Payment</td>
							<td>Kinkead Family Trust/083-006 45-333-3232</td>
							<td>RACV INSURANCE PTY LTD</td>
							<td>Paid</td>
							<td class="accountBalance">137.21</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

