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
                                        <a class="list-group-item list-group-item-action" id="list-profile-list"
                                            data-toggle="list" href="#list-profile" role="tab">News Letter</a>
                                    
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="tab-content" id="nav-tabContent">

                                        @include('admin.settings.general-setting')

                                        <div class="tab-pane fade" id="list-profile" role="tabpanel"
                                            aria-labelledby="list-profile-list">
                                            Deserunt cupidatat anim ullamco ut dolor anim sint nulla amet incididunt tempor
                                            ad ut pariatur officia culpa laboris occaecat. Dolor in nisi aliquip in non
                                            magna amet nisi sed commodo proident anim deserunt nulla veniam occaecat
                                            reprehenderit esse ut eu culpa fugiat nostrud pariatur adipisicing incididunt
                                            consequat nisi non amet.
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
