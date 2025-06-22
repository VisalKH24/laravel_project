@extends('Frontend.layout')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
@section('title')
NL SHOPPING
@endsection
<style>
    @media (min-width: 1025px) {
        .h-custom {
            height: 100vh !important;
        }
    }

    .number-input input[type="number"] {
        -webkit-appearance: textfield;
        -moz-appearance: textfield;
        appearance: textfield;
    }

    .number-input input[type=number]::-webkit-inner-spin-button,
    .number-input input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
    }

    .number-input button {
        -webkit-appearance: none;
        background-color: transparent;
        border: none;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin: 0;
        position: relative;
    }

    .number-input button:before,
    .number-input button:after {
        display: inline-block;
        position: absolute;
        content: '';
        height: 2px;
        transform: translate(-50%, -50%);
    }

    .number-input button.plus:after {
        transform: translate(-50%, -50%) rotate(90deg);
    }

    .number-input input[type=number] {
        text-align: center;
    }

    .number-input.number-input {
        border: 1px solid #ced4da;
        width: 10rem;
        border-radius: .25rem;
    }

    .number-input.number-input button {
        width: 2.6rem;
        height: .7rem;
    }

    .number-input.number-input button.minus {
        padding-left: 10px;
    }

    .number-input.number-input button:before,
    .number-input.number-input button:after {
        width: .7rem;
        background-color: #495057;
    }

    .number-input.number-input input[type=number] {
        max-width: 4rem;
        padding: .5rem;
        border: 1px solid #ced4da;
        border-width: 0 1px;
        font-size: 1rem;
        height: 2rem;
        color: #495057;
    }

    @media not all and (min-resolution:.001dpcm) {
        @supports (-webkit-appearance: none) and (stroke-color:transparent) {

            .number-input.def-number-input.safari_only button:before,
            .number-input.def-number-input.safari_only button:after {
                margin-top: -.3rem;
            }
        }
    }

    .shopping-cart .def-number-input.number-input {
        border: none;
    }

    .shopping-cart .def-number-input.number-input input[type=number] {
        max-width: 2rem;
        border: none;
    }

    .shopping-cart .def-number-input.number-input input[type=number].black-text,
    .shopping-cart .def-number-input.number-input input.btn.btn-link[type=number],
    .shopping-cart .def-number-input.number-input input.md-toast-close-button[type=number]:hover,
    .shopping-cart .def-number-input.number-input input.md-toast-close-button[type=number]:focus {
        color: #212529 !important;
    }

    .shopping-cart .def-number-input.number-input button {
        width: 1rem;
    }

    .shopping-cart .def-number-input.number-input button:before,
    .shopping-cart .def-number-input.number-input button:after {
        width: .5rem;
    }

    .shopping-cart .def-number-input.number-input button.minus:before,
    .shopping-cart .def-number-input.number-input button.minus:after {
        background-color: #9e9e9e;
    }

    .shopping-cart .def-number-input.number-input button.plus:before,
    .shopping-cart .def-number-input.number-input button.plus:after {
        background-color: #4285f4;
    }
</style>



@section('content')
<div class="h-100 h-custom" style="background-color: #eee;">

    <div class="container h-100 py-5">
        @if (Session::has('message'))
        <p class="text-center" style="font-size: 25px;color: #65ff18"><b>{{ Session::get('message') }}</b></p>
        @endif
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card shopping-cart" style="border-radius: 15px;">
                    <div class="card-body text-black">

                        <div class="row">
                            <div class="col-lg-6 px-5 py-4">

                                <h3 class="mb-5 pt-2 text-center fw-bold text-uppercase">Your products</h3>

                                <div class="d-flex align-items-center mb-5">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $product->image }}" class="img-fluid" style="width: 150px;"
                                            alt="Generic placeholder image">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <a href="#!" class="float-end text-black"><i class="fas fa-times"></i></a>
                                        <h5 class="text-primary">{{ $product->product_name }}</h5>
                                        <h6 style="color: #9e9e9e;">Color:{{ $product->color }}</h6>
                                        <p class="fw-bold mb-0 me-5 pe-3">Reqular Price : $
                                            {{ $product->reqular_price }}
                                        </p>
                                        <div class="d-flex align-items-center">

                                            <p class="fw-bold mb-0 me-5 pe-3">Sale Price : $ {{ $product->sale_price }}
                                            </p>
                                            <form action="" method="POST">
                                                @csrf
                                                <div class="def-number-input number-input safari_only">
                                                    <button type="button" onclick="changeQuantity(this, -1)"
                                                        class="minus"></button>
                                                    <input class="quantity fw-bold text-black" min="1"
                                                        name="quantity" value="{{ $quantity }}" type="number">
                                                    <button type="button" onclick="changeQuantity(this, 1)"
                                                        class="plus"></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <hr class="mb-4" style="height: 2px; background-color: #1266f1; opacity: 1;">

                                <div class="d-flex justify-content-between p-2 mb-2" style="background-color: #e1f5fe;">
                                    <h5 class="fw-bold mb-0">Total:</h5>
                                    <h5 class="fw-bold mb-0" id="total-payment">$ {{ $totalPayment }}</h5>
                                </div>

                            </div>
                            <div class="col-lg-6 px-5 py-4" style="display:flex; flex-direction: column">

                                <h3 class="mb-5 pt-2 text-center fw-bold text-uppercase">Payment</h3>

                                <form action="{{ route('buy-product-submit', $product->id) }}" class="mb-5"
                                    method="post">
                                    @csrf
                                    <div class="row" style="margin-left: 200px">
                                        <img src="/QR.jpg" alt="" style="width: 200px;">
                                    </div>

                                    <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-primary btn-block btn-lg" class="btn right-auto"
                                        style="margin-left: 400px; margin-top: 50px">Buy now</button>

                                    <h5 class="fw-bold mb-5" style="position: absolute; bottom: 0; right: 70px;">
                                        <a href="{{ route('product', $product->id) }}"><i
                                                class="fas fa-angle-left me-2 "></i>Back to shopping</a>
                                    </h5>

                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function changeQuantity(btn, delta) {
        var input = btn.parentNode.querySelector('input[type=number]');
        var newValue = parseInt(input.value) + delta;
        newValue = Math.max(newValue, 1); // minimum quantity = 1
        input.value = newValue;

        // update total price
        var salePrice = parseFloat({
            {
                $product - > sale_price
            }
        });
        var total = newValue * salePrice;
        document.getElementById('total-payment').innerText = '$ ' + total.toFixed(2);
    }
</script>
@endsection