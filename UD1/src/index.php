<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unidad 1: Introducción a PHP</title>
    <link rel="stylesheet" href="assets/global.css">
</head>
<body>
    <header>
        <h1>Unidad 1: Introducción a PHP</h1>
    </header>
    <main>
        <section>
            <p>Bienvenido a la página principal de la Unidad 1: Introducción a PHP. Aquí encontrarás los ejemplos y ejercicios realizados en clase.</p>
            <p>Los ejercicios están publicados en el <a href="https://centros.edu.xunta.gal/iescotarelovilagarcia/aulavirtual/course/section.php?id=21857" target="_blank">aula virtual</a>.</p>
            <p>Consulta el <a href="https://www.php.net/manual/es/" target="_blank">manual oficial de PHP</a> para más información.</p>
        </section>
        <section>
            <h2>Ejemplos</h2>
            <ul>
                <?php
                $ejemplos = glob('ejemplos/*.php');
                foreach ($ejemplos as $ejemplo) {
                    $nombre = basename($ejemplo);//TODO Hacer dinamico para subdirectorios
                    echo "<li><a href=\"$ejemplo\">$nombre</a></li>";
                }
                ?>
            </ul>
        </section>
        <section>
            <h2>Ejercicios</h2>
            <ul>
                <?php
                $ejercicios = glob('ejercicios/*/*.php');
                foreach ($ejercicios as $ejercicio) {
                    $nombre = basename($ejercicio); //TODO Hacer dinamico para subdirectorios
                    echo "<li><a href=\"$ejercicio\">$nombre</a></li>";
                }
                ?>
            </ul>
        </section>
    </main>
    <footer>
        <p>&copy; 2026 Unidad 1: Introducción a PHP</p>
    </footer>
</body>
</html>