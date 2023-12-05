<?php
    function getIconList($mysqli) {
        $sql = "SELECT * FROM pf_icons ORDER BY 'order' ASC";
        $result = $mysqli->query($sql);
        if($result->num_rows>0){
            return $result->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
        }
    }