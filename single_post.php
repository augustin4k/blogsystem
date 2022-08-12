<?php  include('config.php'); ?>
<?php  include('includes/public_functions.php'); ?>
<?php include('includes/comments.inc.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/post_functions.php'); ?>
<?php require_once( ROOT_PATH . '/includes/registration_login.php') ?>
<?php require_once('includes/head_section.php') ?>
<?php
	if (isset($_GET['post-slug'])) {
		$post = getPost($_GET['post-slug']);
		$click = 1;
		$query = mysqli_query($conn, "UPDATE posts SET views = views + $click WHERE slug = '".$_GET['post-slug']."'");
	}
	$topics = getAllTopics();
?>
<?php include('includes/head_section.php'); ?>
<title> <?php echo $post['title'] ?> | LifeBlog</title>
</head>
<body>
<div class="container">
	<!-- Navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	<!-- // Navbar -->

	<div class="content" >
		<!-- Page wrapper -->
		<div class="post-wrapper">
			<!-- full post div -->
			<div class="full-post-div">
			<?php
				if (!isset($post['published']))
					echo "<h2 class='post-title'>Sorry... This post has not been published</h2>";
				else {?>
					<h2 class="post-title"><?php if (isset($post['title'])) {
						echo $post['title'];
					}
					?></h2>
					<div class="post-body-div">
					<?php if (isset($post['body']))
					 echo html_entity_decode($post['body']); ?>
				</div>
			<?php  }
			?>
			</div>
			<!-- // full post div -->
<?php date_default_timezone_set('Europe/Chisinau'); ?>

<?php
if (isset($_SESSION['user']['role'])){
		echo "<form class='' action='".setComments($conn)."' method='post'>
			<input type='hidden' name='uid' value='".$_SESSION['user']['id']."'>
			<input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
			<textarea name='message' rows='8' cols='80'></textarea> <br>
			<button type = 'submit' name = 'commentSubmit'>Comment</button>
			<input type='hidden' name='pid' value='".$post['id']."'>
		</form>";
		getComments($post['id']);
	} else {
		echo "<a href='register.php' class='btn'>Become a member to leave a comment!</a>";
	}
?>


		</div>
		<!-- // Page wrapper -->

		<!-- post sidebar -->
		<div class="post-sidebar">
			<div class="card">
				<div class="card-header">
					<h2>Topics</h2>
				</div>
				<div class="card-content">
					<?php foreach ($topics as $topic): ?>
						<a
							href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $topic['id'] ?>">
							<?php echo $topic['name']; ?>
						</a>
					<?php endforeach ?>
				</div>
			</div>
		</div>
		<!-- // post sidebar -->
	</div>
</div>
<!-- // content -->

<?php include( ROOT_PATH . '/includes/footer.php'); ?>
