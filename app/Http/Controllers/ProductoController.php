<?php

namespace App\Http\Controllers;

use App\Models\Pattern;
use App\Models\Product;
use App\Models\Category;
use App\Models\Trademark;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Request;

class ProductoController extends Controller
{

    public function storeProduct(ProductRequest $request)
    {
        // Validar los datos y obtener solo los datos validados
        $validatedData = $request->validated();

        // Crear un nuevo producto con los datos validados
        $product = Product::create([
            'sku' => $validatedData['sku'],
            'product_name' => $validatedData['product_name'],
            'description' => $validatedData['description'],
            'img' => $validatedData['img'],
            'unit_price' => $validatedData['unit_price'],
            'stock_quantity' => $validatedData['stock_quantity'],
            'stock_max' => $validatedData['stock_max'],
            'stock_min' => $validatedData['stock_min'],
            'category_id' => $validatedData['category_id'],
            'pattern_id' => $validatedData['pattern_id'],
        ]);

        // Puedes retornar una respuesta JSON u otra respuesta según sea necesario
        return response()->json(['message' => 'Producto agregado correctamente', 'data' => $product], 201);
    }

///product Controller
public function showProduct(Product $product)
{
    if (!$product->status) { 
        return response()->json(['message' => 'Categoria ha sido eliminada'], 404);
    }
    return response()->json($product);
}



    public function search(Request $request)
    {
        $query = $request->query('query');

        $products = Product::where('product_name', 'like', "%{$query}%")
                           ->orWhere('id_product', 'like', "%{$query}%")
                           ->orWhere('id_pattern', 'like', "%{$query}%")
                           ->get();

        return response()->json(['products' => $products]);
    }
    public function indexProduct()
    {
        $product = Product::active()->get();
        return response()->json($product);
    }

    public function searchBySku($sku)
    {
        $product = Product::where('sku', $sku)->first();
            if (!$product) {
                 return response()->json(['error' => 'Producto no encontrado'], 404);
                }

        return response()->json($product);
    }

    //CategoryController 
    public function indexCat()
    {
        $categories = Category::active()->get();
        return response()->json($categories);
    }
    public function storeCat(CategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return response()->json(
            ['message' => 'Categoria creada.', 'data' => $category]);
    }
    public function showCat(Category $category)
    {
        if (!$category->status) { 
            return response()->json(['message' => 'Categoria ha sido eliminada'], 404);
        }
        return response()->json($category);
    }
    public function updateCat(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->validated());
        return response()->json(['message' => 'Categoria actualizada con exito.', 'data' => $category]);
    }

    public function destroyCat($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(['message' => 'Categoria eliminada con exito.']);
    }

    public function deactivateCat($id)
    {
        $category = Category::findOrFail($id);
        $category->update(['status' => false]);
        return response()->json(['message' => 'Categoria eliminada con exito.']);
    }

    ///TrademarkController



    public function deactivatetrade($id)
    {
        $trademark = Trademark::findOrFail($id);
        $trademark->update(['status' => false]);
        return redirect()->route('trademarks.index')->with('success', 'Trademark deactivated successfully.');
    }


    //PatternController 
    public function deactivatepattern($id)
    {
        $pattern = Pattern::findOrFail($id);
        $pattern->update(['status' => false]);
        return redirect()->route('patterns.index')->with('success', 'Pattern deactivated successfully.');
    }

//ProductController 

 public function deactivateproduc($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['status' => false]);
        return redirect()->route('products.index')->with('success', 'Product deactivated successfully.');
    }



}
