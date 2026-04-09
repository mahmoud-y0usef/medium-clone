<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify your email – Medium</title>
    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background: #f7f4ed;
            font-family: 'Figtree', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        nav {
            border-bottom: 1px solid #d9d5cc;
            background: #f7f4ed;
            padding: 0 2rem;
            height: 65px;
            display: flex;
            align-items: center;
        }
        nav a {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: #111827;
            text-decoration: none;
        }

        /* Card */
        .wrap {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        .card {
            background: #fff;
            border: 1px solid #e8e4de;
            border-radius: 1rem;
            padding: 2.75rem 2.5rem;
            width: 100%;
            max-width: 480px;
            text-align: center;
        }

        /* Mail icon */
        .icon-wrap {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #f0fdf4;
            border: 1.5px solid #bbf7d0;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }

        h1 {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: .6rem;
        }
        p {
            font-size: .9rem;
            color: #6b7280;
            line-height: 1.65;
            margin-bottom: 1.75rem;
        }

        /* Success banner */
        .success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: .5rem;
            padding: .65rem 1rem;
            font-size: .82rem;
            color: #15803d;
            margin-bottom: 1.25rem;
            text-align: left;
        }

        /* Buttons */
        .btn-primary {
            display: block;
            width: 100%;
            padding: .8rem;
            background: #111827;
            color: #fff;
            border: none;
            border-radius: 9999px;
            font-size: .9rem;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            margin-bottom: .85rem;
            transition: background .15s;
        }
        .btn-primary:hover { background: #1a8917; }

        .btn-ghost {
            background: none;
            border: none;
            font-size: .85rem;
            color: #9ca3af;
            cursor: pointer;
            font-family: inherit;
            text-decoration: underline;
            transition: color .15s;
        }
        .btn-ghost:hover { color: #111827; }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Medium</a>
    </nav>

    <div class="wrap">
        <div class="card">

            <!-- Mail icon -->
            <div class="icon-wrap">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                     stroke="#16a34a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                    <path d="M2 7l10 7 10-7"/>
                </svg>
            </div>

            <h1>Check your inbox</h1>
            <p>
                We sent a verification link to your email address.<br>
                Click the link to activate your account. If you did not receive it, request a new one below.
            </p>

            @if (session('status') == 'verification-link-sent')
            <div class="success">
                A new verification link has been sent to your email address.
            </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn-primary">Resend verification email</button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-ghost">Sign out</button>
            </form>

        </div>
    </div>
</body>
</html>
