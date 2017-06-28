<?php if(count($print) > 0): ?>
    <div>
        <?php foreach ($print as $p): ?>
            <p style="color: gray;"><?php echo $p; ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>