<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDatatable;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    private $categoryImagePath;

    public function __construct()
    {
        $this->categoryImagePath = public_path('/assets/images/category_images');

        if (!File::isDirectory($this->categoryImagePath)) {
            File::makeDirectory($this->categoryImagePath, 0777, true, true);
        }
    }

    public function index(CategoryDatatable $dataTable)
    {
        return $dataTable->render('category.index');
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|file',
        ]);

        $image = $request->file('image');
        $imageName = date('Y_m_d_h_i_s') . '__' . rand(100, 50000) . '.' . $image->getClientOriginalExtension();
        $request->image->move($this->categoryImagePath, $imageName);

        Category::create(['image' => $imageName, 'name' => $request->name]);

        return redirect()->route('category.index')->with(['success' => 'Category stored successfully']);
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Category $category, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => $request->has('image') && $request->image != "" ? 'required|file' : '',
        ]);

        $category->name = $request->name;
        if ($request->has('image') && $request->image != "") {
            $image = $request->file('image');
            $imageName = date('Y_m_d_h_i_s') . '__' . rand(100, 50000) . '.' . $image->getClientOriginalExtension();
            $request->image->move($this->categoryImagePath, $imageName);
            $category->image = $imageName;
        }
        $category->save();

        return redirect()->route('category.index')->with(['success' => 'Category updated successfully']);
    }

    public function delete(Request $request)
    {
        $category = Category::where('uuid', $request->uuid)->first();

        if (empty($category)) {
            return response()->json([
                'status' => false,
                'data' => '',
                'message' => 'Category not found!'
            ]);
        }
        $category->delete();

        return response()->json([
            'status' => true,
            'data' => '',
            'message' => 'Category deleted successfully'
        ]);
    }
}
