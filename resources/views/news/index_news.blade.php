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
                <h2 class="text-light">News</h2>
                <a class="btn btn-primary text-white" href="{{ route('news.create') }}"><span class="fw-bold">Add </span><i
                        class="fas fa-add"></i></a>
            </div>
        </div>

        <div class="card-body">
            <table id="myTable" style="" class="table table-striped table-bordered border-primary">
                <thead class="bg-primary border-dark text-light">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($news as $n)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $n->title }}</td>
                            <td>{{ $n->categoryNews->name }}</td>
                            <td>{{ $n->userNews->name }}</td>
                            <td>{{ $n->created_at }}</td>
                            <td class="text-center">
                                <a href="{{ route('news.edit', ['id' => $n->id]) }}" class="mx-3">
                                    <i class="fa fa-edit fa-lg" style="color:#0055ff"></i>
                                </a>
                                <div class="d-lg-none d-block">
                                    <br>
                                </div>
                                <form action="{{ route('news.delete', ['id' => $n->id]) }}" method="post" class="d-inline">
                                    {{-- @method('DELETE') --}}
                                    @csrf
                                    <button class="border-0 mx-3" type="sumbit" onclick="return confirm('Are you sure?')">
                                        <i class="fa fa-trash fa-lg" style="color:#1500ff"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <script>
        // setting DataTable
        $(document).ready(function() {
            $("#myTable").DataTable({
                searching: false,
                buttons: [{
                        extend: "csv",
                        exportOptions: {
                            columns: ":visible:not(.no-export)",
                        },
                    },
                    {
                        extend: "print",
                        exportOptions: {
                            columns: ":visible:not(.no-print)",
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
                        targets: 0
                    }, // Kolom no
                    {
                        responsivePriority: 1,
                        targets: 1,
                    }, // Kolom title
                    {
                        responsivePriority: 2,
                        targets: 2
                    }, // Kolom category
                    {
                        responsivePriority: 3,
                        targets: 3
                    }, // Kolom uploaded by
                    {
                        responsivePriority: 3,
                        targets: 4
                    }, // Kolom created at
                    {
                        responsivePriority: 1,
                        targets: 5,
                        className: 'no-print no-export',
                    }, // Kolom action
                ],
            });

            // table.buttons().container().appendTo("#myTable_wrapper");
        });
    </script>
@endsection
