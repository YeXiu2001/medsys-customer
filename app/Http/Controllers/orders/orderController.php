<?php

namespace App\Http\Controllers\orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class orderController extends Controller{
    public function index(Request $request){
        $userId = $request->session()->get('user_id');

        if (!$userId) {
            return redirect('/customer/login');
        }
        $user = DB::table('user_customers')->where('id', $userId)->first();

        $open_transactions = DB::table('trans_order as to')
        ->join('pharmacy_info as pi', 'to.pharmacy_id', '=', 'pi.id')
        ->select('to.*', 'pi.name as pharmacy_name')
            ->where('to.customer_id', $userId)
            ->where('trans_status', 'O')
            ->orderBy('to.created_at', 'desc')
            ->get();

        $closed_transactions = DB::table('trans_order as to')
        ->join('pharmacy_info as pi', 'to.pharmacy_id', '=', 'pi.id')
        ->select('to.*', 'pi.name as pharmacy_name')
            ->where('to.customer_id', $userId)
            ->where('trans_status', '!=', 'O')
            ->orderBy('to.created_at', 'desc')
            ->paginate(5);

        return view ('orders.transactions', [
            'user' => $user,
            'ots' => $open_transactions,
            'cts' => $closed_transactions
        ]);
    }

    public function order(Request $request, $pharmaId){
        $userId = $request->session()->get('user_id');

        if (!$userId) {
            return redirect('/customer/login');
        }
        $user = DB::table('user_customers')->where('id', $userId)->first();

        $meds = DB::table('pharmacy_meds as pm')
                ->join('medicines as m', 'pm.med_id', '=', 'm.id')
                ->where('pm.pharmacy_id', $pharmaId)
                ->select(
                    'pm.id as pharmed_id',
                    'pm.pharmacy_id',
                    'm.name as medname',
                    'pm.med_id as medId',
                    'pm.med_description as description',
                    'pm.price as price',
                    'pm.stocks',
                    'pm.is_prescribed',
                    'pm.is_yellow',
                    'pm.dosage',
                    'pm.enable'
                )
                ->get();
                
        return view('orders.order', [
            'meds' => $meds,
            'user' => $user,
            'pharmaId' => $pharmaId
        ]);
    }

    public function checkout(Request $request) {
        $userId = $request->session()->get('user_id');
        
        if (!$userId) {
            return redirect('/customer/login');
        }
        
        DB::beginTransaction();
        try {
            $cartdata = $request->input('cart');
        
            if (is_null($cartdata)) {
                return response()->json(['status' => 'error', 'message' => 'No data provided.'], 400);
            }
    
            // Insert into trans_order table
            $orderInserted = DB::table('trans_order')->insert([
                'pharmacy_id' => $cartdata['pharmacy_id'],
                'customer_id' => $userId,
                'trans_status' => 'O', //open
                'pay_status' => 'U', //unpaid
                'prep_status' => 'Pending',
                'pay_method' => 'Cash',
                'subtot_amt' => $cartdata['subtotal_amnt'],
                'total_due' => $cartdata['total_due'],
                'total_discount' => 0.00,
                'created_by' => $userId,
                'created_at' => now(),
            ]);
    
            if (!$orderInserted) {
                throw new \Exception('Failed to insert into trans_order table');
            }
    
            $orderId = DB::getPdo()->lastInsertId();
            
            // Insert items into trans_items table
            foreach ($cartdata['items'] as $item) {
                $itemInserted = DB::table('trans_items')->insert([
                    'order_id' => $orderId,
                    'med_id' => $item['med_id'],
                    'med_name' => $item['medname'],
                    'pharmed_id' => $item['pharmed_id'],
                    'qty' => $item['qty'],
                    'base_price' => $item['base_price'],
                    'total_price' => $item['total_price'],
                    'created_by' => $userId,
                    'created_at' => now(),
                ]);
    
                if (!$itemInserted) {
                    throw new \Exception('Failed to insert into trans_items table');
                }
            }
        
            DB::commit();
            return response()->json([
                'status' => 'success', 
                'message' => 'Order processed successfully.'
            ]);
        
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Log the actual error message for debugging purposes
            Log::error('Order processing failed: ' . $e->getMessage());
    
            return response()->json([
                'status' => 'error', 
                'message' => 'An error occurred while processing your order. Please try again later.',
                'error_details' => $e->getMessage(),  // Add error details to the response for debugging
            ]);
        }
    }

    public function viewItems(Request $request, $orderId){
        $userId = $request->session()->get('user_id');

        if (!$userId) {
            return redirect('/customer/login');
        }
        $user = DB::table('user_customers')->where('id', $userId)->first();
        
        $items = DB::table('trans_items')
            ->join('pharmacy_meds','trans_items.pharmed_id','=','pharmacy_meds.id')
            ->select('trans_items.*', 'pharmacy_meds.*')
            ->where('trans_items.order_id', $orderId)
            ->get();

        return view('orders.items', [
            'order_id' => $orderId,
            'user' => $user,
            'items' => $items
        ]);
    }
    
    
}

