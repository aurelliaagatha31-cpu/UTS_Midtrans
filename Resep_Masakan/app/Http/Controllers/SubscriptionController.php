<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function index()
    {
        return view('subscription.index');
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();
        $amount = 50000; // Example: Rp 50.000 for 1 month premium
        $orderId = 'TRX-' . time() . '-' . Str::random(5);

        // Create transaction record
        $transaction = Transaction::create([
            'id' => $orderId,
            'user_id' => $user->id,
            'amount' => $amount,
            'status' => 'pending',
        ]);

        // Setup Midtrans parameters
       $params = [
    'transaction_details' => [
        'order_id' => $orderId,
        'gross_amount' => 1000,
    ],
    'customer_details' => [
        'first_name' => auth()->user()->name,
        'email' => $user->email,
    ],
    'enabled_payments' => [
        'bank_transfer',
        'gopay',
        'qris',
        'bca_va',
        'bni_va',
        'bri_va',
        'credit_card',
    ],
];

        try {
            $snapToken = Snap::getSnapToken($params);

            // Save token to transaction
            $transaction->update(['snap_token' => $snapToken]);

            return view('subscription.checkout', compact('snapToken', 'transaction'));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membuat transaksi: ' . $e->getMessage());
        }
    }
}
