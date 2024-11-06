<link rel="stylesheet" href="assets/css/sobre.css">

<main>
    <section class="about-banner">
        <div class="content">
            <div class="about-text">
                <h1>Sobre Nós</h1>
                <p>Somos uma empresa especializada em personalização de uniformes e brindes corporativos, 
                focada em oferecer soluções de alta qualidade para destacar a imagem da sua marca.</p>
                <p>Desde o primeiro contato até a entrega do produto final, nossa missão é simplificar o processo de personalização para nossos clientes, garantindo sempre um atendimento de excelência e resultados que superam as expectativas.</p>
            </div>
            <div class="about-image">
                <img src="assets/images/equipe.png" alt="Nossa equipe">
            </div>
        </div>
    </section>

    <!-- Carrossel de logos de clientes -->
    <section class="clients-carousel">
    <h2>Nossos Clientes</h2>
    <div class="carousel-container">
        <button class="carousel-control prev" onclick="changeSlide(-1)">&#10094;</button>
        <div class="carousel-track">
            <img src="assets/images/logos/colgate.png" alt="Cliente 1">
            <img src="assets/images/logos/colgate.png" alt="Cliente 2">
            <img src="assets/images/logos/colgate.png" alt="Cliente 3">
            <img src="assets/images/logos/colgate.png" alt="Cliente 3">
            <img src="assets/images/logos/colgate.png" alt="Cliente 3">
            <img src="assets/images/logos/colgate.png" alt="Cliente 3">
            <img src="assets/images/logos/colgate.png" alt="Cliente 3">
            <img src="assets/images/logos/colgate.png" alt="Cliente 3">
            <img src="assets/images/logos/colgate.png" alt="Cliente 3">
        </div>
        <button class="carousel-control next" onclick="changeSlide(1)">&#10095;</button>
    </div>
</section>

    <!-- Mapa da localização da loja -->
    <section class="location">
        <h2>Localização</h2>
        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.0198729901296!2d-122.419415084681!3d37.774929279759!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80858064d6a58cdb%3A0x7a0b2c35b22227f1!2sFake%20Store%20Location!5e0!3m2!1sen!2sus!4v1234567890"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
</main>

<script>




let slideIndex = 0;
const totalSlides = 3   ; // Número total de imagens no carrossel
let autoSlideInterval;

function changeSlide(n) {
    const track = document.querySelector('.carousel-track');
    const items = document.querySelectorAll('.carousel-track img');
    
    slideIndex += n;

    // Ajuste para manter o carrossel dentro dos limites
    if (slideIndex < 0) {
        slideIndex = totalSlides - 1;
    } else if (slideIndex >= totalSlides) {
        slideIndex = 0;
    }

    track.style.transform = `translateX(-${slideIndex * (items[0].offsetWidth + 20)}px)`;
}

// Função para iniciar o carrossel automático
function startAutoSlide() {
    autoSlideInterval = setInterval(() => changeSlide(1), 3000); // Muda a cada 3 segundos
}

// Função para parar o carrossel automático ao passar o mouse
function stopAutoSlide() {
    clearInterval(autoSlideInterval);
}

// Inicia o carrossel automático
startAutoSlide();

// Event listeners para parar o carrossel ao passar o mouse
const carouselContainer = document.querySelector('.carousel-container');
carouselContainer.addEventListener('mouseover', stopAutoSlide);
carouselContainer.addEventListener('mouseout', startAutoSlide);
</script>
