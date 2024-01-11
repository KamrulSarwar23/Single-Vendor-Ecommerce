<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.general-setting-update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Site Name</label>
                    <input type="text" class="form-control" name="site_name"
                        value="{{ @$generalSetting->site_name }}">
                </div>

                <div class="form-group">
                    <label>Layout</label>
                    <select name="layout" id="" class="form-control">
                        <option {{ @$generalSetting->layout == 'LTR' ? 'selected' : '' }} value="LTR">LTR</option>
                        <option {{ @$generalSetting->layout == 'RTL' ? 'selected' : '' }} value="RTL">RTL</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Contact Email</label>
                    <input type="email" class="form-control" name="contact_email"
                        value="{{ @$generalSetting->contact_email }}">
                </div>

                <div class="form-group">
                    <label>Contact Phone</label>
                    <input type="text" class="form-control" name="contact_phone"
                        value="{{ @$generalSetting->contact_phone }}">
                </div>

                <div class="form-group">
                    <label>Contact Address</label>
                    <input type="text" class="form-control" name="contact_address"
                        value="{{ @$generalSetting->contact_address }}">
                </div>

                <div class="form-group">
                    <label>Google Map Url</label>
                    <input type="text" class="form-control" name="map"
                        value="{{ @$generalSetting->map }}">
                </div>

                <hr>

                <div class="form-group">
                    <label>Default Currency Name</label>
                    <select name="currency_name" id="" class="form-control select2">
                        <option value="">Select</option>

                        @foreach (config('settings.currency_list') as $currency)
                            <option {{ @$generalSetting->currency_name == $currency ? 'selected' : '' }}
                                value="{{ $currency }}">{{ $currency }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label>Currency Icon</label>

                    <select name="currency_icon" id="" class="form-control select2">
                        @foreach (config('settings.currencySymbols') as $currencySymbols)
                            <option {{ @$generalSetting->currency_icon == $currencySymbols ? 'selected' : '' }}
                                value="{{ $currencySymbols }}">{{ $currencySymbols }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Time Zone</label>
                    <select name="time_zone" id="" class="form-control select2">
                        <option value="">Select</option>
                        @foreach (config('settings.time_zone') as $key => $time_zone)
                            <option {{ @$generalSetting->time_zone == $key ? 'selected' : '' }}
                                value="{{ $key }}">{{ $key }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>
