<section class="contenidor-checkout">
    <h2>Confirmar la teva Comanda</h2>

    <!-- Shipping Address -->
    <div class="adreca-entrega">
        <h3>Adreça d'entrega</h3>
        <p><strong>Nom:</strong> <?php echo htmlspecialchars($usuari['nom']); ?></p>
        <p><strong>Adreça:</strong> <?php echo htmlspecialchars($usuari['adreca']); ?></p>
        <p><strong>Població:</strong> <?php echo htmlspecialchars($usuari['poblacio']); ?></p>
        <p><strong>Codi Postal:</strong> <?php echo htmlspecialchars($usuari['codi_postal']); ?></p>
    </div>

    <!-- Order Summary -->
    <div class="resum-comanda">
        <h3>Productes de la comanda</h3>

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
                <?php foreach ($carret as $item): ?>
                <tr>
                    <td>
                        <div class="producte-info">
                            <img src="<?php echo BASE_URL . '/' . $item['imatge']; ?>" alt="<?php echo $item['nom']; ?>">
                            <span><?php echo htmlspecialchars($item['nom']); ?></span>
                        </div>
                    </td>
                    <td><?php echo number_format($item['preu'], 2, ',', '.'); ?> €</td>
                    <td><?php echo $item['quantitat']; ?></td>
                    <td><?php echo number_format($item['subtotal'], 2, ',', '.'); ?> €</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Total -->
        <div class="total-checkout">
            <h3>Total a pagar:</h3>
            <span class="total-preu"><?php echo number_format($total, 2, ',', '.'); ?> €</span>
        </div>
    </div>

    <!-- Actions -->
    <div class="checkout-accions">
        <a href="index.php?accio=carret" class="boto-secundari">Tornar al carret</a>
        <button class="boto-accio" onclick="confirmarCompra()">Confirmar compra</button>
    </div>
</section>

<script>
function confirmarCompra() {
    if (confirm('Estàs segur que vols confirmar aquesta comanda?')) {
        window.location.href = '<?php echo BASE_URL; ?>/index.php?accio=processar-comanda';
    }
}
</script>
