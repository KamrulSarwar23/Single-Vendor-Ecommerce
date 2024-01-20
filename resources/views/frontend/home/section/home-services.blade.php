<section id="wsus__home_services" class="home_service_2">
    <div class="container">
        <div class="row">

            @foreach ($service as $item)
            <div class="col-xl-3 col-sm-6 col-lg-3 pe-lg-0 mb-5">
                <div class="wsus__home_services_single home_service_single_2 border_left">
                    <i class="{{ $item->icon }}"></i>
                    <h5>{{ $item->heading }}</h5>
                    <p>{{ $item->service }}</p>
                </div>
            </div>
            @endforeach
      
            
        </div>
    </div>
</section>