<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Controller\Exception;
use App\Http\Requests\facturaUpdate;
use App\Http\Resources\GuardarFacturaRequest;
use App\Http\Responses\apiResponses;
use App\Models\factura_salida;

class facturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $factura_salida = factura_salida::all();
            return  apiResponses::success('Listado de facturas: ',205,$factura_salida);            
        } catch(Exception $e){
            return apiResponses::error('Algo salió mal al llamar las facturas '.$e->getMessage(),500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $factura_salida = factura_salida::create([
                "Cantidad" => $request -> Cantidad,
                "Precio_unitario" => $request -> Precio_unitario,
                "fecha" => $request -> fecha,
                "id_producto"=> $request -> id_producto,
                "id_vendedor"=> $request -> id_vendedor,

     
              
            ]);
            return apiResponses::success('devolucion guardada exitosamente',201, $factura_salida);
        }catch(ValidationException $e){
            return apiResponses::error('Algo falló al intentar guardar la devolucion ',422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $Id_factura_salida)
    {
        try{
            $factura_salida = factura_salida::findOrFail($Id_factura_salida);  
            return apiResponses::success('salida retornada exitosamente: ',200, $Id_factura_salida);
        }catch(ModelNotFoundException $e){
            return apiResponses::error('Fallo al buscar la salida ',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(facturaUpdate $request, factura_salida $Id_factura_salida)
    {
        try{                  
           
            $Id_factura_salida->update($request->all());
            return apiResponses::success('factura actualizada correctamente',200,$Id_factura_salida);
        }catch(ModelNotFoundException $e){
            return apiResponses::error('factura no encontrada',404);
        }catch (ValidationException $e) {
            return apiResponses::error('Error de validación: ' . $e->getMessage(), 422);
        }catch(Exception $e){
            return apiResponses::error('Error: '.$e->getMessage(),422);
        }

        $Id_factura_salida->update($request->all());
        return response()->json([
            "res" => true,
            "mensaje" => "factura Actualizado"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
