<?php include "top.php" ?>
<title>STORS: Apply For Transport</title>
</head>
<body>
    <!-- header of the page incl. the nav -->
        <header>
            <?php include "nav.php" ?>
        </header>

        <!-- hero image -->
        <div class="hero" id="apply_hero">
            <h1 class="hero_text display-4">Apply For Transport</h1>
        </div>

        <!-- main content -->
        <div class="container">

            <main class="mb-3">
               <h2>List of Learners</h2>

                <hr>
                <div class="mb-3">
                            <!-- Table of learners here -->
                            <table class="table table-primary table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Learner Name</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="learner_list">
                                        <?php for ($i = 0; $i < count($learners); $i++): ?>
                                            <?php if (!checkLearnerPassengerStatus($learners[$i]["id"])) : ?>
                                                <tr>
                                                    <td name="fullName"><?php echo $learners[$i]["name"] . " " . $learners[$i]["surname"] ?></td>
                                                    <td>
                                                        <?php if (checkLearnerApplyStatus($learners[$i]["id"])): ?>
                                                            <button class="btn btn-danger" value="<?php echo $learners[$i]['id'] ?>" name="cancelBtn">Cancel Application</button>
                                                        <?php else: ?>
                                                            <button class="btn btn-primary" value="<?php echo $learners[$i]['id'] ?>" name="applyFormBtn">Apply For Transport</button>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </tbody>
                            </table>
                    </div>
                    <hr>

                    <!-- Application for learners -->
                    <div class="mb-3" id="apply_learner_div">
                        <h3 name="apply_heading">Apply For Learner</h3>

                        <p>NB: Please select points that are on the same route. E.g. Select 1A and 1B of Rooihuiskraal.</p>

                        <form method="POST" id="apply_learner" class="form_move text-bg-primary">
                            <input hidden name="action" id="action" value="apply_learner"/>
                            <input hidden name="l_id" value=""/>

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
            </main> 
            
        </div>

        <!-- footer with credit -->
        <?php include "footer.php" ?>
</body>
</html>