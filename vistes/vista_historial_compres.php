<section class="contenidor-checkout">
    <h2>Les meves Compres</h2>

    <?php if (empty($comandes)): ?>
        <div class="carret-buit">
            <p>No has fet cap comanda encara.</p>
            <a href="index.php?accio=llistar-categories" class="boto-accio">Començar a comprar</a>
        </div>
    <?php else: ?>
        <div class="comandes-lista">
            <?php foreach ($comandes as $comanda): ?>
                <div class="comanda-card" onclick="window.location.href='index.php?accio=confirmacio&id=<?php echo $comanda['id']; ?>'">
                    <div class="comanda-header">
                        <div class="comanda-info">
                            <h3>Comanda #<?php echo $comanda['id']; ?></h3>
                            <p class="comanda-data"><?php echo date('d/m/Y H:i', strtotime($comanda['data'])); ?></p>
                        </div>
                        <div class="comanda-estat">
                            <span class="estat-badge"><?php echo ucfirst($comanda['estat']); ?></span>
                        </div>
                    </div>

                    <div class="comanda-total">
                        <p><strong>Total:</strong> <span class="total-preu"><?php echo number_format($comanda['total'], 2, ',', '.'); ?> €</span></p>
                    </div>

                    <div class="comanda-adreca">
                        <p><strong>Adreça:</strong> <?php echo htmlspecialchars($comanda['adreca']); ?></p>
                        <p><?php echo htmlspecialchars($comanda['poblacio']); ?>, <?php echo htmlspecialchars($comanda['codi_postal']); ?></p>
                    </div>

                    <div class="comanda-accio">
                        <span>Veure detalls →</span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
