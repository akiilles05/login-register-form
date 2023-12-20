<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];
    $email = $_POST["email"];

    // Ellenőrizd a kritériumokat

    // Adatbázis kapcsolódás
    $conn = new mysqli("localhost", "root", "", "website");

    // Ellenőrizd a felhasználónév létezését
    $checkUsernameQuery = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $checkUsernameQuery->bind_param("s", $username);
    $checkUsernameQuery->execute();
    $result = $checkUsernameQuery->get_result();

    if ($result->num_rows > 0) {
        header('Location: ./error.html');
    } else {
        // Jelszó hashelése
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Adatok mentése az adatbázisba
        $insertQuery = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $insertQuery->bind_param("sss", $username, $hashedPassword, $email);

        if ($insertQuery->execute()) {
            header('Location: ./success.html');
        } else {
            header('Location: ./error.html');
        }

        $insertQuery->close();
    }

    $checkUsernameQuery->close();
    $conn->close();
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Regisztráció</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />


</head>

<body class="bg-blue-700 h-[100vh] place-items-center">

    <section class="flex justify-center items-center h-full">
        <div class="r px-6 py-8 mx-auto w-[75%] lg:py-0">


            <div class="bg-gray-50 rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Regisztráció
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="/" id="form" method="POST" onsubmit="return validateForm()">
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Felhasználónév</label>
                            <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="User1234">
                            <div class="error" id="name-error"></div>
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com">

                            <div class="error" id="email-error"></div>

                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jelszó</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <div class="error" id="password-error"></div>

                        </div>
                        <div>
                            <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jelszó
                                megerősítés</label>
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <div class="error" id="password2-error"></div>
                        </div>
                        <button type="submit" id="successButton" data-modal-target="successModal" data-modal-toggle="successModal" class="w-full text-white bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Regisztrálás</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>

</body>

</html>