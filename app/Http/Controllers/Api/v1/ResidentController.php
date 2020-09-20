<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Residents\UpdateResidentRequest;
use App\Http\Resources\ResidentResource;
use App\Models\Resident;
use App\Models\Tenant;
use App\Models\User;
use App\Services\ResidentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResidentController extends Controller
{
    protected ResidentService $residentService;

    public function __construct(ResidentService $residentService)
    {
        $this->residentService = $residentService;
    }

    public function index()
    {
        $residents = $this->residentService->list();

        return response()->json($residents, 200);
    }

    public function store(Request $request)
    {
        $create = $this->residentService->make($request->all());

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
        $resident = $this->residentService->show($uuid);

        if ($resident) {
            return response()->json($resident, 200);
        }

        return response()->json([], 404);
    }


    public function update(UpdateResidentRequest $request, string $uuid)
    {
        $update = $this->residentService->update($request->all(), $uuid);

        if ($update) {
            return response()->json([
                'status' => 'success',
                'message' => 'Dados do morador alterado com sucesso'
            ], 200);
        }

        return response()->json([
                'status' => 'error',
                'message' => 'Erro para alterar os dados do morador'
            ], 400);
    }

    public function destroy(string $uuid)
    {
        $delete = $this->residentService->delete($uuid);

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
