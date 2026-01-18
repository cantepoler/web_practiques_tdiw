<div class="detall">
    <div class="caixa_detall">
        <img src="<?php echo BASE_URL . '/' . $producte['imatge']?>" alt="<?php echo $producte['nom'] ?>">
        <div class="information">
            <h2><?php echo $producte['nom'] ?></h2>
            <div><?php echo $producte['descripcio'] ?></div>
            <div class="preu">
                <?php echo number_format($producte['preu'], 2, ',', '.') ?> €
            </div>

            <form action="index.php?accio=afegir-al-carret" method="POST">
                <input type="hidden" name="id_producte" value="<?php echo $producte['id'] ?>">
                <button type="submit" class="btn-carret">
                    🛒 Afegir al carret
                </button>
            </form>
        </div>
    </div>
</div>
