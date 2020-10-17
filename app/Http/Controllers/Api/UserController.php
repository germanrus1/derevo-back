<?php

namespace App\Http\Controllers\API;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Validator;

class UserController extends BaseController
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

    public function store(Request $request)
    {
        $input = $request->all();
        $status = $this->loadImage('avatarFIle', $request);

        if ($status['status']) {
            return $this->sendResponse($status, $status['message']);
        }

        return $this->sendError($status['message']);
    }

    public function update(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email',
            'login' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Неправильные данные.', $validator->errors());
        }

        $user = Auth::user();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->login = $input['last_name'];
        $user->last_name = $input['last_name'];
        $user->age = $input['age'];
        $user->description = $input['description'];
        $user->telephone = $input['telephone'];
        $user->gender = $input['gender'];
        $user->avatar_url = $input['avatar_url'];
        $user->update();

        return $this->sendResponse($user->toArray(), 'Данные изменены успешно!');
    }
    public function profile()
    {
        // получить api api авторизованного пользователя
//        $user = User::find()
//        return
    }

    // Вынести в общий модуль
    public function loadImage($fileName, Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'avatarFile' => 'required',
//            'avatarFile' => [ // аналогичный вариант
//                'required',
//                Rule::dimensions()->maxWidth(1000)->maxHeight(500)->ratio(3 / 2),
//            ],
        ]);
        $user = Auth::user();
        $folderPath = '/user_images/user_' . $user->getAuthIdentifier();
        $fileNameBD = 'original_img.jpg';
        // сохраняет в файл. store - хранит в store
        $path = $request->file($fileName)
            ->storeAs($folderPath, $fileNameBD, 'upload');

        if ($path != false) {
            $user->avatar_url = $folderPath . '/' . $fileNameBD;
            $user->update();
            return ['status' => true, 'message' => $path, 'path' => 'upload/' . $path];
            return ['status' => true, 'message' => 'Файл успешно загружен.'];
        }

        return ['status' => true, 'message' => $path];
        return ['status' => true, 'message' => 'Произошла ошибка при загрузке файла.'];
    }
}
