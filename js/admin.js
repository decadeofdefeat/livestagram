function activate(op,sb) {

    //First menu
    jQuery('a[id^="op"]').removeClass("active");
    jQuery("#" + op).addClass("active");

    //Second menu
    jQuery('a[id^="sb"]').removeClass("active");
    jQuery("#" + sb).addClass("active");

}