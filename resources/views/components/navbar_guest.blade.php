<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jouets Tétouan - Navbar</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 5%;
            background: white;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: #e63a28; /* Rouge de votre thème */
            cursor: pointer;
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo img {
            height: 40px;
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
            color: #e63a28;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: #e63a28;
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .auth-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .login-btn {
            padding: 0.6rem 1.5rem;
            background: transparent;
            color: #e63a28;
            border: 2px solid #e63a28;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .login-btn:hover {
            background: rgba(230, 58, 40, 0.1);
        }

        .register-btn {
            padding: 0.6rem 1.5rem;
            background: linear-gradient(135deg, #e63a28, #ff6b6b);
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(230, 58, 40, 0.3);
            text-decoration: none;
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(230, 58, 40, 0.4);
            background: linear-gradient(135deg, #d63422, #e63a28);
        }

        .menu-toggle {
            display: none;
            cursor: pointer;
            font-size: 1.5rem;
        }

        @media (max-width: 768px) {
            nav {
                padding: 1rem 5%;
            }
            .nav-links {
                position: fixed;
                top: 80px;
                left: -100%;
                width: 100%;
                height: calc(100vh - 80px);
                background: white;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 2rem;
                transition: left 0.3s ease;
            }
            .nav-links.active {
                left: 0;
            }
            .auth-buttons {
                display: none;
            }
            .menu-toggle {
                display: block;
            }
            .mobile-auth {
                display: flex;
                flex-direction: column;
                gap: 1rem;
                margin-top: 2rem;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <nav>
        <a href="{{ route('acceuil') }}" class="logo">
            <img src="{{ asset('images/lo3baty.jpg') }}" alt="Logo Jouets Tétouan">
            Lo3baty
        </a>
        
        <ul class="nav-links">
            <li><a href="#hero">Accueil</a></li>
            <li><a href="#annonces">Annonces</a></li>
            <li><a href="#how-it-works">Comment ça marche</a></li>
            <li><a href="#team">Notre équipe</a></li>
            <li><a href="#testimonials">Avis</a></li>
            
           
        </ul>
        
        <div class="auth-buttons">
            <a href="{{ route('login') }}" class="login-btn">Connexion</a>
            <a href="{{ route('register') }}" class="register-btn">Inscription</a>
        </div>
        
        <div class="menu-toggle">
            <i class="fas fa-bars"></i>
        </div>
    </nav>

    <script>
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.nav-links').classList.toggle('active');
        });
    </script>
</body>
</html>