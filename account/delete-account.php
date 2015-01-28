<?php
include '../includes/signin.php';

if (isset($_SESSION['userid']))
$userid = $_SESSION['userid'];
else $userid = '';

$stmt1 = $mysqli->prepare("SELECT user_signin.email, user_details.studentno, user_details.firstname, user_details.surname FROM user_sigin LEFT JOIN user_details ON user_signin.userid = user_details.userid WHERE user_signin.userid = ? LIMIT 1");
$stmt1->bind_param('i', $userid);
$stmt1->execute();
$stmt1->store_result();
$stmt1->bind_result($email, $studentno, $firstname, $surname);
$stmt1->fetch();

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

    <title>Student Portal | Delete Account</title>

</head>

<body>
	
	<div class="preloader"></div>

	<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>

    <div class="container">

    <?php include '../includes/menus/portal_menu.php'; ?>

    <ol class="breadcrumb">
    <li><a href="../../overview/">Overview</a></li>
	<li><a href="../../account/">Account</a></li>
    <li class="active">Delete account</li>
    </ol>
	
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	
	<div class="panel panel-default">
	
	<div class="panel-heading" role="tab" id="headingOne">
    <h4 class="panel-title">
    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Delete account</a>
    </h4>
    </div>

    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
    
	<div class="panel-body">
	
    <!-- Delete account -->
    <div class="content-panel mb10" style="border: none;">
                                    
	<form class="form-custom" style="max-width: 600px; padding-top: 0px;" name="deleteaccount_form">

    <div class="form-group">
    
	<div class="col-xs-6 col-sm-6 full-width">
    <label>First name</label>
    <input class="form-control" type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>" placeholder="First name" readonly="readonly">
	<label>Student number</label>
    <input class="form-control" type="text" name="studentno" id="studentno" value="<?php echo $studentno; ?>" placeholder="Student Number" readonly="readonly">
	</div>

    <div class="col-xs-6 col-sm-6 full-width">
	<label>Surname</label>
    <input class="form-control" type="text" name="surname" id="surname" value="<?php echo $surname; ?>" placeholder="Surname" readonly="readonly">
    <label>Email address</label>
    <input class="form-control" type="email" name="email" id="email" value="<?php echo $email; ?>" placeholder="Email address" readonly="readonly">
    </div>
    
	</div>

    <div class="text-right">
    <a class="btn btn-custom btn-lg ladda-button mt10 mr5" data-style="slide-up" data-spinner-color="#FFA500" data-toggle="modal" href="#deleteaccount-modal"><span class="ladda-label">Delete account</span></a>
    </div>

    </form>

    </div><!-- /content-panel -->
    <!-- End of Delete account -->
	
	</div><!-- /panel-body -->
    </div><!-- /panel-collapse -->
    </div><!-- /panel-default -->
	</div><!-- /panel-group -->

    <!-- Delete Account Modal -->

    <div class="modal modal-custom" id="deleteaccount-modal" tabindex="-1" role="dialog" aria-labelledby="deleteaccount-modal-label" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    
	<div class="modal-header">
    <div class="logo-custom animated fadeIn delay1">
    <i class="fa fa-trash"></i>
    </div>
    </div>

    <div class="modal-body">

    <form class="form-custom" name="deleteaccount_form">

    <input type="hidden" name="deleteaccount_button" id="deleteaccount_button">

    <p class="feedback-custom text-center">Are you sure you want to delete your account?</p>

    </div>
    
	<div class="modal-footer">
    
	<div class="pull-left">
    <button id="FormSubmit" class="btn btn-custom btn-lg ladda-button mt10 mr5" data-style="slide-up" data-spinner-color="#FFA500" type="submit"><span class="ladda-label">Yes</span></button>
    </div>
    <div class="text-right">
	<button class="btn btn-custom btn-lg ladda-button" data-style="slide-up" data-spinner-color="#FFA500" data-dismiss="modal"><span class="ladda-label">No</span></button>
	</div>
    
	</div>

    </form>

    </div>
    </div>
    </div>

    </div> <!-- /container -->
	
	<?php include '../includes/footers/portal_footer.php'; ?>

    <!-- Sign Out (Inactive) JS -->
    <script src="https://student-portal.co.uk/assets/js/custom/sign-out-inactive.js"></script>

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

	<script>
    Ladda.bind('.ladda-button', {timeout: 1000});
	</script>

    <script>
    $(document).ready(function() {
    $("#FormSubmit").click(function (e) {
    e.preventDefault();

    deleteaccount_button = $("#deleteaccount_button").val();

    jQuery.ajax({
    type: "POST",
    url: "https://student-portal.co.uk/includes/account_process.php",
    data:'deleteaccount_button=' + deleteaccount_button,
    success:function(response){
        window.location.href = "/account/account-deleted/";
    },
    error:function (xhr, ajaxOptions, thrownError){
        $("#error").show();
        $("#error").empty().append(thrownError);
    }
    });

    return true;

    });
    });
    </script>

</body>
</html>
