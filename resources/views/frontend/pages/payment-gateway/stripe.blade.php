<div class="tab-pane fade show" id="v-pills-stripe" role="tabpanel" aria-labelledby="v-pills-home-tab">
    <div class="row">
        <div class="col-xl-12 m-auto">
            <div class="wsus__payment_area">
                <form action="{{ route('user.stripe.payment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="stripe_token" id="stripe-token-id">
                    <div id="card-element"></div>
                    <button class="nav-link common_btn">Pay With Stripe</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe();
    </script>
@endpush
