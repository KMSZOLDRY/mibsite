#!/usr/bin/env bash
# MIB — budgets des assets du thème (octets, avant compression).
# Échoue si un fichier dépasse son plafond : le déploiement est alors bloqué.
set -euo pipefail

fail=0
check() { # fichier plafond
	local size
	size=$(wc -c < "$1")
	if (( size > $2 )); then
		echo "❌ $1 : $size o (plafond $2 o)"; fail=1
	else
		echo "✅ $1 : $size o (plafond $2 o)"
	fi
}

check theme/mib/assets/css/mib.css 20000
check theme/mib/assets/js/menu.js 2000
for f in theme/mib/assets/fonts/*.woff2; do check "$f" 15360; done

# Aucun appel à un domaine tiers dans le thème (polices, CDN, trackers).
if grep -rEn "https?://(fonts\.googleapis|fonts\.gstatic|cdn\.|cdnjs|unpkg|jsdelivr|www\.google-analytics|googletagmanager)" theme/; then
	echo "❌ Ressource tierce détectée dans le thème."; fail=1
fi

exit $fail
