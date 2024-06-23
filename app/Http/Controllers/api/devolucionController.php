<?php

namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;
use App\Http\Requests\GuardarDevolucionRequest;
use App\Http\Requests\ActualizarDevolucionRequest;
use Illuminate\Http\Request;
use Exception;
use App\Http\Responses\apiResponses;
use App\Models\devolucion;
use App\Models\usuario;
use Barryvdh\DomPDF\Facade\Pdf;

class devolucionController extends Controller
{
    /**
     * Listado de todos los registros de devoluciones
     * @OA\Get (
     *     path="/api/devolucion",
     *     tags={"Devolucion"},
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
     *                         property="id_devolucion",
     *                         type="number",
     *                         example="2"
     *                     ),
     *                    
     *               
     *                     @OA\Property(
     *                         property="id_producto",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                        
     *                     @OA\Property(
     *                         property="unidades",
     *                         type="number",
     *                         example="20"
     *                     ),
     *                    
     *                     @OA\Property(
     *                         property="id_entrada_devolucion",
     *                         type="number",
     *                         example="2"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        try{
            $devolucion = devolucion::select('id_devolucion', 'id_producto', 'unidades', 'id_entrada')
            ->with('producto:id_producto,nom_producto') 
            ->get();
            
            return apiResponses::success("Listado de devoluciones", 200, $devolucion);
        }catch (Exception $e){
            return apiResponses::error("algo salio mal".$e->getMessage(),404);
        }
    }

    public function indexPdf()
    {
        try{
            $devolucion = devolucion::all();
            $pdf = PDF::loadView('devolucion',['devoluciones'=> $devolucion]);
            return $pdf->download('DevolucionReporte.pdf');
        }catch (Exception $e){
            return apiResponses::error("algo salio mal".$e->getMessage(),404);
        }
    }

    /**
     * Listado de todos los registros de devoluciones
     * @OA\Post (
     *     path="/api/devolucion",
     *     tags={"Devolucion"},
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
     *                         property="id_devolucion",
     *                         type="number",
     *                         example="2"
     *                     ),
     *                    
     *               
     *                     @OA\Property(
     *                         property="id_producto",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                        
     *                     @OA\Property(
     *                         property="unidades",
     *                         type="number",
     *                         example="20"
     *                     ),
     *                    
     *                     @OA\Property(
     *                         property="id_entrada_devolucion",
     *                         type="number",
     *                         example="2"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function store(GuardarDevolucionRequest $request)
    {
        try{
            $devolucion = devolucion::create([
                "id_producto" => $request -> id_producto,
                "unidades" => $request -> unidades,
                "id_entrada"  => $request -> id_entrada
            ]);
            return apiResponses::success('devolucion guardada exitosamente',201, $devolucion);
        }catch(ValidationException $e){
            return apiResponses::error('Algo falló al intentar guardar la devolucion ',422);
        }
    }

        /**
     * Mostrar la información de una devolucion
     * @OA\Get (
     *     path="/api/devolucion/{id_devolucion}",
     *     tags={"Devolucion"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id_devolucion", type="number", example=1),
     *              @OA\Property(property="id_producto", type="number", example="1"),
     *              @OA\Property(property="unidades", type="number", example="10"),
     *              @OA\Property(property="id_entrada_devolucion", type="number", example="2")
     *              
     *             
     *             
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\factura_salida] #id_factura_salida"),
     *          )
     *      )
     * )
     */
    public function show(string $id_devolucion)
    {
        try{
            $devolucion = devolucion::findOrFail($id_devolucion);  
            return apiResponses::success('devolucion retornado exitosamente: ',200, $devolucion);
        }catch(ModelNotFoundException $e){
            return apiResponses::error('Fallo al buscar la devolucion ',404);
        }
    }


    public function update(ActualizarDevolucionRequest $request, devolucion $id_devolucion)
    {
        try{                  
           
            $id_devolucion->update($request->all());
            return apiResponses::success('Devolución actualizada correctamente',200,$id_devolucion);
        }catch(ModelNotFoundException $e){
            return apiResponses::error('Devolución no encontrada',404);
        }catch (ValidationException $e) {
            return apiResponses::error('Error de validación: ' . $e->getMessage(), 422);
        }catch(Exception $e){
            return apiResponses::error('Error: '.$e->getMessage(),422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
