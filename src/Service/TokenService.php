<?php

namespace App\Service;

class TokenService
{
    private $tokens = [];

    public function set(string $id, string $token)
    {
        $this->tokens[$id] = $token;
    }

    public function get(string $id)
    {
        return $this->tokens[$id] ?? null;
    }

    public function remove(string $id)
    {
        unset($this->tokens[$id]);
    }

    public function generateToken($length = 10)
    {
        return bin2hex(random_bytes($length));
    }
}
