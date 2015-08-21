<?php
/*
 * Author: Grant Kinkead
 * Student Number: s3444261
 * Student Email: s3444261@student.rmit.edu.au
 *
 * CPT375 Web Database Applications
 * 2015 - Study Period 2
 *
 * footer.php
 * This file is used to incorporate the footer information at the bottom of the page.
 * The base code for the footer was obtained from the Twitter Bootstrap -
 * http://getbootstrap.com/ site.
 */
?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	$(".hideRow").hide();
    $(".group1").show();
<?php 
if(isset($_SESSION ['found'])){
	$noGroups = ceil($_SESSION ['found']/5);
	$pageNo = 1;
	for($i=0; $i<$noGroups; $i++){
		echo '$("#show' . $pageNo . '").click(function(){
			$(".hideRow").hide();
	        $(".group' . $pageNo . '").show();
	    });';
		$pageNo++;
	}
}
if(isset($_SESSION ['numPayments'])){
	$noGroups = ceil($_SESSION ['numPayments']/5);
	$pageNo = 1;
	for($i=0; $i<$noGroups; $i++){
		echo '$("#show' . $pageNo . '").click(function(){
			$(".hideRow").hide();
	        $(".group' . $pageNo . '").show();
	    });';
		$pageNo++;
	}
}
?>
});
</script>
<?php 
if($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/Home'){
	echo '<footer>&#9400; Federal Australia Bank Limited - A ficticious site built for educational purposes.</footer>';
}
?>

</body>
</html>