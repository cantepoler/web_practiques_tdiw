async function actualitzarCountCarret() {
    try {
        const resposta = await fetch('index.php?accio=carret-count');
        const data = await resposta.json();
        document.getElementById('cart-count').textContent = '(' + data.count + ')';
    } catch (error) {
        console.error('Error updating cart count:', error);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form[action="index.php?accio=afegir-al-carret"]');
    forms.forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
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
        });
    });
});
