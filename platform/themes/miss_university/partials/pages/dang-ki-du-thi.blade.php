@php
    function getVal($item, $attr) {
        return (isset($item[$attr])) ? $item[$attr] : '';
    }
    $item = new Theme\Missuniversity\Repositories\ThisinhRepo();
    $item = $item->getMemberRegisterProcessing();
    $item_date = getVal($item, 'ngay_sinh');
    if($item_date!='') {
        $item_date = explode('-',getVal($item, 'ngay_sinh'));
        $item['date'] = $item_date[2];
        $item['month'] = $item_date[1];
        $item['year'] = $item_date[0];
    } else {
        $item['date'] = $item['mont'] = $item['year'] = '';
    }
    $hinhTmp = Theme::asset()->url('dist/images/exam-register/img_upload.png');
    $imgAvatar = getVal($item, 'avatar');
    $imgAvatar = ($imgAvatar=='')?$hinhTmp:'storage/'.$imgAvatar;
    $imgAvatar1 = getVal($item, 'avatar_toan_than_1');
    $imgAvatar1 = ($imgAvatar1=='')?$hinhTmp:'storage/'.$imgAvatar1;
    $imgAvatar2 = getVal($item, 'avatar_toan_than_2');
    $imgAvatar2 = ($imgAvatar2=='')?$hinhTmp:'storage/'.$imgAvatar2;
    $hinhTmp = asset('themes/miss_university/images/exam-register/add_img_btn.png');
    $anh1 = getVal($item, 'anh_1');
    $anh1 = ($anh1=='')?$hinhTmp:'storage/'.$anh1;
    $anh2 = getVal($item, 'anh_2');
    $anh2 = ($anh2=='')?$hinhTmp:'storage/'.$anh2;
    $anh3 = getVal($item, 'anh_3');
    $anh3 = ($anh3=='')?$hinhTmp:'storage/'.$anh3;
    $anh4 = getVal($item, 'anh_4');
    $anh4 = ($anh4=='')?$hinhTmp:'storage/'.$anh4;
    $anh5 = getVal($item, 'anh_5');
    $anh5 = ($anh5=='')?$hinhTmp:'storage/'.$anh5;
    $ban_scan = getVal($item, 'ban_scan');
    if($ban_scan!=''){
        $ban_scan = explode('/',$ban_scan);
        $ban_scan = $ban_scan[1];
    } else {
        $ban_scan = 'Bản scan Giấy chứng nhận giải thưởng Top 5 MU năm ngoái';
    }
@endphp
{{-- <section class="header-banner">
    <img src="{{Theme::asset()->url('dist/images/elimination/banner.png')}}" alt="" class="img-fluid">
</section> --}}
<div class="container">
    <div class="exam-register">
        <div class="heading">
            <img src="{{Theme::asset()->url('dist/images/missuni_logo_full.png')}}" style="width: 220px" class="logo" alt="">
        </div>
        <div class="body">
            <h1 class="title text-center">Đăng ký tham dự</h1>
            <div class="exam-register-form">
                <div class="be_errors text-danger"></div>
                 <form class="d-flex overflow-x-hidden" id="form_dang_ki" action="{{ route('thisinh.register') }}" method="POST" enctype="multipart/form-​data">
                    <!-- Form 1 -->
                    <input type="hidden" name="id_ts"  value="{{ getVal($item, 'id') }}" />
                    <div id="form-1" class="container active">
                        <div class="row form-row">
                            <div class="col-lg-4 form-group">
                                <input type="text" class="form-control" placeholder="Họ" name="ho" value="{{ getVal($item, 'ho') }}" >
                                <span class="error_ho text-danger text-error"></span>
                            </div>
                            <div class="col-lg-5 form-group">
                                <input type="text" class="form-control" placeholder="Tên" name="ten" value="{{ getVal($item, 'ten') }}">
                                <span class="error_ten text-danger text-error"></span>
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="form-group col-lg-3 col-4">
                                <div class="custom-selected">
                                    <div class="select-selected">
                                        <select class="form-control select-selected" name="date">
                                            <option disabled selected>Ngày sinh</option>
                                            @for($i = 1 ; $i <= 31; $i++)
                                                @if($i==getVal($item, 'date'))
                                                    <option selected="selected">{{ $i }}</option>
                                                @else
                                                    <option>{{ $i }}</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-lg-3 col-4">
                                <div class="custom-selected">
                                    <div class="select-selected">
                                        <select class="form-control select-selected" name="month">
                                            <option disabled selected>Tháng</option>
                                            @for($i = 1 ; $i <= 12; $i++)
                                                @if($i==getVal($item, 'month'))
                                                    <option selected="selected">{{ $i }}</option>
                                                @else
                                                    <option>{{ $i }}</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-lg-3 col-4">
                                <div class="custom-selected">
                                    <div class="select-selected">
                                        <select class="form-control select-selected" name="year">
                                            <option disabled selected>Năm</option>
                                            @for($i = 1990 ; $i <= 2005; $i++)
                                                @if($i==getVal($item, 'year'))
                                                    <option selected="selected">{{ $i }}</option>
                                                @else
                                                    <option>{{ $i }}</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <span class="error_ngay_sinh text-danger text-error"></span>
                        </div>
                        <div class="row form-row">
                            <div class="col-lg-12 form-group">
                                <input type="text" class="form-control" placeholder="Địa chỉ liên lạc" name="dia_chi"  value="{{ getVal($item, 'dia_chi') }}">
                                <span class="error_dia_chi text-danger text-error"></span>
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col-lg-12 form-group">
                                <input type="text" class="form-control" placeholder="Số điện thoại" name="sdt"  value="{{ getVal($item, 'sdt') }}">
                                <span class="error_sdt text-danger text-error"></span>
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col-lg-12 form-group">
                                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ getVal($item, 'email') }}">
                                <span class="error_email text-danger text-error"></span>
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col-lg-12 form-group">
                                <input type="phone" class="form-control" placeholder="Sđt người thân (trong trường hợp khẩn)" name="sdt_nguoi_than" value="{{ getVal($item, 'sdt_nguoi_than') }}">
                                <span class="error_sdt_nguoi_than text-danger text-error"></span>
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="form-group col-lg-12">
                                <div class="select-selected">
                                    <select class="form-control select-selected" name="id_truong">
                                        <option value="" >--- Trường Đại Học ---</option>
                                        <?php echo \Theme\Missuniversity\Repositories\ThisinhRepo::optionTruong(getVal($item, 'id_truong')); ?>
                                    </select>
                                    <span class="error_id_truong text-danger text-error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col-lg-3 form-group">
                                <div class="select-selected">
                                    <select class="form-control select-selected" name="id_nam_hoc">
                                        <option value="" >--- Năm học ---</option>
                                        <?php echo \Theme\Missuniversity\Repositories\ThisinhRepo::optionNamhoc(getVal($item, 'id_nam_hoc')); ?>
                                    </select>
                                    <span class="error_id_nam_hoc text-danger text-error"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 form-group">
                                <input type="text" class="form-control" placeholder="MSSV" name="mssv" value="{{ getVal($item, 'mssv') }}">
                                <span class="error_mssv text-danger text-error"></span>
                            </div>
                            <div class="col-lg-5 form-group">
                                <input type="text" class="form-control" placeholder="Thuộc khoa/ngành" name="khoa_nganh" value="{{ getVal($item, 'khoa_nganh') }}">
                                <span class="error_khoa_nganh text-danger text-error"></span>
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col-lg-3 col-4 form-group">
                                <input name="chieu_cao" type="text" class="form-control" placeholder="Chiều cao" value="{{ getVal($item, 'chieu_cao') }}">
                                <span class="error_chieu_cao text-danger text-error"></span>
                            </div>
                            <div class="col-lg-4 col-4 form-group">
                                <input name="can_nang" type="text" class="form-control" placeholder="Cân nặng" value="{{ getVal($item, 'can_nang') }}">
                                <span class="error_can_nang text-danger  text-error"></span>
                            </div>
                            <div class="col-lg-5 col-4 form-group">
                                <input name="so_do_ba_vong" type="text" class="form-control" placeholder="Số đo 3 vòng" value="{{ getVal($item, 'so_do_ba_vong') }}">
                                <span class="error_so_do_ba_vong text-danger text-error"></span>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn-submit dang_ki" id="step-1-next" type="button">Bước 2</button>
                        </div>
                    </div>
                    <!-- form 2 -->
                    <div id="form-2" class="container">
                        <div class="row form-row">
                            <div class="col form-group">
                                <label class="sr-only" for="selfDesc">selfDesc</label>
                                <textarea class="form-control mo_ta_ly_lich" id="selfDesc" rows="5"
                                          placeholder="Mô tả sơ lược về bản thân" name="mo_ta_ly_lich">{{ clean(getVal($item, 'mo_ta_ly_lich')) }}</textarea>
                                <span class="error_mo_ta_ly_lich text-danger text-error"></span>
                            </div>
                        </div>
                        <!-- picture group -->
                        <div class="row form-row">
                            <div class="col form-group d-lg-flex">
                                <!-- Portrait -->
                                <div class="image-input-group">
                                    <label for="portrait">*Ảnh chân dung</label><br/>
                                    <img class="avatar must_up" id="portraitImg"
                                         src="{{ $imgAvatar }}"
                                         alt="your image" width="150" height="150"
                                         onclick="chooseImage('avatar')" />
                                </div>
                                <!-- Picture body -->
                                <div class="image-input-group mt-3 mt-lg-0">
                                    <label for="portrait">*Ảnh toàn thân(nên chọn ảnh ngang)</label>
                                    <div class="d-flex">
                                        <div>
                                            <img class="avatar-toan-than-1 must_up" id="bodyImg1"
                                                 src="{{ $imgAvatar1 }}"
                                                 alt="your image" width="150" height="150"
                                                 onclick="chooseImage('avatar-toan-than-1')" />
                                        </div>
                                        <div class="ml-1 ml-sm-5 ml-lg-2">
                                            <img class="avatar-toan-than-2 must_up" id="bodyImg2"
                                                 src="{{ $imgAvatar2 }}"
                                                 alt="your image" width="150" height="150"
                                                 onclick="chooseImage('avatar-toan-than-2')" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="error_upload_image text-danger">

                            </div>
                        </div>
                        <!-- picture list -->
                        <div class="row form-row">
                            <div class="col form-group">
                                <label for="mulImg">Thêm ảnh đẹp khác</label>
                                <div class="d-flex">
                                    <div>
                                        <img class="mr-4 anh-1"
                                             src="{{ $anh1 }}"
                                             alt="your image" width="100" height="100"
                                             onclick="chooseImage('anh-1')" />
                                    </div>
                                    <div>
                                        <img class="mr-4 anh-2"
                                             src="{{ $anh2 }}"
                                             alt="your image" width="100" height="100"
                                             onclick="chooseImage('anh-2')" />
                                    </div>
                                    <div>
                                        <img class="mr-4 anh-3"
                                             src="{{ $anh3 }}"
                                             alt="your image" width="100" height="100"
                                             onclick="chooseImage('anh-3')" />
                                    </div>
                                    <div>
                                        <img class="mr-4 anh-4"
                                             src="{{ $anh4 }}"
                                             alt="your image" width="100" height="100"
                                             onclick="chooseImage('anh-4')" />
                                    </div>
                                    <div>
                                        <img class="mr-4 anh-5"
                                             src="{{ $anh5 }}"
                                             alt="your image" width="100" height="100"
                                             onclick="chooseImage('anh-5')" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col form-group">
                                <div class="input-group form-control mb-3 justify-content-between align-items-center position-relative">
                                    <div class="input-group-prepend ban-scan" id="fileText"> {{ $ban_scan }} </div>
                                    <button class="btn btn-upload" onclick="chooseImage('ban-scan')" type="button" id="fileBtn">Tải lên </button>
                                </div>
                                <small>*đối với các thi sinh đặc cách vào vòng Bán kết trường</small>
                            </div>
                        </div>
                        <div class="row form-row">
                            <div class="col form-group">
                                <div>
                                <input class="video form-control" name="video" type="text" aria-label="Link Youtube clip" name="linkClip"
                                       placeholder="*Link youtube clip tự giới thiệu bản thân" value="{{ getVal($item, 'video') }}" />
                                       <small>*VD: https://www.youtube.com/watch?v=tHEhbWa4-qQ</small>
                                </div>
                                <span class="error_video text-danger text-error"></span>
                            </div>
                        </div>

                        <!-- Term -->
                        <div class="row form-row">
                            <div class="col term">
                                Bằng cách đăng ký, bạn đồng ý với <a href="/the-le">Điều khoản, thể lệ</a> và <a href="/the-le">Chính sách bảo mật của Miss University 2021</a>
                            </div>
                        </div>
                        <!-- Button group -->
                        <div class="form-group d-sm-flex justify-content-center text-center">
                            <button class="btn-submit btn-back mr-sm-3" id="step-1-back" type="button">&nbsp;</button>
                            <button class="btn-submit finish">Hoàn thành</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<form style="display:none" name="form_upload" id="form_upload" class="form_product_image d-none" enctype="multipart/form-data" method="POST"
    onsubmit="return ajaxUploadFile.submit(this, {'onComplete': function () { ajaxUploadFile.resetUpload('.form_product_image', afterUploadedProductImage) }})" >
    {{ csrf_field() }}
    <input type="hidden" name="id" value="0" />
    <input type="file" multiple="multiple" class="img" name="image[]" onchange="onChangeImage(this)" />
</form>


@push('scripts')
<script>
    var img_dest = '';
    function chooseImage(name) {
        $('#form_upload input[type="file"]').attr('name', name)
        $('#form_upload').attr('action', 'thisinh/upload/candidates/'+name)
        $('#form_upload input[type="file"]').trigger('click')
        img_dest = name
    }

    function onChangeImage(input) {
        jQuery(input).parents('form').submit()
        showLoading()
    }

    var afterUploadedProductImage = function(form, result){
        if(img_dest=='ban-scan') {
            var value = $('#form_upload input[type=file]').val().replace(/.*(\/|\\)/, '')
            $('.ban-scan').html(value)
            setTimeout( hideLoading, 2000)
            return
        }
        $('.'+img_dest).attr('src', "storage/"+result.path)
        setTimeout( hideLoading, 2000)
    }

    function checkUPloadImage() {
        var error = false
        $( ".must_up" ).each(function( index ) {
            var value = $(this).attr('src').replace(/.*(\/|\\)/, '')
            if(value=='img_upload.png')
                error = true
        })
        return error
    }

    function matchYoutubeUrl(url){
        var valid = url.match(/youtube\.com/)
        var video = (valid==null) ? false : true
        var valid = url.match(/youtu\.be/)
        var videolist = (valid==null) ? false : true
        return (video==true || videolist==true) ? true : false
    }

    $(document).ready(function(){
        $('.dang_ki').on('click', function(){
            var data = $('#form_dang_ki').serialize()
            var url = $('#form_dang_ki').attr('action')
            sendData(url, data, 'POST', function(response){
                if(response.success) {
                    $('#form_upload input[name="id"]').val(response.success)
                    $('#form_dang_ki input[name="id_ts"]').val(response.success)
                    $('#form-1').removeClass('active')
                    $('#form-2').addClass('active')
                    $('#form-1 .text-error').html('')
                }
            })
        })

        $('.finish').on('click', function(event ){
            event.preventDefault();
            var error = checkUPloadImage()
            var signImage = true
            var signVideo = true
            if(error==true){
                $('.error_upload_image').html('Trường hình phải được upload')
                signImage = false
            } else {
                $('.error_upload_image').html('')
                signImage = true
            }
            var video = $('.video').val()
            var isValid = matchYoutubeUrl(video)
            if(!isValid) {
                $('.error_video').html('Trường video chưa đúng')
                signVideo = false
            } else {
                $('.error_video').html('')
                signVideo = true
            }
            if(signVideo==false || signImage==false)
                return
            var data = {
                id : $('#form_upload input[name="id"]').val(),
                video : $('.video').val(),
                mo_ta_ly_lich : $('.mo_ta_ly_lich').val()
            }
            sendData('thisinh/update-info', data, 'POST', function(response){
                if(response.success) {
                    location.href = 'chi-tiet-thi-sinh?id='+data.id
                }
            })
        })

        $('#step-1-back').on('click', function(){
            $('#form-1').addClass('active')
            $('#form-2').removeClass('active')
        })

    })
</script>

@endpush
