<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\TenantService;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    protected TenantService $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    public function index()
    {
        $tenants = $this->tenantService->list();

        return response()->json($tenants, 200);
    }

    public function store(Request $request)
    {
        $create = $this->tenantService->make($request->all());

        if ($create) {
            return response()->json([
                'status' => 'success',
                'message' => 'Registro cadastrado com sucesso'
            ], 201);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Erro para realizar o cadastro'
        ], 400);
    }

    public function show(string $uuid)
    {
        $tenant = $this->tenantService->show($uuid);

        if ($tenant) {
            return response()->json($tenant, 200);
        }

        return response()->json([], 404);
    }

    public function update(Request $request, string $uuid)
    {
        $update = $this->tenantService->update($request->all(),$uuid);

        if ($update) {
            return response()->json([
                'status' => 'success',
                'message' => 'Dados atualizados com sucesso'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Erro para atualizar os dados'
        ], 400);
    }

    public function destroy(string $uuid)
    {
        $delete = $this->tenantService->delete($uuid);

        if ($delete) {
            return response()->json([
                'status' => 'success',
                'message' => 'Registro removido com sucesso'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Erro para remover o registro'
        ], 400);
    }
}
