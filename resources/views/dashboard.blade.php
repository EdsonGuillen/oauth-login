<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #1a1a2e, #16213e, #0f3460);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            padding: 2.5rem;
            border-radius: 16px;
            width: 420px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            color: white;
        }
        .avatar {
            width: 90px; height: 90px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255,255,255,0.2);
            margin-bottom: 1rem;
        }
        .avatar-placeholder {
            width: 90px; height: 90px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1rem;
        }
        h1 { font-size: 1.5rem; margin-bottom: 0.3rem; }
        .badge {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        .badge-discord { background: #5865F2; }
        .badge-github  { background: #24292e; border: 1px solid rgba(255,255,255,0.2); }
        .info-grid {
            background: rgba(255,255,255,0.05);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            text-align: left;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            font-size: 0.9rem;
        }
        .info-row:last-child { border-bottom: none; }
        .info-label { color: rgba(255,255,255,0.5); }
        .info-value { color: #fff; font-weight: 500; max-width: 220px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        form button {
            background: rgba(255,80,80,0.2);
            border: 1px solid rgba(255,80,80,0.4);
            color: #ff8080;
            padding: 10px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.95rem;
            transition: background 0.2s;
        }
        form button:hover { background: rgba(255,80,80,0.35); }
    </style>
</head>
<body>
    <div class="card">
        @if($user->avatar)
            <img src="{{ $user->avatar }}" alt="Avatar" class="avatar">
        @else
            <div class="avatar-placeholder">👤</div>
        @endif

        <h1>¡Hola, {{ $user->name }}!</h1>
        <span class="badge badge-{{ $user->provider }}">
            {{ ucfirst($user->provider) }}
        </span>

        <div class="info-grid">
            <div class="info-row">
                <span class="info-label">Email</span>
                <span class="info-value">{{ $user->email }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Provider ID</span>
                <span class="info-value">{{ $user->provider_id }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Proveedor</span>
                <span class="info-value">{{ ucfirst($user->provider) }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Miembro desde</span>
                <span class="info-value">{{ $user->created_at->format('d/m/Y') }}</span>
            </div>
        </div>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
    </div>
</body>
</html>
