<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>DECOMPRESS TEXT FILE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>

  <!-- Import Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&display=swap" rel="stylesheet"/>

  <style>
    body {
      font-family: Georgia, serif;
      background: linear-gradient(135deg, #f5f1e9 0%, #fff9f5 40%, #ffe1dc 75%, #ffffff 100%);
      min-height: 100vh;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .fade-in {
      animation: fadeIn 1s ease-in;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .card-style {
      background-color: #ffffff;
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      text-align: center;
    }

    .upload-area {
      border: 2px dashed #fff;
      background-color: #dc3545;
      color: #fff;
      padding: 60px 30px;
      border-radius: 10px;
      text-align: center;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .upload-area:hover, .upload-area.dragover {
      background-color: #bb2d3b;
      transform: scale(1.02);
    }

    .file-input {
      display: none;
    }

    /* Apply Josefin Sans and zoom animation to heading */
    h3 {
      font-family: 'Josefin Sans', sans-serif;
      text-transform: uppercase;
      font-weight: 700;
      animation: zoomInOut 4s ease-in-out infinite;
    }

    @keyframes zoomInOut {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }

    .btn-outline-danger {
      padding: 12px 40px;
      border-radius: 50px;
      font-weight: bold;
      color: #dc3545;
      border-color: #dc3545;
    }

    .btn-outline-danger:hover {
      background-color: #dc3545;
      color: #fff;
      border-color: #bb2d3b;
    }
  </style>
</head>
<body>

<div class="container fade-in">
  <div class="card-style">
    <h3 class="mb-4">DECOMPRESS TEXT FILE</h3>

    <form action="decompress-action.php" method="post" enctype="multipart/form-data" onsubmit="setLoadingState()">
      <div class="upload-area mb-4" id="uploadArea">
        <i class="bi bi-cloud-download-fill fs-1"></i>
        <p id="file-name" class="mt-3">Click or Drag & Drop file here</p>
        <input type="file" name="binfile" id="fileInput" class="file-input" accept=".bin" required>
      </div>

      <div class="row justify-content-center mb-3">
        <div class="col-md-4 d-flex justify-content-center">
          <button type="submit" id="startButton" class="btn btn-outline-danger">
            <i class="bi bi-arrow-down-circle-fill me-2"></i> Start
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  const uploadArea = document.getElementById('uploadArea');
  const fileInput = document.getElementById('fileInput');
  const fileNameDisplay = document.getElementById('file-name');

  // Click to select file
  uploadArea.addEventListener('click', () => {
      fileInput.click();
  });

  // Handle file selection
  fileInput.addEventListener('change', function () {
    if (fileInput.files.length > 0) {
      const file = fileInput.files[0];
      const sizeKB = (file.size / 1024).toFixed(2);
      fileNameDisplay.textContent = `Uploaded: ${file.name} (${sizeKB} KB)`;
    } else {
      fileNameDisplay.textContent = 'No file chosen';
    }
  });

  // Drag & Drop functionality
  uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.classList.add('dragover');
  });

  uploadArea.addEventListener('dragleave', () => {
    uploadArea.classList.remove('dragover');
  });

  uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('dragover');

    const files = e.dataTransfer.files;
    if (files.length > 0) {
      fileInput.files = files;
      const sizeKB = (files[0].size / 1024).toFixed(2);
      fileNameDisplay.textContent = `Uploaded: ${files[0].name} (${sizeKB} KB)`;
    }
  });

  function setLoadingState() {
    const startButton = document.getElementById('startButton');
    startButton.disabled = true;
    startButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Decompressing...';
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
