@extends('layouts.layout')
@section('extra-meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('extra-script')
    <script src="https://js.stripe.com/v3/"></script>
@endsection




@section('content')
<div class="container">
    <div class="col-md-12">
        <h1>Page de paiment</h1>
        <div class="row">
        <div class="col-md-6">
        <form id="payment-form" action="{{ route('checkout.store') }}" method="POST" class="my-4">
            @csrf
            <div id="card-element">
                <!-- Elements will create input elements here -->
            </div>

            <!-- We'll put the error messages in this element -->
            <div id="card-errors" role="alert"></div>

            <button class="btn btn-success mt-4" id="submit">Proceder au paiment {{ getPrice(Cart::total()) }}</button>
            </form>
        </div>
        </div>
    </div>
</div>

@endsection

@section('extra-js')
    <script>
        var stripe = Stripe('pk_test_bCAiIzbPZ54TuL4H4jKbibNg00XvglXU9y');

        
        var elements = stripe.elements();
        var style = {
            base: {
            color: "#32325d",
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: "antialiased",
            fontSize: "16px",
            "::placeholder": {
                color: "#aab7c4"
            }
            },
            invalid: {
            color: "#fa755a",
            iconColor: "#fa755a"
            }
        };

        var card = elements.create("card", { style: style });
        card.mount("#card-element");

        //Event handler error
        card.on('change', ({error}) => {
            const displayError = document.getElementById('card-errors');
            if (error) {
                displayError.classList.add('alert', 'alert-warning');
                displayError.textContent = error.message;
            } else {
                displayError.classList.remove('alert', 'alert-warning');
                displayError.textContent = '';
            }
        });

        //more
        var submitButton = document.getElementById('submit');
        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function(ev) {
        ev.preventDefault();
        submitButton.disabled = true;
        stripe.confirmCardPayment("{{ $clientSecret }}", {
            payment_method: {
            card: card
            }
        }).then(function(result) {
            if (result.error) {
            // Show error to your customer (e.g., insufficient funds)
            submitButton.disabled = false;
            console.log(result.error.message);
            } else {
            // The payment has been processed!
            if (result.paymentIntent.status === 'succeeded') {
                // Show a success message to your customer
                // There's a risk of the customer closing the window before callback
                // execution. Set up a webhook or plugin to listen for the
                // payment_intent.succeeded event that handles any business critical
                // post-payment actions.
                //console.log(result.paymentIntent);
                //var forma = document.getElementById('payment-form');
                var paymentIntent = result.paymentIntent;
                var url = form.action;
                var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                var redirect = '/merci';

                fetch(
                    url,
                    {
                        headers:{
                            "Content-Type": "application/json",
                            "Accept": "application/json, text-plain, */*",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": token
                        },
                        method : 'post',
                        body: JSON.stringify({
                            paymentIntent: paymentIntent
                        })
                    }
                ).then((data) => {
                    console.log(data);
                    window.location.href = redirect;
                }).catch((error) => {
                    console.log(error);
                })
            }
            }
        });
        });

    </script>
@endsection
