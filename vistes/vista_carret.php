<section class="contenidor-carret">
    <h2>El teu carret</h2>
    
    <?php if (empty($carret)): ?>
        <div class="carret-buit">
            <p>El teu carret està buit.</p>
            <a href="index.php?accio=llistar-categories" class="boto-secundari">Continuar comprant</a>
        </div>
    <?php else: ?>
        <div class="carret-items">
            <?php foreach ($carret as $item): ?>
                <div class="carret-item" data-id="<?php echo $item['id']; ?>">
                    <div class="item-imatge">
                        <img src="<?php echo BASE_URL . '/' . $item['imatge']; ?>" alt="<?php echo $item['nom']; ?>">
                    </div>
                    
                    <div class="item-info">
                        <h3><?php echo $item['nom']; ?></h3>
                        <p class="item-preu"><?php echo number_format($item['preu'], 2, ',', '.'); ?> € / unitat</p>
                    </div>
                    
                    <div class="item-controls">
                        <button class="btn-quantitat" onclick="actualitzarQuantitat(<?php echo $item['id']; ?>, -1)">-</button>
                        <span class="quantitat"><?php echo $item['quantitat']; ?></span>
                        <button class="btn-quantitat" onclick="actualitzarQuantitat(<?php echo $item['id']; ?>, 1)">+</button>
                    </div>
                    
                    <div class="item-subtotal">
                        <?php echo number_format($item['subtotal'], 2, ',', '.'); ?> €
                    </div>
                    
                    <button class="btn-eliminar" onclick="eliminarDelCarret(<?php echo $item['id']; ?>)">
                        🗑️
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="carret-resum">
            <div class="total-summari">
                <h3>Total:</h3>
                <span class="total-preu"><?php echo number_format($total, 2, ',', '.'); ?> €</span>
            </div>
            
            <div class="carret-accions">
                <a href="index.php?accio=llistar-categories" class="boto-secundari">Continuar comprant</a>
                <button class="boto-secundari" onclick="buidarCarret()">Buidar carret</button>
                <a href="index.php?accio=checkout" class="boto-accio">Finalitzar compra</a>
            </div>
        </div>
    <?php endif; ?>
</section>

<script>
async function actualitzarQuantitat(idProducte, canvi) {
    try {
        const resposta = await fetch(`index.php?accio=actualitzar-carret`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id_producte=${idProducte}&quantitat=${canvi}`
        });
        
        const data = await resposta.json();
        
        if (data.success) {
            // Update item quantity display
            const itemElement = document.querySelector(`.carret-item[data-id="${idProducte}"]`);
            if (itemElement) {
                itemElement.querySelector('.quantitat').textContent = data.nova_quantitat;
                itemElement.querySelector('.item-subtotal').textContent = number_format(data.subtotal, 2, ',', '.') + ' €';
            }
            
            // Update total
            document.querySelector('.total-preu').textContent = number_format(data.total, 2, ',', '.') + ' €';
            
            // Update cart count in header
            document.getElementById('cart-count').textContent = '(' + data.num_items + ')';
            
            // If quantity is 0, remove the item
            if (data.nova_quantitat === 0) {
                itemElement.remove();
                
                // Check if cart is empty
                const items = document.querySelectorAll('.carret-item');
                if (items.length === 0) {
                    location.reload();
                }
            }
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error en actualitzar el carret');
    }
}

async function eliminarDelCarret(idProducte) {
    if (!confirm('Estàs segur que vols eliminar aquest producte del carret?')) {
        return;
    }
    
    try {
        const resposta = await fetch(`index.php?accio=eliminar-del-carret`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id_producte=${idProducte}`
        });
        
        const data = await resposta.json();
        
        if (data.success) {
            // Remove item from DOM
            const itemElement = document.querySelector(`.carret-item[data-id="${idProducte}"]`);
            if (itemElement) {
                itemElement.remove();
            }
            
            // Update total
            document.querySelector('.total-preu').textContent = number_format(data.total, 2, ',', '.') + ' €';
            
            // Update cart count in header
            document.getElementById('cart-count').textContent = '(' + data.num_items + ')';
            
            // Check if cart is empty
            const items = document.querySelectorAll('.carret-item');
            if (items.length === 0) {
                location.reload();
            }
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error en eliminar el producte');
    }
}

async function buidarCarret() {
    if (!confirm('Estàs segur que vols buidar tot el carret? Aquesta acció no es pot desfer.')) {
        return;
    }

    try {
        const resposta = await fetch('index.php?accio=buidar-carret', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            }
        });

        const data = await resposta.json();

        if (data.success) {
            // Remove all cart items
            const items = document.querySelectorAll('.carret-item');
            items.forEach(item => item.remove());

            // Hide cart items container
            document.querySelector('.carret-items').style.display = 'none';

            // Show empty cart message
            document.querySelector('.carret-buit').style.display = 'block';

            // Update total price to 0
            document.querySelector('.total-preu').textContent = number_format(0, 2, ',', '.') + ' €';

            // Update cart count in header to 0
            document.getElementById('cart-count').textContent = '(0)';

            // Scroll to top of page
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error en buidar el carret');
    }
}

function number_format(number, decimals, dec_point, thousands_sep) {
    return number.toFixed(decimals).replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep);
}
</script>
