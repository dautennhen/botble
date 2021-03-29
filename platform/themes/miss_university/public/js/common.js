
function sendData(url, data, method, callback) {
    return jQuery.ajax({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        data: data,
        type: method,
        beforeSend: function () {
            showLoading()
        },
        success: function (response) {
            callback(response)
        },complete: function (response) {
            hideLoading()
        },error: function (xhr) {
            if (xhr.status == 422) {
                var objs = JSON.parse(xhr.responseText)
                objs = objs.errors
                $('.text-error').html('')
                $.each(objs, function (i, error) {
                    var obj = eval('objs.'+i)
                    $('.error_'+i).html(obj[0])
                });
            }
    }

    })
}
// Upload ajax
ajaxUploadFile = {
    frameName: 'frameUpload',
    frame: function (c) {
        var d = document.createElement('DIV');
        d.innerHTML = '<iframe style="display:none" src="about:blank" id="' + this.frameName + '" name="' + this.frameName + '" onload="ajaxUploadFile.loaded(\'' + this.frameName + '\')"></iframe>';
        document.body.appendChild(d);
        var i = document.getElementById(this.frameName);
        if (c && typeof (c.onComplete) == 'function') {
            i.onComplete = c.onComplete;
        }
        return this.frameName;
    },
    form: function (f, name) {
        f.setAttribute('target', name);
    },
    submit: function (f, c) {
        this.form(f, this.frame(c));
        if (c && typeof (c.onStart) == 'function') {
            return c.onStart();
        } else {
            return true;
        }
    },
    loaded: function (id) {
        var i = document.getElementById(id);
        if (i.contentDocument) {
            var d = i.contentDocument;
        } else if (i.contentWindow) {
            var d = i.contentWindow.document;
        } else {
            var d = window.frames[id].document;
        }
        if (d.location.href == "about:blank") {
            return;
        }
        if (typeof (i.onComplete) == 'function') {
            i.onComplete(d.body.innerHTML);
        }
    },
    resetUpload: function (form, callback) {
        var result = jQuery('#' + this.frameName).contents().find('body').text();
        result = JSON.parse(result)
        if (result.path) {
            if (typeof callback == 'function')
                callback(form, result);
                jQuery('#' + this.frameName).remove()
        } else {
            console.log('Something wrong when upload file in server');
        }
    }
}

function showLoading(){
    jQuery('.fullscreen_loading').show();
}

function hideLoading(){
    jQuery('.fullscreen_loading').hide();
}

function showMessage(message){
    jQuery('.popup_message').show();
}

function hideMessage(){
    jQuery('.popup_message').hide();
}