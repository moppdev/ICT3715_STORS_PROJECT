<?php
    // Model for login

    // function that'll check login for admins
    function admin_login($email, $password, $name)
    {
        global $db;
        $query = "SELECT * FROM admins WHERE password = :password AND email = :email AND concat(initials, ' ', surname) = :name";
        $statement = $db->prepare($query);
        $statement->bindValue(":password", $password);
        $statement->bindValue(":email", $email);
        $statement->bindValue(":name", $name);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }

    // function that'll check login for parents
    function parent_login($email, $password)
    {
        global $db;
        $query = "SELECT * FROM parents WHERE password = :password AND email = :email";
        $statement = $db->prepare($query);
        $statement->bindValue(":password", $password);
        $statement->bindValue(":email", $email);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }
?>