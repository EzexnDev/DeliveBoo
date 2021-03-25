@extends('layouts.main')

@section('content')
    {{-- @if(session('success_message'))
        <div class="alert alert-success">
            {{session('success_message')}}
        </div>
    @endif

    @if(count($errors) > 0)
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach;
            </ul>
        </div>
    @endif   --}}

    <checkout-cart></checkout-cart>
    {{-- <form method="post" id="payment-form" action="{{redirect()->route('/home')}}">
        @csrf
        <card-component></card-component>
    </form> --}}

    {{-- PAYMENT FORM --}}
    <div class="checkbox-container">
        <div class="container payment-container">
            <div class="payment-box">
                <form method="post" id="payment-form" action="{{route('result.message')}}">
                    @csrf
                    <section>
                        <label class="amount" for="amount">
                            <span class="input-label" style='color:#5433ff;'>Totale da pagare:</span>
                            <div class="input-wrapper amount-wrapper">
                                <input id="amount" name="amount" type="tel" min="1"  style= 'color:#5433ff;' placeholder="Amount" value="{{$totalPrice}}">
                            </div>
                        </label>
                        <div class="bt-drop-in-wrapper">
                            <div id="bt-dropin"></div>
                        </div>
                    </section>

                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                    <button class="button" type="submit"><span>Completa Pagamento</span></button>
                </form>
            </div>
        </div>
    </div>
@endsection

    <script defer src="https://js.braintreegateway.com/web/dropin/1.27.0/js/dropin.min.js"></script>
    <script defer>
        document.addEventListener('DOMContentLoaded',function(event){
                    var form = document.querySelector('#payment-form');
                    var client_token = "{{ $token }}";
                    braintree.dropin.create({
                        authorization: client_token,
                        selector: '#bt-dropin',
                        paypal: {
                            flow: 'vault'
                        }
                    }, function(createErr, instance) {
                        if (createErr) {
                            console.log('Create Error', createErr);
                            return;
                        }
                        form.addEventListener('submit', function(event) {

                            event.preventDefault();
                            instance.requestPaymentMethod(function(err, payload) {
                                if (err) {
                                    console.log('Request Payment Method Error', err);
                                    return;
                                }
                                // Add the nonce to the form and submit
                                document.querySelector('#nonce').value = payload.nonce;
                                form.submit();
                            });
                        });
                    });
        });
    </script>
