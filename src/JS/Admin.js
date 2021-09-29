function logout()
{
    console.log("logout")
    data_list = new FormData()
    data_list.append("ajax", 1)

    var route = Routing.generate('AdminLogout')
    $.ajax({
        url: route,
        type: 'POST',
        data: data_list,
        processData: false,
         contentType: false  
    })
    .done(function(x) {
        location.reload(true);
    })
    .fail(function(e) {
        console.log(e.responseText);
    });
}