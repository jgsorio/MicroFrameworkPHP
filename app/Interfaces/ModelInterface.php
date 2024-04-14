<?php

namespace App\Interfaces;

interface ModelInterface
{
    public function all();
    public function find(string $key, mixed $value): mixed;
}