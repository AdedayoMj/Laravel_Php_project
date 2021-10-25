@extends('layouts.layout')


@section('content')
<div class="d-flex align-items-start justify-content-center content-margin position-ref full-height">

  <div class="content">
    <div class="row">
      <div class="col-lg-12 margin-tb">
        <div class="pull-right">
          <a class="btn btn-success text-light" type="button" data-toggle="modal" data-target="#addstock"> <i
              class="fas fa-plus-circle"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="title m-b-md">
      Stock List
    </div>
    @if(\Session::has('mssgadded'))
    <div class="alert alert-success ">
      <p class="mssgadded"><i class="fa fa-check" style='margin-right:0.2rem'
          aria-hidden="true"></i>{{session('mssgadded')}}</p>
    </div>
    @endif
    @if(\Session::has('mssgupdate'))
    <div class="alert alert-success ">
      <p class="mssgupdate"><i class="fa fa-check" style='margin-right:0.2rem'
          aria-hidden="true"></i>{{session('mssgupdate')}}</p>
    </div>
    @endif
    @if(\Session::has('mssgdelete'))
    <div class="alert alert-success ">
      <p class="mssgdelete"><i class="fa fa-check" style='margin-right:0.2rem'
          aria-hidden="true"></i>{{session('mssgdelete')}}</p>
    </div>
    @endif
    <table class="styled-table">
      <thead>
        <tr>
          <th>Company</th>
          <th>Unit price</th>
          <th>Updated at</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($stock as $stock)
        <tr>
          <td>{{$stock->company_name}}</td>
          <td class="moneyText">€ {{$stock->unit_price}}</td>
          <td>{{$stock->updated_at->todatestring()}}</td>
          <td>
            <div class="dropdown">
              <button class="btn btn-primary text-light " type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="/stock-info/{{$stock->id}}">Update unit price</a>
                <a class="dropdown-item">
                  <form method="post" action="/stock_delete/{{$stock->id}}">
                    @csrf
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-light dropdown-item">Delete stock</button>
                  </form>
                </a>


              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
      <table>


  </div>
</div>




@endsection