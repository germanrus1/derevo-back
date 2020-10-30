<?php

namespace App\Http\Controllers\API;

use App\Models\Tree;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\TreeItem;
use Validator;

class TreeItemController extends BaseController
{

    public function treeItemList($id)
    {
        if ($id) {
            $tree = Tree::find($id);
            $treeItemList = TreeItem::where('tree_id', $id)->get();

            return $this->sendResponse(
                [
                    'tree' => $tree,
                    'items' => $treeItemList->toArray(),
                ],
                'Список людей.'
            );
        } else {
            return $this->sendError('Отсутсвтует id дерева',);
        }
    }
    /**
     * Index - список всех людей в дереве.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        if ($input['tree_id']) {
//            $treeItems = TreeItem::find(['tree_id' => $input['tree_id']]);
//            return $this->sendResponse($treeItems->toArray(), 'Список людей.');
//        } else {
//            return $this->sendError('Отсутсвтует id дерева',);
            return $this->sendError('Метод не работает. Доделать или удалить метод',);
//        }
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

        if(empty($input)){
            return $this->sendError('Ошибка входных параметров.', $input);
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
    public function show(Request $request, $id)
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

        $treeItem->update($input);
        return $this->sendResponse($treeItem, 'Успешно изменен.');
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
