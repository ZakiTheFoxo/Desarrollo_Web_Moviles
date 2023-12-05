<?php
    function getTable($mysqli){
        $sql = "SELECT id, nombre, nacimiento, nombre_puesto FROM mi_tabla INNER JOIN puestos ON mi_tabla.id_puesto = puestos.id_puesto";
        $result = $mysqli->query($sql);
        if($result->num_rows>0){
            return $result->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
        }
    }
