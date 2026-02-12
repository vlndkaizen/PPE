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

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Archivo', sans-serif;
            background: var(--light) !important;
            color: var(--dark);
            overflow-x: hidden;
            line-height: 1.6;
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
            inset: 0;
            background-image: url("https://static.vecteezy.com/system/resources/previews/034/060/841/large_2x/inside-moden-car-background-luxury-car-interior-elements-wallpaper-black-leather-car-interior-photo.jpg");
            background-size: cover;
            background-position: center;
            opacity: 0.3;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            width: 100%;
            padding: 2rem 4rem;
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hero h1 { font-size: 70px; margin-bottom: 1.5rem; }

        .hero p {
            font-size: clamp(1rem, 2vw, 1.3rem);
            max-width: 700px;
            margin: 0 auto 3rem;
        }

        .cta-button {
            display: inline-block;
            padding: 1.2rem 3rem;
            background: var(--primary);
            color: var(--dark);
            text-decoration: none;
            font-weight: 700;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            background: var(--accent);
            box-shadow: 0 10px 30px rgba(255,220,0,0.3);
        }

        .vehicles-section { padding: 8rem 2rem; }

        .section-title {
            font-size: clamp(2rem, 5vw, 3.5rem);
            text-align: center;
            margin-bottom: 1rem;
        }

        .section-description {
            font-size: 22px;
            color: var(--grey);
            max-width: 1200px;
            margin: 0 auto 3rem;
        }

        .vehicles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 3rem;
            max-width: 1400px;
            margin: auto;
        }

        .vehicle-card {
            background: var(--light);
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid var(--border-grey);
            transition: 0.3s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .vehicle-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary);
        }

        .vehicle-image { height: 250px; overflow: hidden; }

        .vehicle-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.6s;
        }

        .vehicle-card:hover img { transform: scale(1.1); }

        .vehicle-info { padding: 2rem; }

        .vehicle-name { font-size: 1.8rem; font-weight: 700; margin-bottom: 0.5rem; }

        .vehicle-description { color: var(--grey); margin-bottom: 1.5rem; }

        .vehicle-buttons { display: flex; gap: 1rem; }

        .btn-primary {
            flex: 1;
            padding: 0.9rem 1.5rem;
            background: var(--primary);
            color: var(--dark);
            text-align: center;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-primary:hover { background: var(--accent); transform: translateX(5px); }

        @media (max-width: 768px) {
            .hero h1 { font-size: 40px; }
            .vehicles-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>

<section class="hero">
    <div class="hero-content">
        <h1>Choisissez le véhicule idéal pour l'apprentissage de la conduite</h1>
        <p>Découvrez notre gamme complète de véhicules adaptés à tous vos besoins professionnels.</p>
        <a href="#vehicules" class="cta-button">Découvrir nos véhicules</a>
    </div>
</section>

<section id="vehicules" class="vehicles-section">

    <h2 class="section-title">Notre Flotte</h2>

    <div class="section-description">
        <p>Des véhicules récents, confortables et sécurisés pour garantir un apprentissage optimal.</p>
    <div class="section" >
     <h2 class="section-title">Le véhicule idéal pour débuter la conduite</h2>
    <p style="color: var(--text-medium); font-size: 1.1rem; margin-bottom: 30px;">
   Pour un apprentissage de la conduite sûr et efficace, il est essentiel de choisir le véhicule adapté. Des voitures fiables, modernes et faciles à prendre en main garantissent une expérience fluide pour les élèves, quel que soit leur niveau.</p>
    <p>Des modèles compacts aux citadines spacieuses, en boîte automatique ou manuelle, offrent une conduite intuitive, des technologies de sécurité avancées et un confort optimal pour les premiers kilomètres. Ces véhicules permettent aux élèves de se concentrer sur l'apprentissage, sans stress, et facilitent la progression rapide et sécurisée.</p><br>
   <p> Choisir le bon véhicule, c'est allier sécurité, confort et praticité, et offrir aux futurs conducteurs une expérience d'apprentissage agréable et professionnelle. Découvrez notre sélection de véhicules spécialement adaptés aux besoins des auto-écoles et commencez l'aventure de la conduite avec confiance.</p>
    </p>
    </div>

    <div class="vehicle-grid">
        <?php if(!empty($lesvehicules) && is_array($lesvehicules)): ?>
            <?php foreach($lesvehicules as $vehicule): ?>
                <div class="vehicle-card">
                    <!-- AJOUT: Affichage de l'image -->
                    <div class="vehicle-image" style="height: 200px; overflow: hidden; background: #f0f0f0;">
                        <?php if (!empty($vehicule['image']) && file_exists(__DIR__ . '/../../uploads/vehicules/' . $vehicule['image'])
): ?>
                            <img src="uploads/vehicules/<?= $vehicule['image'] ?>" 
                                 alt="<?= htmlspecialchars($vehicule['marque'] . ' ' . $vehicule['modele']) ?>"
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        <?php else: ?>
                            <!-- Image par défaut SVG -->
                            <svg width="100%" height="100%" viewBox="0 0 200 200" style="background: #e0e0e0;">
                                <rect x="40" y="80" width="120" height="60" fill="#0F4C81" rx="5"/>
                                <circle cx="70" cy="150" r="15" fill="#333"/>
                                <circle cx="130" cy="150" r="15" fill="#333"/>
                                <rect x="50" y="70" width="100" height="30" fill="#1E5A96" rx="3"/>
                                <text x="100" y="110" text-anchor="middle" fill="white" font-size="14" font-weight="bold">
                                    <?= strtoupper(substr($vehicule['marque'], 0, 1)) ?>
                                </text>
                            </svg>
                        <?php endif; ?>
                    </div>
                    
                    <div class="vehicle-info">
                        <h3><?= htmlspecialchars($vehicule['marque']) ?> <?= htmlspecialchars($vehicule['modele']) ?></h3>
                        <div class="vehicle-plate"><?= htmlspecialchars($vehicule['immatriculation']) ?></div>
                        <div style="margin-top: 15px;">
                            <span class="badge badge-success">Disponible</span>
                        </div>
                        
                        <!-- AJOUT: Informations supplémentaires -->
                        <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #e0e0e0;">
                            <p style="font-size: 0.9rem; color: #666; line-height: 1.6;">
                                <strong style="color: #0F4C81;">Équipements :</strong><br>
                                • Double commande<br>
                                • Climatisation<br>
                                • ABS & ESP<br>
                                • Caméra de recul
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="card" style="grid-column: 1 / -1; text-align: center; padding: 60px;">
                <p style="color: var(--text-medium); font-size: 1.1rem;">
                    Nos véhicules sont actuellement en cours de maintenance.
                </p>
            </div>
        <?php endif; ?>
    </div>

    <div class="vehicles-grid">

        <div class="vehicle-card">
            <div class="vehicle-image">
                <img src="https://www.automobile-magazine.fr/asset/cms/224961/config/172081/la-version-roland-garros-de-la-renault-5-e-tech-electric-sera-commercialise-en-2025.jpg" alt="Renault 5">
            </div>
            <div class="vehicle-info">
                <h3 class="vehicle-name">Renault 5 E-Tech</h3>
                <p class="vehicle-description">100% électrique, idéale pour l'apprentissage urbain.</p>
                <div class="vehicle-buttons">
                    <a href="#" class="btn-primary">Découvrir</a>
                </div>
            </div>
        </div>

        <div class="vehicle-card">
            <div class="vehicle-image">
                <img src="https://www.electrichunter.com/sites/default/files/field/gallery/Renault-Clio-E-Tech-hybrid-2020-car-02-245.jpg" alt="Renault Clio">
            </div>
            <div class="vehicle-info">
                <h3 class="vehicle-name">Renault Clio E-Tech</h3>
                <p class="vehicle-description">Hybride, confortable et économique.</p>
                <div class="vehicle-buttons">
                    <a href="#" class="btn-primary">Découvrir</a>
                </div>
            </div>
        </div>

        <div class="vehicle-card">
            <div class="vehicle-image">
                <img src="https://rcesproductsimages-wired-prod-1-euw1.wrd-aws.com/pim/catalog/a/7/2/0/a720c5769809127e77f00fd8f93a58989ab0f646_1055387cfb4f75bacb932d031a8206aa2cbb47ef_redim_PIM_HHN_RFR00.jpg" alt="Renault Austral">
            </div>
            <div class="vehicle-info">
                <h3 class="vehicle-name">Renault Austral</h3>
                <p class="vehicle-description">SUV premium, espace et sécurité maximale.</p>
                <div class="vehicle-buttons">
                    <a href="#" class="btn-primary">Découvrir</a>
                </div>
            </div>
        </div>

    </div>

</section>

</body>
</html>
