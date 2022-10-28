<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaction;

use App\Models\User;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function deposit() {
        return view('deposit');
    }

    public function saveDeposit(Request $request) {
        $message = [
            'min'=> 'The :attribute must be above :min INR'
        ];
        $validator = Validator::make($request->all(), [
            'amount' => 'required|min:1|regex:/^\d+(\.\d{1,2})?$/'
        ], $message)->validate();
        $user_data=User::where('id', Auth::user()->id)->get('balance');
        $current_balance=$request->amount;
        foreach($user_data as $d) {
            $current_balance += $d->balance;
        }
        $deposit = new Transaction;
        $deposit->user_id = Auth::user()->id;
        $deposit->amount = $request->amount;
        $deposit->current_balance = $current_balance;
        $deposit->type = "Credit";
        $deposit->details = "Deposit";
        $save = $deposit->save();
        $data['balance']= $current_balance;

        $user = User::where('id', Auth::user()->id)->update($data);
      
        if($save) {
            return back()->with('success', 'Cash deposited successfully');
        }else {
            return back()->with('error', 'Something encountered with cash deposit. Please try again');
        }
    }


    public function withdraw() {
        return view('withdraw');
    }


    public function saveWithdraw(Request $request) {
        $message = [
            'min'=> 'The :attribute must be above :min INR'
        ];
        $validator = Validator::make($request->all(), [
            'amount' => 'required|min:1|regex:/^\d+(\.\d{1,2})?$/'
        ], $message)->validate();
        $user_data=User::where('id', Auth::user()->id)->get('balance');
        foreach($user_data as $d) {
            $current_balance = $d->balance;
        }
        $amount = $request->amount;
        if($current_balance < $amount) {
            return redirect()->back()->with('error', 'Insufficient fund to withdraw');
        }
        else {
            $current_balance=$current_balance-$amount;
            $withdraw = new Transaction;
            $withdraw->user_id = Auth::user()->id;
            $withdraw->amount = $amount;
            $withdraw->current_balance = $current_balance;
            $withdraw->type = "Debit";
            $withdraw->details = "Withdraw";
            $save = $withdraw->save();
            $data['balance']= $current_balance;
    
            $user = User::where('id', Auth::user()->id)->update($data);
          
            $save = $withdraw->save();
            if($save) {
                return back()->with('success', 'Cash withdrawed successfully');
            }else {
                return back()->with('error', 'Something encountered with cash withdraw. Please try again');
            }
        }
    }
    public function transfer() {
        return view('transfer');
    }



    public function saveTransfer(Request $request) {
        $message = [
            'min'=> 'The :attribute must be above :min INR'
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'amount' => 'required|min:1|regex:/^\d+(\.\d{1,2})?$/'
        ], $message)->validate();
        $email = $request->email;
        $amount = $request->amount;
        $user_data=User::where('id', Auth::user()->id)->get('balance');
        foreach($user_data as $d) {
            $balance = $d->balance;
        }

       ;
        
        if($email === Auth::user()->email) {
            return redirect()->back()->with('error', 'You cannot transfer fund to yourself. Please try with another registered email');
        }
        
        else {
            $email_exists = User::where('email', $email)->first();
            if(!$email_exists) {
                return redirect()->back()->with('error', 'Email address not found. Please try with registered e-mail address.');
            }else {
                $to_user = $email_exists->id;
            }
            if($amount > $balance) {
                return redirect()->back()->with('error', 'Insufficient fund to transfer');
            }

            $balance=$balance-$amount;
            $withdraw = new Transaction;
            $withdraw->user_id = Auth::user()->id;
            $withdraw->amount = $amount;
            $withdraw->current_balance = $balance;
            $withdraw->type = "Debit";
            $withdraw->details = "Transfer to ". Auth::user()->email;
            $save = $withdraw->save();

            $data['balance']= $balance;
    
            $user = User::where('id', Auth::user()->id)->update($data);

            $current_balance=$email_exists->balance;
            
            $current_balance=$current_balance+$amount;
            $deposit = new Transaction;
            $deposit->user_id = $to_user;
            $deposit->amount = $request->amount;
            $deposit->current_balance = $current_balance;
            $deposit->type = "Credit";
            $deposit->details = "Transfer from ".$email;
            $save = $deposit->save();
            $data['balance']= $current_balance;
            $user = User::where('id', $to_user)->update($data);

            
            if($save) {
                return back()->with('success', 'Fund Transfered successfully');
            }else {
                return back()->with('error', 'Something encountered with fund transfer. Please try again');
            }
        }
        
    }
    public function statement() {
        $statement = [];
        $statement = Transaction::where('user_id', Auth::user()->id)->get();
        
      
        return view('statement', compact('statement'));
    }
    
 
}
