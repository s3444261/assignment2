<?php
?>
<h1>Federal Australia Bank</h1>

<div class="row">
	<div class="bluestripe">
		<div class="row">
			<div class="col-xs-2 col-sm-2 col-md-3"></div>
			<div
				class="col-xs-8 col-sm-8 col-md-6 altHeading loginBuffer hidden-xs">
				FAB Internet Banking</div>
			<div class="col-xs-2 col-sm-2 col-md-3"></div>
		</div>
		<div class="row">
			<div class="hidden-sm hidden-md hidden-lg col-xs-12 smallHeight"></div>
		</div>
		<div class="row">
			<div class="col-xs-2 col-sm-2 col-md-3"></div>
			<div class="col-xs-8 col-sm-8 col-md-6">
<?php
if (! isset ( $_SESSION ['loggedin'] )) {
	echo '<form class="form-inline" method="post" action="Login">
					<div class="form-group">
						<label class="sr-only" for="fabid">FAB ID</label> <input
							type="text" class="form-control" name="fabid" id="fabid" placeholder="FAB ID">
					</div>
					<div class="form-group">
						<label class="sr-only" for="password">Password</label> <input
							type="password" class="form-control" name="password" id="password"
							placeholder="Password">
					</div>
					<button type="submit" class="btn btn-default">Login</button>
				</form>';
}
?>
				
			</div>
			<div class="col-xs-2 col-sm-2 col-md-3"></div>
		</div>
	</div>
</div>