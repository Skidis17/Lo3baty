<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kider - Navbar</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f9f9f9;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 5%;
            background: white;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 100;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: #FF6B6B;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links li {
            position: relative;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.3s ease;
            padding: 0.5rem 0;
        }

        .nav-links a:hover {
            color: #FF6B6B;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: #FF6B6B;
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .join-btn {
            padding: 0.8rem 1.8rem;
            background: linear-gradient(135deg, #FF6B6B, #FF8E8E);
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
            text-decoration: none; 
            display: inline-block; 
        }

        .join-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
        }

        @media (max-width: 768px) {
            nav {
                padding: 1rem 5%;
            }
            .nav-links {
                display: none;
            }
            .join-btn {
                padding: 0.6rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('accueil') }}" class="logo">Kider</a>
        <ul class="nav-links">
            <li><a href="{{ route('accueil') }}">Accueil</a></li>
            <li><a href="{{ route('annonces') }}">Annonces</a></li>
        </ul>
        <a href="{{ route('register') }}" class="join-btn">Join Us</a>
    </nav>
</body>
</html>