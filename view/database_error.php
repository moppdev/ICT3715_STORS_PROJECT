<?php include "top.php" ?>
<title>STORS: DB Error</title>
</head>
<body>
    <!-- header of the page incl. the nav -->
        <header>
            <?php include "nav.php" ?>
        </header>

        <!-- hero image -->
        <div class="hero" id="db_error_hero">
            <h1 class="hero_text display-4">Database Error</h1>
        </div>

        <!-- main content -->
        <div class="container">

            <main class="mb-3">
                <h2>An error has occured connecting to the database</h2>

                <p>Error message: <?php echo $error_message ?></p>
            </main> 
            
        </div>

        <!-- footer with credit -->
        <?php include "footer.php" ?>
</body>
</html>