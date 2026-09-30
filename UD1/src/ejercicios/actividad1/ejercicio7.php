<?php

/**
 * Devuelve true si $p2 es un anagrama de $p1.
 */
function esAnagrama(string $p1, string $p2): bool
{
    $p1 = strtoupper($p1);
    $p2 = strtoupper($p2);
    //Si las palabras tienen distinto numero de letras, no son anagramas.
    if (strlen($p1) !== strlen($p2)) {
        return false;
    }

    //Si $p1 y $p2 son la misma palabra, tampoco son anagramas.
    if ($p1 === $p2) {
        return false;
    }


    $arrayP1 = str_split($p1);
    foreach ($arrayP1 as $letra) {
        if (($i = strpos($p2, $letra)) == false) {
            return false;
        } else {
            $p2 = substr_replace($p2, "", $i, 1);
        }
    }

    return true;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>
</head>

<body>
    <h1>Comprobador de anagramas</h1>
    <form action="" method="POST">
        <label for="palabra1"> Palabra</label>
        <input type="text" name="palabra1"><br>
        <label for="palabra1"> Anagrama?</label>

        <input type="text" name="palabra2"><br>
        <button type="submit">Comprobar</button>
    </form>

    <div>
        <?php
        if (isset($_POST['palabra1']) && isset($_POST['palabra2'])){
            echo esAnagrama($_POST['palabra1'], $_POST['palabra2'])?"SON ANAGRAMAS": "NO SON ANAGRAMAS";
        }
        ?>
    </div>

</body>

</html>