<!-- Modal Delete -->
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h5 class="modal-title" id="deleteLabel">Delete Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="">Are you sure to delete {{ $event->title }} ? </h4>
                {{-- alert  --}}
                <form action="{{ route('event.delete') }}" method="post">
                    @csrf
                    <input value="{{ $event->id }}" type="hidden" name="id" id="d_id"
                        class="form-control">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"> Delete </button>
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="updateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h5 class="modal-title" id="updateLabel">Edit Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-start">
                    <form action="{{ route('event.update') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-10 mb-3">
                                <label class="form-label" for="e_eventTitle">Title</label>
                                <input type="text" name="title" value="{{ $event->title }}" id="e_eventTitle"
                                    class="form-control" placeholder="Title" required>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="exampleColorInput" class="form-label">Color</label>
                                <input type="color" name="color" class="form-control form-control-color"
                                    id="exampleColorInput" value="{{ $event->color }}" title="Choose your color"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="startDate" class="form-label">Start Date</label>
                                <input type="date" name="start_date" value="{{ $event->original_start_date }}"
                                    class="form-control" id="startDate" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="endDate" class="form-label">End Date</label>
                                <input type="date" name="end_date" value="{{ $event->original_end_date }}"
                                    class="form-control" id="endDate" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label mb-1 mt-4">Description (Optional)</label>
                                <textarea type="text" name="description" id="description" class="form-control">{{ $event->description }}</textarea>
                            </div>
                            <input type="hidden" value="{{$event->id}}" name="id">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"> Save </button>
                </div>
                </form>
            </div>

        </div>
    </div>
</div>
