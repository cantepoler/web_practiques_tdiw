<?php foreach ($productes as $prod) { ?>
    <div class="caixa">
        <a href="index.php?accio=detall-producte&id=<?php echo $prod['id']; ?>">
            <img src="<?php echo BASE_URL . '/' . $prod['imatge']?>" alt="<?php echo $prod['nom']; ?>">
            <div class="information">
                <h2><?php echo $prod['nom'] ?></h2>
            </div>
        </a>
        <div class="preu">
                <?php echo number_format($prod['preu'], 2, ',', '.') ?> €
        </div>

        <form action="index.php?accio=afegir-al-carret" method="POST">
            <input type="hidden" name="id_producte" value="<?php echo $prod['id'] ?>">
            <button type="submit" class="btn-carret">
                🛒 Afegir al carret
            </button>
        </form>
    </div>
<?php } ?>
