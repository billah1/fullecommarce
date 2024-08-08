@extends('Admin.master')
@push('css')

@endpush
@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Sliders
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a id="programmatically-show-slide-over" href="javascript:;" class="btn btn-primary mr-1 mb-2">Add New
                Slider</a>
            <div class="dropdown ml-auto sm:ml-0">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-feather="plus"></i> </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item"> <i data-feather="share-2" class="w-4 h-4 mr-2"></i> Share
                                Post </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-feather="download" class="w-4 h-4 mr-2"></i>
                                Download Post </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="intro-y grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Blog Layout -->
        @foreach($items as $item)
            <div class="intro-y col-span-12 md:col-span-6 xl:col-span-4 box" style="height: 520px">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 px-5 py-4">

                    <div class="ml-3 mr-auto">
                        <a href="" class="font-medium">{{ $item->title }}</a>
                        <div class="flex text-slate-500 truncate text-xs mt-0.5"><span
                                class="mx-1">•</span> {{ $item->created_at->diffForHumans() }} </div>
                    </div>
                </div>
                <div class="p-5">
                    <div class="h-40 2xl:h-56 image-fit">
                        <img alt="Tinker Tailwind HTML Admin Template" class="rounded-md"
                             src="{{ asset('admin/slider/'. $item->image) }}">
                    </div>
                    <a href="" class="block font-medium text-base mt-5">Description</a>
                    <div class="text-slate-600 dark:text-slate-500 mt-2">{{ $item->description }}</div>
                </div>
                <div class="flex items-center px-5 py-3 border-t border-slate-200/60 dark:border-darkmode-400">
                    <div class="intro-x flex mr-2">
                        <div class="form-switch w-full">
                            <label class="form-check-label" for="show-example-1">Active/Disable</label>
                            <input id="show-example-1" class="show-code form-check-input mr-0 ml-3 active-btn"
                                   data-action="{{ route('slider.status.toggle', $item->id) }}"
                                   id="statusToggle-{{ $item->id }}" name="status" type="checkbox"
                                {{ $item->is_active ? 'checked' : '' }}>
                        </div>
                    </div>
{{--                    <button data-id="{{ $item->id }}" data-title="{{ $item->title }}"--}}
{{--                       data-description="{{ $item->description }}" data-status="{{ $item->is_active }}" data-image="{{ $item->image }}"--}}
{{--                       class="edit-button btn btn-primary flex items-center justify-center text-primary bg-primary/10 dark:bg-darkmode-300 dark:text-slate-300 ml-auto">--}}
{{--                        <i data-feather="check-square" class="w-3 h-3 mr-3"></i> Edit </button>--}}
                    <div class="edit-button  flex items-center justify-center text-primary bg-primary/10 dark:bg-darkmode-300 dark:text-slate-300 ml-auto" hidden>

                    </div>
                    <form id="delete-form-{{ $item->id }}"
                          action="{{ route('admin.sliderDelete', ['slider' => $item->id]) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deleteConfirmation({{ $item->id }});" class="btn btn-danger flex items-center justify-end  bg-danger text-white ml-2"> <i
                            data-feather="trash-2" class="w-3 h-3 mr-3"></i> Delete </button>
                    </form>
                </div>
            </div>
        @endforeach
        <!-- END: Blog Layout -->
        <!-- BEGIN: Pagination -->
        {{ $items->links('vendor.pagination.tailwind-pagination') }}
        <!-- END: Pagination -->
        @include('Admin.pages.slider.modal.create')
        @include('Admin.pages.slider.modal.edit')
    </div>
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

{{--    <script type="text/javascript">--}}
{{--        var baseUrl = "{{ asset('admin') }}";--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        // Function to fetch data (kept as is for context)--}}
{{--        function fetchData(id, title, description, image, status) {--}}
{{--            return Promise.resolve({--}}
{{--                someField: {--}}
{{--                    id,--}}
{{--                    title,--}}
{{--                    description,--}}
{{--                    image,--}}
{{--                    status: status === "1" || status === "true"--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}

{{--        // Function to open the modal--}}
{{--        function openModal() {--}}
{{--            const modal = tailwind.Modal.getOrCreateInstance(document.querySelector("#editModal"));--}}
{{--            modal.show();--}}
{{--            // initializeDropify(baseUrl + '/slider/' + image);--}}
{{--        }--}}

{{--        // Function to close the modal--}}
{{--        function closeModal() {--}}
{{--            const modal = tailwind.Modal.getOrCreateInstance(document.querySelector("#editModal"));--}}
{{--            modal.toggle();--}}
{{--        }--}}

{{--        // Function to initialize Dropify on the image file input--}}
{{--        function initializeDropify(nameImage) {--}}
{{--            const fileInput = document.querySelector('.editImage');--}}
{{--            // Destroy existing Dropify instance if exists--}}
{{--            if (fileInput.classList.contains('dropify')) {--}}
{{--                $(fileInput).dropify('destroy');--}}
{{--            }--}}
{{--            console.log(fileInput);--}}
{{--            fileInput.classList.add('dropify');--}}
{{--            console.log(fileInput);--}}
{{--            fileInput.setAttribute('data-default-file', nameImage);--}}
{{--            fileInput.setAttribute('src', nameImage);--}}
{{--            $(fileInput).dropify();--}}
{{--            $('.dropify-render img').attr('src', nameImage);--}}
{{--        }--}}

{{--        // Function to update form fields with fetched data--}}
{{--        function updateFormFields(data) {--}}
{{--            const { title, description, image, status, id } = data.someField;--}}
{{--            document.querySelector('.title').value = title;--}}
{{--            document.querySelector('.description').value = description;--}}
{{--            document.querySelector('.checkStatus').checked = status;--}}
{{--            const form = document.getElementById('sliderEditForm');--}}
{{--            form.setAttribute('action', "{{ route('admin.sliderEdit', ['slider' => 'dataIdPlaceholder']) }}".replace('dataIdPlaceholder', id));--}}
{{--            initializeDropify(baseUrl + '/slider/' + image);--}}
{{--        }--}}

{{--        // Event listener for edit buttons--}}
{{--        document.querySelectorAll('.edit-button').forEach(button => {--}}
{{--            button.addEventListener('click', function() {--}}
{{--                fetchData(--}}
{{--                    this.getAttribute('data-id'),--}}
{{--                    this.getAttribute('data-title'),--}}
{{--                    this.getAttribute('data-description'),--}}
{{--                    this.getAttribute('data-image'),--}}
{{--                    this.getAttribute('data-status')--}}
{{--                ).then(updateFormFields).then(openModal);--}}
{{--            });--}}
{{--        });--}}

{{--        // Event listener for hiding the modal--}}
{{--        document.querySelector("#editModal-hide-modal").addEventListener("click", closeModal);--}}

{{--    </script>--}}
    <script>
        function deleteConfirmation(itemId) {
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
                    document.getElementById('delete-form-' + itemId).submit();
                }
            });
        }
    </script>
    <script>
        $('.dropify').dropify();
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
                            editButton.setAttribute('data-status', true);
                        } else {
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
@endpush
