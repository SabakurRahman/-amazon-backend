<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function placeOrder(Request $request)
    {
        $order_address = $request->shippingAddress;
//        dd($order_address['fullName']);
//
        try {
            DB::beginTransaction();
            $order_address =OrderAddress::query()->create([
                'user_id'     => auth()->id(),
                'name'        => $order_address['fullName'],
                'address'     => $order_address['address'],
                'city'        => $order_address['city'],
                'post_code'   => $order_address['postalCode'],
                'country'     => $order_address['country'],
            ]);
            $order = Order::query()->create([
                'user_id'        => auth()->id(),
                'invoice_no' => 'INV-'.time(), // 'INV-'.time() . '-' . auth()->id(),
                'order_address'  => $order_address->id,
                'shipping_price' => $request->shippingPrice,
                'tax_price'      => $request->taxPrice,
                'total_price'    => $request->totalPrice,
                'payment_method' => $request->paymentMethod,
                'payment_status' => $request->payment_status,
                'order_status'   => $request->order_status,
            ]);
            if ($request->has('orderItems') && is_array($request->orderItems)) {
                foreach ($request->orderItems as $item) {
                    OrderItem::query()->create([
                        'order_id'          => $order->id,
                        'product_id'        => $item['id'],
                        'product_name'      => $item['name'],
                        'product_image'     => $item['image'],
                        'product_quantity'  => $item['qty'],
                        'product_price'     => $item['price'],
                        'slug'              => $item['slug'],
                    ]);
                }
            }
            else {
                // Handle the case when 'orderItems' is not present or is not an array
                // You might want to log an error or return a response indicating the issue.
                return response()->json(['error' => 'Invalid or missing orderItems data'], 400);
            }


            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], 500);


        }
        return response()->json([
            'order' => $order,
            'message' => 'Order placed successfully'
        ], 201);
    }

    public function getOrder($order_id)
    {
        $order = Order::query()->with('OrderAddress','orderItems')->where('id',$order_id)->first();
        return response()->json([
            'order' => $order,
            'message' => 'Order get successfully'
        ], 200);
    }

    public function updateOrder(Request $request, $order_id)
    {

        $order = Order::query()->where('id',$order_id)->first();
        $order->payment_status = 1;
        $order->paid_at = now();
        $order->save();
        return response()->json([
            'order' => $order,
            'message' => 'Order updated successfully'
        ], 200);
    }

    public function getOrdersByUser()
    {
        $orders = Order::with(['OrderAddress', 'orderItems'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc') // Assuming 'created_at' is the column representing the order's creation time
            ->get();
        return response()->json([
            'order' => $orders,
            'message' => 'Order get successfully'
        ], 200);
    }


}
