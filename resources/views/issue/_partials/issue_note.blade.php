<div class="card-footer bg-light">
    @if($issue->note != null)
    <p class="fs--1 mb-0"><strong>Notes: </strong>
        {{$issue->note}}
        <span class="badge rounded-pill badge-soft-info">({{$issue->noteEditBy->name}})</span>
    </p>
    @endif
</div>
{{-- Add Note And Submit Work Permit Model --}}
<div class="modal fade" id="addNoteAndSubmitWorkPermit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 400px">
        <div class="modal-content position-relative">
            <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('issue.addNoteWorkPermit',$issue->id)}}" method="POST">
                @csrf
                <div class="modal-body p-0">
                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Added Note</h4>
                    </div>
                    <div class="p-4 pb-0">
                        <div class="mb-3">
                            <label class="col-form-label" for="note">Issue Note <small
                                    class="text-danger">(optional)</small></label>
                            <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
