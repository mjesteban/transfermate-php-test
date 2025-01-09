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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
    </style>
</head>
<body>
<main>
    <header>
        <h1>Famous Books and Their Authors</h1>
        <p>Discover some of the most popular books and the brilliant authors behind them.</p>
    </header>
    <table>
        <thead>
        <tr>
            <th>Author</th>
            <th>Book</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>J.K. Rowling</td>
            <td>Harry Potter and the Sorcerer's Stone</td>
        </tr>
        <tr>
            <td>J.R.R. Tolkien</td>
            <td>The Lord of the Rings</td>
        </tr>
        <tr>
            <td>George Orwell</td>
            <td>1984</td>
        </tr>
        <tr>
            <td>Harper Lee</td>
            <td>To Kill a Mockingbird</td>
        </tr>
        <tr>
            <td>F. Scott Fitzgerald</td>
            <td>The Great Gatsby</td>
        </tr>
        <tr>
            <td>Jane Austen</td>
            <td>Pride and Prejudice</td>
        </tr>
        <tr>
            <td>Mark Twain</td>
            <td>The Adventures of Huckleberry Finn</td>
        </tr>
        <tr>
            <td>Ernest Hemingway</td>
            <td>The Old Man and the Sea</td>
        </tr>
        <tr>
            <td>Mary Shelley</td>
            <td>Frankenstein</td>
        </tr>
        <tr>
            <td>Herman Melville</td>
            <td>Moby-Dick</td>
        </tr>
        </tbody>
    </table>
</main>
</body>
</html>