<?php 
    // Index file for STORS
    // Create session
    session_start();

    // Declare database/model filepaths here
    include "model/database.php";
    include "model/login_db.php";
    include "model/parent_admin_db.php";
    include "model/learners_db.php";
    include "model/wait_application_db.php";
    include "model/trips_routes_db.php";
    include "model/misqueries_db.php";
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // Function to send emails
    function send_mail($subject, $body, $alt, $to_address, $to_name)
    {
        $mail = new PHPMailer();

        try {
            // Server settings
            $mail->isSMTP(); 
            $mail->Host = 'mail.klipstapel.co.za'; 
            $mail->SMTPAuth = true; 
            $mail->Username = 'sultanmustafa@klipstapel.co.za'; 
            $mail->Password = 'QW1lJj4}Ib01'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
            $mail->Port = 465;

            // Recipients
            $mail->setFrom('sultanmustafa@klipstapel.co.za', 'STORS');
            $mail->addAddress($to_address, $to_name);

            // Content
            $mail->isHTML(true); 
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = $alt;

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    // Get the value of action to determine what happens in the website
    $action = filter_input(INPUT_POST, "action");
    if ($action == NULL)
    {
        $action = filter_input(INPUT_GET, "action");
        if ($action == NULL)
        {
            $action = "none";
        }
    }

    // load learners according to the role assigned in session
    if (isset($_SESSION["role"]))
    {
        if (isset($_SESSION["user_id"]))
        {
            $learners = get_parent_learners();
            if ($_SESSION["role"] == "admins")
            {
                $learners = get_all_learners();
            }
        }
    }

    // Get all parents
    $parents = get_all_parents();

    // Get the route points
    $points = getRoutePoints();

    // Check the value of action
    switch ($action) {
        case "parent_login":
            // Parental login
             $p_email = filter_input(INPUT_POST, "email");
            $p_pass = filter_input(INPUT_POST, "password");
            
            $p_result = parent_login($p_email, $p_pass);
            
            // Check login result
            if ($p_result) {
                $_SESSION["user_id"] = $p_result["id"];
                $_SESSION["role"] = "parents";
                $_SESSION["user_info"] = get_parent_info($_SESSION["user_id"]);
                session_regenerate_id();
                header("Location: home.php");
                exit();
            } else {
                $error = "Please check your credentials and try again.";
            }
        break;
        case "register_learner":
            // Register a learner
            // Get input
            $name = filter_input(INPUT_POST, "name");
            $surname = filter_input(INPUT_POST, "surname");
            $cell_num = filter_input(INPUT_POST, "cell_num");
            $grade = filter_input(INPUT_POST, "grade");

            // Create learner and relation
            create_new_learner($name, $surname, $cell_num, $grade);
            create_new_relation();
            header("Location: home.php");

            exit();
        break;
        case "register_learner_admin":
            // Register learner via admin
            // Get inputs
            $name = filter_input(INPUT_POST, "name");
            $surname = filter_input(INPUT_POST, "surname");
            $cell_num = filter_input(INPUT_POST, "cell_num");
            $grade = filter_input(INPUT_POST, "grade");
            $p_id = filter_input(INPUT_POST, "parent");

            // Create learner and relation
            create_new_learner($name, $surname, $cell_num, $grade);
            create_new_relation($p_id);
            header("Location: home.php");

            exit();
        break;
        case "register_parent":
            // Get inputs
            $name = filter_input(INPUT_POST, "name");
            $surname = filter_input(INPUT_POST, "surname");
            $cell_num = filter_input(INPUT_POST, "cell_num");
            $grade = filter_input(INPUT_POST, "grade");
            $p_id = filter_input(INPUT_POST, "parent");

            
        break;
        case "edit_learner":
            // Edit a learner's details
            // Get inputs
            $id = filter_input(INPUT_POST, "l_id");
            $e_name = filter_input(INPUT_POST, "e_name");
            $e_surname = filter_input(INPUT_POST, "e_surname");
            $e_cell_num = filter_input(INPUT_POST, "e_cell_num");
            $e_grade = filter_input(INPUT_POST, "e_grade");

            // Edit the learner
            edit_learner($id, $e_name, $e_surname, $e_grade, $e_cell_num);
            header("Location: home.php");

            exit();
        break;
        case "edit_parent":
            echo "Hello";
        break;
        case "remove_learner":
            // Remove a learner from the system
            $id = filter_input(INPUT_POST, "selected_learner");

            // Remove learner
            remove_learner($id);
            header("Location: home.php");
            exit();
        break;
        case "remove_parent":
            echo "Hello";
        break;
        case "admin_login":
            // Login as admin
            // Get inputs
            $a_email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $a_pass = filter_input(INPUT_POST, "password");
            $a_name = filter_input(INPUT_POST, "name");
    
            $a_result = admin_login($a_email, $a_pass, $a_name);

            // Check login result
            if ($a_result) {
                $_SESSION["role"] = "admins";
                $_SESSION["user_id"] = $a_result["admin_id"];
                $_SESSION["user_info"] = get_admin_info($_SESSION["user_id"]);
                session_regenerate_id();
                header("Location: home.php");
                exit();
            }
            else
            {
                $error = "Please check your administrative credentials. Access Denied.";
            }
        break;
        case "get_learners":
            // Return learners for FETCH request in JSON format
            echo json_encode($learners);
        break;
        case "apply_learner":
            // Apply for transport for a learner via parent
            // Get input
            $id = filter_input(INPUT_POST, "l_id");
            $pickup = filter_input(INPUT_POST, "pickup");
            $dropoff = filter_input(INPUT_POST, "dropoff");

            // Apply for learner
            applyForLearner($id, $pickup, $dropoff);

            // Get parent details and send email
            $name = $_SESSION['user_info']['name'];
            $email = $_SESSION['user_info']['email'];

            send_mail("STORS Application Notification" , "<b>Dear $name</b>, your application for one of your learners has been successful. <br> Kind Regards <br> Strive High", 
            "Dear $name, your application for one of your learners has been successful. Kind Regards Strive High", $email, $name);

            header("Location: applytransport.php");

            exit();
        break;
        case "cancel_app":
            // Cancel an application for learner via parent
            // get input
            $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

            // Cancel application and send json response
            cancelApplication($id);
            echo json_encode(['success' => true]);

            // Get parent details and send email
            $name = $_SESSION['user_info']['name'];
            $email = $_SESSION["user_info"]["email"];

            send_mail("STORS Application Cancellation Notification" , "<b>Dear $name</b>, <br><br> your application for one of your learners has been cancelled. <br><br> Kind Regards <br> Strive High", 
            "Dear $name, your application for one of your learners has been cancelled. Kind Regards Strive High", $email, $name);

            exit();
        break;
        case "sign_out":
            // Sign out
            // Destroy session
            $_SESSION = array();
            session_destroy();
            header("Location: view/home.php");
            exit();
        break;
    }
?>