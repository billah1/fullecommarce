@extends('Admin.master')
@push('css')

@endpush
@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Banner Manage
        </h2>
    </div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <div class="col-md-6">
            <div class="modal-body p-10">

                <div class="flex flex-col sm:flex-row items-center">
                    <h1 class="font-medium text-base">
                        Banner 1
                    </h1>

                </div>
                <form action="{{ route('admin.bannerSave') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="banner_id" value="{{ isset($items[0]) ? $items[0]->id : '' }}">
                    <div id="input" class="mt-6">
                        <div class="preview">
                            <div class="mb-3">
                                <label for="regular-form-1" class="form-label">Title</label>
                                <input id="regular-form-1" type="text" name="title" class="form-control"
                                       placeholder="Enter Slider Title" value="{{ isset($items[0]) ? $items[0]->title : '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="regular-form-1" class="form-label">Description</label>
                                <textarea id="regular-form-1" name="description" class="form-control"
                                          placeholder="Enter Banner Description"
                                          required>{{ isset($items[0]) ? $items[0]->description :  '' }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="regular-form-1" class="form-label">Slider Image</label>
                                <input name="file" type="file"
                                       data-default-file="{{ isset($items[0]) ?  asset('admin/Banner').'/'. $items[0]->image : '' }}"
                                       class="dropify" data-height="400"/>
                            </div>
                        </div>
                    </div>
                    <div class="buttons flex justify-between" style="margin-top: 20px;">
                        <button type="submit" class="btn btn-primary mr-1">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="modal-body p-10">

                <div class="flex flex-col sm:flex-row items-center">
                    <h1 class="font-medium text-base">
                        Banner 2
                    </h1>

                </div>
                <form action="{{ route('admin.bannerSave') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="banner_id" value="{{ isset($items[1]) ? $items[1]->id : '' }}">
                    <div id="input" class="mt-6">
                        <div class="preview">
                            <div class="mb-3">
                                <label for="regular-form-1" class="form-label">Title</label>
                                <input id="regular-form-1" type="text" name="title" class="form-control"
                                       value="{{ isset($items[1]) ? $items[1]->title : '' }}"
                                       placeholder="Enter Slider Title" required>
                            </div>
                            <div class="mb-3">
                                <label for="regular-form-1" class="form-label">Description</label>
                                <textarea id="regular-form-1" name="description" class="form-control"
                                          placeholder="Enter Banner Description"
                                          required>{{ isset($items[1]) ? $items[1]->description : '' }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="regular-form-1" class="form-label">Slider Image</label>
                                <input name="file" type="file" class="dropify"
                                       data-default-file="{{ isset($items[1]) ?  asset('admin/Banner').'/'. $items[1]->image : '' }}"
                                       data-height="400"/>
                            </div>
                        </div>
                    </div>
                    <div class="buttons flex justify-between" style="margin-top: 20px;">
                        <button type="submit" class="btn btn-primary mr-1">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('.dropify').dropify();
    </script>
@endpush
