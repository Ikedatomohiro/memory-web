<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * イベントトップページ
     * 
     * @access public
     * 
     */
    public function index(Request $request)
    {
    print_r($request['id']);exit();
        return view('event.index');
    }

    /**
     * イベント削除
     * 
     * @access public
     * 
     */
    public function destroy($id)
    {
        echo $id;
        echo 'ldjalkjfljllllll';exit();

        return redirect('/events');
    }



}
