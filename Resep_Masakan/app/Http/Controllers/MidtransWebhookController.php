<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Transaction;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('Midtrans callback masuk', $request->all());

        $orderId = $request->input('order_id');
        $status = $request->input('transaction_status');
        $paymentType = $request->input('payment_type');

        $transaction = Transaction::where('id', $orderId)->first();

        if (!$transaction) {
            Log::warning('Transaction tidak ditemukan', [
                'order_id' => $orderId
            ]);

            return response()->json([
                'status' => 'ok',
                'message' => 'Transaction not found'
            ], 200);
        }

        // Status Midtrans:
        // settlement/capture = berhasil
        // pending = menunggu pembayaran VA
        // expire/cancel/deny/failure = gagal
        if ($status === 'settlement' || $status === 'capture') {
            $transaction->update([
                'status' => 'success',
            ]);

            $user = $transaction->user;

            if ($user) {
                $user->is_premium = true;
                $user->subscription_ends_at = date('Y-m-d H:i:s', strtotime('+30 days'));
                $user->save();
            }
        } elseif ($status === 'pending') {
            $transaction->update([
                'status' => 'pending',
            ]);
        } elseif (in_array($status, ['expire', 'cancel', 'deny', 'failure'])) {
            $transaction->update([
                'status' => 'failed',
            ]);
        } else {
            $transaction->update([
                'status' => $status,
            ]);
        }

        return response()->json([
            'status' => 'ok'
        ], 200);
    }
}