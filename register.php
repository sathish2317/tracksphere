<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#050a16">
<title>TrackSphere — Register</title>
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root {
  --bg:#050a16;--bg1:#0a1428;--bg2:#0f1d3a;
  --cyan:#00e5ff;--purple:#7b5fff;--green:#00ff9d;--red:#ff3d5a;--amber:#ffb830;
  --text:#dce9ff;--muted:#5a7399;--dim:#2a3f60;
  --border:rgba(0,229,255,0.1);--r:12px;--rs:8px;
  --mono:'JetBrains Mono',monospace;--body:'DM Sans',sans-serif;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{font-family:var(--body);background:var(--bg);color:var(--text);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:1.5rem 1rem;overflow-x:hidden;}
body::before{content:'';position:fixed;inset:0;background-image:radial-gradient(ellipse at 80% 80%,rgba(123,95,255,0.07) 0%,transparent 55%),radial-gradient(ellipse at 20% 20%,rgba(0,229,255,0.05) 0%,transparent 50%);pointer-events:none;}
body::after{content:'';position:fixed;inset:0;background-image:linear-gradient(rgba(0,229,255,0.018) 1px,transparent 1px),linear-gradient(90deg,rgba(0,229,255,0.018) 1px,transparent 1px);background-size:40px 40px;pointer-events:none;}

.wrap{width:100%;max-width:460px;position:relative;z-index:1;}
.brand{text-align:center;margin-bottom:1.75rem;}
.brand-icon{width:56px;height:56px;background:linear-gradient(135deg,var(--purple),var(--cyan));border-radius:14px;display:inline-flex;align-items:center;justify-content:center;font-size:26px;margin-bottom:12px;box-shadow:0 8px 28px rgba(123,95,255,0.3);}
.brand-title{font-family:var(--mono);font-size:1.6rem;font-weight:700;color:var(--cyan);letter-spacing:-1.5px;margin-bottom:3px;}
.brand-sub{font-size:0.68rem;color:var(--muted);letter-spacing:3px;text-transform:uppercase;}

.card{background:var(--bg1);border:1px solid var(--border);border-radius:var(--r);padding:2rem;box-shadow:0 0 60px rgba(0,229,255,0.04);}

.tabs{display:flex;background:var(--bg);border-radius:var(--rs);padding:3px;margin-bottom:1.5rem;border:1px solid var(--border);}
.tab{flex:1;padding:0.52rem;border:none;background:transparent;color:var(--muted);font-family:var(--body);font-size:0.8rem;font-weight:500;cursor:pointer;border-radius:6px;transition:all 0.2s;}
.tab.active{background:var(--purple);color:#fff;box-shadow:0 2px 10px rgba(123,95,255,0.3);}

.panel{display:none;animation:fi 0.2s ease;}
.panel.active{display:block;}
@keyframes fi{from{opacity:0;transform:translateY(4px);}to{opacity:1;transform:translateY(0);}}

.fg{margin-bottom:0.9rem;}
label{display:block;font-size:0.68rem;color:var(--muted);letter-spacing:1.5px;text-transform:uppercase;margin-bottom:5px;font-weight:600;}
input{width:100%;padding:0.65rem 0.95rem;background:var(--bg2);border:1.5px solid var(--border);border-radius:var(--rs);color:var(--text);font-family:var(--body);font-size:0.88rem;outline:none;transition:border-color 0.2s,box-shadow 0.2s;}
input:focus{border-color:var(--cyan);box-shadow:0 0 0 3px rgba(0,229,255,0.07);}
input::placeholder{color:var(--dim);}

.btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:0.72rem 1.4rem;border:none;border-radius:var(--rs);font-family:var(--body);font-size:0.9rem;font-weight:600;cursor:pointer;transition:all 0.18s;width:100%;}
.btn-primary{background:linear-gradient(135deg,var(--purple),#4f2fcc);color:#fff;box-shadow:0 4px 14px rgba(123,95,255,0.22);}
.btn-primary:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(123,95,255,0.32);}
.btn-primary:disabled{opacity:0.6;cursor:default;transform:none;}

.note{background:rgba(255,184,48,0.05);border:1px solid rgba(255,184,48,0.18);border-radius:var(--rs);padding:0.65rem 0.85rem;font-size:0.76rem;color:var(--amber);line-height:1.6;margin-bottom:0.9rem;}
.info{background:rgba(0,229,255,0.05);border:1px solid rgba(0,229,255,0.1);border-radius:var(--rs);padding:0.65rem 0.85rem;font-size:0.76rem;color:var(--muted);line-height:1.6;margin-bottom:0.9rem;}

.notif{position:fixed;top:1rem;right:1rem;left:1rem;max-width:400px;margin:0 auto;background:var(--bg2);border:1px solid var(--cyan);border-radius:var(--r);padding:0.75rem 1.1rem;font-size:0.82rem;color:var(--cyan);z-index:9999;display:flex;align-items:center;gap:8px;transform:translateY(-120%);transition:transform 0.3s cubic-bezier(.34,1.56,.64,1);}
.notif.show{transform:translateY(0);}
.notif.err{border-color:var(--red);color:var(--red);}
.notif.success{border-color:var(--green);color:var(--green);}

.spinner{width:16px;height:16px;border:2px solid rgba(255,255,255,0.25);border-top-color:#fff;border-radius:50%;animation:spin 0.7s linear infinite;}
@keyframes spin{to{transform:rotate(360deg);}}

.signin-link{text-align:center;margin-top:1.2rem;font-size:0.82rem;color:var(--muted);}
.link-btn{background:none;border:none;color:var(--cyan);font-size:0.82rem;cursor:pointer;text-decoration:underline;font-family:var(--body);}

.success-box{text-align:center;padding:1.5rem 0;}
.success-icon{font-size:3rem;margin-bottom:1rem;}
.token-display{font-family:var(--mono);font-size:0.72rem;background:var(--bg);border:1px solid var(--border);border-radius:var(--rs);padding:0.75rem 1rem;color:var(--green);word-break:break-all;line-height:1.8;margin:0.75rem 0;}

@media(max-width:480px){
  .card{padding:1.4rem 1.1rem;}
  .brand-title{font-size:1.4rem;}
}
</style>
</head>
<body>

<div class="notif" id="notif"><span id="n-icon">✓</span><span id="n-msg"></span></div>

<div class="wrap">
  <div class="brand">
    <div class="brand-icon">🛰️</div>
    <div class="brand-title">TrackSphere</div>
    <div class="brand-sub">Create Your Account</div>
  </div>

  <div class="card">
    <div class="tabs">
      <button class="tab active" id="tab-user"  onclick="switchTab('user')">📱 User Account</button>
      <button class="tab"        id="tab-admin" onclick="switchTab('admin')">🛡 Admin Account</button>
    </div>

    <!-- ── USER REGISTER ── -->
    <div class="panel active" id="panel-user">
      <div id="user-form">
        <div class="info">👤 Create a user account to enable GPS + battery tracking on your device.</div>
        <div class="fg"><label>Full Name</label><input type="text" id="u-name" placeholder="Your full name" autocomplete="name"></div>
        <div class="fg"><label>Email Address</label><input type="email" id="u-email" placeholder="your@email.com" autocomplete="email"></div>
        <div class="fg"><label>Password</label><input type="password" id="u-pass" placeholder="Min 8 characters" autocomplete="new-password"></div>
        <div class="fg"><label>Confirm Password</label><input type="password" id="u-pass2" placeholder="Repeat password" onkeydown="if(event.key==='Enter')doRegUser()"></div>
        <div class="fg"><label>Device Name</label><input type="text" id="u-device" placeholder="e.g. Samsung Galaxy S24"></div>
        <button class="btn btn-primary" id="reg-user-btn" onclick="doRegUser()">📱 Create User Account</button>
      </div>
      <div id="user-success" style="display:none;">
        <div class="success-box">
          <div class="success-icon">📧</div>
          <div style="font-family:var(--mono);font-size:1rem;color:var(--cyan);margin-bottom:0.5rem;">Registration Successful!</div>
          <div style="font-size:0.82rem;color:var(--muted);line-height:1.7;margin-bottom:1rem;">Your verification token:</div>
          <div class="token-display" id="user-token-display">—</div>
          <div style="font-size:0.78rem;color:var(--muted);margin-bottom:1.25rem;">Copy this token and use it on the <strong style="color:var(--cyan)">Verify Token</strong> tab on the login page. Valid for 24 hours.</div>
          <button class="btn btn-primary" onclick="location.href='login.php?tab=verify'">✅ Go Verify Now</button>
        </div>
      </div>
    </div>

    <!-- ── ADMIN REGISTER ── -->
    <div class="panel" id="panel-admin">
      <div id="admin-form">
        <div class="note">🔑 Admin registration requires a secret key. Contact your system owner to get it.</div>
        <div class="fg"><label>Full Name</label><input type="text" id="a-name" placeholder="Admin name" autocomplete="name"></div>
        <div class="fg"><label>Email Address</label><input type="email" id="a-email" placeholder="admin@yourdomain.com" autocomplete="email"></div>
        <div class="fg"><label>Password</label><input type="password" id="a-pass" placeholder="Min 8 characters" autocomplete="new-password"></div>
        <div class="fg"><label>Confirm Password</label><input type="password" id="a-pass2" placeholder="Repeat password"></div>
        <div class="fg"><label>Admin Registration Key</label><input type="password" id="a-key" placeholder="Secret key" onkeydown="if(event.key==='Enter')doRegAdmin()"></div>
        <button class="btn btn-primary" id="reg-admin-btn" onclick="doRegAdmin()">🛡 Create Admin Account</button>
      </div>
    </div>

    <div class="signin-link">Already have an account? <button class="link-btn" onclick="location.href='login.php'">Sign In →</button></div>
  </div>
</div>

<script>
const API = {
  adminAuth: 'api/admin_auth.php',
  userAuth:  'api/user_auth.php',
};

function switchTab(t) {
  ['user','admin'].forEach(id => {
    document.getElementById('tab-'+id).classList.toggle('active', id===t);
    document.getElementById('panel-'+id).classList.toggle('active', id===t);
  });
}

async function apiPost(url, body) {
  const res  = await fetch(url, { method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify(body) });
  const json = await res.json();
  if (!json.ok) throw new Error(json.error || 'API error');
  return json;
}

async function doRegUser() {
  const name   = document.getElementById('u-name').value.trim();
  const email  = document.getElementById('u-email').value.trim();
  const pass   = document.getElementById('u-pass').value.trim();
  const pass2  = document.getElementById('u-pass2').value.trim();
  const device = document.getElementById('u-device').value.trim() || 'Unknown Device';

  if (!name||!email||!pass||!pass2) { notif('All fields are required','⚠️','err'); return; }
  if (pass !== pass2) { notif('Passwords do not match','⚠️','err'); return; }
  if (pass.length < 8) { notif('Password must be at least 8 characters','⚠️','err'); return; }
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { notif('Enter a valid email address','⚠️','err'); return; }

  const btn = document.getElementById('reg-user-btn');
  btn.innerHTML = '<div class="spinner"></div> Creating account...';
  btn.disabled  = true;

  try {
    const data = await apiPost(API.userAuth + '?action=register', { name, email, pass, pass2, device });
    document.getElementById('user-token-display').textContent = data.token;
    document.getElementById('user-form').style.display    = 'none';
    document.getElementById('user-success').style.display = 'block';
    notif('Account created! Save your token.', '✅', 'success');
  } catch(e) {
    notif(e.message, '❌', 'err');
    btn.innerHTML = '📱 Create User Account';
    btn.disabled  = false;
  }
}

async function doRegAdmin() {
  const name  = document.getElementById('a-name').value.trim();
  const email = document.getElementById('a-email').value.trim();
  const pass  = document.getElementById('a-pass').value.trim();
  const pass2 = document.getElementById('a-pass2').value.trim();
  const key   = document.getElementById('a-key').value.trim();

  if (!name||!email||!pass||!pass2||!key) { notif('All fields are required','⚠️','err'); return; }
  if (pass !== pass2) { notif('Passwords do not match','⚠️','err'); return; }
  if (pass.length < 8) { notif('Password must be at least 8 characters','⚠️','err'); return; }
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { notif('Enter a valid email address','⚠️','err'); return; }

  const btn = document.getElementById('reg-admin-btn');
  btn.innerHTML = '<div class="spinner"></div> Creating admin...';
  btn.disabled  = true;

  try {
    const data = await apiPost(API.adminAuth + '?action=register', { name, email, pass, admin_key: key });
    notif(data.msg, '🛡', 'success');
    setTimeout(() => location.href = 'login.php', 1200);
  } catch(e) {
    notif(e.message, '❌', 'err');
    btn.innerHTML = '🛡 Create Admin Account';
    btn.disabled  = false;
  }
}

let nt;
function notif(msg, icon='✓', type='') {
  const n = document.getElementById('notif');
  document.getElementById('n-msg').textContent  = msg;
  document.getElementById('n-icon').textContent = icon;
  n.className = 'notif show' + (type ? ' '+type : '');
  clearTimeout(nt);
  nt = setTimeout(() => n.classList.remove('show'), 4500);
}
</script>
</body>
</html>