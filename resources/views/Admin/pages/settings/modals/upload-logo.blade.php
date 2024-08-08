<div id="programmatically-show-hide-modal" class="p-5">
    <div class="preview">
        <!-- BEGIN: Modal Content -->
        <div id="programmatically-modal" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-10">

                        <div class="flex flex-col sm:flex-row items-center">
                            <h1 class="font-medium text-base">
                                Upload Logo here
                            </h1>
                        </div>
                        <form action="{{ route('admin.uploadLogo') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="container" style="margin-top: 10px;">
                                <input name="file" type="file" class="dropify" data-height="300"/>
                            </div>
                            <div class="buttons flex justify-between" style="margin-top: 20px;">
                                <a id="programmatically-hide-modal" href="javascript:;" class="btn btn-danger mr-1">Cancel</a>
                                <button type="submit" class="btn btn-primary mr-1">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Modal Content -->
    </div>
</div>
