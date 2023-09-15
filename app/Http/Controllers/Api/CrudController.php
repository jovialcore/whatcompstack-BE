<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = DB::table('cruds')->select()->get();
            return response()->json($data);
        } catch (\Throwable $th) {
            return  response()->json(['error' => $th], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        dd('createek');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::table('cruds')->insert([
                'name' => $request->name
            ]);

            return response()->json(['message' => 'update was successfull'], 200);
        } catch (\Throwable $th) {
            return  response()->json(['error' => $th], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $data = DB::table('cruds')->select()->where('id', $id)->orWhere('name', $id)->get();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        try {
            $data =  DB::table('cruds')->where('id', $id)->orWhere('name', $id)->update(['name' => $request->name]);
            return response()->json(['message' => 'update was successfull'], 200);
        } catch (\Throwable $th) {
            return  response()->json(['error' => $th], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $data =  DB::table('cruds')->findOrFail($id);
            $data->delete();
            return response()->json(['message' => 'delete was successfull'], 200);
        } catch (\Throwable $th) {

            return  response()->json(['error' => $th], 500);
        }
    }
}
