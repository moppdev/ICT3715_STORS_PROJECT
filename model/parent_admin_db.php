<?php
    // Model for parents and admins tables

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

    //Get administrator info
    function get_admin_info($a_id)
    {
        global $db;
        $query = "SELECT initials, surname, email FROM admins WHERE id = :id ";
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $a_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }
?>