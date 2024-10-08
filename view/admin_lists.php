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
                <div class="button_holder">
                    <p>Get started by clicking one of the three buttons below!</p>

                    <!-- Buttons to toggle fragment used/shown -->
                    <button class="btn btn-primary" id="applyLearnBtn">Apply For A Learner</button>
                    <button class="btn btn-secondary" id="waitingBtn">Waiting List</button>
                    <button class="btn btn-secondary" id="passBtn">Passenger List</button>
                </div>
                <hr>

                <h2 id="title">Apply For A Learner</h2>  

                <!-- fragments of the page -->
                 <div class="mb-3" id="subtitle">
                    Apply for a learner below. NB: Please select points that are on the same route. E.g. Select 1A and 1B of Rooihuiskraal.
                 </div>

                 <!-- Apply for a Learner section -->
                 <div class="learner_section" id="applyLearner">
                    <!-- Apply for a learner as admin here -->
                        <form method="POST" id="apply_learner" class="form_move text-bg-primary">
                            <input hidden name="action" id="action" value="apply_learner_admin"/>
                            <input hidden id="l_id" name="l_id" value=""/>
                            
                            <div class="mb-3">
                                <label for="pickup">Learner to apply for:</label>
                                <input type="text" name="searcher" placeholder=" Search for a learner here" class="form-control"/>

                                <!-- Dropdown to hold learners -->
                                <div id="learnerDropdown" class="dropdown-menu show mt-1" style="max-height: 200px; overflow-y: auto;">
                                    <!-- The options will be dynamically filtered and shown here -->
                                    <?php for ($i = 0; $i < count($learners); $i++): ?>
                                        <?php if (checkLearnerPassengerStatus($learners[$i]["id"]) === false) : ?>
                                            <?php if (checkLearnerApplyStatus($learners[$i]["id"]) === false): ?>
                                                <button class="dropdown-item" type="button" data-value="<?php echo $learners[$i]["id"] ?>">
                                                    <?php echo $learners[$i]["name"] . " " . $learners[$i]["surname"] ?>
                                                </button>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                            </div>

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

                 <!-- Waiting List section -->
                 <div class="learner_section" id="waitingList">
                 <?php if (!empty($error)) :?>
                        <p><?php echo $error ?></p>
                <?php endif; ?>

                        <div class="mb-3 table-responsive">
                                    <!-- Waiting List table here -->
                                    <table class="table table-primary table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Learner Name</th>
                                                    <th colspan="2">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="wait_list">
                                                <?php for ($i = 0; $i < count($learners); $i++): ?>
                                                    <?php if (checkLearnerPassengerStatus($learners[$i]["id"]) === false) : ?>
                                                        <?php if (checkLearnerApplyStatus($learners[$i]["id"]) === true): ?>
                                                        <tr>
                                                            <td name="fullName"><?php echo $learners[$i]["name"] . " " . $learners[$i]["surname"] ?></td>
                                                            <td>
                                                                    <form method="POST">
                                                                        <input hidden name="action" value="cancel_app_admin"/>
                                                                        <input hidden name="l_id" value="<?php echo $learners[$i]['id'] ?>"/>
                                                                        <button class="btn btn-danger" name="cancelAppBtn">Cancel Application</button>
                                                                    </form>
                                                            </td>
                                                            <td>
                                                                    <form method="POST">
                                                                        <input hidden name="action" value="move_to_trips"/>
                                                                        <input hidden name="l_id" value="<?php echo $learners[$i]['id'] ?>"/>
                                                                        <button class="btn btn-warning" name="moveBtn">Move To Passenger List</button>
                                                                    </form>
                                                            </td>
                                                        </tr>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            </tbody>
                                    </table>
                    </div>
                 </div>

                 <!-- Passenger List (learner_trips table) -->
                 <div class="learner_section" id="passengerList">
                    <div class="mb-3 table-responsive">
                                    <!-- Passenger List table here -->
                                    <table class="table table-primary table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Learner Name</th>
                                                    <th>Pickup Point</th>
                                                    <th>Pickup Time</th>
                                                    <th>Dropoff Point</th>
                                                    <th>Dropoff Time</th>
                                                    <th colspan="2">Options</th>
                                                </tr>
                                            </thead>
                                            <tbody id="pass_list">
                                                <?php for ($i = 0; $i < count($learners); $i++): ?>
                                                    <?php if (checkLearnerPassengerStatus($learners[$i]['id'])) : ?>
                                                        <?php $info = getPassengerInfo($learners[$i]['id']); ?>
                                                        <tr>
                                                            <td name="fullName"><?php echo $learners[$i]["name"] . " " . $learners[$i]["surname"] ?></td>
                                                            <td name="p1_point_name"><?php echo $info["p1_name"] ?></td>
                                                            <td name="p1_pickup_time"><?php echo $info["p1_time"] ?></td>
                                                            <td name="p2_point_name"><?php echo $info["p2_name"] ?></td>
                                                            <td name="p2_dropoff_time"><?php echo $info["p2_time"] ?></td>
                                                            <td>
                                                                <form method="POST">
                                                                    <input hidden name="action" value="remove_trip"/>
                                                                    <input hidden name="t_id" value="<?php echo $info['id'] ?>"/>
                                                                    <button class="btn btn-danger" type="submit" name="emailBtn">Remove From List</button>
                                                                </form>
                                                            </td>
                                                            <td>
                                                                <form method="POST">
                                                                    <input hidden name="action" value="send_trip_info"/>
                                                                    <input hidden name="l_id" value="<?php echo $learners[$i]['id'] ?>"/>
                                                                    <button class="btn btn-success" type="submit" name="emailBtn">Email Trip To Parent</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            </tbody>
                                    </table>
                    </div>
                </div>
            </main> 
            
        </div>

        <!-- footer with credit -->
        <?php include "footer.php" ?>
</body>
</html>