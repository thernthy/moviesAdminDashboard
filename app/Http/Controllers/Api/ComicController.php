<?php 

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ComicController extends Controller
{
    public function cagetory(Request $request)
    {
        $token = $request->query('token');
        if(!$token){
            return response()->json('Sorry you can access our data', 401);
        }
        $filter = $request->query('filter');
        $sqlQuery = null;
        $data = '';
        
        if ($request->has('filter')) {
            $sqlQuery = '!=';
        } elseif ($request->has('optional')) {
            $sqlQuery = '=';
        } elseif ($request->has('search')) {
            $sqlQuery = 'LIKE';
        } elseif ($request->has('filterBy')) {
            $sqlQuery = 'LIKE';
        }
        if ($sqlQuery !== null) {
            $selectOn = $request->query('filterBy') ?? $request->query('optional') ?? '%'.$request->query('search').'%' ?? null;
            $data = DB::table('titles')->where('title', $sqlQuery, $selectOn)->get();
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Invalid parameters'], 401);
        }
    }
}
