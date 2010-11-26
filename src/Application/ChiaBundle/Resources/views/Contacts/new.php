<form action="<?php echo $view['router']->generate('contacts_new') ?>" method="post" <?php echo $view['form']->enctype($form) ?>>
    <?php echo $view['form']->errors($form) ?>
    <?php echo $view['form']->render($form) ?>
    <input type="submit" value="Send!" />
</form>
