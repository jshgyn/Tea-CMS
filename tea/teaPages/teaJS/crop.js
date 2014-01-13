
function changeThumbType(){

    $newThumb = $("#thumbType").val();
    //alert($newThumb);
    
    if ($newThumb == "norm") {
        $('#smallPhotoContainer').css({ 
            width: cWidth, 
            height: cHeight,
        }); 
        $('#largePhoto').imgAreaSelect({ 
            aspectRatio: '1:1'
        });
    }
    else if ($newThumb == "tall") {
        $('#smallPhotoContainer').css({ 
            width: cWidth, 
            height: cHeight*2,
        });
        $('#largePhoto').imgAreaSelect({ 
            aspectRatio: '1:2'
        });
    }
    else if ($newThumb == "wide") {
        $('#smallPhotoContainer').css({ 
            width: cWidth*2, 
            height: cHeight,
        }); 
        $('#largePhoto').imgAreaSelect({ 
            aspectRatio: '2:1'
        });                
    }
}

function preview(img, selection) { 

    var thisW = $('#smallPhotoContainer').css("width");
    thisW = thisW.substr(0,thisW.length-2);
    var thisH = $('#smallPhotoContainer').css("height");
    thisH = thisH.substr(0,thisH.length-2);

    var scaleX = thisW / (selection.width || 1); 
    var scaleY = thisH / (selection.height || 1); 
    $('#largePhoto + div > img').css({ 
        width: Math.round(scaleX * img.width) + 'px', 
        height: Math.round(scaleY * img.height) + 'px', 
        marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
        marginTop: '-' + Math.round(scaleY * selection.y1) + 'px'
    }); 
} 
 
$(document).ready(function () { 
    var scale_w = $('#thumbContent').width();
    $('input[name=t_scale]').val(scale_w); 


    $('<div id="smallPhotoContainer"><img id="smallPhoto" class="imageThumbEdit" src="'+$("#largePhoto").attr("src")+'" /><div>') .css({ 
        overflow: 'hidden', 
        width: cWidth, 
        height: cHeight,
        margin: '0 0 10px 0',
        float: 'left'
    }) .insertAfter($('#largePhoto')); 
     
    $('#largePhoto').imgAreaSelect({ 
        aspectRatio: '1:1', 
        handles: true,
        onSelectChange: preview, 
        onSelectEnd: function ( image, selection ) {
            var thisW = $('#smallPhotoContainer').css("width");
                thisW = thisW.substr(0,thisW.length-2);
            var thisH = $('#smallPhotoContainer').css("height");
                thisH = thisH.substr(0,thisH.length-2);
            $('input[name=x1]').val(selection.x1); 
            $('input[name=y1]').val(selection.y1); 
            $('input[name=x2]').val(selection.x2); 
            $('input[name=y2]').val(selection.y2);
            $('input[name=cW]').val(thisW); 
            $('input[name=cH]').val(thisH);
        } 
    }); 
});