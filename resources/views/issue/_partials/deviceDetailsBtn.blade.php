@role('admin')
<button class="btn btn-falcon-info btn-sm editBtnIssueHasDevice m-1 px-2" type="button">
    <span class="fas fa-edit" data-fa-transform="shrink-3 down-1"></span>
</button>
<button class="btn btn-falcon-success btn-sm checkBtnIssueHasDevice d-none m-1 px-2" type="button">
    <span class="fas fa-check" data-fa-transform="shrink-3 down-1"></span>
</button>
<button class="btn btn-falcon-danger btn-sm deleteBtnIssueHasDevice m-1" type="button"
    style="padding: 3px 10px !important;">
    <span class="fas fa-trash" data-fa-transform="shrink-3 down-1"></span>
</button>
@else
@if($issueHasDevice->work_permit_status == 'pending')
<button class="btn btn-falcon-info btn-sm editBtnIssueHasDevice m-1 px-2" type="button">
    <span class="fas fa-edit" data-fa-transform="shrink-3 down-1"></span>
</button>
<button class="btn btn-falcon-success btn-sm checkBtnIssueHasDevice d-none m-1 px-2" type="button">
    <span class="fas fa-check" data-fa-transform="shrink-3 down-1"></span>
</button>
<button class="btn btn-falcon-danger btn-sm deleteBtnIssueHasDevice m-1" type="button"
    style="padding: 3px 10px !important;">
    <span class="fas fa-trash" data-fa-transform="shrink-3 down-1"></span>
</button>
@else
<span class="badge bg-success text-capitalize">
    {{$issueHasDevice->work_permit_status}}
</span>
@endif
@endrole
