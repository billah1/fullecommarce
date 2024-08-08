@extends('Admin.master')
@push('css')
    <style>
        input[type="radio"] {
            display: none;
        }

        /* Style for the color circles */
        label span {
            display: inline-block;
            margin-right: 5px;
            height: 25px;
            width: 25px;
            border-radius: 50%;
            transition: transform 0.2s ease-in-out;
            cursor: pointer;
        }

        /* Color Styles */
        .red {
            background-color: #DB2828;
        }

        .green {
            background-color: #21BA45;
        }

        .yellow {
            background-color: #FBBD08;
        }

        .olive {
            background-color: #B5CC18;
        }

        .orange {
            background-color: #F2711C;
        }

        .teal {
            background-color: #00B5AD;
        }

        .blue {
            background-color: #2185D0;
        }

        .violet {
            background-color: #6435C9;
        }

        .purple {
            background-color: #A333C8;
        }

        .pink {
            background-color: #E03997;
        }

        /* Hover effect */
        label:hover span {
            transform: scale(1.1);
        }

        /* Scale up the color circle when the corresponding radio button is checked */
        input[type="radio"]:checked + label span {
            transform: scale(1.25);
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.3);
        }
    </style>
@endpush
@section('content')
    <form action="{{ route('admin.productUpdate', ['product' => $product->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Edit Product
            </h2>
            <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                <button type="button" class="btn box mr-2 flex items-center ml-auto sm:ml-0"><i class="w-4 h-4 mr-2"
                                                                                                data-feather="eye"></i>
                    Preview
                </button>
                <div class="dropdown">
                    <button type="submit" class="btn btn-primary shadow-md flex items-center"> Update
                    </button>
                </div>
            </div>
        </div>
        <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
            <!-- BEGIN: Post Content -->
            <div class="intro-y col-span-12 lg:col-span-8">
                <input type="text" name="name" class="intro-y form-control py-3 px-4 box pr-10" placeholder="Title"
                       value="{{ $product->name }}"
                       required>
                <div class="post intro-y overflow-hidden box mt-5">
                    <div class="post__content tab-content">
                        <div id="content" class="tab-pane p-5 active" role="tabpanel" aria-labelledby="content-tab">
                            <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                <div
                                    class="font-medium flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                    <i data-feather="chevron-down" class="w-4 h-4 mr-2"></i> Product Description
                                </div>
                                <div class="mt-5">
                                    <textarea name="description" style="width:100%;" cols="116" rows="15"
                                              required>{{ $product->description }}</textarea>
                                </div>
                            </div>
                            <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5 mt-5">
                                <div
                                    class="font-medium flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                    <i data-feather="chevron-down" class="w-4 h-4 mr-2"></i> Product Images
                                </div>
                                <div class="mt-5">
                                    <div class="mt-3">
                                        <label class="form-label">Upload Image</label>
                                        <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                            <div class="flex flex-wrap px-4" id="image-preview-container">
                                                {{--                                                @dd($products->first()->first()->productImage)--}}
                                                @foreach ($product->productImage as $image)
                                                    @if (isset($image->image))
                                                        <div
                                                            class='w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in'
                                                            data-image-id="{{ $image->id }}">
                                                            <img src="{{ asset('admin/product/'.$image->image) }}"
                                                                 class="rounded-md" alt="Preview Image">
                                                            {{-- Remove button --}}
                                                            <div
                                                                class='remove-image tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2'
                                                                title='Remove this image?'>
                                                                <i data-feather="x" class="w-4 h-4"></i>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                                <i data-feather="image" class="w-4 h-4 mr-2"></i> <span
                                                    class="text-primary mr-1">Upload a file</span> or drag and drop
                                                <input type="file" id="image-upload" name="image[]"
                                                       class="w-full h-full top-0 left-0 absolute opacity-0" multiple>
                                            </div>
                                            <textarea name="photo[]" id="hiddenTextarea"
                                                      style="display: none;"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Post Content -->
            <!-- BEGIN: Post Info -->
            <div class="col-span-12 lg:col-span-4">
                <div class="intro-y box p-5">
                    <div>
                        <label class="form-label">Added By</label>
                        <select data-placeholder="Select categories" class="tom-select w-full" id="post-form-3" required
                                name="added_by">
                            @foreach ($admins as $user)
                                <option
                                    value="{{ $user->id }}" {{ $user->id == $product->created_by ? 'selected' : '' }}>
                                    {{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="post-form-2" class="form-label">Post Date</label>
                        <input type="text" name="date" class="datepicker form-control" id="post-form-2"
                               data-single-mode="true" value="{{ $product->created_at }}">
                    </div>
                    @php
                        $metadata = [];
                        foreach ($product->productCategory as $category) {
                            array_push($metadata, $category->category_id);
                        }
                    @endphp
                    <div class="mt-3">
                        <label for="post-form-3" class="form-label">Categories</label>
                        <select data-placeholder="Select categories" class="tom-select w-full" id="post-form-3"
                                name="category[]" multiple>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                        @if(in_array($category->id, $metadata)) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="post-form-4" class="form-label">Tags</label>
                        <select data-placeholder="Select your favorite actors" name="tag[]" class="tom-select w-full"
                                id="post-form-4" multiple required>
                            @foreach(json_decode($product->tags) as $key => $tag)
                                <option value="{{ $tag }}" selected>{{ $tag }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{--                    TODO:: need to fix--}}
                    <div class="mt-3">
                        <label for="post-form-4" class="form-label">Product code</label>
                        <input type="text" name="product_code" class="form-control" id="post-form-2"
                               data-single-mode="true" value="{{ $product->product_code }}" required>
                    </div>


                    <div class="mt-3">
                        <label for="post-form-4" class="form-label">Currency</label>
                        <select data-placeholder="Add your product price currency" name="currency"
                                class="tom-select w-full" id="post-form-4" required>
                            @foreach ($currencies as $currency)
                                <option value="{{ $currency->id }}" {{ $currency->id == $product->currency_id ? 'selected' : '' }}>{{ $currency->name }} ({{ $currency->code }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="post-form-4" class="form-label">Product Price</label>
                        <input type="text" name="price" class="form-control" id="post-form-2"
                               data-single-mode="true" value="{{ $product->price }}" required>
                    </div>
                    <div class="mt-3">
                        <label for="post-form-4" class="form-label">Discount Product Price</label>
                        <input type="text" name="discount_price" class="form-control" id="post-form-2"
                               data-single-mode="true" value="{{ $product->discount_price }}">
                    </div>
                    <div class="mt-3">
                        <label for="post-form-4" class="form-label">Product Stock</label>
                        <input type="number" name="stock" class="form-control" id="post-form-2"
                               data-single-mode="true" value="{{ $product->stock }}" required>
                    </div>
                    <div class="form-check form-switch flex flex-col items-start mt-3">
                        <label for="coupon-toggle" class="form-check-label ml-0 mb-2">Add Coupon Code?</label>
                        <input id="coupon-toggle" class="form-check-input" name="coupon" type="checkbox" {{ $product->has_coupon == 1 ? 'checked' : '' }}>
                    </div>
                    <div id="coupon-field" class="mt-3" style="display: none;">
                        <label for="post-form-coupon" class="form-label">Product Coupon Code(OPTIONAL)</label>
                        <input type="text" name="coupon_code" class="form-control" id="post-form-coupon"
                               data-single-mode="true">
                    </div>
                    <div id="percentage-field" class="mt-3" style="display: none;">
                        <label for="post-form-percentage" class="form-label">Percentage</label>
                        <input type="text" name="coupon_percentage" class="form-control" id="post-form-percentage"
                               data-single-mode="true">
                    </div>
                    <div class="form-check form-switch flex flex-col items-start mt-3">
                        <label for="post-form-5" class="form-check-label ml-0 mb-2">Published</label>
                        <input id="post-form-5" name="publish" class="form-check-input" type="checkbox" {{ $product->is_active == 1 ? 'checked' : '' }}>
                    </div>
                </div>
            </div>
            <!-- END: Post Info -->
        </div>
    </form>

    <div id="success-notification" class="p-5">
        <div class="preview">
            <div class="text-center">
                <!-- BEGIN: Notification Content -->
                <div id="success-notification-content" class="toastify-content hidden flex">
                    <i class="text-success" data-feather="check-circle"></i>
                    <div class="ml-4 mr-4">
                        <div class="font-medium">Success!</div>
                        <div class="text-slate-500 mt-1">Image Removed Successfully</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('dist/js/ckeditor-classic.js') }}"></script>
    <script>
        let allFiles = [];
        document.getElementById('image-upload').addEventListener('change', function () {
            const previewContainer = document.getElementById('image-preview-container');

            const files = this.files;
            for (const file of files) {
                allFiles.push(file);
                const reader = new FileReader();
                reader.onload = function (e) {
                    // Create the outer div
                    const imgDiv = document.createElement('div');
                    imgDiv.classList.add('w-24', 'h-24', 'relative', 'image-fit', 'mb-5', 'mr-5',
                        'cursor-pointer', 'zoom-in');

                    // Create the img element
                    const imgElement = document.createElement('img');
                    imgElement.classList.add('rounded-md');
                    imgElement.setAttribute('src', e.target.result);
                    imgElement.setAttribute('alt', 'Preview Image');

                    // Create the remove button div
                    const removeButtonDiv = document.createElement('div');
                    removeButtonDiv.classList.add('tooltip', 'w-5', 'h-5', 'flex', 'items-center',
                        'justify-center', 'absolute', 'rounded-full', 'text-white', 'bg-danger', 'right-0',
                        'top-0', '-mr-2', '-mt-2');
                    removeButtonDiv.setAttribute('title', 'Remove this image?');
                    removeButtonDiv.innerHTML = '<i data-feather="x" class="w-4 h-4"></i>';


                    // Event listener for remove button
                    removeButtonDiv.addEventListener('click', function () {
                        const fileName = file.name;
                        const fileIndex = allFiles.findIndex(f => f.name === fileName);
                        if (fileIndex !== -1) {
                            allFiles.splice(fileIndex, 1); // Remove the file from the array
                        }
                        updateHiddenTextarea(); // Update the textarea
                        previewContainer.removeChild(imgDiv);

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
                    });

                    imgDiv.appendChild(imgElement);
                    imgDiv.appendChild(removeButtonDiv);
                    previewContainer.appendChild(imgDiv);
                    feather.replace();
                };
                reader.readAsDataURL(file);
            }
            updateHiddenTextarea();

            const imageNames = allFiles.map(file => file.name);
            console.log(imageNames)
            document.getElementById('hiddenTextarea').value = imageNames.join(',');


            function updateHiddenTextarea() {
                const imageNames = allFiles.map(file => file.name);
                document.getElementById('hiddenTextarea').value = imageNames.join(',');
            }

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('coupon-toggle');
            const couponField = document.getElementById('coupon-field');
            const percentageField = document.getElementById('percentage-field');

            // Function to toggle visibility
            function toggleVisibility(checked) {
                if (checked) {
                    couponField.style.display = 'block';
                    percentageField.style.display = 'block';
                } else {
                    couponField.style.display = 'none';
                    percentageField.style.display = 'none';
                    couponField.value = '';
                    percentageField.value = '';
                }
            }

            // Event listener for checkbox
            checkbox.addEventListener('change', function () {
                toggleVisibility(this.checked);
            });

            // Initial check
            toggleVisibility(checkbox.checked);
        });
    </script>
    <script>
        document.querySelectorAll('.remove-image').forEach(button => {
            button.addEventListener('click', function () {
                var imageDiv = this.parentElement;
                var imageId = imageDiv.getAttribute('data-image-id');

                // AJAX request to backend route for deletion
                console.log(imageId);
                fetch('delete-image/' + imageId, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove the image element from the DOM
                            imageDiv.remove();
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
                        } else {
                            // Handle error
                            alert('Error removing image');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });

    </script>
    <script>
        document.querySelectorAll('.remove').forEach(button => {
            button.addEventListener('click', function () {
                console.log('ok');
            });
        });
    </script>
@endpush
