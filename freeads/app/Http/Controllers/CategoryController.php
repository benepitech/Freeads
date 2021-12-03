<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function index(Request $request)
{
    $categories = DB::table('categories')
    ->select('categories.name')
    ->get();


    return view('dashboard')
    ->with(compact('categories'));
}


}
