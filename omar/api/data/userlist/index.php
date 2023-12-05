<?php
    function getUserList($mysqli) {
        $sql = "SELECT id_user, name FROM pf_user ORDER BY id_user ASC";
        $result = $mysqli->query($sql);
        if($result->num_rows>0){
            return $result->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
        }
    }