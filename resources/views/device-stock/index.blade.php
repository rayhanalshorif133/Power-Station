@extends('layouts.admin.admin')


@section('head')
@endsection
@section('content')
<div class="card shadow-none">
  <div class="card-body">
    <div class="card shadow-none">
      <div class="card-body p-0 pb-3">
        <div class="row">
          <div class="col-md-6">
            <div class="card-header">
              <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                  <h5 class="mb-0">Device Stock List</h5>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex align-items-center justify-content-end my-3">
              <div id="bulk-select-replace-element">
                <button class="btn btn-falcon-success btn-sm newDeviceStockCreate" type="button" data-bs-toggle="modal"
                  data-bs-target="#newDeviceStockCreate">
                  <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span>
                  <span class="ms-1">New</span>
                </button>
              </div>
              <div class="d-none ms-3" id="bulk-select-actions">
                <div class="d-flex">
                  <select class="form-select form-select-sm userActionSelect" aria-label="Bulk actions">
                    <option selected="selected">Actions</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="delete">Delete</option>
                  </select>
                  <button class="btn btn-falcon-danger btn-sm ms-2 userApplyBtn" type="button">Apply</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="table-responsive scrollbar">
          <table class="table mb-0 customDataTable">
            <thead class="text-black bg-200">
              <tr>
                <th class="align-middle white-space-nowrap">
                  <div class="form-check mb-0"><input class="form-check-input" type="checkbox"
                      data-bulk-select='{"body":"bulk-select-body","actions":"bulk-select-actions","replacedElement":"bulk-select-replace-element"}' />
                  </div>
                </th>
                <th class="align-middle">Device Name</th>
                <th class="align-middle">Sender Name</th>
                <th class="align-middle">Stock Quantity</th>
                <th class="align-middle">Actions</th>
              </tr>
            </thead>
            <tbody id="bulk-select-body" class="collapsedTable">
              @foreach ($deviceStocks as $deviceStock)
              <tr id="deviceStockId-{{$deviceStock->id}}">
                <td class="align-middle white-space-nowrap">
                  <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" id="checkbox-1"
                      data-bulk-select-row="data-bulk-select-row" />
                  </div>
                </td>
                <td class="align-middle" data-toggle="tooltip" data-placement="top" title="View device details"
                  id="getDeviceId-{{$deviceStock->device->id}}">
                  <a href="{{route('device.show', $deviceStock->device->id)}}">{{ $deviceStock->device->name }}</a>
                </td>
                <td class="align-middle" id="getSeenderId-{{$deviceStock->user->id}}">
                  {{ $deviceStock->user->name }}
                </td>
                <td class="align-middle">
                  {{ $deviceStock->quantity }}
                </td>
                <td class="align-middle">
                  <div class="btn-group btn-group-sm btn-group-flush" role="group" aria-label="Basic example">
                    <button class="btn btn-falcon-primary btn-sm deviceStockUpdate" type="button" data-bs-toggle="modal"
                      data-bs-target="#deviceStockUpdate" data-toggle="tooltip" data-placement="top" title="Edit"><span
                        class="fas fa-pencil-alt"></span></button>
                    <button class="btn btn-falcon-danger btn-sm deviceStockDeleteBtn" type="button"
                      data-toggle="tooltip" data-placement="top" title="Delete"><span
                        class="fas fa-trash"></span></button>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@include('device-stock.newDeviceStockCreate')
@include('device-stock.deviceStockUpdate')
@endsection


@section('scripts')
{{-- <script src="{{asset('js/device/device-stock.js')}}"></script> --}}
<script>
  var id = 0;
  var setQuantity = 0;
  var getDeviceId = 0;
  var getSenderUserId = 0;
  var getQuantity = 0;
  var thisSeleted = 0;
  $(document).ready(function () {
    handleNewStockQuantity();
    deviceStockUpdate(); 
    deviceStockDeleteBtn(); 
    });

    function handleNewStockQuantity() {
      $('.newDeviceStockCreate').on('click', function () {
        $('.stockQuantity').val("0");
      });

      $(document).on('click','#minusBtn',function (){
        setQuantity = parseInt($('.stockQuantity').val()) - 1;
        if(setQuantity < 0){
          setQuantity = 0;
          toastr.error('Quantity can not be negative');
        }
        $('.stockQuantity').val(setQuantity);
        if(setQuantity > 0){
          $('.submitBtn').attr('disabled',false);
        }else{
          $('.submitBtn').attr('disabled',true);
        }
      });
      $(document).on('click','#plusBtn',function (){
        setQuantity = parseInt($('.stockQuantity').val()) + 1;
        $('.stockQuantity').val(setQuantity);
        if(setQuantity > 0){
        $('.submitBtn').attr('disabled',false);
        }else{
          $('.submitBtn').attr('disabled',true);
        }
      });

      $(document).on('keyup','.stockQuantity', function(){
        $('.submitBtn').attr('disabled',false);
        if($(this).val() > 0){
        $('.submitBtn').attr('disabled',false);
        }else{
        $('.submitBtn').attr('disabled',true);
        }
      });
    }

    function deviceStockUpdate(){
      $(document).on('click','.deviceStockUpdate',function (){
        $('#updateStockId').val($(this).closest('tr').attr('id').split('-')[1]);
        getDeviceId = $(this).closest('tr').find('td').eq(1).attr('id').split('-')[1];
        getSenderUserId = $(this).closest('tr').find('td').eq(2).attr('id').split('-')[1];
        getQuantity = $(this).closest('tr').find('td').eq(3).text();
        getQuantity = parseInt(getQuantity);
        $("#updateDeviceId").val(getDeviceId);
        $("#updateSeenderUserId").val(getSenderUserId);
        $('.stockQuantity').val(getQuantity);
      });
    }

    function deviceStockDeleteBtn(){
      $(document).on('click','.deviceStockDeleteBtn', function (){
        id = $(this).closest('tr').attr('id').split('-')[1];
        thisSeleted = $(this);
        swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        }).then((willDelete) => {
        if (willDelete) {
        swal("Done! Your data has been deleted", {
        icon: "success",
        });
        axios
        .delete(`/device-stock/${id}/delete`, {
        id: id,
        })
        .then(function (response) {
        let data = response.data;
        if (data.status == true) {
          thisSeleted.closest('tr').remove();
          toastr.success(data.message);
        } else {
        toastr.error(data.message);
        }
        });
        } else {
        swal("Your data is now deleted", {
        icon: "error",
        });
        }
        });
      });
    }
</script>

@endsection