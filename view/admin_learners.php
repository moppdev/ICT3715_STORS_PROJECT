<?php include "top.php" ?>
<title>STORS: Manage Learners</title>
</head>
<body>
    <!-- header of the page incl. the nav -->
        <header>
            <?php include "nav.php" ?>
        </header>

        <!-- hero image -->
        <div class="hero" id="learner_hero">
            <h1 class="hero_text display-4">Manage Learners</h1>
        </div>

        <!-- main content -->
        <div class="container">

        <main class="mb-3">

                <hr>
                <div>
                    <p>Get started by clicking one of the three buttons below!</p>

                    <!-- Buttons to toggle fragment used/shown -->
                    <button class="btn btn-primary" id="registerBtn">Register New Learner</button>
                    <button class="btn btn-secondary" id="editBtn">Edit a Learner's Details</button>
                    <button class="btn btn-secondary" id="removeBtn">Remove a Learner</button>
                </div>
                <hr>

                <h2 id="title">Register a Learner</h2>  

                <!-- fragments of the page -->
                 <div class="mb-3" id="subtitle">
                    Fill in the form below to register your child on the system!
                 </div>

                <!-- fragment where a new learner can be registered by a parent -->
                <div class="learner_section" id="register">
                    <form method="POST" id="register_learner_admin" class="form_move text-bg-primary">
                        <input hidden name="action" id="action" value="register_learner_admin"/>

                        <div class="mb-3">
                            <label for="name">Name:</label>
                            <input name="name" placeholder="Johnny" required type="text" class="form-control"/>
                        </div>

                        <div class="mb-3">
                            <label for="surname">Surname:</label>
                            <input name="surname" placeholder="Johnson" required type="text" class="form-control"/>
                        </div>

                        <div class="mb-3">
                            <label for="cell_num">Cellphone:</label>
                            <input name="cell_num" placeholder="0729082345" required type="text" class="form-control"/>
                        </div>

                        <div class="mb-3">
                            <label for="grade">Grade:</label>
                            <select required name="grade" class="form-select">
                                <option value="" disabled selected>Select a grade</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="parent">Parent:</label>

                            <!-- searcher for parents -->
                            <input type="text" name="searcher" placeholder=" Search for a learner here" class="form-control"/>
                                <!-- Dropdown to hold parents -->
                                <div id="parentDropdown" class="dropdown-menu show mt-1" style="max-height: 200px; overflow-y: auto;">
                                    <!-- The options will be dynamically filtered and shown here -->
                                    <?php for ($i = 0; $i < count($parents); $i++): ?>
                                                <button class="dropdown-item" type="button" data-value="<?php echo $parents[$i]["id"] ?>">
                                                    <?php echo $parents[$i]["name"] . " " . $parents[$i]["surname"] ?>
                                                </button>
                                    <?php endfor; ?>
                                </div>
                                <input hidden name="parent" id="parent" value=""/>
                        </div>

                        <button type="submit" class="btn btn-warning" name="registerBtn">Register New Learner</button>
                    </form>
                </div>

                <!-- fragment where a learner's details can be edited -->
                <div class="learner_section" id="edit">
                    <div class="mb-3">
                        <label>Select a learner's details you would like to change:</label>
                        <select name="selected_learner">
                            <option value="" disabled selected>Select a learner</option>
                            <?php for ($i = 0; $i < count($learners); $i++): ?>
                                <option value="<?php echo $learners[$i]["id"] ?>"><?php echo $learners[$i]["name"] . " " . $learners[$i]["surname"] ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <form method="POST" id="edit_learner" class="form_move text-bg-primary">
                        <input hidden name="action" value="edit_learner"/>
                        <input hidden name="l_id" id="l_id" value="" />

                        <div class="mb-3">
                            <label for="name">Name:</label>
                            <input name="e_name" required type="text" class="form-control"/>
                        </div>

                        <div class="mb-3">
                            <label for="surname">Surname:</label>
                            <input name="e_surname" required type="text" class="form-control"/>
                        </div>

                        <div class="mb-3">
                            <label for="cell_num">Cellphone:</label>
                            <input name="e_cell_num" required type="text" class="form-control"/>
                        </div>

                        <div class="mb-3">
                            <label for="grade">Grade:</label>
                            <select required name="e_grade" class="form-select">
                                <option value="" disabled selected>Select a grade</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-warning" name="editBtn">Edit Learner's Details</button>
                    </form>
                </div>

                <!-- fragment where a parent can remove a learner related to them from the system -->
                <div class="learner_section" id="remove">
                    <form method="POST" id="remove_learner" class="form_move text-bg-primary">
                        <input hidden name="action" value="remove_learner"/>

                        <div class="mb-3">
                            <label>Select a learner you would like to remove:</label>
                            <select name="selected_learner">
                                <option disabled selected value="">Select a learner</option>
                                <?php for ($i = 0; $i < count($learners); $i++): ?>
                                    <option value="<?php echo $learners[$i]["id"] ?>"><?php echo $learners[$i]["name"] . " " . $learners[$i]["surname"] ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-danger" name="removeBtn">Remove Learner</button>
                    </form>
                </div>
            </main> 
            
        </div>

        <!-- footer with credit -->
        <?php include "footer.php" ?>
</body>
</html>