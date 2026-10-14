# MIB — maninback.com

Site de MIB — Man in Back, système d'anticipation et d'intervention Humain × Digital. WordPress « CMS Green » : thème sur mesure, zéro image, zéro dépendance tierce, budget 150 Ko par page.

## Structure

| Dossier | Rôle | Déployé vers |
|---|---|---|
| `theme/mib/` | Thème WordPress (gabarits, CSS écrit à la main, menu JS < 2 Ko, police Montserrat auto-hébergée) | `wp-content/themes/mib/` |
| `theme/mib/config/site.php` | Contenus et réglages statiques (textes des 8 sections d'accueil, 4 leviers, CTA, mentions légales, pastilles) — servis par OPcache, sans MySQL | — |
| `server/` | `.htaccess` (sécurité, CSP, cache statique, compression), `robots.txt`, `llms.txt`, `wp-config-mib.php` | racine WordPress |
| `.github/workflows/` | `ci.yml` (contrôles + déploiement SSH), `cron.yml` (cron WordPress horaire) | — |
| `tools/check-budgets.sh` | Bloque le déploiement si un asset dépasse son budget | — |

## Mesures locales (thème v2, charte Man in Back)

- Accueil : 5 requêtes · 60 Ko non compressés · Lighthouse 100/100/100/100 mobile et desktop · LCP 1,3 s mobile / 0,4 s desktop · CLS 0.
- Page levier : 51 Ko · 100/100/100/100.

## Mise en service (une seule fois)

1. **OVH** : installer WordPress (module en 1 clic) sur `maninback.com`, activer le SSL, PHP 8.3.
2. **Clé SSH** : générer une clé `ed25519` dédiée au déploiement, ajouter la clé publique dans OVH (accès SSH de l'hébergement).
3. **GitHub → Settings → Secrets and variables → Actions** :
   - secrets `OVH_SSH_HOST`, `OVH_SSH_USER`, `OVH_SSH_KEY` (clé privée), `OVH_WP_PATH` (ex. `/home/xxxx/www`) ;
   - variable `DEPLOY_ENABLED` = `true`.
4. **wp-config.php** : ajouter `require_once __DIR__ . '/wp-config-mib.php';` juste avant « That's all, stop editing! ».
5. **WordPress** :
   - activer le thème MIB ; langue Français ; permaliens « Titre de la publication » ;
   - créer les pages : Accueil, Blog, les 4 leviers (slugs : `performance-humaine`, `rse-qualite-de-vie-au-travail`, `ingenierie-data-ia`, `web-design-communication`), `mentions-legales`, `confidentialite`, `accessibilite` ;
   - Réglages → Lecture : page d'accueil = Accueil, page des articles = Blog ;
   - extensions (2 max) : **The SEO Framework** (titres, meta, sitemap), **Two Factor** (double authentification admin).

## Règles

- Pas de constructeur de page, pas d'extension de cache ou de sécurité lourde, pas de ressource tierce (vérifié en CI).
- Les pastilles CO₂ / RGAA n'affichent que des valeurs mesurées : `config/site.php` → `metrics`.
