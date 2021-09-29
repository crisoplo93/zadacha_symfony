
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});

function sendInfo()
{
  user_input = document.getElementById('user_input')
  data_list = new FormData()
  data_list.append("ajax", 1)
  data_list.append("message", $('#user_message').val())
  data_list.append("email", $('#user_email').val())
  data_list.append("color", $('#user_color').val())
  data_list.append("shape", $('#user_shape').val())

  for (var i = 0; i < user_input.files.length; i++)
  {
      data_list.append("img_"+i, user_input.files[i])
  }

  var route = Routing.generate('SaveUserData')

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
        msg = x['msg'].split("|").join("<br/>")
        alertMessages("warning", "Внимание!", msg)
    }
    else if (x['code']==0)
    {
        alertMessages("success", "Успех!", x['msg'])
        $('#user_message').val("")
        $('#user_email').val("")
        $('#user_color').val("")
        $('#user_shape').val("")
        user_input.value=""
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
