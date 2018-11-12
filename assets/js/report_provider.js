function openPopup(obj) {

    var data = $(obj).serialize();

    var url = BASE_URL+"/report/provider_pdf?"+data;
    window.open(url, "report", "width=700,height=500");

    return false;
}