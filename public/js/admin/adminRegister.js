$(document).ready(function(){
	
 // $('#birth-date').mask('00/00/0000');
 // $('#phone-number').mask('000-000-0000');
  var email_pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  var pattern = /[^a-zA-Z0-9\!\@\#\$\%\^\*\_\|]+/;
  $("#registeradmin").submit(function(){
	  let name = $("#name").val();
	  let password =$("#password").val();
	  let cpass = $("#cpassword").val();
	  let email = $("#email").val();
	  //let phonenumber = $("#phone-number").val();
	  //let bday = $("#birth-date").val();
	  
	  if(name == ""){
		swal({
		title: "Missing",
		text: 'Please insert your fullname',
		icon: "warning",
		button: "OK",
		});
		$("#name").focus();
		return false;
		
	  }
	  /*else if(pattern.test(name) && name !== ""){
		  swal({
		title: "Missing",
		text: 'Characters Only',
		icon: "warning",
		button: "OK",
		});
		  return false;
	  }*/
	  
	  if(password == ""){
		swal({
		title: "Missing",
		text: 'Please insert your password',
		icon: "warning",
		button: "OK",
		});
		$("#password").focus();
		return false;
	  }else if(password.length > 0 && password.length < 10){
		  swal({
		title: "Length",
		text: 'Atleast 10 characters',
		icon: "warning",
		button: "OK",
		});
		$("#password").focus();
		  return false;
	  }
	  if(cpass == ""){
		swal({
		title: "Missing",
		text: 'Please confirm your password',
		icon: "warning",
		button: "OK",
		});
		$("#cpassword").focus();
		return false;
	  }else if(cpass != password){
		  swal({
		title: "Warning",
		text: 'Password did not match!',
		icon: "warning",
		button: "OK",
		});
		  return false;
	  }
	  if(email == ""){
		swal({
		title: "Missing",
		text: 'Please insert your email',
		icon: "warning",
		button: "OK",
		});
		$("#email").focus();
		return false;
	  }else if(email_pattern.test(email) && email !== "")
	  {
		 
	  }else{
		swal({
		title: "Missing",
		text: 'Invalid Email format!',
		icon: "warning",
		button: "OK",
		});
		$("#email").focus();
		  return false;
	  }
	//   if(phonenumber == ""){
	// 	swal({
	// 	title: "Missing",
	// 	text: 'Please insert your phonenumber',
	// 	icon: "warning",
	// 	button: "OK",
	// 	});
	// 	$("#phone-number").focus();
	// 	return false;
	//   }
	//   if(bday == ""){
	// 	swal({
	// 	title: "Missing",
	// 	text: 'Please insert your birthdate',
	// 	icon: "warning",
	// 	button: "OK",
	// 	});
	// 	$("#birth-date").focus();
	// 	return false;
	//   }
	  swal({
		title: "Registration Status",
		text: 'Successfully Registered!',
		icon: "success",
		button: "OK",
		});
		
  });
  
 })