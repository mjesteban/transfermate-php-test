<?php

declare(strict_types=1);

?>

<!doctype html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='description'
          content='Popular books and their authors.'>
    <meta name='keywords' content='Books, Authors>
    <meta name=' author
    ' content='Mario Joseph Esteban'>
    <title>Famous Books and Their Authors</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f9;
        }

        table {
            width: 90%;
            max-width: 800px;
            border-collapse: collapse;
            margin: 20px auto;
            background: #ffffff;
        }

        th, td {
            text-align: left;
            padding: 12px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #6c63ff;
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
            border-radius: 4px 0 0 4px;
            font-size: 16px;
        }

        button[type='submit'] {
            padding: 10px 20px;
            border: none;
            background-color: #6c63ff;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 0 4px 4px 0;
        }

        button[type='submit']:hover {
            background-color: #5753d9;
        }
    </style>
</head>
<body>
<main>
    <header>
        <h1>Transfermate PHP Test</h1>
        <!--        <p>Discover some of the most popular books and the brilliant authors behind them.</p>-->
        <p>By Mario Joseph Esteban</p>
    </header>
    <form method='GET' action=''>
        <label>
            <input type='text' name='search' placeholder='Search by author'
                   value="<?= htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES) ?>">
        </label>
        <button type='submit'>Search</button>
    </form>
    <table>
        <thead>
        <tr>
            <th>Author</th>
            <th>Book</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($authors)) : ?>
            <?php foreach ($authors as $author) : ?>
                <tr>
                    <td><?= $author->name ?></td>
                    <td><?= $author->book ?></td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
        </tbody>
    </table>
</main>
</body>
</html>