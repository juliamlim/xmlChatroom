$(document).ready(function() {
    "use strict";
    var height = $(window).height() - $("#postMessage").height() - $("header").height() - 150;
    $("#messages").css("height", height);
    var messages = document.getElementById("messages");
    messages.scrollTop = messages.scrollHeight;
});