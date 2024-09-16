<?php 
    // Index file for the STORS
    // Create session
    session_start();

    // Declare database/model filepaths here
    include "model/database.php";
    include "model/login_db.php";
    include "model/parent_admin_db.php";
    include "model/learners_db.php";

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

    // load parental or admin information
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

            exit();
        break;
        case "edit_learner":

        break;
        case "remove_learner":
            $id = filter_input(INPUT_POST, "selected_learner");

            remove_learner($id);
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
        case "sign_out":
            $_SESSION = array();
            session_destroy();
            header("Location: view/home.php");
            exit();
        break;
    }
?>