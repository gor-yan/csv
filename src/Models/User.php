<?php

namespace App\Models;

class User
{
    public int $id;
    public string $phone;
    public string $name;

    public function __construct(string $phone, string $name)
    {
        $this->phone = $phone;
        $this->name = $name;
    }
}
