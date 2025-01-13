<?php

declare(strict_types=1);

?>

<!doctype html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='description'
          content='Transfermate PHP Test by Mario Joseph Esteban.'>
    <meta name='keywords' content='Books, Authors, Mario Joseph Esteban, Transfermate'>
    <meta name='author' content='Mario Joseph Esteban'>
    <title>Transfermate PHP Test by Mario Joseph Esteban</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            min-height: 100vh;
            background-color: whitesmoke;
        }

        table {
            width: 90%;
            max-width: 800px;
            border-collapse: collapse;
            margin: 20px auto;
            background: white;
        }

        th, td {
            text-align: left;
            padding: 12px;
            border: 1px solid #ddd;
        }

        th {
            background-color: black;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        @media (max-width: 600px) {
            table {
                font-size: 14px;
            }

            th, td {
                padding: 8px;
            }
        }

        form {
            display: flex;
            justify-content: center;
            margin: 20px;
            max-width: 800px;
        }

        form label {
            flex: 1;
            display: flex;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }

        header h1 {
            flex: 1;
            margin: 0;
        }

        header p {
            flex: 1;
            text-align: right;
            margin: 0;
        }

        input[type='text'] {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        button[type='submit'] {
            padding: 10px 20px;
            border: none;
            background-color: black;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button[type='submit']:hover {
            background-color: black;
        }

        /* Your existing CSS styles */
        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .slide-in {
            animation: slideIn 0.5s ease-out;
        }
    </style>
    <script>
        console.log('Hello World!');

        document.addEventListener('DOMContentLoaded', () => {
            const rows = document.querySelectorAll('#authors tbody tr');
            rows.forEach((row, index) => {
                setTimeout(() => {
                    row.classList.add('slide-in');
                }, index * 75)
            });
        });
    </script>
</head>
<body>
<main>
    <header>
        <h1>Transfermate PHP Test</h1>
        <p>By Mario Joseph Esteban</p>
    </header>
    <form method='GET' action=''>
        <label>
            <input type='text' name='author' placeholder='Search by author'
                   value="<?= htmlspecialchars($_GET['author'] ?? '', ENT_QUOTES) ?>">
        </label>
        <button type='submit'>Search</button>
    </form>
    <table id="authors">
        <thead>
        <tr>
            <th>Author</th>
            <th>Book</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($authors) && !empty($authors->current())) : ?>
            <?php foreach ($authors as $author) : ?>
                <tr>
                    <td><?= htmlspecialchars($author->name, ENT_QUOTES) ?></td>
                    <td><?= htmlspecialchars($author->book, ENT_QUOTES) ?></td>
                </tr>
            <?php endforeach ?>
        <?php else : ?>
            <tr>
                <td colspan="2">No authors found.</td>
            </tr>
        <?php endif ?>
        </tbody>
    </table>
</main>
</body>
</html>