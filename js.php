<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Form GET with JavaScript</title>
</head>

<body>
    <form id="myForm">
        <label for="norek">norek:</label>
        <input type="text" id="norek" required><br><br>

        <input type="submit" value="Submit">
    </form>

    <script>
        document.getElementById('myForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah form mengirim data secara default

            // Ambil nilai dari input form
            const norek = document.getElementById('norek').value;

            // URL server luar
            const url = 'https://api.siunbin.com/api/v1/bank/rekening/saldo/${encodeURIComponent(norek)}';

            // Redirect ke URL dengan query string
            window.location.href = url;
        });
    </script>
</body>

</html>