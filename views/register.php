<?php 
    $this->title = "Register";
?>

<section style="min-height: 80vh; display: flex; align-items: center;">
    <div style="width:100%;">
        <h1 class="title is-2 has-text-centered">Register</h1>
        <div class="columns is-centered is-vcentered">
            <div class="column is-half">
                <?php $form = \Ramez\PhpMvcCore\Form\Form::begin('/register', 'post') ?>
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
                <?php \Ramez\PhpMvcCore\Form\Form::end() ?>
            </div>
        </div>
    </div>
</section>