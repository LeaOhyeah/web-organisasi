<!-- Modal Delete -->
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h5 class="modal-title" id="deleteLabel">Delete Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-center">Are you sure to delete {{ $category->name }} ? </h4>
                {{-- alert  --}}
                <form action="{{ route('category.delete') }}" method="post">
                    @csrf
                    <input value="{{ $category->id }}" type="hidden" name="id" id="d_id"
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
                <h5 class="modal-title" id="updateLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-start">
                    <form action="{{ route('category.update') }}" method="post">
                        @csrf
                        <label class="text-secondary" for="e_name">Category Name</label>
                        <input value="{{ $category->name }}" type="text" name="name" id="e_name"
                            class="form-control">
                        <input value="{{ $category->id }}" type="hidden" name="id" id="e_id"
                            class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"> Update </button>
                </div>
                </form>
            </div>

        </div>
    </div>
</div>
