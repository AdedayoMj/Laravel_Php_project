@extends('layouts.layout')

@section('content')
<div class="d-flex align-items-start justify-content-center content-margin position-ref full-height ">
  <div class="purchase">

    <div class='title m-b-md '>
      Purchase stock
    </div>
    @if(\Session::has('mssg'))
    <div class="alert alert-success ">
      <p class="mssg"><i class="fa fa-check" style='margin-right:0.2rem' aria-hidden="true"></i>{{session('mssg')}}</p>
    </div>
    @endif
    @if(\Session::has('failupdate'))
    <div class="alert alert-success ">
      <p class="failupdate"><i class="fa fa-check" style='margin-right:0.2rem'
          aria-hidden="true"></i>{{session('failupdate')}}</p>
    </div>
    @endif
    <form class="modal-content styled-table  animate col-lg-12 " action="/purchase_stock" method="post">
      @csrf

      <div class="input-group mb-3">
        <select class="custom-select" name='client' id='client'>
          <option disabled selected>Choose client</option>
          @foreach($client as $client)
          <option value='{{$client->id}}'>{{$client->username}}</option>
          @endforeach
        </select>
      </div>

      <div class="input-group mb-3">

        <select class="custom-select" name='stock' id='stock'>
          <option disabled selected>Choose stock</option>
          @foreach($stock as $stock)
          <option value='{{$stock->id}}'>{{$stock->company_name}}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">

        <input type="number" class="form-control" name='volume' id="volume" aria-describedby="basic-addon1"
          placeholder="Volume" required>

      </div>

      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
    </form>
  </div>
</div>
@endsection