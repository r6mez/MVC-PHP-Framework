<h1 class="title is-2 has-text-centered">Login</h1>

<div class="columns is-centered">
    <div class="column is-half">
        <div class="box">
            <?php $form = \App\Core\Form\Form::begin('/login', 'post') ?>
                <!-- Form Fields -->
                <?php echo $form->field($model, 'email')->emailField() ?>
                <?php echo $form->field($model, 'password')->passwordField() ?>

                <!-- Submit Button -->
                <div class="field"> 
                    <div class="control">
                        <button class="button is-primary is-fullwidth">Login</button>
                    </div>
                </div>

                <!-- Login Link -->
                <div class="has-text-centered">
                    Don't have an account? <a href="/register">Register</a>
                </div>
            <?php \App\Core\Form\Form::end() ?>
        </div>
    </div>
</div>