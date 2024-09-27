<?php
    // Model for parents and admins tables

    // Create a parent
    function create_parent($name, $surname, $password, $cell_num, $email)
    {
        global $db;
        $query = "INSERT INTO parents VALUES (:id, :name, :surname, :password, :cell_num, :email)";
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $db->lastInsertId());
        $statement->bindValue(":name", $name);
        $statement->bindValue(":surname", $surname);
        $statement->bindValue(":password", $password);
        $statement->bindValue(":cell_num", $cell_num);
        $statement->bindValue(":email", $email);
        $statement->execute();
        $statement->closeCursor();
    }

    // function to edit a parent
    function edit_parent($parent_id, $name, $surname, $email, $cell_num, $password)
    {
        global $db;
        $query = "UPDATE parents SET name = :name WHERE id = :parent_id";
        $statement = $db->prepare($query);
        $statement->bindValue(":parent_id", $parent_id);
        $statement->bindValue(":name", $name);
        $statement->execute();
        $statement->closeCursor();

        $query = "UPDATE parents SET surname = :surname WHERE id = :parent_id";
        $statement = $db->prepare($query);
        $statement->bindValue(":parent_id", $parent_id);
        $statement->bindValue(":surname", $surname);
        $statement->execute();
        $statement->closeCursor();

        $query = "UPDATE parents SET email = :email WHERE id = :parent_id";
        $statement = $db->prepare($query);
        $statement->bindValue(":parent_id", $parent_id);
        $statement->bindValue(":email", $email);
        $statement->execute();
        $statement->closeCursor();

        $query = "UPDATE parents SET cell_num = :cell_num WHERE id = :parent_id";
        $statement = $db->prepare($query);
        $statement->bindValue(":parent_id", $parent_id);
        $statement->bindValue(":cell_num", $cell_num);
        $statement->execute();
        $statement->closeCursor();

        $query = "UPDATE parents SET password = :password WHERE id = :parent_id";
        $statement = $db->prepare($query);
        $statement->bindValue(":parent_id", $parent_id);
        $statement->bindValue(":password", $password);
        $statement->execute();
        $statement->closeCursor();
    }

    // Remove a parent and all related information
    function remove_parent($parent_id)
    {
        global $db;
        $query = "SELECT learner_id FROM relations WHERE parent_id = :parent_id";
        $statement = $db->prepare($query);
        $statement->bindValue(":parent_id", $parent_id);
        $statement->execute();
        $learner_ids = $statement->fetchAll();
        $learner_ids = implode(',', $learner_ids);
        $statement->closeCursor();

        if (!empty($learner_ids)) {
            $query = "DELETE FROM learner_trips WHERE learner_id IN (:ids)";
            $statement = $db->prepare($query);
            $statement->bindValue(":ids", $learner_ids);
            $statement->execute();
            $statement->closeCursor();
    
            $query = "DELETE FROM applications WHERE learner_id IN (:ids)";
            $statement = $db->prepare($query);
            $statement->bindValue(":ids", $learner_ids);
            $statement->execute();
            $statement->closeCursor();
    
            $query = "DELETE FROM waiting_list WHERE learner_id IN (:ids)";
            $statement = $db->prepare($query);
            $statement->bindValue(":ids", $learner_ids);
            $statement->execute();
            $statement->closeCursor();
    
            $query = "DELETE FROM learners WHERE id IN (:ids)";
            $statement = $db->prepare($query);
            $statement->bindValue(":ids", $learner_ids);
            $statement->execute();
            $statement->closeCursor();
        }
    
            $query = "DELETE FROM relations WHERE parent_id = :parent_id";
            $statement = $db->prepare($query);
            $statement->bindValue(":parent_id", $parent_id);
            $statement->execute();
            $statement->closeCursor();
        
            $query = "DELETE FROM admins WHERE parent_id = :parent_id";
            $statement = $db->prepare($query);
            $statement->bindValue(":parent_id", $parent_id);
            $statement->execute();
            $statement->closeCursor();
        
            $query = "DELETE FROM parents WHERE id = :parent_id";
            $statement = $db->prepare($query);
            $statement->bindValue(":parent_id", $parent_id);
            $statement->execute();
            $statement->closeCursor();
    }

    // Get parental info
    function get_parent_info($p_id)
    {
        global $db;
        $query = "SELECT name, surname, email FROM parents WHERE id = :id ";
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $p_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }

    // Get all parents
    function get_all_parents()
    {
        global $db;
        $query = "SELECT * FROM parents ORDER BY surname";
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }


    //Get administrator info
    function get_admin_info($a_id)
    {
        global $db;
        $query = "SELECT initials, surname, email FROM admins WHERE admin_id = :id ";
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $a_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }
?>