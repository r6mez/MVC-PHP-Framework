<?php 
    $this->title = "Login";
?>

<section style="min-height: 80vh; display: flex; align-items: center;">
    <div style="width:100%;">
        <h1 class="title is-2 has-text-centered">Login</h1>
        <div class="columns is-centered is-vcentered">
            <div class="column is-half">
                <?php $form = \Ramez\PhpMvcCore\Form\Form::begin('/login', 'post') ?>
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
                <?php \Ramez\PhpMvcCore\Form\Form::end() ?>
            </div>
        </div>
    </div>
</section>