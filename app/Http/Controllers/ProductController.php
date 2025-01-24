<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SendProductCreatedNotification;

class ProductController extends Controller
{
    public function indexApi()
    {
        $availableProducts = Product::available()->get();
        return response()->json($availableProducts);
    }

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(CreateProductRequest $request)
    {
        $request->validated();
        $data = [
            'color' => $request->color,
            'size' => $request->size,
        ];
        $product = Product::create([
            'article' => $request->article,
            'name' => $request->name,
            'status' => $request->status,
            'data' => json_encode($data),
        ]);
        SendProductCreatedNotification::dispatch($product);
        return redirect()->route('products.index')->with('success', 'Продукт успешно создан');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $request->validated();
        $user = auth()->user();
        $role = $user->getRole();
        if($role === config('product.role.admin'))
        {
            $data_request = $request->all();
        }
        else
        {
            $data_request = $request->only('name', 'status', 'data', 'color', 'size');
        }
        $data = [
            'color' => $request->color,
            'size' => $request->size,
        ];
        $data_request['data'] = json_encode($data);
        $product->update($data_request);
        return redirect()->route('products.index')->with('success', 'Продукт успешно изменен');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Продукт успешно удален');
    }
}
