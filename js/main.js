window.onload = function(){
let menu_btn = document.querySelector(".menu-btn")
let nav_bar = document.querySelector(".nav-bar")

menu_btn.addEventListener("click",function(){
	nav_bar.classList.toggle("extended");
	menu_btn.classList.toggle("change");
});
};

$(document).ready(function(){
  
  
  $('[data-toggle="tooltip"]').tooltip();
  $(".form-reg").hide();
  //login - register button event
  $('#login-btn').click(function(){
  		$("#login-btn").addClass("focus");
  		$("#reg-btn").removeClass("focus");
  		$(".form-login").show();
  		$(".form-reg").hide();
  });

  $('#reg-btn').click(function(){
  		$("#login-btn").removeClass("focus");
  		$("#reg-btn").addClass("focus");
  		$(".form-login").hide();
  		$(".form-reg").show();
  });
  
  $("#file").css("display","none");
});