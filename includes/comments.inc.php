<?php
function setComments($conn){
  if (isset($_POST['commentSubmit'])) {
    $uid = $_POST['uid'];
    $date = $_POST['date'];
    $message = $_POST['message'];
    $pid = $_POST['pid'];
    $sql = "INSERT INTO comments (uid, date, message, pid) VALUES ('$uid', '$date', '$message', '$pid')";
    $result = $conn->query($sql);
  }
}

function editComments($conn){
  if (isset($_POST['commentSubmit'])) {
    $cid = $_POST['cid'];
    $uid = $_POST['uid'];
    $date = $_POST['date'];
    $message = $_POST['message'];

    $sql = "UPDATE comments SET message='$message' WHERE cid='$cid'";
    $result = $conn->query($sql);
    header("Location: index.php");
  }
}

function getComments($post_id){
  global $conn;
  $sql = "SELECT * FROM comments WHERE pid = '$post_id'";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
    $id = $row['uid'];
    $sql1 = "SELECT * FROM users WHERE id = '$id'";
    $result1 = $conn->query($sql1);
    if ($row1 = $result1->fetch_assoc()) {
        echo "<div class = 'comment-box'><p>";
          echo $row1['username']."<br>";
          echo $row['date']."<br>";
          echo nl2br($row['message']);
        echo "</p>";
        if (isset($_SESSION['user'])) {
          if ($_SESSION['user']['role'] == "Admin" || $_SESSION['user']['id'] == $row['uid']) {
            echo "<form class='delete-form' method='post' action='".deleteComments($conn)."'>
              <input type='hidden' name='cid' value='".$row['cid']."'>
              <button type='submit' name='commentDelete'>Delete</button>
            </form>
            <form class='edit-form' method='post' action='editcomment.php'>
              <input type='hidden' name='cid' value='".$row['cid']."'>
              <input type='hidden' name='uid' value='".$row['uid']."'>
              <input type='hidden' name='date' value='".$row['date']."'>
              <input type='hidden' name='message' value='".$row['message']."'>
              <button>Edit</button>
            </form>";
          }
        }
        echo "</div>";
    }
  }
}

// function getPublishedPostsByTopic($topic_id) {
// 	global $conn;
// 	$sql = "SELECT * FROM posts ps
// 			WHERE ps.id IN
// 			(SELECT pt.post_id FROM post_topic pt
// 				WHERE pt.topic_id=$topic_id GROUP BY pt.post_id
// 				HAVING COUNT(1) = 1)";
// 	$result = mysqli_query($conn, $sql);
// 	// fetch all posts as an associative array called $posts
// 	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
//
// 	$final_posts = array();
// 	foreach ($posts as $post) {
// 		$post['topic'] = getPostTopic($post['id']);
// 		array_push($final_posts, $post);
// 	}
// 	return $final_posts;
// }


function deleteComments($conn){
  if (isset($_POST['commentDelete'])) {
    $cid = $_POST['cid'];

    $sql = "DELETE FROM comments WHERE cid='$cid'";
    $result = $conn->query($sql);
    header("Location: index.php");
  }
}
