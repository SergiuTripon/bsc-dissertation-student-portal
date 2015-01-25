<?php
include '../includes/signin.php';

if (isset($_POST["recordToChange"])) {

$idToChange = filter_input(INPUT_POST, 'recordToChange', FILTER_SANITIZE_NUMBER_INT);

$stmt1 = $mysqli->prepare("SELECT userid FROM user_signin WHERE userid = ? LIMIT 1");
$stmt1->bind_param('i', $idToChange);
$stmt1->execute();
$stmt1->store_result();
$stmt1->bind_result($userid);
$stmt1->fetch();
$stmt1->close();

} else {
header('Location: ../../account/');
}

if ($dateofbirth == "0000-00-00") {
    $dateofbirth = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<?php include '../assets/js-paths/pacejs-js-path.php'; ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<?php include '../assets/css-paths/common-css-paths.php'; ?>
	<?php include '../assets/css-paths/datetimepicker-css-path.php'; ?>

    <title>Student Portal | Change account password</title>

    <style>
    #gender {
		color: #FFA500;
		background-color: #333333;
	}
    </style>

</head>

<body>

	<div class="preloader"></div>

	<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>

    <?php if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'admin') : ?>

	<div class="container">

    <?php include '../includes/menus/portal_menu.php'; ?>

    <ol class="breadcrumb">
	<li><a href="../../overview/">Overview</a></li>
	<li><a href="../../account/">Account</a></li>
    <li class="active">Update an account</li>
    </ol>

	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

    <div class="panel panel-default">

	<div class="panel-heading" role="tab" id="headingOne">
	<h4 class="panel-title">
    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Update an account</a>
	</h4>
    </div>

    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">

	<div class="panel-body">

	<!-- Change an account's password -->
    <div class="content-panel mb10" style="border: none;">

	<form class="form-custom" style="max-width: 800px; padding-top: 0px;" name="changepassword_form" novalidate>

	<p id="error" class="feedback-sad text-center"></p>
	<p id="success" class="feedback-happy text-center"></p>

	<div id="hide">

    <input type="hidden" name="userid" id="userid" value="<?php echo $userid; ?>" />

    <div class="form-group">

    <div class="col-xs-6 col-sm-6 full-width">
    <label>New password</label>
    <input class="form-control" type="password" name="password" id="password" placeholder="New password">
	</div>

    <div class="col-xs-6 col-sm-6 full-width">
    <label>New password confirmation</label>
    <input class="form-control" type="password" name="confirmpwd" id="confirmpwd" placeholder="Confirm new password">
	</div>

    </div>

    <input type="hidden" name="degree" id="degree">

    <div class="text-right">
    <button id="FormSubmit" class="btn btn-custom btn-lg ladda-button mt10 mr5" data-style="slide-up" data-spinner-color="#FFA500"><span class="ladda-label">Update</span></button>
    </div>

	</div>

    </form>

    </div><!-- /content-panel -->
    <!-- End of Update account -->

    </div><!-- /panel-body -->
    </div><!-- /panel-collapse -->
    </div><!-- /panel-default -->

	</div><!-- /panel-group -->

    </div> <!-- /container -->

	<?php include '../includes/footers/portal_footer.php'; ?>

    <!-- Sign Out (Inactive) JS -->
    <script src="../assets/js/custom/sign-out-inactive.js"></script>

	<?php endif; ?>

	<?php else : ?>

	<style>
    html, body {
		height: 100% !important;
	}
    </style>

    <header class="intro">
    <div class="intro-body">

    <form class="form-custom orange-form">

	<div class="logo-custom animated fadeIn delay1">
    <i class="fa fa-graduation-cap"></i>
    </div>

    <hr class="mt10 hr-custom">
    <p class="feedback-sad text-center">Looks like you're not signed in yet. Please sign in before accessing this area.</p>
    <hr class="hr-custom">

    <div class="text-center">
    <a class="btn btn-custom btn-lg ladda-button" data-style="slide-up" data-spinner-color="#FFA500" href="/"><span class="ladda-label">Sign In</span></a>
	</div>

    </form>

    </div><!-- /intro-body -->
    </header>

	<?php endif; ?>

	<?php include '../assets/js-paths/common-js-paths.php'; ?>
	<?php include '../assets/js-paths/datetimepicker-js-path.php'; ?>

	<script>
    Ladda.bind('.ladda-button', {timeout: 1000});
	</script>

	<script>
	$(document).ready(function() {
    $("#FormSubmit").click(function (e) {
    e.preventDefault();

	var hasError = false;

    var userid1 = $("#userid").val();

	var password = $("#password").val();
	if(password === '') {
		$("#error").show();
        $("#error").empty().append("Please enter a password.");
		$("#password").css("border-color", "#FF5454");
		hasError  = true;
		return false;
    } else {
		$("#error").hide();
		$("#password").css("border-color", "#4DC742");
	}

	if (password.length < 6) {
		$("#error").show();
		$(".sad-feedback").empty().append("Passwords must be at least 6 characters long. Please try again.");
		$("#password").css("border-color", "#FF5454");
		hasError  = true;
		return false;
	} else {
		$("#error").hide();
		$("#password").css("border-color", "#4DC742");
	}

	var upperCase= new RegExp('[A-Z]');
	var lowerCase= new RegExp('[a-z]');
	var numbers = new RegExp('[0-9]');

	if(password.match(upperCase) && password.match(lowerCase) && password.match(numbers)) {
		$("#error").hide();
		$("#password").css("border-color", "#4DC742");
	} else {
		$("#error").show();
		$(".sad-feedback").empty().append("Passwords must contain at least one number, one lowercase and one uppercase letter. Please try again.");
		$("#password").css("border-color", "#FF5454");
		hasError  = true;
		return false;
	}

	var confirmpwd = $("#confirmpwd").val();
	if(confirmpwd === '') {
		$("#error").show();
        $("#error").empty().append("Please enter a password confirmation.");
		$("#confirmpwd").css("border-color", "#FF5454");
		hasError  = true;
		return false;
    } else {
		$("#error").hide();
		$("#confirmpwd").css("border-color", "#4DC742");
	}

	if(password != confirmpwd) {
		$("#error").show();
		$(".sad-feedback").empty().append("Your password and confirmation do not match. Please try again.");
		$("#password").css("border-color", "#FF5454");
		$("#confirmpwd").css("border-color", "#FF5454");
        hasError  = true;
		return false;
	} else {
		$("#error").hide();
		$("#password").css("border-color", "#4DC742");
		$("#confirmpwd").css("border-color", "#4DC742");
	}

	if(hasError == false){
    jQuery.ajax({
	type: "POST",
	url: "https://student-portal.co.uk/includes/adminaccount_process.php",
    data:'userid1=' + userid1 + '&password=' + password1 + '&confirmpwd=' + confirmpwd1,
    success:function(response){
		$("#hide").hide();
		$("#error").hide();
		$("#success").append('The password has been changed successfully.');
		$("#success-button").show();
    },
    error:function (xhr, ajaxOptions, thrownError){
		$("#error").show();
        $("#error").empty().append(thrownError);
    }
	});
    }

	return true;

	});
	});
	</script>

</body>
</html>

