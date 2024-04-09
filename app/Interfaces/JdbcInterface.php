<?php

namespace App\Interfaces;

interface JdbcInterface
{
    public function fetch_array($cursor);
    public function free_result($cursor);
    public function exec(string $sql);
}
