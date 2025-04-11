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
                <form action="?a=formulario-duvidas" method="post" id="formDuvidas">
                    <div class="form-toggle">
                        <label class="radio">
                            <input type="radio" name="tipo-produto" value="Uniformes" id="uniformes" class="botoes" required>
                            Uniformes
                        </label>
                        <label class="radio">
                            <input type="radio" name="tipo-produto" value="Brindes" id="brindes" class="botoes" required>
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

    <!-- Seção "Por Que Escolher a Nossa Empresa?" -->
    <section class="why-choose-us">
        <h2>Por Que Escolher a Nossa Empresa?</h2>
        <div class="why-content">
            <div class="why-item">
                <img src="assets/images/qualidade.png" alt="Qualidade">
                <h3>Qualidade</h3>
                <p>Trabalhamos com materiais de alta qualidade, assegurando que nossos produtos se destaquem em qualquer situação.</p>
            </div>
            <div class="why-item">
                <img src="assets/images/suporte.png" alt="Suporte">
                <h3>Suporte Dedicado</h3>
                <p>Nossa equipe de atendimento está sempre pronta para ajudar e garantir uma experiência sem complicações.</p>
            </div>
            <div class="why-item">
                <img src="assets/images/personalizacao.png" alt="Personalização">
                <h3>Personalização Exclusiva</h3>
                <p>Oferecemos soluções exclusivas para que cada produto tenha o toque especial que a sua empresa merece.</p>
            </div>
        </div>
    </section>

    <!-- Seção "Depoimentos de Clientes" com animação -->
    <section class="testimonials">
        <h2>Depoimentos de Clientes</h2>
        <div class="testimonial-carousel">
            <div class="testimonial-item">
            <img src="assets/images/logos/colgate.png"alt="Descrição da imagem">
                <p>"Os uniformes personalizados são de excelente qualidade! Ficamos impressionados com a rapidez do atendimento e com o resultado final."</p>
                <span>— Empresa X</span>
            </div>
            <div class="testimonial-item">
            <img src="assets/images/logos/colgate.png"alt="Descrição da imagem">
                <p>"Recebemos nossos brindes personalizados e estamos muito satisfeitos. Com certeza faremos novos pedidos."</p>
                <span>— Empresa Y</span>
            </div>
            <div class="testimonial-item">
            <img src="assets/images/logos/colgate.png"alt="Descrição da imagem">
                <p>"A equipe foi extremamente atenciosa e o processo foi muito fácil. Os brindes ficaram incríveis!"</p>
                <span>— Empresa Z</span>
            </div>
        </div>
    </section>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/gh/plentz/jquery-maskmoney@master/dist/jquery.maskMoney.min.js"></script>
<script src="assets/js/script.js"></script>
<script src="assets/js/enviarEmailDuvidas.js"></script>

<script>
let currentTestimonial = 0;
const testimonials = document.querySelectorAll('.testimonial-item');

// Função para exibir o depoimento com animação de entrada
function showTestimonial(index) {
    testimonials.forEach((item, idx) => {
        item.style.display = idx === index ? 'block' : 'none';
        item.classList.remove("fade-in");
    });
    testimonials[index].classList.add("fade-in");
}

function nextTestimonial() {
    currentTestimonial = (currentTestimonial + 1) % testimonials.length;
    showTestimonial(currentTestimonial);
}

// Inicialize o carrossel
showTestimonial(currentTestimonial);
setInterval(nextTestimonial, 3000);
</script>
