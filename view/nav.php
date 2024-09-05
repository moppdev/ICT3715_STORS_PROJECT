<!-- Navigation area of the website -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="home.php">STORS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
                <a class="nav-link" href="home.php">Home</a>
            </li>

            <?php if (isset($_SESSION["role"])): ?>
              <?php if ($_SESSION["role"] == "parents" || $_SESSION["role"] == "admins"): ?>
                        <li class="nav-item">
                          <a class="nav-link" href="../index.php?action=sign_out">Sign Out</a>
                        </li>
                <?php endif; ?>
              <?php else: ?>
                <li class="nav-item">
                      <a class="nav-link" href="parent_login.php">Sign In</a>
                  </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>