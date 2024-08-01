<main class="auth">
    <h2 class="auth__heading"><?php echo $title ?></h2>


    <?php
        require_once __DIR__ . '/../templates/alerts.php';
    ?>


    <?php if(isset($alerts['success'])){ ?>
    <div class="auth-links--success">
        <a href="/login" class="auth-links__link">Iniciar sesión</a>
    </div>
    <?php } ?>
</main>