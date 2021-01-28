<?php

namespace App\Http\Controllers;

use App\Models\project;
use App\Models\location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use DataTables;
use Redirect,Response;

class LocationController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            //$data = location::latest()get();->orderBy('projects.ID_project', 'DESC')
            //$data = DB::table('location')->leftJoin('project', 'location.ID_project', '=', 'project.ID_project')->get();
            $data = location::leftJoin('projects', function($leftjoin) {
                $leftjoin->on('locations.ID_project', '=', 'projects.ID_project');
              })->get();
             
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $action = '<center/>
                            <a class="btn btn-info" id="show-location" data-toggle="modal" data-id='.$row->ID_location.'>รายละเอียด</a>
                            <a class="btn btn-success" onclick="editForm('.$row->ID_location.')">แก้ไข</a>
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <a onclick="deleteData('.$row->ID_location.')" class="btn btn-danger">ลบ</a>';
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('location.index');
    }

   // Fetch records
   public function add(){
        $proData['data'] = project::orderby("ID_project","asc")
        			->select('ID_project','code_project')
                    ->get();
        return response()->json($proData);
        //var_dump($proData);
    }
    public function store(Request $request)
    {   
        $data=[
            'name_location' => $request['name_location'],
            'ID_project' => $request['ID_project'],
        ];
        return location::create($data);
    }

    /**
    * Display the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */

    public function show($id)
    {
        $where = array('ID_location' => $id);
        $location = location::where($where)->first();
        return Response::json($location);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */

    public function edit($id)
    {
        $location = location::find($id);
        return $location;
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
        $location = location::find($id);

        $location -> name_location=$request['name_location'];
        $location -> ID_project=$request['ID_project'];
        $location -> update();

        return $location;
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */

    public function destroy($id)
    {
        location::destroy($id);
    }
}