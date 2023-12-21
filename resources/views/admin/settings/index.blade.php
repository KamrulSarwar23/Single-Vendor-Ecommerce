@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Settings</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Settings</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <div class="list-group" id="list-tab" role="tablist">
                                        <a class="list-group-item list-group-item-action active" id="list-home-list"
                                            data-toggle="list" href="#list-home" role="tab">General Setting</a>
                                        <a class="list-group-item list-group-item-action" id="list-profile-email"
                                            data-toggle="list" href="#list-email" role="tab">Email Configuration</a>
                                    
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="tab-content" id="nav-tabContent">

                                        @include('admin.settings.general-setting')

                                        @include('admin.settings.email-config')

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
