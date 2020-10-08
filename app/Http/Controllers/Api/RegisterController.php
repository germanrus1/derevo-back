<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'last_name' => '',
//            'c_password' => 'required|same:password',
        ]);
        if($validator->fails()){
            return $this->sendError('Неправильные данные.', $validator->errors());
        }
        $input = $request->all();
        $input['password'] = '123123'; // for test
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        return $this->sendResponse($success, 'Поздравляем! Регистрация прошла успешно!.');
    }
}
