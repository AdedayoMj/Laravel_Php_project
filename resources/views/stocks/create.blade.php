<!-- Modal -->
<div class="modal fade" id="addstock" tabindex="-1" role="dialog" aria-labelledby="addstock" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <div class="col-sm-12">
          <h3 class="modal-title float-start" id="liststock">Add Stock</h3>
          <button type="button" class="close float-end" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

      </div>
      <div class="modal-body">
        <form class="modal-content animate" action="/stock_create" method="post">
          @csrf

          <div class="form-group">

            <input type="text" class="form-control" id="company_name" name="company_name"
              aria-describedby="basic-addon1" placeholder="Company name" required>

          </div>

          <div class="input-group mb-3 mt-4">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"> €</span>
            </div>
            <input type="number" step="any" name="unit_price" id="unit_price" class="form-control"
              placeholder="Unit price" aria-label="unit_price" required aria-describedby="basic-addon1">
          </div>

      </div>

      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>
<!-- @section('scripts') -->
<!-- @parent -->