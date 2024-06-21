<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function getAll()
    {
        try {
            $listUser = User::all();
            return response()->json([
                'usuarios' => $listUser
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'errors' => [
                    'default' => $e->getMessage()
                ]
            ], 500);
        }
    }

    public function create(UserRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $user = new User();
            $user->name = $request->name;
            $user->password = $request->password;
            $user->email = $request->email;
            $user->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Usuario cadastrado com sucesso'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'errors' => [
                    'default' => $e->getMessage()
                ]
            ], 500);
        }
    }

    public function getById($id)
    {
        try {
            $userBuscado = User::find($id);

            if (!$userBuscado) {
                throw new Exception('Usuario nao cadastrado', 400);
            }

            return response()->json([
                'usuario' => $userBuscado,
                'message' => 'Usuario encontrado com sucesso'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'errors' => [
                    'default' => $e->getMessage()
                ]
            ]);
        }
    }

    public function updateById(UpdateRequest $request, $id)
    {
        $validated = $request->validated();
        try {
            DB::beginTransaction();

            $user = User::find($id);

            if (!$user) {
                throw new Exception('Usuario nao esta cadastrado');
            }

            $user->name = $request->name ? $request->name : $user->name;
            $user->email = $request->email ? $request->email : $user->email;

            $user->update();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Dados do usuario atualizados'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'errors' => [
                    'default' => $e->getMessage()
                ]
            ], 500);
        }
    }

    public function deleteById($id)
    {
        try {
            DB::beginTransaction();

            $userDeletado = User::find($id);
            if (!$userDeletado) {
                throw new Exception('Usuario nao esta cadastrado');
            }

            $userDeletado->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Usuario removido com sucesso'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'errors' => [
                    'default' => $e->getMessage()
                ]
            ], 500);
        }
    }
}
