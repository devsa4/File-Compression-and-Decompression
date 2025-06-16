<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit("Post request required");
}

$tmpfile = realpath($_FILES['textfile']['tmp_name']);
if (!file_exists($tmpfile)) {
    exit("Error: Input file does not exist.");
}

$originalName = pathinfo($_FILES['textfile']['name'], PATHINFO_FILENAME);
$outputFile = realpath(__DIR__) . "/bin-files/" . $originalName . ".bin";
$command = escapeshellcmd("C:/xampp/htdocs/PBL/Backend/Compression.exe \"$tmpfile\" \"$outputFile\"");

shell_exec($command);

if (!file_exists($outputFile)) {
    exit("Error: Output file was not created.");
}

$originalSizeKB = number_format(filesize($tmpfile) / 1024, 2);
$outputSizeKB = number_format(filesize($outputFile) / 1024, 2);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Compress Text File</title>

    <!-- Josefin Sans font -->
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        body {
            background: #fff9f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            gap: 20px;
            opacity: 0;
            animation: fadeIn 2s ease forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        .card-style {
            background-color: #ffffff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }

        h3 {
            font-family: 'Josefin Sans', sans-serif;
            color: #000;
            font-weight: 700;
            margin-bottom: 30px;
        }

        p.size-info {
            font-weight: 600;
            margin-bottom: 15px;
            color: #444;
        }

        .btn-shine {
            animation: zoomInOut 3s ease-in-out infinite;
            position: relative;
            overflow: hidden;
            z-index: 0;
        }

        .btn-shine::before {
            content: "";
            position: absolute;
            top: 0;
            left: -75%;
            width: 50%;
            height: 100%;
            background: linear-gradient(
                120deg,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.6) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            transform: skewX(-20deg);
            animation: shine 2.5s infinite;
            z-index: 1;
        }

        .btn-shine > * {
            position: relative;
            z-index: 2;
        }

        @keyframes zoomInOut {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        @keyframes shine {
            0% {
                background-position: -200% 0;
            }
            100% {
                background-position: 200% 0;
            }
        }

        .thankyou-gif {
            max-width: 400px;
            width: 100%;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>

<div class="card-style">
    <h3>Your file has been successfully compressed.<br>Thanks for using our website!</h3>

    <p class="size-info">Original file size: <strong><?php echo $originalSizeKB; ?> KB</strong></p>
    <p class="size-info">Compressed file size: <strong><?php echo $outputSizeKB; ?> KB</strong></p>

    <a class="btn btn-outline-success btn-lg btn-shine" 
       download="<?php echo basename($outputFile); ?>" 
       href="bin-files/<?php echo basename($outputFile); ?>">
        <i class="bi bi-arrow-down-circle"></i> Download your file
    </a>
</div>

<img class="thankyou-gif" src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExNWFmbHppM3k1amJ0ZWVpb2UyejkyaGZ1MnZlZGVsM2Q0MTZ1Z3EydSZlcD12MV9zdGlja2Vyc19zZWFyY2gmY3Q9cw/pVavmCDtgkwnuCn2rF/giphy.gif" alt="Thank You Animation" />

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
