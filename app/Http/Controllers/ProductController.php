<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('categoria')->orderBy('nome')->get();

        return view('products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        try {
            $categories = Category::orderBy('nome')->get();

            return view('products.form-create', [
                'categories' => $categories
            ]);
        } catch (Exception $ex) {
            return redirect()
                ->back()
                ->with('error', $ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            if (!$request->nome) {
                throw new Exception('O campo Nome não foi informado');
            }

            if (!$request->id_categoria) {
                throw new Exception('O campo Categoria não foi informado');
            }

            $product = Product::create([
                'nome'          => $request->nome,
                'descricao'     => $request->descricao,
                'id_categoria'  => $request->id_categoria
            ]);

            if (!$product) {
                throw new Exception('Não foi possível cadastrar o produto. Por favor, tente novamente');
            }

            return redirect()
                ->back()
                ->with('success', 'Produto "' . $product->nome . '" Cadastrado com sucesso');
        } catch (Exception $ex) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        try {

            $product->load('categoria');

            $response['error']      = true;
            $response['product']    = $product;
        } catch (Exception $ex) {
            $response['error']  = true;
            $response['msg']    = $ex->getMessage();
        } finally {
            return json_encode($response);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        try {
            $categories = Category::orderBy('nome')->get();

            return view('products.form-edit', [
                'product'       => $product,
                'categories'    => $categories
            ]);
        } catch (Exception $ex) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        try {

            if (!$request->nome) {
                throw new Exception('O campo Nome não foi informado');
            }

            if (!$request->id_categoria) {
                throw new Exception('O campo Categoria não foi informado');
            }

            $product->update([
                'nome'          => $request->nome,
                'descricao'     => $request->descricao,
                'id_categoria'  => $request->id_categoria
            ]);

            if (!$product) {
                throw new Exception('Não foi possível atualizar o produto. Por favor, tente novamente');
            }

            return redirect()
                ->back()
                ->with('success', 'Produto "' . $product->nome . '" Atualizado com sucesso');
        } catch (Exception $ex) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            if (!$product->delete()) {
                throw new Exception('Não foi possível remover o produto. Por favor, tente novamente');
            }

            $response['error'] = false;
            $response['msg']   = 'Produto "' . $product->nome . '" Removido com sucesso';
        } catch (Exception $ex) {
            $response['error'] = true;
            $response['msg']   = $ex->getMessage();
        } finally {
            return json_encode($response);
        }
    }
}
