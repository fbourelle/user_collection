<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('userslist');
    }

    public function update($id, Request $request)
    {
      DB::table('users')
            ->where('id', $id)
            ->update(['name' => $request->name, 'email' => $request->email, 'updated_at' => $request->updated_at]);
    }


}
