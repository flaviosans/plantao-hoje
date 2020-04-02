<?php
use App\Produto;
use App\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('buscar/produtos/', function(Request $request){
    return Produto::where('nome', 'like', '%' . $request->q . '%')->orWhere('codigo_barras', '=', $request->q)->get();
});

Route::post('pedido', 'FrontController@pedido')->middleware('auth');

// TODO: REFATORAR ESSE CÓDIGO, TIRAR ESSA RESPONSABILIDADE DO CHECKOUT
Route::post('checkout', function(Request $request){
    $json = $request->json()->all();

    $user = User::where('email','=', $json['cliente']['email'])->exists();
    if(!$user){
        $user = User::create([
            'name' => $json['cliente']['nome'],
            'email' => $json['cliente']['email'],
            'password' => bcrypt($json['cliente']['password'])
        ]);
        return $user->email->toJson();
    }
    else{
        return "usuário já existe";
    }
});