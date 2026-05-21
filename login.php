<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#050a16">
<title>TrackSphere — Sign In</title>
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root {
  --bg:#050a16;--bg1:#0a1428;--bg2:#0f1d3a;--bg3:#142248;
  --cyan:#00e5ff;--purple:#7b5fff;--green:#00ff9d;--red:#ff3d5a;--amber:#ffb830;
  --text:#dce9ff;--muted:#5a7399;--dim:#2a3f60;
  --border:rgba(0,229,255,0.1);--glow-c:0 0 30px rgba(0,229,255,0.12);
  --r:12px;--rs:8px;--mono:'JetBrains Mono',monospace;--body:'DM Sans',sans-serif;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
html{scroll-behavior:smooth;}
body{font-family:var(--body);background:var(--bg);color:var(--text);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:1rem;overflow-x:hidden;}
body::before{content:'';position:fixed;inset:0;background-image:radial-gradient(ellipse at 20% 50%,rgba(123,95,255,0.06) 0%,transparent 60%),radial-gradient(ellipse at 80% 20%,rgba(0,229,255,0.06) 0%,transparent 50%);pointer-events:none;}
body::after{content:'';position:fixed;inset:0;background-image:linear-gradient(rgba(0,229,255,0.02) 1px,transparent 1px),linear-gradient(90deg,rgba(0,229,255,0.02) 1px,transparent 1px);background-size:40px 40px;pointer-events:none;}

.wrap{width:100%;max-width:440px;position:relative;z-index:1;}

.brand{text-align:center;margin-bottom:2rem;}
.brand-icon{width:60px;height:60px;background:linear-gradient(135deg,var(--purple),var(--cyan));border-radius:16px;display:inline-flex;align-items:center;justify-content:center;font-size:28px;margin-bottom:14px;box-shadow:0 8px 32px rgba(123,95,255,0.3);}
.brand-title{font-family:var(--mono);font-size:1.8rem;font-weight:700;color:var(--cyan);letter-spacing:-2px;margin-bottom:4px;}
.brand-sub{font-size:0.7rem;color:var(--muted);letter-spacing:3px;text-transform:uppercase;}

.card{background:var(--bg1);border:1px solid var(--border);border-radius:var(--r);padding:2rem;box-shadow:0 0 80px rgba(0,229,255,0.04);}

.tabs{display:flex;background:var(--bg);border-radius:var(--rs);padding:3px;margin-bottom:1.75rem;border:1px solid var(--border);}
.tab{flex:1;padding:0.55rem;border:none;background:transparent;color:var(--muted);font-family:var(--body);font-size:0.82rem;font-weight:500;cursor:pointer;border-radius:6px;transition:all 0.2s;}
.tab.active{background:var(--purple);color:#fff;box-shadow:0 2px 12px rgba(123,95,255,0.35);}

.panel{display:none;animation:fadeIn 0.2s ease;}
.panel.active{display:block;}
@keyframes fadeIn{from{opacity:0;transform:translateY(5px);}to{opacity:1;transform:translateY(0);}}

.fg{margin-bottom:1rem;}
label{display:block;font-size:0.68rem;color:var(--muted);letter-spacing:1.5px;text-transform:uppercase;margin-bottom:5px;font-weight:600;}
input{width:100%;padding:0.7rem 1rem;background:var(--bg2);border:1.5px solid var(--border);border-radius:var(--rs);color:var(--text);font-family:var(--body);font-size:0.9rem;outline:none;transition:border-color 0.2s,box-shadow 0.2s;}
input:focus{border-color:var(--cyan);box-shadow:0 0 0 3px rgba(0,229,255,0.08);}
input::placeholder{color:var(--dim);}
select{width:100%;padding:0.7rem 1rem;background:var(--bg2);border:1.5px solid var(--border);border-radius:var(--rs);color:var(--text);font-family:var(--body);font-size:0.9rem;outline:none;transition:border-color 0.2s;}
select:focus{border-color:var(--cyan);}
select option{background:var(--bg2);}

.btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:0.75rem 1.5rem;border:none;border-radius:var(--rs);font-family:var(--body);font-size:0.9rem;font-weight:600;cursor:pointer;transition:all 0.18s;text-decoration:none;width:100%;}
.btn-primary{background:linear-gradient(135deg,var(--purple),#4f2fcc);color:#fff;box-shadow:0 4px 15px rgba(123,95,255,0.25);}
.btn-primary:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(123,95,255,0.35);}
.btn-primary:disabled{opacity:0.6;cursor:default;transform:none;}
.btn-cyan{background:linear-gradient(135deg,var(--cyan),#0099bb);color:var(--bg);font-weight:700;}
.btn-cyan:hover{transform:translateY(-1px);}

.divider{display:flex;align-items:center;gap:10px;margin:1rem 0;color:var(--dim);font-size:0.75rem;}
.divider::before,.divider::after{content:'';flex:1;height:1px;background:var(--border);}

.link-btn{background:none;border:none;color:var(--cyan);font-size:0.82rem;cursor:pointer;text-decoration:underline;font-family:var(--body);padding:0;}
.link-btn:hover{opacity:0.8;}

.info-note{background:rgba(0,229,255,0.05);border:1px solid rgba(0,229,255,0.12);border-radius:var(--rs);padding:0.7rem 0.9rem;font-size:0.78rem;color:var(--muted);line-height:1.6;margin-bottom:1rem;}

.notif{position:fixed;top:1rem;right:1rem;left:1rem;max-width:400px;margin:0 auto;background:var(--bg2);border:1px solid var(--cyan);border-radius:var(--r);padding:0.75rem 1.1rem;font-size:0.82rem;color:var(--cyan);z-index:9999;display:flex;align-items:center;gap:8px;transform:translateY(-120%);transition:transform 0.3s cubic-bezier(.34,1.56,.64,1);box-shadow:var(--glow-c);}
.notif.show{transform:translateY(0);}
.notif.err{border-color:var(--red);color:var(--red);}
.notif.success{border-color:var(--green);color:var(--green);}

.spinner{width:16px;height:16px;border:2px solid rgba(255,255,255,0.25);border-top-color:#fff;border-radius:50%;animation:spin 0.7s linear infinite;flex-shrink:0;}
@keyframes spin{to{transform:rotate(360deg);}}

/* Redirect screen */
.redirect-screen{text-align:center;padding:2rem 0;}
.redirect-icon{font-size:2.8rem;margin-bottom:1rem;}
.redirect-title{font-family:var(--mono);color:var(--cyan);font-size:1rem;margin-bottom:0.5rem;}
.redirect-sub{font-size:0.8rem;color:var(--muted);}

@media(max-width:480px){
  .card{padding:1.5rem 1.2rem;}
  .brand-title{font-size:1.5rem;}
}
</style>
</head>
<body>

<div class="notif" id="notif"><span id="n-icon">✓</span><span id="n-msg"></span></div>

<div class="wrap">
  <div class="brand">
    <div class="brand-icon">🛰️</div>
    <div class="brand-title">TrackSphere</div>
    <div class="brand-sub">Real-Time Location Intelligence</div>
  </div>

  <!-- Already-logged-in redirect screen (hidden by default) -->
  <div class="card" id="card-redirect" style="display:none;">
    <div class="redirect-screen">
      <div class="redirect-icon">✅</div>
      <div class="redirect-title">Already Signed In</div>
      <div class="redirect-sub" style="margin-bottom:1.5rem;">Redirecting you to your dashboard...</div>
      <div class="spinner" style="margin:0 auto;width:20px;height:20px;border-top-color:var(--cyan);border-color:var(--dim);"></div>
    </div>
  </div>

  <!-- Login card -->
  <div class="card" id="card-login">
    <div class="tabs">
      <button class="tab active" id="tab-login"  onclick="switchTab('login')">Sign In</button>
      <button class="tab"        id="tab-verify" onclick="switchTab('verify')">Verify Token</button>
    </div>

    <!-- ── SIGN IN ── -->
    <div class="panel active" id="panel-login">
      <div class="fg">
        <label>Email Address</label>
        <input type="email" id="l-email" placeholder="your@email.com" autocomplete="email">
      </div>
      <div class="fg">
        <label>Password</label>
        <input type="password" id="l-pass" placeholder="••••••••" autocomplete="current-password"
          onkeydown="if(event.key==='Enter')doLogin()">
      </div>
      <div class="fg">
        <label>Login As</label>
        <select id="l-role">
          <option value="user">📱 User (Device Tracker)</option>
          <option value="admin">🛡 Administrator</option>
        </select>
      </div>
      <button class="btn btn-primary" id="login-btn" onclick="doLogin()">🔐 Sign In Securely</button>
      <div class="divider">or</div>
      <div style="text-align:center;font-size:0.82rem;color:var(--muted);">
        Don't have an account? <button class="link-btn" onclick="location.href='register.php'">Register here →</button>
      </div>
    </div>

    <!-- ── VERIFY TOKEN ── -->
    <div class="panel" id="panel-verify">
      <div class="info-note">📧 Paste the verification token from your invitation email below. Tokens are valid for 7 days.</div>
      <div class="fg">
        <label>Verification Token</label>
        <input type="text" id="v-token" placeholder="ts_v_xxxxxxxxxxxxxxxx..."
          onkeydown="if(event.key==='Enter')doVerify()">
      </div>
      <button class="btn btn-cyan" id="verify-btn" onclick="doVerify()">✅ Verify &amp; Activate Account</button>
    </div>
  </div>
</div>

<script>
const API = {
  adminAuth: 'api/admin_auth.php',
  userAuth:  'api/user_auth.php',
};

// ── AUTO-REDIRECT if already logged in ──
(function checkSession() {
  const token = sessionStorage.getItem('ts_token');
  const role  = sessionStorage.getItem('ts_role');
  const user  = sessionStorage.getItem('ts_user');

  if (token && role && user) {
    // Validate token is still active before redirecting
    const ep = role === 'admin'
      ? API.adminAuth + '?action=validate'
      : API.userAuth  + '?action=validate';

    // Show redirect UI immediately, then verify
    document.getElementById('card-login').style.display   = 'none';
    document.getElementById('card-redirect').style.display = 'block';

    fetch(ep, {
      method: 'GET',
      headers: { 'X-Session-Token': token }
    }).then(r => r.json()).then(d => {
      if (d.ok) {
        location.href = 'index.php';
      } else {
        // Session invalid — clear and show login
        sessionStorage.clear();
        document.getElementById('card-login').style.display   = 'block';
        document.getElementById('card-redirect').style.display = 'none';
      }
    }).catch(() => {
      // Network error — just redirect anyway if we have token
      location.href = 'index.php';
    });
  }
})();

// ── Check for ?verify= in URL (one-click from email link) ──
(function() {
  const params = new URLSearchParams(location.search);
  const v = params.get('verify');
  if (v) {
    switchTab('verify');
    document.getElementById('v-token').value = v;
    setTimeout(doVerify, 400);
  }
  const tab = params.get('tab');
  if (tab) switchTab(tab);
})();

function switchTab(t) {
  ['login','verify'].forEach(id => {
    document.getElementById('tab-'+id).classList.toggle('active', id===t);
    document.getElementById('panel-'+id).classList.toggle('active', id===t);
  });
}

async function api(url, method='GET', body=null) {
  const opts = { method, headers: {'Content-Type':'application/json'} };
  if (body) opts.body = JSON.stringify(body);
  const res  = await fetch(url, opts);
  const json = await res.json();
  if (!json.ok) throw new Error(json.error || 'API error');
  return json;
}

async function doLogin() {
  const email = document.getElementById('l-email').value.trim();
  const pass  = document.getElementById('l-pass').value.trim();
  const role  = document.getElementById('l-role').value;
  if (!email || !pass) { notif('Fill in email and password','⚠️','err'); return; }

  const btn = document.getElementById('login-btn');
  btn.innerHTML = '<div class="spinner"></div> Signing in...';
  btn.disabled  = true;

  try {
    const ep   = role === 'admin' ? API.adminAuth + '?action=login' : API.userAuth + '?action=login';
    const data = await api(ep, 'POST', { email, pass });

    sessionStorage.setItem('ts_token', data.token);
    sessionStorage.setItem('ts_role',  role);
    sessionStorage.setItem('ts_user',  JSON.stringify({
      name: data.name, email: data.email,
      device_id: data.device_id, device_name: data.device_name,
      last_battery: data.last_battery
    }));

    notif('Welcome back, ' + data.name + '!', '✅', 'success');
    setTimeout(() => location.href = 'index.php', 800);
  } catch(e) {
    notif(e.message, '❌', 'err');
    btn.innerHTML = '🔐 Sign In Securely';
    btn.disabled  = false;
  }
}

async function doVerify() {
  const token = document.getElementById('v-token').value.trim();
  if (!token) { notif('Enter your verification token','⚠️','err'); return; }

  const btn = document.getElementById('verify-btn');
  btn.innerHTML = '<div class="spinner"></div> Verifying...';
  btn.disabled  = true;

  try {
    const data = await api(API.userAuth + '?action=verify', 'POST', { token });

    sessionStorage.setItem('ts_token', data.token);
    sessionStorage.setItem('ts_role',  'user');
    sessionStorage.setItem('ts_user',  JSON.stringify({
      name: data.name, email: data.email,
      device_id: data.device_id, device_name: data.device_name
    }));

    notif('Account verified! Starting tracking...', '✅', 'success');
    setTimeout(() => location.href = 'index.php', 800);
  } catch(e) {
    notif(e.message, '❌', 'err');
    btn.innerHTML = '✅ Verify &amp; Activate Account';
    btn.disabled  = false;
  }
}

let notifTimer;
function notif(msg, icon='✓', type='') {
  const n = document.getElementById('notif');
  document.getElementById('n-msg').textContent  = msg;
  document.getElementById('n-icon').textContent = icon;
  n.className = 'notif show' + (type ? ' '+type : '');
  clearTimeout(notifTimer);
  notifTimer = setTimeout(() => n.classList.remove('show'), 4000);
}
</script>
</body>
</html>