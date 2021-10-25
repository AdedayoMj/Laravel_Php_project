<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Stock;
use App\Models\Purchase;
use App\Models\Client;

class ClientController extends Controller
{
    public function index() {
   
        $client = Client::all();
        foreach($client as $req){
          $profit= DB::table('purchases AS p')
          ->join('stocks AS s','p.stock_id','=', 's.id')
          ->join('clients AS c','p.user_id','=', 'c.id')
          ->select(DB::raw(' ((p.volume*s.unit_price)-(p.volume*p.purchased_price)) as interest'))
          ->where('user_id', $req->id)->get()->sum('interest');
        }
       

return view('clients.index',['client'=>$client,] );
     }

     public function show($id){
        $purchase= DB::table('purchases AS p')
        ->join('stocks AS s','p.stock_id','=', 's.id')
        ->join('clients AS c','p.user_id','=', 'c.id')
        ->select('c.username','s.company_name','s.unit_price','p.volume','p.purchased_price',DB::raw('((p.volume*s.unit_price)-(p.volume*p.purchased_price)) as gainloss'))
        ->where('user_id', $id)->orderBy('volume','desc')->get();
        $client= Client::findorFail($id);
        $profit= DB::table('purchases AS p')
        ->join('stocks AS s','p.stock_id','=', 's.id')
        ->join('clients AS c','p.user_id','=', 'c.id')
        ->select(DB::raw(' ((p.volume*s.unit_price)-(p.volume*p.purchased_price)) as interest'))
        ->where('user_id', $id)->get()->sum('interest');
        
        $invested= DB::table('purchases AS p')
        ->join('stocks AS s','p.stock_id','=', 's.id')
        ->join('clients AS c','p.user_id','=', 'c.id')
        ->select(DB::raw('(p.volume*p.purchased_price) as invested'))
        ->where('user_id', $id)->get()->sum('invested');
          
        
          $profitConv=number_format($profit,2, ".", "");
          $investedConv=number_format($invested,2, ".", "");
          $performance= $invested > 0 ? number_format((($profit/$invested)*100),2, ".", ""): 0;

          $data=['purchase'=>$purchase, 'profit'=>$profitConv,'client'=>$client, 'invested'=> $investedConv, 'performance'=>$performance];
          return view('clients.show', $data );
     }
     
     public function store(Request $request) {
          $client= new Client;
          $client->username=$request->username;
          $client->save();
          error_log($client);
         return redirect('/client-info')->with('mssg', 'Client successfully created!!!.');
     }
     
}
