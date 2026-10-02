<?php
$nivel = $_POST['nivel'] ?? 0 ;
$nivel ++;
function generarNumeros(int $nivel): array{
    $numeros = [];
    for($i=0; $i < $nivel; $i++){
        $numeros[] = rand(1, 4);
    }

    return $numeros;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 10</title>
    <style>
        .hidden{
            display: none;
        }
    </style>
    <script>
        function ocultarNumeros(){
            setTimeout(
                function (){
                    document.getElementById('numeros').classList.add('hidden');
                    document.getElementById('formulario').classList.remove('hidden');
                } ,
                3000
            );
        }
    </script>
</head>
<body onload="ocultarNumeros()">
    <h1>Simón dice</h1>
    <div id="numeros">
        <?php
            $nums = generarNumeros($nivel);
            echo implode("-",$nums);
        ?>
    </div>

    <div id="formulario" class ="hidden">
        <form action="" method="post">
            <label for="in_nums">Introduzca los números en orden.</label> <br>
            <input type="text" name="in_nums">
            <input type="hidden" name="nivel" value=<?= $nivel ?>>
            <button type="submit">Jugar</button>
        </form>
    </div>

</body>
</html>