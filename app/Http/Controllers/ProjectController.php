<?php

namespace App\Http\Controllers;

use App\Models\project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Redirect,Response;

class ProjectController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = project::latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $action = '<center/>
                            <a class="btn btn-info" id="show-project" data-toggle="modal" data-id='.$row->ID_project.'>รายละเอียด</a>
                            <a class="btn btn-success" onclick="editForm('.$row->ID_project.')">แก้ไข</a>
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <a onclick="deleteData('.$row->ID_project.')" class="btn btn-danger">ลบ</a>';
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('project.index');
    }

    public function store(Request $request)
    {
        $data=[
            'code_project' => $request['code_project'],
            'name_project' => $request['name_project'],
            'name_office' => $request['name_office'],
        ];
        return project::create($data);

    }

    /**
    * Display the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */

    public function show($id)
    {
        $where = array('ID_project' => $id);
        $project = project::where($where)->first();
        return Response::json($project);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */

    public function edit($id)
    {


        //$project = DB::table('project')->where('ID_project', $id)->first();
        $project = project::find($id);
        // var_dump($project);exit();
        //var_dump('testtttt');
        return $project;
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

       // 
       // var_dump('testtttt');
        //exit();
        $project = project::find($id);
        //var_dump($id);
        //var_dump($request['code_project']);
        //var_dump($request['name_project']);
        //var_dump($request['name_office']);

        $project -> code_project=$request['code_project'];
        $project -> name_project=$request['name_project'];
        $project -> name_office=$request['name_office'];
        //var_dump($project);
        $project -> update();

        return $project;
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */

    public function destroy($id)
    {
        project::destroy($id);
    }
}