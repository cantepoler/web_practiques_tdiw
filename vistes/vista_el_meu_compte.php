<section class="contenidor-form">
    <h2>El Meu Compte</h2>
    
    <?php if (isset($success)): ?>
        <div class="success-message"><?php echo $success; ?></div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="error-message visible"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="index.php?accio=el-meu-compte" method="POST" enctype="multipart/form-data" id="form-compte">
        <div class="profile-image-section">
            <?php if (!empty($usuari['imatge_perfil'])): ?>
                <img src="<?php echo FILES_PUBLIC_PATH . $usuari['imatge_perfil']; ?>"
                     alt="<?php echo htmlspecialchars($usuari['nom']); ?>" class="current-image">
            <?php else: ?>
                <div class="default-avatar"><?php echo strtoupper(substr(htmlspecialchars($usuari['nom']), 0, 1)); ?></div>
            <?php endif; ?>

            <label for="imatge_perfil">Canviar imatge de perfil:</label>
            <input type="file" name="imatge_perfil" id="imatge_perfil" accept="image/*">
            <span class="error-message" id="error-imatge_perfil"></span>

            <?php if (!empty($usuari['imatge_perfil'])): ?>
                <button type="submit" name="eliminar_imatge" value="1" class="delete-image-btn">Eliminar imatge</button>
            <?php endif; ?>
        </div>
        <label for="nom">Nom complet:</label>
        <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($usuari['nom'] ?? ''); ?>" maxlength="255" placeholder="El teu nom complet" required>
        <span class="error-message" id="error-nom"></span>
        
        <label for="adreca">Adreça:</label>
        <input type="text" name="adreca" id="adreca" value="<?php echo htmlspecialchars($usuari['adreca'] ?? ''); ?>" maxlength="255" placeholder="Carrer, número, pis..." required>
        <span class="error-message" id="error-adreca"></span>
        
        <label for="poblacio">Població:</label>
        <input type="text" name="poblacio" id="poblacio" value="<?php echo htmlspecialchars($usuari['poblacio'] ?? ''); ?>" maxlength="255" placeholder="La teva ciutat" required>
        <span class="error-message" id="error-poblacio"></span>
        
        <label for="codi_postal">Codi Postal:</label>
        <input type="text" name="codi_postal" id="codi_postal" value="<?php echo htmlspecialchars($usuari['codi_postal'] ?? ''); ?>" maxlength="10" placeholder="08001" required>
        <span class="error-message" id="error-codi_postal"></span>

        <button type="submit" class="boto-accio">Actualitzar informació</button>
    </form>
    
    <div class="info-compte">
        <h3>Informació del compte</h3>
        <p><strong>Correu:</strong> <?php echo htmlspecialchars($usuari['email']); ?></p>
        <p><strong>Data de registre:</strong> <?php echo date('d/m/Y', strtotime($usuari['data_registre'] ?? 'now')); ?></p>
    </div>
</section>

<script>
document.getElementById('form-compte').addEventListener('submit', function(e) {
    let valid = true;
    let firstError = null;
    
    function showError(fieldId, message) {
        const field = document.getElementById(fieldId);
        const errorSpan = document.getElementById('error-' + fieldId);
        
        field.classList.add('error');
        errorSpan.textContent = message;
        errorSpan.classList.add('visible');
        
        if (!firstError) firstError = field;
        valid = false;
    }
    
    function clearError(fieldId) {
        const field = document.getElementById(fieldId);
        const errorSpan = document.getElementById('error-' + fieldId);
        
        field.classList.remove('error');
        errorSpan.textContent = '';
        errorSpan.classList.remove('visible');
    }
    
    clearError('nom');
    clearError('adreca');
    clearError('poblacio');
    clearError('codi_postal');
    
    const nom = document.getElementById('nom').value.trim();
    const adreca = document.getElementById('adreca').value.trim();
    const poblacio = document.getElementById('poblacio').value.trim();
    const codi_postal = document.getElementById('codi_postal').value.trim();
    
    if (!nom) {
        showError('nom', 'El nom és obligatori');
    }
    
    if (!adreca) {
        showError('adreca', "L'adreça és obligatòria");
    }
    
    if (!poblacio) {
        showError('poblacio', 'La població és obligatòria');
    }
    
    if (!codi_postal) {
        showError('codi_postal', 'El codi postal és obligatori');
    } else if (!/^\d{5}$/.test(codi_postal)) {
        showError('codi_postal', 'El codi postal ha de tenir 5 dígits');
    }
    
    if (!valid) {
        e.preventDefault();
        if (firstError) firstError.focus();
    }
});
</script>
