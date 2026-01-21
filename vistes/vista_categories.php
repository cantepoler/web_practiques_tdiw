<div id="caca" class="caixa_container">
<?php foreach ($categories as $categoria) { ?>
    <div class="caixa" onclick="carregarProductes(<?php echo $categoria['id']; ?>)">
        <img src="<?php echo BASE_URL . '/' . $categoria['imatge']?>" alt="<?php echo $categoria['nom'] ?>">
        <div class="information">
            <h2><?php echo $categoria['nom'] ?></h2>
            <div><?php echo $categoria['descripcio'] ?></div>
        </div>
    </div>
<?php } ?>
</div>