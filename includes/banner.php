<head>
	<link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<?php if (isset($_SESSION['user']['username'])) { ?>
	<div class="logged_in_info">
		<span>Welcome <?php echo $_SESSION['user']['username'] ?></span> | <span><a href="logout.php">logout</a></span>
	</div>

<?php } else if(isset($_GET['token']) && isset($_GET['action']) && $_GET['action'] === "request") { ?>
	<div class="banner">
		<div class="welcome_msg">
			<h1>Today's Inspirational Quote</h1>
			<p id="quote">
			    “All our dreams <br>
			    can come true, <br>
			    if we have the courage to pursue them.” <br>
			</p>
			<a href="register.php" class="btn">Join us!</a>
			<script type="text/javascript" src="static/js/quoteChanger.js"></script>
		</div>

		<div class="login_div">
			<form action="<?php echo BASE_URL . 'index.php'; ?>" method="post" >
				<h2 id = "title_login">Confirm password</h2>
				<div style="width: 60%; margin: 0px auto;">
					<?php include(ROOT_PATH . '/includes/errors.php') ?>
				</div>
				<input type="hidden" name="token" value = "<?php echo $_GET['token']?>">
				<input type="password" name="password"  placeholder="Password">
				<input type="password" name="confirm_password"  placeholder="Confirm password">
				<div class="login_request_div">
					<button class="btn" type="submit" name="rst_password">Reset</button>
				</div>
			</form>
		</div>
	</div>
<?php } else { ?>
	<div class="banner">
		<div class="welcome_msg">
			<h1>Today's Inspirational Quote</h1>
			<p id="quote">
			    “All our dreams <br>
			    can come true, <br>
			    if we have the courage to pursue them.” <br>
			</p>
			<a href="register.php" class="btn">Join us!</a>
			<script type="text/javascript" src="static/js/quoteChanger.js"></script>
		</div>

		<div class="login_div">
			<form action="<?php echo BASE_URL . 'index.php'; ?>" method="post" >
				<h2 id = "title_login">Login</h2>
				<div style="width: 60%; margin: 0px auto;">
					<?php include(ROOT_PATH . '/includes/errors.php') ?>
				</div>
				<input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username">
				<input style = "display: none;" type="email" name="email" value="" placeholder="Email">
				<input type="password" name="password"  placeholder="Password">
				<div class="login_request_div">
					<button class="btn" type="submit" name="login_btn">Sign in</button>
					<button style = "display: none;" class="btn" type="submit" name="request_btn">Request</button>
					<a href="#" id = "forgot_password">Forgot password</a>
				</div>
			</form>
		</div>
	</div>
<?php } ?>
<script type="text/javascript">
$( document ).ready(function() {
	var click_for_request = 0;
	$( "#forgot_password" ).click(function() {
		click_for_request++;
		if(click_for_request % 2 != 0) {
			$('#title_login').html("Input email");
			$('.login_request_div a').html("Back to sign in");
			$('input[name = "password"]').css("display", "none");
			$('input[name = "username"]').css("display", "none");
			$('input[name = "email"]').css("display", "block");
			$('button[name = "request_btn"]').css("display", "block");
			$('button[name = "login_btn"]').css("display", "none");
		}
		else {
			$('#title_login').html("Login");
			$('.login_request_div a').html("Forgot password");
			$('input[name = "email"]').css("display", "none");
			$('input[name = "username"]').css("display", "block");
			$('input[name = "password"]').css("display", "block");
			$('button[name = "request_btn"]').css("display", "none");
			$('button[name = "login_btn"]').css("display", "block");
		}
	});
});
</script>
<style media="screen">
	.login_request_div {
		display: flex;
		flex-direction: row;
		align-items: center;
		justify-content: space-between;
	}

	.login_request_div a {
		margin-right: 20%;
		color: white;
	}
</style>
