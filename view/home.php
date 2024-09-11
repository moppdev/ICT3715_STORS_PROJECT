<!-- The home page where parents can register/login and administrators can login -->
<?php include "top.php" ?>
<title>STORS: Home</title>
</head>
<body>
    <!-- header of the page incl. the nav -->
        <header>
            <?php include "nav.php" ?>
        </header>

        <!-- hero image -->
        <div class="hero" id="home_hero">
            <h1 class="hero_text display-4">Welcome to STORS!</h1>
        </div>

        <!-- main content -->
        <div class="container">
            <main class="mb-3">
                <?php if (isset($_SESSION["role"])): ?>
                    <?php if ($_SESSION["role"] == "parents"): ?>
                        <h2>Welcome, <?php echo $_SESSION["user_info"]["name"] . " " .  $_SESSION["user_info"]["surname"] ?></h2>

                        <!-- Table of learners here -->
                        <table>
                            <?php for ($i = 0; $i < count($learners); $i++): ?>
                                <p><?php echo $learners[$i]["name"]?></p>
                            <?php endfor; ?>
                        </table>
                    <?php else: ?>
                        <h2>Welcome, Administrator <?php echo $_SESSION["user_info"]["initials"] . " " . $_SESSION["user_info"]["surname"] ?></h2>

                        <!-- Admin MIS Reports here -->
                    <?php endif; ?>
                <?php else: ?>    
                    <h2>Welcome to the Strive Transport Registration System (STORS)!</h2>

                    <p>
                    Register your children for school transport effortlessly! 
                    Our system allows you to apply for a spot on our safe and reliable buses, 
                    ensuring your kids have a secure and convenient way to get to and from school.
                    </p>

                        <h2>How It Works</h2>
                        <ol>
                            <li><strong>Register Your Child</strong>: Login through our user-friendly portal and go to Learner Hub.</li>
                            <li><strong>Apply For Transport</strong>: Submit an application for transport. If a spot becomes available, your child will be automatically allocated a seat from the waiting list.</li>
                            <li><strong>Enjoy Safe Transport:</strong> Your child travels in a well-maintained, secure bus to and from school.</li>
                        </ol>
                <?php endif; ?>
            </main>
        </div>

        <!-- footer with credit -->
        <?php include "footer.php" ?>
</body>
</html>