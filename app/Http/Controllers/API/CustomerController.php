<?php
//
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Model\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getAll(){
        $customer = Customer::select('id','name','phone as phoneNumber','email','address','password')->get();
        if (count($customer)==0){
            return response("không tồn tại khách hàng",404);
        }
        return response(['clients'=>$customer],200);
    }
    public function detail(Request $request){
        $customer = Customer::select('id','name','phone as phoneNumber','email','address','password')->where('id',$request->id)->first();
        if ($customer == null){
            return response("không tồn tại khách hàng",404);
        }
        // $customer->delete();
        return response($customer,200);
    }
    public function delete(Request $request){
        $customer = Customer::find($request->id);
        if ($customer == null){
            return response("không tồn tại khách hàng",404);
        }
        $customer->delete();
        return response("xóa thành công",200);
    }
    public function dangki(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->phone = $request->phoneNumber;
        $customer->address = $request->address;
        $customer->email = $request->email;
        $customer->password = $request->password;
        $customer->save();
        return response($customer,200);
    }
    public function update(Request $request){
        $customer = Customer::find($request->id);
        $customer->name = $request->name;
        $customer->phone = $request->phoneNumber;
        $customer->address = $request->address;
        $customer->email = $request->email;
        $customer->password = $request->password;
        $customer->save();
        return response($customer,200);
    }
    public function doimatkhau(Request $request)
    {
        $customer = Customer::find($request->id);
        if ($customer!=null){
            if ($customer->password == $request->password){
                    if($request->passwordnew != $request->passwordagain){
                        return response("nhập lại mật khẩu không khớp",403);
                    }
                    else {
                        $customer->password = $request->passwordnew;
                        $customer->save();
                        return response(" đổi thành công",200);
                    }
            }
            else {
                return response(" mật khẩu cũ không khớp",403);
            }
        }
    }
}
