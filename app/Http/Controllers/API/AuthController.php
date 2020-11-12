<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\UserType;
use App\Models\User;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Traits\ResponseTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Organization;
use App\Models\Organization_user;
use App\Models\StatusLog;

/**
 * @OA\Post(
 * path="/login",
 * summary="Sign in",
 * description="Login by email, password",
 * operationId="authLogin",
 * tags={"Auth"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"email","password"},
 *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
 *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
 *       @OA\Property(property="persistent", type="boolean", example="true"),
 *    ),
 * ),
 * @OA\Response(
 *    response=422,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
 *        )
 *     )
 * )
 * 
 * @OA\post(
 * path="/api/register",
 * summary="Sign up",
 * description="This is Docs for register",
 * operationId="authRegister",
 * security={ {"bearer": {} }},
 * tags={"Auth"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user information",
 *    @OA\JsonContent(
 *       required={"name","phone","password","status","type","govern"},
 *       @OA\Property(property="name", type="string", format="name", example="Mohamed Raslan"),
 *       @OA\Property(property="phone", type="string", format="phone", example="01111295259"),
 *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
 *       @OA\Property(property="status", type="integer", format="int64", example="1"),
 *       @OA\Property(property="type", type="integer", format="int64", example="1"),
 *       @OA\Property(property="govern", type="string", format="name", example="Cairo"),
 * 
 *    ),
 * ),
 * @OA\Response(
 *    response=422,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
 *        )
 *     ),
 * @OA\Response(
 *    response=404,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
 *        )
 *     )
 * )
 */

class AuthController extends Controller
{
    use ResponseTrait;
    //
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register','login']]);
    }

    public function register(AuthRequest $request)
    {
        $validated = $request->validated();
        if(!$validated){
           return $this->jsonResponse(null,$validated,Response::HTTP_UNAUTHORIZED);

        }else{
            $password = $request->password;
        //Create User
            $user = $request->all();
            $user['password'] = Hash::make($user['password']);
            $create = User::create($user);
            //We will create a record for his status as a log

            StatusLog::create([
                'user_id' => $create->id,
                'status' => $create->status,
            ]);

        //Create Organization
            if($request->type == UserType::getValue('ORGANIZATION')){
               $org = Organization::create(['name' => $request->organization_name]);
                $org_user = Organization_user::create(['user_id' => $create->id, 'organization_id' =>$org->id]);
            }
        // Create Token
            $token = $create->createToken(Str::random(10));
          return $this->jsonResponse(['token' => $token->accessToken,'user'=>$create],null,Response::HTTP_OK);
       }
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'phone' => 'required',
            'password' => 'required'
        ]);

        if($validate->fails()){
            return $this->jsonResponse(null,$validate->errors()->all(),Response::HTTP_UNAUTHORIZED);
        }
        $user = User::where('phone',$request->phone)->first();
        // search user if exist
        if($user){
            // check if the password match
            if(Hash::check($request->password, $user->password)){
                $token = $user->createToken(Str::random(10))->accessToken;
                return $this->jsonResponse(['token' => $token, 'user' =>$user],null,Response::HTTP_OK);
                // if password missmatch
            }else{
                return $this->jsonResponse(null,'Password missmatch',Response::HTTP_NOT_FOUND);
            }
            // if user doesnt exist
        }else{
            return $this->jsonResponse(null,'User does not exist',Response::HTTP_NOT_FOUND);
        }
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

   

}
