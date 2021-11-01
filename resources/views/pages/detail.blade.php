@extends('layouts.app') @section('title') Store Details page @endsection
@section('content')
<div class="page-content page-details">
    <section
        class="store-breadcrumbs"
        data-aos="fade-down"
        data-aos-delay="100"
    >
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">Product Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="store-gallery mb-3" id="gallery">
        <div class="container">
            <div class="row">
                <div class="col-lg-8" data-aos="zoom-in">
                    <transition name="slide-fade" mode="out-in">
                        <img
                            :src="photos[activePhoto].url"
                            :key="photos[activePhoto].id"
                            class="w-100 main-image"
                            alt=""
                        />
                    </transition>
                </div>
                <div class="col-lg-2">
                    <div class="row">
                        <div
                            class="col-3 col-lg-12 mt-lg-0"
                            v-for="(photo, index) in photos"
                            :key="photo.id"
                            data-aos="zoom-in"
                            data-aos-delay="100"
                        >
                            <a href="#" @click="changeActive(index)">
                                <img
                                    :src="photo.url"
                                    class="w-100 thumbnail-image"
                                    :class="{ active : index == activePhoto }"
                                    alt=""
                                />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="store-details-container" data-aos="fade-up">
        <section class="store-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <h1>{{ $product->name }}</h1>
                        <div class="price mt-3">
                            Rp. {{ number_format($product->price) }}
                        </div>
                    </div>
                    <div class="col-lg-2" data-aos="zoom-in">
                        @auth
                        <form
                            action="{{ route('detail-add', $product->id) }}"
                            method="POST"
                            enctype="multipart/form-data"
                        >
                        @csrf
                         <div class="mb-5">
                            <div class="input-group mb-3" style="max-width: 120px;">
                                <div class="input-group-prepend">
                                <button class="btn btn-outline-primary js-btn-minus"
                                type="button">&minus;</button>
                                </div>
                                <input type="text" name="qty" id="qty" class="form-control text-center"
                                value="1" placeholder="" aria-label="Example text with button addon"
                                aria-describedby="button-addon1">
                                <div class="input-group-append">
                                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                                </div>
                            </div>
                        </div>
                            <button
                                type="submit"
                                class="btn btn-success px-4 text-white btn-block mb-3"
                            >
                                Add to Cart
                            </button>
                        </form>

                        @else
                        <a
                            href="{{ route('login') }}"
                            class="btn btn-success px-4 text-white btn-block mb-3"
                            >Sign in to Add</a
                        >
                        @endauth
                    </div>
                </div>
            </div>
        </section>
        <section class="store-dresciption">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        {!! $product->descriptions !!}
                    </div>
                </div>
            </div>
        </section>
        <section class="store-review">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 mt-3 mb-3">
                        <h5>Customer Review</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-8">
                        @auth
                        <div class="btn-group">
                            <button class="btn btn-light mb-3" id="btn-comment" ><i class="lnr lnr-bubble"></i>Komentar</button>
                        </div>
                        <form action="{{ route('commentar') }}"  style="display:none;" id="comment" method="POST">
                        @csrf
                        <input type="hidden" name="products_id" value="{{ $product->id }}">
                        <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                        <textarea name="konten"  class="form-control" id="comment" rows="4"></textarea>
                        <input type="submit" class="btn btn-primary mb-5" value="kirim">
                        </form>
                        @endauth
                        <ul class="list-unstyled">
                             @if (count($comment) > 0)

                            @foreach ($comment as $item)
                            <li class="media">
                                <img
                                    src="{{$item->user->getAvatar()}}"
                                    alt=""
                                    class="mr-3 rounded-circle"
                                    style="width: 35px; border-radius: 50%; height: 35px; overflow: hidden; background-repeat: no-repeat;
                                    background-position: 50%; background-size: cover;"
                                />
                                <div class="media-body">
                                    <h5 class="mt-2 mb-1">{{$item->user->name}}</h5>
                                   {{$item->konten}} <br><span style="font-size: x-small">{{$item->created_at->diffforHumans()}}</span><hr>
                                </div>
                            </li>
                             @endforeach
                        </ul>
                        {{ $comment->links() }}
                         @else
                        <ul class="list-unstyled">
                            <li class="media">
                                <span class="text-danger">  Belum Ada Komentar, Silahkan untuk Meriview Produk Kami </span>

                            </li>
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection @push('addon-script')
<script>
    $(document).ready(function(){
        $('#btn-comment').click(function(){
            $('#comment').toggle('slide');
        })
    });
</script>


<script src="/vendor/vue/vue.js"></script>
<script>
    var gallery = new Vue({
        el: "#gallery",
        mounted() {
        AOS.init();
        },
        data: {
        activePhoto: 0,
        photos: [
           @foreach ($product->galleries as $gallery)
                {
            id: {{ $gallery->id }},
            url: "{{ Storage::url($gallery->photos) }}",
            },
           @endforeach
        ],
        },
        methods: {
        changeActive(id) {
            this.activePhoto = id;
        },
        },
    });
</script>
@endpush
