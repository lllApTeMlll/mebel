$(function(){
	$('.close').click(function(){
		colssAll();
	});
	$('.openV').click(function(){
		riv('#avtorM');
		return false;
	});
	$('.openR').click(function(){
		riv('#registrM');
		return false;
	});
	$('.openRec').click(function(){
		riv('#recoverM');
		return false;
	});
	
	
	
});
	
function sendMesseg(header,txte){
	$('#messM .hed').html(header);
	$('#messM .texxt').html(txte);
	riv('#messM');
	setTimeout(function(){
		colssAll();
	}, 5000);
}
	
	function riv(param){
		if ($('.modal.active').length){
			$('.modal.active').css({'display' : 'block'}).slideUp(400,function(){
				$('.modal.active').removeClass('active');
				$(param).css({'display' : 'none'}).slideDown(400);
				$(param).addClass('active');
			});	
		}else{
			$(param).css({'display' : 'none'}).slideDown(400);
			$(param).addClass('active');
			var bg="<div class='reveal-modal-bg'></div>";
			$('.rt.error').remove();
			$('body').prepend(bg);
			$('.reveal-modal-bg').css({'display' : 'none'}).fadeIn("slow");
		}
	}

	function colssAll(){
		$('.reveal-modal-bg').css({'display' : 'block'}).fadeOut("slow",function(){
			$('.reveal-modal-bg').remove();
		});
		$('.modal.active').css({'display' : 'block'}).slideUp(400,function(){
			$('.modal.active').removeClass('active');
		});	
		console.log('d');
	}


