<section class="contenidor-form">
    <h2>Crear un nou compte</h2>
    
    <form action="index.php?accio=registre" method="POST" id="form-registre" novalidate>
        
        <label for="nom">Nom complet:</label>
        <input type="text" name="nom" id="nom" maxlength="30" placeholder="El teu nom complet" required>
        <span class="error-message" id="error-nom"></span>

        <label for="email">Correu electrònic:</label>
        <input type="email" name="email" id="email" maxlength="30" placeholder="exemple@correu.com" required>
        <span class="error-message" id="error-email"></span>

        <label for="password">Contrasenya:</label>
        <input type="password" name="password" id="password" placeholder="Mínim 6 caràcters" required>
        <span class="error-message" id="error-password"></span>

        <label for="adreca">Adreça:</label>
        <input type="text" name="adreca" id="adreca" maxlength="30" placeholder="Carrer, número, pis..." required>
        <span class="error-message" id="error-adreca"></span>

        <label for="poblacio">Població:</label>
        <input type="text" name="poblacio" id="poblacio" maxlength="30" placeholder="La teva ciutat" required>
        <span class="error-message" id="error-poblacio"></span>

        <label for="cp">Codi Postal:</label>
        <input type="text" name="cp" id="cp" placeholder="08001" required>
        <span class="error-message" id="error-cp"></span>

        <button type="submit" class="boto-accio">Registrar-me</button>
    </form>
</section>

<script>
document.getElementById('form-registre').addEventListener('submit', function(e) {
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
    clearError('email');
    clearError('password');
    clearError('adreca');
    clearError('poblacio');
    clearError('cp');

    const nom = document.getElementById('nom').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const adreca = document.getElementById('adreca').value.trim();
    const poblacio = document.getElementById('poblacio').value.trim();
    const cp = document.getElementById('cp').value.trim();

    if (!nom) {
        showError('nom', 'El nom és obligatori');
    }

    if (!email) {
        showError('email', 'El correu electrònic és obligatori');
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        showError('email', 'El correu electrònic no és vàlid');
    }

    if (!password) {
        showError('password', 'La contrasenya és obligatòria');
    } else if (password.length < 6) {
        showError('password', 'La contrasenya ha de tenir com a mínim 6 caràcters');
    }

    if (!adreca) {
        showError('adreca', "L'adreça és obligatòria");
    }

    if (!poblacio) {
        showError('poblacio', 'La població és obligatòria');
    }

    if (!cp) {
        showError('cp', 'El codi postal és obligatori');
    } else if (!/^\d{5}$/.test(cp)) {
        showError('cp', 'El codi postal ha de tenir 5 dígits');
    }

    if (!valid) {
        e.preventDefault();
        if (firstError) firstError.focus();
    }
});
</script>