@extends('layouts.app')

@push('styles')
    <style>
        .example.example2 {
        background-color: #fff;
        }

        .example.example2 * {
        font-family: Source Code Pro, Consolas, Menlo, monospace;
        font-size: 16px;
        font-weight: 500;
        }

        .example.example2 .row {
        display: -ms-flexbox;
        display: flex;
        margin: 0 5px 10px;
        }

        .example.example2 .field {
        position: relative;
        width: 100%;
        height: 50px;
        margin: 0 10px;
        }

        .example.example2 .field.half-width {
        width: 50%;
        }

        .example.example2 .field.quarter-width {
        width: calc(25% - 10px);
        }

        .example.example2 .baseline {
        position: absolute;
        width: 100%;
        height: 1px;
        left: 0;
        bottom: 0;
        background-color: #cfd7df;
        transition: background-color 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .example.example2 label {
        position: absolute;
        width: 100%;
        left: 0;
        bottom: 8px;
        color: #cfd7df;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        transform-origin: 0 50%;
        cursor: text;
        pointer-events: none;
        transition-property: color, transform;
        transition-duration: 0.3s;
        transition-timing-function: cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .example.example2 .input {
        position: absolute;
        width: 100%;
        left: 0;
        bottom: 0;
        padding-bottom: 7px;
        color: #32325d;
        background-color: transparent;
        }

        .example.example2 .input::-webkit-input-placeholder {
        color: transparent;
        transition: color 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .example.example2 .input::-moz-placeholder {
        color: transparent;
        transition: color 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .example.example2 .input:-ms-input-placeholder {
        color: transparent;
        transition: color 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .example.example2 .input.StripeElement {
        opacity: 0;
        transition: opacity 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        will-change: opacity;
        }

        .example.example2 .input.focused,
        .example.example2 .input:not(.empty) {
        opacity: 1;
        }

        .example.example2 .input.focused::-webkit-input-placeholder,
        .example.example2 .input:not(.empty)::-webkit-input-placeholder {
        color: #cfd7df;
        }

        .example.example2 .input.focused::-moz-placeholder,
        .example.example2 .input:not(.empty)::-moz-placeholder {
        color: #cfd7df;
        }

        .example.example2 .input.focused:-ms-input-placeholder,
        .example.example2 .input:not(.empty):-ms-input-placeholder {
        color: #cfd7df;
        }

        .example.example2 .input.focused + label,
        .example.example2 .input:not(.empty) + label {
        color: #aab7c4;
        transform: scale(0.85) translateY(-25px);
        cursor: default;
        }

        .example.example2 .input.focused + label {
        color: #24b47e;
        }

        .example.example2 .input.invalid + label {
        color: #ffa27b;
        }

        .example.example2 .input.focused + label + .baseline {
        background-color: #24b47e;
        }

        .example.example2 .input.focused.invalid + label + .baseline {
        background-color: #e25950;
        }

        .example.example2 input, .example.example2 button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        outline: none;
        border-style: none;
        }

        .example.example2 input:-webkit-autofill {
        -webkit-text-fill-color: #e39f48;
        transition: background-color 100000000s;
        -webkit-animation: 1ms void-animation-out;
        }

        .example.example2 .StripeElement--webkit-autofill {
        background: transparent !important;
        }

        .example.example2 input, .example.example2 button {
        -webkit-animation: 1ms void-animation-out;
        }

        .example.example2 button {
        display: block;
        width: calc(100% - 30px);
        height: 40px;
        margin: 40px 15px 0;
        background-color: #24b47e;
        border-radius: 4px;
        color: #fff;
        text-transform: uppercase;
        font-weight: 600;
        cursor: pointer;
        }

        .example.example2 .error svg {
        margin-top: 0 !important;
        }

        .example.example2 .error svg .base {
        fill: #e25950;
        }

        .example.example2 .error svg .glyph {
        fill: #fff;
        }

        .example.example2 .error .message {
        color: #e25950;
        }

        .example.example2 .success .icon .border {
        stroke: #abe9d2;
        }

        .example.example2 .success .icon .checkmark {
        stroke: #24b47e;
        }

        .example.example2 .success .title {
        color: #32325d;
        font-size: 16px !important;
        }

        .example.example2 .success .message {
        color: #8898aa;
        font-size: 13px !important;
        }

        .example.example2 .success .reset path {
        fill: #24b47e;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <h2 class="mb-5 text-center">Agregar Metodos de Pago</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                    <div id="success">
                    </div>
                <div class="form-group">
                    <label for="card-holder-name">Nombre de propietario</label>
                    <input type="text" class="form-control" id="card-holder-name" placeholder="Ingrese el nombre de propietario">
                </div>
                <div id="card-element"></div>

                <button id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-primary mt-4 w-100">
                    Agregar Metodo de Pago
                </button>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const divSuccess = document.getElementById('success');
        const clientSecret = cardButton.dataset.secret;
        const stripe = Stripe('pk_test_51HnEIPIlikZUs9gsI5i69fZnlJJI7L1F1eSyUbqqAi4T9sOMGM2BV3pIcdRypYVqsyEIJ5XFrzxEoBCHGSOo3PVV00kzC7TYYj');

        var elements = stripe.elements({
            fonts: [
            {
                cssSrc: 'https://fonts.googleapis.com/css?family=Roboto',
            },
            ],
            // Stripe's examples are localized to specific languages, but if
            // you wish to have Elements automatically detect your user's locale,
            // use `locale: 'auto'` instead.
            locale: window.__exampleLocale
        });

        var card = elements.create('card', {
            iconStyle: 'solid',
            style: {
            base: {
                iconColor: '#c4f0ff',
                color: '#000',
                fontWeight: 500,
                fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
                fontSize: '16px',
                fontSmoothing: 'antialiased',

                ':-webkit-autofill': {
                color: '#fce883',
                },
                '::placeholder': {
                color: '#87BBFD',
                },
            },
            invalid: {
                iconColor: '#fa755a',
                color: '#fa755a',
            },
            },
        });
        card.mount('#card-element');

        cardButton.addEventListener("click", function(){
            console.log('click');

            createPaymentMethod();
        },false);

        async function createPaymentMethod(){
            const { setupIntent, error } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: card,
                        billing_details: { name: cardHolderName.value }
                    }
                }
            );

            if (error) {
                // Display "error.message" to the user...
                console.log(error);
            } else {
                // The card has been verified successfully...
                axios.post('/save-card',{
                    card: setupIntent["payment_method"],
                    _token: "{{ csrf_token() }}"
                }).then(response => {
                    divSuccess.innerHTML = '<div class="alert alert-success">Metodo de pago agregado!</div>';
                });
            }
        }
    </script>
@endsection
