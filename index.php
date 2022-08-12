<?php require_once('config.php') ?>
<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>
<?php require_once( ROOT_PATH . '/includes/registration_login.php') ?>
<?php $posts = getPublishedPosts(); ?>
<?php require_once('includes/head_section.php') ?>
<?php if(isset($_GET['token']) && isset($_GET['action']) && $_GET['action'] === "reg") {

	$sql = "SELECT * FROM users WHERE token='".$_GET['token']."' LIMIT 1";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		$token = openssl_random_pseudo_bytes(16);
		$token = bin2hex($token);
		mysqli_query($conn, "UPDATE users set status = 1, token = '$token' where token = '".$_GET['token']."'");
		{ array_push($errors, "User registered");}
	}
	else { array_push($errors, "Token inactiv"); }
	}
?>
	<title>BlogPost | Home </title>
</head>
<body>
	<!-- container -->
	<div class="container">
		<!-- navbar -->
		<?php include('includes/navbar.php') ?>
		<!-- // navbar -->

    <!-- banner -->
    <?php include('includes/banner.php') ?>

		<!-- Page content -->
		<div class="content">
			<h2 class="content-title">Articles</h2>
      <hr>

    <?php foreach ($posts as $post): ?>
	     <div class="post" style="margin-left: 0px;">
		<img src="<?php echo BASE_URL . '/static/images/' . $post['image']; ?>" class="post_image" alt="">
		<?php if (isset($post['topic']['name'])): ?>
			<a
				href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $post['topic']['id'] ?>"
				class="btn category">
				<?php echo $post['topic']['name'] ?>
			</a>
		<?php endif ?>

		<a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
			<div class="post_info">
				<h3><?php echo $post['title'] ?></h3>
				<div class="info">
					<span><?php echo date("F j, Y ", strtotime($post["created_at"])); ?></span>
					<span class="read_more">Read more...</span>
				</div>
			</div>
		</a>
	</div>
<?php endforeach ?>
		</div>
		<!-- // Page content -->

		<!-- footer -->
		<?php include('includes/footer.php') ?>
		<!-- // footer -->

	</div>
	<!-- // container -->
</body>

<script type="text/javascript" src="static/js/scaleUpPost.js">

</script>
<script type="text/javascript">
	if ( window.history.replaceState ) {

	  window.history.replaceState( null, null, window.location.href );
	}
</script>

</html>
