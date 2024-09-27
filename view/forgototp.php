<?php include "top.php" ?>
<title>STORS: Forgot Password</title>
</head>
<body>
    <!-- header of the page incl. the nav -->
        <header>
            <?php include "nav.php" ?>
        </header>

        <!-- hero image -->
        <div class="hero" id="forgot_hero">
            <h1 class="hero_text display-4">Forgot Password</h1>
        </div>

        <!-- main content -->
        <div class="container">

            <main class="mb-3">
                <h2>Forgot Password</h2>

                <p>Please enter your VALID cellphone number below to receive an OTP.</p>

                <!-- Where the user's cellphone number is entered to where the OTP will be sent -->
                <form id="forgot_cell" class="form_move text-bg-primary">
                    <div class="mb-3">
                            <label for="cell_num">Cellphone:</label>
                            <input name="cell_num" required type="text" class="form-control"/>
                    </div>

                    <button class="btn btn-warning" name="otpBtn">Send OTP</button>
                </form>


            </main> 
            
        </div>

        <!-- footer with credit -->
        <?php include "footer.php" ?>
</body>
</html>