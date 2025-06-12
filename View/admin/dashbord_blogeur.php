<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Utilisateur</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Icônes Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f5f7fa;
      font-family: 'Segoe UI', sans-serif;
      font-size: 1rem;
    }

    /* Navbar */
    .navbar {
      background-color: #0d6efd;
    }

    .navbar-brand,
    .navbar-nav .nav-link {
      color: #fff;
      font-weight: 500;
    }

    .navbar-nav .nav-link:hover {
      color: #dbe9ff;
    }

    /* Sidebar */
    .sidebar {
      min-height: 100vh;
      background-color: #fff;
      border-right: 1px solid #dee2e6;
      padding-top: 1rem;
    }

    .sidebar .nav-link {
      color: #0d6efd;
      font-weight: 500;
      padding: 0.75rem 1rem;
    }

    .sidebar .nav-link:hover {
      background-color: #f0f4ff;
      border-radius: 0.5rem;
    }

    /* Main Content */
    .main-content {
      padding: 2rem 1rem;
      overflow-x: hidden;
    }

    h1 {
      font-size: 2rem;
    }

    /* Footer */
    .footer {
      background-color: #0d6efd;
      color: white;
      text-align: center;
      padding: 1rem;
    }

    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }
      h1 {
        font-size: 1.5rem;
      }
      body {
        font-size: 1.1rem;
      }
    }

    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    .container-fluid {
      padding: 0;
    }
  </style>
</head>
<body class="d-flex flex-column min-vh-100">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid px-3">
      <a class="navbar-brand" href="#"><i class="bi bi-speedometer2 me-2"></i>Mon Dashboard</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>

  <!-- Contenu principal avec Sidebar -->
  <div class="container-fluid">
    <div class="row gx-0">
      <!-- Sidebar (masquée sur petits écrans) -->
      <div class="col-md-3 col-lg-2 sidebar d-none d-md-block">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-house me-2"></i>Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-calendar-check me-2"></i>Réservations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-person me-2"></i>Profil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-gear me-2"></i>Paramètres</a>
          </li>
        </ul>
      </div>

      <!-- Contenu principal -->
      <main class="col-md-9 col-lg-10 main-content">
        <h1>Bienvenue sur votre tableau de bord</h1>
        <p>Vous pouvez gérer vos rendez-vous, consulter votre profil et ajuster les paramètres ici.</p>
      </main>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer mt-auto">
    <div class="container">
      <span>&copy; 2024 MonDashboard. Tous droits réservés.</span>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

