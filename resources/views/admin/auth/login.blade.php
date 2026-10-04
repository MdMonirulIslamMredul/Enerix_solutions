<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — {{ $settings->site_name ?? 'Enerix Solutions' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root { --primary:#0072ce; --primary-dark:#005bb5; --navy:#07132b; --accent:#38bdf8; }
        *{box-sizing:border-box;margin:0;padding:0;}
        html,body{height:100%;font-family:'Plus Jakarta Sans',sans-serif;overflow:hidden;}
        .login-page{display:flex;min-height:100vh;width:100%;}

        /* LEFT PANEL */
        .brand-panel{width:46%;background:var(--navy);position:relative;display:flex;flex-direction:column;justify-content:space-between;padding:3rem 3.5rem;overflow:hidden;flex-shrink:0;}
        .brand-panel::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(0,114,206,.07) 1px,transparent 1px),linear-gradient(90deg,rgba(0,114,206,.07) 1px,transparent 1px);background-size:48px 48px;animation:gridScroll 20s linear infinite;}
        @keyframes gridScroll{from{background-position:0 0}to{background-position:48px 48px}}
        .brand-panel::after{content:'';position:absolute;top:-120px;right:-120px;width:420px;height:420px;background:radial-gradient(circle,rgba(0,114,206,.22) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
        .orb-bottom{position:absolute;bottom:-80px;left:-80px;width:320px;height:320px;background:radial-gradient(circle,rgba(56,189,248,.15) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
        .brand-top{position:relative;z-index:2;}
        .brand-logo img{height:52px;width:auto;filter:brightness(0) invert(1);}
        .brand-body{position:relative;z-index:2;flex:1;display:flex;flex-direction:column;justify-content:center;padding:2.5rem 0;}
        .brand-tagline{display:inline-flex;align-items:center;gap:8px;background:rgba(0,114,206,.2);border:1px solid rgba(0,114,206,.35);color:var(--accent);font-size:.75rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:5px 14px;border-radius:50px;margin-bottom:1.5rem;width:fit-content;}
        .brand-headline{font-size:clamp(1.7rem,2.8vw,2.4rem);font-weight:900;line-height:1.2;color:#fff;margin-bottom:1rem;}
        .brand-headline .atext{color:var(--accent);}
        .brand-desc{font-size:.92rem;color:#94a3b8;line-height:1.65;max-width:340px;margin-bottom:2.5rem;}
        .feature-list{list-style:none;display:flex;flex-direction:column;gap:.85rem;}
        .feature-list li{display:flex;align-items:center;gap:12px;font-size:.88rem;font-weight:600;color:#cbd5e1;}
        .feat-icon{width:34px;height:34px;border-radius:10px;background:rgba(0,114,206,.18);border:1px solid rgba(0,114,206,.3);display:inline-flex;align-items:center;justify-content:center;color:var(--accent);font-size:.95rem;flex-shrink:0;}
        .brand-footer{position:relative;z-index:2;font-size:.78rem;color:#475569;padding-top:1.5rem;border-top:1px solid rgba(255,255,255,.07);}

        /* RIGHT PANEL */
        .login-panel{flex:1;background:#f8fafc;display:flex;align-items:center;justify-content:center;padding:2rem;position:relative;overflow-y:auto;}
        .login-panel::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,var(--primary) 0%,var(--accent) 100%);}
        .login-card{width:100%;max-width:420px;background:#fff;border-radius:20px;padding:2.75rem 2.5rem;box-shadow:0 4px 32px rgba(0,0,0,.08),0 1px 3px rgba(0,0,0,.04);border:1px solid rgba(0,0,0,.05);}
        .login-card-header{text-align:center;margin-bottom:2rem;}
        .admin-badge{display:inline-flex;align-items:center;gap:6px;background:#eff6ff;color:var(--primary);border:1px solid #bfdbfe;font-size:.73rem;font-weight:700;letter-spacing:1px;text-transform:uppercase;padding:4px 12px;border-radius:50px;margin-bottom:1rem;}
        .login-title{font-size:1.55rem;font-weight:800;color:#0f172a;margin-bottom:.35rem;line-height:1.2;}
        .login-subtitle{font-size:.875rem;color:#64748b;}
        .lbl{font-size:.83rem;font-weight:700;color:#374151;margin-bottom:.45rem;display:block;}
        .input-wrap{position:relative;}
        .iicon{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:1rem;pointer-events:none;}
        .finput{width:100%;padding:11px 14px 11px 42px;border:1.5px solid #e2e8f0;border-radius:12px;font-size:.9rem;font-family:inherit;color:#1e293b;background:#f8fafc;transition:border-color .2s,background .2s,box-shadow .2s;outline:none;}
        .finput:focus{border-color:var(--primary);background:#fff;box-shadow:0 0 0 3px rgba(0,114,206,.12);}
        .pw-btn{position:absolute;right:13px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#94a3b8;font-size:1rem;padding:0;line-height:1;transition:color .2s;}
        .pw-btn:hover{color:var(--primary);}
        .btn-login{width:100%;padding:13px;border-radius:12px;border:none;background:linear-gradient(135deg,var(--primary) 0%,#0056a8 100%);color:#fff;font-size:.95rem;font-weight:700;font-family:inherit;cursor:pointer;transition:all .25s ease;display:flex;align-items:center;justify-content:center;gap:8px;box-shadow:0 6px 20px rgba(0,114,206,.3);}
        .btn-login:hover{background:linear-gradient(135deg,var(--primary-dark) 0%,#003d82 100%);transform:translateY(-1px);box-shadow:0 10px 28px rgba(0,114,206,.38);}
        .btn-login:active{transform:translateY(0);}
        .alert-err{background:#fef2f2;border:1px solid #fecaca;color:#b91c1c;border-radius:10px;padding:10px 14px;font-size:.85rem;font-weight:600;display:flex;align-items:center;gap:8px;margin-bottom:1.25rem;}
        .divider{height:1px;background:#f1f5f9;margin:1.5rem 0;}
        .sec-note{display:flex;align-items:center;justify-content:center;gap:6px;font-size:.775rem;color:#94a3b8;font-weight:500;}

        @media(max-width:768px){
            html,body{overflow:auto;}
            .login-page{flex-direction:column;min-height:100vh;}
            .brand-panel{width:100%;padding:2rem 1.75rem 2.5rem;}
            .brand-body{padding:1.5rem 0;}
            .brand-headline{font-size:1.5rem;}
            .feature-list{display:grid;grid-template-columns:1fr 1fr;gap:.6rem;}
            .login-panel{padding:1.5rem;}
            .login-card{padding:2rem 1.5rem;border-radius:16px;}
        }
        @media(max-width:400px){.feature-list{grid-template-columns:1fr;}}
    </style>
</head>
<body>
<div class="login-page">

    {{-- LEFT BRAND PANEL --}}
    <div class="brand-panel">
        <div class="orb-bottom"></div>

        <div class="brand-top">
            <div class="brand-logo">
                @if ($settings?->logo_path)
                    <img src="{{ asset('storage/' . $settings->logo_path) }}" alt="{{ $settings->site_name ?? 'Enerix Solutions' }}">
                @else
                    <img src="{{ asset('images/enerix/logo-white.svg') }}" alt="Enerix Solutions">
                @endif
            </div>
        </div>

        <div class="brand-body">
            <span class="brand-tagline"><i class="bi bi-shield-lock-fill"></i> Admin Portal</span>
            <h1 class="brand-headline">Manage Your<br><span class="atext">Engineering Hub</span></h1>
            <p class="brand-desc">Control projects, solutions, industries, and site content from a single powerful admin dashboard.</p>
            <ul class="feature-list">
                <li><span class="feat-icon"><i class="bi bi-grid-3x3-gap-fill"></i></span> Dashboard Overview</li>
                <li><span class="feat-icon"><i class="bi bi-folder2-open"></i></span> Project Management</li>
                <li><span class="feat-icon"><i class="bi bi-lightning-charge-fill"></i></span> Solutions &amp; Services</li>
                <li><span class="feat-icon"><i class="bi bi-gear-fill"></i></span> Site Settings</li>
            </ul>
        </div>

        <div class="brand-footer">&copy; {{ date('Y') }} {{ $settings->site_name ?? 'Enerix Solutions' }}. All rights reserved.</div>
    </div>

    {{-- RIGHT LOGIN PANEL --}}
    <div class="login-panel">
        <div class="login-card">

            <div class="login-card-header">
                <div class="admin-badge"><i class="bi bi-person-badge-fill"></i> Administrator</div>
                <h2 class="login-title">Welcome Back</h2>
                <p class="login-subtitle">Sign in to your admin dashboard</p>
            </div>

            @if ($errors->any())
                <div class="alert-err"><i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                <div class="mb-4">
                    <label class="lbl" for="admin_email">Email Address</label>
                    <div class="input-wrap">
                        <input id="admin_email" name="email" type="email" class="finput"
                               value="{{ old('email') }}"
                               placeholder="Enter your email address" required autocomplete="email">
                        <i class="bi bi-envelope iicon"></i>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="lbl" for="admin_password">Password</label>
                    <div class="input-wrap">
                        <input id="admin_password" name="password" type="password" class="finput"
                               placeholder="Enter your password" required autocomplete="current-password"
                               style="padding-right:42px;">
                        <i class="bi bi-lock iicon"></i>
                        <button type="button" class="pw-btn" onclick="togglePw()" aria-label="Toggle password">
                            <i class="bi bi-eye" id="pwIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-login" id="loginBtn">
                    <i class="bi bi-box-arrow-in-right"></i> Sign In to Dashboard
                </button>
            </form>

            <div class="divider"></div>
            <div class="sec-note">
                <i class="bi bi-shield-check" style="color:#22c55e;"></i>
                Secured with encrypted session authentication
            </div>

        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePw() {
        const i = document.getElementById('admin_password');
        const ico = document.getElementById('pwIcon');
        i.type = i.type === 'password' ? 'text' : 'password';
        ico.className = i.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
    }
    document.querySelector('form').addEventListener('submit', function () {
        const btn = document.getElementById('loginBtn');
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span> Signing in...';
        btn.disabled = true;
    });
</script>
</body>
</html>

