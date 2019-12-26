<?php

include __DIR__ . "/../vendor/autoload.php";
include 'IOperacionAritmetica.php';
include 'Suma.php';
include 'Resta.php';
include 'IOperador.php';
include 'Sumador.php';
include 'Restador.php';
include 'Calculadora.php';
include 'Factory.php';

$context     = \Koldown\InversionControl\ContainerContext::getInstance();
$sumador     = $context->create(Factory::class, Sumador::class);
$restador    = $context->create(Factory::class, Restador::class);

$calculadora = $context->create(Factory::class, Calculadora::class);

echo "Función suma (9 + 11)  = {$sumador->ejecutar(9, 11)}<br>";
echo "Función resta (15 - 6) = {$restador->ejecutar(15, 6)}<br>";

echo "Cálculo suma (4 + 8)  = {$calculadora->sumar(4, 8)}<br>";
echo "Cálculo resta (9 - 2) = {$calculadora->restar(9, 2)}";