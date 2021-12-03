<?php
  
namespace App\Http\Controllers;
  
use App\Models\Ad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


  
class AdController extends Controller
{
    public function user_ads()
    {
        $id = Auth::user()->id;
        $ads = DB::table('ads')
        ->join('users', 'users.id', '=', 'ads.user_id')
        ->where('users.id','=',$id)
        ->select('ads.*')
        ->get();

        return view('access_my_ads',compact('ads'))
            ->with('i', (request()->input('page', 1) -1) *5);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ad::latest()->paginate(5);
    
        return view('ads.index',compact('ads'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
   
        $locations = DB::table('locations')
        ->select('locations.name')
        ->get();
        $categories = DB::table('categories')
        ->select('categories.name')
        ->get();
        return view('ads.create', ['categories' => $categories, 'locations' => $locations]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['phone_number'] = Auth::user()->phone_number;
        $request['user_id'] = Auth::user()->id;
        $request->validate([
                'title' => 'required',
                'category' => 'required',
                'description' => 'required',
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'price' => 'required',
                'location' => 'required',
                'user_id' => 'required',
                'phone_number' => 'required',
            
        ]);

        $input = $request->all() ;
       
        
  
        if ($picture = $request->file('picture')) {
            $destinationPath = 'picture/';
            $profilepicture = date('YmdHis') . "." . $picture->getClientOriginalExtension();
            $picture->move($destinationPath, $profilepicture);
            $input['picture'] = "$profilepicture";
        }
    
        Ad::create($input);
     
        return redirect()->route('ads.index')
                        ->with('success','Ad created successfully.');
    }
     
    public function form_create_ad(Request $request)
    {
        $locations = DB::table('locations')
        ->select('locations.name')
        ->get();
        $categories = DB::table('categories')
        ->select('categories.name')
        ->get();
        return view('post_ad', ['categories' => $categories, 'locations' => $locations]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_by_user(Request $request)
    {
        $request['phone_number'] = Auth::user()->phone_number;
        $request['user_id'] = Auth::user()->id;
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required',
            'location' => 'required',
            'user_id' => 'required',
            'phone_number' => 'required',
 
        ]);

        $input = $request->all();

  
        if ($picture = $request->file('picture')) {
            $destinationPath = 'picture/';
            $profilepicture = date('YmdHis') . "." . $picture->getClientOriginalExtension();
            $picture->move($destinationPath, $profilepicture);
            $input['picture'] = "$profilepicture";
        }
    
        Ad::create($input);
     
        return redirect()->route('dashboard')
                        ->with('success','Ad created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function user_show_ads($id)
    {
        $ads = DB::table('ads')
        ->select('ads.*')
        ->where('id','=',$id )
        ->get();


        
        return view('show_my_ads',compact('ads'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function see_ad_detail($id)
    {
        $ads = DB::table('ads')
        ->select('ads.*')
        ->where('id','=',$id )
        ->get();


        
        return view('user_show_ad',compact('ads'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        return view('ads.show',compact('ad'));
    }
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        return view('ads.edit',compact('ad'));
    }
    
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ad $ad)
    {
        $request['phone_number'] = Auth::user()->phone_number;
        $locations = DB::table('locations')
        ->select('locations.name')
        ->get();
        $categories = DB::table('categories')
        ->select('categories.name')
        ->get();
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'price' => 'required',
            'location' => 'required',
            'phone_number' => 'required',
        ]);
  
        $input = $request->all();
  
        if ($picture = $request->file('picture')) {
            $destinationPath = 'picture/';
            $profilepicture = date('YmdHis') . "." . $picture->getClientOriginalExtension();
            $picture->move($destinationPath, $profilepicture);
            $input['picture'] = "$profilepicture";
        }else{
            unset($input['picture']);
        }
          
        $ad->update($input);
    
        return redirect()->route('ads.index')
                        ->with('success','Ad updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        $ad->delete();
     
        return redirect()->route('ads.index')
                        ->with('success','Ad deleted successfully');
    }
}