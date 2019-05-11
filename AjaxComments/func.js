(function() {
  'use strict';

  refresh(); // Загрузка элементов
  $('#comments').on('submit', function(e) {
  	event.preventDefault();

  	var data = {
  		'name': e.currentTarget.elements.name.value,
  		'email': e.currentTarget.elements.email.value,
  		'text': e.currentTarget.elements.comment.value
  	};

  	$.ajax({
	  url: "function.php",
	  data: data,
	  success: function(rep){
	    if(rep == 'error') alert("Ошибка, перезагрузите страницу и попробуйте сначала.");
	    else refresh();
	  }
	}); 
  });

  function refresh() {
  	$('#comment-list')[0].innerHTML = "";

  	$.ajax({
	  url: "function.php",
	  dataType: 'json', 
	  success: function(rep){
	  	rep.forEach(function(item) {
	  		$('#comment-list').append('\
	  			<div class="card-comment col-lg-3 col-md-4 mb-lg-0 mx-lg-4 mb-4 pt-5">\
            	<div class="card white-text">\
              	<div class="text-center p-2 bg-card-title">\
                <h4>'+ item.name +'</h4>\
              	</div>\
              	<div class="card-body card-background pt-2">\
                <p class="mt-4 text-center card-email">'+ item.email +'</p>\
                <p class="card-comment-text">'+ item.comment +'</p>\
              	</div>\
            	</div>\
          		</div>\
	  		');
	  	});
	  }
	}); 

  	
  }

})();