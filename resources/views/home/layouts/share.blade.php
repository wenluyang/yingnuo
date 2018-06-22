<script src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script type="text/javascript" charset="utf-8">
    wx.config({!! $json !!});
    wx.ready(function () {
        wx.onMenuShareTimeline({
            title: '{{$title}}', // 分享标题
            desc: '{{$desc}}',//分享描述
            link: '{{$url}}', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: '{{$imgUrl}}', // 分享图标
            success: function () {
                console.log('share succeed');
            },
            cancel: function () {
                console.log('share canceled');
            }
        });
    });
    wx.ready(function () {
        wx.onMenuShareAppMessage({
            title: '{{$title}}', // 分享标题
            desc: '{{$desc}}',//分享描述
            link: '{{$url}}', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: '{{$imgUrl}}', // 分享图标
            success: function () {
                console.log('share succeed');
            },
            cancel: function () {
                console.log('share canceled');
            }
        });
    });


</script>
