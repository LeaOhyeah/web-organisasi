@extends('template.main')
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            {{ session('error') }} <a href="#" class="text-decoration-none"> Report Problem<i
                    class="fa fa-small fa-circle-exclamation"></i></a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow">

        <div class="card-header bg-primary">
            <div class="d-flex justify-content-between">
                <h2 class="text-light">Categories</h2>
                <button type="button" class="btn btn-primary fw-bold" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Add <i class="fas fa-add"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <table id="myTable" style="" class="table table-striped table-bordered border-primary">
                <thead class="bg-primary border-dark text-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Edited By</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="name">{{ $category->name }}</td>
                            <td>{{ $category->userCategory->name }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td class="text-center">
                                <a data-bs-toggle="modal" class="editData mx-2" data-bs-target="#edit">
                                    <i class="fa fa-edit fa-lg" style="color:#0055ff"></i>
                                </a>
                                <div class="d-lg-none d-block">
                                    <br>
                                </div>
                                <a data-bs-toggle="modal" class="deleteData mx-2" data-bs-target="#delete">
                                    <i class="fa fa-trash fa-lg" style="color:#1500ff"></i>
                                </a>
                                @include('section.modal_category')
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('category.store') }}" method="post">
                        @csrf
                        <div class="form-floating mx-2">
                            <input type="text" name="name" id="floatingName" class="form-control" placeholder="name">
                            <label class="text-secondary" for="floatingName">Category Name</label>
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



    <script>
        // get data edit
        // $(document).on('click', '.editData', function() {
        //     var _this = $(this).parents('tr');
        //     $('#e_id').val(_this.find('.id').text());
        //     $('#e_name').val(_this.find('.name').text());
        // });
        // get data delete
        // $(document).on('click', '.deleteData', function() {
        //     var _this = $(this).parents('tr');
        //     $('#d_id').val(_this.find('.id').text());

        //     var element = document.getElementById('d_name'); // Mendapatkan elemen div dengan id
        //     var data = _this.find('.name').text();
        //     var message = 'Are you sure to delete ';
        //     var symbol = ' ?';
        //     element.textContent = message + data + symbol; // Menampilkan teks ke dalam elemen div
        // });

        // setting DataTable
        $(document).ready(function() {
            $("#myTable").DataTable({
                searching: false,
                buttons: [{
                        extend: "csv",
                        exportOptions: {
                            columns: ":visible",
                        },
                    },
                    {
                        extend: "print",
                        exportOptions: {
                            columns: ":visible",
                        },
                    },
                    {
                        text: "Column",
                        extend: "colvis",
                        exportOptions: {
                            columns: ":visible",
                        },
                    },
                ],
                dom:
                    // length, button and search
                    // "<'row'<'col-md-4'l><'col-md-4'B><'col-md-4'f>>" +
                    "<'row'<'col-md-4'l><'col-md-6'B><'col-md-2'f>>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'row'<'my-4'thead>>" +
                    "<'row'<'col-md-5'i><'col-md-7'p>>",
                responsive: true,
                autoWidth: false,
                columnDefs: [{
                        responsivePriority: 1,
                        targets: 0,
                    }, // Kolom no
                    {
                        responsivePriority: 1,
                        targets: 1,
                    }, // Kolom name
                    {
                        responsivePriority: 2,
                        targets: 2,
                    }, // Kolom updated_at
                    {
                        responsivePriority: 2,
                        targets: 3,
                    }, // Kolom edited_by
                    {
                        responsivePriority: 1,
                        targets: 4,
                    }, // Kolom action
                ],
            });

            // table.buttons().container().appendTo("#myTable_wrapper");
        });
    </script>
@endsection
