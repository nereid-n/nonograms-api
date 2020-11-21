<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\NonogramRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NonogramController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function add(NonogramRequest $request)
    {
        $path = Storage::url(Storage::put('public/nonograms', $request->file('img')));
        $request->user()->nonograms()->create([
            'name' => $request->name,
            'img' => $path,
            'width' => $request->width,
            'height' => $request->height,
            'color' => $request->color
        ]);
        return response()->json([
            'message' => 'Success'
        ], 200);
    }
    public function delete(Request $request, $id)
    {
        DB::table('nonograms')->where('id', $id)->delete();;
        return response()->json([
            'message' => 'Success'
        ], 200);
    }
    public function get(Request $request, $id)
    {
        $nonogram = DB::table('nonograms')->where('id', $id)->get();;
        return response()->json($nonogram[0], 200);
    }
    public function index(Request $request)
    {
        $records = 15;
        $totalPages = ceil(DB::table('nonograms')->count() / $records);
        $this->validate($request, [
            'page' => 'integer',
        ]);
        $request['page'] = $request['page'] ?? 0;
        $nonograms = DB::table('nonograms')->skip($records * $request['page'])->take($records)->get();
        return response()->json([
            'totalPages' => $totalPages,
            'page' => $request['page'],
            'items' => $nonograms
        ], 200);
    }
}
