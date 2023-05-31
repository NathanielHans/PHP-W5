<?php

session_start();

require '../database.php';

//cek cookie
// if(isset ($_COOKIE["user"]) && isset($_COOKIE["key"])){
//     $id = $_COOKIE["user"];
//     $key = $_COOKIE["key"];
//     //get username
//     $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
//     $row = mysqli_fetch_assoc($result);

//     //cek cookie and username
//     if($key === hash('sha256', $row['username'])){
//         $_SESSION["login"] = true;
//     }
// }


if (isset($_SESSION["login"])) {
  header("Location: ../index.php");
  exit;
}


if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $result = mysqli_query($conn, "SELECT * FROM user WHERE Username = '$username'");
  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["Password"])) {
      //set session
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row['id_user'];
      // //set cookie
      // if(isset($_POST["remember"])){
      //     setcookie('user', $row['id'], time()+3600);
      //     setcookie('key', hash('sha256', $row['Username']), time()+3600);
      // }
      header("Location: ../index.php");
      exit;
    }
  }
  $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <!-- Section: Design Block -->
  <section class=" text-center text-lg-start">
    <style>
      .card {
        height: 100vh;
      }

      .card img {
        height: 100vh;
      }

      .rounded-t-5 {
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
      }

      @media (min-width: 992px) {
        .rounded-tr-lg-0 {
          border-top-right-radius: 0;
        }

        .rounded-bl-lg-5 {
          border-bottom-left-radius: 0.5rem;
        }
      }
    </style>
    <div class="card">
      <div class="row g-0 d-flex align-items-center">
        <div class="col-lg-4 d-none d-lg-flex">
          <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" alt="Trendy Pants and Shoes" class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
        </div>
        <div class="col-lg-8">
          <div class="card-body py-5 px-md-5">
            <form action="" method="post">
              <!-- Email input -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="username" placeholder="name@example.com">
                <label for="floatingInput">Username</label>
              </div>
              <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                <label for="floatingPassword">Password</label>
              </div>
              <?php if (isset($error)) : ?>
                <p class="text-danger">Password salah!</p>
              <?php endif; ?>
              <!-- 2 column grid layout for inline styling -->
              <div class="row mb-5">
                <div class="col d-flex justify-content-center">
                  <!-- Checkbox -->
                  <button type="submit" name="login" class="btn btn-primary btn-lg mt-4">Log in</button>
                </div>

                <div class="col">
                  <!-- Simple link -->
                  <button class="btn btn-primary btn-lg mt-4"><a href="regis.php" style="color : white;text-decoration: none;">Register</a></button>
                </div>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Design Block -->
</body>

</html>