/* GESCHOOL - JavaScript Application */

// Configuration globale
const CONFIG = {
  // Données de tarification (modifiable facilement)
  pricing: {
    starter: {
      monthly: 15000,
      yearly: 150000 // 10 mois au lieu de 12
    },
    pro: {
      monthly: 45000,
      yearly: 450000 // 10 mois au lieu de 12
    }
  },
  
  // Paramètres d'animation
  animation: {
    scrollOffset: 100,
    duration: 300
  }
};

// Utilitaires
const Utils = {
  // Formater les nombres avec séparateurs
  formatPrice: (price) => {
    return new Intl.NumberFormat('fr-FR').format(price);
  },
  
  // Debounce function pour les événements
  debounce: (func, wait) => {
    let timeout;
    return function executedFunction(...args) {
      const later = () => {
        clearTimeout(timeout);
        func(...args);
      };
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
    };
  },
  
  // Animation smooth scroll
  smoothScroll: (target) => {
    const element = document.querySelector(target);
    if (element) {
      const headerOffset = 80;
      const elementPosition = element.offsetTop;
      const offsetPosition = elementPosition - headerOffset;
      
      window.scrollTo({
        top: offsetPosition,
        behavior: 'smooth'
      });
    }
  },
  
  // Validation email
  isValidEmail: (email) => {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }
};

// Gestion de la navigation
class Navigation {
  constructor() {
    this.header = document.querySelector('.header');
    this.navBurger = document.getElementById('navBurger');
    this.navMenu = document.getElementById('navMenu');
    this.navLinks = document.querySelectorAll('.nav__link');
    
    this.init();
  }
  
  init() {
    this.bindEvents();
    this.handleScroll();
  }
  
  bindEvents() {
    // Toggle menu mobile
    this.navBurger?.addEventListener('click', () => this.toggleMobileMenu());
    
    // Fermer menu mobile sur clic lien
    this.navLinks.forEach(link => {
      link.addEventListener('click', (e) => {
        e.preventDefault();
        const target = link.getAttribute('href');
        Utils.smoothScroll(target);
        this.closeMobileMenu();
      });
    });
    
    // Gérer le scroll pour header fixe
    window.addEventListener('scroll', Utils.debounce(() => this.handleScroll(), 10));
    
    // Fermer menu mobile sur clic extérieur
    document.addEventListener('click', (e) => {
      if (!e.target.closest('.nav') && this.navMenu.classList.contains('active')) {
        this.closeMobileMenu();
      }
    });
  }
  
  toggleMobileMenu() {
    this.navBurger.classList.toggle('active');
    this.navMenu.classList.toggle('active');
    this.navBurger.setAttribute('aria-expanded', 
      this.navBurger.classList.contains('active')
    );
  }
  
  closeMobileMenu() {
    this.navBurger.classList.remove('active');
    this.navMenu.classList.remove('active');
    this.navBurger.setAttribute('aria-expanded', 'false');
  }
  
  handleScroll() {
    const scrolled = window.scrollY > 50;
    this.header.style.backgroundColor = scrolled 
      ? 'rgba(255, 255, 255, 0.95)' 
      : 'var(--color-bg-primary)';
    this.header.style.backdropFilter = scrolled ? 'blur(10px)' : 'blur(8px)';
  }
}

// Gestion du mode sombre
class DarkModeToggle {
  constructor() {
    this.toggle = document.getElementById('darkModeToggle');
    this.currentTheme = localStorage.getItem('theme') || 'light';
    
    this.init();
  }
  
  init() {
    this.applyTheme(this.currentTheme);
    this.toggle?.addEventListener('click', () => this.toggleTheme());
  }
  
  toggleTheme() {
    this.currentTheme = this.currentTheme === 'light' ? 'dark' : 'light';
    this.applyTheme(this.currentTheme);
    localStorage.setItem('theme', this.currentTheme);
  }
  
  applyTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    if (this.toggle) {
      this.toggle.textContent = theme === 'light' ? '🌙' : '☀️';
      this.toggle.setAttribute('aria-label', 
        theme === 'light' ? 'Activer le mode sombre' : 'Activer le mode clair'
      );
    }
  }
}

// Gestion des tarifs
class PricingManager {
  constructor() {
    this.toggleButtons = document.querySelectorAll('.pricing__toggle-btn');
    this.priceElements = document.querySelectorAll('.pricing__amount');
    this.periodElements = document.querySelectorAll('.pricing__period');
    this.currentPeriod = 'monthly';
    
    this.init();
  }
  
  init() {
    this.bindEvents();
  }
  
  bindEvents() {
    this.toggleButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        const period = btn.dataset.period;
        if (period !== this.currentPeriod) {
          this.switchPeriod(period);
        }
      });
    });
  }
  
  switchPeriod(period) {
    this.currentPeriod = period;
    
    // Mettre à jour les boutons
    this.toggleButtons.forEach(btn => {
      const isActive = btn.dataset.period === period;
      btn.classList.toggle('active', isActive);
      btn.setAttribute('aria-selected', isActive.toString());
    });
    
    // Mettre à jour les prix avec animation
    this.priceElements.forEach(element => {
      element.style.transform = 'scale(0.8)';
      element.style.opacity = '0.5';
      
      setTimeout(() => {
        const planType = this.getPlanType(element);
        if (planType && CONFIG.pricing[planType]) {
          const price = CONFIG.pricing[planType][period];
          element.textContent = Utils.formatPrice(price);
        }
        
        element.style.transform = 'scale(1)';
        element.style.opacity = '1';
      }, 150);
    });
    
    // Mettre à jour les périodes
    this.periodElements.forEach(element => {
      element.textContent = period === 'monthly' ? '/mois' : '/an';
    });
  }
  
  getPlanType(element) {
    const card = element.closest('.pricing__card');
    const planName = card?.querySelector('.pricing__name')?.textContent?.toLowerCase();
    
    if (planName?.includes('starter')) return 'starter';
    if (planName?.includes('pro')) return 'pro';
    return null;
  }
}

// Gestion du formulaire d'inscription
class SignupForm {
  constructor() {
    this.modal = document.getElementById('signupModal');
    this.form = document.getElementById('signupForm');
    this.openButtons = document.querySelectorAll('#signupBtn, #heroSignup, .btn:contains("S\'inscrire")');
    this.closeButton = document.querySelector('.modal__close');
    this.backdrop = document.querySelector('.modal__backdrop');
    this.submitButton = document.getElementById('submitBtn');
    
    this.init();
  }
  
  init() {
    this.bindEvents();
  }
  
  bindEvents() {
    // Ouvrir modal
    document.addEventListener('click', (e) => {
      if (e.target.matches('#signupBtn, #heroSignup') || 
          (e.target.classList.contains('btn') && e.target.textContent.includes('S\'inscrire'))) {
        e.preventDefault();
        this.openModal();
      }
    });
    
    // Fermer modal
    this.closeButton?.addEventListener('click', () => this.closeModal());
    this.backdrop?.addEventListener('click', () => this.closeModal());
    
    // Fermer avec Escape
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && this.modal?.classList.contains('active')) {
        this.closeModal();
      }
    });
    
    // Validation en temps réel
    this.form?.addEventListener('input', (e) => this.validateField(e.target));
    
    // Soumission formulaire
    this.form?.addEventListener('submit', (e) => this.handleSubmit(e));
  }
  
  openModal() {
    this.modal?.classList.add('active');
    document.body.style.overflow = 'hidden';
    
    // Focus sur le premier champ
    setTimeout(() => {
      const firstInput = this.form?.querySelector('input');
      firstInput?.focus();
    }, 100);
  }
  
  closeModal() {
    this.modal?.classList.remove('active');
    document.body.style.overflow = '';
    this.clearErrors();
  }
  
  validateField(field) {
    const value = field.value.trim();
    const fieldName = field.name;
    let isValid = true;
    let message = '';
    
    // Supprimer les classes d'erreur
    field.classList.remove('error');
    
    switch (fieldName) {
      case 'fullName':
        if (value.length < 2) {
          isValid = false;
          message = 'Le nom doit contenir au moins 2 caractères';
        }
        break;
        
      case 'email':
        if (!Utils.isValidEmail(value)) {
          isValid = false;
          message = 'Veuillez saisir une adresse email valide';
        }
        break;
        
      case 'institution':
        if (value.length < 2) {
          isValid = false;
          message = 'Le nom de l\'établissement est requis';
        }
        break;
        
      case 'password':
        if (value.length < 6) {
          isValid = false;
          message = 'Le mot de passe doit contenir au moins 6 caractères';
        }
        break;
    }
    
    // Afficher erreur si nécessaire
    if (!isValid) {
      field.classList.add('error');
      this.showFieldError(fieldName, message);
    } else {
      this.hideFieldError(fieldName);
    }
    
    return isValid;
  }
  
  showFieldError(fieldName, message) {
    const errorElement = document.getElementById(`${fieldName}Error`);
    if (errorElement) {
      errorElement.textContent = message;
    }
  }
  
  hideFieldError(fieldName) {
    const errorElement = document.getElementById(`${fieldName}Error`);
    if (errorElement) {
      errorElement.textContent = '';
    }
  }
  
  clearErrors() {
    const errorElements = this.form?.querySelectorAll('.form-error');
    errorElements?.forEach(el => el.textContent = '');
    
    const inputElements = this.form?.querySelectorAll('.form-input');
    inputElements?.forEach(el => el.classList.remove('error'));
  }
  
  async handleSubmit(e) {
    e.preventDefault();
    
    // Valider tous les champs
    const inputs = this.form.querySelectorAll('input[required]');
    let isFormValid = true;
    
    inputs.forEach(input => {
      if (input.type !== 'checkbox') {
        if (!this.validateField(input)) {
          isFormValid = false;
        }
      }
    });
    
    // Vérifier les conditions
    const termsCheckbox = document.getElementById('terms');
    if (!termsCheckbox?.checked) {
      isFormValid = false;
      // Vous pouvez ajouter un message d'erreur pour les conditions
    }
    
    if (!isFormValid) {
      return;
    }
    
    // Animation de chargement
    this.submitButton.classList.add('btn--loading');
    this.submitButton.disabled = true;
    
    try {
      // Simulation d'envoi (remplacer par vraie API)
      await this.simulateSubmission();
      
      // Succès
      this.showSuccessMessage();
      
    } catch (error) {
      // Erreur
      this.showErrorMessage('Une erreur est survenue. Veuillez réessayer.');
    } finally {
      // Restaurer bouton
      this.submitButton.classList.remove('btn--loading');
      this.submitButton.disabled = false;
    }
  }
  
  async simulateSubmission() {
    // Simulation d'un appel API
    return new Promise((resolve) => {
      setTimeout(resolve, 2000);
    });
  }
  
  showSuccessMessage() {
    const formData = new FormData(this.form);
    const data = Object.fromEntries(formData);
    
    // Remplacer le contenu du modal
    const modalContent = this.modal.querySelector('.modal__content');
    modalContent.innerHTML = `
      <div style="padding: 2rem; text-align: center;">
        <div style="color: var(--color-success); font-size: 3rem; margin-bottom: 1rem;">✓</div>
        <h2 style="color: var(--color-gray-900); margin-bottom: 1rem;">Inscription réussie !</h2>
        <p style="color: var(--color-gray-600); margin-bottom: 2rem;">
          Merci ${data.fullName} ! Un email de confirmation a été envoyé à <strong>${data.email}</strong>.
          Vous pouvez commencer à utiliser Geschool dès maintenant.
        </p>
        <button class="btn btn--primary" onclick="window.location.reload()">
          Accéder à votre tableau de bord
        </button>
      </div>
    `;
    
    // Auto-fermer après 5 secondes
    setTimeout(() => {
      this.closeModal();
      window.location.reload();
    }, 5000);
  }
  
  showErrorMessage(message) {
    // Afficher un message d'erreur temporaire
    const errorDiv = document.createElement('div');
    errorDiv.style.cssText = `
      position: fixed;
      top: 20px;
      right: 20px;
      background: #EF4444;
      color: white;
      padding: 1rem 1.5rem;
      border-radius: 8px;
      box-shadow: var(--shadow-lg);
      z-index: 3000;
      animation: slideInRight 0.3s ease-out;
    `;
    errorDiv.textContent = message;
    
    document.body.appendChild(errorDiv);
    
    setTimeout(() => {
      errorDiv.remove();
    }, 5000);
  }
}

// Gestion des animations au scroll
class ScrollAnimations {
  constructor() {
    this.elements = document.querySelectorAll('.feature-card, .testimonial, .workflow__step');
    this.observer = null;
    
    this.init();
  }
  
  init() {
    this.createObserver();
    this.observeElements();
  }
  
  createObserver() {
    const options = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };
    
    this.observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
          this.observer.unobserve(entry.target);
        }
      });
    }, options);
  }
  
  observeElements() {
    this.elements.forEach((el, index) => {
      // Délai progressif pour effet cascade
      el.style.opacity = '0';
      el.style.transform = 'translateY(30px)';
      el.style.transition = `opacity 0.6s ease-out ${index * 0.1}s, transform 0.6s ease-out ${index * 0.1}s`;
      
      this.observer.observe(el);
    });
  }
}

// Gestion de la newsletter
class Newsletter {
  constructor() {
    this.form = document.getElementById('newsletterForm');
    this.init();
  }
  
  init() {
    this.form?.addEventListener('submit', (e) => this.handleSubmit(e));
  }
  
  async handleSubmit(e) {
    e.preventDefault();
    
    const emailInput = this.form.querySelector('input[type="email"]');
    const submitBtn = this.form.querySelector('button');
    const email = emailInput.value.trim();
    
    if (!Utils.isValidEmail(email)) {
      this.showMessage('Veuillez saisir une adresse email valide', 'error');
      return;
    }
    
    // Animation de chargement
    const originalText = submitBtn.textContent;
    submitBtn.textContent = '...';
    submitBtn.disabled = true;
    
    try {
      // Simulation d'inscription newsletter
      await new Promise(resolve => setTimeout(resolve, 1000));
      
      this.showMessage('Inscription réussie ! Merci de votre intérêt.', 'success');
      emailInput.value = '';
      
    } catch (error) {
      this.showMessage('Une erreur est survenue. Veuillez réessayer.', 'error');
    } finally {
      submitBtn.textContent = originalText;
      submitBtn.disabled = false;
    }
  }
  
  showMessage(text, type) {
    // Créer message temporaire
    const message = document.createElement('div');
    message.style.cssText = `
      position: fixed;
      bottom: 20px;
      right: 20px;
      background: ${type === 'success' ? 'var(--color-success)' : '#EF4444'};
      color: white;
      padding: 1rem 1.5rem;
      border-radius: var(--border-radius-md);
      box-shadow: var(--shadow-lg);
      z-index: 2000;
      animation: slideInUp 0.3s ease-out;
    `;
    message.textContent = text;
    
    document.body.appendChild(message);
    
    setTimeout(() => {
      message.style.animation = 'slideOutDown 0.3s ease-out forwards';
      setTimeout(() => message.remove(), 300);
    }, 4000);
  }
}

// Gestion des boutons de démo
class DemoHandler {
  constructor() {
    this.demoBtn = document.getElementById('demoBtn');
    this.init();
  }
  
  init() {
    this.demoBtn?.addEventListener('click', () => this.showDemo());
  }
  
  showDemo() {
    // Simulation d'une démo (vous pouvez intégrer une vraie vidéo/iframe)
    const demoModal = document.createElement('div');
    demoModal.className = 'modal active';
    demoModal.innerHTML = `
      <div class="modal__backdrop"></div>
      <div class="modal__content" style="max-width: 900px;">
        <div class="modal__header">
          <h2 class="modal__title">Démo Geschool</h2>
          <button class="modal__close">&times;</button>
        </div>
        <div style="padding: 0 2rem 2rem;">
          <div style="aspect-ratio: 16/9; background: var(--color-gray-100); border-radius: var(--border-radius-md); display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
            <p style="color: var(--color-gray-500); text-align: center;">
              🎥 Vidéo de démonstration<br>
              <small>Intégrez ici votre vidéo ou iframe</small>
            </p>
          </div>
          <p style="color: var(--color-gray-600); text-align: center;">
            Découvrez comment Geschool simplifie la gestion de votre établissement en quelques minutes.
          </p>
        </div>
      </div>
    `;
    
    document.body.appendChild(demoModal);
    document.body.style.overflow = 'hidden';
    
    // Fermer la démo
    const closeDemo = () => {
      demoModal.remove();
      document.body.style.overflow = '';
    };
    
    demoModal.querySelector('.modal__close').addEventListener('click', closeDemo);
    demoModal.querySelector('.modal__backdrop').addEventListener('click', closeDemo);
    
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeDemo();
    }, { once: true });
  }
}

// Gestion des performances et lazy loading
class PerformanceOptimizer {
  constructor() {
    this.images = document.querySelectorAll('img[loading="lazy"]');
    this.init();
  }
  
  init() {
    this.setupLazyLoading();
    this.optimizeAnimations();
  }
  
  setupLazyLoading() {
    // Fallback pour navigateurs sans support natif
    if ('loading' in HTMLImageElement.prototype) {
      return; // Support natif disponible
    }
    
    // Polyfill simple pour lazy loading
    const imageObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const img = entry.target;
          img.src = img.dataset.src || img.src;
          img.classList.remove('lazy');
          imageObserver.unobserve(img);
        }
      });
    });
    
    this.images.forEach(img => imageObserver.observe(img));
  }
  
  optimizeAnimations() {
    // Désactiver animations si préférence utilisateur
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
      document.documentElement.style.setProperty('--transition-fast', '0s');
      document.documentElement.style.setProperty('--transition-normal', '0s');
    }
  }
}

// Analytics et tracking (simulation)
class Analytics {
  constructor() {
    this.events = [];
    this.init();
  }
  
  init() {
    this.trackPageView();
    this.setupEventTracking();
  }
  
  trackPageView() {
    this.track('page_view', {
      page: window.location.pathname,
      timestamp: new Date().toISOString()
    });
  }
  
  setupEventTracking() {
    // Tracking des clics CTA
    document.addEventListener('click', (e) => {
      if (e.target.classList.contains('btn--primary')) {
        this.track('cta_click', {
          button_text: e.target.textContent.trim(),
          section: this.getCurrentSection(e.target)
        });
      }
    });
    
    // Tracking du scroll profondeur
    let maxScroll = 0;
    window.addEventListener('scroll', Utils.debounce(() => {
      const scrollPercent = Math.round((window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100);
      if (scrollPercent > maxScroll) {
        maxScroll = scrollPercent;
        if (maxScroll % 25 === 0) { // Track every 25%
          this.track('scroll_depth', { percent: maxScroll });
        }
      }
    }, 1000));
  }
  
  getCurrentSection(element) {
    const section = element.closest('section');
    return section?.className.split(' ')[0] || 'unknown';
  }
  
  track(event, data = {}) {
    // Simulation - remplacer par Google Analytics, Mixpanel, etc.
    const eventData = {
      event,
      data,
      timestamp: new Date().toISOString(),
      user_agent: navigator.userAgent,
      url: window.location.href
    };
    
    this.events.push(eventData);
    
    // En développement, logger dans la console
    if (window.location.hostname === 'localhost' || window.location.hostname.includes('127.0.0.1')) {
      console.log('📊 Analytics Event:', eventData);
    }
    
    // Envoyer à votre service d'analytics
    // this.sendToAnalytics(eventData);
  }
  
  sendToAnalytics(eventData) {
    // Exemple d'implémentation pour Google Analytics 4
    // if (typeof gtag !== 'undefined') {
    //   gtag('event', eventData.event, eventData.data);
    // }
  }
}

// Gestionnaire principal de l'application
class GeschoolApp {
  constructor() {
    this.components = {};
    this.init();
  }
  
  init() {
    // Attendre que le DOM soit chargé
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', () => this.initializeComponents());
    } else {
      this.initializeComponents();
    }
  }
  
  initializeComponents() {
    try {
      // Initialiser tous les composants
      this.components.navigation = new Navigation();
      this.components.darkMode = new DarkModeToggle();
      this.components.pricing = new PricingManager();
      this.components.signupForm = new SignupForm();
      this.components.scrollAnimations = new ScrollAnimations();
      this.components.newsletter = new Newsletter();
      this.components.demoHandler = new DemoHandler();
      this.components.performanceOptimizer = new PerformanceOptimizer();
      this.components.analytics = new Analytics();
      
      // Événements globaux
      this.bindGlobalEvents();
      
      console.log('✅ Geschool App initialized successfully');
      
    } catch (error) {
      console.error('❌ Error initializing Geschool App:', error);
    }
  }
  
  bindGlobalEvents() {
    // Gestion des erreurs JavaScript globales
    window.addEventListener('error', (e) => {
      console.error('Global error:', e.error);
      // Vous pouvez envoyer les erreurs à un service de monitoring
    });
    
    // Gestion des promesses rejetées
    window.addEventListener('unhandledrejection', (e) => {
      console.error('Unhandled promise rejection:', e.reason);
    });
    
    // Optimisation mobile - désactiver zoom sur double tap
    let lastTouchEnd = 0;
    document.addEventListener('touchend', (e) => {
      const now = (new Date()).getTime();
      if (now - lastTouchEnd <= 300) {
        e.preventDefault();
      }
      lastTouchEnd = now;
    }, { passive: false });
  }
  
  // Méthodes utilitaires publiques
  trackEvent(event, data) {
    this.components.analytics?.track(event, data);
  }
  
  showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification--${type}`;
    notification.style.cssText = `
      position: fixed;
      top: 20px;
      right: 20px;
      background: ${type === 'success' ? 'var(--color-success)' : 
                   type === 'error' ? '#EF4444' : 'var(--color-primary)'};
      color: white;
      padding: 1rem 1.5rem;
      border-radius: var(--border-radius-md);
      box-shadow: var(--shadow-lg);
      z-index: 3000;
      animation: slideInRight 0.3s ease-out;
      max-width: 300px;
    `;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
      notification.style.animation = 'slideOutRight 0.3s ease-out forwards';
      setTimeout(() => notification.remove(), 300);
    }, 4000);
  }
}

// Styles CSS pour les animations dynamiques (injectés via JS)
const dynamicStyles = `
@keyframes slideInRight {
  from {
    transform: translateX(100%);
    opacity: 0;
  }
  to {
    transform: translateX(0);
    opacity: 1;
  }
}

@keyframes slideOutRight {
  from {
    transform: translateX(0);
    opacity: 1;
  }
  to {
    transform: translateX(100%);
    opacity: 0;
  }
}

@keyframes slideInUp {
  from {
    transform: translateY(100%);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

@keyframes slideOutDown {
  from {
    transform: translateY(0);
    opacity: 1;
  }
  to {
    transform: translateY(100%);
    opacity: 0;
  }
}

.notification {
  font-weight: 500;
  border-left: 4px solid rgba(255, 255, 255, 0.5);
}
`;

// Injecter les styles dynamiques
const styleSheet = document.createElement('style');
styleSheet.textContent = dynamicStyles;
document.head.appendChild(styleSheet);

// Initialiser l'application
window.GeschoolApp = new GeschoolApp();

// Exposer certaines fonctionnalités globalement pour debug/usage externe
window.Geschool = {
  trackEvent: (event, data) => window.GeschoolApp.trackEvent(event, data),
  showNotification: (message, type) => window.GeschoolApp.showNotification(message, type),
  config: CONFIG,
  utils: Utils
};

// Service Worker pour mise en cache (optionnel)
if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    // Décommentez pour activer le service worker
    // navigator.serviceWorker.register('/sw.js')
    //   .then(registration => console.log('SW registered:', registration))
    //   .catch(error => console.log('SW registration failed:', error));
  });
}