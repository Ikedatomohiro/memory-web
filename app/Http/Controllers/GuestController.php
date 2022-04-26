<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * イベント作成画面
     * 
     * 
     * 
     */
    public function create(Request $request)
    {

        return view('guest.create');
    }

    /**
     * 参加者登録処理
     * 
     * @access public
     */
    public function store(Request $request)
    {
        return redirect('/guest');
    }


}
