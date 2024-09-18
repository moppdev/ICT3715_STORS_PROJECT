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
                                            <th>Grade</th>
                                            <th>Cellphone Number</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i = 0; $i < count($learners); $i++): ?>
                                            <tr>
                                                <td><?php echo $learners[$i]["name"] . " " . $learners[$i]["surname"] ?></td>
                                                <td><?php echo $learners[$i]["grade"]?></td>
                                                <td><?php echo $learners[$i]["cell_num"]?></td>
                                                <td>
                                                    <!-- TODO -->
                                                </td>
                                            </tr>
                                        <?php endfor; ?>
                                    </tbody>
                            </table>
                    </div>
                    <hr>
                    <div class="mb-3" id="apply_learner_div">
                        <h3>Apply For Learner</h3>

                        <form method="POST" id="apply_learner" class="form_move text-bg-primary">
                            <input hidden name="action" id="action" value="apply_learner"/>
                            <input hidden name="l_id" value=""/>

                            <div class="mb-3">
                                <label for="pickup">Pickup Point:</label>
                                <select required name="pickup" class="form-select">
                                    <option value="" disabled selected>Select a pickup point</option>
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
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