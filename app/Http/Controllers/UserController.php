<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
  /**
   * Iniciar sesion con email y password
   * @param  Request $request Payload con los datos enviados por el usuario
   * @return Object Datos del usuario que inicia sesion
   */
  public function authenticate(Request $request)
  {
    // Validar que los campos enviados sean correctos
    $validator = Validator::make($request->all(), [
      'email' => 'required|max:64',
      'password' => 'required',
    ]);

    // Si hay algun error en un valor enviado se genera una respuesta con error
    if ($validator->fails()) {
      return response()->json($validator->messages(), 401);
    }
    // Consultar los datos del usuario
    $credentials = User::where([
      ['email', '=', $request->email],
      ['password', '=', sha1($request->password)]
    ])->first();

    // Validar si hubo resultados en la consulta para generar el token jwt
    if($credentials){
      try {
        if (! $token = JWTAuth::fromUser($credentials)) {
          return response()->json(['error' => 'invalid_credentials'], 400);
        }
      } catch (JWTException $e) {
        return response()->json(['error' => 'could_not_create_token'], 500);
      }
      $credentials->tokenjwt = $token;
      return response()->json($credentials, 200);
    }else{
      return response()->json('Error in user or password', 401);
    }
  }

  /**
   * Registrar en la base de datos la informacion del usuario
   * @param  Request $request Payload con los datos enviados por el usuario
   * @return Object Datos del usuario creado
   */
  public function register(Request $request) {
    // Validar que los campos enviados sean correctos
    $validator = Validator::make($request->all(), [
      'first_name' => 'required|max:128',
      'last_name' => 'required|max:128',
      'email' => 'required|max:64',
      'password' => 'required',
    ]);

    // Si hay algun error en un valor enviado se genera una respuesta con error
    if ($validator->fails()) {
      return response()->json($validator->messages(), 401);
    }

    $user = new User;
    // Asignar los valores a las propiedades
    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->email = $request->email;
    $user->password = sha1($request->password);
    $user->age = $request->age;
    $user->image = $request->image;
    $user->token = uniqid();
    // Generar en la base de datos el nuevo registro
    $user->save();

    return response()->json($user, 200);
  }

  /**
   * Editar todos o parte de los datos un registro en la base de datos
   * @param  Request $request Payload con los datos enviados por el usuario
   * @param  [type]  $id      Id del usuario a modificar
   * @return Object Datos del usuario creado
   */
  public function editar(Request $request) {
    // Si hay algun error en un valor enviado se genera una respuesta con error
    if ($request->id == '' || !isset($request->id)) {
      return response()->json(["error" => "The id field is required."], 403);
    }
    
    // Validar que los campos enviados sean correctos
    $validator = Validator::make($request->all(), [
      'first_name' => 'required|max:128',
      'last_name' => 'required|max:128',
      'age' => 'required',
    ]);

    // Si hay algun error en un valor enviado se genera una respuesta con error
    if ($validator->fails()) {
      return response()->json($validator->messages(), 401);
    }

    User::where('id', '=', $request->id)->update(
      $request->all()
    );
    $users = User::where('id', $request->id)->first();
    return response()->json($users, 200);
  }

  /**
   * Eliminar un registro en la base de datos
   * @param  Request $request Payload con los datos enviados por el usuario
   * @return Object Datos del usuario eliminado
   */
  public function eliminar(Request $request) {
    // Si hay algun error en un valor enviado se genera una respuesta con error
    if ($request->id == '' || !isset($request->id)) {
      return response()->json(["error" => "The id field is required."], 403);
    }

    $users = User::where('id', $request->id)->first();

    User::where('id', '=', $request->id)->delete();
    return response()->json($users, 200);
  }

  /**
   * Obtener los datos de un solo usuario
   * @param  Request $request Payload con los datos enviados por el usuario
   * @return Object Datos del usuario consultado
   */
  public function listarUsuario(Request $request){
    // Si hay algun error en un valor enviado se genera una respuesta con error
    if ($request->id == '' || !isset($request->id)) {
      return response()->json(["error" => "The id field is required."], 403);
    }

    $users = User::where([
      ['id', '=', $request->id]
      ])->first();
    return response()->json($users, 200);
  }

  /**
   * Obtener los todos datos de los usuarios
   * @return Object Listado de todos los usuarios registrados
   */
  public function listarTodosUsuarios(){
    $users = User::all();
    return response()->json($users, 200);
  }

  /**
   * Obtener los todos datos de los usuarios
   * @return Object Mensaje de error al intentar consumir una api rest que no existe
   */
  public function error404(){
    return response()->json(["error" => "Not found"], 200);
  }
}
