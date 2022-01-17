@extends('layouts.subscribe')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Subscribe') }}</div>
                <div class="card-body">
                    <div class='text-center'>
                        <h5 >You can check and send emails to who you want at the click of a button, or even download your next employee's CV for only 15€/month!</h5>
                <form action="{{ route('subscribe.post') }}" method="post" id="payment-form" data-secret={{ $intent->client_secret }}>
                    @csrf

                    
                    <div class="row">
                        <div class="col" >
                            Cardholder's Name
                            <input type="text" class="form-control" id="cardholder-name" value = {{Auth::user()->name}}>
                            <input type="hidden" name="plan" value="price_1KIzARFaZTsfBrG7VNUQTLO0"> 
                        </div>
                        <div class="col"></div>
                    </div> 
                    <br>     
                    <div class="form-row">
                            <label for="card-element">
                            </label>
                            <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>
                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>
                            </div>
                    </div>
                    <br>
                    <div class='text-center'>
                        <button type="submit" class="btn btn-primary" style="padding-bottom:10px">Subscribe (15€/Monthly)</button>
                    </div>      
                </form>
            </div>
        </div>
    </div>
</div>
    @push('scripts')
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            // Create a Stripe client.
            var stripe = Stripe('pk_test_51KHuE6FaZTsfBrG7KKaSRajEO9efxOcHkq46sEjzUMq8tPbDmIPauszE1l1SH6pKqmZH8Dgf6I2dB9862b4NQU6K00ot90ZpCL');

            // Create an instance of Elements.
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {style: style});

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
            });

            // Handle form submission.
            var form = document.getElementById('payment-form');
            var cardHolderName = document.getElementById('cardholder-name');
            var clientSecret = form.dataset.secret;

            form.addEventListener('submit', async function(event) {
            event.preventDefault();
            const { setupIntent, error } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: card,
                        billing_details: { name: cardHolderName.value }
                    }
                }
            );

            if (error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
            } else {
                // Send the token to your server.
                //console.log(setupIntent);
                stripeTokenHandler(setupIntent);
            }
            });

            // Submit the form with the token ID.
            function stripeTokenHandler(setupIntent) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'paymentMethod');
            hiddenInput.setAttribute('value', setupIntent.payment_method);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
            }
        </script>
    @endpush
@endsection