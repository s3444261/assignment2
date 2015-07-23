<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 *
 * nav.php
 * This file is used to display the navigation bar at the top of the page.
 * The base code for this navigation bar was obtained from the Twitter
 * Bootstrap - http://getbootstrap.com/ site and modified by myself. The
 * formatting of the navigation bar is done using Twitter Bootstrap css.
 */
?>
<nav class="navbar navbar-default navbar-inverse">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
				aria-expanded="false">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a class="navbar-brand hidden-xs" href="Home"><img class="logo"
				alt="fab" src="images/LogoFab.png" /></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse"
			id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="dropdown"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown" role="button" aria-haspopup="true"
					aria-expanded="false">Accounts <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="Account-Summary">Account Summary</a></li>
						<li><a href="Transaction-History">Transaction History</a></li>
						<li><a href="Account-Details">Account Details</a></li>
					</ul></li>
				<li class="dropdown"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown" role="button" aria-haspopup="true"
					aria-expanded="false">Bill Payment <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="New-Bill-Payment">New Bill Payment</a></li>
						<li><a href="Payment-List">Payment List</a></li>
						<li><a href="Payee-List">Payee List</a></li>
					</ul></li>
				<li class="dropdown"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown" role="button" aria-haspopup="true"
					aria-expanded="false">Funds Transfer <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="New-Funds-Transfer">New Funds Transfer</a></li>
						<li><a href="Payment-List">Payment List</a></li>
						<li><a href="Payee-List">Payee List</a></li>
					</ul></li>
			</ul>
<?php
if ($_SESSION ['loggedin']) {
	echo '<ul class="nav navbar-nav navbar-right">
        <li><a href="Logout">Logout</a></li>
      </ul>';
}
?> 
    </div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container-fluid -->
</nav>
<?php
?>