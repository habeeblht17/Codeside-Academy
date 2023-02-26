{{-- @extends('layouts.instructor')

@section('breadcrumb')
    <div class="page-banner-content text-center">
        <h3 class="page-banner-heading text-white pb-15"> {{__('My Cards')}} </h3>

        <!-- Breadcrumb Start-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item font-14"><a href="{{route('instructor.dashboard')}}">{{__('Dashboard')}}</a></li>
                <li class="breadcrumb-item font-14 active" aria-current="page">{{__('My Cards')}}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="instructor-profile-right-part">
        <div class="instructor-my-cards-box instructor-payment-settings-page bg-white">
            <div class="row">
                <div class="col-12">
                    <div class="instructor-my-courses-title d-flex justify-content-between align-items-center">
                        <h6>{{ __('Add Account For Withdraw') }}</h6>
                    </div>
                </div>

                <!-- instructor my-cards form item start -->
                <div class="col-12 col-sm-12 col-lg-6">
                    <div class="payment-settings-box">

                        <div class="add-payment-settings-title d-flex align-items-center justify-content-between">
                            <p class="font-medium color-heading">{{ __('Add card') }}</p>
                            <div class="add-card-img"><img src="{{asset('frontend/assets/img/instructor-img/add-visa-master-card.png')}}" alt="Paypal" class="img-fluid"></div>

                        </div>
                        <form method="POST" action="{{route('instructor.save.my-card')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-30">
                                    <label class="font-medium font-15 color-heading">{{ __('Card number') }}</label>
                                    <input type="text" name="card_number" value="{{auth::user()->card ? auth::user()->card->card_number : ''}}" class="form-control" placeholder="1245   2154   2154 215">
                                    @if ($errors->has('card_number'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('card_number') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-30">
                                    <label class="font-medium font-15 color-heading">{{ __('Card Holder Name') }}</label>
                                    <input type="text" class="form-control" name="card_holder_name" value="{{auth::user()->card ? auth::user()->card->card_holder_name : ''}}" placeholder="Your name">
                                    @if ($errors->has('card_holder_name'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('card_holder_name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-30">
                                    <label class="font-medium font-15 color-heading">{{ __('Month') }}</label>
                                    <select name="month" class="form-select">
                                        <option value="">{{ __('Select Month') }}</option>
                                        <option value="1" @if(auth::user()->card && auth::user()->card->month == 1) selected @endif >{{ __('January') }}</option>
                                        <option value="2" @if(auth::user()->card && auth::user()->card->month == 2) selected @endif >{{ __('February') }}</option>
                                        <option value="3" @if(auth::user()->card && auth::user()->card->month == 3) selected @endif >{{ __('March') }}</option>
                                        <option value="4" @if(auth::user()->card && auth::user()->card->month == 4) selected @endif >{{ __('April') }}</option>
                                        <option value="5" @if(auth::user()->card && auth::user()->card->month == 5) selected @endif >{{ __('May') }}</option>
                                        <option value="6" @if(auth::user()->card && auth::user()->card->month == 6) selected @endif >{{ __('June') }}</option>
                                        <option value="7" @if(auth::user()->card && auth::user()->card->month == 7) selected @endif >{{ __('July') }}</option>
                                        <option value="8" @if(auth::user()->card && auth::user()->card->month == 8) selected @endif >{{ __('August') }}</option>
                                        <option value="9" @if(auth::user()->card && auth::user()->card->month == 9) selected @endif >{{ __('September') }}</option>
                                        <option value="10" @if(auth::user()->card && auth::user()->card->month == 10) selected @endif >{{ __('October') }}</option>
                                        <option value="11" @if(auth::user()->card && auth::user()->card->month == 11) selected @endif >{{ __('November') }}</option>
                                        <option value="12" @if(auth::user()->card && auth::user()->card->month == 12) selected @endif >{{ __('December') }}</option>
                                    </select>
                                    @if ($errors->has('month'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('month') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-30">
                                    <label class="font-medium font-15 color-heading">{{ __('Year') }}</label>
                                    <select name="year" class="form-select">
                                        <option value="">{{ __('Select Year') }}</option>
                                        @for($year = \Carbon\Carbon::now()->format('Y'); $year < \Carbon\Carbon::now()->addYear(20)->format('Y'); $year++)
                                            <option value="{{$year}}" @if(auth::user()->card && auth::user()->card->year == $year) selected @endif >{{$year}}</option>
                                        @endfor
                                    </select>
                                    @if ($errors->has('year'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('year') }}</span>
                                    @endif
                                </div>

                            </div>

                            <div class="col-12">
                                <button type="submit" class="theme-btn theme-button1 theme-button3 font-15 fw-bold w-100">{{ __('Save Card') }}</button>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- instructor my-cards form item end -->

                <!-- instructor my-cards form item start -->
                <div class="col-12 col-sm-12 col-lg-6">
                    <div class="payment-settings-box add-paypal-payment-box">

                        <div class="add-payment-settings-title d-flex align-items-center justify-content-between">
                            <p class="font-medium color-heading">{{ __('Add card') }}</p>
                            <div class="add-card-img"><img src="{{asset('frontend/assets/img/instructor-img/add-paypal.png')}}" alt="Paypal" class="img-fluid"></div>

                        </div>
                        <form method="POST" action="{{route('instructor.save.paypal')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-30">
                                    <label class="font-medium font-15 color-heading">{{ __('Paypal Email') }}</label>
                                    <input type="email" class="form-control" name="email" value="{{auth::user()->paypal ? auth::user()->paypal->email : ''}}" placeholder="EX. example@email.com">
                                    @if ($errors->has('email'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="theme-btn theme-button1 theme-button3 font-15 fw-bold w-100">{{ __('Save Paypal') }}</button>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- instructor my-cards form item end -->

            </div>
        </div>
    </div>
@endsection --}}

@php
    function getAllBanks()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/bank?currency=NGN",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ". env('PAYSTACK_SECRET_KEY'),
                "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;

    }

    $all_banks = getAllBanks();
    $decode_all_banks_data = json_decode($all_banks);
@endphp

@extends('layouts.instructor')

@section('breadcrumb')
    <div class="page-banner-content text-center">
        <h3 class="page-banner-heading text-white pb-15"> {{__('My Cards')}} </h3>

        <!-- Breadcrumb Start-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item font-14"><a href="{{route('instructor.dashboard')}}">{{__('Dashboard')}}</a></li>
                <li class="breadcrumb-item font-14 active" aria-current="page">{{__('My Cards')}}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="instructor-profile-right-part">
        <div class="instructor-my-cards-box instructor-payment-settings-page bg-white">
            <div class="row">
                <div class="col-12">
                    <div class="instructor-my-courses-title d-flex justify-content-between align-items-center">
                        <h6>{{ __('Add Account For Withdraw') }}</h6>
                    </div>
                </div>

                <!-- instructor my-cards form item start -->
                <div class="col-12 col-sm-12 col-lg-6">
                    <div class="payment-settings-box">

                        <div class="add-payment-settings-title d-flex align-items-center justify-content-between">
                            <p class="font-medium color-heading">{{ __('Add Account') }}</p>
                            <div class="add-card-img"><img src="{{asset('frontend/assets/img/instructor-img/add-visa-master-card.png')}}" alt="Paypal" class="img-fluid"></div>

                        </div>
                        <form method="POST" action=" {{ route('instructor.my-account') }} ">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-30">
                                    <label class="font-medium font-15 color-heading">{{ __('Account number') }}</label>
                                    <input type="text" name="account_number" value="{{auth::user()->account ? auth::user()->account->account_number : ''}}" class="form-control" placeholder="012456789">
                                    @if ($errors->has('account_number'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('account_number') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="col-md-12 mb-30">
                                    <label class="font-medium font-15 color-heading">{{ __('Account Name') }}</label>
                                    <input type="text" class="form-control" name="account_name" value="{{auth::user()->account ? auth::user()->account->account_name : ''}}" placeholder="Your name">
                                    @if ($errors->has('account_name'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('account_name') }}</span>
                                    @endif
                                </div>
                            </div> --}}
                            
                            <div class="row">
                                <div class="col-md-12 mb-30">
                                    <label class="font-medium font-15 color-heading">{{ __('Bank Name') }}</label>
                                    <select name="bank_code" class="form-control" id="">
                                        <option name="bank_code[]" value="">-- Select Recipient's bank --</option>
                                        @if ($decode_all_banks_data && $decode_all_banks_data->data && is_array($decode_all_banks_data->data))
                                            @foreach ($decode_all_banks_data->data as $key => $bank)
                                                <option name="bank_code[]" value="{{ $bank->code }}"> {{ $bank->name }} </option>
                                            @endforeach
                                        @endif
                                    </select>

                                    @if ($errors->has('bank_code'))
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('account_name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="theme-btn theme-button1 theme-button3 font-15 fw-bold w-100">{{ __('Save Account') }}</button>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- instructor my-cards form item end -->

                <!-- instructor my-cards form item start -->
                <div class="col-12 col-sm-12 col-lg-6">
                    <div class="payment-settings-box add-paypal-payment-box">

                        <div class="add-payment-settings-title d-flex align-items-center justify-content-between">
                            <p class="font-medium color-heading">{{ __('My Account Information') }}</p>
                            {{-- <div class="add-card-img"><img src="{{asset('frontend/assets/img/instructor-img/add-paypal.png')}}" alt="Paypal" class="img-fluid"></div> --}}

                        </div>
                        <div class="my-4 mx-3">

                            @foreach ($instructorAccounts as $instructorAcct)
                                <div class="row">
                                    <div class="col-md-12 mb-10">
                                        <label class="font-medium font-15 color-heading">{{ __('Account Name') }}</label>
                                        <br>
                                        <label for="" class="border rounded p-3 w-100">{{ $instructorAcct->account_name }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-10">
                                        <label class="font-medium font-15 color-heading">{{ __('Account Number') }}</label>
                                        <br>
                                        <label for="" class="border rounded p-3 w-100">{{ $instructorAcct->account_number }}</label>
                                    </div>
                                </div>
                                <hr class="w-80">
                            @endforeach

                        </div>
                    </div>
                </div>
                <!-- instructor my-cards form item end -->

            </div>
        </div>
    </div>

@endsection


