<?php 
 
    $hash =  password_hash('12345', PASSWORD_DEFAULT, ['cost'=>10]);
    echo $hash;
    echo '<br>';
    if(!password_verify('12345', $hash)){
        echo "Contraseña incorrecta";
    }else{
        echo "Contraseña correcta";
    }
?>