<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\ResponseTrait;
use BenSampo\Enum\Enum;
use App\Enums\PrivacyType;
use App\Enums\StatusType;
use App\Models\Contact;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Organization_user;
use Carbon\CarbonPeriod;
use App\Models\StatusLog;
use Berkayk\OneSignal\OneSignalFacade;

class ContactController extends Controller
{
    //
  /*
        Request Must have
        lat,
        long,
        privacy[ public = 1 , private = 2  ]

       ## QR Code Must hava ##
        user_id,    
        organization_id
  */
    use ResponseTrait;

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['register','login']]);
    }

    public function index(Request $request)
    {
        $user = $request->user();
        if($user){
           $contact = $user->contacts;
           if(count($contact) != 0){
            return $this->jsonResponse(['counter' => count($contact)],null,Response::HTTP_OK);
           }
        return $this->jsonResponse(['message' => 'There is no contacts'],null,Response::HTTP_OK);
        }
        return $this->jsonResponse(null,'User not Found',Response::HTTP_UNAUTHORIZED);
       
    }

    public function week_month(Request $request)
    {
        $user = $request->user();
        $weekCount = 0;
        $monthCount = 0;
        $contacts = $user->contacts;
        foreach($contacts as $contact){
            
            $duration = count($this->days($contact->created_at,now()));

            switch ($duration) {
                case $duration < 7:
                    $weekCount++;
                    break;
                case $duration < 30:
                    $monthCount++;                
            }
          
        return $this->jsonResponse(['weekly' => $weekCount, 'monthly' => $monthCount], null, Response::HTTP_OK);
        }
    }

    public function publicContacts(Request $request)
    {
        // Here We will user Enum Values From app/Enums/PrivacyType
        $user = $request->user();
        // Empty array to put contacts in
        $users =[];
        // if user exist
        if($user){
            $publicContacts = $user->contacts()->select('pimmed_id')->where('privacy',PrivacyType::getValue('PUBLIC'))->get();
            if($publicContacts){
                // looped in ids to get users
                foreach($publicContacts as $contact){
                    $users[] = User::where('id',$contact->pimmed_id)->get(); 
                }
                return $this->jsonResponse($users,null,Response::HTTP_OK);
            }
            return $this->jsonResponse(['message' => 'There is no Contacts'],null,Response::HTTP_OK);
        }
        return $this->jsonResponse(null,'User Not Found',Response::HTTP_UNAUTHORIZED);
    }

    public function privateContacts(Request $request)
    {
        // Here We will user Enum Values From app/Enums/PrivacyType
        $user = $request->user();
        // Empty array to put contacts in
        $users =[];
        // if user exist
        if($user){
          if(Hash::check($request->password, $user->password)){
              
            $publicContacts = $user->contacts()->select('pimmed_id')
            ->where('privacy',PrivacyType::getValue('PRIVATE'))->get();

            if($publicContacts){
                // looped in ids to get users
                foreach($publicContacts as $contact){
                    $users[] = User::where('id',$contact->pimmed_id)->get(); 
                }
                return $this->jsonResponse($users,null,Response::HTTP_OK);
            }
            return $this->jsonResponse(['message' => 'There is no Contacts'],null,Response::HTTP_OK);
        }
        return $this->jsonResponse(null,'Password Not Correct',Response::HTTP_UNAUTHORIZED);
     }
        return $this->jsonResponse(null,'User Not Found',Response::HTTP_UNAUTHORIZED);
    }

    public function saveContact(Request $request)
    {
        $user = $request->user();
        if($user){
            // Create Contact
            $createContact = Contact::create([
                'lat' => $request->lat,
                'lang' => $request->lang,
                'privacy' => $request->privacy,
                'user_id' => $request->user()->id,
                'pimmed_id' => $request->user_id,
            ]);
            //Check if the pimmed user is infected or not
            if(User::find($request->user_id)->status == StatusType::getValue('INFECTED')
              || User::find($request->user_id)->status == StatusType::getValue('EXPOSED') ){
                  
                // notify all mycontacts
                $this->notify($user->contacts, $request->user_id);
                //change my status
                $user->status = StatusType::getValue('EXPOSED');
                $user->save();
                StatusLog::create([
                    'user_id' => $user->id,
                    'status' => StatusType::getValue('EXPOSED')
                    ]);   
             }


            // Check if the request have org_id to generate org_user record
            if($request->organization_id){
                Organization_user::create(['user_id' => $request->user()->id, 'organization_id' => $request->organization_id]);
            }
            if($createContact){
                return $this->jsonResponse($createContact,null,Response::HTTP_OK);
            }
            return $this->jsonResponse(null,'Contact Cant be Saved',Response::HTTP_NOT_FOUND);
        }
        return $this->jsonResponse(null,'User Not Found',Response::HTTP_UNAUTHORIZED);
    }

}
