<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use App\Models\Imagen_producto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;


class ProductosController extends Controller
{
    public function verProductos(){
        $productos = Producto::all();
        // $productos = Producto::get(['pro_nombre', 'prod_referencia']); // solo los campos
        // $productos = Producto::get()->take(3); // limit hasta 3

        // lista con precios
        /*
        $productos = Producto::join("precio_venta", "precio_venta.prod_codigo_producto", "=", "producto.prod_codigo")
        ->select("*")
        ->get();
        */

        return $productos;
    }


    public function verProducto($id){
        // $productos = Producto::get()->where('prod_codigo','=',$id); // selector por valor
        // $productos = Producto::find($id);

        // Sintaxis para inner join
        /*
        $resultado = Modelo::join("tabla_externa","tabla_externa.clave_foranea", "=", "modelo.clave")
        ->select("columna1", "columna2", ...)
        ->get();
        */

        // 2 tables
        // $productos = Producto::join("precio_venta", "precio_venta.prod_codigo_producto", "=", "producto.prod_codigo") //ok

        // ->select("*")
        // ->select("producto.*","precio_venta.pre_ven_valor")
        // ->get();
        // ->get()->where('prod_codigo','=',$id);

        // ->select("producto.pro_nombre","producto.prod_referencia","precio_venta.pre_ven_valor") //ok
        // ->find($id); //ok


        // 3 tables
        $productos = Producto::join("precio_venta", "precio_venta.prod_codigo_producto", "=", "producto.prod_codigo")
        ->join('imagen_producto', 'imagen_producto.prod_codigo_producto', '=', 'producto.prod_codigo')

        // ->select("producto.pro_nombre","producto.prod_referencia","precio_venta.pre_ven_valor","imagen_producto.imag_prod_url") //ok
        ->select("producto.pro_nombre","producto.prod_referencia","precio_venta.pre_ven_valor","imagen_producto.imag_base64") //ok

        // ->get();
        ->find($id); //ok

        return $productos;
    }


    // public function insertProducto(Request $request) {
    //     // Log::info($request);
    //     $validator = Validator::make($request->all(), [
    //         'name_product' => 'required|string|max:255',
    //         // 'email' => 'required|string|email|max:255|unique:users',
    //         // 'password' => 'required|string|min:6|confirmed',
    //     ]);

    //     if($validator->fails()){
    //         return response()->json($validator->errors()->toJson(),400);
    //     }

    //     // DB::table('producto')->insert($data);

    //     // DB::table('producto')->insert([
    //     //     'name' => $request->get('name_product'),
    //     //     ['pro_nombre' => 'picard@example.com', 'votes' => 0],
    //     //     ['email' => 'janeway@example.com', 'votes' => 0],
    //     // ]);

    //     // $product->name_product = $request->name_product;

    //     DB::table('producto')->insert($request);

    //     // echo "Record inserted successfully.<br/>".$request->name_product;

    //     // $project->user_id = $request->userId;




    //     // DB::table('producto')->insert($request);


    //     // $name = $request->input('stud_name');
    //     // DB::insert('insert into student (name) values(?)',[$name]);
    //     // echo "Record inserted successfully.<br/>";
    //     // echo '<a href = "/insert">Click Here</a> to go back.';


    //     // DB::table('users')->insert([
    //     //     ['email' => 'picard@example.com', 'votes' => 0],
    //     //     ['email' => 'janeway@example.com', 'votes' => 0],
    //     // ]);

    //     /*
    //     https://laracasts.com/discuss/channels/laravel/batch-insert-in-laravel-52
    //     https://www.tutorialspoint.com/laravel/insert_records.htm
    //     https://laravel.com/docs/9.x/queries#insert-statements
    //     https://aprendible.com/series/laravel-desde-cero/lecciones/eloquent-insertar-registros/comentarios
    //     */
    // }


    // public function insertProductoFunction(Request $request) {
    //     $producto = Producto::create([
    //         'pro_nombre' => $request->post('prod_nombre'),
    //         'prod_referencia' => $request->post('prod_referencia'),
    //         'prod_descripcion' => $request->post('prod_descripcion'),
    //     ]);

    //     return $request;
    // }


    // public function insertProductoFunction2(Request $request) {
    //     $registrant = Producto::create($request->all());

    //     return $request;
    // }


    public function insertProductoImagenFunction(Request $request) {
        $producto = Producto::create([
            'pro_nombre' => $request->post('pro_nombre'),
            'prod_referencia' => $request->post('prod_referencia'),
            'prod_descripcion' => $request->post('prod_descripcion'),
        ]);

        $productos = Producto::select("prod_codigo")
        ->whereraw("pro_nombre='".$request->post('pro_nombre')."'")->first();

        $registrant = Imagen_producto::create([
            "prod_codigo_producto" => $productos["prod_codigo"],
            "imag_base64" => $request->post("imag_base64"),
        ]);

        return $productos["prod_codigo"];
    }
}
