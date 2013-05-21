function jqPngFix() {
    try {
        //ie6 png transperency fix
        $.each($("img[src$=.png],img[src$=.PNG]"), function () {
            var img = $(this);
            img.css({"width": img.width(),"height": img.height(), "filter": "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + img.attr("src") + "', sizingMethod='scale')"});
            img.attr("src","/images/blank.gif");
        });
    } catch(e) {
        alert(e.description)
    }
}
$(document).ready(jqPngFix);