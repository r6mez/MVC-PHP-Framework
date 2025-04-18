<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MVC FrameWork</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
</head>

<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">
                <h1 class="title is-4">Ramez MVC Framework</h1>
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="/">
                    Home
                </a>

                <a class="navbar-item" href="/contact">
                    Contact
                </a>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <?php if (App\Core\Application::isGuest()): ?>
                        <div class="buttons">
                            <a class="button is-primary" href="/register">
                                <strong>Sign up</strong>
                            </a>
                            <a class="button is-light" href="/login">
                                Login
                            </a>
                        </div>
                    <?php else : ?>
                        <div class="buttons">
                            <a class="button is-light" href="/logout">
                                Logout
                            </a>
                            <a class="button is-light" href="/profile">
                                <?php echo App\Core\Application::$app->user->getDisplayName() ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </nav>

    <section class="section">
        <?php if (\App\Core\Application::$app->session->getFlash("success")) : ?>
            <div class="notification is-success">
                <?= \App\Core\Application::$app->session->getFlash("success") ?>
            </div>
        <?php endif; ?>
        {{content}}
    </section>
</body>

</html>