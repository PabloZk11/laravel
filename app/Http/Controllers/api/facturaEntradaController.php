<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Http\Responses\apiResponses;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrarFacturaEntradaRequest;
use App\Models\factura_entrada;
use Illuminate\Http\Request;

class facturaEntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $factura_entrada = factura_entrada::all();
            return  apiResponses::success('Facturas de entrada: ',205,$factura_entrada);
        } catch(Exception $e){
            return apiResponses::error('Algo salió mal al retornar las facturas de entrada '.$e->getMessage(),500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistrarFacturaEntradaRequest $request)
    {
       try{
            $factura_entradas = factura_entrada::create([
                "unidades"            => $request -> unidades,
                "precio_unitario"                => $request -> precio_unitario,
                "precio_total"                   => $request -> precio_total,
                "fecha"               => $request -> fecha,
                "id_proveedor"               => $request -> id_proveedor,
                "producto_id_producto"               => $request -> producto_id_producto,
            ]);
            return apiResponses::success('Entrada registrada ',201, $factura_entradas);
        }catch(ValidationException $e){
            return apiResponses::error('Algo falló al registrar la entrada ',422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_factura_entrada)
    {
        try{
            $factura_entrada = factura_entrada::findOrFail($id_factura_entrada);  
            return apiResponses::success('Entrada retornada exitosamente: ',200, $factura_entrada);
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
