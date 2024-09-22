<?php
    // Model for the waiting list and applications tables

    // Check a learner's application status
    function checkLearnerApplyStatus($id)
    {
        global $db;
        $query = "SELECT waiting_list.learner_id FROM applications INNER JOIN waiting_list ON applications.learner_id = waiting_list.learner_id
                        WHERE applications.learner_id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        if ($result == NULL)
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
        return $result;
    }

    // Create an application for a learner and automatically add them to the waiting list
    function applyForLearner($id, $pickup, $dropoff)
    {
        global $db;
        $query = "INSERT INTO applications VALUES (:id, :l_id, :pickup, :dropoff)";
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $db->lastInsertId());
        $statement->bindValue(":l_id", $id);
        $statement->bindValue(":pickup", $pickup);
        $statement->bindValue(":dropoff", $dropoff);
        $statement->execute();
        $app_id = $db->lastInsertId();
        $statement->closeCursor();

        $query = "INSERT INTO waiting_list VALUES (:l_id, :app_id, :date)";
        $statement = $db->prepare($query);
        $statement->bindValue(":l_id", $id);
        $statement->bindValue(":app_id", $app_id);
        $statement->bindValue(":date", date('Y-m-d H:i:s'));
        $statement->execute();
        $statement->closeCursor();
    }

    // Remove a learner's application and from the waiting list
    function cancelApplication($learner_id)
    {
        global $db;
        $query = "DELETE FROM applications WHERE learner_id = :learner_id";
        $statement = $db->prepare($query);
        $statement->bindValue(":learner_id", $learner_id);
        $statement->execute();

        $query = "DELETE FROM waiting_list WHERE learner_id = :learner_id";
        $statement = $db->prepare($query);
        $statement->bindValue(":learner_id", $learner_id);
        $statement->execute();
        $statement->closeCursor();
    }
    
?>