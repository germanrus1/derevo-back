<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Tree;
use Illuminate\Support\Facades\Auth;
use Validator;

class TreeController extends BaseController
{
    /**
     * Index - список всех людей в дереве.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            $trees = Tree::where('user_id', $user->getAuthIdentifier())->get();
            return $this->sendResponse($trees->toArray(), 'Список деревьев.');
        } else {
            return $this->sendError('Пользователь не авторизован или ошибка по другой причине');
        }
    }
    /**
     * Store - добавляет в БД.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $user = Auth::user();
        $validator = Validator::make($input, [
            'name' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Ошибка входных параметров.', $input);
        }

        $input['user_id'] = $user->getAuthIdentifier();
        $tree = Tree::create($input);

        return $this->sendResponse($tree, 'Дерево успешно создан.');
    }
    /**
     * Show - Показывает конкретный элемент.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tree = Tree::find($id);
        if (is_null($tree)) {
            return $this->sendError('Не удалось найти дерево.');
        }
        return $this->sendResponse($tree->toArray(), 'Данные дерева.');
    }
    /**
     * Update - изменяет конкретный элемент.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tree $tree)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Ошибка входных параметров.', $validator->errors());
        }
        $tree->name = $input['name'];
        $tree->detail = $input['detail'];
//        $tree->save();
        return $this->sendResponse($tree->toArray(), 'Дерево успешно изменен.');
    }
    /**
     * Destroy - удаялет элемен из БД.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tree $tree)
    {
//        $tree->delete();

        return $this->sendResponse($tree->toArray(), 'Дерево успешно удален.');
    }
}
