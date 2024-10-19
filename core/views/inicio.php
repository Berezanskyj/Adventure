<link rel="stylesheet" href="assets/css/home.css">

<main>
        <section class="banner">
            <div class="content">
                <div class="text">
                    <h1>Personalize sem <strong>complicação</strong></h1>
                    <p>Personalize seus uniformes e brindes com facilidade. Soluções de qualidade para destacar sua empresa desde o primeiro pedido.</p>
                </div>
                <div class="form-section">
                    <h2>Dúvidas</h2>
                
                    <form action="?a=formulario-duvidas" method="post">
                    <div class="form-toggle">
                        <label class="radio">
                            <input type="radio" name="tipo-produto" value="Uniformes" id="uniformes" class="botoes" required>
                            Uniformes
                        </label>
                        <label class="radio">
                            <input type="radio" name="tipo-produto" value="Brindes" id="brindes" class="botoes"required>
                            Brindes
                        </label>
                    </div>
                
                        <input type="text" placeholder="Digite seu nome" name="nome_cliente" required>
                        <input type="email" placeholder="Digite seu e-mail" name="email_cliente" required>
                        <textarea placeholder="Digite sua dúvida" cols="5" rows="10" name="duvida" required></textarea>
                        <button type="submit">Enviar</button>
                    </form>
                </div>
            </div>
        </section>
    </main>


<script src="assets/js/script.js"></script>