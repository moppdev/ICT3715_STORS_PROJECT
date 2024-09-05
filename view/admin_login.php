<?php include "top.php" ?>
<title>STORS: Admin Login</title>
</head>
<body>
    <!-- header of the page incl. the nav -->
        <header>
            <?php include "nav.php" ?>
        </header>

        <!-- main content -->
    <div class="container">
        <h1 class="display-6">Admin Login</h1>

        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error ?></p>
        <?php endif; ?>

        <!-- Login form for the admin -->
        <div class="mb-3">
            <fieldset>
                <legend>Sign in</legend>
                <form method="POST" class="form_move text-bg-primary">
                    <input hidden name="action" value="admin_login"/>

                    <div class="mb-3">
                        <label for="init_sur" class="form-label">Enter your initials and surname:</label>
                        <input type="text" name="name" class="form-control" placeholder="E Xample" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Enter your email address:</label>
                        <input type="email" name="email" class="form-control" placeholder="example@email.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Enter your password here:</label>
                        <input type="password" name="password" class="form-control" required />
                        <span id="togglePassword" class="eye">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                </svg>
                            </div>
                        </span>
                    </div>

                    <button type="submit" class="btn btn-secondary">Log In As Admin</button>
                </form>
            </fieldset>
        </div>
    </div>

    <!-- footer with credit -->
    <?php include "footer.php" ?>
</body>
</html>