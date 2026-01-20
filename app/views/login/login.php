<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - YQ Corredores de Seguros</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/login.css">
</head>

<body>

<div class="container-login">

    <!-- Columna izquierda con la imagen -->
    <div class="login-image">
        <div class="overlay"></div>
        <h1 class="brand-title">YQ Corredores de Seguros</h1>
    </div>

    <!-- Columna derecha (contenedor) -->
    <div class="login-form">

        <!-- FORM LOGIN -->
        <div id="form-login" class="form-section active">
            <h2>Bienvenido</h2>
            <p class="subtitle">Accede al sistema de cotización</p>

            <?php if (isset($_GET['login_error'])): ?>
    <div class="error">Credenciales incorrectas</div>
<?php endif; ?>



            <form action="<?php echo BASE_URL; ?>login/validar" method="POST">

                <label>DNI</label>
                <input type="text" name="dni" placeholder="Ingresa tu DNI" required>

                <label>Contraseña</label>
                <input type="password" name="password" placeholder="********" required>

                <button type="submit" class="btn-login">Ingresar</button>
            </form>

            <p class="switch-text">
                ¿Eres nuevo?
                <span class="switch-link" onclick="showRegister()">Regístrate ahora</span>
            </p>
        </div>

        <!-- FORM REGISTRO -->
        <div id="form-register" class="form-section">
            <h2>Crear Cuenta</h2>
            <p class="subtitle">Regístrate para cotizar tus seguros</p>

           <?php if (isset($_GET['register_error'])): ?>
    <div class="error"><?php echo $_GET['register_error']; ?></div>
<?php endif; ?>



            <form action="<?php echo BASE_URL; ?>login/registrarUsuario" method="POST">

                <input type="hidden" name="rol" value="cliente">

                <label>DNI</label>
                <input type="text" name="dni" pattern="\d{8}" maxlength="8"
                       placeholder="Ingresa tu DNI" required>

                <label>Contraseña</label>
                <input type="password" name="password" placeholder="Crea una contraseña" required>
                <small style="color:#555;">Sugerencia: usa tu DNI como contraseña inicial</small>
<br><br>
                <label>Código de asesor (opcional)</label>
                <input type="text" name="cod_asesor" placeholder="Ejemplo: A123">

                <button type="submit" class="btn-login">Registrarme</button>

                <p class="switch-text" style="margin-top:20px;">
                    ¿Ya tienes cuenta? 
                    <span class="switch-link" onclick="showLogin()">Inicia sesión</span>
                </p>
            </form>
        </div>
    </div>
</div>
<?php 
$openRegister = isset($_GET['register_error']);
?>
<script>
    // Mostrar formulario correcto según errores
    const openRegister = <?php echo $openRegister ? 'true' : 'false'; ?>;
    if (openRegister) {
        showRegister();
    }

    function showRegister() {
        document.getElementById("form-login").classList.remove("active");
        document.getElementById("form-register").classList.add("active");
    }

    function showLogin() {
        document.getElementById("form-register").classList.remove("active");
        document.getElementById("form-login").classList.add("active");
    }
</script>

</body>
</html>
