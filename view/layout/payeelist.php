<?php
?>
<h1>Payee List</h1>

<div class="row">
	<div class="bluestripe"></div>
</div>
<div class="row">
	<div
		class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 history">
		<form class="form-inline" action="">
			<div class="row marginTop20">
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">Payment Type:</div>
				<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
					<select class="form-control" id="paymentType">
						<option>All Payment Types</option>
						<option>Biller</option>
						<option>Payee</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 marginTop20 textRight">
					<a href="Biller-Add" class="btn btn-primary btn-md active" role="button">Add Biller</a>
					<a href="Payee-Add" class="btn btn-primary btn-md active" role="button">Add Payee</a>
				</div>
			</div>
		</form>
		<div class="row">
			<div
				class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 marginTop20 table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Nickname</th>
							<th>Pay To</th>
							<th>Pay Type</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>ASIC</td>
							<td>AUSTRALIAN SECURITIES & INVESTMENTS COMMISSION</td>
							<td>Biller</td>
							<td><a href="#">Modify</a>&nbsp;<td><a href="#">Delete</a></td>
						</tr>
						<tr>
							<td>ATO</td>
							<td>AUSTRALIAN Taxation Office</td>
							<td>Biller</td>
							<td><a href="#">Modify</a>&nbsp;<td><a href="#">Delete</a></td>
						</tr>
						<tr>
							<td>G KINKEAD</td>
							<td>345-332 4435223432</td>
							<td>Payee</td>
							<td><a href="#">Modify</a>&nbsp;<td><a href="#">Delete</a></td>
						</tr>
						<tr>
							<td>GIO</td>
							<td>AAI LIMITED T/AS GIO HOME & MOTOR INSURANCE</td>
							<td>Biller</td>
							<td><a href="#">Modify</a>&nbsp;<td><a href="#">Delete</a></td>
						</tr>
						<tr>
							<td>Super</td>
							<td>443-543 8873254098</td>
							<td>Payee</td>
							<td><a href="#">Modify</a>&nbsp;<td><a href="#">Delete</a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

