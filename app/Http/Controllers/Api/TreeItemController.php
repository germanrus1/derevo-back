<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\TreeItem;
use Validator;

class TreeItemController extends BaseController
{
    /**
     * Index - список всех людей в дереве.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->all();

        if ($input['tree_id']) {
            $products = TreeItem::find(['tree_id' => $input['tree_id']]);
            return $this->sendResponse($products->toArray(), 'Список людей.');
        } else {
            return $this->sendError('Отсутсвтует id дерева',);
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
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Ошибка входных параметров.', $validator->errors());
        }
        $treeItem = TreeItem::create($input);
        return $this->sendResponse($treeItem->toArray(), 'Успешно добавлен.');
    }
    /**
     * Show - Показывает конкретный элемент.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $treeItem = TreeItem::find($id);
        if (is_null($treeItem)) {
            return $this->sendError('Не удалось найти человека.');
        }
        return $this->sendResponse($treeItem->toArray(), 'Данные человека.');
    }
    /**
     * Update - изменяет конкретный элемент.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TreeItem $treeItem)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Ошибка входных параметров.', $validator->errors());
        }
        $treeItem->name = $input['name'];
        $treeItem->detail = $input['detail'];
        $treeItem->save();
        return $this->sendResponse($treeItem->toArray(), 'Успешно изменен.');
    }
    /**
     * Destroy - удаялет элемен из БД.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TreeItem $treeItem)
    {
        $treeItem->delete();
        return $this->sendResponse($treeItem->toArray(), 'Успешно удален.');
    }
}
