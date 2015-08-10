<?php
?>
<h1>Delete Biller Details</h1>

<div class="row">
	<div class="bluestripe"></div>
</div>
<div class="row">
	<div
		class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 details padding20">
		<form class="form-inline" method="post" action="Payee-List">
			<div class="row marginTop20">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">Biller Code:</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><?php if(isset($_SESSION['billerCode'])){ echo $_SESSION['billerCode']; } ?></div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">Biller Name:</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><?php if(isset($_SESSION['billerName'])){ echo $_SESSION['billerName']; } ?></div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">Biller Nickname:</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><?php if(isset($_SESSION['billerNickname'])){ echo $_SESSION['billerNickname']; } ?></div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">Customer Reference
					No:</div>
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><?php if(isset($_SESSION['customerReference'])){ echo $_SESSION['customerReference']; } ?></div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					Are you sure you want to Delete this Biller?
				</div>
			</div>
			<div class="row marginTop20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 textCentre">
					<a href="Bill-Payee-List" class="btn btn-primary" role="button">Cancel</a>
					<button type="submit" name="deleteBiller" class="btn btn-primary">Delete</button>
				</div>
			</div>
		</form>
	</div> 
</div>