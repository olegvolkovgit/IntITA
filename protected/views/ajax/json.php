<?php
header('Content-Type: application/json');

if (isset($statusCode) && !empty($statusCode) && is_int($statusCode)) {
    http_response_code($statusCode);
}

if (!empty($body)) {
    print_r($body);
}
