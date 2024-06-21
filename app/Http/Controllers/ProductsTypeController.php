<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductTypeRequest;
use App\Http\Requests\ProductTypesUpdateRequest;
use App\Models\ProductsType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsTypeController extends Controller
{
    public function create(ProductTypeRequest $request)
    {
        try {
            DB::beginTransaction();
            $productsType = new ProductsType();
            $productsType->type = $request->type;
            $productsType->length = $request->length;
            $productsType->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'errors' => [
                    'message' => $e->getMessage()
                ]
            ], 500);
        }
    }

    public function getAll()
    {
        try {
            $listProductsType = ProductsType::all();

            return response()->json([
                'products' => $listProductsType
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
            $productById = ProductsType::find($id);

            if (!$productById) {
                throw new Exception('Produto nao encontrado');
            }

            return response()->json([
                'product' => $productById,
                'message' => 'Produto encontrado com sucesso'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'errors' => [
                    'default' => $e->getMessage()
                ]
            ], 500);
        }
    }

    public function updateById(ProductTypesUpdateRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $productUpdated = ProductsType::find($id);

            if (!$productUpdated) throw new Exception('Produto nao encontrado.');

            $productUpdated->type = $request->type ? $request->type : $productUpdated->type;
            $productUpdated->length = $request->length ? $request->length : $productUpdated->length;

            $productUpdated->update();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Produto atualizado com sucesso'
            ], 200);
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

            $productDeleted = ProductsType::find($id);

            if (!$productDeleted) throw new Exception('Produto nao encontrado');

            $productDeleted->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Produto removido com sucesso'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'errors' => [
                    'defautl' => $e->getMessage()
                ]
            ], 500);
        }
    }
}
