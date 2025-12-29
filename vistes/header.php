<header>
    <div>
        <a href="/" class="static">
            <img src="/img/ham.webp" alt="Logo de BurguerHub" width="30px">
            <span class="page_name">The Burguer House</span>
        </a>
    </div>

    <div class="interactive">
        <div class="cart">
            <a href="#"> <!-- TODO -->
                <img src="/img/carro.png" alt="Carro de la compra" width="20px">
                <span>Carret</span>
            </a> 
                
        </div>
        <div class="login" id="obrir_menu">
            <a href="#">
                <img src="/img/person.svg" alt="Icona d'usuari" width="20px">
                <span>Login</span>
            </a>
            <ul id="desplegable-usuari" class="desplegable-usuari">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="index.php?accio=el-meu-compte">El meu compte</a></li>
                    <li><a href="index.php?accio=les-meves-compres">Les meves compres</a></li>
                    <li><a href="index.php?accio=logout">Tancar sessió</a></li>
                <?php else: ?>
                    <li><a href="index.php?accio=login">Iniciar sessió</a></li>
                    <li><a href="index.php?accio=registre">Registrar-se</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>