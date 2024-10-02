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

                        <?php if ($learners): ?>
                            <div class="mb-3 form_move">
                                <h3>Table of Learners</h3>
                                <!-- Table of learners here -->
                                <table class="table table-primary table-striped table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Learner Name</th>
                                            <th>Grade</th>
                                            <th>Cellphone Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i = 0; $i < count($learners); $i++): ?>
                                            <tr>
                                                <td><?php echo $learners[$i]["name"] . " " . $learners[$i]["surname"] ?></td>
                                                <td><?php echo $learners[$i]["grade"]?></td>
                                                <td><?php echo $learners[$i]["cell_num"]?></td>
                                            </tr>
                                        <?php endfor; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p>Add some learners to the system!</p>
                        <?php endif; ?>
                    <?php else: ?>
                        <h2>Welcome, Administrator <?php echo $_SESSION["user_info"]["initials"] . " " . $_SESSION["user_info"]["surname"] ?></h2>

                        <h3>MIS Reports</h3>

                        <!-- Admin MIS Reports here -->
                        <div id="route_amt_MIS" class="mis">
                            <h4>Passenger Count Per Route</h4>
                            <canvas id="route_chart"></canvas>
                         </div>
                         
                         <div id="parent_details_MIS" class="mis">
                                <h4>Parent Contact Details</h4>
                                <table class="table table-primary table-striped table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Learner Name</th>
                                            <th>Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody id="parent_target">
                                        
                                    </tbody>
                                </table>
                         </div>

                         <div id="waiting_list_MIS" class="mis table_responsive">
                            <h4>Current Waiting List</h4>
                                <table class="table table-primary table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Learner Name</th>
                                            <th>Grade</th>
                                            <th>Pickup ID</th>
                                            <th>Dropoff ID</th>
                                            <th>Cellphone Number</th>
                                            <th>Date Added</th>
                                        </tr>
                                    </thead>
                                    <tbody id="wait_target">
                                        
                                    </tbody>
                                </table>
                         </div>

                         <div class="mis" id="current_overview_MIS">
                                <h4>Current Trip Overview</h4>
                                <table class="table table-primary table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Learner Name</th>
                                            <th>Route Name</th>
                                            <th>Point Name</th>
                                            <th>Point ID</th>
                                            <th>Departure Time</th>
                                        </tr>
                                    </thead>
                                    <tbody id="overview_target">
                                        
                                    </tbody>
                                </table>
                         </div>
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