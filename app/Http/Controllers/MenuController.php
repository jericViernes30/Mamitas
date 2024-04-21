<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
class MenuController extends Controller
{
    public function dashboard(){
        $menu = Menu::all();
        return view('dashboard', ['menus' => $menu]);
    }
}
