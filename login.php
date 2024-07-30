<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
       <div class="row">
           <div class="col-lg-5 mx-auto">
               <div class="card-border-0 shadow rounded-3 my-5">
                   <div class="card-body p-sm-5">
                        <div class="card-title text-center fw-bold fs-3 mb-5">Form Login</div>
                        <form action="proses_login.php" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" name="username" id="" class="form-control" required placeholder="username">
                            <label for="" class="floating-input">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" id="" class="form-control" required placeholder="password">
                            <label for="" class="floating-input">Password</label>
                        </div>
                        <div class="d-grid">
                            <input type="submit" value="Login" class="btn btn-primary fw-bold fs-5 text-uppercase">
                        </div>
        </form>

                   </div>
               </div>
           </div>
       </div>
         
    </div>
</body>
</html>