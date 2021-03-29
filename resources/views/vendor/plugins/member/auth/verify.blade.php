@extends('plugins/member::layouts.skeleton')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ trans('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{-- {{ trans('A fresh verification link has been sent to your email address.') }} --}}
                            Một liên kết xác minh mới đã được gửi đến địa chỉ email của bạn.
                        </div>
                    @endif

                    {{-- {{ trans('Before proceeding, please check your email for a verification link.') }} --}}
                    Trước khi tiếp tục, vui lòng kiểm tra email của bạn để biết liên kết xác minh.
                    {{-- {{ trans('If you did not receive the email') }}                                {{ trans('click here to request another') }} --}}
                    Nếu bạn không nhận được email, <a href="{{ route('public.member.resend_confirmation') }}">bấm vào đây để yêu cầu khác</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
