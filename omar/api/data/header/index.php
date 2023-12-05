<?php
    function getHeader($mysqli){
        $sql = "SELECT * FROM menu WHERE publicado = 1";
        $result = $mysqli->query($sql);
        if($result->num_rows>0){
            return $result->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
        }
    }
