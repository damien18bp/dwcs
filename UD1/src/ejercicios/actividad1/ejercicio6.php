<?php
function comprobarNumero(int $numero)
{
    if ($numero === 0) {
        return "Es cero";
    }
    if ($numero < 0) {
        return " $numero es menor que 0";
    }

    return "$numero es mayor que 0";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Positivo negativo</title>
</head>

<body>

    <form action="" method="post">
        <label for="numero">Introduzca un número</label>
        <input type="text" name="num">
        <button type="submit">Comprobar</button>

    </form>

    <div class="respuesta">
        <?php
            $numero = $_POST["num"] ?? "";
            if(is_numeric($numero)){
                echo comprobarNumero($numero);
            }
        ?>
    </div>

</body>

</html>