<section class="contenidor-form">
    <h2>El Meu Compte</h2>
    
    <?php if (isset($success)): ?>
        <div class="success-message"><?php echo $success; ?></div>
    <?php endif; ?>
    
    <?php if (isset($error)): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form action="index.php?accio=el-meu-compte" method="POST">
        <label for="nom">Nom complet:</label>
        <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($usuari['nom'] ?? ''); ?>" maxlength="255" required>
        
        <label for="adreca">Adreça:</label>
        <input type="text" name="adreca" id="adreca" value="<?php echo htmlspecialchars($usuari['adreca'] ?? ''); ?>" maxlength="255" required>
        
        <label for="poblacio">Població:</label>
        <input type="text" name="poblacio" id="poblacio" value="<?php echo htmlspecialchars($usuari['poblacio'] ?? ''); ?>" maxlength="255" required>
        
        <label for="codi_postal">Codi Postal:</label>
        <input type="text" name="codi_postal" id="codi_postal" value="<?php echo htmlspecialchars($usuari['codi_postal'] ?? ''); ?>" maxlength="10" required>
        
        <button type="submit" class="boto-accio">Actualitzar informació</button>
    </form>
    
    <div class="info-compte">
        <h3>Informació del compte</h3>
        <p><strong>Correu:</strong> <?php echo htmlspecialchars($usuari['email']); ?></p>
        <p><strong>Data de registre:</strong> <?php echo date('d/m/Y', strtotime($usuari['data_registre'] ?? 'now')); ?></p>
    </div>
</section>

<style>
.success-message {
    background: #d1fae5;
    color: #065f46;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
    text-align: center;
}

.info-compte {
    margin-top: 30px;
    padding: 20px;
    background: #f9fafb;
    border-radius: 8px;
}

.info-compte h3 {
    margin-bottom: 15px;
    color: #1f2937;
}

.info-compte p {
    margin: 8px 0;
    color: #4b5563;
}
</style>
