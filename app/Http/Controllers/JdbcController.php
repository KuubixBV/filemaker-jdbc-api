<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Interfaces\JdbcRepoInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class JdbcController extends BaseController
{
    public function __construct(
        protected JdbcRepoInterface $jdbcRepo
    ) {
    }

    /**
     * Proxy data from the JDBC connection
     *
     * @param Request $request
     * @return JsonResponse 
     */
    public function proxyData(Request $request): JsonResponse
    {
        $sql = $request->input('sql') ?? null;

        if (!$sql) {
            return response()->json([
                'error' => 'SQL query not provided'
            ]);
        }

        try {
            $data = $this->jdbcRepo->makeRequest($sql);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }

        return response()->json($data);
    }
}
