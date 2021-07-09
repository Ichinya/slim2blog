<ul>
    <li class="active"><a href="<?php echo $app->urlFor('home'); ?>"><span>Home</span></a></li>
    <?php if (!empty($pages) && is_array($pages)) : ?>
        <?php foreach ($pages as $page) : ?>
            <li><a href="<?php echo $app->urlFor('page', array('alias' => $page['alias'])); ?>"><span><?php echo $page['title'] ?></span></a></li>
        <?php endforeach; ?>
    <?php endif; ?>
    <li class="active"><a href="/contacts"><span>Контакты</span></a></li>
</ul>