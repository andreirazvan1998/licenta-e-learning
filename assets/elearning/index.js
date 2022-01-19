function loadAjax(req, data1, divID, callback) {
    if (!data1) data1 = "";
    var opt = "ajax=true" + data1;
    var resp = $.ajax({
        url: req,
        data: opt,
        async: true,
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8'
    });
    resp.done(function (msg) {
        if (divID != null && divID != "" && divID != " ") {
            $("#" + divID).html(msg);
            if (callback != null && callback != '' && callback != 'undefined') {
                console.log("Callback start");
                callback(msg, divID);
                console.log("Callback end");
            }
        }
    });
}

function formAjax(req, formID, divID, callback) {
    if (!formID) return false;
    var resp = $.ajax({
        url: req,
        data: $("#" + formID).serialize(),
        async: true,
        type: 'post',
        cache: false,
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8'
    });
    resp.done(function (msg) {
        if (divID != null && divID != "" && divID != " ") {
            $("#" + divID).html(msg);
            if (callback != null && callback != '' && callback != 'undefined') {
                console.log("Callback start");
                callback(msg, divID);
                console.log("Callback end");
            }
        }
    });
}