<?php
/**
 * Configuration statique du site MIB — Manager In Business.
 *
 * Tout ce qui change moins d'une fois par an vit ici, pas en base :
 * le fichier est compilé une fois par OPcache puis servi depuis la RAM,
 * sans aucune requête MySQL.
 *
 * Textes : vouvoiement, mots du dirigeant de TPE/PME, aucun chiffre non démontré.
 */

defined( 'ABSPATH' ) || exit;

return array(

	'brand' => array(
		'name'        => 'MIB',
		'long_name'   => 'Manager In Business',
		'vision'      => 'Management Intelligence & Business',
		'tagline'     => 'Digital & Humain',
		'promise'     => 'Voir plus tôt. Comprendre plus vite. Agir au bon endroit.',
		'signature'   => array( "Rendre visible l'intelligence", 'qui agit derrière la performance.' ),
		'description' => "MIB relie la performance de vos équipes et celle de vos outils numériques. Nous repérons ce qui se dérègle, puis nous envoyons le bon spécialiste au bon endroit.",
		'hero_lead'   => 'L’ensemble des métiers du digital réunis avec des experts ressources et cœur de métier. Votre expert, nous l’avons.',
		'email'       => 'contact@managerinbusiness.com',
		// Lien de prise de rendez-vous (Calendly à créer). Vide = le bouton ouvre un e-mail.
		'cal_url'     => '',
		'city'        => 'Toulouse',
		'postal_code' => '31200',
		'country'     => 'FR',
	),

	// Appel à l'action unique du site.
	'cta' => array(
		'label' => 'Demander mon audit offert',
		'note'  => '1er audit offert · sans engagement · réponse rapide',
	),

	/*
	 * Pastilles d'en-tête. Une valeur null masque la pastille :
	 * on n'affiche que des chiffres réellement mesurés et datés.
	 */
	'metrics' => array(
		'co2'       => null,             // ex. '0.03g' après mesure EcoIndex / Website Carbon
		'co2_date'  => null,             // ex. '29/10/2026'
		'rgaa'      => null,             // ex. 'conforme' après audit ; null = masqué
		'rgaa_page' => '/accessibilite/',
	),

	'home' => array(

		'problem' => array(
			'label' => 'Le constat',
			'title' => 'Accélérez le digital, boostez vos résultats.',
			'text'  => 'Vos outils deviennent un levier de croissance. Vos équipes gagnent en productivité.',
			'more'  => array(
				"IA, automatisation, nouveaux logiciels, travail hybride : chaque changement numérique modifie les rythmes, les compétences et la charge mentale. Fatigue, perte de repères, décrochage d'une partie de l'équipe.",
				"L'inverse est vrai : un outil mal adopté ne rapporte rien. La performance digitale et la performance humaine forment une seule boucle. C'est elle que nous surveillons.",
			),
			'pains' => array(
				array( 'q' => 'Je veux utiliser l’IA, mais je ne sais pas par où commencer.', 'a' => 'L’IA là où elle vous fait gagner du temps, pas ailleurs.', 'to' => 'ingenierie-data-ia' ),
				array( 'q' => 'Je n’ai plus d’énergie en fin de semaine.', 'a' => 'Vos équipes au sommet, du lundi au vendredi.', 'to' => 'performance-humaine' ),
				array( 'q' => 'Mon équipe décroche depuis le nouvel outil.', 'a' => 'Intégré avec vos équipes, pensé pour votre croissance.', 'to' => 'rse-qualite-de-vie-au-travail' ),
				array( 'q' => 'Mon site ne m’apporte aucun client.', 'a' => 'Stoppez les pertes : faites de votre site votre moteur de rentabilité.', 'to' => 'web-design-communication' ),
			),
		),

		'answer' => array(
			'label' => 'La réponse MIB',
			'title' => 'Humain et digital : une alliance gagnante.',
			'text'  => 'Transformez chaque évolution en croissance. Nous gardons le cap avec vous.',
			'more'  => array(
				"Nous ne traitons pas votre site d'un côté et vos équipes de l'autre. Nous observons comment l'un agit sur l'autre : signaux faibles, tendances, premiers indices.",
				"Nous intervenons avant qu'un déséquilibre ne s'installe, puis nous remesurons. Sans promettre de prédire l'avenir : nous le regardons venir.",
			),
			'loop'  => array(
				array( 't' => 'Transformation digitale', 'd' => 'IA, outils, nouveaux usages' ),
				array( 't' => "Effets sur l'humain", 'd' => 'Charge, repères, engagement' ),
				array( 't' => 'Signaux faibles', 'd' => 'Les premiers indices' ),
				array( 't' => 'Intervention ciblée', 'd' => 'Une action, une nouvelle mesure' ),
			),
			'loop_note' => 'Observer · comprendre · intervenir · mesurer · adapter',
		),

		'method' => array(
			'label' => 'Méthode',
			'title' => 'Nous mesurons pour honorer votre savoir-faire, sécuriser vos choix et amplifier votre croissance.',
			'steps' => array(
				array( 't' => 'Mesurer', 'd' => 'Nous évaluons ce qui compte : votre site, vos outils, votre organisation, l’énergie de vos équipes.' ),
				array( 't' => 'Comprendre', 'd' => 'Nous repérons les tendances et les signaux faibles, avant qu’ils ne deviennent des problèmes.' ),
				array( 't' => 'Intervenir', 'd' => 'Nous déclenchons la réponse adaptée, avec le spécialiste adapté. Rien de plus.' ),
				array( 't' => 'Adapter', 'd' => 'Nous remesurons, et nous ajustons l’action tant que ce n’est pas réglé.' ),
			),
			'demo'  => 'Pendant le diagnostic, nous vous montrons nos outils d’évaluation en situation réelle.',
		),

		'action' => array(
			'label' => "Capacité d'action",
			'title' => 'Des indicateurs précis, des experts engagés.',
			'text'  => 'Nous déployons l’excellence pour amplifier et sécuriser votre savoir-faire. Chaque besoin repéré a son spécialiste, en présentiel ou à distance.',
		),

		'about' => array(
			'label' => 'Qui sommes-nous',
			'title' => 'Management Intelligence & Business.',
			'punch' => 'Une collaboration transparente, des résultats visibles.',
			'text'  => 'Votre métier au centre, notre accompagnement comme accélérateur. Digital & Humain : l’intelligence artificielle de MIB d’un côté, l’expérience terrain du fondateur et de ses experts de l’autre.',
			'more'  => array(
				"Nous sommes partis d'un constat : la technologie évolue parfois plus vite que notre capacité collective à nous adapter. Ce qui commence comme une transformation digitale peut devenir, petit à petit, un enjeu humain.",
				"MIB se place à cette jonction. Plus de 25 métiers du digital : ingénieurs data et réseaux, développeurs web et applicatifs, designers, graphistes, experts en marketing et en communication. Plus de 15 experts en santé, fluidité, bien-être et performance métier.",
				"Vous avez un interlocuteur. Derrière lui, l'équipe qu'il faut à votre situation.",
			),
		),

		/*
		 * Gains estimés à 3 et 6 mois (règle du fondateur : vendre le gain, pas la prestation).
		 * Estimations prudentes, jamais présentées comme garanties. À remplacer par
		 * des résultats mesurés dès les premières études de cas.
		 */
		'gains' => array(
			'label' => 'Ce que vous gagnez',
			'title' => 'Le client n’achète pas une prestation. Il achète un gain.',
			'text'  => 'Gain estimé pour une petite structure, en euros, en croissance et en heures libérées.',
			'rows'  => array(
				array( 'who' => 'Artisans du bâtiment', 'm3' => '+3 500 à 7 000 €', 'm6' => '+10 500 à 14 000 €', 'pct' => '+20 à 40 % de chantiers', 'hours' => '48 h puis 96 h libérées' ),
				array( 'who' => 'Cabinets comptables', 'm3' => '+3 600 €', 'm6' => '+9 000 €', 'pct' => '+14 % de capacité', 'hours' => '60 h puis 120 h libérées' ),
				array( 'who' => 'Avocats, santé libérale', 'm3' => '+3 600 €', 'm6' => '+9 000 €', 'pct' => '+14 % de capacité', 'hours' => '60 h puis 120 h libérées' ),
			),
			'note'  => 'Estimations prudentes, non garanties : heures valorisées à 60 € de l’heure, demandes entrantes en hausse après correction du site et des avis Google. Hypothèses détaillées lors du diagnostic. Nous les remplacerons par nos résultats mesurés.',
		),

		/*
		 * Offre d'appel : Pack Mobile Express.
		 */
		'pack' => array(
			'label'     => 'Offre de lancement',
			'title'     => 'Pack Mobile Express',
			'text'      => 'Sur mobile, plus d’une visite sur deux est abandonnée quand une page met plus de 3 secondes à s’afficher (Google). Nous corrigeons votre site WordPress en 10 jours ouvrés.',
			'items'     => array(
				'Mesure Google PageSpeed avant travaux, captures datées',
				'Images, cache, scripts et polices corrigés',
				'Mesure après travaux, rapport clair d’une page',
			),
			'price'     => '690 €',
			'founder'   => '490 €',
			'founder_note' => 'Prix fondateur réservé à nos 5 premiers clients, en échange d’une étude de cas. Ensuite : 690 €.',
			'guarantee' => 'Garantie : +30 points sur la note mobile Google PageSpeed (ou 90/100 si vous partez au-dessus de 60), sinon remboursé. La note est mesurée par Google, pas par nous.',
			'terms'     => 'Médiane de 3 mesures sur la page d’accueil, avant et après. Pack proposé après diagnostic, quand l’objectif est atteignable.',
		),

		'trust' => array(
			'label' => 'Confiance',
			'title' => 'Un cadre clair. Aucune promesse en l’air.',
			'items' => array(
				array( 't' => 'Aucune donnée conservée', 'd' => 'Utilisées pour le diagnostic, puis supprimées.' ),
				array( 't' => 'Anonymat des équipes', 'd' => 'Des tendances, jamais de réponses individuelles.' ),
				array( 't' => 'Une méthode documentée', 'd' => 'Présentée dès le premier échange.' ),
				array( 't' => 'Aucun chiffre inventé', 'd' => 'Seuls comptent les résultats mesurés chez vous.' ),
			),
		),
	),

	/*
	 * Les 4 leviers d'intervention. La clé est le slug de la page WordPress.
	 */
	'groups' => array(
		'humain'  => 'Humain',
		'digital' => 'Digital',
	),
	'expertises' => array(
		'performance-humaine' => array(
			'group' => 'humain',
			'title' => 'Performance humaine',
			'tags'  => 'Coaching individuel · Coaching collectif · Préparation physique et mentale · Stress et récupération',
			'desc'  => 'Coaching individuel et collectif, préparation physique et mentale, ateliers sur le stress et la récupération. Pour les dirigeants comme pour les équipes.',
			'lead'  => 'Vos équipes au sommet, du lundi au vendredi : énergie, concentration et une dynamique qui tient dans la durée.',
		),
		'rse-qualite-de-vie-au-travail' => array(
			'group' => 'humain',
			'title' => 'RSE & qualité de vie au travail',
			'tags'  => 'Audit RSE · Qualité de vie au travail · Accompagnement des managers · Sobriété numérique',
			'desc'  => 'Diagnostic RSE, qualité de vie au travail et accompagnement des managers quand l’organisation doit évoluer avec ses outils.',
			'lead'  => 'Intégré avec vos équipes, pensé pour votre croissance : le changement se suit au lieu de se subir.',
		),
		'ingenierie-data-ia' => array(
			'group' => 'digital',
			'title' => 'Ingénierie, data & IA',
			'tags'  => 'Intelligence artificielle · Automatisation · Data · Réseaux · Infrastructure · Sécurité',
			'desc'  => 'Intégrer l’IA là où elle sert vraiment, automatiser les tâches lourdes, fiabiliser vos réseaux, vos données et votre sécurité.',
			'lead'  => 'Des outils numériques fiables, sécurisés, et utiles à ceux qui s’en servent.',
		),
		'web-design-communication' => array(
			'group' => 'digital',
			'title' => 'Web, design & communication',
			'tags'  => 'Sites web · Applications · Design · Graphisme · Référencement · Marketing',
			'desc'  => 'Sites et applications rapides, identité visuelle, référencement et marketing : une présence en ligne qui vous apporte des clients.',
			'lead'  => 'Stoppez les pertes : faites de votre site votre moteur de rentabilité.',
		),
	),

	'footer' => array(
		'cta_title' => '1er audit offert.',
		'cta_text'  => 'Gains immédiats, pertes limitées. Failles de données, visibilité en ligne, énergie des équipes : nous repérons vos frictions avant qu’elles vous coûtent.',
		'reply'     => 'Réponse sous 24 heures ouvrées',
	),

	'legal' => array(
		'publisher'    => 'SEREGE JUNIOR',
		'status'       => 'Entrepreneur individuel',
		'trade_name'   => 'Manager In Business (MIB)',
		'siret'        => '525 404 695 00039',
		'address'      => 'Appartement D117, 21 rue Simone Boudet, 31200 Toulouse, France',
		'director'     => 'SEREGE JUNIOR',
		'host_name'    => 'OVH SAS',
		'host_address' => '2 rue Kellermann, 59100 Roubaix, France',
		'host_phone'   => '1007',
		'host_note'    => 'Hébergé en France par OVHcloud',
	),

	'pages' => array(
		'legal'         => '/mentions-legales/',
		'privacy'       => '/confidentialite/',
		'accessibility' => '/accessibilite/',
	),
);
