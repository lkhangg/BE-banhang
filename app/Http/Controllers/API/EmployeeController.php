<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Model\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function getAll(){
        $employee = Employee::select('id','name as employee_name','gender as employee_gender','phone as employee_phone','user_name as employee_username','address as employee_address','password as employee_password')->get();
        return response(['employee'=>$employee],200);
    }
    public function insert(Request $request){
        $employee = new Employee(); // tạo đối tượng nhân viên
        $employee->name = $request->employee_name;
        $employee->gender = $request->employee_gender;
        $employee->phone = $request->employee_phone;
        $employee->address = $request->employee_address;
        $employee->user_name = $request->employee_username;
        $employee->password = $request->employee_password;
        $employee->save(); // lưu 
        return response('them thanh cong',200);
    }
    public function update(Request $request){
        $employee = Employee::find($request->id); // chỉ tìm theo ID
        if($employee==null){
            return response("khong tim thay",404);
        }
        $employee->name = $request->employee_name;
        $employee->gender = $request->employee_gender;
        $employee->phone = $request->employee_phone;
        $employee->address = $request->employee_address;
        $employee->user_name = $request->employee_username;
        $employee->password = $request->employee_password;
        $employee->save(); //lưu 
        return response('cap nhat thanh cong',200);
    }
    public function delete(Request $request){
        $employee = Employee::where('id',$request->id)->select('id','name as employee_name','gender as employee_gender','phone as employee_phone','user_name as employee_username','address as employee_address','password as employee_password')->first(); // lấy 1 
        if($employee==null){
            return response("khong tim thay",404);
        }
        $employee->delete(); // xóa
        return response('xoa thanh cong',200);
    }
    public function detail(Request $request){
        $employee = Employee::where('id',$request->id)->select('id','name as employee_name','gender as employee_gender','phone as employee_phone','user_name as employee_username','address as employee_address','password as employee_password')->first(); //lấy 1
        if($employee==null){
            return response("khong tim thay",404);
        }
        return response($employee,200);
    }
}
