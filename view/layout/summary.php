<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 */
$driver = Driver::getInstance ();
?>
<h1>Account Summary</h1>

<div class="row">
	<div class="bluestripe">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 summary">
				<div class="table-responsive  marginTop20">
					<table class="table">
						<thead>
							<tr>
								<th></th>
								<th>Account</th>
								<th class="accountBalance">Current Balance</th>
								<th class="accountBalance">Available Balance</th>
							</tr>
						</thead>
						<tbody>
<?php
if (isset ( $_SESSION ['summaryAccounts'] )) {
	foreach ( $_SESSION ['summaryAccounts'] as $account ) {
		$balance = $account ['currentBalance'];
		
		if ($balance >= 0) {
			$sign = ' . CR';
		} else {
			$sign = ' . DR';
			$balance = - $balance;
		}
		echo '<tr>
            <th><span class="glyphicon glyphicon-equalizer" aria-hidden="true"></span></th>
            <td><table><tr><td class="accountName">' . $account ['accountName'] . '</td></tr>
            <tr><td class="accountDetails">BSB: ' . $account ['bsb'] . ' Acct No: ' . $account ['accountNumber'] . '</td></tr>
            <tr><td class="accountDetails"><a href="Transaction-History/' . $account ['accountID'] . '">Transactions</a> |
            <a href="New-Bill-Payment/' . $account ['accountID'] . '">Pay Bill</a> |
            <a href="New-Funds-Transfer/' . $account ['accountID'] . '">Transfer Funds</a> |
            <a href="Account-Details/' . $account ['accountID'] . '">Account Details</a></td></tr></table></td>
            <td class="accountBalance">' . number_format ( $balance, 2 ) . $sign . '</td>
            <td class="accountBalance">' . number_format ( $account ['availableBalance'], 2 ) . '</td>
          </tr>';
	}
}
?>

							<tr class="totals topBorder">
								<th></th>
								<td class="accountBalance">Credit Balance:</td>
								<td class="accountBalance"><?php if(isset($_SESSION['summaryCreditBalance'])){ echo $_SESSION['summaryCreditBalance']; } ?></td>
								<td></td>
							</tr>
							<tr class="totals">
								<th></th>
								<td class="accountBalance">Debit Balance:</td>
								<td class="accountBalance"><?php if(isset($_SESSION['summaryDebitBalance'])){ echo $_SESSION['summaryDebitBalance']; } ?></td>
								<td></td>
							</tr>
							<tr class="totals accountName bottomBorder">
								<th></th>
								<td class="accountBalance">Net Position:</td>
								<td class="accountBalance"><?php if(isset($_SESSION['summaryNetBalance'])){ echo $_SESSION['summaryNetBalance']; } ?></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>