function setLoader(){
  var body= $('html').height();
  $('#loader').height(body);
}

var Search = {
			keyword : null,
			list : null,
			filter : function(keyword, list){
				for(var count = 0; count < list.length; count++){
					if(list[count].textContent.length < keyword.length){
						$(list[count]).hide();
					} else {
						if(list[count].textContent.substr(0, keyword.length).toLowerCase() === keyword.toLowerCase()){
							$(list[count]).show();
						} else {
							$(list[count]).hide();
						}
					}
				} //end for loop
			}		
		};
