<?php

namespace App\Http\Controllers\User;

use App\Enum\RolesEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /** 
     * Login to the system
     */
    public function login(Request $request): JsonResponse
    {
        try {
            if (Auth::attempt($request->only('email', 'password'))) {
                $user = Auth::user();
                $token = $user->createToken('app');

                return response([
                    'message' => 'Successfully Login',
                    'token' => $token,
                    'user' => $user,
                ], 200);
            }
        } catch (Exception $exception) {
            return $this->errorResponse([], $exception->getMessage(), 400);
        }

        return $this->errorResponse([], 'Invalid Email Or Password');
    }

    /**
     * register new user
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $user = User::create($validated);
            $role = $user->assignRole([RolesEnum::User->value]);
            $role->givePermissionTo(['create_product', 'delete_product', 'edit_product']);
            DB::commit();

            return  $this->successResponse(['user' => new UserResource($user)], 'Registration Successfull');
        } catch (Exception $exception) {
            DB::rollBack();

            return  $this->errorResponse([], $exception->getMessage());
        }
    }
}
