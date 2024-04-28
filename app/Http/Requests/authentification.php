<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\DB;

class authentification
{
    public function create_table_user(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id SERIAL PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            about VARCHAR NOT NULL
        )";
        DB::statement($sql);
    }
    public function add_user(string $email, string $password): void
    {
        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
        DB::statement($sql);
    }

    public function get_user(string $email): array
    {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        return DB::select($sql);
    }

    public function update_user(string $email, string $password): void
    {
        $sql = "UPDATE users SET password = '$password' WHERE email = '$email'";
        DB::statement($sql);
    }

    public function delete_user(string $email): void
    {
        $sql = "DELETE FROM users WHERE email = '$email'";
        DB::statement($sql);
    }

}
