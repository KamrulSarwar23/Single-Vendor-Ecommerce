<div class="tab-pane fade" id="list-logo" role="tabpanel" aria-labelledby="list-profile-logo">

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.logo-setting-update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div>
                    <img width="100px" height="100px" src="{{ asset(@$logoSetting->logo) }}" alt="">
                </div>
                <div class="form-group mt-2">
                    <label>Logo</label>
                    <input type="file" class="form-control" name="logo" value="">
                    <input type="hidden" class="form-control" name="old_logo" value="{{@$logoSetting->logo}}">
                </div>

                <div>
                    <img width="100px" height="100px" src="{{ asset(@$logoSetting->favicon) }}" alt="">
                </div>

                <div class="form-group mt-2">
                    <label>Favicon</label>
                    <input type="file" class="form-control" name="favicon" value="">
                    <input type="hidden" class="form-control" name="old_favicon" value="{{@$logoSetting->favicon}}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>
