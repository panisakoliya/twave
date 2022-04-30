<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDatatable;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    private $productImagePath;

    public function __construct()
    {
        $this->productImagePath = public_path('/assets/images/product_images');

        if (!File::isDirectory($this->productImagePath)) {
            File::makeDirectory($this->productImagePath, 0777, true, true);
        }
    }

    public function index(ProductDatatable $dataTable)
    {
        return $dataTable->render('product.index');
    }

    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|integer',
            'price' => 'required|integer',
            'description' => 'required',
            'image' => 'required|file',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        if ($request->has('image') && $request->image != "") {
            $image = $request->file('image');
            $imageName = date('Y_m_d_h_i_s') . '__' . rand(100, 50000) . '.' . $image->getClientOriginalExtension();
            $request->image->move($this->productImagePath, $imageName);
            $product->image = $imageName;
        }

        $product->save();
        return redirect()->route('product.index')->with('success', 'Product stored successfully');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|integer',
            'description' => 'required',
            'price' => 'required|integer',
            'image' => $request->has('image') && $request->image != "" ? 'required|file' : '',
        ]);

        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->description = $request->description;
        if ($request->has('image') && $request->image != "") {
            $image = $request->file('image');
            $imageName = date('Y_m_d_h_i_s') . '__' . rand(100, 50000) . '.' . $image->getClientOriginalExtension();
            $request->image->move($this->productImagePath, $imageName);
            $product->image = $imageName;
        }
        $product->save();
        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    public function delete(Request $request)
    {
        $product = Product::where('uuid', $request->uuid)->first();

        if (empty($product)) {
            return response()->json([
                'status' => false,
                'data' => '',
                'message' => 'Product not found!'
            ]);
        }

        $product->delete();

        return response()->json([
            'status' => true,
            'data' => $product,
            'message' => 'Product deleted successfully'
        ]);
    }



    /**
     *
     * API Methods
     *
     */

    public function productsAPI()
    {
        $products = Product::all();

        $data = array();

        if (count($products) > 0) {
            foreach ($products as $key => $product) {
                $data[$key]['category'] = $product->category->name ?? '';
                $data[$key]['description'] = $product->description;
                $data[$key]['image'] = $product->image_path;
                $data[$key]['name'] = $product->name;
                $data[$key]['price'] = $product->price;
            }

            return response()->json([
                'status' => true,
                'data' => $data,
                'message' => 'Products retrieve successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'data' => null,
            'message' => 'No products found'
        ]);
    }
}
