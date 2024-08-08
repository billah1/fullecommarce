@extends('Admin.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
@endpush
@section('content')
    <h2 class="intro-y text-lg font-medium mt-10">
        All Product List
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('admin.addNewProduct') }}" class="btn btn-primary shadow-md mr-2">Add New Product</a>
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-feather="plus"></i>
                    </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="{{ route('export.products') }}" class="dropdown-item"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i>
                                Export to Excel </a>
                        </li>
                        <li>
                            <a id="programmatically-show-modal" href="javascript:void(0);" class="dropdown-item"> <i
                                    data-feather="file-text" class="w-4 h-4 mr-2"></i>
                                Import XLS </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden md:block mx-auto text-slate-500"></div>
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
                    <th class="whitespace-nowrap">IMAGES</th>
                    <th class="whitespace-nowrap">PRODUCT NAME</th>
                    <th class="text-center whitespace-nowrap">STOCK</th>
                    <th class="text-center whitespace-nowrap">PRICE</th>
                    <th class="text-center whitespace-nowrap">Discount PRICE</th>
                    <th class="text-center whitespace-nowrap">Published/Unpublished</th>
                    <th class="text-center whitespace-nowrap">STATUS</th>
                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $product)
                    <tr class="intro-x">
                        <td class="w-40">
                            <div class="flex">
                                @foreach($product->productImage as $image)
                                    <div class="w-10 h-10 image-fit zoom-in {{ $loop->iteration > 1 ? '-ml-5' : '' }}">
                                        <img alt="Tinker Tailwind HTML Admin Template" class="tooltip rounded-full"
                                             src="{{ asset('admin/product/' . $image->image) }}"
                                             title="Uploaded at {{ $image->created_at }}">
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <a href="" class="font-medium whitespace-nowrap">{{ $product->name }}</a>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">
                                <span style="font-weight: bold">Categories: </span>
                                @foreach ($product->productCategory as $category)
                                    {{ $category->category->name }}
                                    @unless ($loop->last)
                                        , <!-- Add a comma unless it's the last category -->
                                    @endunless
                                @endforeach
                            </div>
                        </td>
                        <td class="text-center">{{ $product->stock }}</td>
                        <td class="w-40">
                            <div
                                class="flex items-center justify-center w">{{ $product->productCurrency->symbol }} {{ $product->price }}
                            </div>
                        </td>
                        <td class="w-40">
                            <div
                                class="flex items-center justify-center w">{{ $product->productCurrency->symbol }} {{ $product->discount_price }}
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-switch w-full">
                                <label class="form-check-label" for="show-example-1">Publish/Unpublish</label>
                                <input id="show-example-1" class="show-code form-check-input mr-0 ml-3 active-btn"
                                       data-action="{{ route('productStatus.toggle', $product->code) }}"
                                       id="statusToggle-{{ $product->code }}" name="status" type="checkbox"
                                    {{ $product->is_active ? 'checked' : '' }}>
                            </div>
                        </td>
                        <td class="w-40 status">
                            @if ($product->is_active)
                                <div class="flex items-center justify-center text-success"><i
                                        data-feather="check-square" class="w-4 h-4 mr-2"></i> Published
                                </div>
                            @else
                                <div class="flex items-center justify-center text-success" style="color: red"><i
                                        data-feather="x-square" class="w-4 h-4 mr-2"></i> Unpublished
                                </div>
                            @endif
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <form method="post"
                                      action="{{ route('admin.productEdit', ['code' => $product->code]) }}">
                                    @csrf
                                    @method('PUT')
                                    <button class="flex items-center mr-3" type="submit"><i data-feather="check-square"
                                                                                            class="w-4 h-4 mr-1"></i>
                                        Edit
                                    </button>
                                </form>
                                <form id="delete-form"
                                      action="{{ route('admin.productDelete', ['product' => $product->code]) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE') <!-- Specifying that this is a DELETE request -->
                                    <button type="button" onclick="deleteConfirmation(this);"
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
        {{ $items->links('vendor.pagination.tailwind-pagination') }}
        <!-- END: Pagination -->
    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-feather="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-slate-500 mt-2">
                            Do you really want to delete these records?
                            <br>
                            This process cannot be undone.
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-danger w-24">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->
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
    @include('Admin.pages.product.modal.upload-csv')
@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('.active-btn').on('change', function () {
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
                    success: function (response) {
                        var editButton = document.querySelector('.edit-button[data-id="' +
                            response.id + '"]');
                        if (response.is_active) {
                            tdElement.html(
                                `<div class="flex items-center justify-center text-success"><i data-feather="check-square" class="w-4 h-4 mr-2"></i> Published</div>`
                            );
                        } else {
                            tdElement.html(
                                '<div class="flex items-center justify-center text-success" style="color: red"><i data-feather="x-square" class="w-4 h-4 mr-2"></i> Unpublished</div>'
                            );
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
                    error: function (xhr, status, error) {
                        // toastr.options = {
                        //     "closeButton": true,
                        //     "progressBar": true
                        // }
                        // toastr.error(xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>
    <script>
        function deleteConfirmation(buttonElement) {
            const formElement = buttonElement.closest('form');
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
                    formElement.submit();
                }
            });
        }
    </script>
    <script>
        // Show modal
        const elShow = document.querySelector("#programmatically-show-modal");
        elShow.addEventListener("click", function () {
            const elModal = document.querySelector("#programmatically-modal");
            const modal = tailwind.Modal.getOrCreateInstance(elModal);
            modal.show();
        });

        // Hide modal
        const elHide = document.querySelector("#programmatically-hide-modal");
        elHide.addEventListener("click", function () {
            const elModal = document.querySelector("#programmatically-modal");
            const modal = tailwind.Modal.getOrCreateInstance(elModal);
            modal.hide();
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify();
    </script>
@endpush
