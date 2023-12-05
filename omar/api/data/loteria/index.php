<?php
    function addLottery($data, $mysqli) {
        $sql = "INSERT INTO lottery(num, name, img) VALUES($data[num], '$data[name]', '$data[img]')";
        $result = $mysqli->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    function searchLottery($data, $mysqli) {
        $sql = "SELECT * FROM lottery WHERE num = '$data[search]' OR name LIKE '%$data[search]%'";
        $result = $mysqli->query($sql);
        if($result->num_rows>0){
            return $result->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
        }
    }

    function modifyLottery($data, $mysqli) {
        $sql = "UPDATE lottery SET num = $data[num], name = '$data[name]', img = '$data[img]' WHERE id = $data[id]";
        $result = $mysqli->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    function deleteLottery($data, $mysqli) {
        $sql = "DELETE FROM lottery WHERE id = $data[id]";
        $result = $mysqli->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }