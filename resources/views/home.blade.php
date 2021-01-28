@extends('layouts.main')

@section('content')
    <div class="containner">
        <div class="row">
            <div class="col-sm-12">
                <h2 aling="center">จัดการสมาชิก</h2>
                <a href="/member/create" class="btn btn-primary my-2">เพิ่มสมาชิก</a>
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col"><center/>ลำดับ</th>
                        <th scope="col"><center/>ชื่อ-สกุล</th>
                        <th scope="col"><center/>ระดับผู้ใช้งาน</th>
                        <th scope="col"><center/>เบอร์โทรศัพท์</th>
                        <th scope="col"><center/>ชื่อผู้ใช้</th>
                      </tr>
                    </thead>
                    {{-- <tbody>
                        <p hidden>{{$n=1}} </p>
                        @foreach ($data as $row)
                         <tr>
                            <th scope="row"><center/>{{$n}}</th>
                            <td>{{$row->name}}</td>
                            <td><center/>{{$row->level}}</td>
                            <td><center/>{{$row->phone}}</td>
                            <td>{{$row->username}}</td>
                            <td><center/><a href="{{route('member.edit',$row->id)}}" class="btn btn-warning">แก้ไข</a></td>
                            <td>
                                <form action="{{route('member.destroy',$row->id)}}" method="POST">
                                    @csrf @method('DELETE')
                                    <center/><input type="submit" value="ลบ" data-name="{{$row->name}}" class="btn btn-danger deleteForm">
                                </form>
                            </td>
                            
                        </tr> 
                        <p hidden>{{$n++}} </p> 
                        @endforeach
                      
                    </tbody> --}}
                  </table>
            </div>
        </div>
    </div>
@endsection