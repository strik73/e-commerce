@extends('layouts.app')

@section('title', 'Category')

@section('content')

    @if (session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            })
        </script>
    @endif

    <div class="container card">
        <div class="card-body">
            <h3>Item's Category</h3>
        </div>
    </div>

    <div class="card mt-3">
        <div>
            <button type="button" class="float-end mt-3 me-4 btn btn-sm btn-primary pt-2 pe-3" data-bs-toggle="modal"
                data-bs-target="#addCategory">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="pb-1">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 5l0 14" />
                    <path d="M5 12l14 0" />
                </svg>
                Add New</button>
        </div>

        {{-- Create Modal --}}
        <div class="modal modal-blur fade" id="addCategory" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title px-2">Add Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-5">
                        <form action="{{ route('category.store') }}" method="post">
                            @csrf

                            <div style="width: 300px" class="mb-3 col-md-12 col-sm-12">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" class="form-control" id="category" name="category"
                                    value="{{ old('category') }}" placeholder="Insert category name..."
                                    style="border: 1px solid #515050;" required>
                            </div>

                            <div class="mb-3 col-md-3 col-sm-3">
                                <label for="status" class="form-label">Status</label>
                                <label class="form-check form-switch">
                                    <input class="form-check-input" name="status" type="checkbox" value="1"
                                        style="border: 1px solid #515050">
                                    <span class="form-check-label">Aktif</span>
                                </label>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn ms-auto" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Edit Modal --}}
        <div class="modal modal-blur fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title px-2">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-5">
                        <form id="editForm" method="post">
                            @csrf
                            @method('PUT')
                            <div style="width: 300px" class="mb-3 col-md-12 col-sm-12">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" class="form-control" id="category" name="category"
                                    value="{{ old('category') }}" placeholder="Insert category name..."
                                    style="border: 1px solid #515050;" required>
                            </div>

                            <div class="mb-3 col-md-3 col-sm-3">
                                <label for="status" class="form-label">Status</label>
                                <label class="form-check form-switch">
                                    <input class="form-check-input" name="status" type="checkbox" value="1"
                                        style="border: 1px solid #515050">
                                    <span class="form-check-label">Aktif</span>
                                </label>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn ms-auto" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-1 p-4">
            <div class="table-responsive">
                <table id='data' class="table table-bordered table-hover" width='100%'>
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Created_at</button></th>
                            <th>Updated_at</button></th>
                            <th class="text-center">Action</button></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <th class="text-center">{{ $category->id }}</th>
                                <th>{{ $category->category }}</th>
                                <td>
                                    @if ($category->status == true)
                                        <span class="badge bg-success text-white">Aktif</span>
                                    @else
                                        <span class="badge bg-danger text-white">Non-Aktif</span>
                                    @endif
                                </td>
                                <td>{{ $category->created_at->format('d-m-Y') }}</td>
                                <td>{{ $category->updated_at->format('d-m-Y') }}</td>
                                <td class="text-center">
                                    {{-- @if (auth()->user()->can('UPDATE KATEGORI')) --}}
                                    <button class="btn btn-primary btn-sm btn-edit" data-bs-toggle="modal"
                                        data-bs-target="#editModal" data-id="{{ $category->id }}">
                                        <span class="">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler-pencil"
                                                width="18" height="18" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                <path d="M13.5 6.5l4 4" />
                                            </svg>
                                        </span> Edit </button>
                                    {{-- @endif --}}
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#data').DataTable({
                scrollCollapse: true,
                paging: true,
                language: {
                    emptyTable: "Tidak ditemukan data item",
                    zeroRecords: "Tidak ada data item yang ditemukan"
                },
            });
        });
    </script>

    <script>
        $(function() {
            var categoryId;

            $('#editModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                categoryId = button.data('id');

                $.ajax({
                    type: 'GET',
                    url: '/admin/category/edit/' + categoryId,
                    success: function(response) {
                        console.log(response)
                        $('#modalBody').html(response);
                        $('#editModal').find('[name="category"]').val(response.category);
                        if (response.status == 1) {
                            $('#editModal').find('[name="status"]').prop('checked', true);
                        } else {
                            $('#editModal').find('[name="status"]').prop('checked', false);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });

                $('#editForm').submit(function(event) {
                    event.preventDefault();

                    $.ajax({
                        type: 'POST',
                        url: '/admin/category/update/' + categoryId,
                        data: $(this).serialize() + "&_method=PUT",
                        success: function(response) {
                            window.location.href =
                                "{{ route('category.index') }}";
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);

                        }
                    });
                });
            });
        });
    </script>
@endsection
