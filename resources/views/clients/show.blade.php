@extends('layouts.layout')

@section('content')
<div class="d-flex align-items-start justify-content-center content-margin position-ref full-height">
  <div class="content">


    <div class="title-bd m-b-md">
      <span class="title-st">List clint's stock<span> <span class="userText">{{$client->username}}</span>
    </div>
    @if(\Session::has('success'))
    <div class="alert alert-success">
      <p>{{\Session::get('success')}}</p>
    </div>
    @endif
    <table class="styled-table">
      <thead>
        <tr>
          <th>Company</th>
          <th>Volume</th>
          <th>Unit price</th>
          <th>Current price</th>
          <th>Gain/Loss</th>

        </tr>
      </thead>
      @if($invested> 0)
      <tbody>
        @foreach($purchase as $purchase)
        <tr>
          <td>{{$purchase->company_name}}</td>
          <td class="moneyText">{{$purchase->volume}}</td>
          <td class="moneyText">{{$purchase->purchased_price}}</td>
          <td class="moneyText">{{$purchase->unit_price}}</td>
          <td class="moneyText">
            <div class="row">
              @if(($purchase->gainloss) > 0)
              <div style="color:green "> + € {{$purchase->gainloss}}</div>
              @elseif(($purchase->gainloss) <0) <div style="color:red  ">€ {{$purchase->gainloss}}
            </div>
            @else
            <div> <span>€</span> {{$purchase->gainloss}}</div>
            @endif
  </div>

  </td>

  </tr>

  @endforeach
  </tbody>
  <table>
    <div style="text-align: right">
      <div class="d-flex align-items-end justify-content-end row">
        <div class=" col-lg-2">
          Total
        </div>

        @if($profit > 0)
        <span style="color:green " class="col-lg-2 moneyText"> + € {{$profit}}</span>
        @elseif($profit <0) <span style="color:red " class="col-lg-2 moneyText">€ {{$profit}}</span>
          @else
          <span class="col-lg-2 moneyText">€ {{$profit}}</span>
          @endif

      </div>
      <div class="d-flex align-items-end justify-content-end row">
        <div class="col-lg-2">
          Invested
        </div>
        <span class="col-lg-2 moneyText">€ {{$invested}}</span>
      </div>
      <div>
        <div class="d-flex align-items-end justify-content-end row">
          <div class="col-lg-2">
            Performace
          </div>

          @if($performance > 0)
          <span style="color:green " class="col-lg-2 moneyText"> +{{$performance}}% </span>
          @elseif($performance < 0) <span style="color:red " class="col-lg-2 moneyText">
            {{$performance}}%</span>
            @else
            <span class="col-lg-2 moneyText">{{$performance}}%</span>
            @endif

        </div>
        <div>
          <div class="d-flex align-items-end justify-content-end row">
            <div class="col-lg-2">
              Cash Balance
            </div>
            <span class="col-lg-2 moneyText">€ {{$client->cash_balance}}</span>
          </div>
          <div>

          </div>

        </div>
      </div>



    </div>
    @else
    <div style="font-size: 20px">No available stock purchase</div>
    @endif
    @endsection