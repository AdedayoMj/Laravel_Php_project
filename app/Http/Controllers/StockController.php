<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Stock;
use App\Models\Purchase;
use App\Models\Client;

class StockController extends Controller
{
     public function index() {
        
        $stock = Stock::orderBy('unit_price','desc')->get();
        return view('stocks.index', [
            'stock' => $stock,
        ]);
     }
     public function show($id){
        // $purchase= DB::table('purchases AS p')
        //             ->join('stocks AS s','p.stock_id','=', 's.id')
        //             ->join('clients AS c','p.user_id','=', 'c.id')
        //             ->select('c.username','s.company_name','s.unit_price','p.volume','p.purchased_price',DB::raw('((p.volume*s.unit_price)-(p.volume*p.purchased_price)) as gainloss'))
        //             ->where('user_id', $id)->get();
        $stock= Stock::findorFail($id);
        return view('stocks.show',['stock'=>$stock] );
     }
     public function store(Request $request){
       
        $editStmt = new Stock;
        $editStmt->company_name = $request->input('company_name');
        $editStmt->unit_price = $request->input('unit_price');
         $editStmt->save();
     
  
       return redirect('/stock-info')->with('mssgadded', 'Stock  created !!!.');
    }
    public function update(Request $request){
       
         $data = Stock::find($request->id);
         $data->company_name=$request->company_name;
         $data->unit_price=$request->unit_price;
         $data->save();
         $client =DB::table('clients')->max('id');
         for ($i = 1; $i <= $client; $i++) 
         {
            $stock = Client::find($i);
            if($stock ){
               $profit=DB::table('purchases AS p')
               ->join('stocks AS s','p.stock_id','=', 's.id')
               ->join('clients AS c','p.user_id','=', 'c.id')
               ->select(DB::raw(' ((p.volume*s.unit_price)-(p.volume*p.purchased_price)) as interest'))
               ->where('user_id', $i)->get()->sum('interest');
               $cov=number_format($profit,2, ".", "");

               DB::table('clients')->where('id',$i)->update(['gain_loss'=>$cov ]);
            }
           
            }
     return redirect('/stock-info')->with('mssgupdate', 'Stock  updated !!!.');
  }
 
   public function delete($id){
      $stock = Stock::find($id);
      $stock->delete();
   return redirect('/stock-info')->with('mssgdelete', 'Stock  deleted !!!.');
}
}
