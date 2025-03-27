<h1 class="title is-2 has-text-centered">Login</h1>

<div class="columns is-centered">
    <div class="column is-one-third">
        <div class="box">
            <?php $form = \App\Core\Form\Form::begin('/login', 'post') ?>
                <?php echo $form->field($model, 'email')->emailField() ?>
                <?php echo $form->field($model, 'password')->passwordField() ?>
                <div class="field">
                    <div class="control">
                        <button class="button is-primary is-fullwidth">Login</button>
                    </div>
                </div>
                <div class="has-text-centered">
                    don't have an account? 
                    <a href="/register">Sign Up</a>
                </div>
            <?php \App\Core\Form\Form::end() ?>
        </div>
    </div>
</div>
