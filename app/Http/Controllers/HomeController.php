<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::orderBy('name')->paginate(5);

        return view('home', [
            'products' => $products
        ]);
    }

    public function createPost(ProductRequest $request)
    {
        $success = true;
        if ($request->input('productId') != null) {
            $product = Product::findOrFail($request->input('productId'));
        } else {
            $product = new Product();
        }
        $product->fill($request->all());
        $success = $success && $product->save();

        if ($success) {
            if ($request->input('productId') != null) {
                Session::flash('message-success', '¡Producto actualizado correctamente!');
            } else {
                Session::flash('message-success', '¡Producto creado correctamente!');
            }

            return response()->json([
                'success' => true,
            ]);
        }

        return response()->json([
            'success' => false,
        ]);
    }

    public function destroy($productId)
    {
        $success = true;
        $product = Product::findOrFail($productId);
        $success = $success && $product->delete();

        if ($success) {
            Session::flash('message-success', '¡Producto eliminado correctamente!');
        } else {
            Session::flash('message-error', 'Error al eliminar el producto, vuelva a intentar más tarde.');
        }

        return redirect()->route('home');
    }
}
