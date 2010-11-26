<a href="<?php echo $view['router']->generate('contacts_new') ?>">New</a>
<ul>
<?php foreach($contacts as $contact): ?>
    <li><?php echo $contact['name']; ?></li>
<?php endforeach; ?>
</ul>
