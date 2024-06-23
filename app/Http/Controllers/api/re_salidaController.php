<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\api\productoController;
use App\Models\producto;
use App\Models\registro_salida;
use App\Http\Requests\GuardarSalidaRequest;
use Exception;
use Illuminate\Validation\ValidationException;
use App\Http\Responses\apiResponses;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class re_salidaController extends Controller
{
/**
     * Muestra la informacion de las salidas (venta)
     * @OA\Get (
     *     path="/api/salida",
     *     tags={"Registro_salida"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id_salida",
     *                         type="int",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="unidades",
     *                         type="int",
     *                         example="5"
     *                     ),
     *                     @OA\Property(
     *                         property="id_factura_salida",
     *                         type="int",
     *                         example="8"
     *                     ),
     *                     @OA\Property(
     *                         property="id_producto",
     *                         type="int",
     *                         example="3"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        try {
            $registro_salida = registro_salida::select('id_salida', 'unidades', 'id_factura_salida', "id_producto")
            ->with('producto:id_producto,nom_producto') // Selecciona todas las columnas de producto
            ->get();
            
            return apiResponses::success("Listado de ventas", 200, $registro_salida);
        } catch (Exception $e){
            return apiResponses::error("Algo salió mal: " . $e->getMessage(), 404);
        }
    }
    
    public function indexPdf()
    {
        try{
            $registro_salida = registro_salida::select('id_salida', 'unidades', 'id_factura_salida', 'id_producto')->get();
            $pdf = PDF::loadView('re_salida',['registro_salidas'=> $registro_salida]);
            return $pdf->download('registro_salidaReporte.pdf');
        }catch (Exception $e){
            return apiResponses::error("algo salio mal".$e->getMessage(),404);
        }
    }
    
    

/**
     * Ingresa la informacion de una salida (venta)
     * @OA\Post (
     *     path="/api/salida",
     *     tags={"Registro_salida"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id_salida",
     *                         type="int",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="unidades",
     *                         type="int",
     *                         example="5"
     *                     ),
     *                     @OA\Property(
     *                         property="id_factura_salida",
     *                         type="int",
     *                         example="8"
     *                     ),
     *                     @OA\Property(
     *                         property="id_producto",
     *                         type="int",
     *                         example="3"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function store(GuardarSalidaRequest $request)
    {
        try{

            $producto = producto::findOrFail($request->id_producto);

            // Verificar si hay suficiente stock
            if ($producto->unidades_disponibles < $request->unidades) {
                return response()->json(['error' => 'No hay suficiente unidades disponibles'], 400);
            }

            $registro_salida = registro_salida::create([
                "unidades" => $request -> unidades,
                "id_factura_salida" => $request -> id_factura_salida,
                "id_producto" => $request -> id_producto,
            ]);

            $producto->decrement('unidades_disponibles', $request->unidades);

            return apiResponses::success('salida guardada exitosamente',201, $registro_salida);
            }catch (ValidationException $e) {
                return apiResponses::error("Algo fallo al guardar la salida",404);
            }
        }

 /**
     * Mostrar la información de una unica salida (venta)
     * @OA\Get (
     *     path="/api/salida/{id}",
     *     tags={"Registro_salida"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id_salida",
     *         required=true,
     *         @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id_salida", type="int", example=1),
     *              @OA\Property(property="unidades", type="int", example="5"),
     *              @OA\Property(property="id_factura_salida", type="int", example="8"),
     *              @OA\Property(property="id_producto", type="int", example="3")
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Cliente] #id"),
     *          )
     *      )
     * )
     */
    public function show($id_salida)
    {
        try{
            $registro_salida = registro_salida::findOrFail($id_salida);  
            return apiResponses::success('salida retornada exitosamente: ',200, $registro_salida);
        }catch(ModelNotFoundException $e){
            return apiResponses::error('Fallo al buscar la salida ',404);
        }
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
