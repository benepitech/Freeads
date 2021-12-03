<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use DB;
  
class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $advertising = DB::table('ads')->get();

        return view('home', ['advertising' => $advertising]);
    }
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sign_in()
    {
        return view('sign_in');
    }
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('register');
    }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function post_ad()
    {
        return view('post_ad');
    }
}