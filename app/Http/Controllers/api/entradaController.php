<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Http\Responses\apiResponses;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrarEntradaRequest;
use App\Models\entrada_mercancia;
use App\Models\producto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class entradaController extends Controller
{
     /**
    * @OA\Get(
    *     path="/api/entrada_mercancia",
    *     tags={"Entrada_mercancia"},
    *     summary="Mostrar entradas",
    *     @OA\Response(
    *         response=200,
    *         description="Mostrar todas las entradas de la tienda.",
    *          @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id_entrada",
     *                         type="number",
     *                         example="3"
     *                     ),
     *                     @OA\Property(
     *                         property="cantidad_unidades",
     *                         type="number",
     *                         example="20"
     *                     ),
     *                     @OA\Property(
     *                         property="id_producto",
     *                         type="number",
     *                         example="20."
     *                     ),
     *                     @OA\Property(
     *                         property="id_pedido",
     *                         type="number",
     *                         example="2"
     *                     ),
     *                     @OA\Property(
     *                         property="id_proveedor",
     *                         type="number",
     *                         example="1"
     *                     )
     *                 )
     *             )
     *         )  
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */
    public function index()
    {
        try {
            $entrada = entrada_mercancia::select('id_entrada', 'cantidad_unidades', 'id_producto', 'id_pedido', "id_proveedor")
            ->with('producto:id_producto,nom_producto', 'proveedor:id_proveedor,nom_proveedor') 
            ->get();
            
            return apiResponses::success("Listado de entradas de mercancia", 200, $entrada);
        } catch (Exception $e){
            return apiResponses::error("algo salio mal".$e->getMessage(),404);
        }
    }

    public function indexPdf()
    {
        try{
            $entrada = entrada_mercancia::all();
            $pdf = PDF::loadView('entrada',['entradas'=> $entrada]);
            return $pdf->download('EntradasReporte.pdf');
        }catch (Exception $e){
            return apiResponses::error("algo salio mal".$e->getMessage(),404);
        }
    }
    /**
     * Registrar entrada
     * @OA\Post(
     *     path="/api/entrada_mercancia",
     *     tags={"Entrada_mercancia"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"cantidad_unidades", "id_producto", "id_pedido", "id_proveedor"},
     *             @OA\Property(
     *                 property="cantidad_unidades",
     *                 type="number",
     *                 example=250
     *             ),
     *             @OA\Property(
     *                 property="id_producto",
     *                 type="number",
     *                 example=1
     *             ),
     *             @OA\Property(
     *                 property="id_pedido",
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
    public function store(RegistrarEntradaRequest $request)
    {
       try{

            $producto = producto::findOrFail($request->id_producto);


            $entradas = entrada_mercancia::create([
                "cantidad_unidades"   => $request -> cantidad_unidades,
                "id_producto"         => $request -> id_producto,
                "id_pedido"           => $request -> id_pedido,
                "id_proveedor"        => $request -> id_proveedor
            ]);

            $producto->increment('unidades_disponibles', $request->cantidad_unidades);

            return apiResponses::success('Entrada registrada ',201, $entradas);
        }catch(ValidationException $e){
            return apiResponses::error('Algo falló al registrar la entrada ',422);
        }
    }

    /**
     * Mostrar una entrada específica.
     * @OA\get(
     *     path="/api/entrada_mercancia/{id_entrada}",
     *     tags={"Entrada_mercancia"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id_entrada",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Entrada retornada exitosamente",
     *         @OA\JsonContent(
     *              @OA\Property(property="id_entrada", type="number", example=3),
     *              @OA\Property(property="cantidad_unidades", type="number", example=20),
     *              @OA\Property(property="id_producto", type="number", example=1),
     *              @OA\Property(property="id_pedido", type="number", example=2),
     *              @OA\Property(property="id_proveedor", type="number", example=1)
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\entrada_mercancia] #id_entrada"),
     *          )
     *      )
     * )
     */
    public function show($id_entrada)
    {
        try{
            $entrada = entrada_mercancia::findOrFail($id_entrada);  
            return apiResponses::success('Entrada retornada exitosamente: ',200, $entrada);
        }catch(ModelNotFoundException $e){
            return apiResponses::error('Fallo al buscar la entrada ',404);
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
