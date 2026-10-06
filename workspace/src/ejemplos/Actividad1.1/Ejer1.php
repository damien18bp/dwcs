/**
 * Calculadora de IVA
 *
 * Este script calcula el precio total de un producto incluyendo el IVA
 */
<?php
 function calcularIVA($precio, $iva){
    $total = $precio + ($precio * ($iva / 100));
    return $total;
}
echo "El precio con IVA es: " . calcularIVA(100,21);