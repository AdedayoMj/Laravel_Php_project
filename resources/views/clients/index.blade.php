@extends('layouts.layout')

@section('content')

<div class="d-flex align-items-start justify-content-center content-margin position-ref full-height">
  <div class="content">
    <div class="row">
      <div class="col-lg-12 margin-tb">
        <div class="pull-right">
          <a class="btn btn-success text-light" type="button" data-toggle="modal" data-target="#addclient"> <i
              class="fas fa-plus-circle"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="title m-b-md">
      Client List
    </div>
    @if(\Session::has('mssg'))
    <div class="alert alert-success ">
      <p class="mssg"><i class="fa fa-check" style='margin-right:0.2rem' aria-hidden="true"></i>{{session('mssg')}}</p>
    </div>
    @endif
    <table class="styled-table">
      <thead>
        <tr>
          <th>Clients</th>
          <th>Cash Balance</th>
          <th>Gain/Loss</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($client as $client)
        <tr>
          <td>{{$client->username}}</td>
          <td class="moneyText">€ {{$client->cash_balance}}</td>
          <td class="moneyText">
            <div class="row">
              @if(($client->gain_loss) > 0)
              <div style="color:green "> + € {{$client->gain_loss}}</div>
              @elseif(($client->gain_loss) <0) <div style="color:red  ">€ {{$client->gain_loss}}
            </div>
            @else
            <div> <span>€</span> {{$client->gain_loss}}</div>
            @endif

          </td>
          <td>
            <div class="dropdown">
              <button class="btn btn-primary text-light " type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="/clients-purchase-info/{{$client->id}}">View stocks</a>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
      <table>

  </div>

  <!-- Modal -->
  <div class="modal fade" id="addclient" tabindex="-1" role="dialog" aria-labelledby="addclient" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">

          <div class="col-sm-12">
            <h3 class="modal-title float-start" id="liststock">Add Client</h3>
            <button type="button" class="close float-end" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

        </div>
        <div class="modal-body">
          <form class="modal-content animate" enctype="multipart/form-data" role="form" action='/addclient'
            method="post">
            @csrf
            <div class="modal-body">
              <div class="input-group mb-3 mt-4">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"> @</span>
                </div>
                <input type="text" required name="username" id="username" class="form-control" placeholder="Username"
                  aria-label="Unit_Price" required aria-describedby="basic-addon1">
              </div>
            </div>
        </div>


        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
        </form>
      </div>
    </div>
  </div>

</div>
@endsection