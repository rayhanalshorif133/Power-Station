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
                  <h5 class="mb-0">Goods Tools/Devices List</h5>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex align-items-center justify-content-end my-3">
              <div id="bulk-select-replace-element">
                <button class="btn btn-falcon-success btn-sm newDeviceToolsCreate" type="button" data-bs-toggle="modal"
                  data-bs-target="#newDeviceToolsCreate">
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
                <th class="align-middle">Image</th>
                <th class="align-middle">Device Name</th>
                <th class="align-middle">Category</th>
                <th class="align-middle">Description</th>
                <th class="align-middle">Added By</th>
                <th class="align-middle">Actions</th>
              </tr>
            </thead>
            <tbody id="bulk-select-body" class="collapsedTable">
              @foreach ($goodsTools as $goodsTool)
              <tr>
                <td class="align-middle white-space-nowrap">
                  <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" id="checkbox-1"
                      data-bulk-select-row="data-bulk-select-row" />
                  </div>
                </td>
                <td class="align-middle imageUrl" id="{{$goodsTool->image}}">
                  <a href="{{asset($goodsTool->image)}}" data-gallery="gallery-2">
                    <img src="{{asset($goodsTool->image)}}" alt="{{$goodsTool->title}}"
                      style="max-width: 100% !important;" height="40" width="40" />
                  </a>
                </td>
                <td class="align-middle" id="{{$goodsTool->device->id}}">{{$goodsTool->device->name}}</td>
                <td class="align-middle" id="{{$goodsTool->device->deviceCategory->id}}">
                  {{$goodsTool->device->deviceCategory->name}}</td>
                <td class="align-middle">
                  @if($goodsTool->description != null)
                  {{$goodsTool->description}}
                  @else
                  <span class="badge badge-soft-info">No Description</span>
                  @endif
                </td>
                <td class="align-middle">{{$goodsTool->addedBy->name}}</td>
                <td class="align-middle">
                  <div class="btn-group btn-group-sm btn-group-flush" id="goodsToolId-{{$goodsTool->id}}" role="group"
                    aria-label="Basic example">
                    <a class="btn btn-sm btn-falcon-primary" href="{{route('goods-tools.show', $goodsTool->id)}}"
                      data-toggle="tooltip" data-placement="top" title="View">
                      <i class="far fa-eye"></i>
                    </a>
                    <a class="btn btn-sm btn-falcon-info editDeviceTools" id="" data-bs-toggle="modal"
                      data-bs-target="#editDeviceTools" data-toggle="tooltip" data-placement="top" title="Edit">
                      <span class="fas fa-pencil-alt"></span>
                    </a>
                    <a class="btn btn-sm btn-falcon-danger deviceToolsDeleteBtn" id="" data-toggle="tooltip"
                      data-placement="top" title="Delete">
                      <span class="fas fa-trash"></span>
                    </a>
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
@include('goods-tools.newDeviceToolsCreate')
@include('goods-tools.editDeviceTools')
@endsection


@section('scripts')
{{-- <script src="{{asset('js/device/device-stock.js')}}"></script> --}}
<script>
  var id = "";
  var getDeviceId = 0;
  var getCategoryId = 0;
  var description = "";
  var getImageUrl = "";
  var thisSeleted = 0;
  var selectedRoom = 0;
  var selectedRack = 0;
  var selectedRoomDataDetails = '';
  $(document).ready(function () {
    searchBySelectedCategory();
    searchBySelectedRoomAndShelf();
    editDeviceTools(); 
    deviceToolsDeleteBtn(); 
    });

    function searchBySelectedRoomAndShelf() {
      $('#roomId').on('change', function () {
        selectedRoom = $(this).val();
        axios.get(`/goods-tools/fetchRacks/${selectedRoom}/byRoomId`)
              .then(function (response) {
                let {rack,roomDetails} = response.data.data;
                selectedRoomDataDetails = roomDetails;
                $('#rackId').find('option').remove();
                rack = parseInt(rack);
                $('#rackId').append(`<option value="" disabled selected>Select Rack</option>`);
                for (let i = 1; i < rack+1; i++) {
                  $('#rackId').append($('<option>', {
                    value: i,
                    text: "Rack-" + i
                  }));
                }
              });
      });
      $('#rackId').on('change', function () {
        selectedRack = $(this).val();
        $('#shelfId').find('option').remove();
        for (let index = 0; index < selectedRoomDataDetails.length; index++) {
          if(selectedRoomDataDetails[index].rack == selectedRack){
            let shelf = selectedRoomDataDetails[index].shelf;
            $('#shelfId').append($('<option>', {
              value: shelf,
              text: "Shelf-" + shelf
            }));
          }
        }
      });
    }

    function searchBySelectedCategory() {
      $('#categoryId').on('change', function () {
        var selectedCategoryId = $(this).val();
        $('.noDeviceFound').addClass('d-none');
        $('#deviceId').removeClass('d-none');
        axios.get(`/goods-tools/fetchDevices/${selectedCategoryId}/byCategoryId`)
            .then(function (response) {
              var devices = response.data.data;
              if(devices.length > 0) {
                $('#deviceId').find('option').remove();
                $.each(devices, function (key, value) {
                $('#deviceId').append($('<option>', {
                    value: value.id,
                    text : value.name
                  }));
                });
              }else{
                $('#deviceId').find('option').remove();
                $('.noDeviceFound').removeClass('d-none');
                $('#deviceId').addClass('d-none');
              }
             
            })
      });
    }

    function editDeviceTools(){
      $(document).on('click','.editDeviceTools',function (){
        id = $(this).parent().attr('id').split('-')[1];
        $('#goodsToolsID').val(id);
        axios.get(`/goods-tools/${id}/fetch`)
            .then(function(response){
              let data = response.data.data;
              $("#editDeviceId").val(data.device_id);
              $("#editCategoryId").val(data.device_category_id);
              $("#editDescription").val(data.description);
              let image = "/" + data.image;
              $(".setImage img").attr('src',image);
        });

      });
    }

    function deviceToolsDeleteBtn(){
      $(document).on('click','.deviceToolsDeleteBtn', function (){
        id = $(this).parent().attr('id').split('-')[1];
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
        .delete(`/goods-tools/${id}/delete`, {
        id: id,
        })
        .then(function (response) {
        let data = response.data;
        if (data.status == true) {
          toastr.success(data.message);
          location.reload();
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