@extends('Admin.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
@endpush
@section('content')
    <div class="content content--top-nav">

        <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Logos
            </h2>

        </div>
        <div class="col-span-12 lg:col-span-12 2xl:col-span-10 mt-5">
            <!-- BEGIN: File Manager Filter -->
            <div class="intro-y flex flex-col-reverse sm:flex-row items-center">
                <div class="w-full sm:w-auto relative mr-auto mt-3 sm:mt-0">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 ml-3 left-0 z-10 text-slate-500"
                       data-feather="search"></i>
                    <input type="text" class="form-control w-full sm:w-64 box px-10" placeholder="Search files">
                    <div class="inbox-filter dropdown absolute inset-y-0 mr-3 right-0 flex items-center"
                         data-tw-placement="bottom-start">
                        <i class="dropdown-toggle w-4 h-4 cursor-pointer text-slate-500" role="button"
                           aria-expanded="false" data-tw-toggle="dropdown" data-feather="chevron-down"></i>
                        <div class="inbox-filter__dropdown-menu dropdown-menu pt-2">
                            <div class="dropdown-content">
                                <div class="grid grid-cols-12 gap-4 gap-y-3 p-3">
                                    <div class="col-span-6">
                                        <label for="input-filter-1" class="form-label text-xs">File Name</label>
                                        <input id="input-filter-1" type="text" class="form-control flex-1"
                                               placeholder="Type the file name">
                                    </div>
                                    <div class="col-span-6">
                                        <label for="input-filter-2" class="form-label text-xs">Shared With</label>
                                        <input id="input-filter-2" type="text" class="form-control flex-1"
                                               placeholder="example@gmail.com">
                                    </div>
                                    <div class="col-span-6">
                                        <label for="input-filter-3" class="form-label text-xs">Created At</label>
                                        <input id="input-filter-3" type="text" class="form-control flex-1"
                                               placeholder="Important Meeting">
                                    </div>
                                    <div class="col-span-6">
                                        <label for="input-filter-4" class="form-label text-xs">Size</label>
                                        <select id="input-filter-4" class="form-select flex-1">
                                            <option>10</option>
                                            <option>25</option>
                                            <option>35</option>
                                            <option>50</option>
                                        </select>
                                    </div>
                                    <div class="col-span-12 flex items-center mt-3">
                                        <button class="btn btn-secondary w-32 ml-auto">Create Filter</button>
                                        <button class="btn btn-primary w-32 ml-2">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-auto flex">
                    <a id="programmatically-show-modal" href="javascript:void(0);" class="btn btn-primary mr-1 mb-2">Upload
                        New Files</a>
                    <div class="dropdown">
                        <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                            <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4"
                                                                                       data-feather="plus"></i> </span>
                        </button>
                        <div class="dropdown-menu w-40">
                            <ul class="dropdown-content">
                                <li>
                                    <a href="" class="dropdown-item"> <i data-feather="file" class="w-4 h-4 mr-2"></i>
                                        Share Files </a>
                                </li>
                                <li>
                                    <a href="" class="dropdown-item"> <i data-feather="settings"
                                                                         class="w-4 h-4 mr-2"></i> Settings </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: File Manager Filter -->
            <!-- BEGIN: Directory & Files -->
            <div class="intro-y grid grid-cols-12 gap-3 sm:gap-6 mt-5">
                @foreach($logos as $key => $logo)
                    <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 2xl:col-span-2">
                        <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                            <div class="absolute left-0 top-0 mt-3 ml-3">
                                <input class="form-check-input border border-slate-500" type="checkbox"
                                       data-id="{{ $logo->id }}" {{ $logo->is_active == true ? "checked" : ""}}>
                            </div>
                            <a href="" class="w-3/5 file__icon file__icon--image mx-auto">
                                <div class="file__icon--image__preview image-fit">
                                    <img
                                        src="{{ $logo->logo != '' ? asset('admin/logo/' . $logo->logo) : asset('dist/images/preview-7.jpg') }}"
                                        alt="#">
                                </div>
                            </a>
                            <a href="" class="block font-medium mt-4 text-center truncate">{{ $logo->logo }}</a>
                            <div class="text-slate-500 text-xs text-center mt-0.5">1 MB</div>
                            <div class="absolute top-0 right-0 mr-2 mt-3 dropdown ml-auto">
                                <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false"
                                   data-tw-toggle="dropdown"> <i data-feather="more-vertical"
                                                                 class="w-5 h-5 text-slate-500"></i> </a>
                                <div class="dropdown-menu w-40">
                                    <ul class="dropdown-content">
                                        <li>
                                            <a href="" class="dropdown-item"> <i data-feather="users"
                                                                                 class="w-4 h-4 mr-2"></i> Share File
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="dropdown-item"> <i data-feather="trash"
                                                                                 class="w-4 h-4 mr-2"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="btnContainer flex justify-end mt-5">
                <button id="applyButton" class="btn btn-primary">Apply</button>
            </div>
            <!-- END: Directory & Files -->
            <!-- BEGIN: Pagination -->
            {{ $logos->links('vendor.pagination.tailwind-pagination') }}
            <!-- END: Pagination -->
        </div>
    </div>
    <div id="success-notification" class="p-5">
        <div class="preview">
            <div class="text-center">
                <!-- BEGIN: Notification Content -->
                <div id="success-notification-content" class="toastify-content hidden flex">
                    <i class="text-success" data-feather="check-circle"></i>
                    <div class="ml-4 mr-4">
                        <div class="font-medium">Success!</div>
                        <div class="text-slate-500 mt-1">Logo Set Successfully</div>
                    </div>
                </div>
                <!-- END: Notification Content -->
                <!-- BEGIN: Notification Toggle -->
                <button id="success-notification-toggle" class="btn btn-primary">Show Notification</button>
                <!-- END: Notification Toggle -->
            </div>
        </div>
    </div>

    @include('Admin.pages.settings.modals.upload-logo')
@endsection
@push('js')
    <script>
        // Handle dropdown change
        $('#perPageSelect').on('change', function () {
            window.location = '{{ url()->current() }}?perPage=' + $(this).val();
        });
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
    <script>
        $(document).ready(function () {
            // Handle checkbox click event
            $('.form-check-input').on('change', function () {
                // Uncheck all other checkboxes
                $('.form-check-input').not(this).prop('checked', false);
            });

            // Handle Apply button click event
            $('#applyButton').on('click', function () {
                // Find the checked checkbox
                const checkedCheckbox = $('.form-check-input:checked');

                if (checkedCheckbox.length > 0) {
                    // Get the data attributes
                    const logoId = checkedCheckbox.data('id');
                    const isActive = checkedCheckbox.data('is-active');

                    // Update the is_active property (you might want to send an AJAX request to update it in the backend)
                    console.log(`Logo ID: ${logoId}, is_active: ${isActive}`);

                    // Example: If you want to send an AJAX request to update is_active
                    $.ajax({
                        url: `update-is-active/${logoId}`,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {is_active: true},
                        success: function (response) {
                            console.log(response);
                            window.location.reload();
                            Toastify({
                                node: $("#success-notification-content")
                                    .clone()
                                    .removeClass("hidden")[0],
                                duration: -1,
                                newWindow: true,
                                close: true,
                                gravity: "top",
                                position: "right",
                                stopOnFocus: true,
                            }).showToast();
                        },
                        error: function (error) {
                            console.error(error);
                        }
                    });
                } else {
                    console.log('No checkbox is checked.');
                }
            });
        });
    </script>
@endpush
