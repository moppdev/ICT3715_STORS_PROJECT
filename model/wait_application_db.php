<?php
    // Model for the waiting list and applications tables

    // Remove a learner from learner_trips
    function removeTrip($id)
    {
        global $db;
        $query = "DELETE FROM learner_trips WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $statement->closeCursor();
    }

    // Transfer application to learner_trips
    function move_app_to_trip($id)
    {
        global $db;
        $query = "SELECT pickup_id, dropoff_id FROM applications WHERE learner_id = :id LIMIT 1";
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $points = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();

        // Construct the check string based off the pickup points and determine the limit
        $check = substr($points["pickup_id"], 0, 1) . "" . substr($points["dropoff_id"], 0, 1);
        $limit = 0;
        switch ($check)
        {
            case "11":
                $limit = 35;
                break;
            case "22":
                $limit = 8;
                break;
            case "33":
                $limit = 15;
                break;
        }

        // Check how many learners are on this route
        $query = "SELECT COUNT(*) AS num FROM learner_trips WHERE CONCAT(SUBSTRING(pickup_id, 1, 1), '', SUBSTRING(dropoff_id, 1, 1)) = :check";
        $statement = $db->prepare($query);
        $statement->bindValue(":check", $check);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();

        // If limit is not exceeded
        if (intval($result["num"]) < $limit)
        {
            // If the learner can be added, cancel their application
            cancelApplication($id);

            // Insert the learner into the learner_trips table
            $query = "INSERT INTO learner_trips VALUES (:id, :l_id, :p_id, :d_id)";
            $statement = $db->prepare($query);
            $statement->bindValue(":id", $db->lastInsertId());
            $statement->bindValue(":l_id", $id);
            $statement->bindValue(":p_id", $points["pickup_id"]);
            $statement->bindValue(":d_id", $points["dropoff_id"]);
            $statement->execute();
            $statement->closeCursor();
            return true;
        }
        else
        {
            return false;
        }
}

    // Check a learner's application status
    function checkLearnerApplyStatus($id)
    {
        global $db;
        $query = "SELECT waiting_list.learner_id FROM applications 
                        INNER JOIN waiting_list ON applications.learner_id = waiting_list.learner_id
                        WHERE applications.learner_id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        if ($result == NULL || $result == false)
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
        return $result;
    }

    // Check if a learner's in the passenger lists
    function checkLearnerPassengerStatus($id)
    {
        global $db;
        $query = "SELECT learner_id FROM learner_trips
                        WHERE learner_id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        if ($result == NULL || $result === false)
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
        return $result;
    }

    // Get a learner's passenger info
    function getPassengerInfo($id)
    {
        global $db;
        $query = "SELECT id, t1.point_name AS p1_name, t1.pickup_time AS p1_time, t2.point_name AS p2_name, t2.dropoff_time AS p2_time FROM stors.learner_trips 
INNER JOIN stors.route_points AS t1 
        ON t1.point_num = stors.learner_trips.pickup_id 
INNER JOIN stors.route_points AS t2 
        ON t2.point_num = stors.learner_trips.dropoff_id WHERE learner_id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
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