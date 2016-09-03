<html>
<head>
	<meta charset="UTF-8" />
	<title>Rental Reminder Form</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

	<div class="contact-form">
        <h2>Rental Reminder Form</h2>
		<form id="contact-form" method="POST" action="form-to-email.php">

			<div class="control-group">
				<label>Your Name</label>
				<input class="fullname" type="text" name="fullname" />
			</div>

			<div class="control-group">
				<label>Email</label>
				<input class="email" type="text" name="email" />
			</div>

			<div class="control-group">
				<label>Phone (optional)</label>
				<input class="phone" type="text" name="phone" />
			</div>

			<div class="control-group">
				<label>Message</label>
				<textarea class="message" name="message"></textarea>
			</div>

			<div id="errors"></div>

			<div class="control-group no-margin">
				<input type="submit" name="submit" value="Send" id="submit" />
			</div>

		</form>
        <div id='msg_submitting'><h2>Submitting ...</h2></div>
        <div id='msg_submitted'><h2>Thank you !<br> The form was submitted Successfully.</h2></div>
	</div>

	<!-- JavaScript Files -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/additional-methods.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <!-- End JavaScript Files -->

</body>
</html>