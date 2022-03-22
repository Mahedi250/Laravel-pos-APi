<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Category\Entities\Category;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return response()->json(Category::whereNull('parent_id')->get());
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        $validator = \Validator::make($request->all(), ['name' => 'required',]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }



        try {
            $Category = new Category();

            $Category->name = $request->name;
            $Category->slug = str_replace(' ', '-', strtolower(trim($request->name)));
            $saved = $Category->save();
            return response()->json(["message" => "Entry saved"], 200);
        } catch (\Exception $e) {

            return response()->json(["message" => "Entry not save"], 500);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('category::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('category::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), ['name' => 'required',]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $this->validate($request, [
                'name' => 'required',
            ]);

            $slug = str_replace(' ', '-', strtolower(trim($request->name)));
            $Category = Category::whereNull('parent_id')
                ->where('id', $id)
                ->update([
                    'name' => $request->name,
                    'slug' => $slug
                ]);
            if (!$Category) {
                return response()->json(["message" => "Entry not Updated"], 500);
            } else {

                return response()->json(["message" => "Entry  Updated"], 200);
            }
        } catch (\Exception $e) {
            return response()->json(["message" => $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try {
            $delete = Category::whereNull('parent_id')->where('id', $id)->delete();
            if ($delete) {
                return response()->json(["message" => "Entry deleted succesfully"], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }
}
