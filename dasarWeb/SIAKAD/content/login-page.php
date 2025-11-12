<!DOCTYPE html>
<html>
<head>
    <title>LOGIN SIAKAD</title>
    <link rel="icon" href="../img/lambang-polinema.png">

    <script src="jquery-3.7.1.js"></script>
    <script src="scriptLogin.js"></script>
    <script src="scriptRegister.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
          crossorigin="anonymous">
</head>
<body class="bg-white min-vh-100 d-flex flex-column">

    <header class="header-login bg-primary text-white d-flex align-items-center py-3 shadow-sm">
        <div class="logo ms-3 me-3 col-2 col-md-1">
            <img src="../img/lambang-polinema.png" alt="logo" class="img-fluid">
        </div>
        <div class="txt-head">
            <h1 class="txt fs-3 fw-bold m-0">LOGIN SIAKAD</h1>
        </div>
    </header>

    <div class="content container d-flex flex-md-row flex-column align-items-start justify-content-center py-5 flex-grow-1">
        
        <div class="img-content me-5 col-md-6 d-flex mb-2">
            <img src="../img/image.png" alt="gambar-mengajar" id="gambar" class="img-fluid w-100">
        </div>

        <div class="col-md-4 d-flex flex-column gap-5 ms-5">
            
            <div class="login">
                <div class="card border rounded-4 shadow p-4 bg-white">
                    <h2 class="text-center mb-2 fs-4">Masukkan Username dan Password</h2>
                    <p class="text-center text-secondary mb-4 fs-6">(menggunakan NIM dan password)</p>

                    <form id="loginForm" method="post"">
                        <div class="mb-3"> 
                            <input type="text" id="nim" name="NIM" placeholder="NIM" class="form-control form-control-lg fs-6"> 
                        </div>
                        <div class="mb-3">
                            <input type="password" id="password" name="password" placeholder="Password" class="form-control form-control-lg fs-6"> 
                        </div>
                        <p id="errorMsg" class="text-danger mb-3 text-center small"></p> 
                        <button type="submit" class="btn btn-primary w-100 btn-lg fs-6">LOGIN</button>
                    </form>

                    <div class="mt-4 text-center">
                        <p>Belum Punya Akun? <a href="register-page.php">Daftar disini</a></p>
                    </div>

                    <div class="error-msg"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
            crossorigin="anonymous">
    </script>
</body>
</html>
