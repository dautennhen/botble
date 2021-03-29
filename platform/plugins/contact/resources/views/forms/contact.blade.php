{!! Form::open(['route' => 'public.send.contact', 'method' => 'POST', 'class' => 'contact-form']) !!}
<div class="container">
    <div class="exam-register">
        <div class="heading">
            <img src="{{Theme::asset()->url('dist/images/missuni_logo_full.png')}}" style="width: 220px" class="logo" alt="">
        </div>
        <div class="body">
            <h1 class="title text-center">Liên Hệ</h1>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="exam-register-form">
                <div class="contact-form-group"><p>Mọi thắc mắc liên quan đến cuộc thi, vui lòng liên hệ: </p></div>
                <div class="contact-form-group"><p>- Hotline 1900 63 69 80 </p></div>
                <div class="contact-form-group"><p>- Emai: missuniversity@nhg.vn  </p></div>
                <div class="contact-form-group"><p>- Để được trả lời nhanh nhất, vui lòng sử dụng biểu mẫu liên hệ bên dưới.  </p></div>
                    <!-- Form 1 -->
                    
                    <div id="form-1" class="container active">
                        <div class="row form-row">
                            <div class="col-lg-12 form-group">
                                <label for="contact_name" class="contact-label required">{{ __('Name') }}</label>
                                <input type="text" class="form-control contact-form-input" name="name" value="{{ old('name') }}" id="contact_name"
                                       placeholder="{{ __('Name') }}">
                                @error('name')
                                    <span class="error_name text-danger text-error"> {{ $errors->first('name') }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col-lg-12 form-group">
                                <label for="contact_email" class="contact-label required">Email</label>
                                <input type="email" class="form-control contact-form-input" name="email" value="{{ old('email') }}" id="contact_email"
                                       placeholder="{{ __('Email') }}">
                                @error('email')
                                    <span class="error_email text-danger text-error">{{ $errors->first('email') }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-row">
                            <div class="col-lg-12 form-group">
                                <label for="contact_address" class="contact-label">{{ __('Address') }}</label>
                                <input type="text" class="form-control contact-form-input" name="address" value="{{ old('address') }}" id="contact_address"
                                       placeholder="{{ __('Address') }}">
                            </div>
                        </div>

                        <div class="row form-row">
                            <div class="col-lg-12 form-group">
                                <label for="contact_phone" class="contact-label">{{ __('Phone') }}</label>
                                <input type="text" class="form-control contact-form-input" name="phone" value="{{ old('phone') }}" id="contact_phone"
                                       placeholder="{{ __('Phone') }}">
                            </div>
                        </div>

                        <div class="row form-row">
                            <div class="col-lg-12 form-group">
                                <label for="contact_subject" class="contact-label">{{ __('Subject') }}</label>
                                <input type="text" class="form-control contact-form-input" name="subject" value="{{ old('subject') }}" id="contact_subject"
                                       placeholder="{{ __('Subject') }}">
                            </div>
                        </div>

                        <div class="row form-row">
                            <div class="col-lg-12 form-group">
                                <label for="contact_content" class="contact-label required">{{ __('Message') }}</label>
                                <textarea name="content" id="contact_content" class="form-control contact-form-input" rows="5" placeholder="{{ __('Message') }}">{{ old('content') }}</textarea>
                                @error('content')
                                    <span class="error_name text-danger text-error">{{ $errors->first('content') }} </span>
                                @enderror
                            </div>
                        </div>

                        @if (setting('enable_captcha') && is_plugin_active('captcha'))
                        <div class="contact-form-row">
                            <div class="contact-column-12">
                                <div class="contact-form-group">
                                    {!! Captcha::display() !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="contact-form-group"><p>{!! clean(__('The field with (<span style="color:#FF0000;">*</span>) is required.')) !!}</p></div>

                    {{-- <div class="contact-form-group">
                        <button type="submit" class="contact-button">{{ __('Send') }}</button>
                    </div> --}}
                    <div class="contact-form-group profile__summary--button font-weight-bold text-center" styler>
                        {{-- <button class="contact-button" data-vote="">
                            <img src="{{Theme::asset()->url('dist/images/gui.png')}}" alt="">
                        </button> --}}

                        <button class="btn_vote dis-img">
                            <img class="img-dis" src="{{Theme::asset()->url('dist/images/gui.png')}}" alt="">
                        </button>
                    </div>

                    <div class="contact-form-group">
                        <div class="contact-message contact-success-message" style="display: none"></div>
                        <div class="contact-message contact-error-message" style="display: none"></div>
                    </div>

                    </div>

            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}