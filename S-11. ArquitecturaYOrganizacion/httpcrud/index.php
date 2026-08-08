<?php

// 
require_once __DIR__ . '/autoload.php';

use Exception;

try {
    // code...
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            // code...
            break;
        case 'POST':
            // code...
            break;
        case 'PUT':
            // code...
            break;
        case 'DELETE':
            // code...
            break;
        default:
            // code...    
            http_response_code(405);
            echo json_encode([
                'error' => 'Método no permitido',
                'code' => 405,
                'file' => __FILE__,
                'line' => __LINE__,
            ]);
            break;
    }
} catch (Exception $e) {
    //throw $th;
    http_response_code(500);
    echo json_encode([
        'error' => $e->getMessage(),
        'code' => $e->getCode(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
    ]);
}

