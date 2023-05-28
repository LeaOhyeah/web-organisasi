@extends('template.main')
@section('content')
    <style>
        .color-circle {
            width: 20px;
            height: 20px;
            border-width: 2px;
        }
    </style>
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
                <h2 class="text-light">Events</h2>
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
                        <th>Title</th>
                        <th>Start-End</th>
                        <th>Describe</th>
                        <th>Updated at</th>
                        <th>Edited By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex">
                                    <div class="color-circle border rounded-circle"
                                        style="background-color: {{ $event->color }};"></div>
                                    <div class="ms-2">{{ $event->title }}</div>
                                </div>
                            </td>
                            <td>{{ $event->start_date }} <br> {{ $event->end_date }}</td>
                            <td>{{ $event->description }}</td>
                            <td>{{$event->updated_at}}</td>
                            <td>{{ $event->userEvent->name }}</td>
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
                                @include('section.modal_event')
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
                    <h5 class="modal-title" id="exampleModalLabel">Add New Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('event.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-10 mb-3">
                                <label class="form-label" for="floatingTitle">Title</label>
                                <input type="text" name="title" id="floatingTitle" class="form-control"
                                    placeholder="Title" required>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="exampleColorInput" class="form-label">Color</label>
                                <input type="color" name="color" class="form-control form-control-color"
                                    id="exampleColorInput" value="#1500ff" title="Choose your color" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="startDate" class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-control" id="startDate" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="endDate" class="form-label">End Date</label>
                                <input type="date" name="end_date" class="form-control" id="endDate" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label mb-1 mt-4">Description (Optional)</label>
                                <textarea type="text" name="description" id="description" class="form-control"></textarea>
                            </div>
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
        const startDate = document.getElementById('startDate');
        const endDate = document.getElementById('endDate');

        // Dapatkan tanggal hari ini
        const today = new Date().toISOString().split('T')[0];

        // Set atribut 'max' pada elemen input tanggal
        startDate.setAttribute('min', today);
        endDate.setAttribute('min', today);

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
                        targets: 0,
                    }, // Kolom no
                    {
                        responsivePriority: 1,
                        targets: 1,
                    }, // Kolom title
                    {
                        responsivePriority: 1,
                        targets: 2,
                    }, // Kolom start
                    {
                        responsivePriority: 2,
                        targets: 3,
                    }, // Kolom end
                    {
                        responsivePriority: 2,
                        targets: 4,
                    }, // Kolom desc
                    {
                        responsivePriority: 2,
                        targets: 5,
                    }, // Kolom edited_by
                    {
                        responsivePriority: 1,
                        targets: 6,
                        className: 'no-print no-export',
                    }, // Kolom action
                ],
            });

            // table.buttons().container().appendTo("#myTable_wrapper");
        });
    </script>
@endsection
