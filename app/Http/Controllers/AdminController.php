<?php

namespace App\Http\Controllers;

use App\Enums\StatusType;
use App\Enums\UserType;
use App\Models\Govern;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use \Illuminate\Session\Store;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class AdminController extends Controller
{
    //
    public function login(Request $request)
    {
        Session::put('token',$request->phone.Str::random(10));
        Session::save('token');
        $response = false;
        $validate = $request->validate([
            'phone' => 'required|min:11',
            'password' => 'required|string'
        ]);
        $user = User::where('phone', $request->phone)->where('type',UserType::getValue('ADMIN'))->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $response = true;
                echo json_encode($response);
                exit;
            }else{
                echo json_encode($response);
                exit;
            }
        }
        echo json_encode($response);
        exit;
    }

    public function Home($route = 'admin.layout')
    {  
        
        if(Session::has('token')){
        $userCount =  User::where('type',UserType::getValue('PERSONAL'))->orWhere('type',UserType::getValue('ORGANIZATION'))->count();
        $infected  =  User::where('status',StatusType::getValue('INFECTED'))->count();
        $exposed   =  User::where('status', StatusType::getValue('EXPOSED'))->count();
        $fine      =  User::where('status',StatusType::getValue('FINE'))->count(); 
        return view($route)
        ->with('userCount',$userCount)
        ->with('infected',$infected)
        ->with('exposed',$exposed)
        ->with('fine',$fine);
        }else{
            return view('admin.login');
        }

    }

    public function counter()
    {
        // to not repeat the function above
        return $this->Home($route = 'admin.home');
    }

    public function data()
    {
        $governs = Govern::all();
        $instance = new Govern();
        return view('admin.data')->with('governs',$governs)->with('new',$instance);
    
    }

    public function settings()
    {
        $user = new User();
        return view('admin.settings')->with('user',$user->getUser());
    }

    public function editInfo(Request $request)
    {
        $response = false;  
        $user = new User();
        $user = $user->getUser();
        $user->name = $request->name;
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        if($user->save()){
            $response = true;
            echo json_encode($response);
            exit;
        }
        echo json_encode($response);
        exit;
    }
}
