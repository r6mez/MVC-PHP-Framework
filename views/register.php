<h1 class="title is-2 has-text-centered">Register</h1>

<div class="columns is-centered">
    <div class="column is-half">
        <div class="box">
            <?php $form = \App\Core\Form\Form::begin('/register', 'post') ?>
                <!-- Form Fields -->
                <?php echo $form->field($model, 'name') ?>
                <?php echo $form->field($model, 'email')->emailField() ?>
                <?php echo $form->field($model, 'password')->passwordField() ?>
                <?php echo $form->field($model, 'confirmPassword')->passwordField() ?>
                <!-- Submit Button -->
                <div class="field"> 
                    <div class="control">
                        <button class="button is-primary is-fullwidth">Register</button>
                    </div>
                </div>

                <!-- Login Link -->
                <div class="has-text-centered">
                    Already have an account? <a href="/login">Login</a>
                </div>
            <?php \App\Core\Form\Form::end() ?>
        </div>
    </div>
</div>