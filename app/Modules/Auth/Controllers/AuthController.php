<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Requests\LoginRequest;
use App\Modules\Auth\Http\Requests\RegisterRequest;
use App\Modules\Auth\Http\Resources\LoginResource;
use App\Modules\Auth\Http\Resources\LogoutResource;
use App\Modules\Auth\Http\Resources\RegisterResource;
use App\Modules\Auth\Contracts\UserRepositoryContract;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @var UserRepositoryContract
     */
    protected UserRepositoryContract $userRepo;

    /**
     * @param UserRepositoryContract $userRepo
     */
    public function __construct(UserRepositoryContract $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * @param RegisterRequest $request
     * @return RegisterResource
     */
    public function register(RegisterRequest $request): RegisterResource
    {
        $dto = $request->toDTO();
        $user = $this->userRepo->create($dto);
        return new RegisterResource($user);
    }

    /**
     * @param LoginRequest $request
     * @return LoginResource|void
     * @throws ValidationException
     */
    public function login(LoginRequest $request)
    {
        $dto = $request->toDTO();
        if (!auth()->attempt($dto->only('email', 'password')->toArray())) {
            return $this->sendFailedLoginResponse();
        }
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return (new LoginResource(auth()->user()))->additional(['access_token' => $accessToken]);
    }

    /**
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse()
    {
        throw ValidationException::withMessages([
            $this->username() => ['Error! Invalid login credentials.'],
        ]);
    }

    /**
     * @param Request $request
     * @return LogoutResource
     */
    public function logout(Request $request): LogoutResource
    {
        $token = $request->user()->token();
        $token->revoke();
        return new LogoutResource($request->user());
    }

    /**
     * @return string
     */
    public function username(): string
    {
        return 'name';
    }
}
