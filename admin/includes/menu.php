<div class="menu">
	<div class="card">
		<div class="card-header">
			<h2>Actions</h2>
		</div>
		<div class="card-content">
			<a href="<?php echo BASE_URL . 'admin/create_post.php' ?>">Create/Edit Posts</a>
			<a href="<?php echo BASE_URL . 'admin/posts.php' ?>">Manage Posts</a>
			<?php
		  if (isset($_SESSION['user']['role'])) {
		    if (in_array($_SESSION['user']['role'], ["Admin"]))
		    echo '<a href= '.BASE_URL .'admin/users.php>Manage Users</a>';
		  }
		   ?>
			<a href="<?php echo BASE_URL . 'admin/topics.php' ?>">Manage Topics</a>
		</div>
	</div>
</div>
