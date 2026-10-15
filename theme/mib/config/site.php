<?php
/**
 * Configuration statique du site MIB — Man in Back.
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
		'long_name'   => 'Man in Back',
		'promise'     => 'Voir plus tôt. Comprendre plus vite. Agir au bon endroit.',
		'signature'   => array( "Rendre visible l'intelligence", 'qui agit derrière la performance.' ),
		'description' => "MIB relie la performance de vos équipes et celle de vos outils numériques. Nous repérons ce qui se dérègle, puis nous envoyons le bon spécialiste au bon endroit.",
		'hero_lead'   => '25 métiers du digital. 15 experts de la performance humaine. Votre expert, nous l’avons.',
		'email'       => 'contact@maninback.com',
		'cal_url'     => 'https://cal.com/maninback/audit',
		'city'        => 'Toulouse',
		'postal_code' => '31200',
		'country'     => 'FR',
	),

	// Appel à l'action unique du site.
	'cta' => array(
		'label' => 'Obtenir mon diagnostic',
		'note'  => '15 min · gratuit · sans engagement',
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
			'title' => 'Le digital va plus vite que vos équipes.',
			'text'  => 'Chaque nouvel outil a un effet humain. Nous le voyons avant vous.',
			'more'  => array(
				"IA, automatisation, nouveaux logiciels, travail hybride : chaque changement numérique modifie les rythmes, les compétences et la charge mentale. Fatigue, perte de repères, décrochage d'une partie de l'équipe.",
				"L'inverse est vrai : un outil mal adopté ne rapporte rien. La performance digitale et la performance humaine forment une seule boucle. C'est elle que nous surveillons.",
			),
			'pains' => array(
				array( 'q' => 'Mon site ne m’apporte aucun client.', 'to' => 'web-design-communication' ),
				array( 'q' => 'Je n’ai plus d’énergie en fin de semaine.', 'to' => 'performance-humaine' ),
				array( 'q' => 'Mon équipe décroche depuis le nouvel outil.', 'to' => 'rse-qualite-de-vie-au-travail' ),
				array( 'q' => 'Je veux utiliser l’IA, mais je ne sais pas par où commencer.', 'to' => 'ingenierie-data-ia' ),
			),
		),

		'answer' => array(
			'label' => 'La réponse MIB',
			'title' => 'Humain et digital : une seule boucle.',
			'text'  => 'Une baisse n’est pas toujours un danger. Nous gardons votre cap.',
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
			'title' => 'On ne mesure pas pour faire un rapport. On mesure pour savoir où agir.',
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
			'title' => 'Nous ne nous arrêtons pas au diagnostic.',
			'text'  => 'Chaque besoin repéré a son spécialiste. Il intervient chez vous, en présentiel ou à distance.',
		),

		'about' => array(
			'label' => 'Qui sommes-nous',
			'title' => 'Les Man in Back.',
			'punch' => 'MIB dans votre équipe. L’avance sur vos concurrents.',
			'text'  => 'On ne nous voit pas. On voit les résultats.',
			'more'  => array(
				"Nous sommes partis d'un constat : la technologie évolue parfois plus vite que notre capacité collective à nous adapter. Ce qui commence comme une transformation digitale peut devenir, petit à petit, un enjeu humain.",
				"MIB se place à cette jonction. 25 métiers du digital : ingénieurs data et réseaux, développeurs web et applicatifs, designers, graphistes, experts en marketing et en communication. 15 experts de la performance humaine : professionnels de santé diplômés, coachs en préparation physique et mentale, spécialistes RSE.",
				"Vous avez un interlocuteur. Derrière lui, l'équipe qu'il faut à votre situation.",
			),
		),

		'trust' => array(
			'label' => 'Confiance',
			'title' => 'Un cadre clair. Aucune promesse en l’air.',
			'items' => array(
				array( 't' => 'Santé : des professionnels diplômés', 'd' => 'Uniquement. Sans exception.' ),
				array( 't' => 'Aucune donnée conservée', 'd' => 'Utilisées pour le diagnostic, puis supprimées.' ),
				array( 't' => 'Anonymat des équipes', 'd' => 'Des tendances, jamais de réponses individuelles.' ),
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
			'lead'  => 'Retrouver de l’énergie, de la concentration et une dynamique d’équipe qui tient dans la durée.',
		),
		'rse-qualite-de-vie-au-travail' => array(
			'group' => 'humain',
			'title' => 'RSE & qualité de vie au travail',
			'tags'  => 'Audit RSE · Qualité de vie au travail · Accompagnement des managers · Sobriété numérique',
			'desc'  => 'Diagnostic RSE, qualité de vie au travail et accompagnement des managers quand l’organisation doit évoluer avec ses outils.',
			'lead'  => 'Des équipes qui suivent le changement au lieu de le subir.',
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
			'lead'  => 'Une présence en ligne qui travaille pour vous, même quand vous n’y pensez pas.',
		),
	),

	'footer' => array(
		'cta_title' => 'Diagnostic gratuit.',
		'cta_text'  => 'Failles de données, visibilité en ligne, énergie des équipes. Nous repérons vos frictions avant qu’elles coûtent.',
		'reply'     => 'Réponse sous 24 heures ouvrées',
	),

	'legal' => array(
		'publisher'    => 'SEREGE JUNIOR',
		'status'       => 'Entrepreneur individuel',
		'trade_name'   => 'Man in Back (MIB)',
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
