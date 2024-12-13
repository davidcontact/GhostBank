<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Notifications\TransactionNotification;
use Exception;

class walletsController extends Controller
{
    public function index(){
        if (auth()->check()) {
            $getId = auth()->id();
            $Wallet = Wallet::where('user_id', $getId)->firstOrFail();
            // Get the recent transactions for the authenticated user's wallet
            $notifications = Notification::where('user_id', $getId)  // Get notifications for the current user
            ->whereIn('type', ['transaction', 'refund'])  // Filter by 'transaction' or 'refund' types
            ->latest()  // Sort by most recent
            ->limit(5)  // Limit to 5 recent notifications
            ->get();
            return view('wallet.index', ['wallet' => $Wallet, 'notifications' => $notifications]);
        } else {
            $wallet = null;
            $notifications = null;
            // Redirect to login page if not authenticated
            return view('wallet.index', ['wallet' => $wallet, 'notifications' => $notifications]);  // Or any other page you want
        }
    }

    public function Transaction(Request $request){
        
        $validated = $request->validate([
            'Address' => 'required|string|exists:wallets,wallet_address',
            'Amount' => 'required|numeric|min:0.01'
        ]);

        // dd($validated);

        // $sender = Auth::user();
        // $senderWallet = $sender->wallet;
        // dd($validated, $senderWallet, $sender);
        
        DB::beginTransaction();
        try {
            // Find the sender's wallet (assuming the logged-in user is sending money)
            $senderWallet = Wallet::where('user_id', auth()->id())->first();
            $recipientWallet = Wallet::where('wallet_address', $request->Address)->first();
            if($senderWallet->wallet_address == $request->Address){
                return back()->withErrors(['error' => 'Transaction failed. Please try again.']);
                dd("address is the same like");
            }else{

            // dd("breakkk");
            // dd($senderWallet, $recipientWallet);
            // Ensure the sender and recipient wallets exist
            if (!$senderWallet || !$recipientWallet) {
                return back()->withErrors(['error' => 'Wallet not found.']);
            }
    
            // Ensure the sender has sufficient balance
            if ($senderWallet->balance < $request->Amount) {
                return back()->withErrors(['error' => 'Insufficient funds.']);
            }

            // Deduct the amount from sender's wallet
            $senderWallet->balance -= $request->Amount;
            // dd($senderWallet->balance, $request->Amount);

            $senderWallet->save();
    
            // Add the amount to the recipient's wallet
            $recipientWallet->balance += $request->Amount;
            // dd($recipientWallet->balance += $request->Amount);

            $recipientWallet->save();
            // dd("gay?");

            // Create a transaction record
            $transaction = new Transaction([
                'sender_wallet_id' => $senderWallet->id,
                'recipient_wallet_id' => $recipientWallet->id,
                'amount' => $request->Amount,
                'currency_type' => $senderWallet->currency_type,
                'type' => 'transfer',
                'status' => 'completed', 
                'description' => 'Money transfer from ' . $senderWallet->user->name,
                'transaction_hash' => uniqid(), 
                'fee' => 0, 
            ]);
            // dd($transaction);
            $transaction->save();

            // Commit the transaction
            DB::commit();
    
            // Create a notification for both the sender and recipient
            $senderNotification = new Notification([
                'user_id' => auth()->id(),
                'transaction_id' => $transaction->id,
                'title' => 'Payment Completed',
                'message' => 'Your transfer to ' .$recipientWallet->user->name . ' was successful.',
                'type' => 'transaction',
                'status' => 'unread',
            ]);

            $senderNotification->save();
    
            $recipientNotification = new Notification([
                'user_id' => $recipientWallet->user_id,
                'transaction_id' => $transaction->id,
                'title' => 'Funds Received',
                'message' => 'You have received funds from ' . $senderWallet->user->name,
                'type' => 'transaction',
                'status' => 'unread',
            ]);
            // dd($senderNotification, $recipientNotification);

            $recipientNotification->save();
    
            // Return success message
            return redirect()->route('wallets')->with('success', 'Transaction successful!');
            }
        } catch (Exception $e) {
            dd("Break");
            // Rollback in case of failure
            DB::rollBack();
            return back()->withErrors(['error' => 'Transaction failed. Please try again.']);
        }
    

        
        // dd("Break");


        // return redirect()->route("wallets");
    }
}
