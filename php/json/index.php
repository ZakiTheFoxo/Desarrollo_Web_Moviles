<?php
    $json_text = '{"nombre" : "Omar", "edad" : 21, "altura" : 1.76, "sexo" : "M"}';
    $json_text = json_decode($json_text, JSON_UNESCAPED_UNICODE);

    echo "<pre>";
    var_dump($json_text);
    echo "</pre>";

    echo "<br>***************************************<br>";

    $json_array = array(
        "nombre" => "Omar",
        "edad" => 21,
        "altura" => 1.76,
        "sexo" => "M"
    );

    echo "<pre>";
    var_dump($json_array);
    echo "</pre>";

    $json_array = json_encode($json_array);

    echo "<pre>";
    var_dump($json_array);
    echo "</pre>";

    echo "<br>***************************************<br>";

    $json_texto = '{"squadName": "Super hero squad","homeTown": "Metro City","formed": 2016,"secretBase": "Super tower","active": true,"members": [{"name": "Molecule Man","age": 29,"secretIdentity": "Dan Jukes","powers": ["Radiation resistance", "Turning tiny", "Radiation blast"]},{"name": "Madame Uppercut","age": 39,"secretIdentity": "Jane Wilson","powers": ["Million tonne punch","Damage resistance","Superhuman reflexes"]},{"name": "Eternal Flame","age": 1000000,"secretIdentity": "Unknown","powers": ["Immortality","Heat Immunity","Inferno","Teleportation","Interdimensional travel"]}]}';

    $json_texto = json_decode($json_texto, JSON_UNESCAPED_UNICODE);

    if($json_texto == null){
        echo "Error al decodificar el JSON";
        exit;
    }else{
        echo "<pre>";
        var_dump($json_texto);
        echo "</pre>";
    }
?>