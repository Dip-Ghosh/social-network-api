<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormValidationRequest;
use App\Http\Requests\RegisterFormValidationRequest;
use App\Repository\LoginRegistrationInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;


class AuthController extends Controller
{

    protected $loginRegistration;
    protected $responseResource;

    public function __construct(LoginRegistrationInterface $loginRegistration)
    {
        $this->loginRegistration = $loginRegistration;
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
           return $this->ResponseSuccess($data,"User register successfully", ResponseAlias::HTTP_CREATED);

        }catch (\Exception $e){
            return $this->ResponseError(null,$e->getMessage(), ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
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
            return $this->ResponseError(null,"Invalid Email or Password", ResponseAlias::HTTP_UNAUTHORIZED);
        }
        $data['user'] = Auth::user();
        $data['token'] = $data['user']->createToken('auth_token')->accessToken;
        return $this->ResponseSuccess($data,"Login successfully", ResponseAlias::HTTP_OK);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try{
            Auth::user()->token()->revoke();
            return $this->ResponseSuccess(null,"Logout successfully", ResponseAlias::HTTP_OK);
        }catch (\Exception $e){
            return $this->ResponseError(null,$e->getMessage(), ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



}
