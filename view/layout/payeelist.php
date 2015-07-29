<?php
?>
<h1>Payee List</h1>

<div class="row">
	<div class="bluestripe"></div>
</div>
<div class="row">
	<div
		class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 history">
		<form class="form-inline" method="post" action="Payee-List">
			<div class="row marginTop20">
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bold">Payee Type:</div>
				<div class="form-group col-xs-10 col-sm-10 col-md-10 col-lg-10">
					<select class="form-control" name="payeeType" id="payeeType">
						<option
							<?php if(isset($_SESSION['allPayeeList'])){ echo $_SESSION['allPayeeList']; } ?>>All
							Payment Types</option>
						<option
							<?php if(isset($_SESSION['billPayeeList'])){ echo $_SESSION['billPayeeList']; } ?>>Bill
							Payment</option>
						<option
							<?php if(isset($_SESSION['fundsTransferPayeeList'])){ echo $_SESSION['fundsTransferPayeeList']; } ?>>Funds
							Transfer</option>
					</select>
					<button type="submit" class="btn btn-primary">Display</button>
				</div>
			</div>
		</form>
	<div class="row">
		<div
			class="col-xs-12 col-sm-12 col-md-12 col-lg-12 marginTop20 textRight">
			<a href="Biller-Add" class="btn btn-primary btn-md"
				role="button">Add Biller</a> <a href="Payee-Add"
				class="btn btn-primary btn-md" role="button">Add Payee</a>
		</div>
	</div>

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
<?php
if (isset ( $_SESSION ['payeeList'] )) {
	foreach ( $_SESSION ['payeeList'] as $p ) {
		echo '<tr>
				<td>' . $p ['payeeNickname'] . '</td>
				<td>' . $p ['payeeName'] . '</td>
				<td>' . $p ['payeeType'] . '</td>
				<td>' . $p ['payeeModify'] . '</td>
				<td>' . $p ['payeeDelete'] . '</td>
			</tr>';
	}
}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>

