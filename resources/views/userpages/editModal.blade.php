<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Post Form</h1>
            </div>
            <form action="{{ route('post.edit') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="number" name="id" id="id" hidden>
                    <div class="field-con">
                        <input type="text" name="title" id="title" class="form-control" placeholder="Title"
                            required>
                    </div>
                    <div class="field-con">
                        <textarea name="body" class="form-control" id="body" cols="30" rows="5" placeholder="Description"
                            required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
