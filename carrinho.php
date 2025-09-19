<?php
// Iniciar sessão para possíveis funcionalidades futuras
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Carrinho de Compras | Pizzaria Primicia</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header id="header">
    <nav>
      <img src="img/logo.png" alt="" href="index.php" class="logo">

      <ul class="nav-links" id="nav-links">
        <li><a href="index.php#home"><i class="fa-solid fa-house"></i> Início</a></li>
        <li><a href="index.php#menu"><i class="fa-solid fa-utensils"></i> Cardápio</a></li>
        <li><a href="index.php#about"><i class="fa-solid fa-info-circle"></i> Nossa História</a></li>
        <li><a href="index.php#contact"><i class="fa-solid fa-phone"></i> Contato</a></li>
      </ul>

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

  <main class="container main-carrinho">
    <div class="section-header fade-in" style="margin-top: 40px;">
      <div class="section-subtitle">Seu Pedido</div>
      <h2 class="section-title serif"><i class="fa-solid fa-shopping-cart"></i> Carrinho de Compras</h2>
    </div>
    
    <div id="cart-items" class="fade-in"></div>
    
    <div id="cart-total" class="serif fade-in"></div>
    
    <div class="cart-actions fade-in" style="margin: 40px 0 60px; display: flex; gap: 15px; flex-wrap: wrap;">
      <button onclick="clearCart()" class="form-button" style="background: var(--dark-gray); flex: 1; min-width: 200px;">
        <i class="fa-solid fa-trash"></i> Limpar Carrinho
      </button>
      <button onclick="finalizarPedido()" class="form-button" style="flex: 2; min-width: 200px;">
        <i class="fa-solid fa-check"></i> Finalizar Pedido
      </button>
    </div>

    <div class="cart-empty" id="cart-empty" style="display: none; text-align: center; padding: 60px 20px;">
      <i class="fa-solid fa-shopping-cart" style="font-size: 4rem; color: var(--medium-gray); margin-bottom: 20px;"></i>
      <h3 class="serif" style="color: var(--text-secondary); margin-bottom: 15px;">Seu carrinho está vazio</h3>
      <p style="color: var(--text-muted); margin-bottom: 30px;">Adicione algumas pizzas deliciosas para começar!</p>
      <a href="index.php#menu" class="cta-button">
        <i class="fa-solid fa-utensils"></i> Ver Cardápio
      </a>
    </div>
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
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

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

    function renderCart() {
      const container = document.getElementById('cart-items');
      const totalDiv = document.getElementById('cart-total');
      const emptyDiv = document.getElementById('cart-empty');
      const cartActions = document.querySelector('.cart-actions');
      
      container.innerHTML = "";

      if(cart.length === 0){
        container.style.display = 'none';
        totalDiv.style.display = 'none';
        cartActions.style.display = 'none';
        emptyDiv.style.display = 'block';
        updateCartCount();
        return;
      }

      container.style.display = 'block';
      totalDiv.style.display = 'block';
      cartActions.style.display = 'flex';
      emptyDiv.style.display = 'none';

      let total = 0;
      cart.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;

        container.innerHTML += `
          <div class="cart-item" style="display:flex;align-items:center;justify-content:space-between;margin:15px 0;padding:20px;border-bottom:1px solid var(--medium-gray);background:var(--pure-white);border-radius:4px;box-shadow:var(--shadow-subtle);gap:15px;flex-wrap:wrap;">
            <div class="item-info" style="flex: 1; min-width: 200px;">
              <h4 style="font-weight: 600; color: var(--text-primary); margin-bottom: 5px;">${item.name}</h4>
              <p style="color: var(--text-secondary); font-size: 0.9rem;">
                <i class="fa-solid fa-times" style="color: var(--text-muted);"></i> ${item.quantity} 
                <span style="margin: 0 10px;">•</span>
                <i class="fa-solid fa-dollar-sign" style="color: var(--accent-gold);"></i> R$ ${item.price.toFixed(2)}
              </p>
            </div>
            <div class="item-total" style="font-weight: 600; color: var(--primary-dark); font-size: 1.1rem;">
              R$ ${itemTotal.toFixed(2)}
            </div>
            <div class="item-actions" style="display: flex; gap: 10px; align-items: center;">
              <button onclick="updateQuantity(${index}, ${item.quantity - 1})" 
                      style="background:var(--medium-gray);color:var(--text-primary);border:none;border-radius:50%;width:32px;height:32px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:var(--transition);"
                      ${item.quantity <= 1 ? 'disabled' : ''}>
                <i class="fa-solid fa-minus"></i>
              </button>
              <span style="min-width: 30px; text-align: center; font-weight: 600;">${item.quantity}</span>
              <button onclick="updateQuantity(${index}, ${item.quantity + 1})" 
                      style="background:var(--accent-gold);color:var(--primary-dark);border:none;border-radius:50%;width:32px;height:32px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:var(--transition);">
                <i class="fa-solid fa-plus"></i>
              </button>
              <button onclick="removeItem(${index})" 
                      style="background:var(--primary-dark);color:var(--pure-white);border:none;border-radius:2px;padding:8px 12px;cursor:pointer;margin-left:10px;transition:var(--transition);">
                <i class="fa-solid fa-trash"></i>
              </button>
            </div>
          </div>
        `;
      });

      totalDiv.innerHTML = `
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
          <div>
            <span style="font-size: 1rem; color: var(--text-secondary);">
              <i class="fa-solid fa-receipt"></i> Total do Pedido:
            </span>
          </div>
          <div style="font-size: 2rem; font-weight: 600; color: var(--primary-dark);">
            R$ ${total.toFixed(2)}
          </div>
        </div>
      `;
      updateCartCount();
    }

    function updateQuantity(index, newQuantity) {
      if (newQuantity <= 0) {
        removeItem(index);
        return;
      }
      
      cart[index].quantity = newQuantity;
      localStorage.setItem('cart', JSON.stringify(cart));
      renderCart();
    }

    function removeItem(index){
      cart.splice(index, 1);
      localStorage.setItem('cart', JSON.stringify(cart));
      renderCart();
    }

    function clearCart() {
      if (cart.length === 0) return;
      
      if (confirm('Tem certeza que deseja limpar todo o carrinho?')) {
        cart = [];
        localStorage.removeItem('cart');
        renderCart();
      }
    }

   function finalizarPedido(){
  if(cart.length === 0) {
    alert("Seu carrinho está vazio!");
    return;
  }
  // leva ao formulário e foca o campo nome
  window.location.href = 'index.php#contact';
  // após redirecionar, é difícil garantir foco via JS se a página recarregar.
  // então, no index.php, se quiser, podemos adicionar lógica para checar location.hash e focar o campo.
}

    // Atualiza badge do carrinho
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

    // Header scroll effect
    window.addEventListener("scroll", function () {
      const header = document.getElementById("header");
      if (window.scrollY > 50) {
        header.classList.add("scrolled");
      } else {
        header.classList.remove("scrolled");
      }
    });

    // Inicialização
    renderCart();
  </script>
</body>
</html>