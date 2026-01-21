<section class="contenidor-confirmacio">
    <div class="confirmacio-success">
        <div class="icon-check">✓</div>
        <h2>Comanda confirmada!</h2>
        <p>Gràcies per la teva compra. El teu comanda és #<?php echo $comanda['id']; ?></p>
        <p>Rebràs un correu electrònic amb els detalls de la teva comanda.</p>
    </div>

    <!-- Order Details -->
    <div class="detalls-comanda">
        <h3>Detalls de la comanda</h3>

        <table class="taula-comanda">
            <thead>
                <tr>
                    <th>Producte</th>
                    <th>Preu unitari</th>
                    <th>Quantitat</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detalls as $detall): ?>
                <tr>
                    <td>
                        <div class="producte-info">
                            <img src="<?php echo BASE_URL . '/' . $detall['imatge']; ?>" alt="<?php echo $detall['nom_producte']; ?>">
                            <span><?php echo htmlspecialchars($detall['nom_producte']); ?></span>
                        </div>
                    </td>
                    <td><?php echo number_format($detall['preu_unitat'], 2, ',', '.'); ?> €</td>
                    <td><?php echo $detall['quantitat']; ?></td>
                    <td><?php echo number_format($detall['subtotal'], 2, ',', '.'); ?> €</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Summary -->
    <div class="resum-compra">
        <h3>Resum</h3>

        <div class="info-comanda">
            <p><strong>Número de comanda:</strong> #<?php echo $comanda['id']; ?></p>
            <p><strong>Data:</strong> <?php echo date('d/m/Y H:i', strtotime($comanda['data'])); ?></p>
            <p><strong>Total:</strong> <span class="total-preu"><?php echo number_format($comanda['total'], 2, ',', '.'); ?> €</span></p>
            <p><strong>Estat:</strong> <span class="estat-badge"><?php echo ucfirst($comanda['estat']); ?></span></p>
        </div>

        <div class="adreca-confirmacio">
            <h4>Adreça d'entrega:</h4>
            <p><?php echo htmlspecialchars($comanda['nom_client']); ?></p>
            <p><?php echo htmlspecialchars($comanda['adreca']); ?></p>
            <p><?php echo htmlspecialchars($comanda['poblacio']); ?>, <?php echo htmlspecialchars($comanda['codi_postal']); ?></p>
        </div>
    </div>

    <!-- Actions -->
    <div class="confirmacio-accions">
        <a href="index.php?accio=llistar-categories" class="boto-accio">Continuar comprant</a>
        <a href="index.php?accio=les-meves-compres" class="boto-secundari">Veure les meves compres</a>
    </div>
</section>
