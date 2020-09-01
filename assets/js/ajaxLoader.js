window.ajaxDataLoader = function(url, dataType, method, postVal) {
    if (url.charAt(0) !== '/') {
        var host = document.location.protocol+"//"+document.location.hostname
        if (document.location.port != 0) host += ":"+document.location.port
        host += "/" + url
    } else {
        host = url
    }

    // let encoded_postVal = null
    // if (postVal) encoded_postVal = { 'values': JSON.stringify(postVal) }
    // console.log('POST PARAM: '+encoded_postVal)

    return $.ajax({
        url : host,
        type : method,
        data: postVal,
        async: true,
        dataType : dataType,
    })
    .fail(function(data) { console.log("-- Error -- url: ", url) })
}