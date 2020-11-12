<?php
use \OneSignal as BA;
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\ResponseTrait;
use BenSampo\Enum\Enum;
use App\Enums\PrivacyType;
use App\Models\Contact;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\StatusLog;
use App\Enums\StatusType;
use Berkayk\OneSignal\OneSignalClient;

class UserController extends Controller
{
    //

    use ResponseTrait;

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['register','login']]);
    }

    public function getProfile(Request $request)
    {
            $user = $request->user();
            if($user){
                return $this->jsonResponse($user,null,200);  
            }else{
                return $this->jsonResponse(null,'HTTP_UNAUTHORIZED', Response::HTTP_UNAUTHORIZED);
            }

    }

    // Request must have token & status
    /*
             INFECTED = 1;
             EXPOSED = 2
             FINE = 3;
    */
    public function updateStatus(Request $request)
    {
        $contacts = [];
        $user = $request->user();
        if($user){
            $user->status = $request->status;
            if($user->save()){
                StatusLog::create([
                    'user_id' => $user->id,
                    'status'  => $request->status, 
                ]);
                return $this->jsonResponse('Status Updated Successfuly',null,Response::HTTP_OK);
        
                // check if user you will pim with is infected or not 
            if($request->status == StatusType::getValue('INFECTED') 
               || $request->status == StatusType::getValue('EXPOSED') ){
               $this->notify($user->contacts);
            }
            }
            return $this->jsonResponse('Status not Updated',null,Response::HTTP_OK);
        }
        return $this->jsonResponse(null,'User Not Found',Response::HTTP_UNAUTHORIZED);

    }

    public function getQr(Request $request)
    {
        $user = $request->user();
        $qr = array([
            'id' => $user->id,
            'phone' => $user->phone,
        ]);
        return $this->jsonResponse($qr, null, Response::HTTP_OK);
    }
  

    public function player_id(Request $request)
    {
        $user = $request->user();
        $user->player_id = $request->player_id;
        if($user->save()){
            return $this->jsonResponse('Updated Successfully', null, Response::HTTP_OK);
        }
        return $this->jsonResponse(null, 'Not Updated', Response::HTTP_NOT_FOUND);
    }

    public function changepassword(Request $request)
    {
        $user = $request->user();
        if($request->password){
            $user->password = Hash::make($request->password);
            if($user->save()){
                return $this->jsonResponse('Updated Successfully', null, Response::HTTP_OK);
            }
            return $this->jsonResponse(null, 'Not Updated', Response::HTTP_OK);

        }
    }

    public function test(Request $request)
    {/*
        $user = $request->user();
        OneSignalClient::sendNotificationToAll(
            "Some Message", 
            $url = null, 
            $data = null, 
            $buttons = null, 
            $schedule = null
        );
    */
    }

}
