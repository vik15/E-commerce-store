<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Responsive Magic Line Pagination</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>

<!-- <link href="//netdna.bootstrapcdn.com/font-awesome/3.0/css/font-awesome.css" rel="stylesheet">
 -->
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
<script>
  WebFont.load({
    google: {
      families: ['Kalam']
    }
  });
</script><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="./pagination.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container"> 
<div class="mainbox">
  <div class="pgn">
    <ul class="pgn__list" role="navigation" aria-labelledby="paginglabel">
      <li class="prev" title="Previous Page">
        <a href="#" rel="prev"><i class="pgn__prev-icon icon-angle-left"></i><span class="pgn__prev-txt">Previous</span></a>
      </li>
      <!--<li class="prev" title="Previous Page"></li>-->
      <li class="pgn__item">
        <a href="#">3</a>
        <a href="#">4</a>
        <strong class="current">5</strong>
        <a href="#">6</a>
        <a href="#">7</a>
      </li>
      <li class="next" title="Next Page">
        <a href="#" rel="next"><i class="pgn__next-icon icon-angle-right"></i><span class="pgn__next-txt">Next</span></a>
      </li>
      <!--<li class="next" title="Next Page"></li>-->
    </ul>
  </div><!-- /.pagination -->
</div> 
</div><!-- /.container -->
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="./pagination.js"></script>

</body>
</html>
