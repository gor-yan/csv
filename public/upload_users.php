<?php

require_once __DIR__ . '/../vendor/autoload.php';

ini_set('max_execution_time', 0);

use App\Models\User;
use App\Services\UserService;
use App\Utils\CsvParser;

$filePath = __DIR__ . '/../data.csv';

try {
    $rows = CsvParser::parse($filePath);
    $userService = new UserService();

    foreach ($rows as $row) {
        $user = new User($row['phone'], $row['name']);
        $userService->save($user);
    }

    echo "Uploaded!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
