<?php

namespace App\Interfaces;

interface JdbcRepoInterface
{
    public function makeRequest(string $sql): array;
}
