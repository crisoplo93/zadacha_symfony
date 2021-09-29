function login()
{   
  data_list = new FormData()
  data_list.append("ajax", 1)
  data_list.append("login", $('#admin_login').val())
  data_list.append("password", $('#admin_password').val())

  var route = Routing.generate('AdminLogin')

  $.ajax({
    url: route,
    type: 'POST',
    data: data_list,
    processData: false,
     contentType: false  
})
.done(function(x) {
    console.log(x)
    if (x['code']==1)
    {
        alertMessages("warning", "Внимание!", x['msg'])
    }
    else if (x==1)
    {
        location.reload(true);
    }
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