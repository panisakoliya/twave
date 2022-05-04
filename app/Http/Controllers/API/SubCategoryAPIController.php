<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoryAPIController extends Controller
{

    public function subCategories(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'category_id' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => 'Fields are required!'
            ]);
        }

        $data = array();

        $subCategories = SubCategory::where('status', 1)->where('category_id', $request->category_id)->with('category', 'posts')->get();
        if (count($subCategories) > 0) {
            foreach ($subCategories as $key => $subCategory) {
                $data[$key]['id'] = $subCategory->id;
                $data[$key]['uuid'] = $subCategory->uuid;
                $data[$key]['name'] = $subCategory->name;
                $data[$key]['status'] = $subCategory->status;
                $data[$key]['category_id'] = $subCategory->category_id;
                $data[$key]['image'] = $subCategory->image_path;
                $data[$key]['posts'] = [];
                if (count($subCategory->posts) > 0) {
                    foreach ($subCategory->posts as $postKey => $post) {
                        $data[$key]['posts'][$postKey] = $post;
                        $data[$key]['posts'][$postKey]['image'] = $post->image_path;
                    }
                }
                $data[$key]['category'] = $subCategory->category;
                $data[$key]['category']['image'] = $subCategory->category->image_path;
                $data[$key]['created_at'] = $subCategory->created_at;
                $data[$key]['updated_at'] = $subCategory->updated_at;
            }
        }

        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => 'Retrieved all sub categories'
        ]);
    }

    public function getSubCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sub_category_id' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => 'Fields are required!'
            ]);
        }

        $data = array();

        $subCategory = SubCategory::with('category', 'posts')->where('id', $request->sub_category_id)->first();
        if ($subCategory == null) {
            return response()->json([
                'status' => false,
                'data' => $data,
                'message' => 'Sub category not found!'
            ]);
        }
        $data['id'] = $subCategory->id;
        $data['uuid'] = $subCategory->uuid;
        $data['name'] = $subCategory->name;
        $data['status'] = $subCategory->status;
        $data['category_id'] = $subCategory->category_id;
        $data['image'] = $subCategory->image_path;
        $data['posts'] = [];
        if (count($subCategory->posts) > 0) {
            foreach ($subCategory->posts as $postKey => $post) {
                $data['posts'][$postKey] = $post;
                $data['posts'][$postKey]['image'] = $post->image_path;
            }
        }
        $data['category'] = $subCategory->category;
        $data['category']['image'] = $subCategory->category->image_path;
        $data['created_at'] = $subCategory->created_at;
        $data['updated_at'] = $subCategory->updated_at;

        return response()->json(['status' => true,
            'data' => $data,
            'message' => 'Retrieved sub category']);
    }

    public function searchSubCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => 'Fields are required!'
            ]);
        }

        $data = array();

        $subCategories = SubCategory::with('category', 'posts')->where('name', 'like', '%' . $request->name . '%')->get();
        if (count($subCategories) > 0) {
            foreach ($subCategories as $key => $subCategory) {
                $data[$key]['id'] = $subCategory->id;
                $data[$key]['uuid'] = $subCategory->uuid;
                $data[$key]['name'] = $subCategory->name;
                $data[$key]['status'] = $subCategory->status;
                $data[$key]['category_id'] = $subCategory->category_id;
                $data[$key]['image'] = $subCategory->image_path;
                $data[$key]['posts'] = [];
                if (count($subCategory->posts) > 0) {
                    foreach ($subCategory->posts as $postKey => $post) {
                        $data[$key]['posts'][$postKey] = $post;
                        $data[$key]['posts'][$postKey]['image'] = $post->image_path;
                    }
                }
                $data[$key]['category'] = $subCategory->category;
                $data[$key]['category']['image'] = $subCategory->category->image_path;
                $data[$key]['created_at'] = $subCategory->created_at;
                $data[$key]['updated_at'] = $subCategory->updated_at;
            }
        }

        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => 'Retrieved searched sub categories'
        ]);
    }
}
