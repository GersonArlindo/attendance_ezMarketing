<?php
session_start();
if (isset($_SESSION['employee_id']) && $_SESSION['employee_id'] > 0) {
    header("Location:./");
    exit;
}
require_once('./DBConnection.php');
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Employee Assistance System</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/script.js"></script>

    <!-- Nuevo Login -->
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!--load all styles -->
    <link href="/your-path-to-uicons/css/uicons-[your-style].css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />

    <!-- Nuevo Login -->

    <style>
   body{
    background-color: black;
   }

 
    
 
    #radius-shape-5 {
      height: 220px;
      width: 220px;
      top: -60px;
      left: -130px;
      background: radial-gradient(#460404, #c20606);
      overflow: hidden;
    }
 
    #radius-shape-4 {
      border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
      bottom: -60px;
      right: -110px;
      width: 300px;
      height: 300px;
      background: radial-gradient(#460404, #c20606);
      overflow: hidden;
    }
 
    .bg-glassp {
      display: grid;
      place-items: center;
      background-color: hsla(0, 0%, 100%, 0.9) !important;
      backdrop-filter: saturate(200%) blur(25px);
      width: 500px;
      height: 417px;
    }

    </style>
</head>

<body>
    <!-- Section: Design Block -->
    <section class="background-radial-gradientp overflow-hidden">

        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                <span class="mb-1 opacity-70" style="color: hsl(218, 81%, 85%)">
                        <img src="./images/logoOficial.png" alt="" width="100%">
                    </span>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                    <div id="radius-shape-5" class="position-absolute rounded-circle shadow-5-strong"></div>
                    <div id="radius-shape-4" class="position-absolute shadow-5-strong"></div>

                    <div class="card bg-glassp">
                        <div class="card-body px-4 py-3 px-md-5">
                            <form action="" id="login-form">
                                <!-- 2 column grid layout with text inputs for the first and last names -->
                                <div class="row">
                                    <h1 class="text-center"> LOGIN - AGENT</h1>
                                    <!-- email input -->
                                    <div class="form-outline mb-4">
                                        <input type="email" id="email" name="email" autocomplete="on" class="form-control" required/>
                                        <label class="form-label" for="email">Email</label>
                                    </div>

                                    <!-- Password input -->
                                    <div class="form-outline mb-4">
                                        <input type="password" id="password" name="password" class="form-control" required/>
                                        <label class="form-label" for="password">Password</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block mb-4" style="background-color: #790707; color: white;">
                                        Sign in
                                    </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section: Design Block -->
</body>

<script type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js">
</script>

<script>  
    $(function() {
        $('#login-form').submit(function(e) {
            e.preventDefault();
            $('.pop_msg').remove()
            var _this = $(this)
            var _el = $('<div>')
            _el.addClass('pop_msg')
            _this.find('button').attr('disabled', true)
            _this.find('button[type="submit"]').text('Loging in...')
            $.ajax({
                url: './Actions.php?a=e_login',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'JSON',
                error: err => {
                    console.log(err)
                    _el.addClass('alert alert-danger')
                    _el.text("An error has occurred")
                    _this.prepend(_el)
                    _el.show('slow')
                    _this.find('button').attr('disabled', false)
                    _this.find('button[type="submit"]').text('SIGN IN')
                },
                success: function(resp) {
                    if (resp.status == 'success') {
                        _el.addClass('alert alert-success')
                        setTimeout(() => {
                            location.replace('./');
                        }, 2000);
                    } else {
                        _el.addClass('alert alert-danger')
                    }
                    _el.text(resp.msg)

                    _el.hide()
                    _this.prepend(_el)
                    _el.show('slow')
                    _this.find('button').attr('disabled', false)
                    _this.find('button[type="submit"]').text('SIGN IN')
                }
            })
        })
    })

</script>

</html>