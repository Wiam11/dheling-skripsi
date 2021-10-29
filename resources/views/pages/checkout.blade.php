@extends('layouts.app') @section('title') Keranjang @endsection
@section('content')

 <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                    <div class="col-12">
                        <h2 class="mb-1">Payment Information</h2>
                    </div>
                </div>
                  <form
                action="{{ route('checkout') }}"
                id="locations"
                enctype="multipart/form-data"
                method="POST"
            >
                @csrf
                <input
                    type="hidden"
                    name="total_price"
                    value="{{ $totalPrice }}"
                />
                @php $totalProductPrice = 0 @endphp
                @foreach ($carts as $cart)
                  @php $totalProductPrice += $cart->product->price * $cart->qty @endphp
                <div class="row" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-4 col-md-2">
                        <div class="product-title">Rp. {{ $totalProductPrice }}</div>
                        <div class="product-subtitle">Country Tax</div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="product-title">Rp. {{ $ongkir }}</div>
                        <div class="product-subtitle">Product insurance</div>
                    </div>
                    <div class="col-4 col-md-2">
                        <div class="product-title">Rp.</div>
                        <div class="product-subtitle">Shipping</div>
                    </div>
                    <div class="col-4 col-md-2">
                        <div class="product-title text-success">
                            Rp. {{ number_format($totalPrice ?? 0) }}
                        </div>
                        <div class="product-subtitle">Total</div>
                    </div>
                   @endforeach
                    <div class="col-8 col-md-3">
                        <button
                            type="submit"
                            class="btn btn-success mt-4 px-4 btn-block"
                        >
                            Checkout Now
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
