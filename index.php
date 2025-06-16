<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>COMPRESSIFY</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&display=swap" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(135deg, #f5f1e9 0%, #fff9f5 40%, #ffe1dc 75%, #ffffff 100%);
      min-height: 100vh;
      margin: 0;
      font-family: Georgia, serif;
      border-bottom: 8px solid black; /* Thicker border */
    }

    .navbar {
      height: 56px;
      padding: 0 1rem;
      font-family: 'Josefin Sans', sans-serif;
      font-weight: 700;
      letter-spacing: 1.5px;
      text-transform: uppercase;
    }

    .navbar-brand {
      font-size: 3rem;
      font-weight: 700;
      color: black !important;
      font-family: 'Josefin Sans', sans-serif;
      text-transform: uppercase;
      display: flex;
      align-items: center;
      gap: 0.3rem;
      opacity: 0;
      animation: fadeIn 1.5s ease forwards;
      transition: transform 0.3s ease-in-out;
    }

    /* Lift up "Compressify" on hover */
    .navbar-brand:hover {
      transform: translateY(-8px);
    }

    .card-header {
      background: linear-gradient(135deg, #000000, #1a1a1a);
      color: white;
      font-family: 'Josefin Sans', sans-serif;
      font-size: 1.8rem;
      text-transform: uppercase;
      font-weight: 700;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 0.6rem;
      position: relative;
      overflow: hidden;
      transition: transform 0.3s ease-in-out;
    }

    /* Lift up the card header on hover */
    .card-header:hover {
      transform: translateY(-8px);
    }

    /* Shimmer effect on card header */
    .card-header::before {
      content: "";
      position: absolute;
      top: 0; left: -150%;
      width: 50%;
      height: 100%;
      background: linear-gradient(120deg, transparent, rgba(255,255,255,0.6), transparent);
      transform: skewX(-20deg);
      animation: shimmer 2.5s infinite;
    }

    .card {
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
      border-radius: 8px;
      transition: box-shadow 0.3s ease, transform 0.3s ease, background-color 0.3s ease;
      background-color: white;
      font-family: Georgia, serif;
      opacity: 0;
      animation: fadeIn 1.8s ease forwards;
      position: relative;
      overflow: hidden;
    }

    /* Lift up the card on hover */
    .card:hover {
      box-shadow: 0 24px 60px rgba(0, 0, 0, 0.35);
      transform: translateY(-12px) scale(1.08);
      background-color: #fff1f1;
    }

    /* Oval-shaped, larger buttons with zoom animation */
    .btn-danger {
      background: linear-gradient(45deg, #dc3545, #a71d2a);
      border-color: #dc3545;
      font-family: 'Montserrat', sans-serif;
      font-weight: 700;
      font-size: 1.3rem;
      letter-spacing: 1.2px;
      padding: 14px 50px;
      border-radius: 50px;
      transition: box-shadow 0.3s ease, transform 0.2s ease;
      display: inline-flex;
      align-items: center;
      gap: 0.7rem;
      margin: 1.5rem;
      animation: zoomInOut 2.5s ease-in-out infinite;
    }

    .btn-danger:hover {
      background: linear-gradient(45deg, #c82333, #8f1b23);
      border-color: #bd2130;
      box-shadow: 0 0 20px 6px rgba(220, 53, 69, 0.7);
      transform: scale(1.15);
    }

    @keyframes shimmer {
      0% { left: -150%; }
      100% { left: 150%; }
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes zoomInOut {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
    <div class="container-fluid justify-content-center">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <i class="bi bi-file-earmark-arrow-up-fill"></i> COMPRESSIFY
      </a>
    </div>
  </nav>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="card">
          <div class="card-header">
            <i class="bi bi-file-text-fill"></i> OPTIMISE YOUR FILES
          </div>
          <div class="card-body text-center">
            <p>Compressify reduces your file size without losing a single byte.</p>
            <p>It also decompresses your optimized files perfectly every time.</p>
            <!-- <p>Decomprssion and Compresion just a click away!</p> -->
          </div>
        </div>
      </div>
    </div>

    <!-- Zooming buttons moved outside the card -->
    <div class="row justify-content-center mt-4">
      <div class="col-md-6 text-center">
        <a href="compress-text.php" class="btn btn-danger fw-bold">
          <i class="bi bi-arrow-down-circle-fill"></i> Compress
        </a>
        <a href="decompress-text.php" class="btn btn-danger fw-bold">
          <i class="bi bi-arrow-up-circle-fill"></i> Decompress
        </a>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
