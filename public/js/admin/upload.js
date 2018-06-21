// 更换封面
$('.cmd-cover').uploader({
    url: common_ops.buildAdminUrl('/images/upload'),
    onAdd: function (elementId) {
        $(this).next('img').addClass('loading').attr('src', '/images/loading.gif');
    },
    onImageLoad: function (uri, elementId) {
        $(this).next('img').removeClass('loading').attr('src', uri)
            .after('<div class="progress"></div>');
    },
    onProgress: function (e) {
        var percent = parseInt(100 - (e.loaded / e.total) * 100) + '%';
        $(e.target.element).nextAll('.progress').css({height: percent});
    },
    done: function (response, elementId) {
        $(this).nextAll(':hidden').val(response.path);
    }
});