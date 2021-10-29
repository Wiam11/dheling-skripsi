@extends('layouts.dashboard')

@section('title')
    Dashboard akun
@endsection

@section('content')
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
        <h2 class="dashboard-tittle">My Account</h2>
        <p class="dashboard-subtitle">update your current profile</p>
        </div>
        <div class="dashboard-content">
        <div class="row">
            <div class="col-12">
            <form action="{{ route('dashboard-settings-redirect', 'dashboard-settings-account') }}"
            method="POST" enctype="multipart/form-data" id="locations">
            @csrf
                <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="addressOne">Your Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            value="{{ $user->name }}"
                        />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="addressTwo">Email</label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            value="{{ $user->email }}"
                        />
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group">
                        <label for="addressTwo">Foto</label>
                        <input
                            type="file"
                            class="form-control"
                            id="avatar"
                            name="avatar"
                            value="{{ $user->avatar }}"
                        />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="address_one">Address 1</label>
                        <input
                            type="text"
                            class="form-control"
                            id="address_one"
                            name="address_one"
                            value="{{ $user->address_one }}"
                        />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="address_two">Address 2</label>
                        <input
                            type="text"
                            class="form-control"
                            id="address_two"
                            name="address_two"
                            value="{{ $user->address_two }}"
                        />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="province">Province</label>
                          <select name="provinces_id"  id="provinces_id"  class="form-control">
                            <option value="0">-- Pilih Provinsi --</option>
                            @foreach ($provinces as $province=> $value)
                              <option value="{{$province}}">{{ $value  }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="regencies_id">City</label>
                        <select name="regencies_id"  id="regencies_id"  class="form-control">
                        <option value="">-- Pilih Kota/Kabupaten --</option>
                          </select>
                        </div>
                      </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="zip_code">Postal Code</label>
                        <input
                            type="text"
                            class="form-control"
                            id="zip_code"
                            name="zip_code"
                            value="{{ $user->zip_code }}"
                        />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="country">Country</label>
                        <input
                            type="text"
                            class="form-control"
                            id="country"
                            name="country"
                            value="{{ $user->country }}"
                        />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="phone_number">Mobile</label>
                        <input
                            type="text"
                            class="form-control"
                            id="phone_number"
                            name="phone_number"
                            value="{{ $user->phone_number }}"
                        />
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col text-right">
                        <button
                        type="submit"
                        class="btn btn-success px-5"
                        >
                        Save Now
                        </button>
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
@endsection

 @push('addon-script')
<script src="/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/vue-toasted"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        //active select2
        $(".provinces_id, .regencies_id").select2({
            theme:'bootstrap4',width:'style',
        });
        //ajax select kota asal
        $('select[name="provinces_id"]').on('change', function () {
            let provindeId = $(this).val();
            if (provindeId) {
                jQuery.ajax({
                    url: '/cities/'+provindeId,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        $('select[name="regencies_id"]').empty();
                        $('select[name="regencies_id"]').append('<option value="">-- Pilih Kota/Kabupaten --</option>');
                        $.each(response, function (key, value) {
                            $('select[name="regencies_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                $('select[name="regencies_id"]').append('<option value="">-- Pilih Kota/Kabupaten --</option>');
            }
        });

    });
</script>

@endpush
