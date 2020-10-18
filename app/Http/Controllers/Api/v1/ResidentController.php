<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Residents\UpdateResidentRequest;
use App\Http\Resources\ResidentResource;
use App\Models\Resident;
use App\Models\Tenant;
use App\Models\User;
use App\Services\PhoneService;
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

    public function phones(string $uuid)
    {
        $resident = Resident::with('user')->where('uuid', $uuid)->first();
        $phones = (new PhoneService())->getPhones($resident->user);

        return response()->json($phones, 200);
    }

    public function phoneUpdate(Request $request, string $uuid)
    {
        $resident = Resident::with('user')->where('uuid', $uuid)->first();
        $update = (new PhoneService())->update($request->all(), $resident->user);

        if ($update) {
            return response()->json([
                'status' => 'success',
                'message' => 'Registro alterado com sucesso'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Erro para alterar o registro'
        ], 400);

    }

    public function phoneStore(Request $request)
    {
        $resident = Resident::with('user')->where('uuid', $request->uuid)->first();
        $store = (new PhoneService())->make($request->all(), $resident->user);

        if ($store) {
            return response()->json([
                'status' => 'success',
                'message' => 'Cadastro realizado com sucesso'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Erro para realizar o cadastro'
        ], 400);
    }
}
