async function carregarProductes(idCategoria) {
    const resposta = await fetch(`index.php?accio=llistar-productes&categoria_id=${idCategoria}`)
    const productes = await resposta.text()
    let contingut = document.getElementById("caca")
    contingut.innerHTML = productes
}

async function carregarDetallProducte(idProducte) {
    const resposta = await fetch(`index.php?accio=detall-producte&id=${idProducte}`)
    const producte = await resposta.text()
    let contingut = document.getElementById("caca")
    contingut.innerHTML = producte
}

async function actualitzarCountCarret() {
    try {
        const resposta = await fetch('index.php?accio=carret-count');
        const data = await resposta.json();
        document.getElementById('cart-count').textContent = '(' + data.count + ')';
    } catch (error) {
        console.error('Error updating cart count:', error);
    }
}

async function afegirAlCarret(event, form) {
    event.preventDefault();
    event.stopPropagation();

    const formData = new FormData(form);

    try {
        const resposta = await fetch('index.php?accio=afegir-al-carret', {
            method: 'POST',
            body: formData
        });

        const data = await resposta.json();

        if (data.success) {
            document.getElementById('cart-count').textContent = '(' + data.num_items + ')';
            alert('Producte afegit al carret!');
        } else {
            alert('Error: ' + (data.error || 'No s\'ha pogut afegir el producte'));
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error en afegir el producte al carret');
    }
}

async function confirmarCompra() {
    if (!confirm('Estàs segur que vols confirmar aquesta comanda?')) {
        return;
    }

    try {
        const resposta = await fetch('index.php?accio=processar-comanda', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            }
        });

        const data = await resposta.json();

        if (data.success) {
            // Update cart count to 0
            document.getElementById('cart-count').textContent = '(0)';
            // Redirect to confirmation page
            window.location.href = `index.php?accio=confirmacio&id=${data.comanda_id}`;
        } else {
            alert('Error: ' + (data.error || 'No s\'ha pogut processar la comanda'));
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error en processar la comanda');
    }
}

