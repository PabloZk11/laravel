<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuardarCategoriaRequest;
use App\Http\Requests\updateCategoriaRequest;
use App\Http\Responses\apiResponses;
use App\Models\categoria_productos;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class categoriaController extends Controller
{
    /**
     * Listado de las categorías de productos que ofrece la tienda.
     * @OA\Get(
     *     path="/api/categoria_productos",
     *     tags={"Categoria"},     
     *     @OA\Response(
     *         response=200,
     *         description="Lista de categorías",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id_categoria",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="nombre_categoria",
     *                         type="string",
     *                         example="Cuadernos"
     *                     ),
     *                     @OA\Property(
     *                         property="descripcion",
     *                         type="string",
     *                         example="Descripción que puede ser cuadernos, lápices, etc."
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     **/
    public function index()
    {
        try{
            $categorias = categoria_productos::all();
            return  apiResponses::success('Lista de categorias',205,$categorias);
        } catch(Exception $e){
            return apiResponses::error('Algo salió mal al llamar las categorías '.$e->getMessage(),500);
        }
    }

        /**
     * Registrar entrada
     * @OA\Post(
     *     path="/api/categoria_productos",
     *     tags={"Categoria"},     
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"nombre_categoria", "descripcion"},
     *             @OA\Property(
     *                 property="nombre_categoria",
     *                 type="string",
     *                 example="Categoria de tijeras (ejemplo)."
     *             ),
     *             @OA\Property(
     *                 property="descripcion",
     *                 type="string",
     *                 example="Describiendo algún aspecto importante de la categoría tijeras."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Categoría registrada exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Categoría registrada exitosamente"),
     *             @OA\Property(property="code", type="integer", example=201),
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Datos de entrada no válidos",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Algo falló al intentar registrar la categoría"),
     *             @OA\Property(property="code", type="integer", example=422)
     *         )
     *     )
     * )
     */
    public function store(GuardarCategoriaRequest $request)
    {
        try{
            $categorias = categoria_productos::create([
                "nombre_categoria"  => $request -> nombre_categoria,
                "descripcion"  => $request -> descripcion
            ]);
            return apiResponses::success('Categoria registrada exitosamente',201, $categorias);
        }catch(ValidationException $e){
            return apiResponses::error('Algo falló al intentar registrar la categoría ',422);
        }
    }

    /**
     * Mostrar la información de un pedido en específico.
     * @OA\get(
     *     path="/api/categoria_productos/{id_categoria}",
     *     tags={"Categoria"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id_categoria",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Categoría retornado exitosamente",
     *         @OA\JsonContent(
     *              @OA\Property(property="id_categoria", type="number", example=3),
     *              @OA\Property(property="nombre_categoria", type="string", example="Nombre de categoría ejemplo lápices"),
     *              @OA\Property(property="descripcion", type="string", example="Describiendo la categoría ejemplo lápices")
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Pedido] #id_pedido"),
     *          )
     *      )
     * )
     */
    public function show($id_categoria)
    {
        try{
            $categorias = categoria_productos::findOrFail($id_categoria);
            return apiResponses::success('Categoria retornada exitosamente: ',200, $categorias);
        }catch(ModelNotFoundException $e){
            return apiResponses::error('Fallo al buscar la categoría ',404);
        }
    }

    /**
     * Actualizar categoría existente
     * @OA\Put(
     *     path="/api/categoria_productos/{id_categoria}",
     *     tags={"Categoria"},
     *     summary="Actualizar categoría",
     *     @OA\Parameter(
     *         name="id_categoria",
     *         in="path",
     *         description="ID de la categoría a actualizar",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="nombre_categoria",
     *                 type="string",
     *                 example="Nuevo nombre de categoría"
     *             ),
     *             @OA\Property(
     *                 property="descripcion",
     *                 type="string",
     *                 example="Nueva descripción de la categoría"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Categoría actualizada exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Categoría actualizada exitosamente"),
     *             @OA\Property(property="code", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Categoría no encontrada",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="La categoría no fue encontrada"),
     *             @OA\Property(property="code", type="integer", example=404)
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Datos de entrada no válidos",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Algo falló al actualizar la categoría"),
     *             @OA\Property(property="code", type="integer", example=422)
     *         )
     *     )
     * )
     **/
    public function update(updateCategoriaRequest $request,  $id_categoria)
    {
        try{                  
            $categoria = categoria_productos::findOrFail($id_categoria);
            $request->validate([
                'nombre_categoria' => ['required',Rule::unique('categoria_productos')->ignore($categoria)],
                'descripcion' => ['required',Rule::unique('categoria_productos')->ignore($categoria)]
            ]);
            $categoria->update($request->all());
            return apiResponses::success('Categoría actualizada correctamente',200,$categoria);
        }catch(ModelNotFoundException $e){
            return apiResponses::error('Categoria no encontrada',404);
        }catch (ValidationException $e) {
            return apiResponses::error('Error de validación: ' . $e->getMessage(), 422);
        }catch(Exception $e){
            return apiResponses::error('Error: '.$e->getMessage(),422);
        }
    }

    /**
     * Eliminar una categoría existente
     * @OA\Delete(
     *     path="/api/categoria_productos/{id_categoria}",
     *     tags={"Categoria"},
     *     summary="Eliminar categoría",
     *     @OA\Parameter(
     *         name="id_categoria",
     *         in="path",
     *         description="ID de la categoría a eliminar",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Categoría eliminada exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Categoría eliminada exitosamente"),
     *             @OA\Property(property="code", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Categoría no encontrada",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="La categoría no fue encontrada"),
     *             @OA\Property(property="code", type="integer", example=404)
     *         )
     *     )
     * )
     **/
    public function destroy( $id_categoria)
    {
        try{
            $categorias = categoria_productos::findOrFail($id_categoria); 
            $categorias->DELETE();
            return apiResponses::success('categoría eliminada exitosamente', 200);
        }catch(ModelNotFoundException $e){
            return apiResponses::error('error al eliminar la categoría',404);
        }
    }
}
