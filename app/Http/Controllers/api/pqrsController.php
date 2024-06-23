<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Http\Responses\apiResponses;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\pqrsRequest;
use Illuminate\Http\Request;
use App\Models\pqrs;

class pqrsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $pqrs = pqrs::all();
            return  apiResponses::success('Preguntas, quejas, reclamos, solicitudes: ',205,$pqrs);
        } catch(Exception $e){
            return apiResponses::error('Algo salió mal al retornar las pqrs '.$e->getMessage(),500);
        }
    }



    public function store(pqrsRequest $request)
    {
        try{
            $pqrs = pqrs::create([
                "pqrs_descripcion" => $request -> pqrs_descripcion,
                "id_usuario_pqrs" => $request -> id_usuario_pqrs,
                "id_rol_pqrs" => $request -> id_rol_pqrs
            ]);
            return apiResponses::success('Pqrs enviado.',201, $pqrs);
            }catch (ValidationException $e) {
                return apiResponses::error("Algo falló al enviar el pqrs.",404);
            }
        }


    public function show($id_pqrs)
        {
            try{
                $pqrs = pqrs::findOrFail($id_pqrs);
                return apiResponses::success('pqrs retornado exitosamente: ',200, $pqrs);
            }catch(ModelNotFoundException $e){
                return apiResponses::error('Fallo al buscar el pqrs ',404);
            }
        }
}
