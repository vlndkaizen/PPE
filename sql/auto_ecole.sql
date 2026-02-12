<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Solutions pour les Voitures | Auto-école</title>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@300;400;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #FFDC00;
            --dark: #000000;
            --light: #FFFFFF;
            --grey: #666666;
            --light-grey: #F5F5F5;
            --border-grey: #E0E0E0;
            --accent: #FF6B00;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Archivo', sans-serif;
            background: var(--light) !important;
            color: var(--dark);
            overflow-x: hidden;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .hero {
            height: 100vh;
          
            display: flex;
            background: var(--light);
            overflow: hidden;
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            background-image: url("https://static.vecteezy.com/system/resources/previews/034/060/841/large_2x/inside-moden-car-background-luxury-car-interior-elements-wallpaper-black-leather-car-interior-photo.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.3;
        }
.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    width: 100%;
    max-width: 100%;
    padding: 2rem 4rem;
    animation: fadeInUp 1s ease-out;
}


        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero h1 {
            font-size: 70px;
            margin-bottom: 1.5rem;
            line-height: 1.1;
            color: var(--dark);
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        .hero p {
            font-size: clamp(1rem, 2vw, 1.3rem);
            color: var(--dark);
            max-width: 700px;
            margin: 0 auto 3rem;
            animation: fadeInUp 1s ease-out 0.4s both;
        }

        .cta-button {
            display: inline-block;
            padding: 1.2rem 3rem;
            background: var(--primary);
            color: var(--dark);
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            position: relative;
            animation: fadeInUp 1s ease-out 0.6s both;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 220, 0, 0.3);
            background: var(--accent);
        }

        /* Section véhicules */
        .vehicles-section {
            padding: 8rem 2rem;
            background: var(--light);
            position: relative;
            width: 100%;
        }

        .section-title {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 700;
            text-align: center;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .section-subtitle {
            text-align: center;
            color: var(--grey);
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto 3rem;
        }

        .section-description {
            font-size: 22px;
            color: var(--grey);
            max-width: 1200px;
            margin: 0 auto 3rem;
            line-height: 1.8;
        }

        .vehicles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 3rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .vehicle-card {
            background: var(--light);
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            transition: all 0.3s ease;
            border: 1px solid var(--border-grey);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .vehicle-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            border-color: var(--primary);
        }

        .vehicle-image {
            width: 100%;
            height: 250px;
            background: var(--light-grey);
            position: relative;
            overflow: hidden;
        }

        .vehicle-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s;
        }

        .vehicle-card:hover .vehicle-image img {
            transform: scale(1.1);
        }

        .vehicle-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: var(--primary);
            color: var(--dark);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.85rem;
            font-family: 'Space Mono', monospace;
            z-index: 2;
        }

        .vehicle-info {
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        .vehicle-name {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .vehicle-description {
            color: var(--grey);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .vehicle-specs {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .spec-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: var(--grey);
        }

        .spec-icon {
            width: 20px;
            height: 20px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            color: var(--dark);
            font-weight: 700;
        }

        .vehicle-price {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1rem;
            font-family: 'Space Mono', monospace;
        }

        .vehicle-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-primary, .btn-secondary {
            flex: 1;
            min-width: 140px;
            padding: 0.9rem 1.5rem;
            text-decoration: none;
            text-align: center;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-block;
        }

        .btn-primary {
            background: var(--primary);
            color: var(--dark);
        }

        .btn-primary:hover {
            background: var(--accent);
            transform: translateX(5px);
        }

        .btn-secondary {
            background: transparent;
            color: var(--dark);
            border: 2px solid var(--border-grey);
        }

        .btn-secondary:hover {
            background: var(--light-grey);
            border-color: var(--primary);
        }

        /* Section offres */
        .offers-section {
            padding: 8rem 2rem;
            background: var(--light-grey);
            position: relative;
        }

        .offers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 3rem;
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .offer-card {
            background: var(--light);
            border-radius: 8px;
            padding: 3rem;
            border: 1px solid var(--border-grey);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .offer-card:hover {
            border-color: var(--primary);
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }

        .offer-header {
            margin-bottom: 2rem;
        }

        .offer-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .offer-price {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            font-family: 'Space Mono', monospace;
        }

        .offer-price span {
            font-size: 1rem;
            color: var(--grey);
        }

        .offer-features {
            list-style: none;
            margin-bottom: 2rem;
        }

        .offer-features li {
            padding: 0.8rem 0;
            border-bottom: 1px solid var(--border-grey);
            color: var(--grey);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .offer-features li::before {
            content: '✓';
            color: var(--primary);
            font-weight: 700;
            font-size: 1.2rem;
        }

        /* Animations d'entrée au scroll */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s, transform 0.8s;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero {
                height: 100vh;
                width: 100vw;
                margin: 0;
                padding: 0;
            }

            .hero-content {
                padding: 1rem;
            }

            .hero h1 {
                font-size: 40px;
            }

            .vehicles-grid,
            .offers-grid {
                grid-template-columns: 1fr;
            }

            .vehicles-section,
            .offers-section {
                padding: 4rem 1rem;
            }

            .offer-card {
                padding: 2rem;
            }

            .section-description {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
     <div style="width:100% !important">
    <section class="hero">
        <div class="hero-content">
            <h1>Choisissez le véhicule idéal pour l'apprentissage de la conduite</h1>
            <p>Découvrez notre gamme complète de véhicules adaptés à tous vos besoins professionnels. Des citadines compactes aux berlines spacieuses, trouvez le véhicule idéal pour votre activité.</p>
            <a href="#offres" class="cta-button">DÉCOUVRIR NOS OFFRES</a>
        </div>
    </section>
     </div>

    <!-- Section Véhicules -->
    <section class="vehicles-section">
        <h2 class="section-title">Le véhicule idéal pour débuter la conduite</h2>
        
        <div class="section-description">
            <p style="margin-bottom: 1.5rem;">Pour un apprentissage de la conduite sûr et efficace, il est essentiel de choisir le véhicule adapté. Des voitures fiables, modernes et faciles à prendre en main garantissent une expérience fluide pour les élèves, quel que soit leur niveau.</p>
            
            <p style="margin-bottom: 1.5rem;">Des modèles compacts aux citadines spacieuses, en boîte automatique ou manuelle, offrent une conduite intuitive, des technologies de sécurité avancées et un confort optimal pour les premiers kilomètres. Ces véhicules permettent aux élèves de se concentrer sur l'apprentissage, sans stress, et facilitent la progression rapide et sécurisée.</p>
            
            <p>Choisir le bon véhicule, c'est allier sécurité, confort et praticité, et offrir aux futurs conducteurs une expérience d'apprentissage agréable et professionnelle. Découvrez notre sélection de véhicules spécialement adaptés aux besoins des auto-écoles et commencez l'aventure de la conduite avec confiance.</p>
        </div>

        <br><br>

        <div class="vehicles-grid">
            <!-- Véhicule 1: Renault 5 -->
            <div class="vehicle-card fade-in">
                <div class="vehicle-image">
                    <div class="vehicle-badge">ÉLECTRIQUE</div>
                    <img src="https://www.automobile-magazine.fr/asset/cms/224961/config/172081/la-version-roland-garros-de-la-renault-5-e-tech-electric-sera-commercialise-en-2025.jpg" alt="Renault 5 E-Tech Électrique">
                </div>
                <div class="vehicle-info">
                    <h3 class="vehicle-name">Renault 5 E-Tech Électrique</h3>
                    <p class="vehicle-description">L'icône électrique nouvelle génération. Design rétro-futuriste et technologies de pointe pour une conduite urbaine exceptionnelle.</p>
                    <div class="vehicle-specs">
                        <div class="spec-item">
                            <div class="spec-icon">⚡</div>
                            <span>400 km d'autonomie</span>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon">⏱</div>
                            <span>Charge rapide 30min</span>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon">🔋</div>
                            <span>150 ch</span>
                        </div>
                    </div>
                    <div class="vehicle-buttons">
                        <a href="#" class="btn-primary">Découvrir</a>
                        
                    </div>
                </div>
            </div>

            <!-- Véhicule 2: Renault Clio -->
            <div class="vehicle-card fade-in">
                <div class="vehicle-image">
                    <div class="vehicle-badge">HYBRIDE</div>
                    <img src="https://www.electrichunter.com/sites/default/files/field/gallery/Renault-Clio-E-Tech-hybrid-2020-car-02-245.jpg" alt="Renault Clio E-Tech Full Hybrid">
                </div>
                <div class="vehicle-info">
                    <h3 class="vehicle-name">Renault Clio E-Tech Full Hybrid</h3>
                    <p class="vehicle-description">La référence hybride. Allie performance, économie et confort pour une conduite sans compromis au quotidien.</p>
                    <div class="vehicle-specs">
                        <div class="spec-item">
                            <div class="spec-icon">💨</div>
                            <span>145 ch</span>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon">⛽</div>
                            <span>4.3 L/100km</span>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon">🔧</div>
                            <span>Boîte auto</span>
                        </div>
                    </div>
                    <div class="vehicle-buttons">
                        <a href="#" class="btn-primary">Découvrir</a>
                    </div>
                </div>
            </div>

            <!-- Véhicule 3: Renault Austral -->
            <div class="vehicle-card fade-in">
                <div class="vehicle-image">
                    <div class="vehicle-badge">PREMIUM</div>
                    <img src="https://rcesproductsimages-wired-prod-1-euw1.wrd-aws.com/pim/catalog/a/7/2/0/a720c5769809127e77f00fd8f93a58989ab0f646_1055387cfb4f75bacb932d031a8206aa2cbb47ef_redim_PIM_HHN_RFR00.jpg" alt="Renault Austral E-Tech">
                </div>
                <div class="vehicle-info">
                    <h3 class="vehicle-name">Renault Austral E-Tech</h3>
                    <p class="vehicle-description">Le SUV premium hybride. Espace généreux, technologies avancées et confort haut de gamme pour vos déplacements professionnels.</p>
                    <div class="vehicle-specs">
                        <div class="spec-item">
                            <div class="spec-icon">👥</div>
                            <span>5 places</span>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon">📦</div>
                            <span>555L coffre</span>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon">🎯</div>
                            <span>200 ch</span>
                        </div>
                    </div>
                    <div class="vehicle-buttons">
                        <a href="#" class="btn-primary">Découvrir</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="offers-section" id="offres">
        <h2 class="section-title">NOS VÉHICULES PÉDAGOGIQUES</h2>
        <p class="section-subtitle">Des voitures modernes, sûres et spécialement équipées pour l’apprentissage de la conduite.</p>
        
        <div class="offers-grid">
            <div class="offer-card fade-in">
                <div class="offer-header">
                    <h3 class="offer-title">Citadine Pédagogique – Boîte Manuelle</h3>
                    <div><b>À partir de 20€/heure</b></div>
                </div>
                <ul class="offer-features">
                    <li>Double commande (pédales + rétroviseurs instructeur)</li>
                    <li>Direction souple & prise en main facile</li>
                    <li>Idéale pour débuter la conduite</li>
                    <li>Parfaite pour la ville et les manœuvres</li>
                </ul>
                <strong>Le choix idéal pour apprendre en toute confiance</strong>
                <a href="#" class="btn-primary" style="width: 100%; margin-top: 1rem;">Profiter de l'offre</a>
            </div>

            <div class="offer-card fade-in">
                <div class="offer-header">
                    <h3 class="offer-title">Véhicule Électrique – Nouvelle Génération</h3><br>
                    <div><b>À partir de 22€/heure</b></div>
                </div>
                <ul class="offer-features">
                    <li>Conduite fluide & silencieuse</li>
                    <li>Zéro émission</li>
                    <li>Boîte automatique</li>
                    <li>Parfaite pour une conduite moderne</li>
                </ul>
                <strong>Apprendre à conduire en douceur et en respectant l’environnement</strong>
                <a href="#" class="btn-primary" style="width: 100%; margin-top: 1rem;">Profiter de l'offre</a>
            </div>
            <div class="offer-card fade-in">
                <div class="offer-header">
                    <h3 class="offer-title">SUV Pédagogique – Grand Confort</h3><br>
                    <div><b>À partir de 25€/heure</b></div>
                </div>
                <ul class="offer-features">
                    <li>Position de conduite haute</li>
                    <li>Aides à la conduite avancées</li>
                    <li>Habitacle spacieux</li>
                    <li>Confort premium</li>
                </ul>
                <strong>Idéal pour gagner en assurance et en maîtrise</strong>
                <a href="#" class="btn-primary" style="width: 100%; margin-top: 1rem;">Profiter de l'offre</a>
            </div>
        </div>
    </section>
<section class="why-vehicles">
  <div class="container">
    <h2>Pourquoi nos véhicules sont adaptés à l’apprentissage ?</h2>
     <ul class="offer-features">
      <li>
        <span class="icon">🚦</span>
        <div>
          <h3>Double commande homologuée</h3>
          <p>Sécurité maximale grâce aux doubles pédales et rétroviseurs instructeur.</p>
        </div>
      </li>
      <li>
        <span class="icon">🛡</span>
        <div>
          <h3>Véhicules récents et sécurisés</h3>
          <p>Flotte moderne équipée des dernières technologies de sécurité.</p>
        </div>
      </li>
      <li>
        <span class="icon">🧠</span>
        <div>
          <h3>Aides à la conduite modernes</h3>
          <p>Aide au démarrage en côte, freinage d’urgence, maintien dans la voie.</p>
        </div>
      </li>
      <li>
        <span class="icon">👁</span>
        <div>
          <h3>Excellente visibilité</h3>
          <p>Poste de conduite ergonomique et vision optimale pour anticiper.</p>
        </div>
      </li>
    </ul>
  </div>
</section>




    <script>
        // Animation au scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, index * 100);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });

        // Smooth scroll pour les ancres
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>