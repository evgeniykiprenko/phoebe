<?php
require_once('route/api.php');

try {
    $api = new Route();
    echo $api->run();
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
