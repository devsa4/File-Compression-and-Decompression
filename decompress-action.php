<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit("Error: Post request required.");
}

$tmpfile = realpath($_FILES['binfile']['tmp_name']);
if (!$tmpfile || !file_exists($tmpfile)) {
    exit("Error: Input file does not exist.");
}
$originalName = pathinfo($_FILES['binfile']['name'], PATHINFO_FILENAME);
$outputFile = realpath(__DIR__) . "/text-files/" . $originalName . ".txt";
$command = escapeshellcmd("C:/xampp/htdocs/PBL/Backend/Decompression.exe \"$tmpfile\" \"$outputFile\"");
shell_exec($command);


if (!file_exists($outputFile) || filesize($outputFile) == 0) {
    exit("Error: Output file was not created correctly.");
}

$originalSizeKB = number_format(filesize($tmpfile) / 1024, 2);
$outputSizeKB = number_format(filesize($outputFile) / 1024, 2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Decompress File</title>


    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&display=swap" rel="stylesheet" />
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

        @keyframes zoomInOut {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .btn-shine {
            animation: zoomInOut 3s ease-in-out infinite;
        }

        .thankyou-gif {
            max-width: 400px;
            width: 100%;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        /* Fade-in animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 1s ease-out forwards;
            opacity: 0;
        }
    </style>
</head>
<body>

<div class="card-style fade-in">
    <h3>Your file has been successfully decompressed.<br>Thanks for using our website!</h3>

    <p class="size-info">Compressed file size: <strong><?php echo $originalSizeKB; ?> KB</strong></p>
    <p class="size-info">Decompressed file size: <strong><?php echo $outputSizeKB; ?> KB</strong></p>

    <a 
        class="btn btn-outline-success btn-lg btn-shine" 
        download="<?php echo basename($outputFile); ?>" 
        href="text-files/<?php echo basename($outputFile); ?>"
    >
        <i class="bi bi-download"></i> Download your text file
    </a>
</div>

<img 
    class="thankyou-gif fade-in"
    src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExNWFmbHppM3k1amJ0ZWVpb2UyejkyaGZ1MnZlZGVsM2Q0MTZ1Z3EydSZlcD12MV9zdGlja2Vyc19zZWFyY2gmY3Q9cw/pVavmCDtgkwnuCn2rF/giphy.gif" 
    alt="Thank You Animation" 
/>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
