<?php  include('../config.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/post_functions.php'); ?>
	<title>Admin | Dashboard</title>
</head>
<body>
	<div class="header">
		<div class="logo">
			<a href="<?php echo BASE_URL .'admin/dashboard.php' ?>">
				<h1>LifeBlog - Admin</h1>
			</a>
		</div>
		<?php if (isset($_SESSION['user'])): ?>
			<div class="user-info">
				<span><a class="active"
						href="<?php echo BASE_URL . 'index.php' ?>">Home</a></span> &nbsp;
				<span><?php echo $_SESSION['user']['username'] ?></span> &nbsp; &nbsp;
				<a href="<?php echo BASE_URL . '/logout.php'; ?>" class="logout-btn">logout</a>
			</div>
		<?php endif ?>
	</div>
	<div class="container dashboard">
		<h1>Welcome</h1>
		<div class="stats">
			<?php
		  if (isset($_SESSION['user']['role'])) {
		    if (in_array($_SESSION['user']['role'], ["Admin"]))
		    echo '<a href="users.php" class="first">
					<span> '.getUsers()[0][0].'</span> <br>
					<span>Registered users</span>
				</a>';
		  }
		   ?>
			<a href="posts.php">
				<span><?php echo (getPostsCount()[0][0]); ?></span> <br>
				<span>Published posts</span>
			</a>
			<a>
				<span><?php echo (getViewsCount()[0][0]); ?></span> <br>
				<span>Views</span>
			</a>
		</div>
		<br><br><br>
		<div class="buttons">
			<?php
			  if (isset($_SESSION['user']['role'])) {
			    if (in_array($_SESSION['user']['role'], ["Admin"]))
			    echo '<a href="users.php">Add Users</a>';
			  }
		   ?>
			<a href="create_post.php">Add Posts</a>
		</div>
	</div>
</body>
</html>
