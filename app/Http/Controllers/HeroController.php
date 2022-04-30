<?php

namespace App\Http\Controllers;

use App\DataTables\HeroDatatable;
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HeroController extends Controller
{
    private $heroImagePath;

    public function __construct()
    {
        $this->heroImagePath = public_path('/assets/images/hero_images');

        if (!File::isDirectory($this->heroImagePath)) {
            File::makeDirectory($this->heroImagePath, 0777, true, true);
        }
    }

    public function index(HeroDataTable $dataTable)
    {
        return $dataTable->render('hero.index');
    }

    public function create()
    {
        return view('hero.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|file',
        ]);

        $image = $request->file('image');
        $imageName = date('Y_m_d_h_i_s') . '__' . rand(100, 50000) . '.' . $image->getClientOriginalExtension();
        $request->image->move($this->heroImagePath, $imageName);

        Hero::create(['image' => $imageName]);

        return redirect()->route('hero.index')->with(['success' => 'Hero stored successfully']);
    }

    public function edit(Hero $hero)
    {
        return view('hero.edit', compact('hero'));
    }

    public function update(Hero $hero, Request $request)
    {
        $request->validate([
            'image' => $request->has('image') && $request->image != "" ? 'required|file' : '',
        ]);

        if ($request->has('image') && $request->image != "") {
            $image = $request->file('image');
            $imageName = date('Y_m_d_h_i_s') . '__' . rand(100, 50000) . '.' . $image->getClientOriginalExtension();
            $request->image->move($this->heroImagePath, $imageName);
            $hero->image = $imageName;
        }
        $hero->save();

        return redirect()->route('hero.index')->with(['success' => 'Hero updated successfully']);
    }

    public function delete(Request $request)
    {
        $hero = Hero::where('uuid', $request->uuid)->first();

        if (empty($hero)) {
            return response()->json([
                'status' => false,
                'data' => '',
                'message' => 'Hero not found!'
            ]);
        }
        $hero->delete();

        return response()->json([
            'status' => true,
            'data' => '',
            'message' => 'Hero deleted successfully'
        ]);
    }

    /**
     *
     * API Methods
     *
     */

    public function herosAPI()
    {
        $heros = Hero::all();

        $data = array();

        if (count($heros) > 0) {
            foreach ($heros as $key => $hero) {
                $data[$key]['name'] = $hero->name;
                $data[$key]['image'] = $hero->image_path;
            }

            return response()->json([
                'status' => true,
                'data' => $data,
                'message' => 'Heros retrieve successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'data' => null,
            'message' => 'No heros found'
        ]);
    }
}
