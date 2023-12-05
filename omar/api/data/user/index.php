<?php
    /* GET */
    function getUser($data, $mysqli) {
        $sql = "SELECT * FROM pf_user WHERE name = '".$data["name"]."';";
        $result = $mysqli->query($sql);
        if($result->num_rows>0){
            return $result->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
        }
    }

    function getAbout($id, $mysqli) {
        $sql = "SELECT about FROM pf_about WHERE id_user = ".$id.";";
        $result = $mysqli->query($sql);
        if($result->num_rows>0){
            return $result->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
        }
    }

    function getObjectives($id, $mysqli) {
        $sql = "SELECT objective FROM pf_objectives WHERE id_user = ".$id.";";
        $result = $mysqli->query($sql);
        if($result->num_rows>0){
            return $result->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
        }
    }

    function getNeeds($id, $mysqli) {
        $sql = "SELECT need FROM pf_needs WHERE id_user = ".$id.";";
        $result = $mysqli->query($sql);
        if($result->num_rows>0){
            return $result->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
        }
    }

    function getFeatures($id, $mysqli) {
        $sql = "SELECT * FROM pf_features WHERE id_user = ".$id.";";
        $result = $mysqli->query($sql);
        if($result->num_rows>0){
            return $result->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
        }
    }

    function getCompetency($id, $mysqli) {
        $sql = "SELECT * FROM pf_competency WHERE id_user = ".$id.";";
        $result = $mysqli->query($sql);
        if($result->num_rows>0){
            return $result->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
        }
    }

    function getSocial($id, $mysqli) {
        $sql = "SELECT url, name, icon, pf_social.id_icon FROM pf_social INNER JOIN pf_icons ON pf_social.id_icon = pf_icons.id_icon WHERE id_user = ".$id.";";
        $result = $mysqli->query($sql);
        if($result->num_rows>0){
            return $result->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
        }
    }

    /* POST */
    function addUser($data, $mysqli) {
        $sql = "INSERT INTO pf_user(name, age, job, marital, city, quote, img, created_by) 
                VALUES('$data[name]', $data[age], '$data[job]', '$data[status]', '$data[city]', \"$data[quote]\", '$data[img]', $data[created_by]);";
        $result = $mysqli->query($sql);
        if($result){
            return $mysqli -> insert_id;
        }else{
            return false;
        }
    }

    function addAbout($data, $mysqli) {
        $sql = "INSERT INTO pf_about(id_user, about) 
                VALUES($data[id], \"$data[about]\");";
        $result = $mysqli->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    function addObjectives($data, $mysqli) {
        foreach ($data['objectives'] as $key => $value) {
            $sql = "INSERT INTO pf_objectives(id_user, objective) 
                    VALUES($data[id], '$value');";
            $result = $mysqli->query($sql);
            if(!$result){
                return false;
            }
        }
        return true;
    }

    function addNeeds($data, $mysqli) {
        foreach ($data['needs'] as $key => $value) {
            $sql = "INSERT INTO pf_needs(id_user, need) 
                    VALUES($data[id], '$value');";
            $result = $mysqli->query($sql);
            if(!$result){
                return false;
            }
        }
        return true;
    }

    function addFeatures($data, $mysqli) {
        $sql = "INSERT INTO pf_features(id_user, scale1, scale2, scale3, scale4) 
                VALUES($data[id], $data[feature1], $data[feature2], $data[feature3], $data[feature4]);";
        $result = $mysqli->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    function addCompetency($data, $mysqli) {
        $sql = "INSERT INTO pf_competency(id_user, scale1, scale2, scale3, scale4) 
                VALUES($data[id], $data[competency1], $data[competency2], $data[competency3], $data[competency4]);";
        $result = $mysqli->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    function addSocial($data, $mysqli) {
        foreach ($data['social'] as $key => $value) {
            $url = 'url_'.$value;
            $sql = "INSERT INTO pf_social(id_user, id_icon, url) 
                    VALUES($data[id], $value,'$data[$url]');";
            $result = $mysqli->query($sql);
            if(!$result){
                return false;
            }
        }
        return true;
    }

    /* PUT */
    function modifyUser($data, $mysqli) {
        $sql = "UPDATE pf_user SET name = '$data[name]', age = $data[age], job = '$data[job]', marital = '$data[status]', city = '$data[city]', quote = \"$data[quote]\", img = '$data[img]', created_by = $data[created_by] WHERE id_user = $data[id]";
        $result = $mysqli->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    function modifyAbout($data, $mysqli) {
        $sql = "UPDATE pf_about SET about = '$data[about]' WHERE id_user = $data[id]";
        $result = $mysqli->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    function modifyObjectives($data, $mysqli) {
        $sql = "DELETE FROM pf_objectives WHERE id_user = $data[id]";
        $mysqli->query($sql);

        foreach ($data['objectives'] as $key => $value) {
            $sql = "INSERT INTO pf_objectives(id_user, objective) 
                    VALUES($data[id], '$value');";
            $result = $mysqli->query($sql);
            if(!$result){
                return false;
            }
        }
        return true;
    }

    function modifyNeeds($data, $mysqli) {
        $sql = "DELETE FROM pf_needs WHERE id_user = $data[id]";
        $mysqli->query($sql);

        foreach ($data['needs'] as $key => $value) {
            $sql = "INSERT INTO pf_needs(id_user, need) 
                    VALUES($data[id], '$value');";
            $result = $mysqli->query($sql);
            if(!$result){
                return false;
            }
        }
        return true;
    }

    function modifyFeatures($data, $mysqli) {
        $sql = "UPDATE pf_features SET scale1 = $data[feature1], scale2 = $data[feature2], scale3 = $data[feature3], scale4 = $data[feature4] WHERE id_user = $data[id]";
        $result = $mysqli->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    function modifyCompetency($data, $mysqli) {
        $sql = "UPDATE pf_competency SET scale1 = $data[competency1], scale2 = $data[competency2], scale3 = $data[competency3], scale4 = $data[competency4] WHERE id_user = $data[id]";
        $result = $mysqli->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    function modifySocial($data, $mysqli) {
        $sql = "DELETE FROM pf_social WHERE id_user = $data[id]";
        $mysqli->query($sql);

        foreach ($data['social'] as $key => $value) {
            $url = 'url_'.$value;
            $sql = "INSERT INTO pf_social(id_user, id_icon, url) 
                    VALUES($data[id], $value,'$data[$url]');";
            $result = $mysqli->query($sql);
            if(!$result){
                return false;
            }
        }
        return true;
    }

    /* DELETE */
    function deleteUser($data, $mysqli) {
        $sql = "DELETE FROM pf_user WHERE name = '".$data["name"]."';";
        $result = $mysqli->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }