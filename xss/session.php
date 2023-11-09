<?php
require_once "app.php";
if (isset($_POST["email"])) {
    $post = $_POST;
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include('app/views/components/head.php') ?>

<body>
    <main id="main" class="d-flex justify-content-center">
        <div class="w-50 mt-3 p-5 bg-light">
            <h3>XSS</h3>
            <ul>
                <li>
                    &lt;script&gt;
                    var cookies = document.cookie;
                    cookies.trim();
                    const array = cookies.split(';');
                    console.log(array);
                    sessions = {};
                    array.forEach(function(values) {
                        var content = values.split('=');
                        var key = content[0].trim();
                        var value = content[1].trim();
                        sessions[key] = value;
                    });
                    var p = document.createElement('p');
                    p.innerHTML = cookies;
                    document.getElementById('result').append(p);

                    var p = document.createElement('p');
                    p.id = 'php-session';
                    p.innerHTML = sessions.PHPSESSID;
                    document.getElementById('result').append(p);
                    &lt;/script&gt;
                </li>
                <li>

                </li>
            </ul>
            <h2 class="h2 mb-3 fw-normal text-center">Search Email</h2>
            <form id="form" action="" method="post">
                <div class="form-floating mb-2">
                    <input id="email" type="text" name="email" value="" class="form-control">
                    <label for="" class="form-label">Email</label>
                </div>
                <button class="w-100 btn btn-primary">Search</button>
            </form>

            <h2>結果</h2>
            <p id="result">
                <?= $post['email'] ?>
            </p>
        </div>
        <script src="js/default.js"></script>
    </main>
</body>

</html>