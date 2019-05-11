<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Test Page · Bootstrap</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
      .card-body {
        height: 20rem;
        max-height: 20rem;

        display: flex;
        justify-content: space-between;
        flex-direction: column;
      }
      .card-header {
      	height: 9rem;
      }
    </style>
  </head>
  <body>
    <header>
  
  <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="loginFrom" action="index.php" method="get">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input type="text" name="username" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-email">Your Username</label>
        </div>

        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type="password" name="password" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-pass">Your Password</label>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" id="submit" class="btn btn-default">Login</button>
      </div>
    </div>
    </form>
  </div>
</div>




  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
      <a href="#" class="navbar-brand d-flex align-items-center">
        <strong>Test Page</strong>
      </a>  
    </div>
  </div>
</header>

<main role="main">

  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading"><?php echo (!empty($content['page-title'])) ? $content['page-title'] : "Home page" ; ?></h1>
      <p class="lead text-muted">Select page</p>
      <p>
        <a href="?a=pages" class="btn btn-primary my-2">Pages</a>
        <a href="?a=posts" class="btn btn-secondary my-2">Posts</a>
      </p>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">
		<?php 
    if(!empty($content['items']))
      foreach ($content['items'] as $item): 
      ?>
		<div class="col-md-4">
          <div class="card mb-4 shadow-sm">
          	<div class="card-header">
		        <h4 class="my-0 font-weight-normal"><?php echo mb_substr(strip_tags($item->title->rendered), 0, 70); ?></h4>
		    </div>
            <div class="card-body">
              <p class="card-text"><?php echo mb_substr(strip_tags($item->content->rendered), 0, 250); ?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href='<?php echo $item->link; ?>' type="button" class="btn btn-sm btn-outline-secondary">View</a>
                  <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> -->
                </div>
                <!-- <small class="text-muted">9 mins</small> -->
              </div>
            </div>
          </div>
        </div>
		<?php endforeach ?>
      </div>
    </div>
  </div>

</main>

<footer class="text-muted pt-2">
  <div class="container">
    <p class="float-right">
      <a href="#">Back to top</a>
    </p>
  </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
var isLogin = '<?php echo checkSession(); ?>'; 

$(document).ready(function(){
  if(isLogin == false)
    $("#modalLoginForm").modal('show');  

  $('form button[type="submit"]').on('click', function () {
    $("#modalLoginForm .close").click();

    // $(this).parents('form').submit();
  });

});



</script>
</body>
</html>