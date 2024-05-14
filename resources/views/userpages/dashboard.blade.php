<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.headPackage')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
</head>

<body>
    @include('partials.header')

    <section id="dashboard">
        <div class="wrapper">
            <div class="dashboard-con">
                <div class="post-con">
                    <div class="post-header-con">
                        <h2>Posts</h2>
                        <button type="button" class="btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                            Add Post
                        </button>
                    </div>
                    @include('userpages.addModal')
                    <div class="post-widget-con">
                        @foreach ($posts as $post)
                            <div class="post-widget">
                                <div class="widget-header-con">
                                    <div class="widget-header-details">
                                        <p>{{ $post->username }}</p>
                                        <span>{{ \Carbon\Carbon::parse($post->created_at)->isoFormat('MMMM D [at] h:mm A') }}</span>
                                    </div>
                                    <button class="btn-primary editPost">Edit</button>
                                </div>
                                <div class="post-details">
                                    <h5>{{ $post->title }}</h5>
                                    <p>{{ $post->body }}</p>
                                </div>
                                <div class="stars">
                                    <p id="stars">
                                        {{ $post->stars }}
                                    </p>
                                </div>
                                <div class="widget-footer-con">
                                    <div class="footer-nav">
                                        <div class="comment-con" id="starBtn" data-id="{{ $post->id }}">
                                            <i class="bi bi-star"></i>
                                            <span>Star</span>
                                        </div>
                                        <div class="comment-con">
                                            <i class="bi bi-chat"></i>
                                            <span>Comment</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @include('userpages.editModal')
                    </div>

                    {{-- 
                    <table id="postTable" class="display">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Body</th>
                                <th style="width:25%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->body }}</td>
                                    <td class="table-btn-con">
                                        <button class="btn-primary editPost" data-id="{{ $post->id }}">Edit</button>
                                        <button class="btn-secondary deletePost"
                                            data-id="{{ $post->id }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        @include('userpages.editModal')
                    </table> --}}
                </div>
            </div>
        </div>
    </section>

    @include('partials.plugins')
    @include('partials.script')
    @include('partials.toastr')
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script>
        $(document).ready(() => {
            let postTable = new DataTable('#postTable', {
                "info": false,
                "ordering": false,
                "responsive": true
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // $('.editPost').click(function() {
            //     $('#title').val($(this).closest('tr').find('td:nth-child(1)').text());
            //     $('#body').text($(this).closest('tr').find('td:nth-child(2)').text());
            //     $('#id').val($(this).data('id'));
            //     $('#editModal').modal('show');
            // });

            $('.deletePost').click(function() {
                confirmModal("Are you sure you want to delete this?").then((result) => {
                    if (!result.isConfirmed) return;

                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('post.delete', 'postId') }}".replace(
                            'postId', $(this).data('id')),
                        success(response) {
                            if (response.status == "warning") {
                                showWarningMessage(response.message);
                            } else {
                                let rowIndex = postTable.row($(this).closest('tr')).index();

                                postTable.row(rowIndex).remove().draw(false);
                                showSuccessMessage("Post Successfully Deleted.");
                            }
                        },
                        error: showErrorMessage
                    })
                });
            });

            $('#starBtn').click(function() {
                $.ajax({
                    type: "PATCH",
                    url: "{{ route('post.star', 'postId') }}".replace(
                        'postId', $(this).data('id')),
                    success(response) {
                        if (response.status == "warning") {
                            showWarningMessage(response.message);
                        } else {
                            let stars = $(this).closest('.post-details').find('#stars');

                            alert(stars.text())
                            stars.text(parseInt(stars.text()) + 1);
                        }
                    },
                    error: showErrorMessage
                })
            });
        });
    </script>
</body>

</html>
