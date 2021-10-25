@extends('layouts.layout')

@section('content')


<div class=" d-flex align-items-start justify-content-center content-margin position-ref full-height ">
  <div class="ml-4 purchase">

    <div class='title m-b-md h1  ' style=" font-size: 40px !important,">
      Edit stock
    </div>

    <form class="form-control role='form' styled-table animate col-lg-12 " action="/stock_update" method="post">
      @csrf
      <input type="hidden" name='id' value="{{$stock->id}}">
      <div class="input-group mb-3 mt-4">
        <input type="text" name="company_name" id="company_name" value="{{$stock->company_name}}" class="form-control"
          placeholder="Company name" aria-label="company_name" required aria-describedby="basic-addon1">
      </div>


      <div class="input-group mb-3 mt-4">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"> €</span>
        </div>
        <input type="number" step="any" name="unit_price" id="unit_price" value="{{$stock->unit_price}}"
          class="form-control" placeholder="Unit price" aria-label="unit_price" required
          aria-describedby="basic-addon1">
      </div>

      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>

</div>
@endsection