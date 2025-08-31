<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma de Videojocs</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <h2>Gamers.cat</h2>
            </div>
            <div class="menu">
                <a href="/mvc/?route=/">Inici</a>
                <a href="/mvc/?route=/jocs">Jocs</a>
                <?php if (Session::isLoggedIn()): ?>
                    <!-- VULNERABILITAT: XSS -->
                    <a href="/mvc/?route=/perfil">Hola, <?= Session::get('nom_usuari') ?></a>
                    <a href="/mvc/?route=/ranking">Ranking</a>
                    <a href="/mvc/?route=/logout">Sortir</a>
                <?php else: ?>
                    <a href="/mvc/?route=/login">Accedir</a>
                    <a href="/mvc/?route=/registre">Registrar-se</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    <main>