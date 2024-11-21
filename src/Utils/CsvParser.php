<?php

namespace App\Utils;

use App\Core\Validator;
use App\Exceptions\ValidationException;

class CsvParser
{
    public static function parse(string $filePath): array
    {
        if (!file_exists($filePath)) {
            throw new \Exception("File not found: $filePath");
        }

        $rows = [];
        $handle = fopen($filePath, 'r');
        fgetcsv($handle);

        while (($data = fgetcsv($handle)) !== false) {
            $rows[] = [
                'phone' => trim($data[0]),
                'name' => trim($data[1]),
            ];
        }

        fclose($handle);

        return self::validateRows($rows);
    }

    private static function validateRows(array $rows): array
    {
        $validatedRows = [];
        $validator = new Validator([
            'phone' => fn($phone) => preg_match('/^\+?\d+$/', $phone),
            'name' => fn($name) => strlen($name) > 0,
        ]);

        foreach ($rows as $row) {
            try {
                $validator->validate($row);
                $validatedRows[] = $row;
            } catch (ValidationException $e) {
                Logger::log('Validation error: ' . implode(', ', $e->getErrors()));
            }
        }

        return $validatedRows;
    }
}
