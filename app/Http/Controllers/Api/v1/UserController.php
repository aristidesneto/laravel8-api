<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = (new UserService())->list();

        return response()->json($users, 200);
    }

    public function store(Request $request)
    {
        $create = (new UserService())->make($request->all());

        if ($create) {
            return response()->json([
                'status' => 'success',
                'message' => 'Usuário cadastrado com sucesso'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Erro para cadastrar o usuário'
        ], 400);
    }

    public function show(string $uuid)
    {
        $user = (new UserService())->show($uuid);

        if ($user) {
            return response()->json($user, 200);
        }

        return response()->json(['message' => 'Usuário não encontrado'], 404);

    }

    public function update(Request $request, string $uuid)
    {
        $update = (new UserService())->update($request->all(), $uuid);

        if ($update) {
            return response()->json([
                'status' => 'success',
                'message' => 'Usuário atualizado com sucesso'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Erro para atualizar o usuário'
        ], 400);
    }

    public function destroy(string $uuid)
    {
        $delete = (new UserService())->delete($uuid);

        if ($delete) {
            return response()->json([
                'status' => 'success',
                'message' => 'Usuário removido com sucesso'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Erro para remover o usuário'
        ], 400);
    }
}
