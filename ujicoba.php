<!DOCTYPE html> 
<html> 
  <head>     
    <title>Animated Login Form</title>     
    <link rel="stylesheet" type="text/css" href="style.css">     
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">     
    <script src="https://kit.fontawesome.com/a81368914c.js%22%3E"></script>     
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
  </head> 
  <body>     
    <img class="wave" src="wave.png">     
    <div class="container">         
      <div class="img">             
        <img src="bg.svg">         
      </div>         
      <div class="login-content">             
        <form action="index.html">                 
          <img src="avatar.svg">                 
          <h2 class="title">Welcome</h2>                    
          <div class="input-div one">                       
            <div class="i">                              
              <i class="fas fa-user"></i>                       
            </div>                       
            <div class="div">                               
              <h5>Username</h5>                               
              <input type="text" class="input">                       
            </div>                    
          </div>                    
          <div class="input-div pass">                       
  <div class="i">
  <i class="fas fa-user"></i>
                      </div>
                      <div class="div">
                              <h5>Username</h5>
                              <input type="text" class="input">
                      </div>
                   </div>
                   <div class="input-div pass">
                      <div class="i"> 
                           <i class="fas fa-lock"></i>
                      </div>
                      <div class="div">
                           <h5>Password</h5>
                           <input type="password" class="input">
                   </div>
                </div>
                <a href="#">Forgot Password?</a>
                <input type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="valid.js"></script>
</body>
</html>

function login() {
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  if (username == "admin" && password == "password") {
    alert("Login successful!");
    window.location.replace("todo.html");
  } else {
    alert("Invalid username or password.");
  }
}
const inputs = document.querySelectorAll(".input");


function addcl(){
    let parent = this.parentNode.parentNode;
    parent.classList.add("focus");
}

function remcl(){
    let parent = this.parentNode.parentNode;
    if(this.value == ""){
        parent.classList.remove("focus");
    }
}


inputs.forEach(input => {
    input.addEventListener("focus", addcl);
    input.addEventListener("blur", remcl);
});