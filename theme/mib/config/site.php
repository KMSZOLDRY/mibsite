<?php
/**
 * Configuration statique du site MIB.
 *
 * Tout ce qui change moins d'une fois par an vit ici, pas en base :
 * le fichier est compilé une fois par OPcache puis servi depuis la RAM,
 * sans aucune requête MySQL.
 */

defined( 'ABSPATH' ) || exit;

return array(

	'brand' => array(
		'name'        => 'MIB',
		'long_name'   => 'Maninback',
		'tagline'     => "L'excellence numérique est humaine",
		'description' => "MIB est une agence d'ingénierie numérique. Nous concevons vos infrastructures logicielles de pointe et optimisons la performance humaine de vos organisations.",
		'email'       => 'contact@maninback.com',
		'cal_url'     => 'https://cal.com/maninback/audit',
		'city'        => 'Toulouse',
		'postal_code' => '31200',
		'country'     => 'FR',
	),

	/*
	 * Pastilles d'en-tête. Une valeur null masque la pastille :
	 * on n'affiche que des chiffres réellement mesurés et datés.
	 */
	'metrics' => array(
		'co2'          => null,          // ex. '0.03g' après mesure EcoIndex / Website Carbon
		'co2_date'     => null,          // ex. '29/10/2026'
		'rgaa'         => 'audit en cours',
		'rgaa_page'    => '/accessibilite/',
	),

	'home' => array(
		'discipline' => "L'excellence technologique est indissociable de la performance humaine. MIB intervient à l'intersection de l'ingénierie logicielle lourde et de l'optimisation des organisations.",
		'pains'      => array(
			array(
				'q' => 'Vous redoutez la faille de sécurité ou le piratage ?',
				'a' => 'Nos ingénieurs sécurisent vos plateformes de manière native pour protéger vos données et vos clients.',
			),
			array(
				'q' => 'Vos outils informatiques ralentissent vos équipes ?',
				'a' => 'Nous nettoyons et accélérons vos architectures logicielles pour restaurer la productivité.',
			),
			array(
				'q' => "Votre entreprise veut intégrer l'IA sans savoir par où commencer ?",
				'a' => "Nous déployons des systèmes d'intelligence artificielle éthiques, concrets et rentables.",
			),
			array(
				'q' => 'Vos salariés souffrent de fatigue numérique ou de processus lourds ?',
				'a' => 'Notre pôle RSE intervient sur site pour alléger le quotidien des équipes et préserver le bien-être des salariés comme des dirigeants.',
			),
		),
		'expertises_intro' => 'Des architectures logicielles aux systèmes agentiques, chaque pôle opère sous une contrainte technique stricte et un engagement RSE mesurable.',
	),

	/*
	 * Les 4 pôles d'expertise. La clé est le slug de la page WordPress.
	 */
	'expertises' => array(
		'core-engineering-architecture' => array(
			'title' => 'Core Engineering & Architecture',
			'tags'  => 'JVM · Kotlin · GraalVM · Go · Rust · Python · Cloud · CI/CD',
			'desc'  => 'Conception, évolution et scalabilité de systèmes réels. Des stacks choisies pour leurs performances et leur sécurité, sans dogmatisme : WordPress sur mesure, architectures découplées ou applications natives.',
			'lead'  => 'Architectures logicielles durables, systèmes robustes et ingénierie haute performance.',
		),
		'data-ai-intelligent-systems' => array(
			'title' => 'Data, AI & Agentic Systems',
			'tags'  => 'LLM · Agents autonomes · RAG · Data pipelines · Streaming · MLOps',
			'desc'  => "IA générative et modèles de langage en production. Agents autonomes, gouvernance éthique des données et pipelines d'ingénierie des données à haut débit.",
			'lead'  => 'Systèmes agentiques, LLM et ingénierie des données en production.',
		),
		'interface-experiences-security' => array(
			'title' => 'Interface, Experiences & Security',
			'tags'  => 'Web performance · Design systems · RGAA · Secure-by-design · RGPD',
			'desc'  => 'Interfaces web et mobiles rapides et accessibles. Design systems, Core Web Vitals, conformité RGAA/WCAG et protection native des données personnelles.',
			'lead'  => 'Interfaces rapides, accessibles et sécurisées dès la conception.',
		),
		'rse-culture-facteur-humain' => array(
			'title' => 'RSE & Performance Humaine',
			'tags'  => 'Audit RSE · QVT numérique · Intervention sur site · Inclusion',
			'desc'  => "Audits d'éco-conception et accompagnement sur site pour fluidifier les processus, réduire la fatigue numérique et préserver le bien-être des salariés comme des dirigeants.",
			'lead'  => 'Qualité de vie au travail, sobriété numérique et accompagnement sur le terrain.',
		),
	),

	'footer' => array(
		'cta_title' => 'Construisez la suite.',
		'cta_text'  => "Pour une analyse de vos infrastructures, un audit RSE ou le déploiement d'un système IA :",
		'reply'     => 'Réponse sous 24 heures ouvrées',
	),

	'legal' => array(
		'publisher'       => 'SEREGE JUNIOR',
		'status'          => 'Entrepreneur individuel',
		'trade_name'      => 'Maninback (MIB)',
		'siret'           => '525 404 695 00039',
		'address'         => 'Appartement D117, 21 rue Simone Boudet, 31200 Toulouse, France',
		'director'        => 'SEREGE JUNIOR',
		'host_name'       => 'OVH SAS',
		'host_address'    => '2 rue Kellermann, 59100 Roubaix, France',
		'host_phone'      => '1007',
		'host_note'       => 'Hébergé en France par OVHcloud',
	),

	'pages' => array(
		'legal'         => '/mentions-legales/',
		'privacy'       => '/confidentialite/',
		'accessibility' => '/accessibilite/',
	),
);
