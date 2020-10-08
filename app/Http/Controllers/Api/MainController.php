<?php

namespace App\Http\Controllers\API;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;

class MainController extends BaseController
{
    /**
     * Main api
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sendResponse(User::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        if (is_null($user)) {
            return $this->sendError('Пользователь не найден.');
        }

        return $this->sendResponse($user->toArray(), 'Пользователь.');
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Неправильные данные.', $validator->errors());
        }

        $user = Auth::user();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->last_name = $input['last_name'];
        $user->update();

        return $this->sendResponse($user->toArray(), 'Данные изменены успешно!');
    }
    public function profile()
    {
        // получить api api авторизованного пользователя
//        $user = User::find()
//        return
    }
}
