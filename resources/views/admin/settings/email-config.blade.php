<div class="tab-pane fade" id="list-email" role="tabpanel" aria-labelledby="list-profile-email">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.email-config.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" value="{{ $emailconfig->email }}">
                </div>

                <div class="form-group">
                    <label>Mail Host</label>
                    <input type="text" class="form-control" name="mail_host" value="{{ $emailconfig->mail_host }}">
                </div>

                <div class="form-group">
                    <label>Smtp username</label>
                    <input type="text" class="form-control" name="smtp_username"
                        value="{{ $emailconfig->smtp_username }}">
                </div>

                <div class="form-group">
                    <label>Smtp password</label>
                    <input type="text" class="form-control" name="smtp_password"
                        value="{{ $emailconfig->smtp_password }}">
                </div>

                <div class="form-group">
                    <label>Mail Port</label>
                    <input type="text" class="form-control" name="mail_port" value="{{ $emailconfig->mail_port }}">
                </div>

                <div class="form-group">
                    <label>Mail Encryption</label>

                    <select name="mail_encryption" id="" class="form-control">
                        <option {{ $emailconfig->mail_encryption == 'tls' ? 'selected' : '' }} value="tls">TLS
                        </option>
                        <option {{ $emailconfig->mail_encryption == 'ssl' ? 'selected' : '' }} value="ssl">SSL
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="Update" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>
