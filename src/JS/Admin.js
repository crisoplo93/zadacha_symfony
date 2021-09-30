$(document).ready(function(){
    get_table_page(1)
  });

function get_table_page(page)
{
    data_list = new FormData()
    data_list.append("page", page)

    var route = Routing.generate('UserPaginate')
    $.ajax({
        url: route,
        type: 'POST',
        data: data_list,
        processData: false,
         contentType: false  
    })
    .done(function(x) {
        $('#users_table').html(x)
    })
    .fail(function(e) {
        console.log(e.responseText);
    });
}

function open_admin()
{
    $("#new_admin_modal").modal('show')
}

function add_admin()
{
  data_list = new FormData()
  data_list.append("ajax", 1)
  data_list.append("login", $('#admin_login').val())
  data_list.append("password", $('#admin_password').val())

  var route = Routing.generate('SaveNewAdmin')

  $.ajax({
    url: route,
    type: 'POST',
    data: data_list,
    processData: false,
     contentType: false  
})
.done(function(x) {
    
    if (x['code']==1)
    {
        msg = x['msg']
        alertMessages("warning", "Внимание!", msg)
    }
    else if (x['code']==0)
    {
        alertMessages("success", "Успех!", x['msg'])
        $('#admin_login').val("")
        $('#admin_password').val("")
        $("#new_admin_modal").modal('hide')
    }	
})
.fail(function(e) {
    console.log(e.responseText);
});
}

function close_new_admin()
{
    $("#new_admin_modal").modal('hide')
}

function close_preview()
{
    $("#preview_modal").modal('hide')
}

function expand(id)
{
    data_list = new FormData()
    data_list.append("ajax", 1)
    data_list.append("id", id)

    var route = Routing.generate('UserExpand')
    $.ajax({
        url: route,
        type: 'POST',
        data: data_list,
        processData: false,
         contentType: false  
    })
    .done(function(x) {
        console.log(x)
        $("#user_message").html(x['message'])
        $("#user_email").html(x['email'])
        $("#user_color").html(x['color'])
        $("#user_shape").html(x['shape'])
        $("#user_images").html(x['img_list'])
        $("#preview_modal").modal('show')
    })
    .fail(function(e) {
        console.log(e.responseText);
    });
    
}

function logout()
{
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

function alertMessages(type, tittle, message)
{
	Swal.fire({
          html: message,
		  icon: type,
		  title: tittle
		})
}
