<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- 
    PERSONNALISATION RAPIDE :
    - Palette couleurs : voir variables CSS dans styles.css (section :root)
    - Texte hero : modifier les h1/p dans la section .hero
    - Tarifs : modifier les prix dans la section .pricing et dans app.js (pricingData)
    -->
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geschool — Gestion scolaire moderne pour établissements secondaires et supérieurs</title>
    <meta name="description" content="Solution SaaS de gestion scolaire complète : élèves, notes, emploi du temps, paiements. Essai gratuit 14 jours pour collèges et universités.">
    
    <!-- Open Graph -->
    <meta property="og:title" content="Geschool — Gestion scolaire moderne">
    <meta property="og:description" content="Centralisez la gestion de vos élèves, notes et paiements. Simple, sécurisé, adapté aux établissements.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://geschool.com">
    
    <!-- Favicon placeholder -->
     <link
		rel="apple-touch-icon"
		sizes="180x180"
		href="{{asset('assets/vendors/images/apple-touch-icon.png')}}" />
	<link
		rel="icon"
		type="image/png"
		sizes="32x32"
		href="{{asset('assets/vendors/images/favicon-32x32.png')}}" />
	<link
		rel="icon"
		type="image/png"
		sizes="16x16"
		href="{{asset('assets/vendors/images/favicon-16x16.png')}}" />
     <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/css/welcom.css')}}">
</head>
<body>
    <!-- HEADER -->
    <header class="header" role="banner">
        <nav class="nav" aria-label="Navigation principale">
            <div class="nav__brand">
                <svg class="nav__logo" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                </svg>
                <span class="nav__title">Geschool</span>
            </div>
            
            <ul class="nav__menu" id="navMenu">
                <li><a href="#features" class="nav__link">Fonctionnalités</a></li>
                <li><a href="#pricing" class="nav__link">Tarifs</a></li>
                <li><a href="#testimonials" class="nav__link">Témoignages</a></li>
                <li><a href="#faq" class="nav__link">FAQ</a></li>
                <li><a href="#contact" class="nav__link">Contact</a></li>
            </ul>
            
            <div class="nav__actions">
                <!-- <button class="btn btn--secondary" id="darkModeToggle" aria-label="Activer le mode sombre">🌙</button> -->
                <!-- <button class="btn btn--primary" id="signupBtn" href>Essai gratuit</button> -->
                <a href="{{route('login')}}" class="btn btn--primary" id="signupBtn"> Essai gratuit </a>
                <button class="nav__burger" id="navBurger" aria-label="Menu de navigation" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </nav>
    </header>

    <main>
        <!-- HERO SECTION -->
        <section class="hero" aria-labelledby="hero-title">
            <div class="container">
                <div class="hero__content">
                    <div class="hero__text">
                        <h1 id="hero-title" class="hero__title">
                            Geschool — La gestion scolaire moderne pour vos établissements
                        </h1>
                        <p class="hero__subtitle">
                            Centralisez les élèves, les notes, la scolarité et les paiements. 
                            Simple, sécurisé, adapté aux collèges et universités.
                        </p>
                        
                        <ul class="hero__benefits">
                            <li>✓ Interface intuitive et moderne</li>
                            <li>✓ Données sécurisées et conformes</li>
                            <li>✓ Support multilingue français</li>
                        </ul>
                        
                        <div class="hero__actions">
                            <a href="{{route('login')}}" class="btn btn--primary btn--large" id="heroSignup">Essai gratuit 1 mois</a>
                            <button class="btn btn--secondary btn--large" id="demoBtn">
                                Voir la démo
                            </button>
                        </div>
                    </div>
                    
                    <div class="hero__visual">
                        <div class="mockup">
                            <img src="{{asset('assets/img/img.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- TRUSTED LOGOS -->
        <section class="trusted" aria-label="Partenaires de confiance">
            <div class="container">
                <p class="trusted__label">Ils nous font confiance</p>
                <div class="trusted__logos">
                    <div class="trusted__logo">EduCorp</div>
                    <div class="trusted__logo">UniTech</div>
                    <div class="trusted__logo">SchoolMax</div>
                    <div class="trusted__logo">AcademyPro</div>
                </div>
            </div>
        </section>

        <!-- FEATURES -->
        <section class="features" id="features" aria-labelledby="features-title">
            <div class="container">
                <header class="section-header">
                    <h2 id="features-title" class="section-title">
                        Tout ce dont vous avez besoin pour gérer votre établissement
                    </h2>
                    <p class="section-subtitle">
                        Une suite complète d'outils conçus pour simplifier la gestion scolaire
                    </p>
                </header>
                
                <div class="features__grid">
                    <article class="feature-card">
                        <div class="feature-card__icon">📝</div>
                        <h3 class="feature-card__title">Saisie des notes</h3>
                        <p class="feature-card__description">
                            Interface intuitive pour la saisie et le suivi des évaluations. 
                            Calculs automatiques des moyennes et bulletins.
                        </p>
                    </article>
                    
                    <article class="feature-card">
                        <div class="feature-card__icon">👥</div>
                        <h3 class="feature-card__title">Gestion des élèves</h3>
                        <p class="feature-card__description">
                            Dossiers complets des étudiants, suivi des présences, 
                            historique académique et communication avec les familles.
                        </p>
                    </article>
                    
                    <article class="feature-card">
                        <div class="feature-card__icon">📅</div>
                        <h3 class="feature-card__title">Emploi du temps</h3>
                        <p class="feature-card__description">
                            Planification intelligente des cours, gestion des salles 
                            et des ressources avec détection automatique des conflits.
                        </p>
                    </article>
                    
                    <article class="feature-card">
                        <div class="feature-card__icon">💳</div>
                        <h3 class="feature-card__title">Paiement des frais</h3>
                        <p class="feature-card__description">
                            Facturation automatisée, suivi des paiements, 
                            relances automatiques et intégration Mobile Money.
                        </p>
                    </article>
                    
                    <article class="feature-card">
                        <div class="feature-card__icon">📊</div>
                        <h3 class="feature-card__title">Rapports & Analytics</h3>
                        <p class="feature-card__description">
                            Tableaux de bord en temps réel, statistiques détaillées 
                            et exports personnalisables pour le pilotage.
                        </p>
                    </article>
                    
                    <article class="feature-card">
                        <div class="feature-card__icon">🏢</div>
                        <h3 class="feature-card__title">Multi-établissement</h3>
                        <p class="feature-card__description">
                            Gestion centralisée de plusieurs campus, 
                            synchronisation des données et rapports consolidés.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        <!-- HOW IT WORKS -->
        <section class="workflow" aria-labelledby="workflow-title">
            <div class="container">
                <header class="section-header">
                    <h2 id="workflow-title" class="section-title">Comment ça marche</h2>
                    <p class="section-subtitle">Trois étapes simples pour transformer votre gestion scolaire</p>
                </header>
                
                <div class="workflow__steps">
                    <div class="workflow__step">
                        <div class="workflow__number">1</div>
                        <h3 class="workflow__title">Inscrivez vos données</h3>
                        <p class="workflow__description">
                            Importez facilement vos élèves, professeurs et matières existants
                        </p>
                    </div>
                    
                    <div class="workflow__step">
                        <div class="workflow__number">2</div>
                        <h3 class="workflow__title">Gérez au quotidien</h3>
                        <p class="workflow__description">
                            Utilisez les outils intuitifs pour les notes, présences et communications
                        </p>
                    </div>
                    
                    <div class="workflow__step">
                        <div class="workflow__number">3</div>
                        <h3 class="workflow__title">Analysez et décidez</h3>
                        <p class="workflow__description">
                            Consultez les rapports pour optimiser les performances de votre établissement
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- PRICING -->
        <section class="pricing" id="pricing" aria-labelledby="pricing-title">
            <div class="container">
                <header class="section-header">
                    <h2 id="pricing-title" class="section-title">Tarifs transparents et flexibles</h2>
                    <p class="section-subtitle">Choisissez le plan qui correspond à la taille de votre établissement</p>
                    
                    <div class="pricing__toggle" role="tablist" aria-label="Périodicité de facturation">
                        <button class="pricing__toggle-btn active" data-period="monthly" role="tab" aria-selected="true">Mensuel</button>
                        <button class="pricing__toggle-btn" data-period="yearly" role="tab" aria-selected="false">Annuel <span class="pricing__savings">-2 mois</span></button>
                    </div>
                </header>
                
                <div class="pricing__grid">
                    <article class="pricing__card">
                        <div class="pricing__header">
                            <h3 class="pricing__name">Starter</h3>
                            <div class="pricing__price">
                                <span class="pricing__amount" data-monthly="15000" data-yearly="150000">15 000</span>
                                <span class="pricing__currency">XAF</span>
                                <span class="pricing__period">/mois</span>
                            </div>
                            <p class="pricing__description">Pour les petits établissements</p>
                        </div>
                        
                        <ul class="pricing__features">
                            <li>✓ Jusqu'à 300 élèves</li>
                            <li>✓ Gestion des notes et bulletins</li>
                            <li>✓ Suivi des présences</li>
                            <li>✓ Communication parents</li>
                            <li>✓ Support email</li>
                        </ul>
                        
                        <button class="btn btn--primary btn--full">S'inscrire</button>
                    </article>
                    
                    <article class="pricing__card pricing__card--featured">
                        <div class="pricing__badge">Populaire</div>
                        <div class="pricing__header">
                            <h3 class="pricing__name">Pro</h3>
                            <div class="pricing__price">
                                <span class="pricing__amount" data-monthly="45000" data-yearly="450000">45 000</span>
                                <span class="pricing__currency">XAF</span>
                                <span class="pricing__period">/mois</span>
                            </div>
                            <p class="pricing__description">Pour les établissements en croissance</p>
                        </div>
                        
                        <ul class="pricing__features">
                            <li>✓ Jusqu'à 2 000 élèves</li>
                            <li>✓ Toutes les fonctionnalités Starter</li>
                            <li>✓ Gestion des paiements</li>
                            <li>✓ Emplois du temps avancés</li>
                            <li>✓ Rapports et analytics</li>
                            <li>✓ Support téléphonique</li>
                            <li>✓ Formation incluse</li>
                        </ul>
                        
                        <button class="btn btn--primary btn--full">S'inscrire</button>
                    </article>
                    
                    <article class="pricing__card">
                        <div class="pricing__header">
                            <h3 class="pricing__name">Établissement</h3>
                            <div class="pricing__price">
                                <span class="pricing__amount">Sur devis</span>
                            </div>
                            <p class="pricing__description">Pour les grands groupes scolaires</p>
                        </div>
                        
                        <ul class="pricing__features">
                            <li>✓ Élèves illimités</li>
                            <li>✓ Multi-établissement</li>
                            <li>✓ Personnalisation complète</li>
                            <li>✓ Intégrations sur mesure</li>
                            <li>✓ Gestionnaire de compte dédié</li>
                            <li>✓ Formation et accompagnement</li>
                            <li>✓ SLA garanti</li>
                        </ul>
                        
                        <button class="btn btn--secondary btn--full">Nous contacter</button>
                    </article>
                </div>
            </div>
        </section>

        <!-- TESTIMONIALS -->
        <section class="testimonials" id="testimonials" aria-labelledby="testimonials-title">
            <div class="container">
                <header class="section-header">
                    <h2 id="testimonials-title" class="section-title">Ce que disent nos utilisateurs</h2>
                </header>
                
                <div class="testimonials__grid">
                    <article class="testimonial">
                        <div class="testimonial__rating">★★★★★</div>
                        <blockquote class="testimonial__content">
                            "Geschool a révolutionné notre gestion administrative. 
                            Nos professeurs gagnent un temps précieux et les parents apprécient la transparence."
                        </blockquote>
                        <footer class="testimonial__author">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 48 48'%3E%3Ccircle cx='24' cy='24' r='24' fill='%23e2e8f0'/%3E%3Ctext x='24' y='28' text-anchor='middle' fill='%23475569' font-family='Arial' font-size='16'%3EMD%3C/text%3E%3C/svg%3E" alt="" class="testimonial__avatar" loading="lazy">
                            <div>
                                <cite class="testimonial__name">Marie Dubois</cite>
                                <p class="testimonial__title">Directrice, Lycée International de Yaoundé</p>
                            </div>
                        </footer>
                    </article>
                    
                    <article class="testimonial">
                        <div class="testimonial__rating">★★★★★</div>
                        <blockquote class="testimonial__content">
                            "L'interface est intuitive et nos équipes ont adopté Geschool très rapidement. 
                            Le support client est exceptionnel."
                        </blockquote>
                        <footer class="testimonial__author">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 48 48'%3E%3Ccircle cx='24' cy='24' r='24' fill='%23e2e8f0'/%3E%3Ctext x='24' y='28' text-anchor='middle' fill='%23475569' font-family='Arial' font-size='16'%3EJK%3C/text%3E%3C/svg%3E" alt="" class="testimonial__avatar" loading="lazy">
                            <div>
                                <cite class="testimonial__name">Jean Kouam</cite>
                                <p class="testimonial__title">Secrétaire Général, Université de Douala</p>
                            </div>
                        </footer>
                    </article>
                    
                    <article class="testimonial">
                        <div class="testimonial__rating">★★★★★</div>
                        <blockquote class="testimonial__content">
                            "Grâce aux rapports détaillés, nous avons amélioré notre taux de réussite de 15%. 
                            Un investissement qui se rentabilise rapidement."
                        </blockquote>
                        <footer class="testimonial__author">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 48 48'%3E%3Ccircle cx='24' cy='24' r='24' fill='%23e2e8f0'/%3E%3Ctext x='24' y='28' text-anchor='middle' fill='%23475569' font-family='Arial' font-size='16'%3EAN%3C/text%3E%3C/svg%3E" alt="" class="testimonial__avatar" loading="lazy">
                            <div>
                                <cite class="testimonial__name">Amina Nkomo</cite>
                                <p class="testimonial__title">Proviseure, Collège Bilingue de Bafoussam</p>
                            </div>
                        </footer>
                    </article>
                </div>
            </div>
        </section>

        <!-- FAQ -->
        <section class="faq" id="faq" aria-labelledby="faq-title">
            <div class="container">
                <header class="section-header">
                    <h2 id="faq-title" class="section-title">Questions fréquentes</h2>
                </header>
                
                <div class="faq__list">
                    <details class="faq__item">
                        <summary class="faq__question">Puis-je migrer mes données d'élèves existantes ?</summary>
                        <div class="faq__answer">
                            <p>Oui, nous proposons un service d'import gratuit pour tous vos données existantes. 
                            Notre équipe vous accompagne dans la migration depuis Excel, CSV ou d'autres systèmes de gestion scolaire.</p>
                        </div>
                    </details>
                    
                    <details class="faq__item">
                        <summary class="faq__question">Quels moyens de paiement sont supportés ?</summary>
                        <div class="faq__answer">
                            <p>Geschool supporte Orange Money, MTN Mobile Money, virement bancaire et paiement par carte. 
                            Les frais de transaction sont transparents et compétitifs.</p>
                        </div>
                    </details>
                    
                    <details class="faq__item">
                        <summary class="faq__question">Mes données sont-elles sécurisées ?</summary>
                        <div class="faq__answer">
                            <p>Absolument. Nous utilisons un chiffrement de niveau bancaire, des sauvegardes automatiques quotidiennes 
                            et nos serveurs sont hébergés en conformité avec les réglementations locales sur la protection des données.</p>
                        </div>
                    </details>
                    
                    <details class="faq__item">
                        <summary class="faq__question">Puis-je essayer avant de m'engager ?</summary>
                        <div class="faq__answer">
                            <p>Bien sûr ! Nous offrons un essai gratuit de 14 jours sans engagement. 
                            Aucune carte de crédit n'est requise pour démarrer votre période d'essai.</p>
                        </div>
                    </details>
                    
                    <details class="faq__item">
                        <summary class="faq__question">Le support client est-il disponible en français ?</summary>
                        <div class="faq__answer">
                            <p>Oui, notre équipe support parle français et est disponible du lundi au vendredi de 8h à 18h (heure de Yaoundé). 
                            Nous proposons aussi une base de connaissances complète en français.</p>
                        </div>
                    </details>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer class="footer" id="contact" role="contentinfo">
        <div class="container">
            <div class="footer__content">
                <div class="footer__section">
                    <div class="footer__brand">
                        <svg class="footer__logo" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                        <span class="footer__title">Geschool</span>
                    </div>
                    <p class="footer__description">
                        La solution moderne de gestion scolaire pour l'Afrique francophone. 
                        Simplifiez votre administration scolaire dès aujourd'hui.
                    </p>
                </div>
                
                <nav class="footer__section" aria-labelledby="footer-product">
                    <h3 id="footer-product" class="footer__heading">Produit</h3>
                    <ul class="footer__links">
                        <li><a href="#features" class="footer__link">Fonctionnalités</a></li>
                        <li><a href="#pricing" class="footer__link">Tarifs</a></li>
                        <li><a href="#" class="footer__link">Sécurité</a></li>
                        <li><a href="#" class="footer__link">API</a></li>
                    </ul>
                </nav>
                
                <nav class="footer__section" aria-labelledby="footer-company">
                    <h3 id="footer-company" class="footer__heading">Entreprise</h3>
                    <ul class="footer__links">
                        <li><a href="#" class="footer__link">À propos</a></li>
                        <li><a href="#" class="footer__link">Carrières</a></li>
                        <li><a href="#" class="footer__link">Presse</a></li>
                        <li><a href="#" class="footer__link">Partenaires</a></li>
                    </ul>
                </nav>
                
                <div class="footer__section">
                    <h3 class="footer__heading">Newsletter</h3>
                    <p class="footer__newsletter-text">Restez informé de nos nouveautés</p>
                    <form class="footer__newsletter" id="newsletterForm">
                        <input type="email" class="footer__newsletter-input" placeholder="votre@email.com" required>
                        <button type="submit" class="btn btn--primary">S'abonner</button>
                    </form>
                </div>
            </div>
            
            <div class="footer__bottom">
                <div class="footer__legal">
                    <a href="#" class="footer__legal-link">Mentions légales</a>
                    <a href="#" class="footer__legal-link">Politique de confidentialité</a>
                    <a href="#" class="footer__legal-link">CGU</a>
                </div>
                
                <div class="footer__social">
                    <a href="#" class="footer__social-link" aria-label="LinkedIn">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    <a href="#" class="footer__social-link" aria-label="Twitter">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                </div>
            </div>
            
            <div class="footer__copyright">
                <p>&copy; 2025 Geschool. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- MODAL D'INSCRIPTION -->
    <div class="modal" id="signupModal" role="dialog" aria-labelledby="signup-title" aria-hidden="true">
        <div class="modal__backdrop"></div>
        <div class="modal__content">
            <header class="modal__header">
                <h2 id="signup-title" class="modal__title">Commencez votre essai gratuit</h2>
                <button class="modal__close" aria-label="Fermer">&times;</button>
            </header>
            
            <form class="signup-form" id="signupForm">
                <div class="form-group">
                    <label for="fullName" class="form-label">Nom complet *</label>
                    <input type="text" id="fullName" name="fullName" class="form-input" required>
                    <span class="form-error" id="fullNameError"></span>
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">Email professionnel *</label>
                    <input type="email" id="email" name="email" class="form-input" required>
                    <span class="form-error" id="emailError"></span>
                </div>
                
                <div class="form-group">
                    <label for="institution" class="form-label">Nom de l'établissement *</label>
                    <input type="text" id="institution" name="institution" class="form-input" required>
                    <span class="form-error" id="institutionError"></span>
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe *</label>
                    <input type="password" id="password" name="password" class="form-input" required>
                    <span class="form-error" id="passwordError"></span>
                </div>
                
                <div class="form-group form-checkbox">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms" class="checkbox-label">
                        J'accepte les <a href="#" class="link">conditions d'utilisation</a> et la 
                        <a href="#" class="link">politique de confidentialité</a>
                    </label>
                </div>
                
                <button type="submit" class="btn btn--primary btn--full btn--loading" id="submitBtn">
                    <span class="btn-text">Démarrer l'essai gratuit</span>
                    <span class="btn-loader" aria-hidden="true"></span>
                </button>
                
                <p class="signup-form__note">
                    Aucune carte de crédit requise • Essai de 14 jours
                </p>
            </form>
        </div>
    </div>

    <script src="{{asset('assets/css/welcom.js')}}"></script>
</body>
</html>