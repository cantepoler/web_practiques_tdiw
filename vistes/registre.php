<section class="contenidor-form">
    <h2>Crear un nou compte</h2>
    
    <form action="index.php?accio=registre" method="POST">
        
        <label for="nom">Nom complet:</label>
        <input type="text" name="nom" id="nom" maxlength="30" required>

        <label for="email">Correu electrònic:</label>
        <input type="email" name="email" id="email" maxlength="30" required>

        <label for="password">Contrasenya:</label>
        <input type="password" name="password" id="password" required>

        <label for="adreca">Adreça:</label>
        <input type="text" name="adreca" id="adreca" maxlength="30" required>

        <label for="poblacio">Població:</label>
        <input type="text" name="poblacio" id="poblacio" maxlength="30" required>

        <label for="cp">Codi Postal:</label>
        <input type="text" name="cp" id="cp" pattern="^\d{5}$" title="5 dígits" required>

        <button type="submit" class="boto-accio">Registrar-me</button>
    </form>
</section>