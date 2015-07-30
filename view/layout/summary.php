<?php
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
foreach ( $driver->summary () as $account ) {
	echo '<tr>
            <th><span class="glyphicon glyphicon-equalizer" aria-hidden="true"></span></th>
            <td><table><tr><td class="accountName">' . $account ['account'] . '</td></tr>
            <tr><td class="accountDetails">BSB: ' . $account ['bsb'] . ' Acct No: ' . $account ['accountNo'] . '</td></tr>
            <tr><td class="accountDetails"><a href="Transaction-History/' . $account ['accountID'] . '">Transactions</a> | 
            <a href="New-Bill-Payment/' . $account ['accountID'] . '">Pay Bill</a> | 
            <a href="New-Funds-Transfer/' . $account ['accountID'] . '">Transfer Funds</a> | 
            <a href="Account-Details/' . $account ['accountID'] . '">Account Details</a></td></tr></table></td>
            <td class="accountBalance">' . $account ['currentBalance'] . '</td>
            <td class="accountBalance">' . $account ['availableBalance'] . '</td>
          </tr>';
}

?>

							<tr class="totals topBorder">
								<th></th>
								<td class="accountBalance">Credit Balance:</td>
								<td class="accountBalance"><?php echo $driver->summaryCredit() ?></td>
								<td></td>
							</tr>
							<tr class="totals">
								<th></th>
								<td class="accountBalance">Debit Balance:</td>
								<td class="accountBalance"><?php echo $driver->summaryDebit() ?></td>
								<td></td>
							</tr>
							<tr class="totals accountName bottomBorder">
								<th></th>
								<td class="accountBalance">Net Position:</td>
								<td class="accountBalance"><?php echo $driver->summaryNet() ?></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>