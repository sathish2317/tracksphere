<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<meta name="theme-color" content="#050a16">
<title>TrackSphere — Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
<style>
:root{
  --bg:#050a16;--bg1:#0a1428;--bg2:#0f1d3a;--bg3:#142248;
  --cyan:#00e5ff;--purple:#7b5fff;--green:#00ff9d;--red:#ff3d5a;--amber:#ffb830;
  --text:#dce9ff;--muted:#5a7399;--dim:#2a3f60;
  --border:rgba(0,229,255,0.1);--r:10px;--rs:7px;
  --mono:'JetBrains Mono',monospace;--body:'DM Sans',sans-serif;
  --sidebar-w:224px;--topbar-h:58px;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
html{scroll-behavior:smooth;}
body{font-family:var(--body);background:var(--bg);color:var(--text);min-height:100vh;overflow-x:hidden;}
body::before{content:'';position:fixed;inset:0;background-image:linear-gradient(rgba(0,229,255,0.02) 1px,transparent 1px),linear-gradient(90deg,rgba(0,229,255,0.02) 1px,transparent 1px);background-size:38px 38px;pointer-events:none;z-index:0;}

/* ── TOPBAR ── */
.topbar{display:flex;align-items:center;justify-content:space-between;padding:0 1.2rem;height:var(--topbar-h);background:var(--bg1);border-bottom:1px solid var(--border);position:fixed;top:0;left:0;right:0;z-index:200;}
.topbar-brand{font-family:var(--mono);font-size:1rem;color:var(--cyan);display:flex;align-items:center;gap:9px;letter-spacing:-0.5px;font-weight:700;}
.topbar-right{display:flex;align-items:center;gap:8px;}
.user-badge{display:flex;align-items:center;gap:8px;background:var(--bg2);border:1px solid var(--border);border-radius:20px;padding:3px 10px 3px 4px;font-size:0.8rem;}
.user-avatar{width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,var(--purple),var(--cyan));display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:#fff;flex-shrink:0;}
.live-dot{width:7px;height:7px;border-radius:50%;background:var(--green);animation:blink 2s infinite;flex-shrink:0;}
@keyframes blink{0%,100%{opacity:1;}50%{opacity:0.35;}}
.tag{display:inline-flex;align-items:center;font-size:0.6rem;padding:2px 6px;border-radius:4px;font-weight:700;letter-spacing:0.5px;text-transform:uppercase;}
.t-cyan{background:rgba(0,229,255,0.12);color:var(--cyan);}
.t-purple{background:rgba(123,95,255,0.12);color:var(--purple);}
.t-green{background:rgba(0,255,157,0.12);color:var(--green);}
.t-red{background:rgba(255,61,90,0.12);color:var(--red);}
.t-amber{background:rgba(255,184,48,0.12);color:var(--amber);}
.hamburger{display:none;background:none;border:none;color:var(--text);font-size:22px;cursor:pointer;padding:4px;}
.btn-topbar{background:transparent;border:1px solid var(--border);color:var(--muted);font-family:var(--body);font-size:0.75rem;padding:0.35rem 0.75rem;border-radius:var(--rs);cursor:pointer;transition:all 0.15s;}
.btn-topbar:hover{border-color:var(--red);color:var(--red);}
.topbar-msg-btn{position:relative;background:transparent;border:1px solid var(--border);color:var(--muted);font-family:var(--body);font-size:0.75rem;padding:0.35rem 0.75rem;border-radius:var(--rs);cursor:pointer;transition:all 0.15s;}
.topbar-msg-btn:hover{border-color:var(--cyan);color:var(--cyan);}
.msg-badge{position:absolute;top:-5px;right:-5px;background:var(--red);color:#fff;font-size:0.6rem;font-weight:700;border-radius:50%;width:16px;height:16px;display:flex;align-items:center;justify-content:center;display:none;}
.msg-badge.show{display:flex;}

/* ── LAYOUT ── */
.app{display:flex;padding-top:var(--topbar-h);min-height:100vh;}

/* ── SIDEBAR ── */
.sidebar{width:var(--sidebar-w);background:var(--bg1);border-right:1px solid var(--border);padding:1rem 0.65rem;flex-shrink:0;display:flex;flex-direction:column;position:fixed;top:var(--topbar-h);bottom:0;overflow-y:auto;z-index:100;transition:transform 0.3s ease;}
.nav-sec{font-size:0.6rem;color:var(--dim);letter-spacing:2px;text-transform:uppercase;padding:0 0.6rem;margin:0.85rem 0 0.35rem;font-weight:600;}
.nav-item{display:flex;align-items:center;gap:9px;padding:0.52rem 0.65rem;border-radius:var(--rs);color:var(--muted);font-size:0.82rem;cursor:pointer;transition:all 0.14s;border:1px solid transparent;margin-bottom:1px;user-select:none;}
.nav-item:hover{background:var(--bg2);color:var(--text);}
.nav-item.active{background:rgba(0,229,255,0.07);color:var(--cyan);border-color:rgba(0,229,255,0.12);}
.nav-icon{font-size:15px;width:18px;text-align:center;flex-shrink:0;}
.nav-label{flex:1;}
.nav-badge{background:var(--purple);color:#fff;font-size:0.6rem;padding:2px 5px;border-radius:8px;font-weight:700;min-width:18px;text-align:center;}
.nav-badge.red{background:var(--red);}
.sidebar-footer{margin-top:auto;padding-top:0.8rem;border-top:1px solid var(--border);}
.overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,0.6);z-index:99;}

/* ── MAIN ── */
.main{flex:1;margin-left:var(--sidebar-w);padding:1.5rem;position:relative;z-index:1;}
.page{display:none;}
.page.active{display:block;animation:fadeIn 0.2s ease;}
@keyframes fadeIn{from{opacity:0;transform:translateY(4px);}to{opacity:1;transform:translateY(0);}}

/* ── CARDS ── */
.page-hdr{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:10px;}
.page-title{font-family:var(--mono);font-size:1.05rem;letter-spacing:-0.5px;}
.page-sub{font-size:0.74rem;color:var(--muted);margin-top:2px;}
.card{background:var(--bg1);border:1px solid var(--border);border-radius:var(--r);padding:1.2rem;}
.card-title{font-size:0.7rem;color:var(--muted);letter-spacing:1.5px;text-transform:uppercase;font-weight:600;margin-bottom:0.85rem;display:flex;align-items:center;gap:7px;}

/* ── STAT GRID ── */
.stat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.5rem;}
.stat-card{background:var(--bg1);border:1px solid var(--border);border-radius:var(--r);padding:1rem 1.15rem;position:relative;overflow:hidden;}
.stat-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;}
.sc1::before{background:var(--cyan);}
.sc2::before{background:var(--purple);}
.sc3::before{background:var(--green);}
.sc4::before{background:var(--amber);}
.stat-label{font-size:0.67rem;color:var(--muted);letter-spacing:1px;text-transform:uppercase;font-weight:600;margin-bottom:4px;}
.stat-val{font-family:var(--mono);font-size:1.7rem;font-weight:700;line-height:1;margin-bottom:3px;}
.stat-sub{font-size:0.68rem;color:var(--muted);}
.stat-bg{position:absolute;right:1rem;top:50%;transform:translateY(-50%);font-size:2.2rem;opacity:0.06;}

/* ── GRID LAYOUTS ── */
.two-col{display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1.5rem;}
.three-col{display:grid;grid-template-columns:1fr 1fr 1fr;gap:1rem;margin-bottom:1.5rem;}

/* ── TABLE ── */
.data-table{width:100%;border-collapse:collapse;font-size:0.82rem;}
.data-table th{text-align:left;padding:0.5rem 0.85rem;font-size:0.63rem;letter-spacing:1px;text-transform:uppercase;color:var(--dim);font-weight:600;border-bottom:1px solid var(--border);}
.data-table td{padding:0.65rem 0.85rem;border-bottom:1px solid rgba(0,229,255,0.03);vertical-align:middle;}
.data-table tr:last-child td{border-bottom:none;}
.data-table tr:hover td{background:rgba(0,229,255,0.018);}
.table-wrap{overflow-x:auto;}

/* ── BADGES ── */
.badge{display:inline-flex;align-items:center;gap:4px;font-size:0.7rem;padding:2px 7px;border-radius:8px;font-weight:600;}
.b-online{background:rgba(0,255,157,0.1);color:var(--green);}
.b-offline{background:rgba(255,61,90,0.1);color:var(--red);}
.b-verified{background:rgba(0,229,255,0.1);color:var(--cyan);}
.b-pending{background:rgba(123,95,255,0.1);color:var(--purple);}
.b-amber{background:rgba(255,184,48,0.1);color:var(--amber);}

/* ── BUTTONS ── */
.btn{display:inline-flex;align-items:center;justify-content:center;gap:7px;padding:0.6rem 1.2rem;border:none;border-radius:var(--rs);font-family:var(--body);font-size:0.85rem;font-weight:600;cursor:pointer;transition:all 0.18s;text-decoration:none;}
.btn-primary{background:linear-gradient(135deg,var(--purple),#4f2fcc);color:#fff;}
.btn-primary:hover{opacity:0.88;transform:translateY(-1px);}
.btn-cyan{background:var(--cyan);color:var(--bg);font-weight:700;}
.btn-cyan:hover{opacity:0.88;}
.btn-green{background:var(--green);color:var(--bg);font-weight:700;}
.btn-ghost{background:transparent;border:1px solid var(--border);color:var(--muted);font-size:0.78rem;padding:0.35rem 0.72rem;}
.btn-ghost:hover{border-color:var(--cyan);color:var(--cyan);}
.btn-danger{background:var(--red);color:#fff;}
.btn-danger:hover{opacity:0.88;}
.btn-sm{padding:0.28rem 0.62rem;font-size:0.73rem;}
.btn-amber{background:var(--amber);color:var(--bg);font-weight:700;}
.btn:disabled{opacity:0.55;cursor:default;transform:none;}

/* ── FORMS ── */
.fg{margin-bottom:0.9rem;}
label,.form-label{display:block;font-size:0.68rem;color:var(--muted);letter-spacing:1.5px;text-transform:uppercase;margin-bottom:5px;font-weight:600;}
input[type=text],input[type=email],input[type=password],input[type=number],select,textarea{width:100%;padding:0.6rem 0.88rem;background:var(--bg2);border:1.5px solid var(--border);border-radius:var(--rs);color:var(--text);font-family:var(--body);font-size:0.86rem;outline:none;transition:border-color 0.2s;}
input:focus,select:focus,textarea:focus{border-color:var(--cyan);}
input::placeholder,textarea::placeholder{color:var(--dim);}
select option{background:var(--bg2);}

/* ── COORDS CARDS ── */
.coords-card{background:var(--bg);border:1px solid var(--border);border-radius:var(--r);padding:1.4rem;text-align:center;position:relative;overflow:hidden;}
.coords-card::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at center,rgba(0,229,255,0.04) 0%,transparent 70%);pointer-events:none;}
.coords-label{font-size:0.67rem;color:var(--muted);letter-spacing:2px;text-transform:uppercase;margin-bottom:7px;}
.coords-value{font-family:var(--mono);font-size:1.6rem;font-weight:700;color:var(--cyan);letter-spacing:-1px;line-height:1.1;}
.coords-sub{font-size:0.73rem;color:var(--muted);margin-top:4px;}

/* ── BATTERY ── */
.bat-wrap{height:6px;background:var(--bg);border-radius:3px;overflow:hidden;margin-top:3px;}
.bat-bar{height:100%;border-radius:3px;transition:width 0.6s ease;}
.bat-hi{background:var(--green);}
.bat-mid{background:var(--amber);}
.bat-lo{background:var(--red);}

/* ── BATTERY RING ── */
.bat-ring-wrap{display:flex;align-items:center;justify-content:center;gap:24px;padding:0.5rem 0 1rem;}
.bat-ring-info{display:flex;flex-direction:column;gap:10px;}
.bat-info-row{display:flex;flex-direction:column;}
.bat-info-label{font-size:0.63rem;color:var(--muted);text-transform:uppercase;letter-spacing:1px;}
.bat-info-val{font-size:0.9rem;font-weight:600;}

/* ── PULSE TRACKING BANNER ── */
.track-banner{background:linear-gradient(90deg,rgba(0,255,157,0.07),rgba(0,229,255,0.05));border:1px solid rgba(0,255,157,0.18);border-radius:var(--r);padding:0.75rem 1rem;margin-bottom:1.5rem;display:flex;align-items:center;gap:10px;font-size:0.82rem;flex-wrap:wrap;}
.track-pulse{width:10px;height:10px;border-radius:50%;background:var(--green);flex-shrink:0;animation:blink 1s infinite;}

/* ── TIMELINE ── */
.timeline{position:relative;padding-left:22px;}
.timeline::before{content:'';position:absolute;left:7px;top:0;bottom:0;width:1px;background:var(--border);}
.tl-item{position:relative;padding-bottom:1rem;font-size:0.81rem;}
.tl-dot{position:absolute;left:-19px;top:4px;width:9px;height:9px;border-radius:50%;background:var(--cyan);border:2px solid var(--bg);}
.tl-dot.warn{background:var(--amber);}
.tl-dot.danger{background:var(--red);}
.tl-time{font-size:0.67rem;color:var(--dim);margin-bottom:1px;font-family:var(--mono);}
.tl-loc{color:var(--text);font-weight:500;}
.tl-coords{font-family:var(--mono);font-size:0.71rem;color:var(--cyan);margin-top:1px;}
.tl-meta{font-size:0.7rem;color:var(--muted);margin-top:2px;}

/* ── ALERT ITEM ── */
.alert-item{display:flex;align-items:flex-start;gap:9px;padding:0.8rem;background:var(--bg2);border-radius:var(--rs);border-left:3px solid var(--amber);margin-bottom:7px;font-size:0.81rem;}

/* ── BAR CHART ── */
.bar-row{display:flex;align-items:center;gap:10px;margin-bottom:7px;font-size:0.73rem;}
.bar-label{width:26px;text-align:right;color:var(--muted);}
.bar-track{flex:1;height:7px;background:var(--bg2);border-radius:3px;overflow:hidden;}
.bar-fill{height:100%;border-radius:3px;background:var(--purple);transition:width 1.2s ease;}
.bar-val{width:28px;color:var(--muted);}

/* ── CODE BLOCK ── */
.code-block{font-family:var(--mono);font-size:0.7rem;background:var(--bg);border:1px solid var(--border);border-radius:var(--rs);padding:0.8rem 1rem;color:var(--green);line-height:1.8;white-space:pre-wrap;word-break:break-all;}
.info-box{background:var(--bg2);border:1px solid var(--border);border-radius:var(--rs);padding:0.7rem 0.85rem;font-size:0.78rem;color:var(--muted);line-height:1.6;margin-bottom:0.9rem;}
.zone-card{background:var(--bg2);border:1px solid var(--border);border-radius:var(--rs);padding:0.75rem 0.85rem;display:flex;align-items:center;gap:10px;margin-bottom:7px;}

/* ── MODAL ── */
.modal-overlay{position:fixed;inset:0;background:rgba(5,10,22,0.88);z-index:500;display:none;align-items:center;justify-content:center;padding:1rem;}
.modal-overlay.show{display:flex;}
.modal{background:var(--bg1);border:1px solid var(--border);border-radius:var(--r);padding:1.75rem;width:100%;max-width:480px;position:relative;animation:fadeIn 0.2s ease;max-height:90vh;overflow-y:auto;}
.modal-title{font-family:var(--mono);font-size:0.95rem;color:var(--cyan);margin-bottom:1rem;}
.modal-close{position:absolute;top:1rem;right:1rem;background:none;border:none;color:var(--muted);cursor:pointer;font-size:18px;line-height:1;}
.modal-close:hover{color:var(--red);}

/* ── NOTIF ── */
.notif{position:fixed;top:1rem;right:1rem;background:var(--bg2);border:1px solid var(--cyan);border-radius:var(--r);padding:0.7rem 1.1rem;font-size:0.82rem;color:var(--cyan);z-index:999;display:flex;align-items:center;gap:8px;transform:translateX(calc(100% + 1rem));transition:transform 0.3s cubic-bezier(.34,1.56,.64,1);max-width:320px;box-shadow:0 4px 20px rgba(0,229,255,0.15);}
.notif.show{transform:translateX(0);}
.notif.err{border-color:var(--red);color:var(--red);}
.notif.success{border-color:var(--green);color:var(--green);}

/* ── MISC ── */
.spinner{width:15px;height:15px;border:2px solid rgba(255,255,255,0.2);border-top-color:#fff;border-radius:50%;animation:spin 0.7s linear infinite;}
@keyframes spin{to{transform:rotate(360deg);}}
.font-mono{font-family:var(--mono);}
.text-cyan{color:var(--cyan);}
.text-green{color:var(--green);}
.text-red{color:var(--red);}
.text-amber{color:var(--amber);}
.text-muted{color:var(--muted);}
.divider{border:none;border-top:1px solid var(--border);margin:1rem 0;}
.mb-4{margin-bottom:1rem;}.mb-6{margin-bottom:1.5rem;}
.flex-between{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;}
::-webkit-scrollbar{width:5px;}
::-webkit-scrollbar-track{background:var(--bg);}
::-webkit-scrollbar-thumb{background:var(--dim);border-radius:3px;}

/* ══════════════════════════════════════════
   WHATSAPP-STYLE CHAT UI
══════════════════════════════════════════ */
.chat-container{display:flex;flex-direction:column;height:calc(100vh - var(--topbar-h) - 4rem);max-height:700px;}
.chat-header{display:flex;align-items:center;justify-content:space-between;padding:0.9rem 1.1rem;background:var(--bg1);border:1px solid var(--border);border-radius:var(--r) var(--r) 0 0;border-bottom:1px solid var(--border);}
.chat-header-left{display:flex;align-items:center;gap:10px;}
.chat-avatar{width:38px;height:38px;border-radius:50%;background:linear-gradient(135deg,var(--purple),var(--cyan));display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:700;color:#fff;flex-shrink:0;}
.chat-name{font-weight:600;font-size:0.92rem;}
.chat-status{font-size:0.7rem;color:var(--green);}
.chat-header-actions{display:flex;gap:8px;}
.chat-body{flex:1;overflow-y:auto;padding:1rem;background:var(--bg);border-left:1px solid var(--border);border-right:1px solid var(--border);display:flex;flex-direction:column;gap:6px;}
.chat-msg{display:flex;flex-direction:column;max-width:72%;animation:fadeIn 0.15s ease;}
.chat-msg.from-me{align-self:flex-end;align-items:flex-end;}
.chat-msg.from-them{align-self:flex-start;align-items:flex-start;}
.chat-bubble{padding:0.55rem 0.85rem;border-radius:12px;font-size:0.84rem;line-height:1.55;word-break:break-word;}
.from-me .chat-bubble{background:var(--purple);color:#fff;border-bottom-right-radius:3px;}
.from-them .chat-bubble{background:var(--bg2);color:var(--text);border-bottom-left-radius:3px;border:1px solid var(--border);}
.chat-time{font-size:0.63rem;color:var(--dim);margin-top:2px;font-family:var(--mono);}
.chat-sender{font-size:0.66rem;color:var(--muted);margin-bottom:2px;font-weight:600;}
.chat-footer{display:flex;gap:8px;padding:0.75rem;background:var(--bg1);border:1px solid var(--border);border-radius:0 0 var(--r) var(--r);border-top:1px solid var(--border);}
.chat-input{flex:1;padding:0.6rem 0.9rem;background:var(--bg2);border:1.5px solid var(--border);border-radius:20px;color:var(--text);font-family:var(--body);font-size:0.86rem;outline:none;transition:border-color 0.2s;resize:none;height:42px;max-height:120px;line-height:1.4;}
.chat-input:focus{border-color:var(--cyan);}
.chat-send-btn{width:42px;height:42px;border-radius:50%;background:var(--purple);border:none;color:#fff;font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all 0.15s;flex-shrink:0;}
.chat-send-btn:hover{background:var(--cyan);color:var(--bg);}
.chat-empty{text-align:center;padding:3rem 1rem;color:var(--muted);font-size:0.83rem;}
.chat-day-sep{text-align:center;font-size:0.65rem;color:var(--dim);font-family:var(--mono);margin:6px 0;}
.chat-read-tick{color:var(--cyan);font-size:0.65rem;margin-left:3px;}

/* Admin inbox list */
.chat-inbox{display:flex;flex-direction:column;gap:0;}
.inbox-item{display:flex;align-items:center;gap:11px;padding:0.85rem;cursor:pointer;border-bottom:1px solid rgba(0,229,255,0.05);transition:background 0.12s;}
.inbox-item:hover{background:var(--bg2);}
.inbox-item.active-chat{background:rgba(0,229,255,0.06);}
.inbox-av{width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,var(--purple),var(--cyan));display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:700;color:#fff;flex-shrink:0;}
.inbox-name{font-weight:600;font-size:0.88rem;}
.inbox-preview{font-size:0.75rem;color:var(--muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:200px;}
.inbox-time{font-size:0.63rem;color:var(--dim);font-family:var(--mono);white-space:nowrap;}
.inbox-unread{background:var(--red);color:#fff;font-size:0.6rem;font-weight:700;border-radius:50%;min-width:18px;height:18px;display:flex;align-items:center;justify-content:center;margin-left:auto;}

/* Chat layout for admin: inbox + conversation side by side */
.chat-admin-wrap{display:grid;grid-template-columns:260px 1fr;gap:0;height:calc(100vh - var(--topbar-h) - 6rem);max-height:680px;border:1px solid var(--border);border-radius:var(--r);overflow:hidden;}
.chat-inbox-panel{background:var(--bg1);border-right:1px solid var(--border);overflow-y:auto;}
.chat-inbox-hdr{padding:0.85rem 1rem;border-bottom:1px solid var(--border);font-family:var(--mono);font-size:0.82rem;color:var(--cyan);display:flex;align-items:center;justify-content:space-between;}
.chat-convo-panel{display:flex;flex-direction:column;background:var(--bg);}
.chat-convo-hdr{display:flex;align-items:center;justify-content:space-between;padding:0.75rem 1rem;background:var(--bg1);border-bottom:1px solid var(--border);}
.chat-convo-left{display:flex;align-items:center;gap:9px;}
.chat-convo-body{flex:1;overflow-y:auto;padding:1rem;display:flex;flex-direction:column;gap:6px;}
.chat-convo-footer{display:flex;gap:8px;padding:0.7rem;background:var(--bg1);border-top:1px solid var(--border);}

/* ── ADVANCED: Map Link Card ── */
.map-link-btn{display:inline-flex;align-items:center;gap:6px;padding:0.4rem 0.8rem;border-radius:var(--rs);background:rgba(0,229,255,0.08);border:1px solid rgba(0,229,255,0.15);color:var(--cyan);font-size:0.75rem;text-decoration:none;cursor:pointer;transition:all 0.15s;}
.map-link-btn:hover{background:rgba(0,229,255,0.14);}

/* ── MOBILE RESPONSIVE ── */
@media(max-width:768px){
  :root{--sidebar-w:260px;}
  .hamburger{display:flex;}
  .sidebar{transform:translateX(-100%);}
  .sidebar.open{transform:translateX(0);}
  .overlay.show{display:block;}
  .main{margin-left:0;padding:1rem;}
  .stat-grid{grid-template-columns:1fr 1fr;}
  .two-col,.three-col{grid-template-columns:1fr;}
  .notif{right:0.75rem;left:0.75rem;transform:translateY(-120%);top:0.75rem;max-width:none;}
  .notif.show{transform:translateY(0);}
  .chat-admin-wrap{grid-template-columns:1fr;}
  .chat-inbox-panel{display:none;}
  .chat-inbox-panel.mobile-show{display:block;position:fixed;inset:var(--topbar-h) 0 0 0;z-index:300;border-right:none;}
}
@media(max-width:480px){
  .stat-grid{grid-template-columns:1fr 1fr;}
  .stat-val{font-size:1.4rem;}
  .bat-ring-wrap{flex-direction:column;gap:12px;}
}
</style>
</head>
<body>

<div class="notif" id="notif"><span id="n-icon">✓</span><span id="n-msg"></span></div>
<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

<!-- ══ TOPBAR ══ -->
<div class="topbar">
  <div style="display:flex;align-items:center;gap:10px;">
    <button class="hamburger" onclick="toggleSidebar()">☰</button>
    <div class="topbar-brand">
      <span>🛰️</span>
      <span class="brand-text">TrackSphere</span>
      <div class="live-dot"></div>
    </div>
  </div>
  <div class="topbar-right">
    <span id="last-sync" style="font-size:0.72rem;color:var(--dim);display:none;"></span>
    <button class="topbar-msg-btn" id="msg-topbar-btn" onclick="goPage('messages')" title="Messages">
      💬 Messages
      <span class="msg-badge" id="msg-topbar-badge">0</span>
    </button>
    <div class="user-badge">
      <div class="user-avatar" id="topbar-av">??</div>
      <span id="topbar-name" style="font-size:0.82rem;">Loading...</span>
      <span class="tag t-purple" id="role-tag">USER</span>
    </div>
    <button class="btn-topbar" onclick="doLogout()">Sign Out</button>
  </div>
</div>

<!-- ══ APP BODY ══ -->
<div class="app">

  <!-- ── SIDEBAR ── -->
  <aside class="sidebar" id="sidebar">

    <!-- ADMIN NAV -->
    <div id="admin-nav" style="display:none;">
      <div class="nav-sec">Overview</div>
      <div class="nav-item active" onclick="goPage('dash')" id="nav-dash"><span class="nav-icon">📊</span><span class="nav-label">Dashboard</span></div>
      <div class="nav-sec">Tracking</div>
      <div class="nav-item" onclick="goPage('users')" id="nav-users"><span class="nav-icon">👥</span><span class="nav-label">Users</span><span class="nav-badge" id="users-badge">0</span></div>
      <div class="nav-item" onclick="goPage('devices')" id="nav-devices"><span class="nav-icon">📱</span><span class="nav-label">Live Devices</span></div>
      <div class="nav-item" onclick="goPage('history')" id="nav-history"><span class="nav-icon">📍</span><span class="nav-label">Location Log</span></div>
      <div class="nav-item" onclick="goPage('battery-log')" id="nav-battery-log"><span class="nav-icon">🔋</span><span class="nav-label">Battery Log</span></div>
      <div class="nav-sec">Alerts & Zones</div>
      <div class="nav-item" onclick="goPage('alerts')" id="nav-alerts"><span class="nav-icon">🔔</span><span class="nav-label">Alerts</span><span class="nav-badge red" id="alerts-badge">0</span></div>
      <div class="nav-item" onclick="goPage('geofence')" id="nav-geofence"><span class="nav-icon">🔲</span><span class="nav-label">Geofences</span></div>
      <div class="nav-sec">Communication</div>
      <div class="nav-item" onclick="goPage('messages')" id="nav-messages"><span class="nav-icon">💬</span><span class="nav-label">Messages</span><span class="nav-badge red" id="msg-badge-nav">0</span></div>
      <div class="nav-sec">Tools</div>
      <div class="nav-item" onclick="showModal('modal-invite')"><span class="nav-icon">📧</span><span class="nav-label">Invite User</span></div>
    </div>

    <!-- USER NAV -->
    <div id="user-nav" style="display:none;">
      <div class="nav-sec">My Device</div>
      <div class="nav-item active" onclick="goPage('my-device')" id="nav-my-device"><span class="nav-icon">📱</span><span class="nav-label">Device Status</span></div>
      <div class="nav-item" onclick="goPage('my-battery')" id="nav-my-battery"><span class="nav-icon">🔋</span><span class="nav-label">Live Battery</span></div>
      <div class="nav-item" onclick="goPage('my-history')" id="nav-my-history"><span class="nav-icon">📍</span><span class="nav-label">My History</span></div>
      <div class="nav-sec">Communication</div>
      <div class="nav-item" onclick="goPage('messages')" id="nav-messages-user"><span class="nav-icon">💬</span><span class="nav-label">Messages</span><span class="nav-badge red" id="msg-badge-nav-user">0</span></div>
      <div class="nav-sec">Account</div>
      <div class="nav-item" onclick="goPage('security')" id="nav-security"><span class="nav-icon">🔑</span><span class="nav-label">Security</span></div>
    </div>

    <div class="sidebar-footer">
      <div style="font-size:0.68rem;color:var(--dim);padding:0 0.6rem;">TrackSphere v3.0 · Secure</div>
    </div>
  </aside>

  <!-- ── MAIN CONTENT ── -->
  <main class="main" id="main">

    <!-- ===== ADMIN: DASHBOARD ===== -->
    <div class="page active" id="page-dash">
      <div class="page-hdr">
        <div><div class="page-title">Dashboard</div><div class="page-sub" id="dash-sub">Real-time overview</div></div>
        <div style="display:flex;gap:8px;flex-wrap:wrap;">
          <button class="btn btn-ghost" onclick="loadDashboard()">↻ Refresh</button>
          <button class="btn btn-primary" onclick="showModal('modal-invite')">📧 Invite User</button>
        </div>
      </div>

      <div class="stat-grid">
        <div class="stat-card sc1"><div class="stat-label">Total Users</div><div class="stat-val text-cyan" id="stat-users">—</div><div class="stat-sub" id="stat-users-sub">verified accounts</div><div class="stat-bg">👥</div></div>
        <div class="stat-card sc2"><div class="stat-label">Online Now</div><div class="stat-val" style="color:var(--purple);" id="stat-online">—</div><div class="stat-sub" id="stat-online-sub">last 15 min</div><div class="stat-bg">🟢</div></div>
        <div class="stat-card sc3"><div class="stat-label">Pings Today</div><div class="stat-val text-green" id="stat-pings">—</div><div class="stat-sub" id="stat-pings-sub">since midnight</div><div class="stat-bg">📡</div></div>
        <div class="stat-card sc4"><div class="stat-label">Unread Alerts</div><div class="stat-val text-amber" id="stat-alerts">—</div><div class="stat-sub" id="stat-alerts-sub">notifications</div><div class="stat-bg">🔔</div></div>
      </div>

      <div class="two-col">
        <div class="card">
          <div class="card-title">📡 Live Feed — Active Devices</div>
          <div id="live-feed-table"><div style="text-align:center;padding:2rem;color:var(--muted);font-size:0.82rem;">Loading...</div></div>
        </div>
        <div class="card">
          <div class="card-title">📈 Weekly Pings</div>
          <div id="weekly-chart">
            <div class="bar-row"><div class="bar-label">Mon</div><div class="bar-track"><div class="bar-fill" id="bar-mon" style="width:0%"></div></div><div class="bar-val" id="bv-mon">0</div></div>
            <div class="bar-row"><div class="bar-label">Tue</div><div class="bar-track"><div class="bar-fill" id="bar-tue" style="width:0%"></div></div><div class="bar-val" id="bv-tue">0</div></div>
            <div class="bar-row"><div class="bar-label">Wed</div><div class="bar-track"><div class="bar-fill" id="bar-wed" style="width:0%"></div></div><div class="bar-val" id="bv-wed">0</div></div>
            <div class="bar-row"><div class="bar-label">Thu</div><div class="bar-track"><div class="bar-fill" id="bar-thu" style="width:0%"></div></div><div class="bar-val" id="bv-thu">0</div></div>
            <div class="bar-row"><div class="bar-label">Fri</div><div class="bar-track"><div class="bar-fill" id="bar-fri" style="width:0%"></div></div><div class="bar-val" id="bv-fri">0</div></div>
            <div class="bar-row"><div class="bar-label">Sat</div><div class="bar-track"><div class="bar-fill" id="bar-sat" style="width:0%"></div></div><div class="bar-val" id="bv-sat">0</div></div>
            <div class="bar-row"><div class="bar-label">Sun</div><div class="bar-track"><div class="bar-fill" id="bar-sun" style="width:0%"></div></div><div class="bar-val" id="bv-sun">0</div></div>
          </div>
          <div style="margin-top:0.7rem;font-size:0.72rem;color:var(--muted);">Total this week: <span class="font-mono text-cyan" id="total-pings-week">0</span></div>
        </div>
      </div>
    </div>

    <!-- ===== ADMIN: USERS ===== -->
    <div class="page" id="page-users">
      <div class="page-hdr">
        <div><div class="page-title">Users</div><div class="page-sub">All registered &amp; verified users</div></div>
        <button class="btn btn-primary" onclick="showModal('modal-invite')">📧 Invite User</button>
      </div>
      <div class="card">
        <div class="table-wrap" id="users-table-wrap"><div style="text-align:center;padding:2rem;color:var(--muted);">Loading...</div></div>
      </div>
    </div>

    <!-- ===== ADMIN: LIVE DEVICES ===== -->
    <div class="page" id="page-devices">
      <div class="page-hdr">
        <div><div class="page-title">Live Devices</div><div class="page-sub">Active tracking devices</div></div>
        <button class="btn btn-ghost" onclick="loadUsers()">↻ Refresh</button>
      </div>
      <div class="card">
        <div class="table-wrap" id="devices-table-wrap"><div style="text-align:center;padding:2rem;color:var(--muted);">Loading...</div></div>
      </div>
    </div>

    <!-- ===== ADMIN: LOCATION LOG ===== -->
    <div class="page" id="page-history">
      <div class="page-hdr">
        <div><div class="page-title">Location Log</div><div class="page-sub">Last 1h — auto-purged every hour</div></div>
        <div style="display:flex;gap:8px;flex-wrap:wrap;">
          <select id="loc-user-filter" style="width:auto;" onchange="loadLocationLog()"><option value="">All Users</option></select>
          <button class="btn btn-ghost" onclick="exportCSV()">⬇ Export CSV</button>
        </div>
      </div>
      <div class="card">
        <div class="table-wrap" id="location-log-wrap"><div style="text-align:center;padding:2rem;color:var(--muted);">Loading...</div></div>
      </div>
    </div>

    <!-- ===== ADMIN: BATTERY LOG ===== -->
    <div class="page" id="page-battery-log">
      <div class="page-hdr">
        <div><div class="page-title">Battery Log</div><div class="page-sub">Device battery readings from pings</div></div>
        <select id="bat-log-user" style="width:auto;" onchange="loadBatteryLog()"><option value="">All Users</option></select>
      </div>
      <div class="card">
        <div class="table-wrap" id="battery-log-wrap"><div style="text-align:center;padding:2rem;color:var(--muted);">Loading...</div></div>
      </div>
    </div>

    <!-- ===== ADMIN: ALERTS ===== -->
    <div class="page" id="page-alerts">
      <div class="page-hdr">
        <div><div class="page-title">Alerts</div><div class="page-sub">Geofence breaches &amp; low battery</div></div>
        <button class="btn btn-amber" onclick="markAlertsRead()">✓ Mark All Read</button>
      </div>
      <div class="card" id="alerts-list"><div style="text-align:center;padding:2rem;color:var(--muted);">Loading...</div></div>
    </div>

    <!-- ===== ADMIN: GEOFENCES ===== -->
    <div class="page" id="page-geofence">
      <div class="page-hdr">
        <div><div class="page-title">Geofence Zones</div><div class="page-sub">Define boundary alert zones</div></div>
        <button class="btn btn-primary" onclick="showModal('modal-add-zone')">+ Add Zone</button>
      </div>
      <div class="card" id="geofence-list"><div style="text-align:center;padding:2rem;color:var(--muted);">Loading...</div></div>
    </div>

    <!-- ===== ADMIN: MESSAGES ===== -->
    <div class="page" id="page-messages">
      <div class="page-hdr">
        <div><div class="page-title">Messages</div><div class="page-sub" id="msg-page-sub">Admin ↔ User conversations</div></div>
        <div id="msg-admin-header-actions" style="display:flex;gap:8px;display:none;">
          <button class="btn btn-ghost btn-sm" onclick="loadAdminInbox()">↻ Refresh</button>
          <button class="btn btn-danger btn-sm" onclick="deleteAllMsgs()" title="Delete all messages in this conversation">🗑 Delete All</button>
        </div>
      </div>
      <!-- Admin: inbox + chat layout -->
      <div id="admin-chat-wrap" class="chat-admin-wrap" style="display:none;">
        <div class="chat-inbox-panel" id="chat-inbox-panel">
          <div class="chat-inbox-hdr">
            <span>💬 Conversations</span>
            <button class="btn-ghost btn-sm" onclick="loadAdminInbox()" style="font-size:0.7rem;padding:2px 6px;border-radius:4px;background:none;border:none;color:var(--muted);cursor:pointer;">↻</button>
          </div>
          <div class="chat-inbox" id="admin-inbox-list">
            <div style="text-align:center;padding:2rem;color:var(--muted);font-size:0.8rem;">Loading...</div>
          </div>
        </div>
        <div class="chat-convo-panel" id="chat-convo-panel">
          <div class="chat-convo-hdr">
            <div class="chat-convo-left">
              <div class="chat-avatar" id="chat-target-av">?</div>
              <div>
                <div class="chat-name" id="chat-target-name">Select a user</div>
                <div class="chat-status" id="chat-target-status">to start chatting</div>
              </div>
            </div>
            <button class="btn btn-danger btn-sm" onclick="deleteAllMsgs()" id="chat-delete-btn" style="display:none;">🗑 Delete All</button>
          </div>
          <div class="chat-convo-body" id="admin-chat-body">
            <div class="chat-empty">👈 Select a user from the list to view messages</div>
          </div>
          <div class="chat-convo-footer" id="admin-chat-footer">
            <textarea class="chat-input" id="admin-chat-input" placeholder="Type a message..." rows="1"
              onkeydown="if(event.key==='Enter'&&!event.shiftKey){event.preventDefault();sendAdminMsg();}"></textarea>
            <button class="chat-send-btn" onclick="sendAdminMsg()">➤</button>
          </div>
        </div>
      </div>

      <!-- User: single chat with admin -->
      <div id="user-chat-wrap" class="chat-container" style="display:none;">
        <div class="chat-header">
          <div class="chat-header-left">
            <div class="chat-avatar">🛡</div>
            <div>
              <div class="chat-name">Admin Support</div>
              <div class="chat-status">● Online</div>
            </div>
          </div>
          <div class="chat-header-actions">
            <button class="btn btn-ghost btn-sm" onclick="loadUserMessages()">↻</button>
            <button class="btn btn-danger btn-sm" onclick="deleteAllMsgs()">🗑 Delete All</button>
          </div>
        </div>
        <div class="chat-body" id="user-chat-body">
          <div class="chat-empty">No messages yet. Send one below!</div>
        </div>
        <div class="chat-footer">
          <textarea class="chat-input" id="user-chat-input" placeholder="Message admin..." rows="1"
            onkeydown="if(event.key==='Enter'&&!event.shiftKey){event.preventDefault();sendUserMsg();}"></textarea>
          <button class="chat-send-btn" onclick="sendUserMsg()">➤</button>
        </div>
      </div>
    </div>

    <!-- ===== USER: MY DEVICE ===== -->
    <div class="page" id="page-my-device">
      <div class="page-hdr">
        <div><div class="page-title">My Device Status</div><div class="page-sub" id="my-device-sub">GPS + Battery tracking</div></div>
        <button class="btn btn-cyan" onclick="manualPing()" id="ping-btn">📡 Ping Now</button>
      </div>

      <div id="my-tracking-banner" class="track-banner" style="display:none;">
        <div class="track-pulse"></div>
        <div id="user-track-msg"><strong style="color:var(--green);">Tracking Active</strong> — GPS every 10 min</div>
        <div style="margin-left:auto;"><button class="btn btn-danger btn-sm" onclick="stopTracking()">⏹ Stop</button></div>
      </div>

      <div class="three-col mb-6">
        <div class="coords-card"><div class="coords-label">📍 Latitude</div><div class="coords-value" id="my-lat">—</div><div class="coords-sub" id="my-lat-sub">Awaiting GPS</div></div>
        <div class="coords-card"><div class="coords-label">📍 Longitude</div><div class="coords-value" id="my-lng">—</div><div class="coords-sub" id="my-lng-sub">Awaiting GPS</div></div>
        <div class="coords-card"><div class="coords-label">🎯 Accuracy</div><div class="coords-value" id="my-acc" style="font-size:1.35rem;">—</div><div class="coords-sub" id="my-acc-sub">GPS precision</div></div>
      </div>

      <div class="two-col">
        <div class="card">
          <div class="card-title">📊 Device Info</div>
          <table class="data-table">
            <tr><td class="text-muted">Name</td><td id="di-name" class="font-mono" style="font-size:0.8rem;">—</td></tr>
            <tr><td class="text-muted">Device ID</td><td id="di-id" class="font-mono text-cyan" style="font-size:0.72rem;">—</td></tr>
            <tr><td class="text-muted">Battery</td><td id="di-bat">—</td></tr>
            <tr><td class="text-muted">Charging</td><td id="di-charging">—</td></tr>
            <tr><td class="text-muted">Last Ping</td><td id="di-lastseen">—</td></tr>
            <tr><td class="text-muted">Ping Count</td><td id="di-pings" class="font-mono">0</td></tr>
            <tr><td class="text-muted">Next Ping</td><td id="di-next" class="font-mono text-cyan" style="font-size:0.82rem;">—</td></tr>
          </table>
        </div>
        <div class="card">
          <div class="card-title">📡 Last Ping Data</div>
          <div class="code-block" id="my-raw-json">{ "status": "waiting_for_first_ping" }</div>
          <div style="margin-top:0.75rem;">
            <a id="open-maps-btn" href="#" target="_blank" class="map-link-btn" style="display:none;">🗺 Open in Google Maps</a>
          </div>
        </div>
      </div>
    </div>

    <!-- ===== USER: LIVE BATTERY ===== -->
    <div class="page" id="page-my-battery">
      <div class="page-hdr">
        <div><div class="page-title">Live Battery Status</div><div class="page-sub">Real-time from device Battery API</div></div>
        <button class="btn btn-ghost" onclick="refreshBattery()">↻ Refresh</button>
      </div>

      <div id="bat-no-support" class="card" style="display:none;">
        <div style="text-align:center;padding:2rem;">
          <div style="font-size:2rem;margin-bottom:0.75rem;">⚠️</div>
          <div style="font-family:var(--mono);color:var(--amber);margin-bottom:0.5rem;">Battery Status API Not Supported</div>
          <div style="font-size:0.82rem;color:var(--muted);line-height:1.7;max-width:380px;margin:0 auto;">
            Your browser does not support the Battery Status API.<br>
            For real battery data use <strong style="color:var(--cyan)">Chrome on Android</strong>.<br><br>
            Battery data recorded at your last ping: <strong id="bat-last-ping-val" class="font-mono text-cyan">—</strong>
          </div>
        </div>
      </div>

      <div id="bat-support-wrap">
        <div class="two-col">
          <div class="card">
            <div class="card-title">🔋 Battery Level</div>
            <div class="bat-ring-wrap">
              <div style="position:relative;width:110px;height:110px;flex-shrink:0;">
                <svg width="110" height="110" viewBox="0 0 110 110">
                  <circle cx="55" cy="55" r="46" fill="none" stroke="var(--bg2)" stroke-width="9"/>
                  <circle id="bat-ring" cx="55" cy="55" r="46" fill="none" stroke="var(--green)" stroke-width="9"
                    stroke-dasharray="289" stroke-dashoffset="289" stroke-linecap="round"
                    transform="rotate(-90 55 55)" style="transition:stroke-dashoffset 0.8s ease,stroke 0.4s;"/>
                </svg>
                <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;flex-direction:column;">
                  <div id="bat-pct-big" style="font-family:var(--mono);font-size:1.6rem;font-weight:700;line-height:1;color:var(--green);">—</div>
                  <div style="font-size:0.58rem;color:var(--muted);letter-spacing:1px;">BATT</div>
                </div>
              </div>
              <div class="bat-ring-info">
                <div class="bat-info-row"><div class="bat-info-label">Status</div><div class="bat-info-val" id="bat-status">Checking…</div></div>
                <div class="bat-info-row"><div class="bat-info-label">Charging</div><div class="bat-info-val" id="bat-charging">—</div></div>
                <div class="bat-info-row"><div class="bat-info-label">Time Left</div><div class="bat-info-val font-mono" id="bat-timeleft">—</div></div>
              </div>
            </div>
            <div class="bat-wrap" style="height:12px;margin-bottom:0.5rem;border-radius:6px;">
              <div class="bat-bar bat-hi" id="bat-bar-big" style="width:0%;border-radius:6px;"></div>
            </div>
            <div style="font-size:0.73rem;color:var(--muted);text-align:center;margin-top:4px;">Last updated: <span id="bat-updated" class="font-mono">—</span></div>
          </div>
          <div class="card">
            <div class="card-title">📋 Battery Details</div>
            <table class="data-table">
              <tr><td class="text-muted">Level</td><td><span id="bat-level-raw" class="font-mono text-cyan">—</span></td></tr>
              <tr><td class="text-muted">Charging?</td><td id="bat-charging-raw">—</td></tr>
              <tr><td class="text-muted">Time to Full</td><td><span id="bat-chargingtime" class="font-mono">—</span></td></tr>
              <tr><td class="text-muted">Time Remaining</td><td><span id="bat-dischargingtime" class="font-mono">—</span></td></tr>
              <tr><td class="text-muted">API Support</td><td id="bat-api-support">Checking…</td></tr>
            </table>
            <div class="divider"></div>
            <div class="info-box">
              🔋 Battery data is read from your device's <strong>Battery Status API</strong> and sent with every GPS ping.
              Supported natively on <strong>Chrome/Android</strong>.
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ===== USER: MY HISTORY ===== -->
    <div class="page" id="page-my-history">
      <div class="page-hdr">
        <div><div class="page-title">My Location History</div><div class="page-sub">GPS pings this session</div></div>
        <button class="btn btn-ghost" onclick="clearMyHistory()">🗑 Clear</button>
      </div>
      <div class="card"><div class="timeline" id="my-timeline"><div style="text-align:center;padding:2rem;color:var(--muted);font-size:0.82rem;" data-empty>No history yet.</div></div></div>
    </div>

    <!-- ===== USER: SECURITY ===== -->
    <div class="page" id="page-security">
      <div class="page-hdr"><div><div class="page-title">Security</div><div class="page-sub">Session &amp; account info</div></div></div>
      <div class="two-col">
        <div class="card">
          <div class="card-title">🔑 Session Info</div>
          <table class="data-table">
            <tr><td class="text-muted">User</td><td id="sec-user">—</td></tr>
            <tr><td class="text-muted">Email</td><td id="sec-email" style="font-size:0.78rem;">—</td></tr>
            <tr><td class="text-muted">Role</td><td id="sec-role">—</td></tr>
            <tr><td class="text-muted">Login Time</td><td id="sec-login-time" class="font-mono" style="font-size:0.78rem;">—</td></tr>
            <tr><td class="text-muted">Token</td><td id="sec-token" class="font-mono text-cyan" style="font-size:0.65rem;word-break:break-all;">—</td></tr>
          </table>
        </div>
        <div class="card">
          <div class="card-title">🛡 Privacy</div>
          <div class="info-box">
            Tracking starts only after verification + GPS permission. Location data auto-purges from server <strong>every 1 hour</strong>.
          </div>
          <div style="display:flex;gap:8px;flex-direction:column;">
            <button class="btn btn-ghost" onclick="doLogout()">🚪 Sign Out</button>
            <button class="btn btn-danger" onclick="notif('Contact admin for full data deletion','⚠️','err')">🗑 Request Data Deletion</button>
          </div>
        </div>
      </div>
    </div>

  </main>
</div>

<!-- ══ MODAL: INVITE USER ══ -->
<div class="modal-overlay" id="modal-invite">
  <div class="modal">
    <div class="modal-title">📧 Invite User — Set Credentials</div>
    <button class="modal-close" onclick="hideModal('modal-invite')">✕</button>
    <div class="info-box">The email will include the user's password + verification link so they can log in immediately after verifying.</div>
    <div class="fg"><label>Full Name</label><input type="text" id="inv-name" placeholder="User's full name"></div>
    <div class="fg"><label>Email Address</label><input type="email" id="inv-email" placeholder="user@example.com"></div>
    <div class="fg"><label>Device Name</label><input type="text" id="inv-device" placeholder="e.g. iPhone 14 / OnePlus 12"></div>
    <div class="fg"><label>Set Password (for the user)</label><input type="text" id="inv-password" placeholder="Min 8 characters — will be emailed to user"></div>
    <div style="display:flex;gap:8px;margin-top:1rem;flex-wrap:wrap;">
      <button class="btn btn-primary" id="inv-btn" onclick="sendInvite()">📤 Create &amp; Send Invite</button>
      <button class="btn btn-ghost" onclick="hideModal('modal-invite')">Cancel</button>
    </div>
  </div>
</div>

<!-- ══ MODAL: ADD ZONE ══ -->
<div class="modal-overlay" id="modal-add-zone">
  <div class="modal">
    <div class="modal-title">🔲 Add Geofence Zone</div>
    <button class="modal-close" onclick="hideModal('modal-add-zone')">✕</button>
    <div class="fg"><label>Zone Name</label><input type="text" id="z-name" placeholder="e.g. School, Office, Home"></div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
      <div class="fg"><label>Latitude</label><input type="number" id="z-lat" placeholder="13.082710" step="0.000001"></div>
      <div class="fg"><label>Longitude</label><input type="number" id="z-lng" placeholder="80.270718" step="0.000001"></div>
    </div>
    <div class="fg"><label>Radius (metres)</label><input type="number" id="z-radius" value="200" min="50" max="50000"></div>
    <div class="fg"><label>Alert Email</label><input type="email" id="z-alert-email" placeholder="alert@yourdomain.com"></div>
    <div style="display:flex;gap:8px;margin-top:1rem;flex-wrap:wrap;">
      <button class="btn btn-primary" onclick="addZone()">✓ Add Zone</button>
      <button class="btn btn-ghost" onclick="hideModal('modal-add-zone')">Cancel</button>
    </div>
  </div>
</div>

<script>
// ══════════════════════════════════════════════
//  EmailJS
// ══════════════════════════════════════════════
emailjs.init('StWumdfQwaVRhi7Fj');
const EJS_SERVICE  = 'service_wim5nqd';
const EJS_TEMPLATE = 'template_e7pd3z1';

// ══════════════════════════════════════════════
//  API endpoints
// ══════════════════════════════════════════════
const API = {
  adminAuth: 'api/admin_auth.php',
  userAuth:  'api/user_auth.php',
  ping:      'api/ping.php',
  adminData: 'api/admin_data.php',
  messages:  'api/messages.php',
};

// ══════════════════════════════════════════════
//  State
// ══════════════════════════════════════════════
const S = {
  role: null, token: null, user: null,
  loginTime: new Date(),
  trackTimer: null, nextPingTime: null, pingCount: 0,
  localHistory: [], intervalMs: 600000,
  batteryObj: null, lastBattery: null,
  // Chat state
  activeChatUserId: null, activeChatUserName: '',
  msgPollTimer: null,
};

// ══════════════════════════════════════════════
//  Bootstrap
// ══════════════════════════════════════════════
(function init() {
  const token = sessionStorage.getItem('ts_token');
  const role  = sessionStorage.getItem('ts_role');
  const user  = sessionStorage.getItem('ts_user');

  if (!token || !role || !user) { location.href = 'login.php'; return; }

  S.token = token;
  S.role  = role;
  S.user  = JSON.parse(user);

  setupShell();

  if (role === 'user') {
    initBattery();
    startTracking();
    pollMsgBadge();
    setInterval(pollMsgBadge, 30000);
  } else {
    loadDashboard();
    setInterval(loadDashboard, 60000);
    pollMsgBadge();
    setInterval(pollMsgBadge, 20000);
  }
})();

// ══════════════════════════════════════════════
//  API helper
// ══════════════════════════════════════════════
async function api(url, method = 'GET', body = null) {
  const opts = { method, headers: { 'Content-Type': 'application/json', 'X-Session-Token': S.token } };
  if (body) opts.body = JSON.stringify(body);
  const res  = await fetch(url, opts);
  const json = await res.json();
  if (!json.ok) throw new Error(json.error || 'API error');
  return json;
}

// ══════════════════════════════════════════════
//  Shell Setup
// ══════════════════════════════════════════════
function setupShell() {
  const u = S.user;
  const isAdmin = S.role === 'admin';

  g('topbar-av').textContent   = (u.name || '??').split(' ').map(w => w[0]).join('').toUpperCase().substr(0, 2);
  g('topbar-name').textContent = u.name || 'User';
  g('role-tag').textContent    = isAdmin ? 'ADMIN' : 'USER';
  g('role-tag').className      = 'tag ' + (isAdmin ? 't-cyan' : 't-purple');
  g('last-sync').style.display = 'block';

  g('admin-nav').style.display = isAdmin ? 'block' : 'none';
  g('user-nav').style.display  = isAdmin ? 'none' : 'block';

  g('sec-user').textContent       = u.name || '—';
  g('sec-email').textContent      = u.email || '—';
  g('sec-role').innerHTML         = `<span class="tag ${isAdmin ? 't-cyan' : 't-purple'}">${S.role.toUpperCase()}</span>`;
  g('sec-login-time').textContent = S.loginTime.toLocaleString();
  g('sec-token').textContent      = S.token;

  if (!isAdmin && u.device_name) {
    g('di-name').textContent = u.device_name;
    g('di-id').textContent   = u.device_id || '—';
  }

  // Show battery last ping value if stored
  if (!isAdmin && u.last_battery != null) {
    const lb = g('bat-last-ping-val');
    if (lb) lb.textContent = u.last_battery + '%';
  }

  goPage(isAdmin ? 'dash' : 'my-device');
}

// ══════════════════════════════════════════════
//  Navigation
// ══════════════════════════════════════════════
function goPage(page) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  const el = g('page-' + page);
  if (el) el.classList.add('active');
  document.querySelectorAll('.nav-item').forEach(n =>
    n.classList.toggle('active', n.id === 'nav-' + page || n.id === 'nav-' + page + '-user')
  );
  closeSidebar();

  if (S.role === 'admin') {
    if (page === 'dash')        loadDashboard();
    if (page === 'users')       loadUsers();
    if (page === 'devices')     loadUsers();
    if (page === 'history')     loadLocationLog();
    if (page === 'battery-log') loadBatteryLog();
    if (page === 'alerts')      loadAlerts();
    if (page === 'geofence')    loadGeofences();
    if (page === 'messages')    initAdminChat();
  } else {
    if (page === 'messages')    initUserChat();
  }
}

function toggleSidebar() {
  g('sidebar').classList.toggle('open');
  g('overlay').classList.toggle('show');
}
function closeSidebar() {
  g('sidebar').classList.remove('open');
  g('overlay').classList.remove('show');
}

// ══════════════════════════════════════════════
//  LOGOUT
// ══════════════════════════════════════════════
async function doLogout() {
  stopTracking();
  clearInterval(S.msgPollTimer);
  try {
    const ep = S.role === 'admin' ? API.adminAuth : API.userAuth;
    await api(ep + '?action=logout', 'POST');
  } catch (_) {}
  sessionStorage.clear();
  location.href = 'login.php';
}

// ══════════════════════════════════════════════
//  REAL BATTERY STATUS API
// ══════════════════════════════════════════════
function initBattery() {
  if (!('getBattery' in navigator)) {
    showBatteryUnsupported();
    return;
  }
  navigator.getBattery().then(b => {
    S.batteryObj = b;
    applyBatteryUI(b);
    ['levelchange', 'chargingchange', 'chargingtimechange', 'dischargingtimechange']
      .forEach(ev => b.addEventListener(ev, () => applyBatteryUI(b)));
    const supEl = g('bat-api-support');
    if (supEl) supEl.innerHTML = '<span style="color:var(--green)">✓ Supported</span>';
  }).catch(e => {
    showBatteryUnsupported();
    const supEl = g('bat-api-support');
    if (supEl) supEl.innerHTML = `<span style="color:var(--red)">Error: ${e.message}</span>`;
  });
}

function showBatteryUnsupported() {
  const noSup = g('bat-no-support');
  const supWrap = g('bat-support-wrap');
  if (noSup)   noSup.style.display   = 'block';
  if (supWrap) supWrap.style.display = 'none';
  // Still update device info panel from server data
  const u = S.user;
  if (u && u.last_battery != null) {
    const diEl = g('di-bat');
    if (diEl) diEl.innerHTML = batBadge(u.last_battery) + ' <span style="color:var(--muted);font-size:0.7rem;">(last ping)</span>';
  }
}

function refreshBattery() {
  if (S.batteryObj) {
    applyBatteryUI(S.batteryObj);
    notif('Battery refreshed','🔋','success');
  } else {
    initBattery();
  }
}

function applyBatteryUI(b) {
  const pct   = Math.round(b.level * 100);
  const color = pct > 50 ? 'var(--green)' : pct > 20 ? 'var(--amber)' : 'var(--red)';
  const cls   = pct > 50 ? 'bat-hi' : pct > 20 ? 'bat-mid' : 'bat-lo';
  S.lastBattery = pct;

  // SVG ring — 2π×46 ≈ 289
  const ring = g('bat-ring');
  if (ring) {
    ring.style.strokeDashoffset = 289 - (289 * pct / 100);
    ring.style.stroke = color;
  }
  const bigPct = g('bat-pct-big');
  if (bigPct) { bigPct.textContent = pct + '%'; bigPct.style.color = color; }

  const bigBar = g('bat-bar-big');
  if (bigBar) { bigBar.style.width = pct + '%'; bigBar.className = 'bat-bar ' + cls; }

  const stEl = g('bat-status');
  if (stEl) {
    if (b.charging && pct < 100) stEl.innerHTML = `<span style="color:var(--amber)">⚡ Charging</span>`;
    else if (pct === 100)        stEl.innerHTML = `<span style="color:var(--green)">✅ Full</span>`;
    else if (pct <= 10)          stEl.innerHTML = `<span style="color:var(--red)">🚨 Critical</span>`;
    else if (pct <= 20)          stEl.innerHTML = `<span style="color:var(--red)">⚠️ Low</span>`;
    else                         stEl.innerHTML = `<span style="color:var(--green)">🔋 Normal</span>`;
  }

  const chEl = g('bat-charging');
  if (chEl) chEl.innerHTML = b.charging
    ? '<span style="color:var(--amber)">⚡ Yes</span>' : '<span style="color:var(--muted)">No</span>';

  const tlEl = g('bat-timeleft');
  if (tlEl) tlEl.textContent = b.charging
    ? fmtSec(b.chargingTime) + ' to full' : fmtSec(b.dischargingTime) + ' remaining';

  setText('bat-level-raw', (b.level * 100).toFixed(1) + '% (raw: ' + b.level + ')');
  setText('bat-charging-raw', b.charging ? 'true ⚡' : 'false');
  setText('bat-chargingtime', b.chargingTime === Infinity ? '∞ / N/A' : fmtSec(b.chargingTime));
  setText('bat-dischargingtime', b.dischargingTime === Infinity ? '∞ / N/A' : fmtSec(b.dischargingTime));
  setText('bat-updated', new Date().toLocaleTimeString());

  const diEl = g('di-bat');
  if (diEl) diEl.innerHTML = `<span style="color:${color};font-family:var(--mono);font-weight:700;">${pct}%</span>`;
  const chgEl = g('di-charging');
  if (chgEl) chgEl.innerHTML = b.charging
    ? '<span style="color:var(--amber)">⚡ Yes</span>' : '<span style="color:var(--muted)">No</span>';
}

function getBatteryPayload() {
  const b = S.batteryObj;
  if (!b) return {};
  return {
    battery_pct      : Math.round(b.level * 100),
    is_charging      : b.charging ? 1 : 0,
    charging_time    : b.chargingTime === Infinity ? null : Math.round(b.chargingTime),
    discharging_time : b.dischargingTime === Infinity ? null : Math.round(b.dischargingTime),
  };
}

// ══════════════════════════════════════════════
//  TRACKING
// ══════════════════════════════════════════════
function startTracking() {
  if (!navigator.geolocation) { notif('Geolocation not supported','❌','err'); return; }
  const banner = g('my-tracking-banner');
  if (banner) banner.style.display = 'flex';
  doPing();
  scheduleNextPing();
}

function scheduleNextPing() {
  clearInterval(S.trackTimer);
  S.nextPingTime = Date.now() + S.intervalMs;
  S.trackTimer = setInterval(() => {
    doPing();
    S.nextPingTime = Date.now() + S.intervalMs;
  }, S.intervalMs);
}

function stopTracking() {
  clearInterval(S.trackTimer);
  S.trackTimer = null;
  const banner = g('my-tracking-banner');
  if (banner) banner.style.display = 'none';
}

function manualPing() { notif('Manual ping requested…','📡'); doPing(); }

function doPing() {
  navigator.geolocation.getCurrentPosition(onGPS, onGPSErr, { enableHighAccuracy: true, timeout: 15000, maximumAge: 0 });
}

async function onGPS(pos) {
  const lat = pos.coords.latitude;
  const lng = pos.coords.longitude;
  const acc = pos.coords.accuracy;
  const ts  = new Date();
  S.pingCount++;

  const batPayload = getBatteryPayload();
  const payload = {
    lat, lng,
    accuracy    : acc,
    altitude    : pos.coords.altitude,
    speed       : pos.coords.speed,
    heading     : pos.coords.heading,
    network_type: navigator.connection?.effectiveType || 'unknown',
    ...batPayload,
  };

  setText('my-lat', lat.toFixed(7));
  setText('my-lng', lng.toFixed(7));
  setText('my-acc', '±' + Math.round(acc) + 'm');
  setText('my-lat-sub', 'degrees N');
  setText('my-lng-sub', 'degrees E');
  setText('my-acc-sub', acc < 20 ? '✅ High precision' : acc < 50 ? '⚠️ Moderate' : '❌ Low precision');
  setText('my-device-sub', 'Last ping: ' + ts.toLocaleTimeString());
  setText('di-lastseen', 'Just now');
  setText('di-pings', S.pingCount);
  setText('last-sync', 'Sync: ' + ts.toLocaleTimeString());

  const rawEl = g('my-raw-json');
  if (rawEl) rawEl.textContent = JSON.stringify(
    { device_id: S.user?.device_id, lat: +lat.toFixed(7), lng: +lng.toFixed(7), accuracy_m: Math.round(acc), ...batPayload, ts: ts.toISOString() },
    null, 2
  );

  // Show Google Maps link
  const mapsBtn = g('open-maps-btn');
  if (mapsBtn) {
    mapsBtn.href = `https://maps.google.com/?q=${lat.toFixed(7)},${lng.toFixed(7)}`;
    mapsBtn.style.display = 'inline-flex';
  }

  addHistoryItem({ lat, lng, acc, ts, battery: batPayload.battery_pct });
  notif('📍 Location updated', '✅', 'success');

  try {
    const res = await api(API.ping, 'POST', payload);
    console.log('[ping ok]', res);
  } catch (e) {
    console.warn('[ping failed]', e.message);
    notif('Ping failed: ' + e.message, '❌', 'err');
  }
}

function onGPSErr(err) {
  const msgs = { 1: 'GPS access denied — allow location permission', 2: 'Position unavailable', 3: 'GPS timeout' };
  notif(msgs[err.code] || 'GPS error', '❌', 'err');
}

function addHistoryItem(r) {
  S.localHistory.unshift(r);
  if (S.localHistory.length > 144) S.localHistory.pop();
  const tl = g('my-timeline');
  if (!tl) return;
  if (tl.querySelector('[data-empty]')) tl.innerHTML = '';
  const item = document.createElement('div');
  item.className = 'tl-item';
  item.innerHTML = `
    <div class="tl-dot"></div>
    <div class="tl-time">${r.ts.toLocaleString()}</div>
    <div class="tl-loc">${S.user?.device_name || 'Unknown Device'}</div>
    <div class="tl-coords">${r.lat.toFixed(7)}° N, ${r.lng.toFixed(7)}° E</div>
    <div class="tl-meta">
      Accuracy: ±${Math.round(r.acc)}m
      ${r.battery != null ? ' · 🔋 ' + r.battery + '%' : ''}
      · <a href="https://maps.google.com/?q=${r.lat.toFixed(7)},${r.lng.toFixed(7)}" target="_blank" class="map-link-btn" style="font-size:0.65rem;padding:1px 5px;">🗺 Map</a>
    </div>
  `;
  tl.insertBefore(item, tl.firstChild);
}

function clearMyHistory() {
  S.localHistory = [];
  const tl = g('my-timeline');
  if (tl) tl.innerHTML = '<div data-empty style="text-align:center;padding:2rem;color:var(--muted);">No history yet.</div>';
  notif('History cleared', '🗑');
}

// Countdown timer
setInterval(() => {
  if (S.trackTimer && S.nextPingTime && S.role === 'user') {
    const diff = Math.max(0, S.nextPingTime - Date.now());
    const mm = String(Math.floor(diff / 60000)).padStart(2, '0');
    const ss = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
    setText('di-next', mm + ':' + ss);
  }
}, 1000);

// ══════════════════════════════════════════════
//  ADMIN: Dashboard
// ══════════════════════════════════════════════
async function loadDashboard() {
  if (S.role !== 'admin') return;
  try {
    const data = await api(API.adminData + '?action=dashboard');
    const s = data.stats;
    setText('stat-users',      s.total_users);
    setText('stat-online',     s.online_now);
    setText('stat-pings',      s.pings_today);
    setText('stat-alerts',     s.unread_alerts);
    setText('stat-users-sub',  s.online_now + ' online now');
    setText('stat-online-sub', (s.total_users > 0 ? Math.round(s.online_now / s.total_users * 100) : 0) + '% active');
    setText('stat-pings-sub',  'Since midnight');
    setText('stat-alerts-sub', s.unread_alerts > 0 ? s.unread_alerts + ' unread' : 'All clear');
    setText('alerts-badge',    s.unread_alerts);
    setText('users-badge',     s.total_users);
    setText('dash-sub',        'Last refresh: ' + new Date().toLocaleTimeString());
    renderLiveFeed(data.live_users);
    const dayKeys = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
    const counts  = {};
    data.weekly.forEach(w => {
      const d = new Date(w.day);
      counts[['Sun','Mon','Tue','Wed','Thu','Fri','Sat'][d.getDay()]] = parseInt(w.cnt);
    });
    const max = Math.max(...Object.values(counts), 1);
    let total = 0;
    dayKeys.forEach(d => {
      const v = counts[d] || 0; total += v;
      const fill = g('bar-' + d.toLowerCase());
      if (fill) fill.style.width = Math.round(v / max * 100) + '%';
      setText('bv-' + d.toLowerCase(), v);
    });
    setText('total-pings-week', total);
  } catch (e) { console.warn('Dashboard error:', e.message); }
}

function renderLiveFeed(users) {
  const el = g('live-feed-table');
  if (!el) return;
  if (!users?.length) {
    el.innerHTML = '<div style="text-align:center;padding:2rem;color:var(--muted);font-size:0.82rem;">No registered devices yet.</div>';
    return;
  }
  const isOnline = u => u.tracking_active && u.last_seen && (new Date() - new Date(u.last_seen)) < 15 * 60000;
  el.innerHTML = `<div class="table-wrap"><table class="data-table">
    <thead><tr><th>User</th><th>Status</th><th>Latitude</th><th>Longitude</th><th>Battery</th><th>Last Seen</th><th>Map</th></tr></thead>
    <tbody>${users.map(u => `<tr>
      <td>${escHtml(u.name)}</td>
      <td>${isOnline(u) ? '<span class="badge b-online">● Live</span>' : '<span class="badge b-offline">Offline</span>'}</td>
      <td><span class="font-mono" style="font-size:0.78rem;color:var(--cyan);">${u.last_lat ? parseFloat(u.last_lat).toFixed(6) + '°' : '—'}</span></td>
      <td><span class="font-mono" style="font-size:0.78rem;color:var(--cyan);">${u.last_lng ? parseFloat(u.last_lng).toFixed(6) + '°' : '—'}</span></td>
      <td>${u.last_battery != null ? batBadge(u.last_battery) : '—'}</td>
      <td style="font-size:0.73rem;color:var(--muted);">${u.last_seen ? new Date(u.last_seen).toLocaleTimeString() : 'Never'}</td>
      <td>${u.last_lat && u.last_lng ? `<a href="https://maps.google.com/?q=${u.last_lat},${u.last_lng}" target="_blank" class="map-link-btn">🗺</a>` : '—'}</td>
    </tr>`).join('')}</tbody>
  </table></div>`;
}

// ══════════════════════════════════════════════
//  ADMIN: Users
// ══════════════════════════════════════════════
async function loadUsers() {
  try {
    const data  = await api(API.adminData + '?action=users');
    const wrap  = g('users-table-wrap');
    const dWrap = g('devices-table-wrap');
    populateUserFilter(data.users);

    if (!data.users.length) {
      if (wrap)  wrap.innerHTML  = '<div style="text-align:center;padding:2rem;color:var(--muted);">No users yet. Invite one →</div>';
      if (dWrap) dWrap.innerHTML = '<div style="text-align:center;padding:2rem;color:var(--muted);">No active devices.</div>';
      return;
    }

    if (wrap) wrap.innerHTML = `<div class="table-wrap"><table class="data-table">
      <thead><tr><th>Name</th><th>Email</th><th>Device</th><th>Status</th><th>Battery</th><th>Last Seen</th><th>Actions</th></tr></thead>
      <tbody>${data.users.map(u => `<tr>
        <td>${escHtml(u.name)}</td>
        <td style="font-size:0.76rem;color:var(--muted);">${escHtml(u.email)}</td>
        <td><span class="font-mono" style="font-size:0.7rem;color:var(--cyan);">${escHtml(u.device_id || '—')}</span><br><span style="font-size:0.71rem;color:var(--muted);">${escHtml(u.device_name || '')}</span></td>
        <td>${u.is_verified ? '<span class="badge b-verified">✓ Verified</span>' : '<span class="badge b-pending">⏳ Pending</span>'}</td>
        <td>${u.last_battery != null ? batBadge(u.last_battery) : '—'}</td>
        <td style="font-size:0.73rem;color:var(--muted);">${u.last_seen ? new Date(u.last_seen).toLocaleString() : '—'}</td>
        <td style="display:flex;gap:5px;flex-wrap:wrap;">
          <button class="btn btn-ghost btn-sm" onclick="openAdminChatWith(${u.id},'${escHtml(u.name)}')">💬 Chat</button>
          <button class="btn btn-danger btn-sm" onclick="removeUser(${u.id})">Remove</button>
        </td>
      </tr>`).join('')}</tbody>
    </table></div>`;

    if (dWrap) {
      const active = data.users.filter(u => u.last_lat);
      dWrap.innerHTML = !active.length
        ? '<div style="text-align:center;padding:2rem;color:var(--muted);">No active devices with location data.</div>'
        : `<div class="table-wrap"><table class="data-table">
            <thead><tr><th>Device ID</th><th>User</th><th>Latitude</th><th>Longitude</th><th>Battery</th><th>Last Ping</th><th>Map</th></tr></thead>
            <tbody>${active.map(u => `<tr>
              <td class="font-mono" style="font-size:0.7rem;color:var(--cyan);">${escHtml(u.device_id)}</td>
              <td>${escHtml(u.name)}</td>
              <td class="font-mono" style="color:var(--green);font-size:0.82rem;">${parseFloat(u.last_lat).toFixed(7)}° N</td>
              <td class="font-mono" style="color:var(--green);font-size:0.82rem;">${parseFloat(u.last_lng).toFixed(7)}° E</td>
              <td>${u.last_battery != null ? batBadge(u.last_battery) : '—'}</td>
              <td style="font-size:0.73rem;color:var(--muted);">${u.last_seen ? new Date(u.last_seen).toLocaleTimeString() : '—'}</td>
              <td><a href="https://maps.google.com/?q=${u.last_lat},${u.last_lng}" target="_blank" class="map-link-btn">🗺 Open</a></td>
            </tr>`).join('')}</tbody>
          </table></div>`;
    }
  } catch (e) { notif('Failed to load users: ' + e.message, '❌', 'err'); }
}

function populateUserFilter(users) {
  ['loc-user-filter', 'bat-log-user'].forEach(id => {
    const sel = g(id);
    if (!sel) return;
    const cur = sel.value;
    sel.innerHTML = '<option value="">All Users</option>' + users.map(u => `<option value="${u.id}">${escHtml(u.name)}</option>`).join('');
    sel.value = cur;
  });
}

async function removeUser(id) {
  if (!confirm('Deactivate this user? They will no longer be able to log in.')) return;
  try {
    await api(API.adminData + '?action=remove_user&id=' + id, 'POST');
    notif('User deactivated', '✓', 'success');
    loadUsers();
  } catch (e) { notif(e.message, '❌', 'err'); }
}

// ══════════════════════════════════════════════
//  ADMIN: Location log
// ══════════════════════════════════════════════
async function loadLocationLog() {
  const uid  = g('loc-user-filter')?.value || '';
  const url  = API.adminData + '?action=location_log&limit=100' + (uid ? '&user_id=' + uid : '');
  const wrap = g('location-log-wrap');
  if (wrap) wrap.innerHTML = '<div style="text-align:center;padding:2rem;color:var(--muted);">Loading...</div>';
  try {
    const data = await api(url);
    if (!data.logs.length) {
      if (wrap) wrap.innerHTML = '<div style="text-align:center;padding:2rem;color:var(--muted);">No location data yet.</div>';
      return;
    }
    if (wrap) wrap.innerHTML = `<div class="table-wrap"><table class="data-table">
      <thead><tr><th>Time</th><th>User</th><th>Latitude</th><th>Longitude</th><th>Accuracy</th><th>Battery</th><th>Network</th><th>Map</th></tr></thead>
      <tbody>${data.logs.map(r => `<tr>
        <td class="font-mono" style="font-size:0.72rem;">${new Date(r.recorded_at).toLocaleString()}</td>
        <td>${escHtml(r.user_name || '—')}</td>
        <td class="font-mono" style="color:var(--cyan);font-size:0.78rem;">${parseFloat(r.latitude).toFixed(7)}</td>
        <td class="font-mono" style="color:var(--cyan);font-size:0.78rem;">${parseFloat(r.longitude).toFixed(7)}</td>
        <td style="font-size:0.78rem;">${r.accuracy_m ? '±' + Math.round(r.accuracy_m) + 'm' : '—'}</td>
        <td>${r.battery_pct != null ? batBadge(r.battery_pct) + (r.is_charging ? '<span style="color:var(--amber);margin-left:3px;">⚡</span>' : '') : '—'}</td>
        <td style="font-size:0.73rem;color:var(--muted);">${r.network_type || '—'}</td>
        <td><a href="https://maps.google.com/?q=${r.latitude},${r.longitude}" target="_blank" class="map-link-btn">🗺</a></td>
      </tr>`).join('')}</tbody>
    </table></div>`;
  } catch (e) { notif(e.message, '❌', 'err'); }
}

// ══════════════════════════════════════════════
//  ADMIN: Battery log
// ══════════════════════════════════════════════
async function loadBatteryLog() {
  const uid  = g('bat-log-user')?.value || '';
  const url  = API.adminData + '?action=battery_log&limit=100' + (uid ? '&user_id=' + uid : '');
  const wrap = g('battery-log-wrap');
  if (wrap) wrap.innerHTML = '<div style="text-align:center;padding:2rem;color:var(--muted);">Loading...</div>';
  try {
    const data = await api(url);
    if (!data.battery_logs.length) {
      if (wrap) wrap.innerHTML = '<div style="text-align:center;padding:2rem;color:var(--muted);">No battery data yet.</div>';
      return;
    }
    if (wrap) wrap.innerHTML = `<div class="table-wrap"><table class="data-table">
      <thead><tr><th>Time</th><th>User</th><th>Device</th><th>Battery %</th><th>Charging</th><th>Charge Time</th><th>Discharge Time</th></tr></thead>
      <tbody>${data.battery_logs.map(r => `<tr>
        <td class="font-mono" style="font-size:0.72rem;">${new Date(r.ping_time).toLocaleString()}</td>
        <td>${escHtml(r.user_name || '—')}</td>
        <td style="font-size:0.75rem;color:var(--muted);">${escHtml(r.device_name || '—')}</td>
        <td>${r.battery_pct != null ? batBadge(r.battery_pct) : '—'}</td>
        <td>${r.is_charging ? '<span style="color:var(--amber)">⚡ Yes</span>' : '<span style="color:var(--muted)">No</span>'}</td>
        <td class="font-mono" style="font-size:0.75rem;">${r.charging_time ? fmtSec(r.charging_time) : '—'}</td>
        <td class="font-mono" style="font-size:0.75rem;">${r.discharging_time ? fmtSec(r.discharging_time) : '—'}</td>
      </tr>`).join('')}</tbody>
    </table></div>`;
  } catch (e) { notif(e.message, '❌', 'err'); }
}

// ══════════════════════════════════════════════
//  ADMIN: Alerts
// ══════════════════════════════════════════════
async function loadAlerts() {
  const wrap = g('alerts-list');
  if (wrap) wrap.innerHTML = '<div style="text-align:center;padding:2rem;color:var(--muted);">Loading...</div>';
  try {
    const data = await api(API.adminData + '?action=alerts&limit=100');
    if (!data.alerts.length) {
      if (wrap) wrap.innerHTML = '<div style="text-align:center;padding:2rem;color:var(--green);">✅ No alerts. All clear.</div>';
      return;
    }
    if (wrap) wrap.innerHTML = data.alerts.map(a => `
      <div class="alert-item" style="border-left-color:${a.type === 'low_battery' ? 'var(--amber)' : 'var(--purple)'};">
        <span style="font-size:1.2rem;">${a.type === 'low_battery' ? '🔋' : '🔲'}</span>
        <div style="flex:1;">
          <div style="font-weight:600;font-size:0.82rem;">${escHtml(a.message)}</div>
          <div style="font-size:0.7rem;color:var(--muted);margin-top:3px;">
            ${new Date(a.created_at).toLocaleString()}
            ${a.is_read ? '<span style="color:var(--green);margin-left:8px;">✓ Read</span>' : '<span style="color:var(--amber);margin-left:8px;">● Unread</span>'}
          </div>
        </div>
      </div>`).join('');
  } catch (e) { notif(e.message, '❌', 'err'); }
}

async function markAlertsRead() {
  try {
    await api(API.adminData + '?action=mark_alerts_read', 'POST');
    notif('All alerts marked as read', '✓', 'success');
    loadAlerts();
    setText('alerts-badge', '0');
    setText('stat-alerts', '0');
  } catch (e) { notif(e.message, '❌', 'err'); }
}

// ══════════════════════════════════════════════
//  ADMIN: Geofences
// ══════════════════════════════════════════════
async function loadGeofences() {
  const wrap = g('geofence-list');
  if (wrap) wrap.innerHTML = '<div style="text-align:center;padding:2rem;color:var(--muted);">Loading...</div>';
  try {
    const data = await api(API.adminData + '?action=geofences');
    if (!data.zones.length) {
      if (wrap) wrap.innerHTML = '<div style="text-align:center;padding:2rem;color:var(--muted);">No zones defined yet.</div>';
      return;
    }
    if (wrap) wrap.innerHTML = data.zones.map(z => `
      <div class="zone-card">
        <span style="font-size:1.4rem;">📍</span>
        <div style="flex:1;">
          <div style="font-weight:600;">${escHtml(z.name)}</div>
          <div style="font-size:0.73rem;color:var(--muted);font-family:var(--mono);">${parseFloat(z.lat_center).toFixed(6)}, ${parseFloat(z.lng_center).toFixed(6)} · radius: ${z.radius_m}m</div>
          ${z.alert_email ? `<div style="font-size:0.7rem;color:var(--muted);">Alert: ${escHtml(z.alert_email)}</div>` : ''}
        </div>
        <a href="https://maps.google.com/?q=${z.lat_center},${z.lng_center}" target="_blank" class="map-link-btn" style="margin-right:6px;">🗺</a>
        <button class="btn btn-danger btn-sm" onclick="deleteZone(${z.id})">Delete</button>
      </div>`).join('');
  } catch (e) { notif(e.message, '❌', 'err'); }
}

async function addZone() {
  const name  = g('z-name').value.trim();
  const lat   = parseFloat(g('z-lat').value);
  const lng   = parseFloat(g('z-lng').value);
  const rad   = parseInt(g('z-radius').value);
  const email = g('z-alert-email').value.trim();
  if (!name || isNaN(lat) || isNaN(lng)) { notif('Name, lat, lng required', '⚠️', 'err'); return; }
  try {
    const data = await api(API.adminData + '?action=add_zone', 'POST', { name, lat, lng, radius: rad, alert_email: email });
    notif(data.msg, '✅', 'success');
    hideModal('modal-add-zone');
    loadGeofences();
  } catch (e) { notif(e.message, '❌', 'err'); }
}

async function deleteZone(id) {
  if (!confirm('Delete this geofence zone?')) return;
  try {
    await api(API.adminData + '?action=delete_zone&id=' + id, 'POST');
    notif('Zone deleted', '✓', 'success');
    loadGeofences();
  } catch (e) { notif(e.message, '❌', 'err'); }
}

// ══════════════════════════════════════════════
//  INVITE USER
// ══════════════════════════════════════════════
async function sendInvite() {
  const name     = g('inv-name').value.trim();
  const email    = g('inv-email').value.trim();
  const device   = g('inv-device').value.trim() || 'Unknown Device';
  const password = g('inv-password').value.trim();

  if (!name || !email) { notif('Name and email are required', '⚠️', 'err'); return; }
  if (!password || password.length < 8) { notif('Set a password (min 8 chars)', '⚠️', 'err'); return; }
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { notif('Enter a valid email', '⚠️', 'err'); return; }

  const btn = g('inv-btn');
  btn.innerHTML = '<div class="spinner"></div> Creating invite...';
  btn.disabled  = true;

  try {
    const data = await api(API.userAuth + '?action=invite', 'POST', { name, email, device, password });
    await emailjs.send(EJS_SERVICE, EJS_TEMPLATE, {
      to_name: data.name, to_email: data.email,
      password: data.plain_password, verify_link: data.verify_link,
      verify_token: data.token, device_name: data.device_name,
      expires_in: data.expires_in, site_url: window.location.origin,
    });
    notif('Invitation emailed to ' + email, '📧', 'success');
    hideModal('modal-invite');
    ['inv-name', 'inv-email', 'inv-device', 'inv-password'].forEach(id => { const el = g(id); if (el) el.value = ''; });
    if (g('page-users')?.classList.contains('active')) loadUsers();
  } catch (e) {
    notif('Error: ' + (e.text || e.message || 'Unknown error'), '❌', 'err');
  } finally {
    btn.innerHTML = '📤 Create &amp; Send Invite';
    btn.disabled  = false;
  }
}

// ══════════════════════════════════════════════
//  CSV Export
// ══════════════════════════════════════════════
async function exportCSV() {
  try {
    const data = await api(API.adminData + '?action=location_log&limit=500');
    if (!data.logs.length) { notif('No data to export', '⚠️', 'err'); return; }
    const hdr  = 'timestamp,user,device_id,latitude,longitude,accuracy_m,battery_pct,is_charging,network\n';
    const rows = data.logs.map(r =>
      [r.recorded_at, r.user_name, r.device_id || '', r.latitude, r.longitude,
       Math.round(r.accuracy_m || 0), r.battery_pct ?? '', r.is_charging ?? '', r.network_type || ''].join(',')
    ).join('\n');
    const blob = new Blob([hdr + rows], { type: 'text/csv' });
    const a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = 'tracksphere_log_' + Date.now() + '.csv';
    a.click();
    notif('CSV exported', '⬇', 'success');
  } catch (e) { notif(e.message, '❌', 'err'); }
}

// ══════════════════════════════════════════════
//  MESSAGING — Message badge polling
// ══════════════════════════════════════════════
async function pollMsgBadge() {
  try {
    const data = await api(API.messages + '?action=unread_count');
    const cnt  = data.count || 0;
    ['msg-badge-nav','msg-badge-nav-user'].forEach(id => {
      const el = g(id);
      if (el) { el.textContent = cnt; el.style.display = cnt > 0 ? 'inline' : 'none'; }
    });
    const tb = g('msg-topbar-badge');
    if (tb) { tb.textContent = cnt; tb.classList.toggle('show', cnt > 0); }
  } catch (_) {}
}

// ──────────────────────────────────────────────
//  ADMIN CHAT
// ──────────────────────────────────────────────
function initAdminChat() {
  g('admin-chat-wrap').style.display = 'grid';
  g('user-chat-wrap').style.display  = 'none';
  loadAdminInbox();
  clearInterval(S.msgPollTimer);
  S.msgPollTimer = setInterval(() => {
    loadAdminInbox(true); // silent refresh
    if (S.activeChatUserId) loadAdminConvo(S.activeChatUserId, true);
  }, 10000);
}

async function loadAdminInbox(silent = false) {
  const list = g('admin-inbox-list');
  if (!silent && list) list.innerHTML = '<div style="text-align:center;padding:2rem;color:var(--muted);font-size:0.8rem;">Loading…</div>';
  try {
    const data = await api(API.messages + '?action=list');
    if (!data.messages.length) {
      if (list) list.innerHTML = '<div style="text-align:center;padding:2rem;color:var(--muted);font-size:0.8rem;">No conversations yet.<br>Go to Users → Chat to start.</div>';
      return;
    }
    if (list) list.innerHTML = data.messages.map(m => `
      <div class="inbox-item ${m.user_id == S.activeChatUserId ? 'active-chat' : ''}" onclick="loadAdminConvo(${m.user_id},'${escHtml(m.user_name || '?')}')">
        <div class="inbox-av">${(m.user_name || '?').charAt(0).toUpperCase()}</div>
        <div style="flex:1;min-width:0;">
          <div class="inbox-name">${escHtml(m.user_name || '—')}</div>
          <div class="inbox-preview">${m.sender === 'user' ? '👤 ' : '🛡 '}${escHtml(m.text)}</div>
        </div>
        <div style="display:flex;flex-direction:column;align-items:flex-end;gap:4px;">
          <div class="inbox-time">${timeAgo(m.created_at)}</div>
          ${!m.is_read && m.sender === 'user' ? `<div class="inbox-unread">!</div>` : ''}
        </div>
      </div>`).join('');
  } catch (e) { console.warn('Inbox error:', e.message); }
}

async function loadAdminConvo(userId, userName, silent = false) {
  if (typeof userName === 'boolean') { silent = userName; userName = S.activeChatUserName; }
  if (!userId) return;

  S.activeChatUserId   = userId;
  S.activeChatUserName = userName;

  // Update header
  setText('chat-target-name',   userName || 'User');
  setText('chat-target-status', '● Active');
  const av = g('chat-target-av');
  if (av) av.textContent = (userName || '?').charAt(0).toUpperCase();
  const delBtn = g('chat-delete-btn');
  if (delBtn) delBtn.style.display = 'inline-flex';

  // Highlight inbox
  document.querySelectorAll('.inbox-item').forEach(el => el.classList.remove('active-chat'));

  const body = g('admin-chat-body');
  if (!silent && body) body.innerHTML = '<div class="chat-empty">Loading…</div>';

  try {
    const data = await api(API.messages + '?action=list&user_id=' + userId);
    renderMessages(body, data.messages, 'admin');
    pollMsgBadge();
  } catch (e) { notif('Failed to load messages: ' + e.message, '❌', 'err'); }
}

async function sendAdminMsg() {
  if (!S.activeChatUserId) { notif('Select a user first', '⚠️', 'err'); return; }
  const inp  = g('admin-chat-input');
  const text = inp?.value.trim();
  if (!text) return;
  inp.value = '';
  try {
    await api(API.messages + '?action=send', 'POST', { text, user_id: S.activeChatUserId });
    await loadAdminConvo(S.activeChatUserId, S.activeChatUserName, true);
  } catch (e) { notif(e.message, '❌', 'err'); inp.value = text; }
}

// Called from Users page "Chat" button
function openAdminChatWith(userId, userName) {
  goPage('messages');
  setTimeout(() => {
    loadAdminConvo(userId, userName);
  }, 100);
}

// ──────────────────────────────────────────────
//  USER CHAT
// ──────────────────────────────────────────────
function initUserChat() {
  g('admin-chat-wrap').style.display = 'none';
  g('user-chat-wrap').style.display  = 'flex';
  loadUserMessages();
  clearInterval(S.msgPollTimer);
  S.msgPollTimer = setInterval(() => loadUserMessages(true), 10000);
}

async function loadUserMessages(silent = false) {
  const body = g('user-chat-body');
  if (!silent && body) body.innerHTML = '<div class="chat-empty">Loading…</div>';
  try {
    const data = await api(API.messages + '?action=list');
    renderMessages(body, data.messages, 'user');
    pollMsgBadge();
  } catch (e) { console.warn('User chat error:', e.message); }
}

async function sendUserMsg() {
  const inp  = g('user-chat-input');
  const text = inp?.value.trim();
  if (!text) return;
  inp.value = '';
  try {
    await api(API.messages + '?action=send', 'POST', { text });
    await loadUserMessages(true);
  } catch (e) { notif(e.message, '❌', 'err'); inp.value = text; }
}

// ──────────────────────────────────────────────
//  Shared: render messages into a container
// ──────────────────────────────────────────────
function renderMessages(container, messages, myRole) {
  if (!container) return;
  if (!messages.length) {
    container.innerHTML = '<div class="chat-empty">No messages yet.</div>';
    return;
  }

  let html = '';
  let lastDate = '';

  messages.forEach(m => {
    const d     = new Date(m.created_at);
    const dStr  = d.toLocaleDateString();
    if (dStr !== lastDate) {
      html += `<div class="chat-day-sep">${dStr === new Date().toLocaleDateString() ? 'Today' : dStr}</div>`;
      lastDate = dStr;
    }
    const isMe = m.sender === myRole;
    const tick = m.is_read ? '<span class="chat-read-tick">✓✓</span>' : '';
    html += `
      <div class="chat-msg ${isMe ? 'from-me' : 'from-them'}">
        ${!isMe ? `<div class="chat-sender">${escHtml(m.sender_name)}</div>` : ''}
        <div class="chat-bubble">${escHtml(m.text)}</div>
        <div class="chat-time">${d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}${isMe ? tick : ''}</div>
      </div>`;
  });

  container.innerHTML = html;
  container.scrollTop = container.scrollHeight;
}

// ──────────────────────────────────────────────
//  Delete all messages
// ──────────────────────────────────────────────
async function deleteAllMsgs() {
  const label = S.role === 'admin' && S.activeChatUserId
    ? 'Delete ALL messages with ' + S.activeChatUserName + '?'
    : 'Delete ALL your messages? This cannot be undone.';
  if (!confirm(label)) return;

  const body = S.role === 'admin' && S.activeChatUserId
    ? { user_id: S.activeChatUserId }
    : {};

  try {
    await api(API.messages + '?action=delete_all', 'POST', body);
    notif('All messages deleted', '🗑', 'success');
    if (S.role === 'admin') {
      loadAdminInbox();
      const chatBody = g('admin-chat-body');
      if (chatBody) chatBody.innerHTML = '<div class="chat-empty">No messages yet.</div>';
    } else {
      loadUserMessages();
    }
  } catch (e) { notif(e.message, '❌', 'err'); }
}

// ══════════════════════════════════════════════
//  Modal helpers
// ══════════════════════════════════════════════
function showModal(id) { const m = g(id); if (m) m.classList.add('show'); }
function hideModal(id) { const m = g(id); if (m) m.classList.remove('show'); }
document.querySelectorAll('.modal-overlay').forEach(m =>
  m.addEventListener('click', e => { if (e.target === m) m.classList.remove('show'); })
);

// ══════════════════════════════════════════════
//  UI Helpers
// ══════════════════════════════════════════════
function batBadge(pct) {
  pct = parseInt(pct);
  const c = pct > 50 ? 'var(--green)' : pct > 20 ? 'var(--amber)' : 'var(--red)';
  const icon = pct > 50 ? '🔋' : pct > 20 ? '🪫' : '❗';
  return `<span style="color:${c};font-family:var(--mono);font-weight:700;">${icon} ${pct}%</span>`;
}

function fmtSec(s) {
  if (!s || s === Infinity || isNaN(s)) return 'Unknown';
  const h = Math.floor(s / 3600), m = Math.floor((s % 3600) / 60);
  return h > 0 ? h + 'h ' + m + 'm' : m + 'm';
}

function timeAgo(dateStr) {
  const d   = new Date(dateStr);
  const now = new Date();
  const sec = Math.floor((now - d) / 1000);
  if (sec < 60)   return 'just now';
  if (sec < 3600) return Math.floor(sec / 60) + 'm ago';
  if (sec < 86400) return Math.floor(sec / 3600) + 'h ago';
  return d.toLocaleDateString();
}

function escHtml(s) {
  return String(s || '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

function g(id)          { return document.getElementById(id); }
function setText(id, txt) { const el = g(id); if (el) el.textContent = txt; }
function setEl(id, txt, color) {
  const el = g(id);
  if (!el) return;
  if (txt !== undefined) el.textContent = txt;
  if (color) el.style.color = color;
}

let notifTimer;
function notif(msg, icon = '✓', type = '') {
  const n = g('notif');
  g('n-msg').textContent  = msg;
  g('n-icon').textContent = icon;
  n.className = 'notif show' + (type ? ' ' + type : '');
  clearTimeout(notifTimer);
  notifTimer = setTimeout(() => n.classList.remove('show'), 4000);
}
</script>
</body>
</html>