<?php foreach ($productes as $prod) { //Millorar les direccions a les imatges?>
    <div class="caixa" onclick="carregarDetallProducte(<?php echo $prod['id']; ?>)" >
        <img src="../../<?php echo $prod['imatge']?>" alt="<?php echo $prod['nom']; ?>"> 
        <div class="information">
            <h2><?php echo $prod['nom'] ?></h2>
            <!-- <div><?php //echo $prod['descripcio'] ?></div> -->
        </div>
        </a>
        <div class="preu">
                <?php echo number_format($prod['preu'], 2, ',', '.') ?> €
        </div>

        <form action="#" method="POST">
            <input type="hidden" name="id_producte" value="<?php echo $prod['id'] ?>">
            <button type="submit" class="btn-carret">
                🛒 Afegir al carret
            </button>
        </form>
    </div>
<?php } ?>
