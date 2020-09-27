<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = (new RoleService())->list();

        return response()->json($roles, 200);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
