<?php
    // Model for learnertrips and routepoints tables
    function getRoutePoints()
    {
        global $db;
        $query = "SELECT point_num, route_name, point_name FROM route_points INNER JOIN bus_routes ON route_points.route_num = bus_routes.id";
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }




?>