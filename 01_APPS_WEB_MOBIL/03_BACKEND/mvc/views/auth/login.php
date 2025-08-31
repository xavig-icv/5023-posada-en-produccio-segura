<?php include 'views/layout/header.php'; ?>

<div class="auth-container">
    <h2>Iniciar Sessió</h2>

    <?php if (isset($error)): ?>
        <!-- VULNERABILITAT: XSS -->
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <!-- VULNERABILITAT: Sense protecció CSRF -->
    <form method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Contrasenya:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit">Entrar</button>
    </form>

    <p>No tens compte? <a href="/mvc/?route=/registre">Registra't aquí</a></p>
</div>

<?php include 'views/layout/footer.php'; ?>