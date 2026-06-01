<?php
// data/repository.php

// Esta reemplaza a tu función cargarUsuarios($ruta)
function cargarUsuarios(): array {
    $ruta = __DIR__ . '/usuarios.json';
    // OPERADOR TERNARIO: (condición)
    return file_exists($ruta) ? json_decode(file_get_contents($ruta), true) : [];
}

// Esta es útil para el GET
function buscarUsuarioPorCurp(string $curp): ?array {
    $usuarios = cargarUsuarios();
    return $usuarios[$curp] ?? null;
}

// Esta centraliza el file_put_contents
function guardarUsuarios(array $usuarios_db): bool {
    $ruta = __DIR__ . '/usuarios.json';
    return file_put_contents($ruta, json_encode($usuarios_db, JSON_PRETTY_PRINT)) !== false;
}