<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 8</title>
</head>

<body>
    <form action="" method="post">
        <label for="base">Base</label><br>
        <input type="text" name="base"><br>

        <label for="exponente">Exponente</label><br>
        <input type="text" name="exponente"><br>

        <button type="submit">Calcular</button>
    </form>

    <!-- resultado -->
    <?php
    // Con require_once y con include_once si el fichero ya se ha importado NO SE VUELVE A HACER LA IMPORTACIÓN.
    require_once "misfunciones/presentacion.php";
    require_once "misfunciones/matematicas.php";
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $base = $_POST['base'];
        $exp = $_POST['exponente'];
        if(potencia($base, $exp)<100){

            echo printPotencia($base, $exp);
        }else{
            echo "El resultado es demasiado grande para ser mostrado!";
        }
    }
    ?>
</body>

</html>