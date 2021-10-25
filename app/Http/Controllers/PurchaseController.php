<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Stock;
use App\Models\Client;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    public function create() {
        $stock = Stock::all();
        $client =Client:: all();
      
        return view('purchase.create', ['stock'=>$stock], ['client'=>$client]);
     }

     public function store(Request $request) {

        $stock =Stock::findorFail($request->stock);
        $userInfo=Client::findorfail($request->client);
        $calBalance=(($userInfo->cash_balance)-(($stock->unit_price)*($request->volume)));
        if($userInfo && (($userInfo->cash_balance)>=(($stock->unit_price)*($request->volume))) ){
        $userInfo->update(['cash_balance'=>$calBalance]);
        $purchase = new Purchase;
         $purchase->user_id=$request->client;
         $purchase->stock_id=$request->stock;
         $purchase->volume=$request->volume;
         $purchase->purchased_price=$stock->unit_price;
         $purchase->moneypaid=(($stock->unit_price)*($request->volume));
         $purchase->save();


      
        return redirect('/purchase_stock')->with ('mssg', 'Stock have been pruchased, check clients table to verify.');
      }else{
            return redirect('/purchase_stock')->with ('failupdate', 'Insufficient balance');
      }
         
     }
    
}
