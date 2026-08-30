<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Rooms — KALACTIVE, A Curation by Rangrez</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com" rel="preconnect">
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500;1,600;1,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<script id="tailwind-config">
tailwind.config={darkMode:"class",theme:{extend:{colors:{"primary-fixed":"#e5e2da","inverse-on-surface":"#f2f1ed","surface-container":"#efeeea","secondary-container":"#ff996f","surface-dim":"#dbdad6","primary-container":"#f5f2ea","surface-container-high":"#e9e8e4","primary":"#5f5e58","background":"#faf9f5","surface-container-low":"#f4f4f0","outline-variant":"#c9c7bd","on-surface-variant":"#474740","on-primary":"#ffffff","outline":"#78776f","secondary":"#974724","surface-container-highest":"#e3e2df","on-secondary":"#ffffff","surface-container-lowest":"#ffffff","error":"#ba1a1a","surface":"#faf9f5","on-background":"#1b1c1a","secondary-fixed":"#ffdbce","on-surface":"#1b1c1a","secondary-fixed-dim":"#ffb598","on-secondary-container":"#772f0d","inverse-surface":"#2f312e","on-tertiary":"#ffffff","primary-fixed-dim":"#c9c6bf"},borderRadius:{"DEFAULT":"0.25rem","lg":"0.5rem","xl":"0.75rem","full":"9999px"},spacing:{"unit":"8px","gutter":"32px","margin-desktop":"64px","margin-mobile":"20px","section-gap":"120px","container-max":"1440px"},fontFamily:{"headline-lg":["Playfair Display"],"headline-xl":["Playfair Display"],"headline-xl-mobile":["Playfair Display"],"body-md":["Inter"],"display-lg":["Playfair Display"],"label-sm":["Inter"],"headline-md":["Playfair Display"],"display-lg-mobile":["Playfair Display"],"body-lg":["Inter"],"label-lg":["Inter"]},fontSize:{"headline-lg":["32px",{"lineHeight":"1.3","fontWeight":"600"}],"headline-xl":["48px",{"lineHeight":"1.2","fontWeight":"600"}],"headline-xl-mobile":["32px",{"lineHeight":"1.2","fontWeight":"600"}],"body-md":["16px",{"lineHeight":"1.6","fontWeight":"400"}],"display-lg":["64px",{"lineHeight":"1.1","letterSpacing":"-0.02em","fontWeight":"700"}],"label-sm":["12px",{"lineHeight":"1.2","letterSpacing":"0.05em","fontWeight":"500"}],"headline-md":["24px",{"lineHeight":"1.4","fontWeight":"500"}],"display-lg-mobile":["40px",{"lineHeight":"1.1","fontWeight":"700"}],"body-lg":["18px",{"lineHeight":"1.6","fontWeight":"400"}],"label-lg":["14px",{"lineHeight":"1.2","letterSpacing":"0.1em","fontWeight":"600"}]}}}}
</script>
<link rel="stylesheet" href="css/style.css">
<style>
/* =============================================================
   ROOMS PAGE — ALL STYLES SCOPED TO .rooms-page
   Zero bleed into any other page.
============================================================= */

/* ── Rajasthani palette tokens ── */
:root{
  --rp-ivory:#F7F3EC;
  --rp-sandstone:#D4A97A;
  --rp-terracotta:#C4622D;
  --rp-sienna:#A0492A;
  --rp-indigo:#2C3358;
  --rp-maroon:#6B2737;
  --rp-brass:#B08850;
  --rp-charcoal:#1A1915;
  --rp-muted:#5C5850;
  --rp-border:#C8C0B0;
  --rp-bg:#F5F1E8;
}

/* ── Page background ── */
.rooms-page{background:#F5F1E8}

/* ── HERO ─────────────────────────────────────────────────── */
.rooms-page .rp-hero{
  position:relative;width:100%;height:100vh;min-height:640px;
  overflow:hidden;display:flex;align-items:flex-end;
  background:#1A1915
}
.rooms-page .rp-hero__img{
  position:absolute;inset:0;width:100%;height:100%;
  object-fit:cover;will-change:transform;transform:scale(1.07);
  transform-origin:center 60%;
  /* warm Rajasthani colour grade */
  filter:saturate(1.12) sepia(0.08) brightness(0.93)
}
.rooms-page .rp-hero__overlay{
  position:absolute;inset:0;
  background:linear-gradient(
    160deg,
    rgba(26,25,21,.1) 0%,
    rgba(26,25,21,.05) 30%,
    rgba(26,25,21,.55) 70%,
    rgba(26,25,21,.82) 100%
  )
}
/* thin brass border top */
.rooms-page .rp-hero::before{
  content:'';position:absolute;top:0;left:0;right:0;
  height:3px;background:linear-gradient(90deg,transparent,#B08850 40%,#B08850 60%,transparent);
  z-index:20;opacity:.6
}
.rooms-page .rp-hero__content{
  position:relative;z-index:10;
  padding:0 64px 80px;max-width:800px
}
@media(max-width:768px){.rooms-page .rp-hero__content{padding:0 20px 52px}}

.rooms-page .rp-hero__eyebrow{
  font-family:'Inter',sans-serif;font-size:10px;font-weight:600;
  letter-spacing:.22em;text-transform:uppercase;
  color:rgba(212,169,122,.85);margin-bottom:22px;
  opacity:0;transform:translateY(14px);
  animation:rp-rise .6s cubic-bezier(.16,1,.3,1) .3s forwards
}
.rooms-page .rp-hero__headline{
  font-family:'Playfair Display',serif;
  font-size:clamp(44px,7vw,88px);font-weight:700;
  line-height:1.04;letter-spacing:-.025em;color:#F5F1E8;
  margin-bottom:28px;
  opacity:0;transform:translateY(24px);
  animation:rp-rise .9s cubic-bezier(.16,1,.3,1) .5s forwards
}
.rooms-page .rp-hero__headline em{
  font-style:italic;color:#D4A97A
}
.rooms-page .rp-hero__sub{
  font-family:'Inter',sans-serif;font-size:15px;line-height:1.7;
  color:rgba(245,241,232,.68);max-width:440px;margin-bottom:44px;
  opacity:0;transform:translateY(14px);
  animation:rp-rise .7s cubic-bezier(.16,1,.3,1) .75s forwards
}
.rooms-page .rp-hero__cta{
  display:inline-flex;align-items:center;gap:10px;
  font-family:'Inter',sans-serif;font-size:11px;font-weight:600;
  letter-spacing:.16em;text-transform:uppercase;color:#F5F1E8;
  border-bottom:1px solid rgba(176,136,80,.5);padding-bottom:4px;
  text-decoration:none;
  transition:gap .3s ease,border-color .3s ease,color .3s ease;
  opacity:0;transform:translateY(12px);
  animation:rp-rise .6s cubic-bezier(.16,1,.3,1) 1s forwards
}
.rooms-page .rp-hero__cta:hover{gap:18px;border-color:#D4A97A;color:#D4A97A}

/* hero side caption */
.rooms-page .rp-hero__side{
  position:absolute;right:64px;bottom:80px;z-index:10;
  display:flex;flex-direction:column;align-items:flex-end;gap:10px;
  opacity:0;animation:rp-rise .5s cubic-bezier(.16,1,.3,1) 1.2s forwards
}
.rooms-page .rp-hero__side-line{width:44px;height:1px;background:rgba(176,136,80,.4)}
.rooms-page .rp-hero__side-text{
  font-family:'Inter',sans-serif;font-size:9px;letter-spacing:.22em;
  text-transform:uppercase;color:rgba(212,169,122,.5);
  writing-mode:horizontal-tb
}
@media(max-width:768px){.rooms-page .rp-hero__side{display:none}}

/* ── SECTION LABEL ───────────────────────────────────────── */
.rooms-page .rp-label{
  font-family:'Inter',sans-serif;font-size:9px;font-weight:600;
  letter-spacing:.22em;text-transform:uppercase;color:#B08850;
  display:flex;align-items:center;gap:12px;margin-bottom:20px
}
.rooms-page .rp-label::after{content:'';flex:1;height:1px;background:rgba(176,136,80,.3)}

/* ── PAGE INTRO ──────────────────────────────────────────── */
.rooms-page .rp-intro{
  max-width:1440px;margin:0 auto;
  padding:80px 64px 56px
}
@media(max-width:768px){.rooms-page .rp-intro{padding:52px 20px 36px}}
.rooms-page .rp-intro__rule{
  width:44px;height:1px;background:#C4622D;margin-bottom:20px
}
.rooms-page .rp-intro__heading{
  font-family:'Playfair Display',serif;
  font-size:clamp(28px,3.5vw,44px);font-weight:600;
  line-height:1.2;color:#1A1915;margin-bottom:16px
}
.rooms-page .rp-intro__sub{
  font-family:'Inter',sans-serif;font-size:15px;
  color:#5C5850;line-height:1.7;max-width:540px
}

/* ── DIAMOND ORNAMENT ────────────────────────────────────── */
.rooms-page .rp-diamond{
  display:inline-block;width:7px;height:7px;
  background:#C4622D;transform:rotate(45deg);flex-shrink:0
}
.rooms-page .rp-divider{
  display:flex;align-items:center;gap:16px;
  margin:0 0 20px
}
.rooms-page .rp-divider__line{flex:1;height:1px;background:#C8C0B0}

/* ── ROOM CARDS ─────────────────────────────────────────── */
.rooms-page .rp-rooms{
  max-width:1440px;margin:0 auto;
  padding:0 64px 100px;
  display:flex;flex-direction:column;gap:0
}
@media(max-width:1024px){.rooms-page .rp-rooms{padding:0 20px 72px}}

/* Individual room strip */
.rooms-page .rp-room{
  display:grid;
  border-top:1px solid #C8C0B0;
  position:relative;
  overflow:hidden;
}
/* BAITHAK — full feature */
.rooms-page .rp-room--baithak{grid-template-columns:1fr;min-height:680px}
/* SHAYAN + BHOJ side by side */
.rooms-page .rp-room--pair{
  grid-template-columns:1fr 1fr;
  border-top:1px solid #C8C0B0;
  align-items:stretch
}
@media(max-width:900px){.rooms-page .rp-room--pair{grid-template-columns:1fr}}
/* KARYA — text heavy left, image right */
.rooms-page .rp-room--karya{grid-template-columns:38% 62%;min-height:520px}
@media(max-width:900px){.rooms-page .rp-room--karya{grid-template-columns:1fr}}
/* AANGAN — wide immersive */
.rooms-page .rp-room--aangan{grid-template-columns:1fr;min-height:560px}
/* DEORHI — portrait card */
.rooms-page .rp-room--deorhi{grid-template-columns:50% 50%;min-height:480px}
@media(max-width:900px){.rooms-page .rp-room--deorhi{grid-template-columns:1fr}}

/* Image panel inside a room */
.rooms-page .rp-room__img-panel{
  position:relative;overflow:hidden;min-height:inherit
}
.rooms-page .rp-room__img{
  position:absolute;inset:0;width:100%;height:100%;
  object-fit:cover;
  filter:saturate(1.1) sepia(0.06) brightness(0.95);
  transition:transform .8s cubic-bezier(.16,1,.3,1)
}
.rooms-page .rp-room:hover .rp-room__img{transform:scale(1.04)}
.rooms-page .rp-room__img-overlay{
  position:absolute;inset:0;
  background:linear-gradient(to top,rgba(26,25,21,.5) 0%,transparent 60%);
  transition:opacity .4s
}
.rooms-page .rp-room:hover .rp-room__img-overlay{opacity:.7}

/* overlay number */
.rooms-page .rp-room__num{
  position:absolute;top:24px;left:28px;z-index:5;
  font-family:'Inter',sans-serif;font-size:10px;font-weight:600;
  letter-spacing:.2em;text-transform:uppercase;
  color:rgba(212,169,122,.7);
}

/* Text panel inside a room */
.rooms-page .rp-room__text-panel{
  background:#F5F1E8;border-left:1px solid #C8C0B0;
  padding:52px 48px;
  display:flex;flex-direction:column;justify-content:center;
  position:relative
}
@media(max-width:900px){
  .rooms-page .rp-room__text-panel{border-left:none;border-top:1px solid #C8C0B0;padding:36px 24px}
}

/* For full-width hero rooms, text is overlaid */
.rooms-page .rp-room--baithak .rp-room__text-panel,
.rooms-page .rp-room--aangan .rp-room__text-panel{
  position:absolute;bottom:0;left:0;right:0;
  background:transparent;border:none;padding:0 64px 56px;
  z-index:10;max-width:660px
}
@media(max-width:768px){
  .rooms-page .rp-room--baithak .rp-room__text-panel,
  .rooms-page .rp-room--aangan .rp-room__text-panel{padding:0 20px 36px}
}

.rooms-page .rp-room--baithak .rp-room__name,
.rooms-page .rp-room--aangan .rp-room__name{color:#F5F1E8}
.rooms-page .rp-room--baithak .rp-room__english,
.rooms-page .rp-room--aangan .rp-room__english{color:rgba(212,169,122,.8)}
.rooms-page .rp-room--baithak .rp-room__tagline,
.rooms-page .rp-room--aangan .rp-room__tagline{color:rgba(245,241,232,.72)}
.rooms-page .rp-room--baithak .rp-room__cta,
.rooms-page .rp-room--aangan .rp-room__cta{color:#F5F1E8;border-color:rgba(176,136,80,.5)}
.rooms-page .rp-room--baithak:hover .rp-room__cta,
.rooms-page .rp-room--aangan:hover .rp-room__cta{color:#D4A97A}
.rooms-page .rp-room--baithak .rp-room__chips .rp-room__chip,
.rooms-page .rp-room--aangan .rp-room__chips .rp-room__chip{
  border-color:rgba(176,136,80,.4);color:rgba(212,169,122,.8)
}

/* Pair cells */
.rooms-page .rp-room--pair > .rp-room__cell{
  display:block;position:relative;overflow:hidden;min-height:460px;min-width:0;
  border-right:1px solid #C8C0B0;
}
.rooms-page .rp-room--pair > .rp-room__cell:last-child{border-right:none}
@media(max-width:900px){
  .rooms-page .rp-room--pair > .rp-room__cell{border-right:none;border-bottom:1px solid #C8C0B0}
  .rooms-page .rp-room--pair > .rp-room__cell:last-child{border-bottom:none}
}
.rooms-page .rp-room__cell-img{
  position:absolute;inset:0;width:100%;height:100%;object-fit:cover;
  filter:saturate(1.1) sepia(0.06) brightness(0.95);
  transition:transform .8s cubic-bezier(.16,1,.3,1)
}
.rooms-page .rp-room__cell:hover .rp-room__cell-img{transform:scale(1.04)}
.rooms-page .rp-room__cell-overlay{
  position:absolute;inset:0;
  background:linear-gradient(to top,rgba(26,25,21,.68) 0%,transparent 55%);
  transition:opacity .4s
}
.rooms-page .rp-room__cell:hover .rp-room__cell-overlay{opacity:.85}
.rooms-page .rp-room__cell-body{
  position:absolute;bottom:0;left:0;right:0;
  padding:36px 36px 28px;z-index:5
}
@media(max-width:768px){.rooms-page .rp-room__cell-body{padding:24px 20px 20px}}
.rooms-page .rp-room__cell-num{
  font-family:'Inter',sans-serif;font-size:9px;font-weight:600;
  letter-spacing:.2em;text-transform:uppercase;color:rgba(212,169,122,.7);
  margin-bottom:10px
}
.rooms-page .rp-room__cell-name{
  font-family:'Playfair Display',serif;font-size:clamp(24px,2.5vw,36px);
  font-weight:700;color:#F5F1E8;line-height:1.1;margin-bottom:4px
}
.rooms-page .rp-room__cell-english{
  font-family:'Inter',sans-serif;font-size:10px;font-weight:500;
  letter-spacing:.12em;text-transform:uppercase;
  color:rgba(212,169,122,.72);margin-bottom:12px
}
.rooms-page .rp-room__cell-tagline{
  font-family:'Inter',sans-serif;font-size:13px;
  color:rgba(245,241,232,.68);line-height:1.5;margin-bottom:16px
}
.rooms-page .rp-room__cell-cta{
  display:inline-flex;align-items:center;gap:6px;
  font-family:'Inter',sans-serif;font-size:10px;font-weight:600;
  letter-spacing:.12em;text-transform:uppercase;
  color:#F5F1E8;border-bottom:1px solid rgba(176,136,80,.4);
  padding-bottom:3px;text-decoration:none;
  transition:gap .3s,border-color .3s,color .3s
}
.rooms-page .rp-room__cell:hover .rp-room__cell-cta{gap:12px;border-color:#D4A97A;color:#D4A97A}
.rooms-page .rp-room__cell-arrow{
  font-size:14px !important;transform:translateX(-3px);opacity:0;
  transition:transform .35s cubic-bezier(.16,1,.3,1),opacity .3s
}
.rooms-page .rp-room__cell:hover .rp-room__cell-arrow{transform:translateX(0);opacity:1}
.rooms-page .rp-room__cell-chips{display:flex;flex-wrap:wrap;gap:4px;margin-top:12px}
.rooms-page .rp-room__cell-chip{
  font-family:'Inter',sans-serif;font-size:8px;font-weight:500;
  letter-spacing:.1em;text-transform:uppercase;
  color:rgba(212,169,122,.7);border:1px solid rgba(176,136,80,.3);
  padding:2px 7px
}

/* text panel typography */
.rooms-page .rp-room__num-inner{
  font-family:'Inter',sans-serif;font-size:9px;font-weight:600;
  letter-spacing:.2em;text-transform:uppercase;color:#B08850;
  margin-bottom:14px
}
.rooms-page .rp-room__name{
  font-family:'Playfair Display',serif;
  font-size:clamp(32px,4vw,52px);font-weight:700;
  line-height:1.05;color:#1A1915;margin-bottom:6px;
  transition:color .3s
}
.rooms-page .rp-room:hover .rp-room__name{color:#C4622D}
.rooms-page .rp-room__english{
  font-family:'Inter',sans-serif;font-size:11px;font-weight:500;
  letter-spacing:.14em;text-transform:uppercase;
  color:#B08850;margin-bottom:20px
}
.rooms-page .rp-room__tagline{
  font-family:'Playfair Display',serif;font-style:italic;
  font-size:18px;color:#5C5850;line-height:1.5;
  margin-bottom:16px
}
.rooms-page .rp-room__desc{
  font-family:'Inter',sans-serif;font-size:14px;
  color:#7A766E;line-height:1.7;margin-bottom:28px;max-width:340px
}
.rooms-page .rp-room__cta{
  display:inline-flex;align-items:center;gap:8px;
  font-family:'Inter',sans-serif;font-size:11px;font-weight:600;
  letter-spacing:.12em;text-transform:uppercase;
  color:#1A1915;border-bottom:1px solid #C8C0B0;padding-bottom:4px;
  text-decoration:none;transition:gap .3s,border-color .3s,color .3s
}
.rooms-page .rp-room:hover .rp-room__cta{gap:14px;border-color:#C4622D;color:#C4622D}
.rooms-page .rp-room__arrow{
  font-size:14px !important;transform:translateX(-3px);opacity:0;
  transition:transform .35s cubic-bezier(.16,1,.3,1),opacity .3s
}
.rooms-page .rp-room:hover .rp-room__arrow{transform:translateX(0);opacity:1}
.rooms-page .rp-room__chips{display:flex;flex-wrap:wrap;gap:5px;margin-top:20px}
.rooms-page .rp-room__chip{
  font-family:'Inter',sans-serif;font-size:9px;font-weight:500;
  letter-spacing:.1em;text-transform:uppercase;
  color:#78776f;border:1px solid #C8C0B0;padding:3px 8px
}

/* decorative corner arch */
.rooms-page .rp-room__text-panel::before{
  content:'';position:absolute;top:32px;right:32px;
  width:48px;height:62px;border:1px solid #C8C0B0;
  border-bottom:none;border-radius:24px 24px 0 0;opacity:.4
}
@media(max-width:900px){.rooms-page .rp-room__text-panel::before{display:none}}

/* sliding bottom accent */
.rooms-page .rp-room::after{
  content:'';position:absolute;bottom:0;left:0;width:0;height:2px;
  background:linear-gradient(90deg,#C4622D,#B08850);
  transition:width .6s cubic-bezier(.16,1,.3,1);z-index:20
}
.rooms-page .rp-room:hover::after{width:100%}

/* ── EDITORIAL BREAK ─────────────────────────────────────── */
.rooms-page .rp-editorial{
  position:relative;width:100%;height:540px;overflow:hidden;
  display:flex;align-items:center;justify-content:center;
  background:#1A1915
}
@media(max-width:768px){.rooms-page .rp-editorial{height:400px}}
.rooms-page .rp-editorial__img{
  position:absolute;inset:0;width:100%;height:100%;object-fit:cover;
  filter:saturate(1.08) sepia(0.12) brightness(0.7);
  transform:scale(1.05);transform-origin:center
}
.rooms-page .rp-editorial__overlay{
  position:absolute;inset:0;
  background:rgba(26,25,21,.58)
}
.rooms-page .rp-editorial__content{
  position:relative;z-index:10;text-align:center;
  padding:0 24px;max-width:760px
}
.rooms-page .rp-editorial__kicker{
  font-family:'Inter',sans-serif;font-size:9px;font-weight:600;
  letter-spacing:.24em;text-transform:uppercase;
  color:rgba(176,136,80,.8);margin-bottom:24px;
  display:block
}
.rooms-page .rp-editorial__headline{
  font-family:'Playfair Display',serif;
  font-size:clamp(26px,4.5vw,58px);font-weight:700;
  color:#F5F1E8;line-height:1.1;letter-spacing:-.015em;margin-bottom:20px
}
.rooms-page .rp-editorial__headline em{font-style:italic;color:#D4A97A}
.rooms-page .rp-editorial__rule{
  width:36px;height:1px;background:rgba(176,136,80,.5);
  margin:0 auto 20px
}
.rooms-page .rp-editorial__sub{
  font-family:'Inter',sans-serif;font-size:14px;
  color:rgba(245,241,232,.62);letter-spacing:.06em
}

/* ── CLOSING CTA ─────────────────────────────────────────── */
.rooms-page .rp-closing{
  background:#F5F1E8;border-top:1px solid #C8C0B0;
  padding:100px 64px;text-align:center
}
@media(max-width:768px){.rooms-page .rp-closing{padding:64px 20px}}
.rooms-page .rp-closing__kicker{
  font-family:'Inter',sans-serif;font-size:9px;font-weight:600;
  letter-spacing:.22em;text-transform:uppercase;color:#B08850;
  margin-bottom:24px;display:block
}
.rooms-page .rp-closing__headline{
  font-family:'Playfair Display',serif;
  font-size:clamp(28px,4vw,52px);font-weight:600;
  color:#1A1915;line-height:1.2;margin-bottom:16px;max-width:640px;
  margin-left:auto;margin-right:auto
}
.rooms-page .rp-closing__rule{
  width:48px;height:1px;background:#C4622D;
  margin:0 auto 24px
}
.rooms-page .rp-closing__sub{
  font-family:'Inter',sans-serif;font-size:15px;color:#7A766E;
  line-height:1.7;max-width:400px;margin:0 auto 40px
}

/* ── ANIMATIONS ──────────────────────────────────────────── */
@keyframes rp-rise{
  from{opacity:0;transform:translateY(16px)}
  to{opacity:1;transform:translateY(0)}
}
.rooms-page .rp-reveal{
  opacity:0;transform:translateY(32px);
  transition:opacity .8s cubic-bezier(.16,1,.3,1),transform .8s cubic-bezier(.16,1,.3,1)
}
.rooms-page .rp-reveal.rp-visible{opacity:1;transform:translateY(0)}
</style>
<style>
/* Rooms page navbar — vintage parchment/brass so links read over dark hero */
.rooms-page #main-nav a{color:#D4A97A !important}
.rooms-page #main-nav button .material-symbols-outlined{color:#D4A97A !important}
.rooms-page #main-nav.scrolled a{color:#5f5e58 !important}
.rooms-page #main-nav.scrolled button .material-symbols-outlined{color:#5f5e58 !important}
.rooms-page #main-nav.scrolled a.text-secondary{color:#974724 !important}
</style>
</head>
<body class="bg-background text-on-background font-body-md antialiased overflow-x-hidden selection:bg-secondary-container selection:text-on-secondary-container rooms-page" data-mode="connect">
<div class="texture-overlay"></div>

<?php
$activePage = 'rooms';
require_once __DIR__ . '/includes/session.php';
include __DIR__ . '/includes/public-nav.php';
?>

<main>

<!-- ════════════════════════════════════════════════════════
     1. HERO — Rajasthani haveli-inspired immersive
════════════════════════════════════════════════════════ -->
<section class="rp-hero">
  <img class="rp-hero__img" id="rp-hero-img"
    src="https://images.unsplash.com/photo-1590381105924-c72589b9ef3f?w=1800&q=85&auto=format&fit=crop"
    alt="A warm haveli interior with carved archways terracotta walls antique brass lamps and handwoven textiles in soft afternoon light.">
  <div class="rp-hero__overlay"></div>
  <div class="rp-hero__content">
    <p class="rp-hero__eyebrow">A Curation by Rangrez &nbsp;&#x2014;&nbsp; Six Rooms</p>
    <h1 class="rp-hero__headline">Rooms,<br><em>with a story.</em></h1>
    <p class="rp-hero__sub">Spaces shaped by craft, colour and the quiet grandeur of Rajasthan.</p>
    <a class="rp-hero__cta" href="#rooms-baithak">
      Explore the Rooms
      <span class="material-symbols-outlined" style="font-size:15px;line-height:1">arrow_forward</span>
    </a>
  </div>
  <div class="rp-hero__side">
    <div class="rp-hero__side-line"></div>
    <span class="rp-hero__side-text">Royal India, reinterpreted</span>
  </div>
</section>

<!-- ════════════════════════════════════════════════════════
     2. PAGE INTRO
════════════════════════════════════════════════════════ -->
<section class="rp-intro rp-reveal" id="rooms-baithak">
  <div class="rp-divider">
    <div class="rp-diamond"></div>
    <div class="rp-divider__line"></div>
    <div class="rp-diamond"></div>
  </div>
  <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
    <div>
      <div class="rp-intro__rule"></div>
      <h2 class="rp-intro__heading">Choose your space.<br>Discover what belongs there.</h2>
      <p class="rp-intro__sub">Six rooms. Six feelings. Each one shaped by the materials, textiles and objects of Indian craft.</p>
    </div>
    <p style="font-family:'Inter',sans-serif;font-size:9px;letter-spacing:.22em;text-transform:uppercase;color:#B08850;white-space:nowrap;opacity:.7">
      Baithak &nbsp;/&nbsp; Shayan &nbsp;/&nbsp; Bhoj &nbsp;/&nbsp; Karya &nbsp;/&nbsp; Aangan &nbsp;/&nbsp; Deorhi
    </p>
  </div>
</section>

<!-- ════════════════════════════════════════════════════════
     3. ROOMS
════════════════════════════════════════════════════════ -->
<div class="rp-rooms">

  <!-- ── 01 BAITHAK — full-width immersive feature ── -->
  <div class="rp-room rp-room--baithak rp-reveal" id="room-baithak">
    <div class="rp-room__img-panel">
      <img class="rp-room__img"
        src="https://i.pinimg.com/1200x/99/14/2d/99142d743c16a0823e895fcec75fe29c.jpg"
        alt="A warm Rajasthani-style sitting room with low carved wooden seating rich terracotta textiles antique brass lamps and arched sandstone walls.">
      <div class="rp-room__img-overlay"></div>
      <span class="rp-room__num">01 of 06</span>
    </div>
    <div class="rp-room__text-panel">
      <p class="rp-room__num-inner" style="color:rgba(212,169,122,.75)">01 &mdash; Baithak</p>
      <h2 class="rp-room__name">Baithak</h2>
      <p class="rp-room__english">Living / Gathering</p>
      <p class="rp-room__tagline">Gather beautifully.</p>
      <div class="rp-room__chips">
        <span class="rp-room__chip">Lamps</span>
        <span class="rp-room__chip">Vases</span>
        <span class="rp-room__chip">Mirrors</span>
        <span class="rp-room__chip">Table Decor</span>
      </div>
      <div style="margin-top:28px">
        <a class="rp-room__cta" href="#">
          Explore Baithak
          <span class="material-symbols-outlined rp-room__arrow">arrow_forward</span>
        </a>
      </div>
    </div>
  </div>
<br>
<br>
  <!-- ── 02 + 03 SHAYAN & BHOJ — side-by-side pair ── -->
  <div class="rp-room rp-room--pair rp-reveal">

    <!-- SHAYAN -->
    <a class="rp-room__cell" href="#">
      <img class="rp-room__cell-img"
        src="https://i.pinimg.com/736x/e1/07/9d/e1079d18fe963590f99bf90e341fec28.jpg"
        alt="An elegant Indian heritage bedroom with handwoven block-print textiles warm wooden furniture arched wall details and brass bedside lighting.">
      <div class="rp-room__cell-overlay"></div>
      <div class="rp-room__cell-body">
        <p class="rp-room__cell-num">02 &mdash; Shayan</p>
        <h3 class="rp-room__cell-name">Shayan</h3>
        <p class="rp-room__cell-english">Bedroom / Rest</p>
        <p class="rp-room__cell-tagline">Slow mornings. Softer nights.</p>
        <span class="rp-room__cell-cta">
          Explore Shayan <span class="material-symbols-outlined rp-room__cell-arrow">arrow_forward</span>
        </span>
        <div class="rp-room__cell-chips">
          <span class="rp-room__cell-chip">Candles</span>
          <span class="rp-room__cell-chip">Textiles</span>
          <span class="rp-room__cell-chip">Bedside Decor</span>
        </div>
      </div>
    </a>

    <!-- BHOJ -->
    <a class="rp-room__cell" href="#">
      <img class="rp-room__cell-img"
        src="https://i.pinimg.com/736x/10/e8/6d/10e86dc4169804d1f8b6da382ffda5ac.jpg"
        alt="An intimate Indian dining room with handcrafted ceramics brassware textile runner warm carved wood and arched haveli architecture.">
      <div class="rp-room__cell-overlay"></div>
      <div class="rp-room__cell-body">
        <p class="rp-room__cell-num">03 &mdash; Bhoj</p>
        <h3 class="rp-room__cell-name">Bhoj</h3>
        <p class="rp-room__cell-english">Dining / Hosting</p>
        <p class="rp-room__cell-tagline">Make every meal ceremonial.</p>
        <span class="rp-room__cell-cta">
          Explore Bhoj <span class="material-symbols-outlined rp-room__cell-arrow">arrow_forward</span>
        </span>
        <div class="rp-room__cell-chips">
          <span class="rp-room__cell-chip">Ceramics</span>
          <span class="rp-room__cell-chip">Serveware</span>
          <span class="rp-room__cell-chip">Centrepieces</span>
        </div>
      </div>
    </a>

  </div>
<br>
<br>
  <!-- ── 04 KARYA — text-heavy left, image right ── -->
  <div class="rp-room rp-room--karya rp-reveal">
    <div class="rp-room__text-panel" style="border-left:none;border-right:1px solid #C8C0B0">
      <p class="rp-room__num-inner">04 &mdash; Karya</p>
      <h2 class="rp-room__name">Karya</h2>
      <p class="rp-room__english">Study / Work</p>
      <p class="rp-room__tagline">A corner worth staying in.</p>
      <p class="rp-room__desc">A carved desk, a brass lamp, a ceramic object that earns its place. Work that feels like ritual.</p>
      <div class="rp-room__chips">
        <span class="rp-room__chip">Desk Objects</span>
        <span class="rp-room__chip">Brass Lamps</span>
        <span class="rp-room__chip">Rugs</span>
        <span class="rp-room__chip">Ceramics</span>
      </div>
      <div style="margin-top:28px">
        <a class="rp-room__cta" href="#">
          Explore Karya
          <span class="material-symbols-outlined rp-room__arrow">arrow_forward</span>
        </a>
      </div>
    </div>
    <div class="rp-room__img-panel">
      <img class="rp-room__img"
        src="https://i.pinimg.com/736x/ec/f3/9a/ecf39a5364b9a5e9040874bd84a52ffa.jpg"
        alt="A refined Indian study with dark carved wooden desk brass lamp handmade ceramics and an arched alcove with warm afternoon light.">
      <div class="rp-room__img-overlay"></div>
    </div>
  </div>

</div>

<!-- ════════════════════════════════════════════════════════
     4. EDITORIAL BREAK
════════════════════════════════════════════════════════ -->
<section class="rp-editorial rp-reveal">
  <img class="rp-editorial__img"
    src="https://i.pinimg.com/1200x/7f/ab/43/7fab4316ccb24a8f1ade55496448bed7.jpg"
    alt="A warm Indian interior courtyard with sandstone limewash walls terracotta floor handwoven textiles and soft golden afternoon light.">
  <div class="rp-editorial__overlay"></div>
  <div class="rp-editorial__content">
    <span class="rp-editorial__kicker">A Note on Spaces</span>
    <div class="rp-editorial__rule"></div>
    <h2 class="rp-editorial__headline">
      Your home doesn&rsquo;t<br>need to be perfect.<br>
      It needs to be <em>yours.</em>
    </h2>
    <p class="rp-editorial__sub">Heritage, texture and objects with a point of view.</p>
  </div>
</section>
<br>
<br>
<!-- ════════════════════════════════════════════════════════
     5. ROOMS continued — AANGAN + DEORHI
════════════════════════════════════════════════════════ -->
<div class="rp-rooms" style="padding-top:0">

  <!-- ── 05 AANGAN — wide immersive ── -->
  <div class="rp-room rp-room--aangan rp-reveal" style="border-top:1px solid #C8C0B0">
    <div class="rp-room__img-panel">
      <img class="rp-room__img"
        src="https://i.pinimg.com/736x/38/48/e8/3848e87444f043374f0743b3f22b3a1a.jpg"
        alt="A contemporary Rajasthani courtyard with sandstone arched openings textiles floor seating and warm sunlight filtering through carved jharokha.">
      <div class="rp-room__img-overlay"></div>
      <span class="rp-room__num">05 of 06</span>
    </div>
    <div class="rp-room__text-panel">
      <p class="rp-room__num-inner" style="color:rgba(212,169,122,.75)">05 &mdash; Aangan</p>
      <h2 class="rp-room__name">Aangan</h2>
      <p class="rp-room__english">Balcony / Courtyard</p>
      <p class="rp-room__tagline">A little outside. A lot of soul.</p>
      <div class="rp-room__chips">
        <span class="rp-room__chip">Lanterns</span>
        <span class="rp-room__chip">Planters</span>
        <span class="rp-room__chip">Outdoor Textiles</span>
        <span class="rp-room__chip">Rattan</span>
      </div>
      <div style="margin-top:28px">
        <a class="rp-room__cta" href="#">
          Explore Aangan
          <span class="material-symbols-outlined rp-room__arrow">arrow_forward</span>
        </a>
      </div>
    </div>
  </div>
<br>
<br>
  <!-- ── 06 DEORHI — portrait right ── -->
  <div class="rp-room rp-room--deorhi rp-reveal">
    <div class="rp-room__text-panel" style="border-left:none;border-right:1px solid #C8C0B0;justify-content:flex-start;padding-top:60px">
      <p class="rp-room__num-inner">06 &mdash; Deorhi</p>
      <h2 class="rp-room__name">Deorhi</h2>
      <p class="rp-room__english">Entryway</p>
      <p class="rp-room__tagline">Make the first impression count.</p>
      <p class="rp-room__desc">The entry sets the tone for everything beyond it. A mirror, a lamp, a vessel with presence.</p>
      <div class="rp-room__chips">
        <span class="rp-room__chip">Arched Mirrors</span>
        <span class="rp-room__chip">Brass Hooks</span>
        <span class="rp-room__chip">Pottery</span>
        <span class="rp-room__chip">Wall Art</span>
      </div>
      <div style="margin-top:28px">
        <a class="rp-room__cta" href="#">
          Explore Deorhi
          <span class="material-symbols-outlined rp-room__arrow">arrow_forward</span>
        </a>
      </div>
    </div>
    <div class="rp-room__img-panel">
      <img class="rp-room__img"
        src="https://i.pinimg.com/736x/7d/58/eb/7d58ebe0b2c58b7387731b420838930f.jpg"
        alt="An elegant haveli-inspired entryway with arched mirror antique brass lighting dark wood console and a ceramic vessel.">
      <div class="rp-room__img-overlay"></div>
    </div>
  </div>

</div>

<!-- ════════════════════════════════════════════════════════
     6. CLOSING CTA
════════════════════════════════════════════════════════ -->
<section class="rp-closing rp-reveal">
  <div style="display:flex;align-items:center;gap:16px;justify-content:center;margin-bottom:28px">
    <div class="rp-diamond"></div>
    <div style="width:64px;height:1px;background:#C8C0B0"></div>
    <div class="rp-diamond"></div>
  </div>
  <span class="rp-closing__kicker">Rajasthan, Reinterpreted</span>
  <h2 class="rp-closing__headline">Every room has something worth discovering.</h2>
  <div class="rp-closing__rule"></div>
  <p class="rp-closing__sub">Begin with the room. Let the objects find you.</p>
  <a class="btn-secondary" href="products.php">Shop All Objects</a>
</section>

</main>

<!-- FOOTER — identical to index.php -->
<footer class="w-full py-section-gap px-margin-mobile md:px-margin-desktop grid grid-cols-1 md:grid-cols-4 gap-gutter bg-surface-container border-t bg-surface-container-high full-width bottom-0">
  <div class="md:col-span-1 flex flex-col items-start">
    <a class="font-display-lg text-display-lg text-primary mb-8" href="index.php"><img src="images/logo.png" alt="KALACTIVE"></a>
    <p class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant">CURATED BY RANGREZ.</p>
  </div>
  <div class="md:col-span-3 grid grid-cols-2 md:grid-cols-4 gap-8">
    <div class="flex flex-col space-y-4">
      <a class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant hover:underline decoration-secondary underline-offset-4" href="index.php">SHOP</a>
      <a class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant hover:underline decoration-secondary underline-offset-4" href="products.php">COLLECTIONS</a>
      <a class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant hover:underline decoration-secondary underline-offset-4" href="story.php">OUR STORY</a>
    </div>
    <div class="flex flex-col space-y-4">
      <a class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant hover:underline decoration-secondary underline-offset-4" href="help.php">HELP</a>
      <a class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant hover:underline decoration-secondary underline-offset-4" href="help.php">CONTACT</a>
    </div>
    <div class="col-span-2 md:col-span-2">
      <p class="font-label-sm text-label-sm uppercase tracking-widest text-primary mb-4">JOIN THE NARRATIVE</p><br>
      <form class="flex items-end max-w-sm">
        <div class="relative w-full">
          <label class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant absolute -top-5 left-0" for="rp-email">EMAIL ADDRESS</label>
          <input class="w-full bg-transparent border-0 border-b border-outline-variant focus:border-secondary focus:ring-0 px-0 py-2 font-body-md text-on-background placeholder-on-surface-variant/50 transition-colors" id="rp-email" placeholder="Enter your email" type="email">
        </div>
        <button class="ml-4 text-secondary hover:text-primary transition-colors" type="submit"><span class="material-symbols-outlined">arrow_forward</span></button>
      </form>
    </div>
  </div>
</footer>

<script src="js/script.js"></script>
<script>
/* ROOMS PAGE ONLY — scoped IIFE */
(function(){
  if(!document.body.classList.contains('rooms-page')) return;

  /* hero scroll parallax */
  var hi = document.getElementById('rp-hero-img');
  if(hi){
    window.addEventListener('scroll',function(){
      var s=window.scrollY;
      if(s<window.innerHeight){
        hi.style.transform='translateY('+(s*0.18)+'px) scale(1.07)';
      }
    },{passive:true});
  }

  /* scroll reveal for .rp-reveal elements */
  var revealEls = document.querySelectorAll('.rooms-page .rp-reveal');
  if('IntersectionObserver' in window){
    var obs = new IntersectionObserver(function(entries){
      entries.forEach(function(e){
        if(e.isIntersecting){
          e.target.classList.add('rp-visible');
          obs.unobserve(e.target);
        }
      });
    },{threshold:0.1,rootMargin:'0px 0px -40px 0px'});
    revealEls.forEach(function(el){ obs.observe(el); });
  } else {
    revealEls.forEach(function(el){ el.classList.add('rp-visible'); });
  }
})();
</script>
</body>
</html>
