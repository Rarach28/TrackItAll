<script>
var colorArray = {};

function updateClr(picker,selector) {
    if(selector===undefined){
        selector="#"+picker.targetElement.id
        if(["twodot","dot","slash","minus"].includes(picker.targetElement.id.substr(14))){
            selector="."+picker.targetElement.id
        }
    }
    // $(selector).style.color = picker.toBackground();
    // console.log("selector",selector);
    $(selector).css('color', picker.toRGBString());
    // console.log(picker.toRGBString());
    // var pomText = (picker.targetElement.id=="#id:")?"idtwodot":picker.targetElement.id;

    var pid = picker.targetElement.id.substr(14)//colorpickerId_
    colorArray[pid] = picker.toRGBString();
    // updateParams();
    console.log("colorArray",colorArray);
}

function getColorArray(){
    return colorArray;
}

function toClr(picker, selector) {
    document.querySelector(selector).style.color = picker.toBackground();
    $(".text-myclr").css('color', picker.toRGBString());
    jscolor.setPreviewElementBg(this.toRGBAString());
    console.log(picker.toRGBString());
}

function updateBg(picker, selector) {
    alert(picker);
    document.querySelector(selector).style.color = picker.toBackground();
    $(selector).css('background', picker.toRGBString());
    console.log(picker.toRGBString());
}

// triggers 'onInput' and 'onChange' on all color pickers when they are ready
jscolor.trigger('input ');


$(document).ready(function() {

    
    $("input#iconFilter").keyup(function() {
        var filter = this.value.toLowerCase(); // no need to call jQuery here

        $('.iconSet').each(function() {
            /* cache a reference to the current .media (you're using it twice) */
            var _this = $(this);
            var title = _this.find('.h5').text().toLowerCase();

            /* 
                title and filter are normalized in lowerCase letters
                for a case insensitive search
             */
            if (title.indexOf(filter) < 0) {
                _this.hide();
            } else {
                _this.show();
            }
        });
    });
});
</script>