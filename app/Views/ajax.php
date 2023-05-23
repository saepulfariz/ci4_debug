<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX DEBUG</title>
</head>

<body>
    <h1>AJX DEBUG</h1>

    <script>
        function ajaxGet() {
            var ajax = new XMLHttpRequest();
            ajax.responseType = 'json';
            ajax.addEventListener('load', () => {
                if (ajax.status >= 200 && ajax.status <= 226) {
                    console.log(ajax.response);
                } else {
                    console.log('Galat');
                }
            })
            ajax.open('GET',
                '<?= base_url(); ?>get'
            );
            ajax.send();
        }

        setInterval(ajaxGet, 5000);
    </script>
</body>

</html>