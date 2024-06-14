<?php
session_start();

// if (!isset($_SESSION['user_id'])) {
//   // User is not logged in, redirect to login page
//   header('Location: login.php');
//   exit();
// }
$conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

// // Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



?>

<head>
  <link rel='stylesheet' href="styles/layouts/index.scss">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
  <script src="https://unpkg.com/htmx.org@1.9.12" integrity="sha384-ujb1lZYygJmzgSwoxRggbCHcjc0rB2XoQrxeTUQyRjrOnlCoYta87iKBWq3EsdM2" crossorigin="anonymous"></script>
  <title>VT S4 INTER</title>

</head>

<?php require 'components/layout/navbar.php' ?>

<body>
  <section class="hero is-halfheight">
    <div class="hero-body is-justify-content-center">
      <div class="">
        <p class="title">aimtop </p>
      </div>
    </div>

  </section>

  <div class="container box">
    <div class="is-flex is-justify-content-center">
      <button class="button is-link is-rounded is-outlined">Discord</button>
      <button class="button is-link is-rounded is-outlined">Twitter</button>
    </div>

  </div>

  <section class="container">
    <div class="columns">
      <div class="column">
        <div class="card">
          <header class="card-header">
            <p class="card-header-title">Voltaic Season 4</p>
          </header>
          <div class="card-content">
            <div class="content">
              The latest Voltaic Season 4 Benchmarks. <br /><br />
              <a href="http://twitter.com/voltaichq target='_blank'">@Voltaic</a>.
            </div>
          </div>
          <footer class="card-footer">
            <a href="benchmarks/vt4_novice.php" class="card-footer-item"><button class="button is-success">Novice</button></a>
            <a href="#" class="card-footer-item"><button class="button is-warning">Intermediate</button></a>
            <a href="#" class="card-footer-item"><button class="button is-danger" disabled>Advanced</button></a>
          </footer>
        </div>
      </div>

      <div class="column">
        <div class="card">
          <header class="card-header">
            <p class="card-header-title">Work in progress...</p>
          </header>
          <div class="card-content">
            <div class="content">

              <progress class="progress is-success" value="60" max="100">
                60%
              </progress>
            </div>
          </div>
          <footer class="card-footer">
            <a aria-disabled="true" class="card-footer-item is-warning">Soon</a>
          </footer>
        </div>
      </div>

      <div class="column">
        <div class="card">
          <header class="card-header">
            <p class="card-header-title">Work in progress...</p>
          </header>
          <div class="card-content">
            <div class="content">
              <progress class="progress is-link" value="15" max="100">
                15%
              </progress>
            </div>
          </div>
          <footer class="card-footer">
            <a aria-disabled="true" class="card-footer-item">Soon</a>
          </footer>
        </div>
      </div>
    </div>
  </section>

  </div>

  <section class="section is-medium content">
    <p><strong>aimtop</strong> is a non-profit project to help the community improve in FPS games. Everything is free and open-source. I don't want to make a second Voltaic. This project can be treated as a repository of materials prepared by experienced players.</p>
    <blockquote>
      The entire project is carried out as a hobby. I create everything myself and I do it for fun, not for money. The website's code may be weak, but all I care about is helping others develop.
    </blockquote>

  </section>


</body>