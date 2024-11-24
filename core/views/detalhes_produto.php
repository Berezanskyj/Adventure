<link rel="stylesheet" href="assets/css/detalhes_produtos.css">

<div class="product-details-container">
    <!-- Canvas para Preview -->
    <div class="product-image" id="product-preview">
        <canvas id="product-canvas" width="600" height="600"></canvas>
    </div>

    <!-- Informações do Produto -->
    <div class="product-info">
        <h1>Camisa Casual Slim Fit</h1>
        <p class="description">
            Camisa de alta qualidade, feita com algodão premium, ideal para ocasiões casuais e formais. Disponível em diferentes tamanhos e cores.
        </p>
        <h2 class="price">R$ 149,90</h2>

        <!-- Personalizações -->
        <div class="customization-options">
            <!-- Escolha de Cor -->
            <div class="option-group">
                <label for="color">Escolha a Cor:</label>
                <select id="color" name="color" onchange="updatePreview()">
                    <option value="preto" data-image="assets/images/produtos/camiseta-1-preta.png">Preto</option>
                    <option value="branco" data-image="assets/images/produtos/camiseta-1.png">Branco</option>
                    <option value="azul" data-image="assets/images/produtos/camiseta-1-azul.png">Azul</option>
                    <option value="vermelho" data-image="assets/images/produtos/camiseta-1-vermelha.png">Vermelho</option>
                </select>
            </div>

            <!-- Upload de Imagem -->
            <div class="option-group">
                <label for="upload-image">Carregar uma imagem:</label>
                <input type="file" id="upload-image" accept="image/*" onchange="addUploadedImage(event)">
            </div>

            <!-- Adicionar Texto -->
            <div class="option-group">
                <label for="custom-text">Adicionar Texto:</label>
                <input type="text" id="custom-text" placeholder="Digite algo" oninput="addCustomText(event)">
            </div>

            <div class="option-group">
                <label for="text-color">Escolha a cor do texto:</label>
                <input type="color" id="text-color" value="#ffffff" onchange="updateTextColor(event)">
            </div>
        </div>


        <!-- Escolha de Tamanho -->
        <div class="option-group">
            <label for="size">Escolha o Tamanho:</label>
            <select id="size" name="size" onchange="updateSizePreview()">
                <option value="pp">PP</option>
                <option value="p">P</option>
                <option value="m">M</option>
                <option value="g">G</option>
                <option value="gg">GG</option>
            </select>
        </div>

        <!-- Botões de Ação -->
            <div class="action-buttons">
                <button class="btn add-to-cart">Adicionar ao Carrinho</button>
                <button class="btn buy-now">Comprar Agora</button>
            </div>
    </div>

    
</div>
</div>

<script>
    // Variáveis para manipulação do Canvas
    const canvas = document.getElementById('product-canvas');
    const ctx = canvas.getContext('2d');

    // Carregar a imagem inicial do produto
    const productImage = new Image();
    productImage.src = "assets/images/produtos/camiseta-1-preta.png";
    productImage.onload = () => {
        ctx.drawImage(productImage, 0, 0, canvas.width, canvas.height);
    };

    // Variáveis para controle do drag and drop
    let isDragging = false;
    let dragElement = null;
    let dragOffsetX = 0;
    let dragOffsetY = 0;

    const elements = [];

    // Atualizar imagem de acordo com a cor selecionada
    function updatePreview() {
        const colorSelect = document.getElementById('color');
        const selectedOption = colorSelect.options[colorSelect.selectedIndex];
        const newImage = selectedOption.getAttribute('data-image');

        productImage.src = newImage;
        productImage.onload = () => {
            redrawCanvas();
        };
    }

    // Função para adicionar imagem ao canvas e torná-la arrastável
    function addUploadedImage(event) {
        const file = event.target.files[0];
        if (file) {
            const uploadedImage = new Image();
            uploadedImage.src = URL.createObjectURL(file);
            uploadedImage.onload = () => {
                const newElement = {
                    type: 'image',
                    image: uploadedImage,
                    x: 50,
                    y: 50,
                    width: 100,
                    height: 100,
                };
                elements.push(newElement);
                redrawCanvas();
            };
        }
    }

    // Função para adicionar texto ao canvas e torná-lo arrastável
    function addCustomText(event) {
    const text = event.target.value; // Captura o texto do input
    const existingTextElement = elements.find(el => el.type === 'text'); // Procura texto existente

    if (existingTextElement) {
        existingTextElement.text = text; // Atualiza texto existente
    } else {
        // Adiciona novo texto
        elements.push({
            type: 'text',
            text: text,
            x: 50,
            y: 350,
            font: '20px Arial',
            color: '#ffffff', // Cor padrão inicial
        });
    }
    redrawCanvas(); // Redesenha o canvas
}

    // Função para atualizar a cor do texto
    function updateTextColor(event) {
    const color = event.target.value; // Captura o valor da cor
    const textElement = elements.find(el => el.type === 'text'); // Encontra o texto

    if (textElement) {
        textElement.color = color; // Atualiza a cor do texto
        redrawCanvas(); // Redesenha o canvas
    } else {
        console.log("Nenhum texto foi adicionado ainda."); // Log de depuração
    }
}

    // Função para redesenhar todos os elementos no canvas
    function redrawCanvas() {
    ctx.clearRect(0, 0, canvas.width, canvas.height); // Limpa o canvas

    // Redesenha a imagem do produto
    ctx.drawImage(productImage, 0, 0, canvas.width, canvas.height);

    // Redesenha todos os elementos
    elements.forEach(el => {
        if (el.type === 'image') {
            ctx.drawImage(el.image, el.x, el.y, el.width, el.height);
        } else if (el.type === 'text') {
            ctx.font = el.font;
            ctx.fillStyle = el.color; // Define a cor do texto
            ctx.fillText(el.text, el.x, el.y);
        }
    });
}

    // Detectar clique no canvas
    canvas.addEventListener('mousedown', (e) => {
        const mouseX = e.offsetX;
        const mouseY = e.offsetY;

        // Verificar se clicou em algum elemento
        dragElement = elements.find(el => {
            if (el.type === 'image') {
                return mouseX >= el.x && mouseX <= el.x + el.width &&
                    mouseY >= el.y && mouseY <= el.y + el.height;
            } else if (el.type === 'text') {
                const textWidth = ctx.measureText(el.text).width;
                return mouseX >= el.x && mouseX <= el.x + textWidth &&
                    mouseY >= el.y - 20 && mouseY <= el.y; // Considerar altura do texto
            }
        });

        if (dragElement) {
            isDragging = true;
            dragOffsetX = mouseX - dragElement.x;
            dragOffsetY = mouseY - dragElement.y;
        }
    });

    // Detectar movimento do mouse
    canvas.addEventListener('mousemove', (e) => {
        if (isDragging && dragElement) {
            const mouseX = e.offsetX;
            const mouseY = e.offsetY;

            dragElement.x = mouseX - dragOffsetX;
            dragElement.y = mouseY - dragOffsetY;
            redrawCanvas();
        }
    });

    // Finalizar o drag
    canvas.addEventListener('mouseup', () => {
        isDragging = false;
        dragElement = null;
    });

    // Cancelar o drag ao sair do canvas
    canvas.addEventListener('mouseleave', () => {
        isDragging = false;
        dragElement = null;
    });
</script>