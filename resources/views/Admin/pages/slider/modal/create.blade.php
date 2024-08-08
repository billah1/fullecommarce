<div id="programmatically-show-hide-slide-over" class="p-5">
    <div class="preview">
        <!-- BEGIN: Modal Content -->
        <div id="programmatically-slide-over" class="modal modal-slide-over" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-10">

                        <div class="flex flex-col sm:flex-row items-center">
                            <h1 class="font-medium text-base">
                                Create New Slider
                            </h1>

                        </div>
                        <form action="{{ route('admin.sliderStore') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div id="input" class="mt-6">
                                <div class="preview">
                                    <div class="mb-3">
                                        <label for="regular-form-1" class="form-label">Title</label>
                                        <input id="regular-form-1" type="text" name="title" class="form-control"
                                               placeholder="Enter Slider Title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="regular-form-1" class="form-label">Description</label>
                                        <textarea id="regular-form-1" name="description" class="form-control"
                                               placeholder="Enter Slider Description" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="regular-form-1" class="form-label">Slider Image</label>
                                        <input name="file" type="file" class="dropify" data-height="300"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-6 sm:mt-2">
                                <label class="form-check-label ml-0" for="show-example-1">Active/Disable</label>
                                <input id="show-example-1"
                                       class="show-code form-check-input mr-0 ml-3" name="status" type="checkbox">
                            </div>
                            <div class="buttons flex justify-between" style="margin-top: 20px;">
                                <a id="programmatically-toggle-slide-over" href="javascript:;" class="btn btn-danger mr-1">Cancel</a>
                                <button type="submit" class="btn btn-primary mr-1">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Modal Content -->
    </div>
</div>
<style>
    .modal.modal-slide-over.show > .modal-dialog {
        margin-right: 0;
        width: 45%;
    }
</style>
