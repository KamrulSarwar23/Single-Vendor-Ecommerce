<div class="tab-pane fade" id="list-cod" role="tabpanel" aria-labelledby="list-cod-list">

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.cod-setting-update', 1) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>COD Status</label>
                    <select name="status" id="" class="form-control">
                        <option {{@$CodSetting->status == 1 ? 'selected' : ''}} value="1">Enable</option>
                        <option {{@$CodSetting->status == 0 ? 'selected' : ''}} value="0">Disable</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>
        </div>
    </div>
</div>
