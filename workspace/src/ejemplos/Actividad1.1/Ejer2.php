/**
 * Funcion para iniciar session
 */

<?php
define ('USER', 'usuario');
define ('PASS', '1234');

function login (string $username, string $password): bool {
    $toret = false;
    if (!empty($username) && !empty($password)){
        if (USER === $username && PASS === $password){
            $toret = true;
        }
    }
    return $toret;
}

echo "La sesion se ha inicado: " . login("Damien", 91);