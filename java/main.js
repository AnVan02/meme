
        $(".ajax_serial_input").val("");
		
			var typingTimer;
			var doneTypingInterval = 1000;
			var $input = $('.ajax_serial_input');
      
   
			$input.on('keyup', function () {
				clearTimeout(typingTimer);
				typingTimer = setTimeout(doneTyping, doneTypingInterval);
				var name = $('.ajax_serial_input').val();
				$('.ajax_serial_search').html('<p> mời nhập mã : <b>'+name+'</b></p>');
			});

			$input.on('keydown', function () {
				clearTimeout(typingTimer);
			});

      function doneTyping (){
        var name = $('.ajax_serial_input').val();
        if (name!=''){
          $.post('/barcode/search_serial/',{name:name},function(data){

          });
        }else {
          $('.ajax_serial_seach').html('<p>Vui lòng nhập mã</p>');
          
        }
      }
		