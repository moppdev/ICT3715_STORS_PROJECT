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
        global $db;
         $query = "INSERT INTO relations VALUES (:id, :learner_id, :parent_id)";
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $db->lastInsertId());
        $statement->bindValue(":learner_id", $db->lastInsertId());
        $statement->bindValue(":parent_id", $_SESSION["user_id"]);
        $statement->execute();
        $statement->closeCursor();
    }

    // function that will either retrieve all learners 
    function get_all_learners()
    {
        global $db;
        $query = "SELECT * FROM learners";
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
            $query = "SELECT * FROM learners INNER JOIN relations WHERE relations.parent_id = :p_id AND relations.learner_id = learners.id";
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

?>