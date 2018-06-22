;
var product_index_ops = {
    init:function(){
        this.p = 1;
        this.sort_field = "default";
        this.sort = "";
        this.category_id = "";
        this.eventBind();
    },
    eventBind:function(){
        var that = this;
        $(".search_header .sch-submit").click( function(){

            that.search();
        });

        $(".sort_box .sort_list li a").click( function(){
            that.sort_field = $(this).attr("data");
            if( $(this).find("i").hasClass("high_icon")  ){
                that.sort = "asc"
            }else{
                that.sort = "desc"
            }
            that.search();
        });

        process = true;
        $( window ).scroll( function() {
            if( ( ( $(window).height() + $(window).scrollTop() ) > $(document).height() - 20 ) && process ){
                process = false;
                that.p += 1;
                var data = {
                    kw:$(".search_header input[name=kw]").val(),
                    sort_field:this.sort_field,
                    sort:this.sort,
                    category_id:$(".page input[name=category_id]").val(),
                    p:that.p,

                };

                $.ajax({
                    url:common_ops.buildMUrl( "news/search" ),
                    type:'GET',
                    dataType:'json',
                    data:data,
                    success:function( res ){
                        process = true;
                        if( res.code != 200 ){
                            return;
                        }
                        var html = "";
                        for( idx in res.data.data ){
                            var info = res.data.data[ idx ];
                            html += '<li><a href="' + common_ops.buildMUrl( "news/###/show".replace('###', info['id'] )) + '"><img src="'+ info['main_image_url'] +'"  class="con_new_hd"/></a><div class="con_new_con"><a href="' + common_ops.buildMUrl( "article/###/show".replace('###', info['id'] )) + '">'+ info['title'] +'</a><p>'+ info['description'] +'</p></div></li>'
                        }

                        $(".probox ul.prolist").append( html );
                        if( !res.data.has_next ){
                            process = false;
                        }
                    }
                });
            }
        });
    },
    search:function(){
        var params = {
            kw:$(".search_header input[name=kw]").val(),
            sort_field:this.sort_field,
            sort:this.sort,
            category_id:$(".page input[name=category_id]").val()
        };
        window.location.href = common_ops.buildMUrl("news",params);
    }
};
$(document).ready(function () {
    product_index_ops.init();
});