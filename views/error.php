<?php 
    $this->title = "Error";
?>

<div>
    <h1 class="title is-1">Error <?php echo $exception->getCode() ?></h1>
    <p><?php echo $exception->getMessage() ?></p>
    <br>
    <div class="buttons">
        <a class="button is-dark is-primary" href="/">Home</a>
    </div>
</div>
