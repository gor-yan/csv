<?php

namespace App\Repositories;

use App\Database\Connection;
use App\Models\User;

class UserRepository
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Connection::getConnection();
    }

    public function save(User $user): bool
    {
        $stmt = $this->db->prepare('INSERT INTO users (phone, name) VALUES (:phone, :name)');
        return $stmt->execute([
            ':phone' => $user->phone,
            ':name' => $user->name,
        ]);
    }

    public function getAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM users');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
