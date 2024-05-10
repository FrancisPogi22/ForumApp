<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Post Form</h1>
            </div>
            <form action="{{ route('post.add') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="field-con">
                        <input type="text" name="title" class="form-control" placeholder="Title" required>
                    </div>
                    <div class="field-con">
                        <textarea name="body" class="form-control" cols="30" rows="5" placeholder="Description" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
