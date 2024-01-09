@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Orders</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <section class="section">
                        <div class="col-md-12 text-right mb-3">
                        </div>
                        <div class="invoice">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="section-title">Vendor Request</div>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <tr>
                                                <th>User Name: </th>
                                                <td>{{ $vendorrequest->user->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>User Email: </th>
                                                <td>{{ $vendorrequest->user->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Shop Name: </th>
                                                <td>{{ $vendorrequest->shop_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Shop Phone: </th>
                                                <td>{{ $vendorrequest->phone }}</td>
                                            </tr>
                                            <tr>
                                                <th>Shop Address: </th>
                                                <td>{{ $vendorrequest->address }}</td>
                                            </tr>
                                            <tr>
                                                <th>Description: </th>
                                                <td>{{ $vendorrequest->description }}</td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Request Status</label>
                                                <select name="status" data-id="{{ $vendorrequest->id }}" id="vendor_status"
                                                    class="form-control">
                                                    <option value="">Select</option>
                                                    <option {{ $vendorrequest->status == 1 ? 'selected' : '' }}
                                                        value="1">Approved</option>
                                                    <option {{ $vendorrequest->status == 0 ? 'selected' : '' }}
                                                        value="0">Pending</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                        </div>

                    </section>

                </div>

            </div>
        </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('#vendor_status').on('change', function() {
                let status = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.vendor-request.status') }}",
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            toastr.success(data.message);
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            })
        })
    </script>
@endpush
