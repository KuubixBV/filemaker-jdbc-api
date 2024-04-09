<?php

namespace App\Repositories;

use App\Interfaces\JdbcRepoInterface;
use Illuminate\Support\Facades\App;
use App\Interfaces\JdbcInterface;
use Exception;

class JdbcRepository implements JdbcRepoInterface
{
    protected JdbcInterface $jdbc;

    public function __construct()
    {
        $this->jdbc = App::make('jdbc');
    }

    /**
     * Make a request to the JDBC connection
     * 
     * @param string $sql
     * @return array
     */
    public function makeRequest(string $sql): array
    {
        if ($this->jdbc) {
            throw new Exception('JDBC connection not found');
        }

        $cursor = $this->jdbc->exec($sql);
        $data = $this->jdbc->fetch_array($cursor);
        $this->jdbc->free_result($cursor);

        return $data;
    }
}
