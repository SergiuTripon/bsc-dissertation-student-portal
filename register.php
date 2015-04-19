<?php
include 'includes/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include 'assets/meta-tags.php'; ?>

    <?php include 'assets/css-paths/common-css-paths.php'; ?>

    <title>Student Portal | Register</title>

    <style>
    #register a {
        color: #FFFFFF;
        background-color: #992320;
    }
    #register a:focus, #register a:hover {
        color: #FFFFFF;
        background-color: #992320;
    }
    </style>

</head>

<body>
	
	<div class="preloader"></div>

	<?php if (isset($_SESSION['signedIn']) && $_SESSION['signedIn'] == true) : ?>

    <?php include 'includes/menus/portal_menu.php'; ?>

    <div class="container">

    <form class="form-horizontal form-custom">
                
	<div class="form-logo text-center">
    <i class="fa fa-check-square-o"></i>
    </div>
    
	<hr>
                
	<p class="feedback-sad text-center">You already have an account and therefore cannot register for another. Only one account is allowed per user.</p>
    
	<hr>
                
	<div class="pull-left">
    <a class="btn btn-success btn-lg btn-load" href="../home/">Home</a>
    </div>
	
    <div class="text-right">
    <a class="btn btn-danger btn-lg btn-load" href="../sign-out/">Sign Out</a>
    </div>
    
	</form>

    </div>

    <?php include 'includes/footers/footer.php'; ?>
    <?php include 'assets/js-paths/common-js-paths.php'; ?>




	<?php else : ?>

    <?php include 'includes/menus/menu.php'; ?>

    <div class="container">

    <form class="form-horizontal form-custom" style="max-width: 600px;" id="register_form" name="register_form">

    <div class="form-logo text-center">
	<i class="fa fa-check-square-o"></i>
    </div>

    <hr>

    <p id="error" class="feedback-sad text-center"></p>
    <p id="error1" class="feedback-sad text-center"></p>
	<p id="success" class="feedback-happy text-center"></p>

    <div id="hide">

    <p class="feedback-sad text-justify">Note: The register facility is available to students only. If you're a lecturer, tutorial assistant or administrator, please contact an administrator who will create an account for you.</p>

    <hr>

    <div class="form-group">
    <div class="col-xs-6 col-sm-6 full-width">
    <label for="firstname">First name<span class="field-required">*</span></label>
    <input class="form-control" type="text" name="firstname" id="firstname" placeholder="Enter your first name">
    </div>
    <div class="col-xs-6 col-sm-6 full-width">
    <label for="surname">Surname<span class="field-required">*</span></label>
    <input class="form-control" type="text" name="surname" id="surname" placeholder="Enter your surname">
    </div>
    </div>

	<div class="form-group">
    <div class="col-xs-12 col-sm-12 full-width">
    <label for="gender">Gender<span class="field-required">*</span></label>
    <select class="form-control" name="gender" id="gender" style="width: 100%;">
        <option></option>
        <option>Male</option>
        <option>Female</option>
        <option>Other</option>
    </select>
    </div>
    </div>

    <label for="email">Email address<span class="field-required">*</span></label>
    <input class="form-control" type="email" name="email" id="email" placeholder="Enter your email address">
    <p id="error3" class="feedback-sad text-center"></p>

    <div class="form-group">
    <div class="col-xs-6 col-sm-6 full-width">
    <label for="password">Password<span class="field-required">*</span></label>
    <input class="form-control" type="password" name="password" id="password" placeholder="Enter your password">
    </div>
    <div class="col-xs-6 col-sm-6 full-width">
	<label for="confirmpwd">Confirm password<span class="field-required">*</span></label>
    <input class="form-control" type="password" name="confirmpwd" id="confirmpwd" placeholder="Enter your password confirmation">
    </div>
    </div>

	<div class="text-right">
    <a href="#modal-help" data-toggle="modal">Need help?</a>
    </div>
	
	</div>

    <hr>

	<div id="register-button" class="pull-left">
    <a class="btn btn-info btn-lg btn-load" href="/">Sign in</a>
    </div>
	
    <div id="register-button" class="text-right">
    <button id="FormSubmit" class="btn btn-primary btn-lg btn-load">Register</button>
    </div>
	
	<div id="success-button" class="text-center" style="display:none">
    <a class="btn btn-success btn-lg btn-load" href="/">Sign in</a>
    </div>
	
    </form>

    </div>

    <!-- Help Modal -->
    <div id="modal-help" class="modal fade modal-custom modal-info" tabindex="-1" role="dialog" aria-labelledby="modal-custom-label" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">

	<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
    <h4 class="modal-title" id="modal-custom-label">Need help?</h4>
    </div>

    <div class="modal-body">
    <ul class="feedback-custom">
    <li>Usernames may contain only digits, upper and lower case letters and underscores</li>
    <li>Emails must have a valid email format</li>
    <li>Passwords must be at least 6 characters long</li>
    <li>Passwords must contain
    <ul>
    <li>At least one upper case letter (A..Z)</li>
    <li>At least one lower case letter (a..z)</li>
    <li>At least one number (0..9)</li>
    </ul>
    </li>
    <li>Your password and confirmation must match exactly</li>
    </ul>
    </div>

	<div class="modal-footer">
    <div class="text-right">
    <button type="button" class="btn btn-lg" data-dismiss="modal">Close</button>
    </div>
    </div>

	</div><!-- /modal -->
    </div><!-- /modal-dialog -->
    </div><!-- /modal-content -->
	<!-- End of Help Modal -->

    <?php include 'includes/footers/footer.php'; ?>
    <?php include 'assets/js-paths/common-js-paths.php'; ?>

	<script>
    //On load
    $(document).ready(function () {
        //select2
        $("#gender").select2({placeholder: "Select an option"});
    });

	//Register user
    $("#FormSubmit").click(function (e) {
    e.preventDefault();

	var hasError = false;

    var firstname = $("#firstname").val();
	if(firstname === '') {
        $("label[for='firstname']").empty().append("Please enter a first name.");
        $("label[for='firstname']").removeClass("feedback-happy");
        $("label[for='firstname']").addClass("feedback-sad");
        $("#firstname").removeClass("input-happy");
        $("#firstname").addClass("input-sad");
        $("#firstname").focus();
		hasError = true;
        return false;
    } else {
        $("label[for='firstname']").empty().append("All good!");
        $("label[for='firstname']").removeClass("feedback-sad");
        $("label[for='firstname']").addClass("feedback-happy");
        $("#firstname").removeClass("input-sad");
        $("#firstname").addClass("input-happy");
	}

	var surname = $("#surname").val();
	if(surname === '') {
        $("label[for='surname']").empty().append("Please enter a surname.");
        $("label[for='surname']").removeClass("feedback-happy");
        $("label[for='surname']").addClass("feedback-sad");
        $("#surname").removeClass("input-happy");
        $("#surname").addClass("input-sad");
        $("#surname").focus();
		hasError = true;
        return false;
    } else {
        $("label[for='surname']").empty().append("All good!");
        $("label[for='surname']").removeClass("feedback-sad");
        $("label[for='surname']").addClass("feedback-happy");
        $("#surname").removeClass("input-sad");
        $("#surname").addClass("input-happy");
	}

    var gender_check = $("#gender :selected").html();
    if (gender_check === 'Select an option') {
        $("label[for='gender']").empty().append("Please select an option.");
        $("label[for='gender']").removeClass("feedback-happy");
        $("label[for='gender']").addClass("feedback-sad");
        $("#gender").removeClass("input-happy");
        $("#gender").addClass("input-sad");
        $("#gender").focus();
        hasError  = true;
        return false;
    }
    else {
        $("label[for='gender']").empty().append("All good!");
        $("label[for='gender']").removeClass("feedback-sad");
        $("label[for='gender']").addClass("feedback-happy");
        $("#marker_category").removeClass("input-sad");
        $("#marker_category").addClass("input-happy");
    }

	var email = $("#email").val();
	if(email === '') {
        $("label[for='email']").empty().append("Please enter an email address.");
        $("label[for='email']").removeClass("feedback-happy");
        $("label[for='email']").addClass("feedback-sad");
        $("#email").removeClass("input-happy");
        $("#email").addClass("input-sad");
        $("#email").focus();
		hasError = true;
        return false;
    } else {
        $("label[for='email']").empty().append("All good!");
        $("label[for='email']").removeClass("feedback-sad");
        $("label[for='email']").addClass("feedback-happy");
        $("#email").removeClass("input-sad");
        $("#email").addClass("input-happy");
	}

	var password = $("#password").val();
	if(password === '') {
        $("label[for='password']").empty().append("Please enter a password.");
        $("label[for='password']").removeClass("feedback-happy");
        $("label[for='password']").addClass("feedback-sad");
        $("#password").removeClass("input-happy");
        $("#password").addClass("input-sad");
        $("#password").focus();
		hasError  = true;
		return false;
    } else {
        $("label[for='password']").empty().append("All good!");
        $("label[for='password']").removeClass("feedback-sad");
        $("label[for='password']").addClass("feedback-happy");
        $("#password").removeClass("input-sad");
        $("#password").addClass("input-happy");
	}

    password = $("#password").val();
	if (password.length < 6) {
        $("#error1").show();
        $("#error1").empty().append("Passwords must be at least 6 characters long. Please try again.");
        $("label[for='password']").empty().append("Passwords must be at least 6 characters long. Please try again.");
        $("label[for='password']").empty().append("Wait a minute!");
        $("label[for='password']").removeClass("feedback-happy");
        $("label[for='password']").addClass("feedback-sad");
        $("#password").removeClass("input-happy");
        $("#password").addClass("input-sad");
        $("#password").focus();
		hasError  = true;
		return false;
	} else {
        $("label[for='password']").empty().append("All good!");
        $("label[for='password']").removeClass("feedback-sad");
        $("label[for='password']").addClass("feedback-happy");
        $("#password").removeClass("input-happy");
        $("#password").addClass("input-sad");
	}

	var upperCase= new RegExp('[A-Z]');
	var lowerCase= new RegExp('[a-z]');
	var numbers = new RegExp('[0-9]');

    password = $("#password").val();
	if(password.match(upperCase) && password.match(lowerCase) && password.match(numbers)) {
        $("label[for='password']").empty().append("All good!");
        $("label[for='password']").removeClass("feedback-sad");
        $("label[for='password']").addClass("feedback-happy");
        $("#password").removeClass("input-sad");
        $("#password").addClass("input-happy");
	} else {
        $("#error1").show();
        $("#error1").empty().append("Passwords must contain at least one number,<br>one lowercase and one uppercase letter. Please try again.");
        $("label[for='password']").empty().append("Wait a minute!");
        $("label[for='password']").removeClass("feedback-happy");
        $("label[for='password']").addClass("feedback-sad");
        $("#password").removeClass("input-happy");
        $("#password").addClass("input-sad");
        $("#password").focus();
		hasError  = true;
		return false;
	}

	var confirmpwd = $("#confirmpwd").val();
	if(confirmpwd === '') {
        $("label[for='confirmpwd']").empty().append("Please enter a password confirmation.");
        $("label[for='confirmpwd']").removeClass("feedback-happy");
        $("label[for='confirmpwd']").addClass("feedback-sad");
        $("#confirmpwd").removeClass("input-happy");
        $("#confirmpwd").addClass("input-sad");
        $("#confirmpwd").focus();
		hasError  = true;
		return false;
    } else {
        $("label[for='confirmpwd']").empty().append("All good!");
        $("label[for='confirmpwd']").removeClass("feedback-sad");
        $("label[for='confirmpwd']").addClass("feedback-happy");
        $("#confirmpwd").removeClass("input-sad");
        $("#confirmpwd").addClass("input-happy");
	}

	if(password != confirmpwd) {
        $("#error1").show();
        $("#error1").empty().append("Your password and confirmation do not match. Please try again.");
        $("label[for='confirmpwd']").empty().append("Wait a minute!");
        $("label[for='confirmpwd']").removeClass("feedback-happy");
        $("label[for='confirmpwd']").addClass("feedback-sad");
        $("#confirmpwd").removeClass("input-happy");
        $("#confirmpwd").addClass("input-sad");
        $("#confirmpwd").focus();
        hasError  = true;
		return false;
	} else {
        $("label[for='confirmpwd']").empty().append("All good!");
        $("label[for='confirmpwd']").removeClass("feedback-sad");
        $("label[for='confirmpwd']").addClass("feedback-happy");
        $("#confirmpwd").removeClass("input-sad");
        $("#confirmpwd").addClass("input-happy");
        $("#error1").hide();
	}

    var gender = $("#gender :selected").val();

    if(hasError == false){
    jQuery.ajax({
	type: "POST",
	url: "https://student-portal.co.uk/includes/processes.php",
    data:'register_firstname=' + firstname +
         '&register_surname='  + surname +
         '&register_gender='   + gender +
         '&register_email='    + email +
         '&register_password=' + password,
    success:function(){
        $("#error").hide();
		$("#hide").hide();
        $("#FormSubmit").hide();
		$("#register-button").hide();
        $("#success").show();
		$("#success").append('Thank you for your registration. You can now Sign in to your account.');
		$("#success-button").show();
    },
    error:function (xhr, ajaxOptions, thrownError){
        $("#success").hide();
        $("#error").show();
        $("#error").empty().append(thrownError);
    }
	});
    }
	return true;
	});
	</script>

	<?php endif; ?>

</body>
</html>

