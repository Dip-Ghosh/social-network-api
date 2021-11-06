<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormValidationRequest;
use App\Http\Requests\RegisterFormValidationRequest;
use App\Http\Resources\ApiResponseResource;
use App\Repository\LoginRegistrationInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    protected $loginRegistration;
    protected $responseResource;


    public function __construct(LoginRegistrationInterface $loginRegistration,ApiResponseResource $responseResource)
    {
        $this->loginRegistration = $loginRegistration;
        $this->responseResource = $responseResource;

    }


    /**
     * @param RegisterFormValidationRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @param first_name.lsat_name,email,password
     */
    public function register( RegisterFormValidationRequest $request){

        try{

           $data['user'] = $this->loginRegistration->register($request->only( ['first_name','last_name','email','password']));
           $data['token'] =$data['user']->createToken('auth_token')->accessToken;
           return $this->responseResource->ResponseSuccess($data,"User register successfully",Response::HTTP_CREATED);

        }catch (\Exception $e){
            return $this->responseResource->ResponseError(null,$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    /**
     * @param LoginFormValidationRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @param email,passpord
     */
    public function login(LoginFormValidationRequest $request)
    {
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->responseResource->ResponseError(null,"Invalid Email or Password",Response::HTTP_UNAUTHORIZED);
        }
        $data['user'] = Auth::user();
        $data['token'] = $data['user']->createToken('auth_token')->accessToken;
        return $this->responseResource->ResponseSuccess($data,"Login successfully",Response::HTTP_OK);

    }


    public function logout()
    {
        try{
            Auth::user()->token()->revoke();
            return $this->responseResource->ResponseSuccess(null,"Logout successfully", Response::HTTP_OK);
        }catch (\Exception $e){
            return $this->responseResource->ResponseError(null,$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



}
