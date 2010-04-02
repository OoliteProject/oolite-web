// JavaScript Document

$(function() {
route1=$('#r1');
route2=$('#r2');
route3=$('#r3');
route4=$('#r4');
route1.show();
route2.show();
route3.show();
route4.show();
route1.css('opacity','0');
route2.css('opacity','0');
route3.css('opacity','0');
route4.css('opacity','0');

k=10;
k2=500;





menu = function(navig){
	
	
	
if(navig=='index') {


$('#about').hover(function() {
route1.stop().animate({ "opacity": 1 },k);

}, function() {	
route1.stop().animate({ "opacity": 0 },k2);

});

$('#download').hover(function() {
route3.stop().animate({ "opacity": 1 },k);
}, function() {	
route3.stop().animate({ "opacity": 0 },k2);
});

$('#gallery').hover(function() {
route2.stop().animate({ "opacity": 1 },k);

}, function() {	
route2.stop().animate({ "opacity": 0 },k2);

});	


$('#links').hover(function() {
route4.stop().animate({ "opacity": 1 },k);
}, function() {	
route4.stop().animate({ "opacity": 0 },k2);
});

}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
if(navig=='links') {
$('#lin1').show();
$('#dow2').show();
$('#gal2').show();
$('#ab2').show();

$('#about').hover(function() {
route1.stop().animate({ "opacity": 1 },k);
route2.stop().animate({ "opacity": 1 },k);				   
route3.stop().animate({ "opacity": 1 },k);
}, function() {	
route1.stop().animate({ "opacity": 0 },k2);
route2.stop().animate({ "opacity": 0 },k2);
route3.stop().animate({ "opacity": 0 },k2);
});

$('#download').hover(function() {
route3.stop().animate({ "opacity": 1 },k);
}, function() {	
route3.stop().animate({ "opacity": 0 },k2);
});

$('#gallery').hover(function() {
route2.stop().animate({ "opacity": 1 },k);
route3.stop().animate({ "opacity": 1 },k);
}, function() {	
route2.stop().animate({ "opacity": 0 },k2);
route3.stop().animate({ "opacity": 0 },k2);
});	
}

if(navig=='about') {
$('#lin2').show();
$('#gal2').show();
$('#dow2').show();
$('#ab1').show();


$('#links').hover(function() {
route1.stop().animate({ "opacity": 1 },k);
route2.stop().animate({ "opacity": 1 },k);				   
route3.stop().animate({ "opacity": 1 },k);
}, function() {	
route1.stop().animate({ "opacity": 0 },k2);
route2.stop().animate({ "opacity": 0 },k2);
route3.stop().animate({ "opacity": 0 },k2);
});

$('#download').hover(function() {
route2.stop().animate({ "opacity": 1 },k);
route1.stop().animate({ "opacity": 1 },k);
}, function() {	
route2.stop().animate({ "opacity": 0 },k2);
route1.stop().animate({ "opacity": 0 },k2);
});

$('#gallery').hover(function() {
route1.stop().animate({ "opacity": 1 },k);
}, function() {	
route1.stop().animate({ "opacity": 0 },k2);
});	
}



if(navig=='gallery') {
$('#lin2').show();
$('#gal1').show();
$('#dow2').show();
$('#ab2').show();


$('#links').hover(function() {
route2.stop().animate({ "opacity": 1 },k);				   
route3.stop().animate({ "opacity": 1 },k);
}, function() {	
route2.stop().animate({ "opacity": 0 },k2);
route3.stop().animate({ "opacity": 0 },k2);
});

$('#download').hover(function() {
route2.stop().animate({ "opacity": 1 },k);

}, function() {	
route2.stop().animate({ "opacity": 0 },k2);

});

$('#about').hover(function() {
route1.stop().animate({ "opacity": 1 },k);
}, function() {	
route1.stop().animate({ "opacity": 0 },k2);
});	






function getBodyScrollTop()
{
  return self.pageYOffset || (document.documentElement && document.documentElement.scrollTop) || (document.body && document.body.scrollTop);
}
	
shadow=function(name){	
$('#shade').css('opacity','0.8');
$('#shade').show();
$('#shade, #picture').click(function() {
$('#shade, #picture').hide();
});

$('#image').remove();
filename="images/gallery/full/" + name;
$('<img class="pics"   id="image"  title="Oolite" src="'+filename+'" alt="Oolite" />').appendTo('.wrap');

h=$('#footer').offset().top+$('#footer').height();
$('#shade').css('height',h)
}











$('.buttons').click(function() {
							
galnum=(this.id).slice(-1);	

gals='#gallery'+galnum;	

stat=$(gals).css('display');




if(stat=='block'){
	
$(gals).hide();
}
else{
$(gals).slideDown()		
};
//$(gal).toggleClass('hide');
})





$('.gallery div img').hover(function() {
$(this).css('borderColor','#ffffff')

}, function() {	
$(this).css('borderColor','#9ca4b7')
});

$('.gallery div img').click(function() {

var path = this.src.split("/");
var name = path[path.length - 1];
name = name.replace("!", ".");
shadow(name);

skroll=getBodyScrollTop()+10;
$('#picture').show();
$('#picture').css('top',skroll)

})











}









if(navig=='download') {
$('#dow1').show();
$('#ab2').show();
$('#gal2').show();
$('#lin2').show();

$('#about').hover(function() {
route1.stop().animate({ "opacity": 1 },k);
route2.stop().animate({ "opacity": 1 },k);				   

}, function() {	
route1.stop().animate({ "opacity": 0 },k2);
route2.stop().animate({ "opacity": 0 },k2);

});

$('#links').hover(function() {
route3.stop().animate({ "opacity": 1 },k);
}, function() {	
route3.stop().animate({ "opacity": 0 },k2);
});

$('#gallery').hover(function() {
route2.stop().animate({ "opacity": 1 },k);

}, function() {	
route2.stop().animate({ "opacity": 0 },k2);

});	
}













}



})
 

 
