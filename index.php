<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Nomina</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #285199, #3366bc);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            backdrop-filter: blur(10px);
            background: rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 40px;
            width: 350px;
            color: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .form-control {
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
        }

        .form-control::placeholder {
            color: #ddd;
        }

        .btn-custom {
            background: #00c6ff;
            border: none;
        }

        .btn-custom:hover {
            background: #0072ff;
        }
    </style>
</head>
<body>

<div class="login-card text-center">
    <h3 class="mb-4">Sistema Nomina</h3>

    <form action="check.php" method="POST">
        <div class="mb-3">
            <input type="text" name="usuario" class="form-control" placeholder="Usuario" required>
        </div>

        <div class="mb-3">
            <input type="password" name="clave" class="form-control" placeholder="Contraseña" required>
        </div>

        <button type="submit" class="btn btn-custom w-100">Ingresar</button>
    </form>
</div>

</body>
</html>