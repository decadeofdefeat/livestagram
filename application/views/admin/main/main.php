<h1>Instagram Admin</h1>

<div id='slide_container'>
<?php foreach ($photos as $item):?>
    <div class='slide' id='slide_<?php echo $item['id'];?>'>
        <img width='100' height='100' src="<?php echo $item['thumb'];?>">
        <div class="caption">
            <p><?php echo $item['user'];?></p>
        </div>
        <div class='edit_photo'>
            <button onclick="banPhoto('<?php echo $item['id'];?>'); return false">Ban This Photo</button>
        </div>
    </div>
<?php endforeach;?>
</div>