<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Ad;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
  
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.register');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('login', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
        
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'login' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone_number' => 'required|min:10',
            'nickname' => 'required',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);

        $credentials = $request->only('login', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
         
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
    


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
    
        $locations = DB::table('locations')
        ->select('locations.name')
        ->get();
        $categories = DB::table('categories')
        ->select('categories.name')
        ->get();

        $advertising = DB::table('ads')
        ->simplePaginate(5);

        if(Auth::check()){
            return view('dashboard', ['advertising' => $advertising, 'categories' => $categories, 'locations' => $locations])
            ->with(compact('categories'));
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    
    public function form_create_ad(Request $request)
    {
        return view('post_ad');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_by_user(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required',
            'location' => 'required',
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
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'login' => $data['login'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'phone_number' => $data['phone_number'],
        'nickname' => $data['nickname']

      ]);
    }
    

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('dashboard');
    }
}