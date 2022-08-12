<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <div class="logo_div">
        <a href="index.php">
          <h1>BlogPost System</h1>
        </a>
      </div>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <?php
        if (isset($_SESSION['user']['role'])) {
          if (in_array($_SESSION['user']['role'], ["Admin"]))
            echo '<li class="nav-item"><a class="nav-link" href="admin/dashboard.php">Admin</a></li>';
          else {
            echo '<li class="nav-item"><a class="nav-link" href="admin/dashboard.php">MyAccount</a></li>';
          }
        }
        ?>
        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
      </ul>
      <!-- <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->
    </div>
  </div>
</nav>
