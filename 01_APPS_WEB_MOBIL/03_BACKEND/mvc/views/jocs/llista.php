<?php include 'views/layout/header.php'; ?>

<div class="jocs-container">
    <h2>Jocs Disponibles</h2>

    <div class="jocs-grid">
        <?php foreach ($jocs as $joc): ?>
            <div class="joc-card">
                <!-- VULNERABILITAT: XSS -->
                <h3><?= $joc['nom_joc'] ?></h3>
                <p><?= $joc['descripcio'] ?></p>
                <p>Puntuació màxima: <?= $joc['puntuacio_maxima'] ?></p>

                <?php if (Session::isLoggedIn()): ?>
                    <!-- VULNERABILITAT: IDOR a la URL -->
                    <a href="/mvc/?route=/jugar&id=<?= $joc['id'] ?>" class="btn-jugar">Jugar</a>
                <?php else: ?>
                    <p><a href="/mvc/?route=/login">Inicia sessió per jugar</a></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'views/layout/footer.php'; ?>