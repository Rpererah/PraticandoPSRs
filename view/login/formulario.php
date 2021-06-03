<?php include __DIR__ . './../header.php'; ?>

    <form action="/realizaLogin" method="post" >
        <div class="form-group">
            <label for="Email">Email:</label>
            <input type="email" name="Email" id="Email" class="form-control mb-2"/>

            <label for="Senha">Senha:</label>
            <input type="password" name="Senha" id="Senha" class="form-control mb-2"/>
            
            <button class="btn btn-primary">Entrar</button>
        </div>


    </form>

<?php include __DIR__ . './../footer.php'; ?>