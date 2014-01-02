$(function(){

	$('.box-ss select').change(function(){
		var str = "";
		$(this).find("option:selected" ).each(function() {
			str = $(this).val();
			window.location.href='http://demo.themerart.net/newvision/'+str;
		});
	});

	$('#switch-button').click(function()
	{
		var x = $('#style-switcher')
		if(x.css("right")=="-212px"){
			x.animate({right:"0px"})
		}else{
			x.animate({right:"-212px"})
		}
	});

});