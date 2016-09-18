$(function() {


	function Intersec(arr1,arr2){
	 var idx = 0, arr3 = [];

	 for (var i = 0; i < arr2.length; i++)
	     {
	       idx = arr1.indexOf(arr2[i]);
	       if (idx >= 0) arr3.push(arr2[i]);
	     }

	 return arr3;
	}


	function validate(text){

		error = "";

		var error_words = ['лес','wood','иерархия', 'маргарин', '<i>', '<section>'];

		var Url = text.search( /(https?:\/\/)?(www\.)?([-а-яa-z0-9_\.]{2,}\.(рф|[a-z]{2,6}))((\/[-а-яa-z0-9_]{1,}\/)|(\/[-а-яa-z0-9_]{1,}\/)([-а-яa-z0-9_]{2,}\.(рф|[a-z]{2,6})))?((\?[a-z0-9_]{2,}=[-0-9]{1,})?((\&[a-z0-9_]{2,}=[-0-9]{1,}){1,})?)?/i);

		text = text.split(" ");
		

		var words = Intersec(error_words, text);

		if(Url != -1){
			error = "Url";
			return false;
		}

		if(words[0] != null){
			for(var i = 0; i < words.length; i++){
				error += " " + words[i];
			}
			return false;
		}else{
			return true;
		}
		
	}
	
	$("#title, #message").change(function(){
			$(".write-post .error").remove();
		if(validate($('#title').val().toLowerCase()) && validate($('#message').val().toLowerCase())){
			$(".write-post .error").remove();
			$(".write-post button").attr('disabled', false); 
		}else{
			if(!($("div").is(".error"))) {
				$(".write-post").prepend("<div class='alert error alert-danger'><strong>Ошибка!</strong> Ведены неверные данные "+error+" </div>");
				$(".write-post button").attr('disabled', true); 
			}
		}
	});
});


