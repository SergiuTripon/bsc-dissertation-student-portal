<?php
include '../includes/session.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<?php include '../assets/meta-tags.php'; ?>

    <title>Student Portal | Create event</title>

    <?php include '../assets/css-paths/common-css-paths.php'; ?>

</head>

<body>

	<div class="preloader"></div>

	<?php if (isset($_SESSION['signedIn']) && $_SESSION['signedIn'] == true) : ?>
	
    <?php if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'administrator') : ?>

	<?php include '../includes/menus/portal_menu.php'; ?>

	<div id="admin-timetable-portal" class="container">

    <ol class="breadcrumb breadcrumb-custom">
    <li><a href="../../home/">Home</a></li>
	<li><a href="../../events/">Events</a></li>
    <li class="active">Create event</li>
    </ol>

    <!-- Create event -->
	<form class="form-horizontal form-custom" style="max-width: 100%;" name="createbook_form" id="createbook_form" novalidate>

    <p id="error" class="feedback-danger text-center"></p>
	<p id="success" class="feedback-success text-center"></p>

	<div id="hide">

	<div class="form-group">
	<div class="col-xs-12 col-sm-12 full-width">
	<label for="event_name">Name<span class="field-required">*</span></label>
    <input class="form-control" type="text" name="event_name" id="event_name" placeholder="Enter a name">
	</div>
	</div>

    <div class="form-group">
	<div class="col-xs-12 col-sm-12 full-width">
	<label>Notes</label>
    <textarea class="form-control" rows="5" name="event_notes" id="event_notes" placeholder="Enter notes"></textarea>
	</div>
	</div>

    <div class="form-group">
	<div class="col-xs-12 col-sm-12 full-width">
	<label>URL</label>
    <input class="form-control" type="text" name="event_url" id="event_url" placeholder="Enter a URL">
	</div>
	</div>

    <div class="form-group">
	<div class="col-xs-6 col-sm-6 full-width">
	<label for="event_from">From<span class="field-required">*</span></label>
	<input type="text" class="form-control" name="event_from" id="event_from" placeholder="Select a date and time">
	</div>
	<div class="col-xs-6 col-sm-6 full-width">
	<label for="event_to">To<span class="field-required">*</span></label>
	<input type="text" class="form-control" name="event_to" id="event_to" placeholder="Select a date and time">
	</div>
	</div>

    <div class="form-group">
	<div class="col-xs-6 col-sm-6 full-width">
	<label for="event_amount">Price (&pound;)<span class="field-required">*</span></label>
	<input type="text" class="form-control" name="event_amount" id="event_amount" placeholder="Enter an amount">
	</div>
	<div class="col-xs-6 col-sm-6 full-width">
	<label for="event_ticket_no">Tickets available<span class="field-required">*</span></label>
	<input type="text" class="form-control" name="event_ticket_no" id="event_ticket_no" placeholder="Enter a number">
	</div>
	</div>

    <hr>

	</div>

    <div class="text-center">
    <a id="create-event-submit" class="btn btn-primary btn-lg btn-load btn-load">Create event</a>
    </div>

	<div id="success-button" class="text-center" style="display:none;">
    <hr class="hr-success">
	<a class="btn btn-primary btn-lg btn-load" href="">Create another</a>
	</div>
	
    </form>
    <!-- End of Create event -->

	</div> <!-- /container -->
	
	<?php include '../includes/footers/footer.php'; ?>

    <?php else : ?>

	<?php include '../includes/menus/portal_menu.php'; ?>

    <div class="container">

    <form class="form-horizontal form-custom">

	<div class="form-logo text-center">
    <i class="fa fa-graduation-cap"></i>
    </div>

    <hr>
	<p class="feedback-danger text-center">You need to have an admin account to access this area.</p>
    <hr>

    <div class="text-center">
    <a class="btn btn-primary btn-lg" href="/home/">Home</a>
    </div>

    </form>
    
	</div>

	<?php include '../includes/footers/footer.php'; ?>

    <?php endif; ?>
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

    //Initialize Date Time Picker
    $('#event_from').datetimepicker({
        format: 'DD/MM/YYYY HH:mm',
        useCurrent: false
    });
    $('#event_to').datetimepicker({
        format: 'DD/MM/YYYY HH:mm',
        useCurrent: false
    });

    //Create event process
    $("#create-event-submit").click(function (e) {
    e.preventDefault();

	var hasError = false;

    //Chekcing if event_name is inputted
	var event_name = $("#event_name").val();
	if(event_name === '') {
        $("label[for='event_name']").empty().append("Please enter a name.");
        $("label[for='event_name']").removeClass("feedback-success");
        $("label[for='event_name']").addClass("feedback-danger");
        $("#event_name").removeClass("input-success");
        $("#event_name").addClass("input-danger");
        $("#event_name").focus();
		hasError  = true;
		return false;
    } else {
        $("label[for='event_name']").empty().append("All good!");
        $("label[for='event_name']").removeClass("feedback-danger");
        $("label[for='event_name']").addClass("feedback-success");
        $("#event_name").removeClass("input-danger");
        $("#event_name").addClass("input-success");
	}

    var event_notes = $("#event_notes").val();
    var event_url = $("#event_url").val();

    //Chekcing if event_from is inputted
    var event_from = $("#event_from").val();
	if(event_from === '') {
        $("label[for='event_from']").empty().append("Please select a date and time.");
        $("label[for='event_from']").removeClass("feedback-success");
        $("label[for='event_from']").addClass("feedback-danger");
        $("#event_from").removeClass("input-success");
        $("#event_from").addClass("input-danger");
        $("#event_from").focus();
		hasError  = true;
		return false;
    } else {
        $("label[for='event_from']").empty().append("All good!");
        $("label[for='event_from']").removeClass("feedback-danger");
        $("label[for='event_from']").addClass("feedback-success");
        $("#event_from").removeClass("input-danger");
        $("#event_from").addClass("input-success");
	}

    //Chekcing if event_to is inputted
    var event_to = $("#event_to").val();
	if(event_to === '') {
        $("label[for='event_to']").empty().append("Please select a date and time.");
        $("label[for='event_to']").removeClass("feedback-success");
        $("label[for='event_to']").addClass("feedback-danger");
        $("#event_to").removeClass("input-success");
        $("#event_to").addClass("input-danger");
        $("#event_to").focus();
		hasError  = true;
		return false;
    } else {
        $("label[for='event_to']").empty().append("All good!");
        $("label[for='event_to']").removeClass("feedback-danger");
        $("label[for='event_to']").addClass("feedback-success");
        $("#event_to").removeClass("input-danger");
        $("#event_to").addClass("input-success");
	}

    //Chekcing if event_amount is inputted
    var event_amount = $("#event_amount").val();
	if(event_amount === '') {
        $("label[for='event_amount']").empty().append("Please enter a price.");
        $("label[for='event_amount']").removeClass("feedback-success");
        $("label[for='event_amount']").addClass("feedback-danger");
        $("#event_amount").removeClass("input-success");
        $("#event_amount").addClass("input-danger");
        $("#event_amount").focus();
		hasError  = true;
		return false;
    } else {
        $("label[for='event_amount']").empty().append("All good!");
        $("label[for='event_amount']").removeClass("feedback-danger");
        $("label[for='event_amount']").addClass("feedback-success");
        $("#event_amount").removeClass("input-danger");
        $("#event_amount").addClass("input-success");
	}

    //Chekcing if event_ticket_no is inputted
    var event_ticket_no = $("#event_ticket_no").val();
	if(event_ticket_no === '') {
        $("label[for='event_ticket_no']").empty().append("Please enter a number.");
        $("label[for='event_ticket_no']").removeClass("feedback-success");
        $("label[for='event_ticket_no']").addClass("feedback-danger");
        $("#event_ticket_no").removeClass("input-success");
        $("#event_ticket_no").addClass("input-danger");
        $("#event_ticket_no").focus();
		hasError  = true;
		return false;
    } else {
        $("label[for='event_ticket_no']").empty().append("All good!");
        $("label[for='event_ticket_no']").removeClass("feedback-danger");
        $("label[for='event_ticket_no']").addClass("feedback-success");
        $("#event_ticket_no").removeClass("input-danger");
        $("#event_ticket_no").addClass("input-success");
	}

    //If there are no errors, initialize the Ajax call
	if(hasError == false){
    jQuery.ajax({
	type: "POST",

    //URL to POST data to
	url: "https://student-portal.co.uk/includes/processes.php",

    //Data posted
    data:'create_event_name='       + event_name +
         '&create_event_notes='     + event_notes +
         '&create_event_url='       + event_url +
         '&create_event_from='      + event_from +
         '&create_event_to='        + event_to +
         '&create_event_amount='    + event_amount +
         '&create_event_ticket_no=' + event_ticket_no,

    //If action completed, do the following
    success:function(){
		$("#error").hide();
		$("#hide").hide();
		$("#create-event-submit").hide();
		$("#success").show();
		$("#success").empty().append('All done! The event has been created.');
		$("#success-button").show();
	},

    //If action failed, do the following
    error:function (xhr, ajaxOptions, thrownError){
        buttonReset();
		$("#success").hide();
		$("#error").show();
        $("#error").empty().append(thrownError);
    }
	});
    }
	return true;
	});
	</script>

</body>
</html>
