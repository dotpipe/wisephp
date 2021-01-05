<?php //declare (strict_types = 1);

namespace wise\src\lib;

require "vendor/autoload.php";

session_start();
file_put_contents("example.txt",":):):):)");
?>
<!doctype html>
<html>
<head>

<style>
.class-list {
    border-color: midnightblue;
    color:silver;
    margin:0px;
    border-width: 2;
    padding:5;
    border-bottom-left-radius: 5px;
    border-top-left-radius: 5px;
    text-align:justify;
}
table {
    border-radius: 30px;
    width:900px;
    margin-left:auto;
    margin-right:auto;
    overflow: clip;
    overflow-x: clip;
}
</style>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Wise Framework</title>
<link href="css/multiColumnTemplate.css" rel="stylesheet" type="text/css">
<script src="./wise/src/switches/pipes.js"></script>
</head>
<body>
<div class="container">
  <header>
    <div class="primary_header">
      <h1 class="title">WISE</h1>
    </div>
    <nav class="secondary_header" id="menu">
      <ul>
        <li id="about" method="GET" ajax="article.php" insert="backoff">ABOUT</li>
        <li id="docs" method="GET" ajax="docs.php" insert="backoff">DOCUMENTATION</li>
		    <li id="git" redirect ajax="https://www.github.com/wise-penny/wise">GIT</li>
        <li class="download" mime-type="application/zip" directory="./d/" file="wisephp.zip">DOWNLOAD</li>
        <li id="issues" redirect ajax="https://github.com/wise-penny/Wise/issues">ISSUES</li>
        <li id="social" redirect ajax="https://www.twitter.com/thexiv">TWITTER</li>
      </ul>   
    </nav>
  </header>
  <section id="backoff">
    <article class="left_article">
      <h3>@wisephp</h3>
      <p>Wise is a intriguing new balance to motion and power. The more on its side in classes, the more involved one can create a web app. This is impecable and with UX being so important, it's very much an issue that we all connect. The introduction here is to begin a new crush to your website's dynamic side. Pipes, which will be introduced on this site, is the biggest mover of AJAX information on this site, and in fact there is no other that can be so easily used and simple to configure. It's an already useable dynamic. Change anything from anywhere without leaving the site. You're only calling a background page. How? Simple. We'll get into later.</p>
    </article>
    
  </section>
  <div class="row">
    <div class="columns">
      <p class="thumbnail_align"> <img src="wise7.png" alt="" class="thumbnail"/> </p>
      <h4>About</h4>
      <p>Wise has been a 4 year project. Starting early in 2017, Wise was established under the name of Pirodock. Subsequently, the name changed, often. Finding a fit was difficult. Now Wise is it.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
    </div>
    <div class="columns">
      <p class="thumbnail_align"> <img src="wise7.png" alt="" class="thumbnail"/> </p>
      <h4>Commercial Use</h4>
      <p>This package is free for as long as it can be used without making a Commercial entity monetary gains through streamlining, publishing, and or creating more code based on Wise's maintained state of structure.&nbsp; &nbsp;&nbsp;</p>
    </div>
    <div class="columns">
      <p class="thumbnail_align"> <img src="wise7.png" alt="" class="thumbnail"/> </p>
      <h4>Students / Teachers</h4>
      <p>Students and Teachers do not need to worry about paying for Wise because it is just that.&nbsp; &nbsp; We would like to see Colleges, High Schools and students using the programs for as long as they can before going global.</p>
    </div>
    <div class="columns">
      <p class="thumbnail_align"> <img src="wise7.png" alt="" class="thumbnail"/> </p>
      <h4>License</h4>
      <p>The MIT License is being used for Wise. It is abundantly clear that Open Source is a huge prerogative for all web developers.&nbsp; In that spirit only web developers who make money with Wise can&nbsp; owe to it.</p>
    </div>
  </div>
  <div class="row blockDisplay">
    <div>
      <p>&nbsp; &nbsp; &nbsp;</p>
    </div>
    <div>
      <h2>&nbsp;</h2>
    </div>
  </div>
  <div class="social">
    <p class="social_icon"><img src="wise7.png" width="309" alt="" class="thumbnail"/></p>
    <p class="social_icon"><img src="wise7.png" width="309" alt="" class="thumbnail"/></p>
    <p class="social_icon"><img src="wise7.png" width="309" alt="" class="thumbnail"/></p>
    <p class="social_icon"><img src="wise7.png" width="309" alt="" class="thumbnail"/></p>
  </div>
  <footer class="secondary_header footer">
    <div class="copyright">&copy;2021 - Wise&nbsp;&nbsp; <strong>&nbsp;</strong></div>
  </footer>
</div>
</body>
</html>
