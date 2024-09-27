<?php include "top.php" ?>
<title>STORS: Manage Parents</title>
</head>
<body>
    <!-- header of the page incl. the nav -->
        <header>
            <?php include "nav.php" ?>
        </header>

        <!-- hero image -->
        <div class="hero" id="parent_hero">
            <h1 class="hero_text display-4">Manage Parents</h1>
        </div>

        <!-- main content -->
        <div class="container">

        <main class="mb-3">

            <hr>
            <div>
                <p>Get started by clicking one of the three buttons below!</p>
                <p>P.S Be mindul of good password practices when creating passwords.</p>

                <!-- Buttons to toggle fragment used/shown -->
                <button class="btn btn-primary" id="registerParentBtn">Register New Parent</button>
                <button class="btn btn-secondary" id="editParentBtn">Edit a Parent's Details</button>
                <button class="btn btn-secondary" id="removeParentBtn">Remove a Parent</button>
            </div>
            <hr>

            <h2 id="title">Register New Parent</h2>  

            <!-- fragments of the page -->
            <div class="mb-3" id="subtitle">
                Register a parent here
            </div>

            <!-- fragment where a new parent can be registered by a admin -->
            <div class="parent_section" id="register">
                <form method="POST" id="register_parent" class="form_move text-bg-primary">
                    <input hidden name="action" id="action" value="register_parent"/>

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
                        <label for="email">Email:</label>
                        <input name="email"  placeholder="email@example.com" required type="email" class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>    
                        <input name="password" type="password" class="form-control" required/>
                        <span name="togglePassword" class="eye">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                </svg>
                            </div>
                        </span>
                    </div>

                    <button type="submit" class="btn btn-warning" name="registerBtn">Register New Parent</button>
                </form>
            </div>

            <!-- fragment where a parent's details can be edited -->
            <div class="learner_section" id="edit">
                <div class="mb-3">
                    <label>Select a parent's details you would like to change:</label>
                    <select name="selected_parent">
                        <option value="" disabled selected>Select a parent</option>
                        <?php for ($i = 0; $i < count($parents); $i++): ?>
                            <option value="<?php echo $parents[$i]["id"] ?>"><?php echo $parents[$i]["name"] . " " . $parents[$i]["surname"] ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <form method="POST" id="edit_parent" class="form_move text-bg-primary">
                    <input hidden name="action" value="edit_parent"/>
                    <input hidden name="p_id" id="p_id" value="" />

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
                        <label for="email">Email:</label>
                        <input name="e_email"  placeholder="email@example.com" required type="email" class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>    
                        <input name="e_password" type="password" class="form-control" required/>
                        <span name="togglePassword" class="eye">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                </svg>
                            </div>
                        </span>
                    </div>

                    <button type="submit" class="btn btn-warning" name="editBtn">Edit Parent's Details</button>
                </form>
            </div>

            <!-- fragment where an admin can remove a parent and all related information from the system -->
            <div class="parent_section" id="remove">
                <form method="POST" id="remove_parent" class="form_move text-bg-primary">
                    <input hidden name="action" value="remove_parent"/>

                    <div class="mb-3">
                        <label>Select a parent you would like to remove:</label>
                        <select required name="selected_parent">
                            <option disabled selected value="">Select a parent</option>
                            <?php for ($i = 0; $i < count($parents); $i++): ?>
                                <option value="<?php echo $parents[$i]["id"] ?>"><?php echo $parents[$i]["name"] . " " . $parents[$i]["surname"] ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-danger" name="removeBtn">Remove Parent</button>
                </form>
            </div>
        </main> 
            
        </div>

        <!-- footer with credit -->
        <?php include "footer.php" ?>
</body>
</html>