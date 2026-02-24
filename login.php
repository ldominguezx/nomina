<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | MONTELEC</title>
    <link rel="shortcut icon" href="img/icono_montelec.gif">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-card {
            width: 100%;
            max-width: 380px;
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .login-card img {
            width: 80px;
            height: 80px;
            margin-bottom: 1rem;
        }
        .form-control {
            height: 45px;
            font-size: 0.95rem;
        }
        .btn-custom {
            height: 45px;
            font-weight: 600;
            font-size: 1rem;
        }
        .forgot-password {
            font-size: 0.85rem;
        }
        hr {
            margin: 1.5rem 0;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-card text-center">
        <img src="img/icono_montelec.gif" alt="Logo Montelec">
        <h3 class="mb-4">Iniciar Sesión</h3>

        <form action="sesion.php" method="post">
            <div class="mb-3">
                <input type="text" class="form-control" name="username" placeholder="Correo electrónico" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
            </div>

            <?php if(isset($_GET['error']) && $_GET['error'] == 'true'): ?>
                <div class="alert alert-danger py-2">Usuario o contraseña incorrectos</div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary btn-custom w-100 mb-2">Entrar</button>

            <div class="text-center mb-3">
                <a href="#" class="forgot-password text-decoration-none">¿Olvidaste tu contraseña?</a>
            </div>
        </form>

        <hr>

        <a href="#" class="btn btn-success btn-custom w-100">Crear cuenta nueva</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
