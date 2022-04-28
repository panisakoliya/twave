<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDatatable;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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
            'name'        => 'required|string|max:255',
            'category' => 'required',
            'price'       => 'required',
            'description' => 'required',
            'image'       => 'required|file',
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->description = $request->description;
        if ($request->has('image')) {
            $profilePicture = $request->file('image');
            $profilePicturePath = public_path('/assets/images/product_images');
            $profilePictureName = date('Y_m_d_h_i_s') . '.' . $profilePicture->getClientOriginalExtension();
            $request->image->move($profilePicturePath, $profilePictureName);
            $product->image = $profilePictureName;
        }
        $product->save();
        return redirect()->route('product.index')->with('Success', 'Product Stored Successfully');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('product.edit',compact('product','categories'));
    }

    public function update(Request $request,Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category' => 'required',
            'price'       => 'required',
            'description' => 'required',
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->description = $request->description;
        if ($request->has('image')) {
            $profilePicture = $request->file('image');
            $profilePicturePath = public_path('/assets/images/product_images');
            $profilePictureName = date('Y_m_d_h_i_s') . '.' . $profilePicture->getClientOriginalExtension();
            $request->image->move($profilePicturePath, $profilePictureName);
            $product->image = $profilePictureName;
        }
        $product->save();
        return redirect()->route('product.index')->with('Success', 'Product Stored Successfully');
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
            'message' => 'User deleted successfully'
        ]);
    }
}
