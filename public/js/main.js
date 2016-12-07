$(document).ready(function(){
	CSRF_TOKEN = Laravel.csrfToken;
	$('#addPost').click(function(){
		var description = $('#description').val();
		var title = $('#title').val();
		if(title.trim() && description.trim()){
			$.ajax({
	            type: "POST",
	            url: '/addPost',
	            data: {title: title, description: description,_token: CSRF_TOKEN},
	            success: function( msg ) {
	                //$("#ajaxResponse").append("<div>"+msg+"</div>");
	            }
        	});

		}else{
			if(!title.trim()){
				$('#title').next().html('Title required');
			}else{
				$('#title').next().html('');
			}
			if (!description.trim()) {
	    		$('#description').next().html('Description required');
	    	}else{
				$('#description').next().html('');
			}
		}
		 

	});
});