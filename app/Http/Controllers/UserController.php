<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Redirect,Response;

class UserController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $action = '<center/>
                            <a class="btn btn-info" id="show-user" data-toggle="modal" data-id='.$row->id.'>รายละเอียด</a>
                            <a class="btn btn-success" onclick="editForm('.$row->id.')">แก้ไข</a>
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <a onclick="deleteData('.$row->id.')" class="btn btn-danger">ลบ</a>';
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('user.index');
    }

    public function store(Request $request)
    {
        $data=[
            'name' => $request['name'],
            'nickname' => $request['nickname'],
            'level' => $request['level'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'username' => $request['username'],
            //'password' => $request['password'],
            'password' => Hash::make($request['password']),
        ];
        return User::create($data);

    }

    /**
    * Display the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */

    public function show($id)
    {
        $where = array('id' => $id);
        $user = User::where($where)->first();
        return Response::json($user);
        //return view('users.show',compact('user'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */

    public function edit($id)
    {
        $user = User::find($id);
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

       // var_dump($request);
       // var_dump('testtttt');exit();

        $user = User::find($id);
       
        $user -> name=$request['name'];
        $user -> nickname=$request['nickname'];
        $user -> level=$request['level'];
        $user -> phone=$request['phone'];
        $user -> email=$request['email'];
        $user -> username=$request['username'];
        $user -> update();

        return $user;
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */

    public function destroy($id)
    {
        //$user = User::where('id',$id)->delete();
        //return Response::json($user);
        User::destroy($id);
        //return redirect()->route('users.index');
    }
}