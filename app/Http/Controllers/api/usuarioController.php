<?php

namespace App\Http\Controllers\api;
use Exception;
use Illuminate\Validation\ValidationException;
use App\Http\Responses\apiResponses;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\usuario;
use App\Http\Requests\postUsuario;
use App\Http\Requests\updUsuario;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;


class usuarioController extends Controller
{
/**
     * Listados de todos los usuarios
     * @OA\Get (
     *     path="/api/usuario",
     *     tags={"Usuarios"},
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
     *                         property="id_usuario",
     *                         type="int",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="nombre",
     *                         type="string",
     *                         example="Andra Roman"
     *                     ),
     *                     @OA\Property(
     *                         property="email",
     *                         type="string",
     *                         example="andrroman@gmail.com"
     *                     ),
     *                     @OA\Property(
     *                         property="contraseña",
     *                         type="varbinary",
     *                         example="ASDAGFAFAGEGEW"
     *                     ),
     *                     @OA\Property(
     *                         property="rol_usuario",
     *                         type="int",
     *                         example="2"
     *                     ),
     *   *                     @OA\Property(
     *                         property="tdoc_proveedor",
     *                         type="int",
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
            $usuario = usuario::select('id_usuario', 'nombre', 'email', 'id_rol', "id_documento")
            ->with('roles:id_rol,nombre_rol', 'documento_ident:id_documento,tipo_documento') // Selecciona todas las columnas de producto
            ->get();
            
            return apiResponses::success("Listado de usuarios", 200, $usuario);
        }catch (Exception $e){
            return apiResponses::error("algo salio mal".$e->getMessage(),404);
        }
    }

    public function indexPdf()
    {
        try{
            $usuario = usuario::select('id_usuario', 'nombre', 'email', 'id_usuario', "id_rol")->get();
            $pdf = PDF::loadView('usuario',['usuarios'=> $usuario]);
            return $pdf->download('usuarioReporte.pdf');
        }catch (Exception $e){
            return apiResponses::error("algo salio mal".$e->getMessage(),404);
        }
    }

/**
     * Ingreso de un usuario al sistema
     * @OA\Post (
     *     path="/api/usuario",
     *     tags={"Usuarios"},
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
     *                         property="id_usuario",
     *                         type="int",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="nombre",
     *                         type="string",
     *                         example="Andra Roman"
     *                     ),
     *                     @OA\Property(
     *                         property="email",
     *                         type="string",
     *                         example="andrroman@gmail.com"
     *                     ),
     *                     @OA\Property(
     *                         property="contraseña",
     *                         type="varbinary",
     *                         example="ASDAGFAFAGEGEW"
     *                     ),
     *                     @OA\Property(
     *                         property="rol_usuario",
     *                         type="int",
     *                         example="2"
     *                     ),
     *   *                     @OA\Property(
     *                         property="tdoc_proveedor",
     *                         type="int",
     *                         example="2"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
    */
    public function store(postUsuario $request)
    {
        try{
            $usuario = usuario::create([
                'nombre' => $request-> nombre,
                'email' => $request-> email,
                'contraseña' => Hash::make($request->contraseña), 
                "id_rol" => $request-> id_rol,
                'id_documento' => $request-> id_documento,
            ]);
            return apiResponses::success('Usuario guardado exitosamente',201, $usuario);
        }catch(Exception $e){
            return apiResponses::error("algo salio mal".$e->getMessage(),404);
        }
    }

/**
     * Mostrar la información de un solo usuario
     * @OA\Get (
     *     path="/api/usuario/{id}",
     *     tags={"Usuarios"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id_usuario",
     *         required=true,
     *         @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id_usuario", type="int", example=1),
     *              @OA\Property(property="nombre", type="string", example="Andra Carmon"),
     *              @OA\Property(property="email", type="string", example="andrroman@gmail.com"),
     *              @OA\Property(property="contraseña", type="int", example="ASDAGFAFAGEGEW"),
     *              @OA\Property(property="rol_usuario", type="string", example="2"),
     *              @OA\Property(property="tdoc_usuario", type="int", example="1")
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
    public function show($id_usuario)
    {
        try {
            $usuario = Usuario::select('id_usuario', 'nombre', 'email', 'rol_usuario', 'tdoc_usuario')->findOrFail($id_usuario);
            return apiResponses::success('Usuario retornado exitosamente: ', 200, $usuario);
        } catch (ModelNotFoundException $e) {
            return apiResponses::error('Fallo al buscar el usuario', 404);
        }
    }


/**
     * Actualizar informacion de un usuario
     * @OA\Put (
     *     path="/api/usuario",
     *     tags={"Usuarios"},
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
     *                         property="id_usuario",
     *                         type="int",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="nombre",
     *                         type="string",
     *                         example="Andra Roman"
     *                     ),
     *                     @OA\Property(
     *                         property="email",
     *                         type="string",
     *                         example="andrroman@gmail.com"
     *                     ),
     *                     @OA\Property(
     *                         property="contraseña",
     *                         type="varbinary",
     *                         example="ASDAGFAFAGEGEW"
     *                     ),
     *                     @OA\Property(
     *                         property="rol_usuario",
     *                         type="int",
     *                         example="2"
     *                     ),
     *   *                     @OA\Property(
     *                         property="tdoc_proveedor",
     *                         type="int",
     *                         example="2"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function update(updUsuario $request, usuario $id_usuario)
    {
        try{

            $id_usuario->update($request->all());
                return apiResponses::success('Usuario actualizado correctamente',200,$id_usuario);
            }catch(ModelNotFoundException $e){
                return apiResponses::error('Usuario no encontrada',404);
            }catch (ValidationException $e) {
                return apiResponses::error('Error de validación: ' . $e->getMessage(), 404);
            }catch(Exception $e){
                return apiResponses::error('Error: '.$e->getMessage(),422);
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {

    }
}
