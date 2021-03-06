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
<h1>New Bill Payment</h1>

<div class="row">
	<div class="bluestripe"></div>
</div>
<div class="row">
	<div
		class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 details">
		<div class="row">
			<div class="col-md-12 padding20">
				<form class="form-inline" method="post"
					action="Bill-Payment-Confirmation">
					<div class="grp1">
						<div class="hidden-xs hidden-sm col-md-1 col-lg-1">1.</div>
						<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">From Account:</div>
						<div class="form-group col-xs-12 col-sm-9 col-md-7 col-lg-6">
							<select class="form-control" name="account" id="account">
<?php
if (isset ( $_SESSION ['accounts'] )) {
	foreach ( $_SESSION ['accounts'] as $account ) {
		echo '<option value="' . $account ['accountID'] . '" ';
		if (isset ( $_SESSION ['paySelectedAccount' . $account ['accountID']] )) {
			echo $_SESSION ['paySelectedAccount' . $account ['accountID']];
		}
		echo ' >' . $account ['accountName'] . ' ( $' . $account ['availableBalance'] . ' )</option>';
	}
}
?>
							</select>
						</div>
						<div class="note hidden-xs hidden-sm col-md-2 col-lg-3">Funds
							available to transfer are displayed next to the account.</div>
					</div>
					<div class="grp2">
						<div class="hidden-xs hidden-sm col-md-1 col-lg-1">2.</div>
						<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">Biller Code:</div>
						<div class="col-xs-12 col-sm-9 col-md-7 col-lg-7"><?php if(isset($_SESSION['payBillerCode'])){ echo $_SESSION['payBillerCode']; } ?></div>
						<div class="hidden-xs hidden-sm col-md-2 col-lg-2">&nbsp;</div>
						<div class="hidden-xs hidden-sm col-md-1 col-lg-1">&nbsp;</div>
						<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">Biller Name:</div>
						<div class="col-xs-12 col-sm-9 col-md-7 col-lg-7"><?php if(isset($_SESSION['payBillerName'])){ echo $_SESSION['payBillerName']; } ?></div>
						<div class="hidden-xs hidden-sm col-md-2 col-lg-2">&nbsp;</div>
						<div class="hidden-xs hidden-sm col-md-1 col-lg-1">&nbsp;</div>
						<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">Biller Nickname:</div>
						<div class="col-xs-12 col-sm-9 col-md-7 col-lg-7"><?php if(isset($_SESSION['payBillerNickname'])){ echo $_SESSION['payBillerNickname']; } ?></div>
						<div class="hidden-xs hidden-sm col-md-2 col-lg-2">&nbsp;</div>
						<div class="hidden-xs hidden-sm col-md-1 col-lg-1">&nbsp;</div>
						<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">Customer Ref:</div>
						<div class="form-group col-xs-12 col-sm-9 col-md-7 col-lg-7">
							<input type="number" class="form-control" name="custref"
								id="custref" placeholder="Customer Reference No"
								value="<?php if(isset($_SESSION['payCustomerRef'])){ echo $_SESSION['payCustomerRef']; } ?>"
								minlength="8" required>
						</div>
						<div class="hidden-xs hidden-sm col-md-2 col-lg-2">&nbsp;</div>
						<div class="hidden-xs hidden-sm col-md-1 col-lg-1">&nbsp;</div>
						<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">Amount:</div>
						<div class="form-group col-xs-12 col-sm-9 col-md-5 col-lg-5">
							<input type="text" class="form-control" name="amount" id="amount"
								pattern="\d+(\.\d{2})?" placeholder="0.00"
								value="<?php if(isset($_SESSION['payAmount'])){ echo $_SESSION['payAmount']; } ?>"
								required>
						</div>
						<div class="note hidden-xs hidden-sm col-md-4 col-lg-4">Daily
							transfer limits apply for payments outside of your own accounts.</div>
					</div>
					<div class="grp3">
						<div class="hidden-xs hidden-sm col-md-1 col-lg-1">3.</div>
						<div class="hidden-xs col-sm-3 col-md-2 col-lg-2">Payment Date:</div>
						<div class="form-group col-xs-12 col-sm-9 col-md-5 col-lg-5">
							<input type="date" class="form-control" name="paymentDate"
								id="paymentDate" placeholder="Payment Date"
								value="<?php if(isset($_SESSION['payDate'])){ echo $_SESSION['payDate']; } ?>"
								required>
						</div>
						<div class="note hidden-xs  hidden-sm col-md-4 col-lg-4">Please
							ensure your payment does not exceed your limit and you have
							available funds on the due date.</div>
					</div>
					<div class="col-xs-12 textRight">
						<a href="New-Bill-Payment" class="btn btn-primary" role="button">Back</a>
						<button type="submit" name="cancel" class="btn btn-primary">Cancel</button>
						<button type="submit" name="next" class="btn btn-primary">Next</button>
					</div>

				</form>
			</div>
		</div>

	</div>
</div>