<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Тестовое задание</title>
  
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <main>
      <div class="bg">
        <div class="container">
        	<div class="pt-4"><a href="#"><img src="img/logo.svg" alt="logo" class="logo"></a></div>
          <img src="img/contact.svg" alt="contact icon" class="contact-logo">
          <form id="comments"  >
            <div class="row">
              <div class="col pr-5">
                <div class="form-group">
                  <label for="name">Имя</label>
                  <input type="text" class="form-control" placeholder="Имя" id="name" required>
                </div>
                <div class="form-group">
                  <label for="email">E-Mail</label>
                  <input type="email" class="form-control" id="email" placeholder="E-Mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                </div>
              </div>
              <div class="col-sm-12 col-md-6 pl-5">
                <div class="form-group">
                  <label for="comment">Комментарий</label>
                  <textarea class="form-control" id="comment" rows="6" placeholder="Комментарий" required></textarea>
                </div>
              </div>
            </div>
            <div class="submit py-4">
              <button type="submit" class="btn btn-danger p-2 px-4">Записать</button>
            </div>
          </form>
        </div>
      </div>
      <div class="container">
        <div class="text-center pt-5">
          <div class="font-lg">Выводим комментарии</div>
        </div>
        <div class="row pt-5 pb-5" id="comment-list">

        </div>
      </div>
    </main>
    
  <footer class="page-footer font-small bg-footer pt-4">
      <div class="container p-4">
        <div class="row">
          <div class="col">
            <a href="#"><img src="img/logo.svg" alt="logo" class="logo"></a>
          </div>
          <div class="col">
            <div class="social row justify-content-end">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="ml-2"><i class="fab fa-vk"></i></a>
            </div>
          </div>
        </div>
        
      </div>
    </footer>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
  <script src="func.js"></script>
</body>
</html>