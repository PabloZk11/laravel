<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Http\Responses\apiResponses;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\GuardarPedidoRequest;
use App\Models\pedido;
use App\Models\producto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class pedidoController extends Controller
{
    /**
     * Listado de los pedidos realizados por la tienda.
     * @OA\Get (
     *     path="/api/pedido",
     *     tags={"Pedido"},     
     *     @OA\Response(
     *         response=200,
     *         description="Lista de pedidos",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id_pedido",
     *                         type="number",
     *                         example="2"
     *                     ),
     *                     @OA\Property(
     *                         property="unidades",
     *                         type="number",
     *                         example="20"
     *                     ),
     *                     @OA\Property(
     *                         property="id_producto",
     *                         type="number",
     *                         example="1"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     **/
    public function index()
    {
        try {
            $pedido = pedido::select("id_pedido", "unidades", "id_producto", "id_usuario","id_proveedor")
            ->with('producto:id_producto,nom_producto', 'usuario:id_usuario,nombre' , 'proveedor:id_proveedor,nom_proveedor') 
            ->get();
            
            return apiResponses::success("Listado de pedidos", 200, $pedido);
        } catch (Exception $e){
            return apiResponses::error("algo salio mal".$e->getMessage(),404);
        }
    }

    public function indexPdf()
    {
        try{
            $pedido = pedido::all();
            $pdf = PDF::loadView('pedido',['pedidos'=> $pedido]);
            return $pdf->download('pedidosReporte.pdf');
        }catch (Exception $e){
            return apiResponses::error("algo salio mal".$e->getMessage(),404);
        }
    }

    /**
     * Realizar o crear nuevo pedido
     * @OA\Post(
     *     path="/api/pedido",
     *     tags={"Pedido"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"unidades", "id_producto", "id_admin", "id_proveedor"},
     *             @OA\Property(
     *                 property="unidades",
     *                 type="number",
     *                 example=20
     *             ),
     *             @OA\Property(
     *                 property="id_producto",
     *                 type="number",
     *                 example=1
     *             ),
     *             @OA\Property(
     *                 property="id_admin",
     *                 type="number",
     *                 example=2
     *             ),
     *             @OA\Property(
     *                 property="id_proveedor",
     *                 type="number",
     *                 example=1
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Pedido creado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Pedido guardado exitosamente"),
     *             @OA\Property(property="code", type="integer", example=201),
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Datos de entrada no válidos",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Algo falló al intentar guardar el pedido"),
     *             @OA\Property(property="code", type="integer", example=422)
     *         )
     *     )
     * )
     */
    public function store(GuardarPedidoRequest $request)
    {
       try{
            $pedidos = pedido::create([
                "unidades"                   => $request -> unidades,
                "id_producto"                => $request -> id_producto,
                "id_usuario"                   => $request -> id_usuario,
                "id_proveedor"               => $request -> id_proveedor
            ]);
            return apiResponses::success('Pedido guardado exitosamente',201, $pedidos);
        }catch(ValidationException $e){
            return apiResponses::error('Algo falló al intentar guardar el pedido ',422);
        }
    }

     /**
     * Mostrar la información de un pedido en específico.
     * @OA\get(
     *     path="/api/pedido/{id_pedido}",
     *     tags={"Pedido"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id_pedido",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pedido retornado exitosamente",
     *         @OA\JsonContent(
     *              @OA\Property(property="id_pedido", type="number", example=2),
     *              @OA\Property(property="unidades", type="number", example=20),
     *              @OA\Property(property="id_producto", type="number", example=1),
     *              @OA\Property(property="id_admin", type="number", example=2),
     *              @OA\Property(property="id_proveedor", type="number", example=1)
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
    public function show($id_pedido)
    {
        try{
            $pedidos = pedido::findOrFail($id_pedido);  
            return apiResponses::success('Pedido retornado exitosamente: ',200, $pedidos);
        }catch(ModelNotFoundException $e){
            return apiResponses::error('Fallo al buscar el pedido ',404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
