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
<h1>Add Biller Details</h1>

<div class="row">
	<div class="bluestripe"></div>
</div>
<div class="row">
	<div
		class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 details padding20">
		<form class="form-inline" method="post" action="New-Bill-Payment">
			<div class="row marginTop20">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">Biller Code:</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><input type="number" class="form-control" name="addBillerCode" id="addBillerCode"
						placeholder="Biller Code" minlength="4" required></div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">Biller Name:</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><input type="text" class="form-control" name="addBillerName" id="addBillerName"
						placeholder="Biller Name" required></div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">Biller Nickname:</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
					<input type="text" class="form-control" name="addBillerNickname" id="addBillerNickname"
						placeholder="Biller Nickname" required>
				</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">Customer Reference
					No:</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
					<input type="number" class="form-control" name="addBillerCustomerRefNumber" id="addBillerCustomerRefNumber"
						placeholder="Customer Reference No" minlength="8" required>
				</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-12 textRight">
					<a href="New-Bill-Payment" class="btn btn-primary" role="button">Cancel</a>
					<button type="submit" name="addBiller" class="btn btn-primary">Add</button>
				</div>
			</div>
		</form>
	</div>
</div>