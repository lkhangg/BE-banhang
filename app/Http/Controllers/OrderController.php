<?php

namespace App\Http\Controllers;

use App\Models\Model\Customer;
use App\Models\Model\Image;
use App\Models\Model\Order;
use App\Models\Model\OrderDetail;
use App\Models\Model\Product;
use App\Models\Model\ProductDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //đặt hàng
    public function order(Request $request){
        $a = $request->cart[0];
        // lúc lấy thông tin khách hàng
        $id_user = $a['clientID']; //lấy id của khách hàng
       $c =  $a["order"]; // lấy list sản phẩm order
       //tạo order mới 
       $order = new Order();
       $order->customer_id = $id_user;
       $order->order_total =0;
       $order->payment_status = 0; //trạng thía thanh toán
       $order->save(); // lưu đơn hàng
//    $c[0] là phần tử đầu tiên trong mảng
        //chạy vòng lặp 
        $total = 0;
        foreach ($c as $key => $item){
           $order_item = new OrderDetail(); // khởi tạo chi tiết đơn hàng
           $order_item->order_id = $order->id;
           $order_item->product_id = $item['id'];
           $product = Product::find($item['id']);
           $order_item->price = $product->price;
           $order_item->color = $item['color'];
           $order_item->size = $item['size'];
           $order_item->quantity = $item['amount'];
           $total+= $product->price*$item['amount'];
           $order_item->save();
        }
        $order->order_total = $total;
        $order->save();
        // return response( var_dump($c),200);
        return response("đặt hàng thành công",200);
    }
    // get toàn bộ đơn hàng của user
    public function getAll(Request $request){
        // $a = Order::select('id', 'customer_id as clientID')->where('customer_id',$request->customer_id)->get();
        $a = Order::select('id', 'customer_id as clientID')->get();
        foreach($a as $item){
            // $item->id = $item;
            // $item->client = 0;
            $orderdetail = OrderDetail::select('product_id as id','color','size','quantity as amount')->where('order_id',$item->id)->get();
            foreach($orderdetail as $key=> $item1){
                $item1->index = $key;

                $product= Product::select('id','name','price','type as purpose','imgURL as imgSrc','total_product as number')->where('id',$item1->id)->first();
                if($product == null){
                    return response('sản phẩm không tồn tại',404);
                }

                $image = Image::where('product_id',$product->id)->get();
                if($image->count()>=1){
                    $img = array();
                    foreach($image as $item2){
                        array_push($img,$item2->image);
                    }
                    $product->details_sideImg = $img;
                }

                $product_detail = ProductDetail::where('product_id',$product->id)->get();
                    $size = array();
                    $color = array();
                    if(count($product_detail)>=1){
                        $size = array();
                        $color = array();
                        // $number = array();
                        foreach($product_detail as $detail){
                            array_push($size,$detail->size);
                            array_push($color,$detail->color);
                        }
                    }
                $product->size = $size;
                $product->color = $color;

                $item1->array = [$product];
            }
            $item->order = $orderdetail;
        }
        return response(['cart'=>$a],200);
    }
    // get theo sdt 
    public function getorderbysdt(Request $request){
        $customer = Customer::where("phone",$request->phone)->first();
        if ($customer==null){
            return response("nguoi dung khong ton tai",404);
        }
        $a = Order::select('id', 'customer_id as clientID')->where('customer_id',$customer->id)->get();
        foreach($a as $item){
            // $item->id = $item;
            // $item->client = 0;
            $orderdetail = OrderDetail::select('product_id as id','color','size','quantity as amount')->where('order_id',$item->id)->get();
            foreach($orderdetail as $key=> $item1){
                $item1->index = $key;

                $product= Product::select('id','name','price','type as purpose','imgURL as imgSrc','total_product as number')->where('id',$item1->id)->first();
                if($product == null){
                    return response('sản phẩm không tồn tại',404);
                }

                $image = Image::where('product_id',$product->id)->get();
                if($image->count()>=1){
                    $img = array();
                    foreach($image as $item2){
                        array_push($img,$item2->image);
                    }
                    $product->details_sideImg = $img;
                }

                $product_detail = ProductDetail::where('product_id',$product->id)->get();
                    $size = array();
                    $color = array();
                    if(count($product_detail)>=1){
                        $size = array();
                        $color = array();
                        // $number = array();
                        foreach($product_detail as $detail){
                            array_push($size,$detail->size);
                            array_push($color,$detail->color);
                        }
                    }
                $product->size = $size;
                $product->color = $color;

                $item1->array = [$product];
            }
            $item->order = $orderdetail;
        }
        return response(['cart'=>$a],200);
    }
    public function getorderbyname(Request $request){
        $customer = Customer::where("name",$request->name)->first();
        if ($customer==null){
            return response("nguoi dung khong ton tai",404);
        }
        $a = Order::select('id', 'customer_id as clientID')->where('customer_id',$customer->id)->get();
        foreach($a as $item){
            // $item->id = $item;
            // $item->client = 0;
            $orderdetail = OrderDetail::select('product_id as id','color','size','quantity as amount')->where('order_id',$item->id)->get();
            foreach($orderdetail as $key=> $item1){
                $item1->index = $key;

                $product= Product::select('id','name','price','type as purpose','imgURL as imgSrc','total_product as number')->where('id',$item1->id)->first();
                if($product == null){
                    return response('sản phẩm không tồn tại',404);
                }

                $image = Image::where('product_id',$product->id)->get();
                if($image->count()>=1){
                    $img = array();
                    foreach($image as $item2){
                        array_push($img,$item2->image);
                    }
                    $product->details_sideImg = $img;
                }

                $product_detail = ProductDetail::where('product_id',$product->id)->get();
                    $size = array();
                    $color = array();
                    if(count($product_detail)>=1){
                        $size = array();
                        $color = array();
                        // $number = array();
                        foreach($product_detail as $detail){
                            array_push($size,$detail->size);
                            array_push($color,$detail->color);
                        }
                    }
                $product->size = $size;
                $product->color = $color;

                $item1->array = [$product];
            }
            $item->order = $orderdetail;
        }
        return response(['cart'=>$a],200);
    }
}
