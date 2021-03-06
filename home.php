<?php
include 'includes/session.php';
include 'includes/functions.php';

    global $mysqli;
    global $session_userid;
    global $student_timetable_count;
    global $academic_staff_timetable_count;
    global $exams_count;
    global $results_count;
    global $library_count;
    global $library_admin_count;
    global $calendar_count;
    global $events_count;
    global $messenger_count;
    global $feedback_count;
    global $feedback_admin_count;

    GetDashboardData();

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <?php include 'assets/meta-tags.php'; ?>

    <title>Student Portal | Home</title>

    <?php include 'assets/css-paths/common-css-paths.php'; ?>

</head>

<body>
	
	<div class="preloader"></div>

	<?php if (isset($_SESSION['signedIn']) && $_SESSION['signedIn'] == true) : ?>

    <?php if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'student') : ?>

    <?php include 'includes/menus/portal_menu.php'; ?>

    <div id="overview-portal" class="container">
    <div class="row">

    <a href="../timetable/">
    <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
    <div class="tile large-tile">
    <i class="fa fa-clock-o"></i>
	<p>Timetable<span class="badge"><?php echo ($student_timetable_count == '0' ? "" : "$student_timetable_count"); ?></span></p>
    </div>
	</div>
    </a>

    <a href="../exams/">
    <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
    <div class="tile">
    <i class="fa fa-pencil"></i>
	<p>Exams<span class="badge"><?php echo ($exams_count == '0' ? "" : "$exams_count"); ?></span></p>
    </div>
	</div>
    </a>

    <a href="../results/">
    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
    <div class="tile">
	<i class="fa fa-trophy"></i>
	<p>Results<span class="badge"><?php echo ($results_count == '0' ? "" : "$results_count"); ?></span></p>
    </div>
	</div>
    </a>

    <a href="../transport/">
    <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
    <div class="tile">
    <i class="fa fa-subway"></i>
	<p>Transport</p>
    </div>
	</div>
    </a>

    <a href="../library/">
    <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
	<div class="tile">
    <i class="fa fa-book"></i>
	<p>Library<span class="badge"><?php echo ($library_count == '0' ? "" : "$library_count"); ?></span></p>
    </div>
	</div>
    </a>

    <a href="../calendar/">
	<div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
	<div class="tile">
    <i class="fa fa-calendar"></i>
	<p>Calendar<span class="badge"><?php echo ($calendar_count == '0' ? "" : "$calendar_count"); ?></span></p>
    </div>
	</div>
    </a>

    <a href="../university-map/">
    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
    <div class="tile">
    <i class="fa fa-map-marker"></i>
	<p>University Map</p>
    </div>
	</div>
    <a>

    <a href="../events/">
    <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
    <div class="tile">
	<i class="fa fa-ticket"></i>
	<p>Events<span class="badge"><?php echo ($events_count == '0' ? "" : "$events_count"); ?></span></p>
    </div>
	</div>
    </a>

	<a href="../feedback/">
    <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
    <div class="tile">
    <i class="fa fa-check-square-o"></i>
	<p>Feedback</p>
    </div>
	</div>
    </a>

	<a href="../messenger/">
    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
    <div class="tile">
    <i class="fa fa-comments"></i>
	<p>Messenger<span class="badge"><?php echo ($messenger_count == '0' ? "" : "$messenger_count"); ?></span></p>
    </div>
	</div>
    </a>

	<a href="../account/">
    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
    <div class="tile">
    <i class="fa fa-user"></i>
	<p>Account</p>
    </div>
	</div>
    </a>
	
	</div><!-- /row -->
	
	</div> <!-- /container -->

	<?php include 'includes/footers/footer.php'; ?>

    <?php endif; ?>

    <?php if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'academic staff') : ?>

    <?php include 'includes/menus/portal_menu.php'; ?>

    <div id="overview-portal" class="container">
    <div class="row">

    <a href="../timetable/">
    <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
    <div class="tile large-tile">
    <i class="fa fa-clock-o"></i>
	<p>Timetable<span class="badge"><?php echo ($academic_staff_timetable_count == '0' ? "" : "$academic_staff_timetable_count"); ?></span></p>
    </div>
	</div>
    </a>

    <a href="../exams/">
    <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
    <div class="tile">
    <i class="fa fa-pencil"></i>
	<p>Exams<span class="badge"><?php echo ($exams_count == '0' ? "" : "$exams_count"); ?></span></p>
    </div>
	</div>
    </a>

    <a href="../results/">
    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
    <div class="tile">
	<i class="fa fa-trophy"></i>
	<p>Results<span class="badge"><?php echo ($results_count == '0' ? "" : "$results_count"); ?></span></p>
    </div>
	</div>
    </a>

    <a href="../transport/">
    <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
    <div class="tile">
    <i class="fa fa-subway"></i>
	<p>Transport</p>
    </div>
	</div>
    </a>

    <a href="../library/">
    <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
	<div class="tile">
    <i class="fa fa-book"></i>
	<p>Library<span class="badge"><?php echo ($library_count == '0' ? "" : "$library_count"); ?></span></p>
    </div>
	</div>
    </a>

    <a href="../calendar/">
	<div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
	<div class="tile">
    <i class="fa fa-calendar"></i>
	<p>Calendar<span class="badge"><?php echo ($calendar_count == '0' ? "" : "$calendar_count"); ?></span></p>
    </div>
	</div>
    </a>

    <a href="../university-map/">
    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
    <div class="tile">
    <i class="fa fa-map-marker"></i>
	<p>University Map</p>
    </div>
	</div>
    <a>

    <a href="../events/">
    <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
    <div class="tile">
	<i class="fa fa-ticket"></i>
	<p>Events<span class="badge"><?php echo ($events_count == '0' ? "" : "$events_count"); ?></span></p>
    </div>
	</div>
    </a>

	<a href="../feedback/">
    <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
    <div class="tile">
    <i class="fa fa-check-square-o"></i>
    <p>Feedback<span class="badge"><?php echo ($feedback_count == '0' ? "" : "$feedback_count"); ?></span></p>
    </div>
	</div>
    </a>

	<a href="../messenger/">
    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
    <div class="tile">
    <i class="fa fa-comments"></i>
	<p>Messenger<span class="badge"><?php echo ($messenger_count == '0' ? "" : "$messenger_count"); ?></span></p>
    </div>
	</div>
    </a>

	<a href="../account/">
    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
    <div class="tile">
    <i class="fa fa-user"></i>
	<p>Account</p>
    </div>
	</div>
    </a>
	
	</div><!-- /row -->
    
	</div> <!-- /container -->

    <?php include 'includes/footers/footer.php'; ?>




    <?php endif; ?>

    <?php if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'administrator') : ?>

    <?php include 'includes/menus/portal_menu.php'; ?>

    <div id="overview-portal" class="container">
    <div class="row">

    <a href="../timetable/">
    <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
    <div class="tile large-tile">
    <i class="fa fa-clock-o"></i>
	<p>Timetable</p>
    </div>
	</div>
    </a>

    <a href="../exams/">
    <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
    <div class="tile">
	<i class="fa fa-pencil"></i>
	<p>Exams</p>
    </div>
	</div>
    </a>

    <a href="../results/">
    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
    <div class="tile">
	<i class="fa fa-trophy"></i>
	<p>Results</p>
    </div>
	</div>
    </a>

    <a href="../transport/">
    <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
    <div class="tile">
    <i class="fa fa-subway"></i>
	<p>Transport</p>
    </div>
	</div>
    </a>

    <a href="../library/">
    <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
	<div class="tile">
    <i class="fa fa-book"></i>
	<p>Library<span class="badge"><?php echo ($library_admin_count == '0' ? "" : "$library_admin_count"); ?></span></p>
    </div>
	</div>
    </a>

    <a href="../calendar/">
	<div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
	<div class="tile">
    <i class="fa fa-calendar"></i>
	<p>Calendar<span class="badge"><?php echo ($calendar_count == '0' ? "" : "$calendar_count"); ?></span></p>
    </div>
	</div>
    </a>

    <a href="../university-map/">
    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
    <div class="tile">
    <i class="fa fa-map-marker"></i>
	<p>University Map</p>
    </div>
	</div>
    <a>

    <a href="../events/">
    <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
    <div class="tile">
	<i class="fa fa-ticket"></i>
	<p>Events</p>
    </div>
	</div>
    </a>

	<a href="../feedback/">
    <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
    <div class="tile">
    <i class="fa fa-check-square-o"></i>
	<p>Feedback<span class="badge"><?php echo ($feedback_admin_count == '0' ? "" : "$feedback_admin_count"); ?></span></p>
    </div>
	</div>
    </a>

	<a href="../messenger/">
    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
    <div class="tile">
    <i class="fa fa-comments"></i>
	<p>Messenger<span class="badge"><?php echo ($messenger_count == '0' ? "" : "$messenger_count"); ?></span></p>
    </div>
	</div>
    </a>

	<a href="../account/">
    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
    <div class="tile">
    <i class="fa fa-user"></i>
	<p>Account</p>
    </div>
	</div>
    </a>
	
	</div><!-- /row -->
	</div><!-- /container -->

    <?php include 'includes/footers/footer.php'; ?>




    <?php endif; ?>

	<?php else : ?>

    <?php include 'includes/menus/menu.php'; ?>
	
    <div class="container">
    
	<form class="form-custom text-center">

    <div class="form-logo">
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

    <?php include 'includes/footers/footer.php'; ?>

	<?php endif; ?>

    <?php include 'assets/js-paths/common-js-paths.php'; ?>

	<script>

	</script>

</body>
</html>
