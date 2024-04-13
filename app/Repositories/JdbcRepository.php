<?php

namespace App\Repositories;

use App\Interfaces\JdbcRepoInterface;
use Illuminate\Support\Facades\App;
use App\Interfaces\JdbcInterface;
use Exception;

use Illuminate\Support\Facades\Log;

class JdbcRepository implements JdbcRepoInterface
{
    protected JdbcInterface $jdbc;

    public function __construct()
    {
        $provider = App::make('jdbc');

        if ($provider) {
            $this->jdbc = App::make('jdbc');
        }
    }

    /**
     * Make a request to the JDBC connection
     *
     * @param string $sql
     * @return mixed
     */
    public function makeRequest(string $sql): mixed
    {
        Log::info('JDBC request: ' . $sql);
        if (!isset($this->jdbc)) {
            throw new Exception('JDBC connection not found');
        }

        $cursor = $this->jdbc->exec($sql);

        if (!$cursor) {
            throw new Exception('Error executing query');
        }

        $allData = [];
        $data = $this->jdbc->fetch_array($cursor);
        while ($data) {
            array_push($allData, $data);
            $data = $this->jdbc->fetch_array($cursor);
        }

        $this->jdbc->free_result($cursor);

        if (count($allData) === 1) {
            return $allData[0];
        }

        return $allData;
    }
}
