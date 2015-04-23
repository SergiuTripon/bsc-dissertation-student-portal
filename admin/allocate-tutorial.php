<?php
include '../includes/session.php';

global $mysqli;
global $tutorialToAllocate;

if (isset($_GET['id'])) {

    $tutorialToAllocate = $_GET['id'];

} else {
    header('Location: ../../timetable/');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<?php include '../assets/meta-tags.php'; ?>

    <title>Student Portal | Allocate tutorial</title>

    <?php include '../assets/css-paths/common-css-paths.php'; ?>

</head>

<body>
<div class="preloader"></div>

	<?php if (isset($_SESSION['signedIn']) && $_SESSION['signedIn'] == true) : ?>

	<?php include '../includes/menus/portal_menu.php'; ?>

	<div class="container">

	<ol class="breadcrumb breadcrumb-custom">
		<li><a href="../../home/">Home</a></li>
        <li><a href="../../timetable/">Timetable</a></li>
		<li class="active">Allocate tutorial</li>
	</ol>

    <div id="tutorialid" style="display: none !important;"><?php echo $tutorialToAllocate; ?></div>

	<div class="panel-group panel-custom" id="accordion" role="tablist" aria-multiselectable="true">

	<div class="panel panel-default">

    <div class="panel-heading" role="tab" id="headingOne">
  	<h4 class="panel-title">
	<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Unallocated students</a>
    </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
  	<div class="panel-body">

	<!-- Allocated students -->
	<section id="no-more-tables">
	<table class="table table-condensed table-custom">

	<thead>
	<tr>
	<th>Full name</th>
	<th>Student number</th>
    <th>Action</th>
	</tr>
	</thead>

	<tbody>
    <?php

    $account_type = 'student';

	$stmt1 = $mysqli->prepare("SELECT user_signin.userid, user_detail.studentno, user_detail.firstname, user_detail.surname FROM user_signin LEFT JOIN user_detail ON user_signin.userid=user_detail.userid WHERE user_signin.userid NOT IN (SELECT DISTINCT(user_tutorial.userid) FROM user_tutorial WHERE user_tutorial.tutorialid=?) AND user_signin.account_type=?");
    $stmt1->bind_param('is', $tutorialToAllocate, $account_type);
    $stmt1->execute();
    $stmt1->bind_result($userid, $studentno, $firstname, $surname);
    $stmt1->store_result();

    if ($stmt1->num_rows > 0) {

        while ($stmt1->fetch()) {
            echo
           '<tr>
			<td data-title="Full name">'.$firstname.' '.$surname.'</td>
			<td data-title="Student number">'.$studentno.'</td>
			<td data-title="Action"><a id="#allocate-'.$userid.'" class="btn btn-primary btn-md btn-allocate-tutorial btn-load">Allocate</a></td>
			</tr>';
        }
    }
	$stmt1->close();
	?>
	</tbody>

	</table>
	</section>

  	</div><!-- /panel-body -->
    </div><!-- /panel-collapse -->
	</div><!-- /panel-default -->

    <div class="panel panel-default">

    <div class="panel-heading" role="tab" id="headingTwo">
  	<h4 class="panel-title">
	<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"> Allocated students</a>
    </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
  	<div class="panel-body">

	<!-- Unallocated students -->
	<section id="no-more-tables">
	<table class="table table-condensed table-custom">

	<thead>
	<tr>
	<th>Full name</th>
	<th>Student number</th>
    <th>Action</th>
	</tr>
	</thead>

	<tbody>
    <?php

    $account_type = 'student';

	$stmt2 = $mysqli->prepare("SELECT user_signin.userid, user_detail.studentno, user_detail.firstname, user_detail.surname FROM user_signin LEFT JOIN user_detail ON user_signin.userid=user_detail.userid WHERE user_signin.userid IN (SELECT DISTINCT(user_tutorial.userid) FROM user_tutorial WHERE user_tutorial.tutorialid=?) AND user_signin.account_type=?");
    $stmt2->bind_param('is', $tutorialToAllocate, $account_type);
    $stmt2->execute();
    $stmt2->bind_result($userid, $studentno, $firstname, $surname);
    $stmt2->store_result();

    if ($stmt2->num_rows > 0) {

        while ($stmt2->fetch()) {

            echo
           '<tr>
			<td data-title="First name">'.$firstname.' '.$surname.'</td>
			<td data-title="Student number">'.$studentno.'</td>
			<td data-title="Action"><a id="#deallocate-'.$userid.'" class="btn btn-primary btn-md btn-deallocate-tutorial btn-load">Deallocate</a></td>
			</tr>';
        }
    }
	$stmt2->close();
	?>
	</tbody>

	</table>
	</section>

  	</div><!-- /panel-body -->
    </div><!-- /panel-collapse -->
	</div><!-- /panel-default -->

	</div><!-- /panel-group -->

    </div><!-- /container -->

	<?php include '../includes/footers/footer.php'; ?>

	<?php else : ?>

	<?php include '../includes/menus/menu.php'; ?>

    <div class="container">

	<form class="form-horizontal form-custom">

    <div class="form-logo text-center">
    <i class="fa fa-graduation-cap"></i>
    </div>

    <hr>

    <p class="feedback-danger text-center">Looks like you're not signed in yet. Please Sign in before accessing this area.</p>

    <hr>

    <div class="text-center">
	<a class="btn btn-primary btn-lg" href="/">Sign in</a>
    </div>

    </form>

	</div>

	<?php include '../includes/footers/footer.php'; ?>

	<?php endif; ?>

	<?php include '../assets/js-paths/common-js-paths.php'; ?>

	<script>

    //DataTables
    settings = {
        "iDisplayLength": 10,
        "paging": true,
        "ordering": true,
        "info": false,
        "language": {
            "emptyTable": "There are no users to display."
        }
    };

    $('.table-custom').dataTable(settings);

    //Allocate module
	$("body").on("click", ".btn-allocate-tutorial", function(e) {
    e.preventDefault();

    var clickedID = this.id.split('-');
    var userToAllocate = clickedID[1];
    var tutorialToAllocate = $("#tutorialid").html();

	jQuery.ajax({
	type: "POST",
	url: "https://student-portal.co.uk/includes/processes.php",
	dataType:"text",
	data:'userToAllocate='+ userToAllocate + '&tutorialToAllocate='+ tutorialToAllocate,
	success:function(){
        location.reload();
    },
	error:function (xhr, ajaxOptions, thrownError){
		$("#error").show();
		$("#error").empty().append(thrownError);
	}
	});
    });

    //Deallocate module
    $("body").on("click", ".btn-deallocate-tutorial", function(e) {
    e.preventDefault();

    var clickedID = this.id.split('-');
    var userToDeallocate = clickedID[1];
    var tutorialToDeallocate = $("#tutorialid").html();

	jQuery.ajax({
	type: "POST",
	url: "https://student-portal.co.uk/includes/processes.php",
	dataType:"text",
	data:'userToDeallocate='+ userToDeallocate + '&tutorialToDeallocate='+ tutorialToDeallocate,
	success:function(){
        location.reload();
    },
	error:function (xhr, ajaxOptions, thrownError){
		$("#error").show();
		$("#error").empty().append(thrownError);
	}
	});
    });
	</script>

</body>
</html>
