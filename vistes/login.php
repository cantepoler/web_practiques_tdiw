<section class="contenidor-form">
    <h2>Iniciar Sessió</h2>

    <?php if (isset($error)): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form id="login-form">
        <label for="email">Correu electrònic:</label>
        <input type="email" name="email" id="email" placeholder="exemple@correu.com" required>
        
        <label for="password">Contrasenya:</label>
        <input type="password" name="password" id="password" placeholder="Introdueix la teva contrasenya" required>
        
        <button type="submit" class="boto-accio">Iniciar sessió</button>
    </form>
    
    <p style="text-align: center; margin-top: 20px; font-size: 14px;">
        No tens compte? <a href="index.php?accio=registre" style="color: #3a86ff; font-weight: 600;">Registrar-se</a>
    </p>
</section>

<script>
document.getElementById('login-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    try {
        const resposta = await fetch('index.php?accio=login&redirect=<?php echo $_GET['redirect'] ?? 'llistar-categories'; ?>', {
            method: 'POST',
            body: formData
        });
        
        const data = await resposta.json();
        
        if (data.success) {
            window.location.href = data.redirect;
        } else {
            document.querySelector('.error-message').textContent = data.error;
            document.querySelector('.error-message').style.display = 'block';
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error en iniciar sessió');
    }
});
</script>

