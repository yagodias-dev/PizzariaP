<?php
// Iniciar sessão para possíveis funcionalidades futuras
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pizzaria Primicia - Delivery | Gastronomia Italiana Autêntica</title>
    <meta
      name="description"
      content="Pizzaria Primicia - Tradição italiana em cada fatia. Delivery premium com ingredientes selecionados e receitas tradicionais."
    />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
<header id="header">
  <nav>
    <img src="img/logo.png" alt="" href="index.php" class="logo">
    <!-- Menu Desktop -->
    <ul class="nav-links" id="nav-links">
      <li><a href="#home"><i class="fa-solid fa-house"></i> Início</a></li>
      <li><a href="#menu"><i class="fa-solid fa-utensils"></i> Cardápio</a></li>
      <li><a href="#about"><i class="fa-solid fa-info-circle"></i> Nossa História</a></li>
      <li><a href="#contact"><i class="fa-solid fa-phone"></i> Contato</a></li>
    </ul>

    <!-- Botão Mobile -->
    <div class="mobile-menu" id="mobile-menu">
      <span></span>
      <span></span>
      <span></span>
    </div>

    <!-- Carrinho -->
    <div class="cart-badge" onclick="window.location.href='carrinho.php'">
      🛒
      <span class="cart-count" id="cart-count">0</span>
    </div>
  </nav>
</header>

    <main>
      <section id="home" class="hero">
        <div class="hero-content">
          <div class="hero-subtitle">Lorem ipsum dolor.</div>
          <h1 class="serif">Lorem ipsum</h1>
          <p class="hero-description">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum
            pariatur, nobis tempora commodi doloribus fugiat aspernatur nesciunt
            corrupti harum, quia architecto perferendis voluptatem obcaecati ex!
            Quam dolorem velit architecto soluta!
          </p>
          <div class="cta-group">
            <a href="#menu" class="cta-button"><i class="fa-solid fa-utensils"></i> Explorar Cardápio</a>
            <a href="#contact" class="cta-button cta-secondary"><i class="fa-solid fa-shopping-cart"></i> Fazer Pedido</a>
          </div>
        </div>
      </section>

      <section id="menu" class="menu">
        <div class="container">
          <div class="section-header fade-in">
            <div class="section-subtitle">Nossos Sabores</div>
            <h2 class="section-title serif">Cardápio Selecionado</h2>
            <p class="section-description">
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nam modi
              suscipit libero, quam amet neque ducimus sit blanditiis expedita
              consequuntur atque impedit similique incidunt quia! Alias eius id
              quod! Hic?
            </p>
          </div>

          <div class="menu-categories fade-in">
            <button class="category-btn active"><i class="fa-solid fa-pizza-slice"></i> Tradicionais</button>
            <button class="category-btn"><i class="fa-solid fa-star"></i> Premium</button>
            <button class="category-btn"><i class="fa-solid fa-crown"></i> Especiais</button>
            <button class="category-btn"><i class="fa-solid fa-leaf"></i> Vegetarianas</button>
          </div>

          <div class="menu-grid">
            <article class="menu-item fade-in">
              <div class="menu-item-image">
                <img
                  src="img/pexels-pablo-macedo-287472-845802.jpg"
                  alt="Pizza Margherita"
                  class="menu-img"
                />
              </div>
              <div class="menu-item-content">
                <h3 class="serif">Margherita Clássica</h3>
                <p class="menu-item-description">
                  Molho de tomate San Marzano, mussarela di bufala, manjericão
                  fresco DOP e azeite extravirgem toscano. A essência da pizza
                  napolitana.
                </p>
                <div class="menu-item-footer">
                  <span class="price serif">R$ 45,90</span>
                  <button
                    class="add-to-cart"
                    onclick="addToCart('Margherita Clássica', 45.90)"
                  >
                    <i class="fa-solid fa-plus"></i> Adicionar
                  </button>
                </div>
              </div>
            </article>

            <article class="menu-item fade-in">
              <div class="menu-item-image">
                <img
                  src="img/pexels-horizon-content-2100060-3762075.jpg"
                  alt="Pizza Quattro Stagioni"
                  class="menu-img"
                />
              </div>
              <div class="menu-item-content">
                <h3 class="serif">Quattro Stagioni</h3>
                <p class="menu-item-description">
                  Uma viagem pelas quatro estações: presunto de Parma, cogumelos
                  porcini, alcachofras marinadas e azeitonas Kalamata sobre base
                  de molho branco.
                </p>
                <div class="menu-item-footer">
                  <span class="price serif">R$ 58,90</span>
                  <button
                    class="add-to-cart"
                    onclick="addToCart('Quattro Stagioni', 58.90)"
                  >
                    <i class="fa-solid fa-plus"></i> Adicionar
                  </button>
                </div>
              </div>
            </article>

            <article class="menu-item fade-in">
              <div class="menu-item-image">
                <img
                  src="img/pexels-enginakyurt-2619970.jpg"
                  alt="Pizza Diavola Premium"
                  class="menu-img"
                />
              </div>
              <div class="menu-item-content">
                <h3 class="serif">Diavola Premium</h3>
                <p class="menu-item-description">
                  Molho de tomate artesanal, mussarela premium, salame piccante
                  calabrês, pimentas frescas e mel de acácia para equilibrar o
                  sabor.
                </p>
                <div class="menu-item-footer">
                  <span class="price serif">R$ 52,90</span>
                  <button
                    class="add-to-cart"
                    onclick="addToCart('Diavola Premium', 52.90)"
                  >
                    <i class="fa-solid fa-plus"></i> Adicionar
                  </button>
                </div>
              </div>
            </article>

            <article class="menu-item fade-in">
              <div class="menu-item-image">
                <img
                  src="img/pexels-jeshoots-3644.jpg"
                  alt="Pizza Tartufo Bianco"
                  class="menu-img"
                />
              </div>
              <div class="menu-item-content">
                <h3 class="serif">Tartufo Bianco</h3>
                <p class="menu-item-description">
                  Base branca com creme de trufa, mussarela de búfala, rúcula
                  selvagem, tomates cereja confitados e lascas de parmesão
                  reggiano 24 meses.
                </p>
                <div class="menu-item-footer">
                  <span class="price serif">R$ 68,90</span>
                  <button
                    class="add-to-cart"
                    onclick="addToCart('Tartufo Bianco', 68.90)"
                  >
                    <i class="fa-solid fa-plus"></i> Adicionar
                  </button>
                </div>
              </div>
            </article>

            <article class="menu-item fade-in">
              <div class="menu-item-image">
                <img
                  src="img/pexels-catscoming-367915.jpg"
                  alt="Pizza Vegetariana Mediterrânea"
                  class="menu-img"
                />
              </div>
              <div class="menu-item-content">
                <h3 class="serif">Vegetariana Mediterrânea</h3>
                <p class="menu-item-description">
                  Berinjelas grelhadas, abobrinha italiana, pimentões assados,
                  queijo de cabra, azeitonas negras e ervas provençais sobre
                  molho pesto.
                </p>
                <div class="menu-item-footer">
                  <span class="price serif">R$ 49,90</span>
                  <button
                    class="add-to-cart"
                    onclick="addToCart('Vegetariana Mediterrânea', 49.90)"
                  >
                    <i class="fa-solid fa-plus"></i> Adicionar
                  </button>
                </div>
              </div>
            </article>

            <article class="menu-item fade-in">
              <div class="menu-item-image">
                <img
                  src="img/pexels-pixabay-280453.jpg"
                  alt="Pizza Prosciutto e Arugula"
                  class="menu-img"
                />
              </div>
              <div class="menu-item-content">
                <h3 class="serif">Prosciutto e Arugula</h3>
                <p class="menu-item-description">
                  Pizza branca com presunto de Parma DOP, rúcula fresca, tomates
                  cereja, mussarela di bufala e redução de vinagre balsâmico de
                  Modena.
                </p>
                <div class="menu-item-footer">
                  <span class="price serif">R$ 62,90</span>
                  <button
                    class="add-to-cart"
                    onclick="addToCart('Prosciutto e Arugula', 62.90)"
                  >
                    <i class="fa-solid fa-plus"></i> Adicionar
                  </button>
                </div>
              </div>
            </article>
          </div>
        </div>
      </section>

      <section id="about" class="about">
        <div class="container">
          <div class="section-header fade-in">
            <div class="section-subtitle">Nossa Tradição</div>
            <h2 class="section-title serif">História de Paixão</h2>
          </div>

          <div class="about-content">
            <div class="about-text fade-in">
              <p>
                Lorem ipsum dolor sit <strong>Pizzaria Primicia</strong> amet consectetur adipisicing elit. Voluptates aliquam hic impedit recusandae. Quasi officiis repellat sit labore, reprehenderit facilis, totam corporis eligendi modi nisi obcaecati et molestiae suscipit animi. !
              </p>

              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, officiis eos provident labore magni ipsa nulla ipsum, dignissimos neque facilis recusandae repellendus. Mollitia tempora beatae a officiis provident corrupti quaerat?
              </p>

              <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus incidunt, aliquam laudantium vero, possimus commodi quas expedita consequatur quia rerum officia cupiditate perspiciatis ratione labore? Ullam tenetur nostrum ratione odio?
              </p>

              <div class="stats">
                <div class="stat-item">
                  <span class="stat-number serif">16</span>
                  <div class="stat-label">Anos de Tradição</div>
                </div>
                <div class="stat-item">
                  <span class="stat-number serif">50k+</span>
                  <div class="stat-label">Pizzas Entregues</div>
                </div>
                <div class="stat-item">
                  <span class="stat-number serif">98%</span>
                  <div class="stat-label">Satisfação</div>
                </div>
                <div class="stat-item">
                  <span class="stat-number serif">25min</span>
                  <div class="stat-label">Tempo Médio</div>
                </div>
              </div>
            </div>
            <div class="about-image fade-in"><img src="img/chef.jpg" alt="Chef da Pizzaria"></div>
          </div>
        </div>
      </section>

      <section id="contact" class="contact">
        <div class="container">
          <div class="section-header fade-in">
            <div class="section-subtitle">Fale Conosco</div>
            <h2 class="section-title serif">Contato & Pedidos</h2>
            <p class="section-description">
              Entre em contato conosco para fazer seu pedido ou esclarecer
              dúvidas. Nossa equipe está pronta para proporcionar a melhor
              experiência gastronômica.
            </p>
          </div>

          <div class="contact-grid">
            <div class="contact-info fade-in">
              <h3 class="serif"><i class="fa-solid fa-info-circle"></i> Informações de Contato</h3>

              <div class="contact-item">
                <div class="contact-icon"><i class="fa-solid fa-location-dot"></i></div>
                <div class="contact-details">
                  <h4>Endereço Principal</h4>
                  <p>
                    Avenida Presidente Tancredo Neves, 3105 <br />
                    Jardim Alice - São Paulo, SP<br />
                    CEP: 01310-100
                  </p>
                </div>
              </div>

              <div class="contact-item">
                <div class="contact-icon"><i class="fa-solid fa-phone"></i></div>
                <div class="contact-details">
                  <h4>Central de Atendimento</h4>
                  <p>
                    Telefone: (11) 3256-8900<br />
                    WhatsApp: (11) 99845-7623<br />
                    Delivery: (11) 3256-8901
                  </p>
                </div>
              </div>

              <div class="contact-item">
                <div class="contact-icon"><i class="fa-solid fa-clock"></i></div>
                <div class="contact-details">
                  <h4>Horários de Funcionamento</h4>
                  <p>
                    Terça a Domingo<br />
                    18h00 às 23h45<br />
                    <em>Segundas: Fechado</em>
                  </p>
                </div>
              </div>

              <div class="contact-item">
                <div class="contact-icon"><i class="fa-solid fa-envelope"></i></div>
                <div class="contact-details">
                  <h4>E-mail Corporativo</h4>
                  <p>
                    contato@pizzariaprimicia.com.br<br />
                    pedidos@pizzariaprimicia.com.br<br />
                    eventos@pizzariaprimicia.com.br
                  </p>
                </div>
              </div>
            </div>

            <form
              class="order-form fade-in"
              onsubmit="handleOrderSubmit(event)"
            >
              <h3 class="serif"><i class="fa-solid fa-shopping-cart"></i> Realizar Pedido</h3>

              <div class="form-group">
                <label for="customer-name"><i class="fa-solid fa-user"></i> Nome Completo *</label>
                <input
                  type="text"
                  id="customer-name"
                  name="customerName"
                  required
                />
              </div>

              <div class="form-group">
                <label for="customer-phone"><i class="fa-solid fa-phone"></i> Telefone para Contato *</label>
                <input
                  type="tel"
                  id="customer-phone"
                  name="customerPhone"
                  required
                />
              </div>

              <div class="form-group">
                <label for="customer-email"><i class="fa-solid fa-envelope"></i> E-mail</label>
                <input type="email" id="customer-email" name="customerEmail" />
              </div>

              <div class="form-group">
                <label for="delivery-address"><i class="fa-solid fa-map-marker-alt"></i> Endereço Completo para Entrega *</label>
                <textarea
                  id="delivery-address"
                  name="deliveryAddress"
                  rows="3"
                  required
                  placeholder="Rua, número, complemento, bairro, CEP"
                ></textarea>
              </div>

              <div class="form-group">
                <label for="payment-method"><i class="fa-solid fa-credit-card"></i> Forma de Pagamento *</label>
                <select id="payment-method" name="paymentMethod" required>
                  <option value="">Selecione a forma de pagamento</option>
                  <option value="dinheiro">Dinheiro</option>
                  <option value="cartao-debito">Cartão de Débito</option>
                  <option value="cartao-credito">Cartão de Crédito</option>
                  <option value="pix">PIX</option>
                  <option value="vale-refeicao">Vale Refeição</option>
                </select>
              </div>

              <div class="form-group">
                <label for="order-notes"><i class="fa-solid fa-edit"></i> Observações Especiais</label>
                <textarea
                  id="order-notes"
                  name="orderNotes"
                  rows="3"
                  placeholder="Instruções especiais, alergias, preferências de entrega, etc."
                ></textarea>
              </div>

              <button type="submit" class="form-button">
                <i class="fa-solid fa-check"></i> Confirmar Pedido
              </button>
            </form>
          </div>
        </div>
      </section>
    </main>

<footer>
  <div class="container">
    <div class="footer-content">
      <div class="footer-section">
        <h3 class="serif"><i class="fa-solid fa-pizza-slice"></i> Pizzaria Primicia</h3>
        <p>
          Tradição italiana desde 2008. Especializada em pizzas artesanais
          com ingredientes premium e receitas autênticas transmitidas
          através de gerações.
        </p>
        <br />
        <p><strong>CNPJ:</strong> 12.345.678/0001-90</p>
      </div>

      <div class="footer-section">
        <h3 class="serif"><i class="fa-solid fa-bars"></i> Navegação</h3>
        <a href="#home">Início</a><br />
        <a href="#menu">Cardápio Completo</a><br />
        <a href="#about">Nossa História</a><br />
        <a href="#contact">Contato & Pedidos</a><br />
        <a href="#">Política de Privacidade</a><br />
        <a href="#">Termos de Uso</a>
      </div>

      <div class="footer-section">
        <h3 class="serif"><i class="fa-solid fa-headset"></i> Atendimento</h3>
        <p>
          <i class="fa-solid fa-location-dot"></i> Avenida Presidente Tancredo Neves, 3105 - Jardim Alice<br />
          <i class="fa-solid fa-phone"></i> (11) 3256-8900 | <i class="fa-solid fa-mobile-screen-button"></i> (11) 99845-7623<br />
          <i class="fa-solid fa-envelope"></i> contato@pizzariaprimicia.com.br<br />
          <i class="fa-regular fa-clock"></i> Ter-Dom: 18h às 23h45<br />
          <i class="fa-solid fa-truck"></i> Delivery em toda São Paulo
        </p>
      </div>

      <div class="footer-section">
        <h3 class="serif"><i class="fa-solid fa-share-alt"></i> Conecte-se</h3>
        <a href="#"><i class="fa-brands fa-instagram"></i> Instagram @pizzariaprimicia</a><br />
        <a href="#"><i class="fa-brands fa-facebook"></i> Facebook /pizzariaprimicia</a><br />
        <a href="#"><i class="fa-brands fa-whatsapp"></i> WhatsApp Business</a><br />
        <a href="#"><i class="fa-solid fa-utensils"></i> iFood & Uber Eats</a><br />
        <a href="#"><i class="fa-regular fa-newspaper"></i> Newsletter Exclusiva</a><br />
        <a href="#"><i class="fa-solid fa-gift"></i> Programa Fidelidade</a>
      </div>
    </div>

    <div class="footer-bottom">
      <p>
        &copy; 2024 Pizzaria Primicia Delivery. Todos os direitos
        reservados. | Desenvolvido com paixão pela gastronomia italiana.
      </p>
    </div>
  </div>
</footer>



    <script>
  // Recupera carrinho do localStorage
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  let cartTotal = 0;

  // Header scroll effect
  window.addEventListener("scroll", function () {
    const header = document.getElementById("header");
    if (window.scrollY > 100) {
      header.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
    }
  });

  // Mobile menu toggle
  document
    .getElementById("mobile-menu")
    .addEventListener("click", function () {
      const navLinks = document.getElementById("nav-links");
      navLinks.classList.toggle("active");

      // Animate hamburger menu
      const spans = this.querySelectorAll("span");
      spans[0].style.transform = navLinks.classList.contains("active")
        ? "rotate(45deg) translate(5px, 5px)"
        : "";
      spans[1].style.opacity = navLinks.classList.contains("active")
        ? "0"
        : "1";
      spans[2].style.transform = navLinks.classList.contains("active")
        ? "rotate(-45deg) translate(7px, -6px)"
        : "";
    });

  // Smooth scrolling for navigation links
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute("href"));
      if (target) {
        const headerHeight = document.querySelector("header").offsetHeight;
        const targetPosition = target.offsetTop - headerHeight;

        window.scrollTo({
          top: targetPosition,
          behavior: "smooth",
        });

        // Close mobile menu if open
        const navLinks = document.getElementById("nav-links");
        navLinks.classList.remove("active");
      }
    });
  });

  // Scroll animations
  function animateOnScroll() {
    const elements = document.querySelectorAll(".fade-in");
    elements.forEach((element) => {
      const elementTop = element.getBoundingClientRect().top;
      const elementVisible = 150;

      if (elementTop < window.innerHeight - elementVisible) {
        element.classList.add("visible");
      }
    });
  }

  window.addEventListener("scroll", animateOnScroll);
  animateOnScroll(); // Initial check

  // Category filter (placeholder functionality)
  document.querySelectorAll(".category-btn").forEach((btn) => {
    btn.addEventListener("click", function () {
      document
        .querySelectorAll(".category-btn")
        .forEach((b) => b.classList.remove("active"));
      this.classList.add("active");
    });
  });

  // Adicionar item ao carrinho
  function addToCart(name, price, image = "") {
    const existingItem = cart.find((item) => item.name === name);

    if (existingItem) {
      existingItem.quantity += 1;
    } else {
      cart.push({ name, price, quantity: 1, image });
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    updateCartCount();

    // Feedback no botão
    const button = event.target;
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fa-solid fa-check"></i> Adicionado!';
    button.style.background = "var(--accent-gold)";
    button.style.color = "var(--primary-dark)";

    setTimeout(() => {
      button.innerHTML = originalText;
      button.style.background = "";
      button.style.color = "";
    }, 1500);
  }

  // Atualiza contador do carrinho
  function updateCartCount() {
    const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
    const cartCount = document.getElementById("cart-count");
    cartCount.textContent = totalItems;

    if (totalItems > 0) {
      cartCount.style.display = "flex";
    } else {
      cartCount.style.display = "none";
    }
  }

  // Form submission
async function handleOrderSubmit(event) {
  event.preventDefault();
  const form = event.target;
  const submitButton = form.querySelector(".form-button");
  const originalText = submitButton.innerHTML;

  // Valida carrinho
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  if (cart.length === 0) {
    alert("Seu carrinho está vazio. Adicione itens antes de confirmar o pedido.");
    return;
  }

  // Preparar FormData
  const formData = new FormData(form);
  formData.append('cart_items', JSON.stringify(cart));

  // Feedback visual
  submitButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Processando...';
  submitButton.disabled = true;

  try {
    const resp = await fetch('processar_pedidos.php', {
      method: 'POST',
      body: formData
    });

    if (!resp.ok) throw new Error('Falha na requisição: ' + resp.status);

    const data = await resp.json();

    if (data.success) {
      // Sucesso: mostrar card de confirmação
      showConfirmationCard(data);
      
      // Limpar carrinho e formulário
      localStorage.removeItem('cart');
      if (typeof updateCartCount === 'function') updateCartCount();
      form.reset();
    } else {
      // Mensagem de erro retornada pelo PHP
      alert('Erro: ' + (data.message || 'Não foi possível processar o pedido.'));
    }
  } catch (err) {
    console.error(err);
    alert('Ocorreu um erro ao enviar o pedido. Verifique o console do navegador ou o log do servidor.');
  } finally {
    submitButton.innerHTML = originalText;
    submitButton.disabled = false;
  }
}

// Função para mostrar o card de confirmação
function showConfirmationCard(data) {
  // Criar overlay e card
  const overlay = document.createElement('div');
  overlay.className = 'confirmation-overlay';
  
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
  
  overlay.innerHTML = `
    <div class="confirmation-card">
      <div class="confirmation-header">
        <i class="fa-solid fa-check-circle"></i>
        <h2>Pedido Confirmado!</h2>
      </div>
      <div class="confirmation-body">
        <p>Seu pedido foi realizado com sucesso!</p>
        <div class="order-details">
          <p><strong>Número do Pedido:</strong> <span>#${data.pedido_id}</span></p>
          <p><strong>Total:</strong> <span>R$ ${data.total}</span></p>
          <p><strong>Status:</strong> <span>Pendente</span></p>
        </div>
      </div>
      <div class="confirmation-footer">
        <button class="confirmation-button" onclick="viewOrderDetails(${data.pedido_id})">
          Ver Detalhes do Pedido
        </button>
      </div>
    </div>
  `;
  
  document.body.appendChild(overlay);
  
  // Mostrar animação
  setTimeout(() => {
    overlay.classList.add('active');
  }, 10);
  
  // Adicionar evento para fechar ao clicar fora
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay) {
      closeConfirmation();
    }
  });
}

// Função para fechar o card
function closeConfirmation() {
  const overlay = document.querySelector('.confirmation-overlay');
  if (overlay) {
    overlay.classList.remove('active');
    setTimeout(() => {
      overlay.remove();
    }, 300);
  }
}

// Função para visualizar detalhes do pedido
function viewOrderDetails(pedidoId) {
  closeConfirmation();
  window.open(`detalhes_pedido_cliente.php?id=${pedidoId}`, '_blank');
}

// Função para mostrar o card de confirmação
function showConfirmationCard(data) {
  // Criar overlay e card
  const overlay = document.createElement('div');
  overlay.className = 'confirmation-overlay';
  
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
  
  overlay.innerHTML = `
    <div class="confirmation-card">
      <div class="confirmation-header">
        <i class="fa-solid fa-check-circle"></i>
        <h2>Pedido Confirmado!</h2>
      </div>
      <div class="confirmation-body">
        <p>Seu pedido foi realizado com sucesso!</p>
        <div class="order-details">
          <p><strong>Número do Pedido:</strong> <span>#${data.pedido_id}</span></p>
          <p><strong>Total:</strong> <span>R$ ${data.total}</span></p>
          <p><strong>Status:</strong> <span>Pendente</span></p>
        </div>
      </div>
      <div class="confirmation-footer">
        <button class="confirmation-button" onclick="viewOrderDetails(${data.pedido_id})">
          Ver Detalhes do Pedido
        </button>
      </div>
    </div>
  `;
  
  document.body.appendChild(overlay);
  
  // Mostrar animação
  setTimeout(() => {
    overlay.classList.add('active');
  }, 10);
  
  // Adicionar evento para fechar ao clicar fora
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay) {
      closeConfirmation();
    }
  });
}

// Função para fechar o card
function closeConfirmation() {
  const overlay = document.querySelector('.confirmation-overlay');
  if (overlay) {
    overlay.classList.remove('active');
    setTimeout(() => {
      overlay.remove();
    }, 300);
  }
}

// Função para visualizar detalhes do pedido
function viewOrderDetails(pedidoId) {
  closeConfirmation();
  window.open(`detalhes_pedido_cliente.php?id=${pedidoId}`, '_blank');
}

  // Inicialização
  updateCartCount();

  // Add some interactive polish
  document.querySelectorAll(".menu-item").forEach((item) => {
    item.addEventListener("mouseenter", function () {
      this.style.transform = "translateY(-8px)";
    });

    item.addEventListener("mouseleave", function () {
      this.style.transform = "translateY(0px)";
    });
  });
</script>

</body>
</html>