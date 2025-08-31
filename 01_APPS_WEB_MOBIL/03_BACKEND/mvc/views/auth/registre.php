<?php include 'views/layout/header.php'; ?>

<div class="auth-container">
    <h2>Crear Compte</h2>

    <?php if (isset($error)): ?>
        <!-- VULNERABILITAT: XSS -->
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <!-- VULNERABILITAT: Sense protecció CSRF -->
    <form method="POST" action="/mvc/?route=/registre">
        <div class="form-group">
            <label for="nom_usuari">Nom d'usuari:</label>
            <!-- VULNERABILITAT: XSS - valor sense escapar -->
            <input type="text" id="nom_usuari" name="nom_usuari"
                value="<?= $_POST['nom_usuari'] ?? '' ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"
                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label for="nom_complet">Nom complet:</label>
            <!-- VULNERABILITAT: XSS -->
            <input type="text" id="nom_complet" name="nom_complet"
                value="<?= $_POST['nom_complet'] ?? '' ?>">
        </div>

        <div class="form-group">
            <label for="password">Contrasenya:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirmar contrasenya:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>

        <!-- VULNERABILITAT: Checkbox de termes sense validació -->
        <div class="form-group">
            <input type="checkbox" id="termes" name="termes" required>
            <label for="termes">Accepto els <a href="/termes" target="_blank">termes i condicions</a></label>
        </div>

        <button type="submit">Registrar-se</button>
    </form>

    <p>Ja tens compte? <a href="/mvc/?route=/login">Inicia sessió aquí</a></p>
</div>

<?php include 'views/layout/footer.php'; ?>