@extends('Admin.master')
@push('css')
@endpush
@section('content')
    <h2 class="intro-y text-lg font-medium mt-10">
        Category List
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a id="programmatically-show-modal" href="javascript:void(0);" class="btn btn-primary shadow-md mr-2">Add New
                Product</a>
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-feather="plus"></i>
                    </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item"> <i data-feather="printer" class="w-4 h-4 mr-2"></i>
                                Print </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i>
                                Export to Excel </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i>
                                Export to PDF </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden md:block mx-auto text-slate-500">Showing 1 to 10 of 150 entries</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <input type="text" class="form-control w-56 box pr-10" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Sl no</th>
                        <th class="whitespace-nowrap">Category Name</th>
                        <th class="text-center whitespace-nowrap">ACTIVE/INACTIVE</th>
                        <th class="text-center whitespace-nowrap">STATUS</th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in">
                                        {{ $loop->iteration }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{--                            TODO::Need to implement click to go products --}}
                                <a href="" class="font-medium whitespace-nowrap">{{ $category->name }}</a>
                            </td>
                            <td class="text-center">
                                <div class="form-switch w-full">
                                    <label class="form-check-label" for="show-example-1">Active/Disable</label>
                                    <input id="show-example-1" class="show-code form-check-input mr-0 ml-3 active-btn"
                                        data-action="{{ route('status.toggle', $category->id) }}"
                                        id="statusToggle-{{ $category->id }}" name="status" type="checkbox"
                                        {{ $category->is_active ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td class="w-40 status">
                                @if ($category->is_active)
                                    <div class="flex items-center justify-center text-success"> <i
                                            data-feather="check-square" class="w-4 h-4 mr-2"></i> Active </div>
                                @else
                                    <div class="flex items-center justify-center text-success" style="color: red"> <i
                                            data-feather="x-square" class="w-4 h-4 mr-2"></i> Inactive </div>
                                @endif
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <button class="flex items-center mr-3 edit-button" data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}" data-status="{{ $category->is_active }}"> <i
                                            data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </button>
                                    <form id="delete-form"
                                        action="{{ route('admin.categoryDelete', ['category' => $category->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE') <!-- Specifying that this is a DELETE request -->
                                        <button type="button" onclick="deleteConfirmation();"
                                            class="flex items-center text-danger">
                                            <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        {{ $categories->links('vendor.pagination.tailwind-pagination') }}

    </div>
    @include('Admin.pages.category.modals.create')
    @include('Admin.pages.category.modals.edit')
    <div id="success-notification" class="p-5">
        <div class="preview">
            <div class="text-center">
                <!-- BEGIN: Notification Content -->
                <div id="success-notification-content" class="toastify-content hidden flex">
                    <i class="text-success" data-feather="check-circle"></i>
                    <div class="ml-4 mr-4">
                        <div class="font-medium">Success!</div>
                        <div class="text-slate-500 mt-1">Status Change Successfully</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        // Show modal
        const elShow = document.querySelector("#programmatically-show-modal");
        elShow.addEventListener("click", function() {
            const elModal = document.querySelector("#programmatically-modal");
            const modal = tailwind.Modal.getOrCreateInstance(elModal);
            modal.show();
        });

        // Hide modal
        const elHide = document.querySelector("#programmatically-hide-modal");
        elHide.addEventListener("click", function() {
            const elModal = document.querySelector("#programmatically-modal");
            const modal = tailwind.Modal.getOrCreateInstance(elModal);
            modal.hide();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteConfirmation() {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this record!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user confirms, you can redirect to the delete route
                    document.getElementById('delete-form').submit();
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.active-btn').on('change', function() {
                let status = $(this).prop('checked') ? 1 : 0;
                url = $(this).attr('data-action');
                let tdElement = $(this).closest('tr').find('.status');
                $.ajax({
                    url: url,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        status: status
                    },
                    success: function(response) {
                        var editButton = document.querySelector('.edit-button[data-id="' +
                            response.id + '"]');
                        if (response.is_active) {
                            // Category is active.
                            tdElement.html(
                                `<div class="flex items-center justify-center text-success"><i data-feather="check-square" class="w-4 h-4 mr-2"></i> Active</div>`
                                );
                            editButton.setAttribute('data-status', true);
                        } else {
                            // Category is inactive.
                            tdElement.html(
                                '<div class="flex items-center justify-center text-success" style="color: red"><i data-feather="x-square" class="w-4 h-4 mr-2"></i> Inactive</div>'
                                );
                            editButton.setAttribute('data-status', false);
                        }
                        feather.replace();
                        Toastify({
                            node: $("#success-notification-content")
                                .clone()
                                .removeClass("hidden")[0],
                            duration: 5000,
                            newWindow: true,
                            close: true,
                            gravity: "top",
                            position: "right",
                            stopOnFocus: true,
                        }).showToast();
                    },
                    error: function(xhr, status, error) {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true
                        }
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>
    <script>
        // Handle dropdown change
        $('#perPageSelect').on('change', function() {
            window.location = '{{ url()->current() }}?perPage=' + $(this).val();
        });
    </script>

    <script>
        // Select all edit buttons
        document.querySelectorAll('.edit-button').forEach(function(button) {
            button.addEventListener('click', function() {
                // Get the ID or any relevant data attribute
                var id = this.getAttribute('data-id');
                var name = this.getAttribute('data-name');
                var status = this.getAttribute('data-status');

                // Fetch data based on the ID or use the row data
                // For demonstration, let's assume you fetch data from an API
                fetchData(id, name, status).then(function(data) {
                    const {
                        name,
                        status,
                        id: dataId
                    } = data.someField;

                    // Populate the modal
                    document.querySelector('.categoryName').value = name;
                    document.querySelector('.checkStatus').checked = status;

                    // Set the action of the form
                    const form = document.getElementById('categoryEditForm');
                    const actionRoute =
                        "{{ route('admin.categoryEdit', ['category' => 'dataIdPlaceholder']) }}"
                        .replace('dataIdPlaceholder', dataId);
                    form.setAttribute('action', actionRoute);
                    // Open the modal
                    openModal(); // This function depends on your modal's implementation
                });

            });
        });

        function fetchData(id, name, status) {
            // Replace with actual data fetching logic
            if (status === "1" || status === "true") {
                var isActive = true;
            } else {
                var isActive = false;
            }
            return Promise.resolve({
                someField: {
                    id: id,
                    name: name,
                    status: isActive
                }
            });
        }

        function openModal() {
            const elModal = document.querySelector("#editModal");
            const modal = tailwind.Modal.getOrCreateInstance(elModal);
            modal.show();
        }

        const editModalHide = document.querySelector("#editModal-hide-modal");

        editModalHide.addEventListener("click", function() {
            const elModal = document.querySelector("#editModal");
            const modal = tailwind.Modal.getOrCreateInstance(elModal);
            modal.hide();
        });
    </script>
@endpush
