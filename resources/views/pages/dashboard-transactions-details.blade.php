@extends('layouts.dashboard') @section('title') Dashboard Transaksaksi Detail
@endsection @section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-tittle">#{{ $transaction->code }}</h2>
            <p class="dashboard-subtitle">Transactions Details</p>
        </div>
        <div class="dashboard-content" id="transactionsDetails">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <img
                                        src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                                        class="w-100 mb-3"
                                        alt=""
                                    />
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="product-title">
                                                Customer Name
                                            </div>
                                            <div class="product-subtitile">
                                                {{ $transaction->transaction->user->name }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="product-title">
                                                Product Name
                                            </div>
                                            <div class="product-subtitile">
                                                {{ $transaction->product->name }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="product-title">
                                                Data of Transactions
                                            </div>
                                            <div class="product-subtitile">
                                                {{ $transaction->created_at }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="product-title">
                                                Payment Status
                                            </div>
                                            <div
                                                class="product-subtitile text-danger"
                                            >
                                                {{ $transaction->transaction->transaction_status }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="product-title">
                                                Total Produk
                                            </div>
                                            <div class="product-subtitile">
                                                Rp.{{ number_format($transaction->price) }}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="product-title">
                                                Mobile
                                            </div>
                                            <div class="product-subtitile">
                                                {{ $transaction->transaction->user->phone_number }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form
                                action="{{ route('dashboard-transactions-update', $transaction->id) }}"
                                method="POST"
                                enctype="multipart/form-data"
                            >
                                @csrf
                                <div class="row">
                                    <div class="col-12 mt-4">
                                        <h5>Shipping Information</h5>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">
                                                    Address I
                                                </div>
                                                <div class="product-subtitile">
                                                    {{ $transaction->transaction->user->address_one }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">
                                                    Address II
                                                </div>
                                                <div class="product-subtitile">
                                                    {{ $transaction->transaction->user->address_two }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">
                                                    Province
                                                </div>
                                                <div class="product-subtitile">
                                                    {{ App\Province::find($transaction->transaction->user->provinces_id)->name }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">
                                                    City
                                                </div>
                                                <div class="product-subtitile">
                                                    {{ App\City::find($transaction->transaction->user->regencies_id)->name }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">
                                                    Postal Code
                                                </div>
                                                <div class="product-subtitile">
                                                    {{ $transaction->transaction->user->zip_code }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">
                                                    Country
                                                </div>
                                                <div class="product-subtitile">
                                                    {{ $transaction->transaction->user->country }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">
                                                    Shipping Status
                                                </div>
                                                <input
                                                    type="text"
                                                    class="form-control col-md-3"
                                                    id="shipping_status"
                                                    name="shipping_status"
                                                    v-model="status"
                                                />
                                            </div>
                                            <template
                                                v-if="status == 'SHIPPING'"
                                            >
                                                <div class="col-nd-3">
                                                    <div class="product-title">
                                                        Input Resi
                                                    </div>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        name="resi"
                                                        v-model="resi"
                                                    />
                                                </div>
                                            </template>
                                            <div class="col-12 col-md-6">
                                            <div class="product-title">
                                                Total Amount
                                            </div>
                                            <div class="product-subtitile">
                                                Rp.{{ number_format($transaction->transaction->total_price) }}
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @push('addon-script')
<script src="/vendor/vue/vue.js"></script>
<script>
    var transactionsDetails = new Vue({
        el: "#transactionsDetails",
        data: {
            status: "{{ $transaction->shipping_status }}",
            resi: "{{ $transaction->resi }}"
        }
    });
</script>
@endpush
