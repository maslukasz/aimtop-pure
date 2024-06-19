<?php
session_start();

// if (!isset($_SESSION['user_id'])) {
//   // User is not logged in, redirect to login page
//   header('Location: login.php');
//   exit();
// }
$conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


?>

<head>
  <link rel='stylesheet' href="styles/layouts/index.scss">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
  <title>aimtop [alpha]</title>

</head>

<?php require 'components/layout/navbar.php' ?>

<body>
  <section class="hero is-fullheight">
    <div class="hero-body has-text-centered">
      <div class="container">
        <p class="title has-text-success is-family-monospace pb-5">aimtop </p>
        <p class="subtitle"><strong class="has-text-link is-family-monospace"><a href='https://x.com/aimtop_hub' target='_blank'>aimtop</a></strong> is a <i>non-profit project</i> where <span class='is-underlined has-text-danger'>passion plays a major role</span>. We aim to help players improve in FPS games. We do not intend to duplicate the efforts of existing aim groups. Instead, we focus on <span class='has-text-success'>gathering materials</span> prepared by experienced players and consolidating them in <span class='has-text-warning'>one place</span>. There are so many groups and guides out there that it can be overwhelming, so we want to assist you in navigating this abundance of information.</p>
      </div>
    </div>
  </section>

  <section class="container section has-text-centered">
    <h1 class="title mb-6 has-text-warning-light">Benchmarks tool</h1>
    <div class="columns">
      <div class="column">
        <div class="card">
          <header class="card-header">
            <p class="card-header-title">Voltaic Season 4</p>
          </header>
          <div class="card-content">
            <div class="content">
              <span class="tag is-warning">KovaaK</span><br><br>
              The latest <a href="http://twitter.com/voltaichq target=' _blank'">@Voltaic</a> Season 4 Benchmarks
            </div>
          </div>
          <footer class="card-footer">
            <a href="benchmarks/vt4_novice.php" class="card-footer-item"><button class="button is-success">Novice</button></a>
            <a href="benchmarks/vt4_intermediate.php" class="card-footer-item"><button class="button is-warning">Intermediate</button></a>
            <a href="benchmarks/vt4_advanced.php" class="card-footer-item"><button class="button is-danger">Advanced</button></a>
          </footer>
        </div>
      </div>

      <div class="column">
        <div class="card">
          <header class="card-header">
            <p class="card-header-title">Revosect x Aimlabs</p>
          </header>
          <div class="card-content">
            <div class="content">
              <span class="tag is-link">Aimlab</span><br><br>
              <a href="https://x.com/Revosect target=' _blank'">@Revosect</a> x <a href="https://x.com/aimlab target=' _blank'">@Aimlabs</a> Benchmarks
            </div>
          </div>
          <footer class="card-footer">
            <a href="#" class="card-footer-item"><button class="button is-success" disabled>Novice</button></a>
            <a href="benchmarks/ra/al_medium.php" class="card-footer-item"><button class="button is-warning">Medium</button></a>
            <a href="benchmarks/ra/al_hard.php" class="card-footer-item"><button class="button is-danger">Advanced</button></a>
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

  <section class="section content is-medium">
    <blockquote>
      From the author - the site is open-source. The code is not written by a professional. I run this project as a hobby, on the side. If there is ever any form of monetization, it will only be to cover hosting costs.
    </blockquote>
  </section>

  <?php require_once 'components/layout/footer.php' ?>

</body>