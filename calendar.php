<?php
include 'includes/session.php';
include 'includes/functions.php';

global $mysqli;
global $session_userid;

calendarUpdate();

global $due_task;
global $completed_task;
global $archived_task;

?>

<!DOCTYPE html>
<html lang="en">

<head>

	<?php include 'assets/meta-tags.php'; ?>

    <title>Student Portal | Calendar</title>

</head>

<body>

    <?php include 'assets/css-paths/common-css-paths.php'; ?>

    <div class="preloader"></div>

	<?php if (isset($_SESSION['signedIn']) && $_SESSION['signedIn'] == true) : ?>

    <?php if (isset($_SESSION['account_type']) && ($_SESSION['account_type'] == 'student' || $_SESSION['account_type'] == 'academic staff' || $_SESSION['account_type'] == 'administrator')) : ?>

	<?php include 'includes/menus/portal_menu.php'; ?>

	<div id="calendar-portal" class="container">

	<ol class="breadcrumb breadcrumb-custom">
    <li><a href="../home/">Home</a></li>
    <li class="active">Calendar</li>
	</ol>

	<div class="row">

    <a id="create-task-button">
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
    <div class="tile">
    <i class="fa fa-plus"></i>
	<p class="tile-text">Create a task</p>
    </div>
	</div>
    </a>
	
	<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
	<div id="task-button">
    <div class="tile task-tile">
	<i class="fa fa-tasks"></i>
	<p class="tile-text">Task view</p>
    </div>
    </div>
	</div>
	
	<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
	<div id="calendar-button">
	<div class="tile calendar-tile">
    <i class="fa fa-calendar"></i>
	<p class="tile-text">Calendar view</p>
    </div>
    </div>
	</div>
	
	</div><!-- /row -->

	<div class="panel-group panel-custom task-view" id="accordion" role="tablist" aria-multiselectable="true">

	<div id="duetasks-toggle" class="panel panel-default">

    <div class="panel-heading" role="tab" id="headingOne">
  	<h4 class="panel-title">
	<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Due tasks</a>
  	</h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
  	<div class="panel-body">

    <!-- Due tasks -->
    <section id="no-more-tables">
    <table class="table table-condensed table-custom table-due-task">

    <thead>
    <tr>
    <th>Task</th>
    <th>Start</th>
    <th>Due</th>
    <th>Action</th>
    </tr>
    </thead>

    <tbody id="content-due-task">

	<?php
    echo $due_task;
	?>

    </tbody>

    </table>
    </section>

  	</div><!-- /panel-body -->
    </div><!-- /panel-collapse -->
	</div><!-- /panel-default -->

    <div id="completedtasks-toggle" class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
  	<h4 class="panel-title">
	<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> Completed tasks</a>
  	</h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
  	<div class="panel-body">

    <!-- Completed tasks -->
    <section id="no-more-tables">
    <table class="table table-condensed table-custom table-completed-task">
    <thead>
    <tr>
    <th>Task</th>
    <th>Start</th>
    <th>Due</th>
    <th>Completed on</th>
    <th>Action</th>
    </tr>
    </thead>

    <tbody id="content-completed-task">

	<?php
    echo $completed_task;
	?>

    </tbody>

    </table>
    </section>

  	</div><!-- /panel-body -->
    </div><!-- /panel-collapse -->
  	</div><!-- /panel-default -->

    <div id="archivedtasks-toggle" class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
  	<h4 class="panel-title">
	<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> Archived tasks</a>
  	</h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
  	<div class="panel-body">

	<!-- Archived tasks -->
	<section id="no-more-tables">
	<table class="table table-condensed table-custom table-archived-task">

	<thead>
	<tr>
	<th>Task</th>
	<th>Start</th>
	<th>Due</th>
    <th>Archived on</th>
    <th>Action</th>
	</tr>
	</thead>

	<tbody id="content-archived-task">
	<?php
    echo $archived_task;
	?>
	</tbody>

	</table>
	</section>

  	</div><!-- /panel-body -->
    </div><!-- /panel-collapse -->
  	</div><!-- /panel-default -->

	</div><!-- /panel-group -->

	<div class="panel-group panel-custom calendar-view" id="accordion" role="tablist" aria-multiselectable="true">

	<div id="calendar-toggle" class="panel panel-default">
	<div class="panel-heading" role="tab" id="headingFour">
	<h4 class="panel-title">
	<a class="accordion-toggle" data-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour"> Calendar</a>
	</h4>
	</div>
	<div id="collapseFour" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFour">
	<div class="panel-body">

	<div class="calendar-buttons text-right">
	<div id="calendar-buttons1" class="btn-group">
		<button class="btn btn-default" data-calendar-nav="prev"><< Prev</button>
		<button class="btn btn-default" data-calendar-nav="today">Today</button>
		<button class="btn btn-default" data-calendar-nav="next">Next >></button>
	</div>
	<div id="calendar-buttons2" class="btn-group">
		<button class="btn btn-default" data-calendar-view="year">Year</button>
		<button class="btn btn-default active" data-calendar-view="month">Month</button>
		<button class="btn btn-default" data-calendar-view="week">Week</button>
		<button class="btn btn-default" data-calendar-view="day">Day</button>
	</div>
	</div>

	<div class="page-header">
	<h3></h3>
	<hr>
	</div>

	<div id="calendar"></div>

	</div><!-- /panel-body -->
	</div><!-- /panel-collapse -->
	</div><!-- /panel-default -->

	</div><!-- /panel-group -->
	
    </div><!-- /container -->

    <div id="create-task-modal" class="modal fade modal-custom modal-form" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modal-custom-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <div class="modal-header">
    <div class="close" data-dismiss="modal"><i class="fa fa-times"></i></div>
    <h4 class="modal-title" id="modal-custom-label">Create a task</h4>
    </div>

    <div class="modal-body">
    <!-- Create a task -->
	<form class="form-horizontal form-custom" style="max-width: 100%; background: none; border: none; padding: 0;" name="create-task-form" id="create-task-form">
	<p id="create_task_error" class="feedback-danger text-center"></p>

    <div class="form-group">
    <div class="col-xs-12 col-sm-12 full-width">
    <label for="create_task_name">Name<span class="field-required">*</span></label>
	<input class="form-control" type="text" name="create_task_name" id="create_task_name" placeholder="Enter a name">
    </div>
    </div>

    <div class="form-group">
    <div class="col-xs-12 col-sm-12 full-width">
    <label>Notes (Optional)</label>
    <textarea class="form-control" rows="5" name="create_task_notes" id="create_task_notes" placeholder="Enter notes"></textarea>
    </div>
    </div>

    <div class="form-group">
    <div class="col-xs-12 col-sm-12 full-width">
	<label>External URL (www.example.com)</label>
	<input class="form-control" type="text" name="create_task_url" id="create_task_url" placeholder="Enter an external URL">
    </div>
    </div>

	<div class="form-group">
	<div class="col-xs-6 col-sm-6 full-width">
	<label for="create_task_startdate">Start date<span class="field-required">*</span></label>
	<input type="text" class="form-control" name="create_task_startdate" id="create_task_startdate" placeholder="Select a start date">
	</div>
    <div class="col-xs-6 col-sm-6 full-width">
    <label for="create_task_duedate">Due date<span class="field-required">*</span></label>
    <input type="text" class="form-control" name="create_task_duedate" id="create_task_duedate" placeholder="Select a due date">
    </div>
	</div>
    </form>
    <!-- End of Create a task -->
    </div>

    <div class="modal-footer">
    <div class="text-right">
    <a class="btn btn-danger btn-lg" data-dismiss="modal">Cancel</a>
    <a id="create-task-submit" class="btn btn-primary btn-lg btn-load">Create task</a>
    </div>
    </div>

    </div><!-- /modal -->
    </div><!-- /modal-dialog -->
    </div><!-- /modal-content -->

    <div id="update-task-modal" class="modal fade modal-custom modal-form" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modal-custom-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">

    <div class="modal-header">
    <div class="close" data-dismiss="modal"><i class="fa fa-times"></i></div>
    <h4 class="modal-title" id="modal-custom-label"></h4>
    </div>

    <div class="modal-body">
    <!-- Update a task -->
    <form id="update-task-form" name="update-task-form" class="form-horizontal form-custom" style="max-width: 100%; background: none; border: none; padding: 0;">
    <p id="update_task_error" class="feedback-danger text-center"></p>

    <input type="hidden" name="update_taskid" id="update_taskid" />

    <label for="update_task_name">Name<span class="field-required">*</span></label>
    <input class="form-control" type="text" name="update_task_name" id="update_task_name" placeholder="Enter a name">

    <label>Notes (Optional)</label>
    <textarea class="form-control" rows="5" name="update_task_notes" id="update_task_notes" placeholder="Notes"></textarea>

    <label>External URL (www.example.com)</label>
    <input class="form-control" type="text" name="update_task_url" id="update_task_url" placeholder="Enter an external URL">

    <div class="form-group">
    <div class="col-xs-6 col-sm-6 full-width">
    <label for="update_task_startdate">Start date and time<span class="field-required">*</span></label>
    <input class="form-control" type="text" name="update_task_startdate" id="update_task_startdate" placeholder="Select a start date and time"/>
    </div>
    <div class="col-xs-6 col-sm-6 full-width">
    <label for="update_task_duedate">Due date and time<span class="field-required">*</span></label>
    <input class="form-control" type="text" name="update_task_duedate" id="update_task_duedate" placeholder="Select a due date and time"/>
    </div>
    </div>

    </form>
    <!-- End of Update a task -->
    </div>

    <div class="modal-footer">
    <div class="text-right">
    <a class="btn btn-danger btn-lg" data-dismiss="modal">Cancel</a>
    <a id="update-task-submit" class="btn btn-primary btn-lg btn-load">Update task</a>
    </div>
    </div>

    </div><!-- /modal -->
    </div><!-- /modal-dialog -->
    </div><!-- /modal-content -->


	<?php include 'includes/footers/footer.php'; ?>
    <?php include 'assets/js-paths/common-js-paths.php'; ?>

    <script>

    //On load actions
    $(document).ready(function () {
        $("#calendar-toggle").hide();
        $(".task-tile").addClass("tile-selected");
        $(".task-tile p").addClass("tile-text-selected");
        $(".task-tile i").addClass("tile-text-selected");

    });

    //Calendar
    var calendar;

	(function($) {

	"use strict";

	var options = {
		events_source: '../../includes/calendar/source/tasks_json.php',
		view: 'month',
		tmpl_path: '../assets/tmpls/',
		tmpl_cache: false,
		onAfterViewLoad: function(view) {
			$('.page-header h3').text(this.getTitle());
			$('.btn-group button').removeClass('active');
			$('button[data-calendar-view="' + view + '"]').addClass('active');
		},
		classes: {
			months: {
				general: 'label'
			}
		}
	};

    calendar = $('#calendar').calendar(options);

	$('.btn-group button[data-calendar-nav]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.navigate($this.data('calendar-nav'));
		});
	});

	$('.btn-group button[data-calendar-view]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.view($this.data('calendar-view'));
		});
	});
	}(jQuery));

    //Responsiveness
    $(window).resize(function(){
        var width = $(window).width();
        if(width <= 550){
            $('.calendar-buttons .btn-group').addClass('btn-group-vertical full-width');
            $('#calendar-buttons2').addClass("mt10");
        } else {
            $('.calendar-buttons .btn-group').removeClass('btn-group-vertical full-width');
            $('#calendar-buttons2').removeClass("mt10");
        }
    }).resize();

    //Date Time Picker
    var datetimepicker = {
        format: 'DD/MM/YYYY HH:mm',
        useCurrent: false,
        showTodayButton: true,
        showClear: true,
        showClose: true
    };

    //Show create task modal
    $("#create-task-button").click(function() {
        $('#create-task-modal').modal('show');
    });

    //Initialize date time picker while modal is shown
    $('#create-task-modal').on('shown.bs.modal', function () {
        $('#create_task_startdate').datetimepicker(datetimepicker);
        $('#create_task_duedate').datetimepicker(datetimepicker);
    });

    //Initialize DataTables
    $('.table-due-task').dataTable(settings);
    $('.table-completed-task').dataTable(settings);
    $('.table-archived-task').dataTable(settings);

    //Create task process
    $("#create-task-submit").click(function (e) {
    e.preventDefault();

    var hasError = false;

    //Checking if create_task_name is inputted
	var create_task_name = $("#create_task_name").val();
	if(create_task_name === '') {
        $("label[for='create_task_name']").empty().append("Please enter a name.");
        $("label[for='create_task_name']").removeClass("feedback-success");
        $("#create_task_name").removeClass("input-style-happy");
        $("label[for='create_task_name']").addClass("feedback-danger");
        $("#create_task_name").addClass("input-danger");
        $("#create_task_name").focus();
        hasError = true;
        return false;
    } else {
        $("label[for='create_task_name']").empty().append("All good!");
        $("label[for='create_task_name']").removeClass("feedback-danger");
        $("#create_task_name").removeClass("input-style-sad");
        $("label[for='create_task_name']").addClass("feedback-success");
        $("#create_task_name").addClass("input-success");
	}

	var create_task_notes = $("#create_task_notes").val();
	var create_task_url = $("#create_task_url").val();

    //Checking if create_task_startdate is inputted
	var create_task_startdate = $("#create_task_startdate").val();
	if(create_task_startdate === '') {
        $("label[for='create_task_startdate']").empty().append("Please select a date and time.");
        $("label[for='create_task_startdate']").removeClass("feedback-success");
        $("#create_task_startdate").removeClass("input-style-happy");
        $("label[for='create_task_startdate']").addClass("feedback-danger");
        $("#create_task_startdate").addClass("input-danger");
        $("#create_task_startdate").focus();
        hasError = true;
        return false;
	} else {
        $("label[for='create_task_startdate']").empty().append("All good!");
        $("label[for='create_task_startdate']").removeClass("feedback-danger");
        $("#task_startdate").removeClass("input-style-sad");
        $("label[for='create_task_startdate']").addClass("feedback-success");
        $("#create_task_startdate").addClass("input-success");
	}

    //Checking if create_task_duedate is inputted
	var create_task_duedate = $("#create_task_duedate").val();
	if(create_task_duedate === '') {
        $("label[for='create_task_duedate']").empty().append("Please select a date and time.");
        $("label[for='create_task_duedate']").removeClass("feedback-success");
        $("#create_task_duedate").removeClass("input-style-happy");
        $("label[for='create_task_duedate']").addClass("feedback-danger");
        $("#create_task_duedate").addClass("input-danger");
        $("#create_task_duedate").focus();
        hasError = true;
        return false;
    } else {
        $("label[for='create_task_duedate']").empty().append("All good!");
        $("label[for='create_task_duedate']").removeClass("feedback-danger");
        $("#create_task_duedate").removeClass("input-style-sad");
        $("label[for='create_task_duedate']").addClass("feedback-success");
        $("#create_task_duedate").addClass("input-success");
	}

    //If there are no errors, initialize the Ajax call
	if(hasError == false){

    jQuery.ajax({
	type: "POST",

    //URL to POST data to
	url: "https://student-portal.co.uk/includes/processes.php",
    dataType:"json",

    //Data posted
    data:'create_task_name='       + create_task_name +
         '&create_task_notes='     + create_task_notes +
         '&create_task_url='       + create_task_url +
         '&create_task_startdate=' + create_task_startdate +
         '&create_task_duedate='   + create_task_duedate,


    //If action completed, do the following
    success:function(html){

        $('.modal-form').modal('hide');

        $('.modal-form').on('hidden.bs.modal', function () {
            $(".table-due-task").dataTable().fnDestroy();
            $('#content-due-task').empty();
            $('#content-due-task').html(html.due_task);
            $(".table-due-task").dataTable(settings);

            $("label[for='create_task_name']").removeClass("feedback-success");
            $("label[for='create_task_name']").removeClass("feedback-danger");
            $("label[for='create_task_name']").empty().append('Name<span class="field-required">*</span>');
            $("#create_task_name").removeClass("input-success");
            $("#create_task_name").removeClass("input-danger");

            $("label[for='create_task_startdate']").removeClass("feedback-success");
            $("label[for='create_task_startdate']").removeClass("feedback-danger");
            $("label[for='create_task_startdate']").empty().append('Start date<span class="field-required">*</span>');
            $("#create_task_startdate").removeClass("input-success");
            $("#create_task_startdate").removeClass("input-danger");

            $("label[for='create_task_duedate']").removeClass("feedback-success");
            $("label[for='create_task_duedate']").removeClass("feedback-danger");
            $("label[for='create_task_duedate']").empty().append('Due date<span class="field-required">*</span>');
            $("#create_task_duedate").removeClass("input-success");
            $("#create_task_duedate").removeClass("input-danger");

            $("#create_task_error").hide();

            $('#create-task-form').trigger("reset");

            buttonReset();

            calendar.view();

        });

    },

    //If action failed, do the following
    error:function (xhr, ajaxOptions, thrownError){
		$("#create_task_error").show();
        $("#create_task_error").empty().append(thrownError);
        buttonReset();
    }
	});
    }
	return true;
	});

    //Update task process
	$("body").on("click", ".btn-update-task", function(e) {
    e.preventDefault();

    //Get clicked ID
	var clickedID = this.id.split('-');
    var taskToUpdate = clickedID[1];

    //Initialize Ajax call
	jQuery.ajax({
	type: "post",

    //URL to POST data to
	url: "https://student-portal.co.uk/includes/processes.php",
	dataType:"json",

    //Data posted
	data:'taskToUpdate='+ taskToUpdate,

    //If action completed, do the following
	success:function(html){

        $("#update-task-modal").modal('show');

        $('#update-task-modal').on('shown.bs.modal', function () {
            $("#update_taskid").val(html.taskid);
            $("#update_task_name").val(html.task_name);
            $("#update_task_notes").html(html.task_notes);
            $("#update_task_url").val(html.task_url);
            $("#update_task_startdate").val(html.task_startdate);
            $("#update_task_duedate").val(html.task_duedate);
            $('#update-task-modal .modal-title').html('Update ' + '"' + html.task_name + '"');

            $('#update_task_startdate').datetimepicker(datetimepicker);
            $('#update_task_duedate').datetimepicker(datetimepicker);
        });
	},

    //If action failed, do the following
	error:function (xhr, ajaxOptions, thrownError){
		$("#error").show();
		$("#error").empty().append(thrownError);
	}
	});

    });

    //Update task process
    $("#update-task-submit").click(function (e) {
    e.preventDefault();

	var hasError = false;

	var update_taskid = $("#update_taskid").val();

    //Check if update_task_name is inputted
	var update_task_name = $("#update_task_name").val();
	if(update_task_name === '') {
        $("label[for='update_task_name']").empty().append("Please enter a name.");
        $("label[for='update_task_name']").removeClass("feedback-success");
        $("#update_task_name").removeClass("input-success");
        $("label[for='update_task_name']").addClass("feedback-danger");
        $("#update_task_name").addClass("input-danger");
        $("#update_task_name").focus();
        hasError = true;
        return false;
    } else {
        $("label[for='update_task_name']").empty().append("All good!");
        $("label[for='update_task_name']").removeClass("feedback-danger");
        $("#update_task_name").removeClass("input-danger");
        $("label[for='update_task_name']").addClass("feedback-success");
        $("#update_task_name").addClass("input-success");
	}

	var update_task_notes = $("#update_task_notes").val();
	var update_task_url = $("#update_task_url").val();

    //Check if update_task_startdate is inputted
	var update_task_startdate = $("#update_task_startdate").val();
	if(update_task_startdate === '') {
        $("label[for='update_task_startdate']").empty().append("Please select a date and time.");
        $("label[for='update_task_startdate']").removeClass("feedback-success");
        $("#update_task_startdate").removeClass("input-success");
        $("label[for='update_task_startdate']").addClass("feedback-danger");
        $("#update_task_startdate").addClass("input-danger");
        $("#update_task_startdate").focus();
        hasError = true;
        return false;
	} else {
        $("label[for='update_task_startdate']").empty().append("All good!");
        $("label[for='update_task_startdate']").removeClass("feedback-danger");
        $("#update_task_startdate").removeClass("input-danger");
        $("label[for='update_task_startdate']").addClass("feedback-success");
        $("#update_task_startdate").addClass("input-success");
	}

    //Check if update_task_duedate is inputted
	var update_task_duedate = $("#update_task_duedate").val();
	if(update_task_duedate === '') {
        $("label[for='update_task_duedate']").empty().append("Please select a date and time.");
        $("label[for='update_task_duedate']").removeClass("feedback-success");
        $("#update_task_duedate").removeClass("input-success");
        $("label[for='update_task_duedate']").addClass("feedback-danger");
        $("#update_task_duedate").addClass("input-danger");
        $("#update_task_duedate").focus();
        hasError = true;
        return false;
    } else {
        $("label[for='update_task_duedate']").empty().append("All good!");
        $("label[for='update_task_duedate']").removeClass("feedback-danger");
        $("#update_task_duedate").removeClass("input-danger");
        $("label[for='update_task_duedate']").addClass("feedback-success");
        $("#update_task_duedate").addClass("input-success");
	}

    //If there are no errors, initialize the Ajax call
	if(hasError == false){
    jQuery.ajax({
	type: "POST",

    //URL to POST data to
	url: "https://student-portal.co.uk/includes/processes.php",
    dataType:"json",

    //Data posted
    data:'update_taskid='           + update_taskid +
         '&update_task_name='       + update_task_name +
         '&update_task_notes='      + update_task_notes +
         '&update_task_url='        + update_task_url +
         '&update_task_startdate='  + update_task_startdate +
         '&update_task_duedate='    + update_task_duedate,

    //If action completed, do the following
    success:function(html){

        $('.modal-form').modal('hide');

        $('.modal-form').on('hidden.bs.modal', function () {
            $(".table-due-task").dataTable().fnDestroy();
            $('#content-due-task').empty();
            $('#content-due-task').html(html.due_task);
            $(".table-due-task").dataTable(settings);

            $("label[for='update_task_name']").removeClass("feedback-success");
            $("label[for='update_task_name']").removeClass("feedback-danger");
            $("label[for='update_task_name']").empty().append('Name<span class="field-required">*</span>');
            $("#update_task_name").removeClass("input-success");
            $("#update_task_name").removeClass("input-danger");

            $("label[for='update_task_startdate']").removeClass("feedback-success");
            $("label[for='update_task_startdate']").removeClass("feedback-danger");
            $("label[for='update_task_startdate']").empty().append('Start date<span class="field-required">*</span>');
            $("#update_task_startdate").removeClass("input-success");
            $("#update_task_startdate").removeClass("input-danger");

            $("label[for='update_task_duedate']").removeClass("feedback-success");
            $("label[for='update_task_duedate']").removeClass("feedback-danger");
            $("label[for='update_task_duedate']").empty().append('Due date<span class="field-required">*</span>');
            $("#update_task_duedate").removeClass("input-success");
            $("#update_task_duedate").removeClass("input-danger");

            $("#update_task_error").hide();

            buttonReset();

        });

    },

    //If action failed, do the following
    error:function (xhr, ajaxOptions, thrownError){
		$("#update_task_error").show();
        $("#update_task_error").empty().append(thrownError);
        buttonReset();
    }
	});
    }
	return true;
	});

    //Complete task process
	$("body").on("click", ".btn-complete-task", function(e) {
    e.preventDefault();

    //Get clicked ID
	var clickedID = this.id.split('-');
    var taskToComplete = clickedID[1];

    togglePreloader();

    //Initialize Ajax call
	jQuery.ajax({
	type: "POST",

    //URL to POST data to
	url: "https://student-portal.co.uk/includes/processes.php",
	dataType:"json",

    //Data posted
	data:'taskToComplete='+ taskToComplete,

    //If action completed, do the following
	success:function(html){

        $(".table-due-task").dataTable().fnDestroy();
        $('#content-due-task').empty();
        $('#content-due-task').html(html.due_task);
        $(".table-due-task").dataTable(settings);

        $(".table-completed-task").dataTable().fnDestroy();
        $('#content-completed-task').empty();
        $('#content-completed-task').html(html.completed_task);
        $(".table-completed-task").dataTable(settings);

        togglePreloader();

        calendar.view();

	},

    //If action failed, do the following
	error:function (xhr, ajaxOptions, thrownError){
		$("#error").show();
		$("#error").empty().append(thrownError);
	}
	});

    });

    //Deactivate task process
    $("body").on("click", ".btn-deactivate-task", function(e) {
    e.preventDefault();

    //Get clicked ID
	var clickedID = this.id.split('-');
    var taskToDeactivate = clickedID[1];

    togglePreloader();

    //Initialize Ajax call
	jQuery.ajax({
	type: "POST",

    //URL to POST data to
	url: "https://student-portal.co.uk/includes/processes.php",
	dataType:"json",

    //Data posted
	data:'taskToDeactivate='+ taskToDeactivate,

    //If action completed, do the following
	success:function(html){

        $(".table-due-task").dataTable().fnDestroy();
        $('#content-due-task').empty();
        $('#content-due-task').html(html.due_task);
        $(".table-due-task").dataTable(settings);

        $(".table-archived-task").dataTable().fnDestroy();
        $('#content-archived-task').empty();
        $('#content-archived-task').html(html.archived_task);
        $(".table-archived-task").dataTable(settings);

        togglePreloader();

        calendar.view();

	},

    //If action failed, do the following
	error:function (xhr, ajaxOptions, thrownError){
		$("#error").show();
		$("#error").empty().append(thrownError);
	}
	});
    });

    //Reactivate task process
    $("body").on("click", ".btn-reactivate-task", function(e) {
    e.preventDefault();

    //Get clicked ID
	var clickedID = this.id.split('-');
    var taskToReactivate = clickedID[1];

    togglePreloader();

    //Initialize Ajax call
	jQuery.ajax({
	type: "POST",

    //URL to POST data to
	url: "https://student-portal.co.uk/includes/processes.php",
	dataType:"json",

    //Data posted
	data:'taskToReactivate='+ taskToReactivate,

    //If action completed, do the following
	success:function(html){

        $(".table-archived-task").dataTable().fnDestroy();
        $('#content-archived-task').empty();
        $('#content-archived-task').html(html.archived_task);
        $(".table-archived-task").dataTable(settings);

        $(".table-completed-task").dataTable().fnDestroy();
        $('#content-completed-task').empty();
        $('#content-completed-task').html(html.completed_task);
        $(".table-completed-task").dataTable(settings);

        $(".table-due-task").dataTable().fnDestroy();
        $('#content-due-task').empty();
        $('#content-due-task').html(html.due_task);
        $(".table-due-task").dataTable(settings);

        togglePreloader();

        calendar.view();

	},

    //If action failed, do the following
	error:function (xhr, ajaxOptions, thrownError){
		$("#error").show();
		$("#error").empty().append(thrownError);
	}
	});
    });

    //Delete task process
    $("body").on("click", ".btn-delete-task", function(e) {
    e.preventDefault();

    //Get clicked ID
	var clickedID = this.id.split('-');
    var taskToDelete = clickedID[1];

    //Initialize Ajax call
	jQuery.ajax({
	type: "POST",

    //URL to POST data to
	url: "https://student-portal.co.uk/includes/processes.php",
	dataType:"json",

    //Data posted
	data:'taskToDelete='+ taskToDelete,

    //If action completed, do the following
	success:function(html){

        $('.modal-custom').modal('hide');

        $('.modal-custom').on('hidden.bs.modal', function () {
            $('#content-due-task').empty();
            $(".table-due-task").dataTable().fnDestroy();
            $('#content-due-task').html(html.due_task);
            $(".table-due-task").dataTable(settings);

            $('#content-completed-task').empty();
            $(".table-completed-task").dataTable().fnDestroy();
            $('#content-completed-task').html(html.completed_task);
            $(".table-completed-task").dataTable(settings);

            $('#content-archived-task').empty();
            $(".table-archived-task").dataTable().fnDestroy();
            $('#content-archived-task').html(html.archived_task);
            $(".table-archived-task").dataTable(settings);

            buttonReset();

            calendar.view();

        });

	},

    //If action failed, do the following
	error:function (xhr, ajaxOptions, thrownError){
        buttonReset();
		$("#error").show();
		$("#error").empty().append(thrownError);
	}
	});
    });

    //If task-button is clicked, do the following
	$("#task-button").click(function (e) {
    e.preventDefault();
        $(".calendar-view").hide();
		$("#calendar-toggle").hide();
        $(".task-view").show();
		$("#duetasks-toggle").show();
		$("#completedtasks-toggle").show();
		$(".calendar-tile").removeClass("tile-selected");
		$(".calendar-tile p").removeClass("tile-text-selected");
		$(".calendar-tile i").removeClass("tile-text-selected");
		$(".task-tile").addClass("tile-selected");
		$(".task-tile p").addClass("tile-text-selected");
		$(".task-tile i").addClass("tile-text-selected");
	});

    //If calendar-button is clicked, do the following
	$("#calendar-button").click(function (e) {
    e.preventDefault();
        $(".task-view").hide();
		$("#duetasks-toggle").hide();
		$("#completedtasks-toggle").hide();
        $(".calendar-view").show();
		$("#calendar-toggle").show();
		$(".task-tile").removeClass("tile-selected");
		$(".task-tile p").removeClass("tile-text-selected");
		$(".task-tile i").removeClass("tile-text-selected");
		$(".calendar-tile").addClass("tile-selected");
		$(".calendar-tile p").addClass("tile-text-selected");
		$(".calendar-tile i").addClass("tile-text-selected");
	});

	</script>

    <?php endif; ?>

	<?php else : ?>

	<?php include 'includes/menus/menu.php'; ?>

    <div class="container">

	<form class="form-horizontal form-custom">

    <div class="form-logo text-center">
    <i class="fa fa-graduation-cap"></i>
    </div>

    <hr>

    <p class="feedback-danger text-center">Looks like you're not signed in yet. Please Sign in before accessing this area.</p>

    <hr>

    <div class="text-center">
	<a id="signin-button" class="btn btn-primary btn-lg" href="/">Sign in</a>
    </div>

    </form>
     
	</div>

	<?php include 'includes/footers/footer.php'; ?>

    <?php include 'assets/js-paths/common-js-paths.php'; ?>

	<?php endif; ?>

</body>
</html>
