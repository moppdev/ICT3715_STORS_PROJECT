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
    // require 'PHPMailer/src/Exception.php';
    // require 'PHPMailer/src/PHPMailer.php';
    // require 'PHPMailer/src/SMTP.php';

    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;

    // function send_mail()
    // {
    //     $mail = new PHPMailer();

    //     try {
    //         // Server settings
    //         $mail->isSMTP(); 
    //         $mail->Host = 'smtp.gmail.com'; 
    //         $mail->SMTPAuth = true; 
    //         $mail->Username = 'my gmail email'; 
    //         $mail->Password = 'lol'; 
    //         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
    //         $mail->Port = 465; 
    //         $mail->SMTPDebug = 2;

    //         // Recipients
    //         $mail->setFrom('howtovote2024@gmail.com', 'STORS');
    //         $mail->addAddress('personal gmail', 'lol');

    //         // Content
    //         $mail->isHTML(true); 
    //         $mail->Subject = 'Here is the subject';
    //         $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    //         $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    //         $mail->send();
    //         echo 'Message has been sent';
    //     } catch (Exception $e) {
    //         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    //     }
    // }

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
             $p_email = filter_input(INPUT_POST, "email");
            $p_pass = filter_input(INPUT_POST, "password");
            
            $p_result = parent_login($p_email, $p_pass);
            
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
            $name = filter_input(INPUT_POST, "name");
            $surname = filter_input(INPUT_POST, "surname");
            $cell_num = filter_input(INPUT_POST, "cell_num");
            $grade = filter_input(INPUT_POST, "grade");

            create_new_learner($name, $surname, $cell_num, $grade);
            create_new_relation();
            header("Location: home.php");

            exit();
        break;
        case "register_learner_admin":
            $name = filter_input(INPUT_POST, "name");
            $surname = filter_input(INPUT_POST, "surname");
            $cell_num = filter_input(INPUT_POST, "cell_num");
            $grade = filter_input(INPUT_POST, "grade");
            $p_id = filter_input(INPUT_POST, "parent");

            create_new_learner($name, $surname, $cell_num, $grade);
            create_new_relation($p_id);
            header("Location: home.php");

            exit();
        break;
        case "edit_learner":
            $id = filter_input(INPUT_POST, "l_id");
            $e_name = filter_input(INPUT_POST, "e_name");
            $e_surname = filter_input(INPUT_POST, "e_surname");
            $e_cell_num = filter_input(INPUT_POST, "e_cell_num");
            $e_grade = filter_input(INPUT_POST, "e_grade");

            edit_learner($id, $e_name, $e_surname, $e_grade, $e_cell_num);
            header("Location: home.php");

            exit();
        break;
        case "remove_learner":
            $id = filter_input(INPUT_POST, "selected_learner");

            remove_learner($id);
            header("Location: home.php");
            exit();
        break;
        case "admin_login":
            $a_email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $a_pass = filter_input(INPUT_POST, "password");
            $a_name = filter_input(INPUT_POST, "name");
    
            $a_result = admin_login($a_email, $a_pass, $a_name);
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
            echo json_encode($learners);
        break;
        case "apply_learner":
            $id = filter_input(INPUT_POST, "l_id");
            $pickup = filter_input(INPUT_POST, "pickup");
            $dropoff = filter_input(INPUT_POST, "dropoff");

            applyForLearner($id, $pickup, $dropoff);
            send_mail();

            header("Location: applytransport.php");

            exit();
        break;
        case "cancel_app":
            $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

            cancelApplication($id);
            echo json_encode(['success' => true]);

            exit();
        break;
        case "sign_out":
            $_SESSION = array();
            session_destroy();
            header("Location: view/home.php");
            exit();
        break;
    }
?>
