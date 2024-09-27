<!-- Navigation area of the website -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="home.php">STORS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="home.php">Home</a>
            </li>

            <?php if (isset($_SESSION["role"])): ?>
              <?php if ($_SESSION["role"] == "parents"): ?>
                <li class="nav-item">
                  <a class="nav-link" href="learner_hub.php">Learner Hub</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="applytransport.php">Apply For Transport</a>
                </li>
              <?php elseif ($_SESSION["role"] == "admins"): ?>
                <li class="nav-item">
                  <a class="nav-link" href="admin_parents.php">Manage Parents</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="admin_learners.php">Manage Learners</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="admin_lists.php">Manage Waiting List</a>
                </li>
              <?php endif; ?>
                  <li class="nav-item">
                      <a class="nav-link" href="../index.php?action=sign_out">Sign Out</a>
                  </li>
              <?php else: ?>
                <li class="nav-item">
                      <a class="nav-link" href="parent_login.php">Sign In</a>
                  </li>
            <?php endif; ?>
        </ul>
    </div>
  </div>
</nav>