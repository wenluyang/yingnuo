
if(location.protocol == 'https:'){
    location.replace(location.href.replace(/^https:/, 'http:'));
}
jaUpload('[data-upload]', {
    // 上传地址
    url: 'http://up-z2.qiniu.com/',

    // 表单附加数据 这里 用作 七牛认证
    data: {
        key: '{date}-{U}-{name}',
        token: '6q3Gdc720xbRwcK-HF-tTP3-ZjFDE7Z6dWw60yUj:_YLJgwRgilF08BXZeR6zJQfxNFk=:eyJzY29wZSI6ImRlbW8iLCJkZWFkbGluZSI6MTY0OTQzNTAzOSwidXBIb3N0cyI6WyJodHRwOlwvXC91cC16Mi5xaW5pdS5jb20iLCJodHRwOlwvXC91cGxvYWQtejIucWluaXUuY29tIiwiLUggdXAtejIucWluaXUuY29tIGh0dHA6XC9cLzE4My42MC4yMTQuMTk4Il19'
    },

    // 上传完成后返回数据的处理
    value: function(a, d){
        var _u = 'http://oo5fdwvf6.bkt.clouddn.com/'+a.key;
        if(_img = d.parentNode.querySelector('img')){
            _img.src = _u;
        }
        return _u;
    }
});
