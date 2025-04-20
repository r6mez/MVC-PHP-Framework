<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <style>
        .navbar {
            min-height: 90px;
        }
        .navbar-item img {
            max-height: 70px;
        }
    </style>
</head>

<body>
    <nav class="navbar px-4 py-3" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">
                <img src="assets/logo.png">
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
                    <?php if (\Ramez\PhpMvcCore\Application::isGuest()): ?>
                        <div class="buttons">
                            <a class="button is-dark is-primary" href="/register">
                                <strong>Sign up</strong>
                            </a>
                            <a class="button is-dark" href="/login">
                                Login
                            </a>
                        </div>
                    <?php else : ?>
                        <div class="buttons">
                            <a class="button is-info is-dark" href="/profile">
                                <?php echo \Ramez\PhpMvcCore\Application::$app->user->getDisplayName() ?>
                            </a>
                            <a class="button is-danger is-dark" href="/logout">
                                Logout
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </nav>

    <section class="section">
        <?php if (\Ramez\PhpMvcCore\Application::$app->session->getFlash("success")) : ?>
            <div class="notification is-success">
                <?= \Ramez\PhpMvcCore\Application::$app->session->getFlash("success") ?>
            </div>
        <?php endif; ?>
        {{content}}
    </section>
</body>

</html>