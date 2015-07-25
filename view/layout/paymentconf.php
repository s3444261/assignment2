<?php
?>
<h1>New Bill Payment - Confirmation</h1>

<div class="row">
	<div class="bluestripe"></div>
</div>
<div class="row">
	<div
		class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 details">
		<div class="row">
			<div class="col-md-12 padding20">
				<form class="form-inline" method="post" action="Bill-Payment-Acknowledgement">
					<div class="conf col-xs-3 col-sm-3 col-md-2 col-lg-2">From Account:</div>
					<div class="conf col-xs-9 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['payAccount'])){ echo $_SESSION['payAccount']; } ?></div>
					<div class="conf col-xs-3 col-sm-3 col-md-2 col-lg-2">Biller Code:</div>
					<div class="conf col-xs-9 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['payBillerCode'])){ echo $_SESSION['payBillerCode']; } ?></div>
					<div class="conf col-xs-3 col-sm-3 col-md-2 col-lg-2">Biller Name:</div>
					<div class="conf col-xs-9 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['payBillerName'])){ echo $_SESSION['payBillerName']; } ?></div>
					<div class="conf col-xs-3 col-sm-3 col-md-2 col-lg-2">Biller Nickname:</div>
					<div class="conf col-xs-9 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['payBillerNickname'])){ echo $_SESSION['payBillerNickname']; } ?></div>
					<div class="conf col-xs-3 col-sm-3 col-md-2 col-lg-2">Customer Ref:</div>
					<div class="conf col-xs-9 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['payCustomerRef'])){ echo $_SESSION['payCustomerRef']; } ?></div>
					<div class="conf col-xs-3 col-sm-3 col-md-2 col-lg-2">Amount:</div>
					<div class="conf col-xs-9 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['payAmount'])){ echo $_SESSION['payAmount']; } ?></div>
					<div class="conf col-xs-3 col-sm-3 col-md-2 col-lg-2">Payment Date:</div>
					<div class="conf col-xs-9 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['payDate'])){ echo $_SESSION['payDate']; } ?></div>
					<div class="conf col-xs-12 col-sm-12 col-md-12 col-lg-12 note">This biller is FAB authorised.</div>
					<div class="conf col-xs-12 col-sm-12 col-md-12 col-lg-12 bold">Enter your Internet Banking Password.</div>
					<div class="conf col-xs-3 col-sm-3 col-md-2 col-lg-2">FAB ID:</div>
					<div class="conf col-xs-9 col-sm-9 col-md-10 col-lg-10"><?php if(isset($_SESSION['fabid'])){ echo $_SESSION['fabid']; } ?></div>
					<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<input type="password" class="form-control" name="password" id="password"
								placeholder="Password">
								</div>
					<div class="conf col-xs-12 col-sm-12 col-md-12 col-lg-12 note marginTop20">Bill payments made before 6.30pm AEST/AEDT are processed in 1 business day in most cases.</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 textRight">
						<a href="Bill-Payment-Amount" class="btn btn-primary" role="button">Back</a>
						<button type="submit" name="cancel" class="btn btn-primary">Cancel</button>
						<button type="submit" name="next" class="btn btn-primary">Next</button>
					</div>

				</form>
			</div>
		</div>

	</div>
</div>