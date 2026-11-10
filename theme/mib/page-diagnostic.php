<?php
/**
 * Template Name: Diagnostic MIB
 *
 * Page template WordPress pour le diagnostic automatisé MIB.
 * Formulaire 4 étapes — envoi POST vers n8n au moment de la confirmation.
 *
 * @package mib
 */
get_header(); ?>

<title>Diagnostic MIB</title>
<meta name="claude:viewport-fit-sides" content="cover">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;800&display=swap">
<style>
/* =========================================================
   PAGE DIAGNOSTIC MIB — styles spécifiques à cette page
   La palette globale (--or, --sauge, etc.) est héritée de mib.css
   ========================================================= */
:root{
  --noir:#0B0B0B; --anthracite:#2E2E2E; --carte:#141414; --ligne:#2A2A2A;
  --vert:#3A5A40; --sauge:#8FAE7B; --or:#D4AF37; --ivoire:#F5F5F0; --gris:#A9A9A2;
  --f:"Montserrat",system-ui,-apple-system,"Segoe UI",Roboto,sans-serif;
  --r:10px;
  color-scheme:dark;
}
*{box-sizing:border-box}
body{background:var(--noir);color:var(--ivoire);font-family:var(--f);font-size:16px;line-height:1.55;margin:0}
.diag-wrap{max-width:1040px;margin:0 auto;padding-left:max(16px,env(safe-area-inset-left,0px));padding-right:max(16px,env(safe-area-inset-right,0px))}
a{color:var(--sauge)}
h1,h2,h3{text-wrap:balance;margin:0;line-height:1.15}
p{margin:0}
.eyebrow{font-size:.75rem;letter-spacing:.14em;text-transform:uppercase;color:var(--sauge);font-weight:600}
header.top{padding-block:20px;display:flex;align-items:center;justify-content:space-between;gap:16px}
.logo{display:flex;align-items:baseline;gap:10px;text-decoration:none}
.logo b{font-weight:800;font-size:1.5rem;letter-spacing:.06em;background:linear-gradient(180deg,#f3d77a,var(--or) 55%,#a8851f);-webkit-background-clip:text;background-clip:text;color:transparent}
.logo span{color:var(--gris);font-size:.8rem;letter-spacing:.1em;text-transform:uppercase}
.hero{display:grid;grid-template-columns:1.05fr .95fr;gap:40px;align-items:start;padding-block:24px 56px}
.hero h1{font-size:clamp(2rem,4.2vw,3.1rem);font-weight:800;letter-spacing:-.01em;margin-top:14px}
.hero h1 em{font-style:normal;color:var(--or)}
.sub{font-size:1.15rem;font-weight:600;color:var(--sauge);margin-top:16px}
.lead{color:var(--gris);margin-top:14px;max-width:60ch}
.badges{display:flex;flex-wrap:wrap;gap:8px;margin-top:22px;padding:0;list-style:none}
.badges li{border:1px solid var(--ligne);border-radius:999px;padding:6px 12px;font-size:.85rem;color:var(--ivoire)}
.badges li::before{content:"";display:inline-block;width:7px;height:7px;border-radius:50%;background:var(--or);margin-right:8px;vertical-align:middle}
.scale-mini{margin-top:28px;display:grid;gap:10px}
.scale-mini div{display:flex;gap:12px;align-items:baseline;font-size:.92rem;color:var(--gris)}
.scale-mini b{color:var(--ivoire);min-width:9.5em;font-weight:600}
.card{background:var(--carte);border:1px solid var(--ligne);border-radius:16px;padding:24px;min-width:0;position:relative}
.card::before{content:"";position:absolute;inset:0 0 auto 0;height:3px;border-radius:16px 16px 0 0;background:linear-gradient(90deg,var(--vert),var(--or))}
.steps{display:flex;gap:6px;margin-bottom:18px}
.steps i{flex:1;height:4px;border-radius:2px;background:var(--ligne)}
.steps i.on{background:var(--or)}
.card h2{font-size:1.3rem;font-weight:800}
.card .hint{color:var(--gris);font-size:.88rem;margin-top:6px}
form{display:grid;gap:14px;margin-top:18px}
label.f{display:grid;gap:6px;font-size:.88rem;font-weight:600}
label.f small{font-weight:400;color:var(--gris)}
input[type=text],input[type=email],input[type=url],input[type=tel],select{width:100%;font:inherit;font-size:1rem;color:var(--ivoire);background:var(--noir);border:1px solid var(--ligne);border-radius:var(--r);padding:12px 14px}
input:focus-visible,select:focus-visible,button:focus-visible,.pill input:focus-visible+span,summary:focus-visible{outline:2px solid var(--or);outline-offset:2px}
fieldset{border:0;padding:0;margin:0;display:grid;gap:8px;min-width:0}
legend{font-size:.95rem;font-weight:600;margin-bottom:8px;padding:0}
legend small{font-weight:400;color:var(--gris)}
.pills{display:flex;flex-wrap:wrap;gap:8px}
.pill{position:relative;cursor:pointer}
.pill input{position:absolute;opacity:0;pointer-events:none}
.pill span{display:inline-block;border:1px solid var(--ligne);border-radius:999px;padding:9px 14px;font-size:.92rem;background:var(--noir);transition:border-color .15s,background .15s}
.pill:hover span{border-color:var(--sauge)}
.pill input:checked+span{background:var(--vert);border-color:var(--sauge);color:var(--ivoire)}
.btn{font:inherit;font-weight:700;font-size:1rem;border:0;border-radius:var(--r);padding:14px 18px;cursor:pointer;background:var(--or);color:var(--noir);display:inline-flex;align-items:center;justify-content:center;gap:8px}
.btn:hover{filter:brightness(1.08)}
.btn:disabled{opacity:.6;cursor:not-allowed;filter:none}
.btn.ghost{background:transparent;color:var(--gris);border:1px solid var(--ligne);font-weight:600}
.row{display:flex;gap:10px;flex-wrap:wrap}
.row .btn{flex:1 1 180px}
.reassure{display:flex;flex-wrap:wrap;gap:6px 14px;font-size:.78rem;color:var(--gris)}
.reassure span::before{content:"✓ ";color:var(--sauge)}
.err{color:#E8A87C;font-size:.85rem}
.check{display:flex;gap:10px;align-items:flex-start;font-size:.92rem;cursor:pointer}
.check input{margin-top:4px;accent-color:var(--or);width:18px;height:18px;flex:none}
.detected{font-size:.85rem;color:var(--gris);background:var(--noir);border:1px dashed var(--ligne);border-radius:var(--r);padding:10px 12px}
.detected b{color:var(--sauge)}
.kpis{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-top:16px}
.kpi{background:var(--noir);border:1px solid var(--ligne);border-radius:var(--r);padding:12px;min-width:0}
.kpi b{display:block;font-size:1.35rem;font-weight:800;color:var(--or);font-variant-numeric:tabular-nums;line-height:1.2}
.kpi span{font-size:.75rem;color:var(--gris)}
.level{margin-top:14px;border:1px solid var(--vert);border-radius:var(--r);padding:12px 14px;background:rgba(58,90,64,.18)}
.level small{color:var(--sauge);text-transform:uppercase;letter-spacing:.12em;font-size:.7rem;font-weight:600}
.level b{display:block;font-size:1.05rem;margin-top:2px}
.level p{font-size:.88rem;color:var(--gris);margin-top:4px}
ol.prio{list-style:none;padding:0;margin:14px 0 0;display:grid;gap:8px;counter-reset:p}
ol.prio li{counter-increment:p;display:grid;grid-template-columns:28px 1fr auto;gap:10px;align-items:start;font-size:.92rem}
ol.prio li::before{content:counter(p);width:24px;height:24px;border-radius:50%;background:var(--anthracite);color:var(--or);display:grid;place-items:center;font-weight:800;font-size:.8rem}
ol.prio li span{min-width:0}
ol.prio li em{font-style:normal;color:var(--gris);display:block;font-size:.82rem}
ol.prio li b{color:var(--sauge);font-variant-numeric:tabular-nums;white-space:nowrap;font-size:.85rem}
.human{margin-top:14px;font-size:.88rem;color:var(--ivoire);border-left:2px solid var(--or);padding-left:12px}
.mib-phrase{margin-top:14px;font-weight:700;color:var(--or)}
.note{font-size:.8rem;color:var(--gris);margin-top:8px}
.done{text-align:center;padding-block:20px}
.done .big{font-size:2.4rem}
section.band{padding-block:56px;border-top:1px solid var(--ligne)}
section.band h2{font-size:clamp(1.5rem,3vw,2rem);font-weight:800;margin-top:10px}
.grid3{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-top:26px}
.sheet{background:var(--carte);border:1px solid var(--ligne);border-radius:var(--r);padding:16px;min-width:0;display:grid;gap:10px;align-content:start}
.sheet h3{font-size:.98rem;font-weight:700}
.sheet p{font-size:.85rem;color:var(--gris)}
.sheet.mibonly{border-color:var(--vert)}
.sheet .tag{font-size:.68rem;letter-spacing:.12em;text-transform:uppercase;color:var(--or);font-weight:600}
.mock{background:var(--noir);border-radius:8px;padding:10px;display:grid;gap:6px;min-height:84px}
.bar{height:8px;border-radius:4px;background:var(--anthracite)}
.bar.g{background:var(--vert)} .bar.o{background:var(--or)} .bar.s{background:var(--sauge)}
.mrow{display:grid;grid-template-columns:1fr 46px;gap:8px;align-items:center}
.mnum{display:flex;gap:6px}
.mnum span{flex:1;background:var(--anthracite);border-radius:6px;padding:6px 4px;text-align:center;font-size:.72rem;color:var(--or);font-weight:800}
.matrix{position:relative;height:84px;border-left:1px solid var(--ligne);border-bottom:1px solid var(--ligne)}
.matrix i{position:absolute;width:10px;height:10px;border-radius:50%;background:var(--sauge)}
.matrix i.o{background:var(--or)}
.road{display:grid;grid-template-columns:repeat(3,1fr);gap:6px}
.road span{height:30px;border-radius:6px;background:var(--anthracite);font-size:.68rem;color:var(--gris);display:grid;place-items:center}
.road span.o{background:var(--vert);color:var(--ivoire)}
.ladder{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-top:26px}
.rung{border:1px solid var(--ligne);border-radius:var(--r);padding:18px;min-width:0;display:grid;gap:8px;align-content:start}
.rung .lvl{font-size:.72rem;letter-spacing:.12em;text-transform:uppercase;color:var(--sauge);font-weight:600}
.rung h3{font-size:1.15rem;font-weight:800}
.rung .who{font-size:.85rem;color:var(--or);font-weight:600}
.rung p{font-size:.88rem;color:var(--gris)}
.stats{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-top:26px}
.stat{border-top:2px solid var(--or);padding-top:12px;min-width:0}
.stat b{font-size:1.6rem;font-weight:800;display:block;font-variant-numeric:tabular-nums}
.stat p{font-size:.88rem;color:var(--ivoire);margin-top:4px}
.stat small{display:block;font-size:.75rem;color:var(--gris);margin-top:8px}
.faq{display:grid;gap:8px;margin-top:22px;max-width:760px}
details{border:1px solid var(--ligne);border-radius:var(--r);background:var(--carte)}
summary{cursor:pointer;padding:14px 16px;font-weight:600;list-style:none;display:flex;justify-content:space-between;gap:12px}
summary::-webkit-details-marker{display:none}
summary::after{content:"+";color:var(--or);font-weight:800}
details[open] summary::after{content:"–"}
details p{padding:0 16px 16px;color:var(--gris);font-size:.92rem;max-width:65ch}
.final{text-align:center;display:grid;gap:14px;justify-items:center}
footer.diag-footer{padding-block:28px;border-top:1px solid var(--ligne);color:var(--gris);font-size:.8rem}
.sig{font-weight:600;color:var(--ivoire)} .sig span{color:var(--sauge)}
@media (max-width:860px){
  .hero{grid-template-columns:1fr;gap:28px}
  .grid3,.ladder,.stats{grid-template-columns:1fr 1fr}
}
@media (max-width:560px){
  .grid3,.ladder,.stats{grid-template-columns:1fr}
  .kpis{grid-template-columns:1fr}
  .card{padding:18px}
  .scale-mini b{min-width:8em}
}
@media (prefers-reduced-motion:reduce){*{transition:none!important}}
</style>

<div class="diag-wrap">
  <div class="hero">
    <div>
      <p class="eyebrow">Diagnostic MIB · offert</p>
      <h1>Récupérez des heures chaque semaine. <em>On vous montre où.</em></h1>
      <p class="sub">Devis, factures, relances : on optimise, vous travaillez.</p>
      <p class="lead">Notre IA étudie votre activité. Un expert MIB relit votre rapport avant envoi : tâches à optimiser, heures récupérables, plan d'action par étapes.</p>
      <ul class="badges">
        <li>Offert</li><li>Relu par un humain</li><li>Adapté à votre taille</li><li>Sans engagement</li>
      </ul>
      <div class="scale-mini" aria-label="Les trois niveaux de solution">
        <div><b>Seul(e)</b>Un assistant IA configuré pour votre métier</div>
        <div><b>Petite équipe</b>Des automatisations prêtes à l'emploi</div>
        <div><b>PME</b>Une infrastructure hébergée en France</div>
      </div>
    </div>

    <div class="card" id="diag" aria-live="polite">
      <div class="steps" aria-hidden="true"><i class="on"></i><i></i><i></i><i></i></div>

      <!-- Étape 1 -->
      <div id="s1">
        <h2>Votre diagnostic en 30 secondes</h2>
        <form id="f1" novalidate>
          <label class="f" for="prenom">Prénom
            <input type="text" id="prenom" autocomplete="given-name" placeholder="Votre prénom">
          </label>
          <label class="f" for="email">E-mail
            <input type="email" id="email" autocomplete="email" placeholder="vous@entreprise.fr">
          </label>
          <label class="f" for="site">Site internet <small>(facultatif, il nous aide à comprendre votre activité)</small>
            <input type="url" id="site" inputmode="url" placeholder="www.votre-entreprise.fr">
          </label>
          <label class="f" for="secteur" id="secteurWrap">Votre secteur
            <select id="secteur">
              <option value="btp">BTP et artisanat</option>
              <option value="nettoyage">Nettoyage / propreté</option>
              <option value="securite">Sécurité / gardiennage</option>
              <option value="restauration">Restauration / hôtellerie</option>
              <option value="commerce">Commerce de proximité</option>
              <option value="sante">Santé / bien-être</option>
            </select>
          </label>
          <fieldset>
            <legend>Vous êtes</legend>
            <div class="pills">
              <label class="pill"><input type="radio" name="taille" id="t-solo" value="solo" checked><span>Seul(e)</span></label>
              <label class="pill"><input type="radio" name="taille" id="t-tpe" value="tpe"><span>2 à 9 personnes</span></label>
              <label class="pill"><input type="radio" name="taille" id="t-pme" value="pme"><span>10 à 49</span></label>
              <label class="pill"><input type="radio" name="taille" id="t-pme2" value="pme2"><span>50 et +</span></label>
            </div>
          </fieldset>
          <p class="err" id="err1" hidden></p>
          <button class="btn" type="submit">Lancer mon diagnostic →</button>
          <p class="reassure"><span>Aucune donnée revendue</span><span>Supprimées après 90 jours</span><span>Hébergé en France</span></p>
        </form>
      </div>

      <!-- Étape 2 -->
      <div id="s2" hidden>
        <h2>C'est lancé. Votre rapport est en préparation.</h2>
        <p class="hint">3 clics de plus, et il sera nettement plus précis. Facultatif.</p>
        <p class="detected" id="detected" hidden></p>
        <form id="f2">
          <fieldset>
            <legend>Qu'est-ce qui vous prend le plus de temps ? <small>Plusieurs choix possibles</small></legend>
            <div class="pills" id="tasks"></div>
          </fieldset>
          <fieldset>
            <legend>En fin de semaine, votre énergie est plutôt…</legend>
            <div class="pills">
              <label class="pill"><input type="radio" name="energie" id="e1" value="intacte"><span>Intacte</span></label>
              <label class="pill"><input type="radio" name="energie" id="e2" value="correcte"><span>Correcte</span></label>
              <label class="pill"><input type="radio" name="energie" id="e3" value="plat"><span>À plat</span></label>
              <label class="pill"><input type="radio" name="energie" id="e4" value="nsp"><span>Je ne me pose plus la question</span></label>
            </div>
          </fieldset>
          <fieldset id="q3"></fieldset>
          <div class="row">
            <button class="btn" type="submit">Voir mon premier aperçu →</button>
            <button class="btn ghost" type="button" id="skip">Passer</button>
          </div>
        </form>
      </div>

      <!-- Étape 3 -->
      <div id="s3" hidden>
        <p class="eyebrow">Premier aperçu</p>
        <h2 id="apTitle">Voici où vous perdez du temps</h2>
        <div class="kpis">
          <div class="kpi"><b id="kH">–</b><span>heures récupérables par semaine</span></div>
          <div class="kpi"><b id="kV">–</b><span>valeur sur un an</span></div>
          <div class="kpi"><b id="kD">–</b><span>pour les premiers effets</span></div>
        </div>
        <div class="level"><small>Votre niveau recommandé</small><b id="lvName">–</b><p id="lvTxt"></p></div>
        <ol class="prio" id="prio"></ol>
        <p class="human" id="human"></p>
        <p class="mib-phrase">Votre savoir-faire reste le vôtre. On optimise tout ce qui l'entoure.</p>
        <p class="note">Rapport complet de 10 à 12 pages, relu par un expert MIB, envoyé sous 48 h ouvrées. Estimation indicative fondée sur vos réponses et un coût horaire moyen.</p>
        <div class="row" style="margin-top:16px">
          <button class="btn" type="button" id="toRdv">On en parle ? →</button>
        </div>
      </div>

      <!-- Étape 4 -->
      <div id="s4" hidden>
        <h2>On en parle ?</h2>
        <p class="hint">Vous choisissez la durée. Un spécialiste MIB vous écoute, sans engagement.</p>
        <form id="f4" novalidate>
          <fieldset>
            <legend>Durée</legend>
            <div class="pills">
              <label class="pill"><input type="radio" name="duree" id="d15" value="15 min" checked><span>15 min · l'essentiel</span></label>
              <label class="pill"><input type="radio" name="duree" id="d30" value="30 min"><span>30 min · on creuse</span></label>
            </div>
          </fieldset>
          <fieldset>
            <legend>Format</legend>
            <div class="pills">
              <label class="pill"><input type="radio" name="format" id="fv" value="visio" checked><span>Visio</span></label>
              <label class="pill"><input type="radio" name="format" id="ft" value="tel"><span>Téléphone</span></label>
            </div>
          </fieldset>
          <label class="f" for="tel" id="telWrap" hidden>Votre numéro
            <input type="tel" id="tel" autocomplete="tel" placeholder="06 12 34 56 78">
          </label>
          <label class="check" for="cadeau"><input type="checkbox" id="cadeau"><span><b>Offert :</b> l'analyse de mon site (référencement, visibilité dans Google et dans les IA, cohérence avec votre activité réelle)</span></label>
          <label class="f" for="site2" id="site2Wrap" hidden>Adresse de votre site
            <input type="url" id="site2" placeholder="www.votre-entreprise.fr">
          </label>
          <label class="check" for="news"><input type="checkbox" id="news"><span>Recevoir nos conseils par e-mail · 1 par mois, désinscription en un clic</span></label>
          <p class="err" id="err4" hidden></p>
          <button class="btn" type="submit" id="btn-submit">Choisir mon créneau →</button>
        </form>
      </div>

      <!-- Étape 5 : confirmation -->
      <div id="s5" hidden class="done">
        <p class="big" aria-hidden="true">✓</p>
        <h2>C'est noté.</h2>
        <p class="hint" id="recap"></p>
        <p class="note">Vous recevrez le rapport sous 48 h ouvrées. Pour choisir votre créneau dès maintenant :</p>
        <a class="btn" href="https://cal.com/maninback/audit" target="_blank" rel="noopener" style="margin-top:12px;display:inline-flex">Réserver mon créneau</a>
        <p class="err" id="err5" hidden style="margin-top:12px"></p>
      </div>
    </div>
  </div>
</div>

<section class="band">
  <div class="diag-wrap">
    <p class="eyebrow">Votre rapport</p>
    <h2>Ce que contiennent vos 10 à 12 pages</h2>
    <div class="grid3">
      <div class="sheet"><p class="tag">Synthèse</p><div class="mock"><div class="mnum"><span>h / sem.</span><span>€ / an</span><span>délai</span></div><div class="bar o" style="width:70%"></div><div class="bar" style="width:45%"></div></div><h3>L'essentiel en une page</h3><p>Heures récupérables, valeur sur un an et vos 3 priorités.</p></div>
      <div class="sheet"><p class="tag">Cartographie</p><div class="mock"><div class="mrow"><div class="bar g" style="width:90%"></div><div class="bar o"></div></div><div class="mrow"><div class="bar g" style="width:70%"></div><div class="bar o" style="width:70%"></div></div><div class="mrow"><div class="bar g" style="width:50%"></div><div class="bar"></div></div><div class="mrow"><div class="bar g" style="width:35%"></div><div class="bar"></div></div></div><h3>Vos tâches, de la plus coûteuse à la moins coûteuse</h3><p>Temps par semaine, part optimisable, coût sur l'année.</p></div>
      <div class="sheet"><p class="tag">Priorité n° 1</p><div class="mock"><div class="mrow"><div class="bar" style="width:100%"></div><span style="font-size:.7rem;color:var(--gris)">avant</span></div><div class="mrow"><div class="bar s" style="width:40%"></div><span style="font-size:.7rem;color:var(--sauge)">après</span></div><div class="bar" style="width:60%"></div></div><h3>Le détail de votre premier levier</h3><p>La situation actuelle, la cible, les gains et ce qu'il faut pour réussir.</p></div>
      <div class="sheet"><p class="tag">Impact et effort</p><div class="mock"><div class="matrix"><i class="o" style="left:12%;top:12%"></i><i class="o" style="left:30%;top:22%"></i><i style="left:62%;top:30%"></i><i style="left:48%;top:58%"></i><i style="left:78%;top:66%"></i></div></div><h3>Par quoi commencer</h3><p>Chaque piste placée selon ce qu'elle rapporte et ce qu'elle demande.</p></div>
      <div class="sheet"><p class="tag">Feuille de route</p><div class="mock"><div class="road"><span class="o">0-3 mois</span><span>3-6 mois</span><span>6-12 mois</span></div><div class="bar o" style="width:85%"></div></div><h3>12 mois en 3 phases</h3><p>Le temps récupéré, mis en face de l'investissement.</p></div>
      <div class="sheet mibonly"><p class="tag">En plus chez MIB</p><div class="mock"><div class="mrow"><div class="bar s" style="width:65%"></div><span style="font-size:.7rem;color:var(--gris)">énergie</span></div><div class="mrow"><div class="bar g" style="width:80%"></div><span style="font-size:.7rem;color:var(--gris)">équipe</span></div><div class="bar o" style="width:50%"></div></div><h3>Le volet humain et votre secteur</h3><p>Votre énergie, l'adhésion de l'équipe, et les chiffres de votre secteur avec leurs sources.</p></div>
    </div>
  </div>
</section>

<section class="band">
  <div class="diag-wrap">
    <p class="eyebrow">Adapté à votre taille</p>
    <h2>Du premier assistant à l'infrastructure complète</h2>
    <div class="ladder">
      <div class="rung"><p class="lvl">Niveau 1</p><h3>L'assistant</h3><p class="who">Pour les indépendants</p><p>Un à trois assistants IA configurés pour votre métier : devis, e-mails, publications. Une heure de prise en main.</p></div>
      <div class="rung"><p class="lvl">Niveau 2</p><h3>Les automatisations</h3><p class="who">Pour les petites équipes</p><p>Relances de factures, tri des e-mails avec réponses en brouillon, comptes rendus de réunion. Mises en place en quelques demi-journées.</p></div>
      <div class="rung"><p class="lvl">Niveau 3</p><h3>L'infrastructure</h3><p class="who">Pour les PME</p><p>Vos outils reliés, vos données centralisées et hébergées en France, des agents qui demandent validation. Votre équipe accompagnée.</p></div>
    </div>
  </div>
</section>

<section class="band">
  <div class="diag-wrap">
    <p class="eyebrow">Pourquoi maintenant</p>
    <h2>Les chiffres de votre quotidien</h2>
    <div class="stats">
      <div class="stat"><b>1 sur 4</b><p>TPE et PME françaises utilise déjà l'IA.</p><small>Source : baromètre France Num 2025</small></div>
      <div class="stat"><b>1er sept. 2026</b><p>Toutes les entreprises doivent pouvoir recevoir des factures électroniques.</p><small>Source : réforme de la facturation électronique, impots.gouv.fr</small></div>
      <div class="stat"><b>14,1 jours</b><p>De retard de paiement moyen en France.</p><small>Source : Altares, 1er semestre 2025</small></div>
    </div>
  </div>
</section>

<section class="band">
  <div class="diag-wrap">
    <p class="eyebrow">Questions fréquentes</p>
    <h2>Avant de lancer votre diagnostic</h2>
    <div class="faq">
      <details><summary>Que contient le rapport ?</summary><p>Une synthèse, la cartographie de vos tâches, le détail de votre premier levier, une matrice impact et effort, une feuille de route sur 12 mois, puis le volet humain et les chiffres de votre secteur. Entre 10 et 12 pages.</p></details>
      <details><summary>Qui le lit avant moi ?</summary><p>Un expert MIB relit et corrige chaque rapport avant l'envoi. Vous le recevez sous 48 h ouvrées.</p></details>
      <details><summary>Que deviennent mes données ?</summary><p>Elles servent uniquement à votre diagnostic, sont hébergées en France et supprimées après 90 jours. Elles ne sont jamais revendues.</p></details>
      <details><summary>Je suis seul(e), c'est pour moi ?</summary><p>Oui. Le diagnostic s'adapte à votre taille. Pour un indépendant, on commence souvent par un assistant IA configuré pour son métier.</p></details>
      <details><summary>Je n'y connais rien en IA, est-ce un problème ?</summary><p>Non. On part de vos tâches, pas de la technique. Le rapport est écrit sans jargon.</p></details>
      <details><summary>Est-ce que ça m'engage ?</summary><p>Non. Le rapport et l'échange sont offerts. Vous décidez ensuite, ou pas.</p></details>
    </div>
  </div>
</section>

<section class="band">
  <div class="diag-wrap final">
    <h2>Récupérez des heures chaque semaine.</h2>
    <a class="btn" href="#diag">Lancer mon diagnostic →</a>
  </div>
</section>

<script>
(function(){
  var WEBHOOK = 'https://n8n.rylaz.fr/webhook/diagnostic';
  var $=function(id){return document.getElementById(id)};
  var state={};

  var TASKS={
    devis:{l:"Devis",h:[1.5,3],s:["Un assistant qui prépare vos devis à partir des anciens","Devis générés depuis votre fiche client","Chiffrage assisté, relié à vos données"]},
    factures:{l:"Factures et relances",h:[1,2.5],s:["Modèles de relance rédigés pour vous","Relances automatiques selon l'échéance","Rapprochement et relances sans saisie"]},
    emails:{l:"E-mails",h:[2,4],s:["Réponses préparées en un clic","Tri du soir et brouillons prêts le matin","Tri, routage et brouillons pour toute l'équipe"]},
    reseaux:{l:"Réseaux sociaux",h:[1,3],s:["Publications rédigées dans votre style","Calendrier de publication automatique","Contenus planifiés et validés en équipe"]},
    rdv:{l:"Rendez-vous",h:[.5,1.5],s:["Confirmations et rappels rédigés","Rappels automatiques, moins de rendez-vous manqués","Agenda partagé et rappels pour tous"]},
    planning:{l:"Planning",h:[1,2],s:["","Planning mis à jour automatiquement","Planning relié aux dossiers et aux équipes"]},
    dossiers:{l:"Suivi des dossiers ou chantiers",h:[1.5,3],s:["","Comptes rendus et suivi générés","Suivi centralisé avec alertes"]},
    ao:{l:"Appels d'offres",h:[3,6],s:["","","Veille, tri des offres et mémoire technique préparé"]},
    reporting:{l:"Reporting",h:[1.5,3],s:["","","Tableaux de bord mis à jour seuls"]},
    docs:{l:"Documents fournisseurs",h:[1,2.5],s:["","","Collecte et contrôle des documents automatisés"]},
    autre:{l:"Autre",h:[.5,1],s:["Un assistant dédié à cette tâche","Un workflow sur mesure","Un workflow sur mesure"]}
  };
  var BY={
    solo:["devis","factures","emails","reseaux","rdv","autre"],
    tpe:["devis","factures","emails","reseaux","rdv","planning","dossiers","autre"],
    pme:["devis","factures","emails","reseaux","rdv","planning","dossiers","ao","reporting","docs","autre"]
  };
  var DEF={
    btp:["devis","factures","dossiers"],
    nettoyage:["planning","factures","emails"],
    securite:["planning","dossiers","reporting"],
    restauration:["reseaux","rdv","factures"],
    commerce:["reseaux","factures","emails"],
    sante:["rdv","factures","emails"]
  };
  var SECT={
    btp:"BTP et artisanat",nettoyage:"Nettoyage / propreté",securite:"Sécurité / gardiennage",
    restauration:"Restauration / hôtellerie",commerce:"Commerce de proximité",sante:"Santé / bien-être"
  };
  var LV=[
    {n:"Niveau 1 · L'assistant",t:"Un à trois assistants IA configurés pour votre métier. Vous gardez la main, il prépare le travail."},
    {n:"Niveau 2 · Les automatisations",t:"Des workflows qui tournent seuls sur vos tâches répétitives, avec un contrôle humain au bon moment."},
    {n:"Niveau 3 · L'infrastructure",t:"Vos outils reliés, vos données centralisées et hébergées en France, et votre équipe accompagnée."}
  ];
  var CONF={
    solo:{lv:0,mul:1,rate:35,d:"< 30 jours"},
    tpe:{lv:1,mul:2,rate:40,d:"< 60 jours"},
    pme:{lv:2,mul:3.5,rate:45,d:"< 90 jours"}
  };

  function show(n){
    for(var i=1;i<=5;i++){$("s"+i).hidden=(i!==n)}
    var bars=document.querySelectorAll(".steps i");
    for(var j=0;j<bars.length;j++){bars[j].classList.toggle("on",j<Math.min(n,4))}
    var card=$("diag");
    if(card.getBoundingClientRect().top<0){card.scrollIntoView({behavior:"smooth",block:"start"})}
    var h=$("s"+n).querySelector("h2");
    if(h){h.setAttribute("tabindex","-1");h.focus({preventScroll:true})}
  }

  function val(name){
    var e=document.querySelector('input[name="'+name+'"]:checked');
    return e?e.value:null;
  }

  function guess(url){
    var u=url.toLowerCase();
    if(/btp|renov|bati|plomb|elec|menuis|macon|toit|chantier/.test(u))return"btp";
    if(/nettoy|propret|menage/.test(u))return"nettoyage";
    if(/securit|gardien|vigil/.test(u))return"securite";
    if(/resto|restaurant|hotel|traiteur|brasserie/.test(u))return"restauration";
    if(/shop|boutique|store|commerce|commerce/.test(u))return"commerce";
    if(/sante|kine|osteo|coach|therapie|yoga|sport|bien/.test(u))return"sante";
    return"btp";
  }

  $("site").addEventListener("input",function(){
    $("secteurWrap").hidden=this.value.trim().length>3;
  });

  $("f1").addEventListener("submit",function(e){
    e.preventDefault();
    var err=$("err1"); err.hidden=true;
    var p=$("prenom").value.trim(), m=$("email").value.trim();
    if(!p){err.textContent="Indiquez votre prénom pour que l'on s'adresse à vous.";err.hidden=false;$("prenom").focus();return}
    if(!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(m)){err.textContent="Cette adresse e-mail semble incomplète. Exemple : vous@entreprise.fr";err.hidden=false;$("email").focus();return}
    var site=$("site").value.trim();
    var t=val("taille"); state.taille=(t==="pme2")?"pme":t;
    state.prenom=p; state.email=m; state.site=site;
    state.secteur=site.length>3?guess(site):$("secteur").value;
    state.taille_raw=t;
    var det=$("detected");
    if(site.length>3){det.innerHTML="Secteur repéré sur votre site : <b>"+SECT[state.secteur]+"</b>";det.hidden=false}
    else{det.hidden=true}
    buildStep2(); show(2);
  });

  function buildStep2(){
    var box=$("tasks"); box.innerHTML="";
    BY[state.taille].forEach(function(k){
      var id="tk-"+k;
      box.insertAdjacentHTML("beforeend",'<label class="pill" for="'+id+'"><input type="checkbox" id="'+id+'" value="'+k+'"><span>'+TASKS[k].l+'</span></label>');
    });
    var q=$("q3");
    if(state.taille==="solo"){
      q.innerHTML='<legend>Ce qui vous freine le plus ?</legend><div class="pills">'+
        ['Le temps','Trouver des clients',"L'administratif",'La fatigue'].map(function(v,i){
          return '<label class="pill" for="q3-'+i+'"><input type="radio" name="q3" id="q3-'+i+'" value="'+v+'"><span>'+v+'</span></label>';
        }).join("")+'</div>';
    }else{
      q.innerHTML='<legend>Votre équipe face aux nouveaux outils ?</legend><div class="pills">'+
        ['Partante','Prudente','Réticente','Débordée'].map(function(v,i){
          return '<label class="pill" for="q3-'+i+'"><input type="radio" name="q3" id="q3-'+i+'" value="'+v+'"><span>'+v+'</span></label>';
        }).join("")+'</div>';
    }
  }

  function fmtH(a,b){return Math.round(a)+" à "+Math.round(b)+" h"}
  function fmtK(a,b){
    var r=function(x){return x>=10000?Math.round(x/1000)+" k€":(Math.round(x/100)/10).toString().replace(".",",")+" k€"};
    return r(a).replace(" k€","")+" à "+r(b);
  }

  function preview(){
    var c=CONF[state.taille];
    var sel=[].slice.call(document.querySelectorAll("#tasks input:checked")).map(function(i){return i.value});
    state.taches=sel;
    var picked=sel.length?sel:(DEF[state.secteur]||["emails","factures","devis"]).filter(function(k){return BY[state.taille].indexOf(k)>-1});
    if(picked.length<3){["emails","factures","devis"].forEach(function(k){if(picked.length<3&&picked.indexOf(k)<0)picked.push(k)})}
    var lo=0,hi=0;
    var rows=picked.map(function(k){var t=TASKS[k];var a=t.h[0]*c.mul,b=t.h[1]*c.mul;lo+=a*.5;hi+=b*.7;return{k:k,a:a*.5,b:b*.7}});
    rows.sort(function(x,y){return y.b-x.b});
    state.heures_lo=Math.round(lo); state.heures_hi=Math.round(hi);
    state.energie=val("energie"); state.q3=val("q3");
    $("apTitle").textContent=state.prenom+", voici où vous perdez du temps";
    $("kH").textContent=fmtH(lo,hi);
    $("kV").textContent=fmtK(lo*46*c.rate,hi*46*c.rate);
    $("kD").textContent=c.d;
    var lv=c.lv; if(state.taille==="solo"&&picked.length>=5)lv=0;
    state.niveau_recommande=LV[lv].n;
    $("lvName").textContent=LV[lv].n; $("lvTxt").textContent=LV[lv].t;
    var ol=$("prio"); ol.innerHTML="";
    rows.slice(0,3).forEach(function(r){
      var t=TASKS[r.k]; var s=t.s[lv]||t.s[2]||t.s[1];
      ol.insertAdjacentHTML("beforeend","<li><span>"+t.l+"<em>"+s+"</em></span><b>"+fmtH(r.a,r.b)+"/sem.</b></li>");
    });
    var en=val("energie"),q=val("q3"),txt="";
    if(en==="plat"||en==="nsp")txt="Côté humain : votre énergie est entamée. On commence par ce qui vous soulage le plus vite, et un spécialiste MIB peut vous aider à récupérer.";
    else if(en)txt="Côté humain : votre énergie tient. On en profite pour installer les bons réflexes avant que la charge augmente.";
    if(state.taille!=="solo"&&(q==="Réticente"||q==="Débordée"))txt+=(txt?" ":"Côté humain : ")+"Votre équipe est "+q.toLowerCase()+". On l'implique dès le départ, pour que l'outil soit adopté et non subi.";
    if(state.taille==="solo"&&q)txt+=(txt?" ":"Côté humain : ")+"Votre frein principal : "+q.toLowerCase()+". Vos priorités en tiennent compte.";
    if(!txt)txt="Côté humain : répondez aux questions énergie et équipe pour un rapport plus précis.";
    $("human").textContent=txt;
    show(3);
  }

  $("f2").addEventListener("submit",function(e){e.preventDefault();preview()});
  $("skip").addEventListener("click",preview);
  $("toRdv").addEventListener("click",function(){$("site2Wrap").hidden=true;show(4)});

  document.querySelectorAll('input[name="format"]').forEach(function(r){
    r.addEventListener("change",function(){$("telWrap").hidden=val("format")!=="tel"});
  });
  $("cadeau").addEventListener("change",function(){
    $("site2Wrap").hidden=!(this.checked&&!state.site);
  });

  $("f4").addEventListener("submit",function(e){
    e.preventDefault();
    var err=$("err4"); err.hidden=true;
    if(val("format")==="tel"&&$("tel").value.replace(/\D/g,"").length<9){
      err.textContent="Indiquez un numéro à 10 chiffres pour que l'on puisse vous appeler.";
      err.hidden=false;$("tel").focus();return;
    }
    if($("cadeau").checked&&!state.site&&$("site2").value.trim().length<4){
      err.textContent="Indiquez l'adresse de votre site pour recevoir son analyse.";
      err.hidden=false;$("site2").focus();return;
    }

    var btn=$("btn-submit");
    btn.disabled=true;
    btn.textContent="Envoi en cours…";

    // Données collectées sur les 4 étapes
    var payload={
      prenom:        state.prenom,
      email:         state.email,
      site:          state.site||($("site2").value.trim()||""),
      secteur:       SECT[state.secteur]||state.secteur,
      taille:        state.taille_raw||state.taille,
      energie:       state.energie||"",
      equipe:        state.q3||"",
      taches:        (state.taches||[]).join(", "),
      heures_lo:     state.heures_lo||0,
      heures_hi:     state.heures_hi||0,
      niveau:        state.niveau_recommande||"",
      rdv_duree:     val("duree")||"30 min",
      rdv_format:    val("format")||"visio",
      tel:           val("format")==="tel"?$("tel").value.trim():"",
      analyse_site:  $("cadeau").checked?"oui":"non",
      newsletter:    $("news").checked?"oui":"non"
    };

    fetch(WEBHOOK,{
      method:"POST",
      headers:{"Content-Type":"application/json"},
      body:JSON.stringify(payload)
    })
    .then(function(res){
      if(res.ok){
        var r="Échange de "+payload.rdv_duree+" "+(payload.rdv_format==="tel"?"par téléphone":"en visio")+".";
        if(payload.analyse_site==="oui")r+=" Analyse de votre site offerte, jointe au rapport.";
        r+=" Rapport complet sous 48 h ouvrées.";
        $("recap").textContent=r;
        show(5);
      }else{
        throw new Error("HTTP "+res.status);
      }
    })
    .catch(function(){
      err.textContent="Une erreur est survenue. Réessayez ou écrivez-nous à contact@maninback.com";
      err.hidden=false;
      btn.disabled=false;
      btn.textContent="Choisir mon créneau →";
    });
  });
})();
</script>

<?php get_footer(); ?>
