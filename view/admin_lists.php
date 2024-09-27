<?php include "top.php" ?>
<title>STORS: Manage Waiting List and Bus Spaces</title>
</head>
<body>
    <!-- header of the page incl. the nav -->
        <header>
            <?php include "nav.php" ?>
        </header>

        <!-- hero image -->
        <div class="hero" id="home_hero">
            <h1 class="hero_text display-5">Manage Waiting List and Bus Spaces</h1>
        </div>

        <!-- main content -->
        <div class="container">

            <main class="mb-3">
                <hr>
                <div>
                    <p>Get started by clicking one of the three buttons below!</p>

                    <!-- Buttons to toggle fragment used/shown -->
                    <button class="btn btn-primary" id="applyLearnBtn">Apply For A Learner</button>
                    <button class="btn btn-secondary" id="waitingBtn">Waiting List</button>
                    <button class="btn btn-secondary" id="passBtn">Passenger Lists</button>
                </div>
                <hr>

                <h2 id="title">Apply For A Learner</h2>  

                <!-- fragments of the page -->
                 <div class="mb-3" id="subtitle">
                    Apply for a learner below. NB: Please select points that are on the same route. E.g. Select 1A and 1B of Rooihuiskraal.
                 </div>

                 <div class="learner_section" id="applyLearner">
                        <form method="POST" id="apply_learner" class="form_move text-bg-primary">
                            <input hidden name="action" id="action" value="apply_learner"/>

                            <div class="mb-3">
                                <label for="pickup">Pickup Point:</label>
                                <select required name="pickup" class="form-select">
                                    <option value="" disabled selected>Select a pickup point</option>
                                    <?php foreach($points as $point) :?>
                                        <option value="<?php echo $point["point_num"] ?>"><?php echo $point["route_name"] . " - " . $point["point_name"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="dropoff">Dropoff Point:</label>
                                <select required name="dropoff" class="form-select">
                                    <option value="" disabled selected>Select a dropoff point</option>
                                    <?php foreach($points as $point) :?>
                                        <option value="<?php echo $point["point_num"] ?>"><?php echo $point["route_name"] . " - " . $point["point_name"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-warning" name="applyBtn">Apply</button>
                        </form>
                 </div>

                 <div class="learner_section" id="waitingList">

                    <div class="mb-3">
                                <!-- Waiting List table here -->
                                <table class="table table-primary table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Learner Name</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="learner_list">
                                            <?php for ($i = 0; $i < count($learners); $i++): ?>
                                                <?php if (checkLearnerPassengerStatus($learners[$i]["id"]) === false) : ?>
                                                    <?php if (checkLearnerApplyStatus($learners[$i]["id"]) === true): ?>
                                                    <tr>
                                                        <td name="fullName"><?php echo $learners[$i]["name"] . " " . $learners[$i]["surname"] ?></td>
                                                        <td>
                                                            <button class="btn btn-danger" value="<?php echo $learners[$i]['id'] ?>" name="cancelWaitBtn">Cancel Application</button>
                                                            <button class="btn btn-warning" value="<?php echo $learners[$i]['id'] ?>" name="moveBtn">Move To Passenger List</button>
                                                        </td>
                                                    </tr>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        </tbody>
                                </table>
                 </div>

                 <div class="learner_section" id="passengerList">
                    <div class="mb-3">
                                    <!-- Waiting List table here -->
                                    <table class="table table-primary table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Learner Name</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="learner_list">
                                                <?php for ($i = 0; $i < count($learners); $i++): ?>
                                                    <?php if (checkLearnerPassengerStatus($learners[$i]["id"]) === false) : ?>
                                                        <?php if (checkLearnerApplyStatus($learners[$i]["id"]) === true): ?>
                                                        <tr>
                                                            <td name="fullName"><?php echo $learners[$i]["name"] . " " . $learners[$i]["surname"] ?></td>
                                                            <td>
                                                                <button class="btn btn-danger" value="<?php echo $learners[$i]['id'] ?>" name="cancelWaitBtn">Cancel Application</button>
                                                                <button class="btn btn-warning" value="<?php echo $learners[$i]['id'] ?>" name="moveBtn">Move To Passenger List</button>
                                                            </td>
                                                        </tr>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            </tbody>
                                    </table>
                    </div>
            </main> 
            
        </div>

        <!-- footer with credit -->
        <?php include "footer.php" ?>
</body>
</html>