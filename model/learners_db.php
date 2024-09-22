<?php 
    // Model for learners table

    // function that will create a new learner
    function create_new_learner($name, $surname, $cell_num, $grade)
    {
        global $db;
        $query = "INSERT INTO learners VALUES (:id, :name, :surname, :cell_num, :grade)";
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $db->lastInsertId());
        $statement->bindValue(":name", $name);
        $statement->bindValue(":surname", $surname);
        $statement->bindValue(":cell_num", $cell_num);
        $statement->bindValue(":grade", $grade);
        $statement->execute();
        $statement->closeCursor();
    }

    // create new relation
    function create_new_relation()
    {
        // Check if any arguments were passed
        if (func_num_args() > 0) {
            $parent_id = func_get_arg(0);
        } else {
            $parent_id = $_SESSION["user_id"]; 
        }

        global $db;
         $query = "INSERT INTO relations VALUES (:id, :learner_id, :parent_id)";
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $db->lastInsertId());
        $statement->bindValue(":learner_id", $db->lastInsertId());
        $statement->bindValue(":parent_id", $parent_id);
        $statement->execute();
        $statement->closeCursor();
    }

    // function that will either retrieve all learners 
    function get_all_learners()
    {
        global $db;
        $query = "SELECT * FROM learners ORDER BY surname";
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    // function to retrieve learners related to a single parent
    function get_parent_learners()
    {
            global $db;
            $query = "SELECT * FROM learners INNER JOIN relations WHERE relations.parent_id = :p_id AND relations.learner_id = learners.id ORDER BY learners.surname";
            $statement = $db->prepare($query);
            $statement->bindValue(":p_id", $_SESSION["user_id"]);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
    }

    // function to remove a learner
    function remove_learner($learner_id)
    {
        global $db;
        $query = "DELETE FROM learners WHERE id = :learner_id";
        $statement = $db->prepare($query);
        $statement->bindValue(":learner_id", $learner_id);
        $statement->execute();
        $statement->closeCursor();
    }

    // function to edit a learner
    function edit_learner($learner_id, $name, $surname, $grade, $cell_num)
    {
        global $db;
        $query = "UPDATE learners SET name = :name WHERE id = :learner_id";
        $statement = $db->prepare($query);
        $statement->bindValue(":learner_id", $learner_id);
        $statement->bindValue(":name", $name);
        $statement->execute();
        $statement->closeCursor();

        $query = "UPDATE learners SET surname = :surname WHERE id = :learner_id";
        $statement = $db->prepare($query);
        $statement->bindValue(":learner_id", $learner_id);
        $statement->bindValue(":surname", $surname);
        $statement->execute();
        $statement->closeCursor();

        $query = "UPDATE learners SET grade= :grade WHERE id = :learner_id";
        $statement = $db->prepare($query);
        $statement->bindValue(":learner_id", $learner_id);
        $statement->bindValue(":grade", $grade);
        $statement->execute();
        $statement->closeCursor();

        $query = "UPDATE learners SET cell_num = :cell_num WHERE id = :learner_id";
        $statement = $db->prepare($query);
        $statement->bindValue(":learner_id", $learner_id);
        $statement->bindValue(":cell_num", $cell_num);
        $statement->execute();
        $statement->closeCursor();
    }

?>