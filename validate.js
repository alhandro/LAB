//This is a function to validate our form
//calling the function when the form is  submitted
function validateForm(){
	var fname=document.forms["user_details"]["first_name"].value;
	var fname=document.forms["user_details"]["last_name"].value;
	var fname=document.forms["user_details"]["city_name"].value;

	if (fname == null || lname =="" || city ==""){
		alert("all details required were not supplied");
		return false;
	}
	return true;
}