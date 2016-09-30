<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\CreateMenuRequest;
use App\Http\Controllers\Controller;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('sort', 'ASC')
            ->get()
            ->toArray();
        return view('admin.menu.index', [
            'menus' => Menu::unlimitedForLevel($menus, 0, '------')
        ]);
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    public function store(CreateMenuRequest $request)
    {
        if ('0' === $request->get('menu_parent_id')) {
            $parentId = 0;
        } else {
            $parentMenu = Menu::findOrFail($request->get('menu_parent_id'));
            $parentId = $parentMenu->id;
        }

        $menu = new Menu();
        $menu->name = trim($request->menu_name);
        $menu->url = $request->has('menu_url') ? trim($request->menu_url) : '';
        $menu->parent_id = $parentId;
        $menu->sort = '0';
        $menu->status = '0';
        if (!$menu->save()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(array('保存失败，请刷新页面后重试'));
        }
        return redirect()->route('admin.menus.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
