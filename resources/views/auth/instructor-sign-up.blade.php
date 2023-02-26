@extends('layouts.auth')

@push('script')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@section('content')
    <!-- Sing Up Area Start -->
    <section class="sign-up-page p-0">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-5">
                    <div class="sign-up-left-content">
                        <div class="sign-up-top-logo">
                            <a href="{{ route('main.index') }}"><img src="{{getImageFile(get_option('app_logo'))}}" alt="logo"></a>
                        </div>
                        <p>{{ __(get_option('sign_up_left_text')) }}</p>
                        @if(get_option('sign_up_left_image'))
                        <div class="sign-up-bottom-img">
                            <img src="{{getImageFile(get_option('sign_up_left_image'))}}" alt="hero" class="img-fluid">
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="">
                        <div class="sign-up-right-content bg-white">
                            <form class="contact-form" method="POST" action="{{route('store.instructor.sign-up')}}" novalidate enctype="multipart/form-data">
                                @csrf

                                <div class="">
                                    <div class="">
                                        <h1 class="mb-1 mt-4 text-lg">{{__('Become an Instructor')}}</h1>
                                        <p class="font-14 mb-30">{{__('Already have an account?')}} <a href="{{route('login')}}" class="color-hover text-decoration-underline font-medium">{{__('Sign In')}}</a></p>
                                    </div>
                                </div>
                                <!-- start step indicators -->
                                <div class="nav nav-fill my-3">
                                    <label class="nav-link shadow-sm step0 border round-lg ml-2">1</label>
                                    <label class="nav-link shadow-sm step1 border round-lg ml-2">2</label>
                                    <label class="nav-link shadow-sm step2 border round-lg ml-2">3</label>
                                </div>
                                <!-- end step indicators -->

                                <!-- section one -->
                                <div class="form-section">
                                    <div class="row mb-30">
                                        <div class="col-md-12">
                                            <label class="label-text-title color-heading font-medium font-16 mb-3" for="email">{{__('Email')}}</label>
                                            <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control" placeholder="Type your email" required>

                                            @if ($errors->has('email'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-30">
                                        <div class="col-md-6">
                                            <label class="label-text-title color-heading font-medium font-16 mb-3" for="first_name">{{__('First Name')}}</label>
                                            <input type="text" name="first_name" id="first_name" value="{{old('first_name')}}" class="form-control" placeholder="{{__('First Name')}}" required>

                                            @if ($errors->has('first_name'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('first_name') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label class="label-text-title color-heading font-medium font-16 mb-3" for="last_name">{{__('Last Name')}}</label>
                                            <input type="text" name="last_name" id="last_name" value="{{old('last_name')}}" class="form-control" placeholder="{{__('Last Name')}}" required>

                                            @if ($errors->has('last_name'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('last_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-30">
                                        <div class="col-md-12">
                                            <label class="label-text-title color-heading font-medium font-16 mb-3" for="password">{{__('Password')}}</label>

                                            <div class="form-group mb-0 position-relative">
                                                <input type="password" name="password" id="password" value="{{old('password')}}" class="form-control password" placeholder="*********" required>
                                                <span class="toggle cursor fas fa-eye pass-icon"></span>
                                            </div>

                                            @if ($errors->has('password'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('password') }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="row mb-30">
                                        <div class="col-md-12">
                                            <div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                                    <label class="form-check-label mb-0" for="flexCheckChecked">
                                                        By clicking Create account, I agree that I have read and accepted the <a href="{{ route('terms-conditions') }}" class="color-hover text-decoration-underline">Terms of Use</a> and <a href="{{ route('privacy-policy') }}" class="color-hover text-decoration-underline">Privacy Policy.</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- section two -->
                                <div class="form-section">
                                    <div class="row mb-30">
                                        <div class="col-md-12">
                                            <label for="professional_title" class="label-text-title color-heading font-medium font-16 mb-2">{{__('Professional Title')}}</label>
                                            <input type="text" name="professional_title" class="form-control" id="professional_title" placeholder="{{__('Professional Title')}}" value="{{ old('professional_title') }}" required>

                                            @if ($errors->has('professional_title'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('professional_title') }}</span>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="row mb-30">
                                        <div class="col-md-12">
                                            <label class="label-text-title color-heading font-medium font-16 mb-2">{{__('Phone Number')}}</label>
                                            <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="{{__('Phone Number')}}" value="{{ old('phone_number') }}" required>
                                        </div>

                                        @if ($errors->has('phone_number'))
                                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('phone_number') }}</span>
                                        @endif
                                    </div>

                                    <div class="row mb-30">
                                        <div class="col-md-12">
                                            <label class="label-text-title color-heading font-medium font-16 mb-2">{{__('Address')}}</label>
                                            <input type="text" name="address" class="form-control" id="address" placeholder="{{__('Address')}}" value="{{ old('address')}}" required>
                                        </div>

                                        @if ($errors->has('address'))
                                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- section three -->
                                <div class="form-section">
                                    <div class="row mb-30">
                                        <div class="col-md-12">
                                            <label class="label-text-title color-heading font-medium font-16 mb-2">CV</label>
                                            <div class="create-assignment-upload-files">
                                                <input type="file" name="cv_file" accept="application/pdf"  class="form-control" />
                                                <p class="font-14 color-heading text-center mt-2 color-gray">No file selected (PDF) <span class="d-block">Maximum Image Upload Size is <span class="color-heading">5mb</span></span> </p>
                                            </div>

                                            @if ($errors->has('cv_file'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('cv_file') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row mb-30">
                                        <div class="col-md-12">
                                            <label class="label-text-title color-heading font-medium font-16 mb-2">{{__('Bio')}}</label>
                                            <textarea name="about_me" class="form-control" cols="30" rows="10" placeholder="About yourself" required>{{ old('about_me') }}</textarea>

                                            @if ($errors->has('about_me'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('about_me') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                </div>

                                <div class="form-navigation d-flex justify-content-between">
                                    <button type="button" class="previous theme-btn theme-button3 show-last-phase-back-btn font-15 fw-bold float-left">Previous</button>
                                    <button type="button" class="nextt theme-btn theme-button3 show-last-phase-back-btn font-15 fw-bold float-right">Next</button>
                                    <button type="submit" class="theme-btn theme-button1 theme-button3 font-15 fw-bold float-right">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Sing Up Area End -->
@endsection

@push('script')
<script type="text/javascript">
    $(function () {
      var $sections = $('.form-section');

      function navigateTo(index) {
        // Mark the current section with the class 'current'
        $sections
          .removeClass('current')
          .eq(index)
            .addClass('current');
        // Show only the navigation buttons that make sense for the current section:
        $('.form-navigation .previous').toggle(index > 0);
        var atTheEnd = index >= $sections.length - 1;
        $('.form-navigation .nextt').toggle(!atTheEnd);
        $('.form-navigation [type=submit]').toggle(atTheEnd);

        const step = document.querySelector('.step'+index);
        step.style.backgroundColor ="#3d4682";
        step.style.color="#fff"
      }

      function curIndex() {
        // Return the current index by looking at which section has the class 'current'
        return $sections.index($sections.filter('.current'));
      }

      // Previous button is easy, just go back
      $('.form-navigation .previous').click(function() {
        navigateTo(curIndex() - 1);
      });

      // Next button goes forward iff current block validates
      $('.form-navigation .nextt').click(function() {
        $('.contact-form').parsley().whenValidate({
          group: 'block-' + curIndex()
        }).done(function() {
          navigateTo(curIndex() + 1);
        });
      });

      // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
      $sections.each(function(index, section) {
        $(section).find(':input').attr('data-parsley-group', 'block-' + index);
      });
      navigateTo(0); // Start at the beginning
    });
</script>
@endpush
