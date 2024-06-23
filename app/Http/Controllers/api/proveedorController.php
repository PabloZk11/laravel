<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuardarProveedorRequest;
use App\Http\Requests\UpdateProveedorRequest;
use App\Http\Responses\apiResponses;
use App\Models\proveedor;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class proveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $proveedores = proveedor::all();
            return  apiResponses::success('Lista de proveedores: ',205,$proveedores);
        } catch(Exception $e){
            return apiResponses::error('Algo salió mal al llamar las categorías '.$e->getMessage(),500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuardarProveedorRequest $request)
    {
        try{
            $proveedores = proveedor::create([
                "productos"  => $request -> productos,
                "doc_proveedor"  => $request -> doc_proveedor
            ]);
            return apiResponses::success('Categoria registrada exitosamente',201, $proveedores);
        }catch(ValidationException $e){
            return apiResponses::error('Algo falló al intentar registrar la categoría ',422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_categoria
     * @return \Illuminate\Http\Response
     */
    public function show($id_proveedor)
    {
        try{
            $proveedores = proveedor::findOrFail($id_proveedor);
            return apiResponses::success('Proveedor : ',200, $proveedores);
        }catch(ModelNotFoundException $e){
            return apiResponses::error('Fallo al buscar el proveedor ',404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProveedorRequest $request,  $id_proveedor )
    {
        try{                  
            $proveedor = proveedor::findOrFail($id_proveedor);
            $request->validate([
                'productos' => ['required',Rule::unique('proveedors')->ignore($proveedor)]
            ]);
            $proveedor->update($request->all());
            return apiResponses::success('Categoría actualizada correctamente',200,$proveedor);
        }catch(ModelNotFoundException $e){
            return apiResponses::error('Proveedor no encontrado',404);
        }catch (ValidationException $e) {
            return apiResponses::error('Error de validación: ' . $e->getMessage(), 422);
        }catch(Exception $e){
            return apiResponses::error('Error: '.$e->getMessage(),422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id_categoria)
    {
    //        
    }
}
