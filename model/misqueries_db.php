<?php
// Model for the MIS Queries

// Query that retrieves learners and their parents' details
function parentDetails()
{
    global $db;
    $query = "SELECT CONCAT(parents.name, ' ', parents.surname) as parent, email,
                    parents.cell_num, learners.id AS learner_id, CONCAT(learners.name, ' ', learners.surname) AS learner, grade
                    FROM learners
                    INNER JOIN relations ON relations.learner_id = learners.id
                    INNER JOIN parents ON relations.parent_id = parents.id
                    ORDER BY learners.id";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

// Query that returns the current waiting list
function currentWaitingList()
{
    global $db;
    $query = "SELECT learners.id, CONCAT(name, ' ', surname) AS full_name, grade, pickup_id, dropoff_id, cell_num, date_added FROM learners
                    INNER JOIN waiting_list ON waiting_list.learner_id = learners.id 
                    INNER JOIN applications ON applications.learner_id = learners.id 
                    ORDER BY learners.id";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

// Query that returns the amount of passengers per route based on the time of day
function routeAmounts($time_of_day)
{
    global $db;
    $query = "";
    if ($time_of_day == "morning")
    {
        $query = "SELECT bus_routes.route_name AS route, COUNT(*) AS learners_amt FROM learner_trips
                        INNER JOIN route_points ON route_points.point_num = learner_trips.pickup_id
                        INNER JOIN bus_routes ON bus_routes.id = route_points.route_num
                        GROUP BY bus_routes.route_name";
    }
    else if ($time_of_day == "afternoon")
    {
        $query = "SELECT bus_routes.route_name AS route, COUNT(*) AS learners_amt FROM learner_trips
                        INNER JOIN route_points ON route_points.point_num = learner_trips.dropoff_id
                        INNER JOIN bus_routes ON bus_routes.id = route_points.route_num
                        GROUP BY bus_routes.route_name";
    }
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

// Query that returns an overview of the time of day's passenger list
function overviewMIS($time_of_day)
{
    global $db;
    $query = "";
    if ($time_of_day == "morning")
    {
        $query = "SELECT CONCAT(name, ' ', surname) AS name, route_name, point_num, point_name, pickup_time FROM learners
                        INNER JOIN learner_trips ON learner_trips.learner_id = learners.id
                        INNER JOIN route_points ON route_points.point_num = learner_trips.dropoff_id
                        INNER JOIN bus_routes ON bus_routes.id = route_points.route_num
                        WHERE (SELECT CURRENT_TIME) <= '12:00:00'
                        ORDER BY learners.surname";
    }
    else if ($time_of_day == "afternoon")
    {
        $query = "SELECT CONCAT(name, ' ', surname) AS name, route_name, point_num, point_name, pickup_time FROM learners
                        INNER JOIN learner_trips ON learner_trips.learner_id = learners.id
                        INNER JOIN route_points ON route_points.point_num = learner_trips.pickup_id
                        INNER JOIN bus_routes ON bus_routes.id = route_points.route_num
                        WHERE (SELECT CURRENT_TIME) >= '12:00:00'
                        ORDER BY learners.surname";
    }
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

?>