<?php
include 'includes/session.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<?php include 'assets/meta-tags.php'; ?>

	<?php include 'assets/css-paths/datatables-css-path.php'; ?>
	<?php include 'assets/css-paths/common-css-paths.php'; ?>
	<?php include 'assets/css-paths/calendar-css-path.php'; ?>

    <title>Student Portal | Results</title>

</head>

<body>
<div class="preloader"></div>

	<?php if (isset($_SESSION['signedIn']) && $_SESSION['signedIn'] == true) : ?>

    <?php if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'student') : ?>

    <?php include 'includes/menus/portal_menu.php'; ?>

	<div id="timetable-portal" class="container">

	<ol class="breadcrumb">
    <li><a href="../overview/">Overview</a></li>
	<li class="active">Results</li>
    </ol>

	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

	<div class="panel panel-default">

    <div class="panel-heading" role="tab" id="headingOne">
  	<h4 class="panel-title">
	<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Results</a>
    </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
  	<div class="panel-body">

	<!-- Results -->
	<section id="no-more-tables">
	<table class="table table-condensed table-custom result-table">

	<thead>
	<tr>
	<th>Module</th>
	<th>Coursework mark</th>
	<th>Exam mark</th>
	<th>Overall mark</th>
    <th>Created on</th>
    <th>Updated on</th>
	</tr>
	</thead>

	<tbody>
	<?php
	$stmt1 = $mysqli->query("SELECT user_results.resultid, system_modules.module_name, user_results.result_coursework_mark, user_results.result_exam_mark, user_results.result_overall_mark, DATE_FORMAT(user_results.created_on,'%d %b %y %H:%i') as created_on, DATE_FORMAT(user_results.updated_on,'%d %b %y %H:%i') as updated_on FROM user_results LEFT JOIN system_modules ON user_results.moduleid=system_modules.moduleid WHERE user_results.userid = '$session_userid' AND system_modules.module_status='active'");

	while($row = $stmt1->fetch_assoc()) {

    $resultid = $row["resultid"];
    $module_name = $row["module_name"];
    $result_coursework_mark = $row["result_coursework_mark"];
    $result_exam_mark = $row["result_exam_mark"];
    $result_overall_mark = $row["result_overall_mark"];
    $result_created_on = $row["created_on"];
    $result_updated_on = $row["updated_on"];

	echo '<tr>

			<td data-title="Module">'.$module_name.'</td>
			<td data-title="Coursework mark">'.$result_coursework_mark.'</td>
			<td data-title="Exam mark">'.$result_exam_mark.'</td>
			<td data-title="Overall mark">'.$result_overall_mark.'</td>
            <td data-title="Added on">'.(empty($result_created_on) ? "-" : "$result_created_on").'</td>
            <td data-title="Added on">'.(empty($result_updated_on) ? "-" : "$result_updated_on").'</td>
			</tr>';
	}

	$stmt1->close();
	?>
	</tbody>

	</table>
	</section>

  	</div><!-- /panel-body -->
    </div><!-- /panel-collapse -->
	</div><!-- /panel-default -->

	</div><!-- /.panel-group -->

    </div><!-- /container -->

	<?php include 'includes/footers/footer.php'; ?>

	<!-- Sign Out (Inactive) JS -->
    <script src="../assets/js/custom/sign-out-inactive.js"></script>

    <?php endif; ?>

    <?php if (isset($_SESSION['account_type']) && ($_SESSION['account_type'] == 'lecturer' || $_SESSION['account_type'] == 'admin')) : ?>

    <?php include 'includes/menus/portal_menu.php'; ?>

    <div id="timetable-portal" class="container">

	<ol class="breadcrumb">
    <li><a href="../overview/">Overview</a></li>
    <li class="active">Results</li>
    </ol>

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
  	<h4 class="panel-title">
	<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Students</a>
    </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
  	<div class="panel-body">

	<!-- Modules -->
	<section id="no-more-tables">
	<table class="table table-condensed table-custom module-table">

	<thead>
	<tr>
	<th>Full name</th>
	<th>Student number</th>
    <th>Action</th>
	</tr>
	</thead>

	<tbody>
	<?php

	$stmt3 = $mysqli->query("SELECT user_signin.userid, user_details.firstname, user_details.surname, user_details.studentno FROM user_signin LEFT JOIN user_details ON user_signin.userid=user_details.userid WHERE account_type = 'student'");

	while($row = $stmt3->fetch_assoc()) {

    $userid = $row["userid"];
	$firstname = $row["firstname"];
	$surname = $row["surname"];
	$studentno = $row["studentno"];

	echo '<tr id="assign-'.$userid.'">

			<td data-title="Name">'.$firstname.' '.$surname.'</td>
            <td data-title="Student number">'.$studentno.'</td>
            <td data-title="Action"><a class="btn btn-primary btn-md ladda-button assign-button" href="/admin/assign-results?id='.$userid.'" data-style="slide-up"><span class="ladda-label">Select</span></a></a></td>
			</tr>';
	}

	$stmt3->close();
	?>
	</tbody>

	</table>
	</section>

  	</div><!-- /panel-body -->
    </div><!-- /panel-collapse -->
	</div><!-- /panel-default -->

	</div><!-- /.panel-group -->

    </div><!-- /container -->

	<?php include 'includes/footers/footer.php'; ?>

	<!-- Sign Out (Inactive) JS -->
    <script src="../assets/js/custom/sign-out-inactive.js"></script>

    <?php endif; ?>

    <?php else : ?>

	<?php include 'includes/menus/menu.php'; ?>

    <div class="container">

	<form class="form-custom">

    <div class="form-logo text-center">
    <i class="fa fa-graduation-cap"></i>
    </div>

    <hr>

    <p class="feedback-sad text-center">Looks like you're not signed in yet. Please sign in before accessing this area.</p>

    <hr>

    <div class="text-center">
	<a class="btn btn-primary btn-lg ladda-button" data-style="slide-up" href="/"><span class="ladda-label">Sign In</span></a>
    </div>

    </form>

	</div>

	<?php include 'includes/footers/footer.php'; ?>

	<?php endif; ?>

	<?php include 'assets/js-paths/common-js-paths.php'; ?>
	<?php include 'assets/js-paths/tilejs-js-path.php'; ?>
	<?php include 'assets/js-paths/datatables-js-path.php'; ?>
	<?php include 'assets/js-paths/calendar-js-path.php'; ?>

	<script>
    //Ladda
    Ladda.bind('.ladda-button', {timeout: 2000});

	//DataTables
    $('.result-table').dataTable({
        "iDisplayLength": 10,
		"paging": true,
		"ordering": true,
		"info": false,
		"language": {
			"emptyTable": "You have no results to display."
		}
	});

    $('.module-table').dataTable({
        "iDisplayLength": 10,
		"paging": true,
		"ordering": true,
		"info": false,
		"language": {
			"emptyTable": "There are no timetables to display."
		}
	});
	</script>

</body>
</html>
