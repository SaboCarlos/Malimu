<!DOCTYPE html>
<html>
<head>
    <title>Newsletter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
            text-align: justify;
            margin: 0 0 20px;
        }

        .image-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .image-container img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        footer {
            font-size: 14px;
            color: #888;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Olá!</h1>
    <p>{!! $content !!}</p>
    @if($image)
        <div class="image-container">
            <img src="{{ asset('storage/' . $image) }}" alt="Imagem da Newsletter">
        </div>
    @endif

    <p>Obrigado por se inscrever em nossa newsletter.</p>

    
    <footer>
        <p>&copy; 2024 Malimu. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
