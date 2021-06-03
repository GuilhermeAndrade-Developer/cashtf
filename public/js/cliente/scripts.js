jQuery(function($){

'use strict';



    // ----------------------------------------------
    // Preloader
    // ----------------------------------------------
	(function () {
	    $(window).load(function() {
	        $('#pre-status').fadeOut();
	        $('#st-preloader').delay(350).fadeOut('slow');
	    });
	}());



    // ---------------------------------------------- 
    //  magnific-popup
    // ----------------------------------------------
	(function () {

		if($('.portfolio-items').magnificPopup){
			$('.portfolio-items').magnificPopup({ 
				delegate: 'a',
				type: 'image',
				// other options
				closeOnContentClick: false,
				closeBtnInside: false,
				mainClass: 'mfp-with-zoom mfp-img-mobile',

				gallery: {
					enabled: false
				},
				zoom: {
					enabled: true,
					duration: 300, // don't foget to change the duration also in CSS
					opener: function(element) {
						return element.find('i');
					}
				}

			});
		}
	}()); 



    // ---------------------------------------------- 
    // Fun facts
    // ---------------------------------------------- 
	(function () {
		if($('.st-counter').counterUp){
			$('.st-counter').counterUp({
			    delay: 10,
			    time: 1500
			});
		}
	}()); 



    // ---------------------------------------------- 
    //  Isotope Filter 
    // ---------------------------------------------- 
	(function () {
		var winDow = $(window);
		var $container=$('.portfolio-items');
		var $filter=$('.filter');

		try{
			if(!$container.imagesLoaded) return false;
			$container.imagesLoaded( function(){
				$container.show();
				$container.isotope({
					filter:'*',
					layoutMode:'masonry',
					animationOptions:{
						duration:750,
						easing:'linear'
					}
				});
			});
		} catch(err) {
		}

		winDow.bind('resize', function(){
			var selector = $filter.find('a.active').attr('data-filter');

			try {
				$container.isotope({ 
					filter	: selector,
					animationOptions: {
						duration: 750,
						easing	: 'linear',
						queue	: false,
					}
				});
			} catch(err) {
			}
			return false;
		});

		$filter.find('a').click(function(){
			var selector = $(this).attr('data-filter');

			try {
				$container.isotope({ 
					filter	: selector,
					animationOptions: {
						duration: 750,
						easing	: 'linear',
						queue	: false,
					}
				});
			} catch(err) {

			}
			return false;
		});


		var filterItemA	= $('.filter a');

		filterItemA.on('click', function(){
			var $this = $(this);
			if ( !$this.hasClass('active')) {
				filterItemA.removeClass('active');
				$this.addClass('active');
			}
		});
	}()); 


	// -------------------------------------------------------------
    // masonry
    // -------------------------------------------------------------

    (function () {
		var $container = $('.portfolio-items');
		// initialize
		if($container.masonry){
			$container.masonry({
			  itemSelector: '.work-grid'
			});
		}
    }());

    // ----------------------------------------------
    // Owl Carousel
    // ----------------------------------------------
	(function () {

		if($(".st-testimonials").owlCarousel){
			$(".st-testimonials").owlCarousel({
			singleItem:true,
			lazyLoad : true,
			pagination:false,
			navigation : false,
			autoPlay: true,
			});
		}

	}());


    // -------------------------------------------------------------
    // Back To Top
    // -------------------------------------------------------------

    (function () {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('.scroll-up').fadeIn();
            } else {
                $('.scroll-up').fadeOut();
            }
        });
    }());
	

    // ----------------------------------------------
    // Parallax Scrolling
    // ----------------------------------------------
	(function () {
		$(window).bind('load', function () {
			parallaxInit();						  
		});
		function parallaxInit() {
			if($("#testimonial").parallax){
				$("#testimonial").parallax("50%", 0.3);
			}
		}	
		parallaxInit();
	}());

	

    // ----------------------------------------------
    // fitvids js
    // ----------------------------------------------
    (function () {

    	if($(".post-video").fitVids){
	        $(".post-video").fitVids();
	    }

    }()); 


    $(function() {
      $('[data-toggle="datepicker"]').datepicker({
        autoHide: true,
        zIndex: 2048,
        language: 'pt-BR',
        format: 'dd/mm/yyyy'
      });
    });	    

});

function mascaraValor(valor) {
    valor = valor.toString().replace(/\D/g,"");
    valor = valor.toString().replace(/(\d)(\d{8})$/,"$1.$2");
    valor = valor.toString().replace(/(\d)(\d{5})$/,"$1.$2");
    valor = valor.toString().replace(/(\d)(\d{2})$/,"$1,$2");
    return valor                    
}

function virgulaPonto(int){
	var valor_final = 0;
	valor_final = int.replace('.','');
	valor_final = valor_final.replace(',','.');
	return valor_final;
}

/*################################
      Carregar imagem no file
#################################*/    
var openFile = function(event) {
    var input = event.target;
    var reader = new FileReader();
    reader.onload = function(){
        var dataURL = reader.result;
        var output = document.getElementById('preview');
        output.src = dataURL;
    };
    reader.readAsDataURL(input.files[0]);
};

function validaCNPJ() {

	cnpj = document.getElementById("cnpj").value;
 
    cnpj = cnpj.replace(/[^\d]+/g,'');
 
    if(cnpj == '') return false;
     
    if (cnpj.length != 14)
        return false;
 
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
        cnpj == "11111111111111" || 
        cnpj == "22222222222222" || 
        cnpj == "33333333333333" || 
        cnpj == "44444444444444" || 
        cnpj == "55555555555555" || 
        cnpj == "66666666666666" || 
        cnpj == "77777777777777" || 
        cnpj == "88888888888888" || 
        cnpj == "99999999999999")
        return false;
         
    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;
         
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false;
           
    return true;
}

$('#cnpjForm').submit(function() {
	if(validaCNPJ() == false){
		$('.cnpj-invalido').show();
		$('#cnpj').css('border-color', 'red');
		return false;
	}
	else {
		$('.cnpj-invalido').hide();
		$('#cnpj').css('border-color', 'black');
		return true;
	}
});

function validaCPF() {	
	cpf = document.getElementById("cpf").value;
	cpf = cpf.replace(/[^\d]+/g,'');	
	if(cpf == '') return false;	
	// Elimina CPFs invalidos conhecidos	
	if (cpf.length != 11 || 
		cpf == "00000000000" || 
		cpf == "11111111111" || 
		cpf == "22222222222" || 
		cpf == "33333333333" || 
		cpf == "44444444444" || 
		cpf == "55555555555" || 
		cpf == "66666666666" || 
		cpf == "77777777777" || 
		cpf == "88888888888" || 
		cpf == "99999999999")
			return false;		
	// Valida 1o digito	
	add = 0;	
	for (i=0; i < 9; i ++)		
		add += parseInt(cpf.charAt(i)) * (10 - i);	
		rev = 11 - (add % 11);	
		if (rev == 10 || rev == 11)		
			rev = 0;	
		if (rev != parseInt(cpf.charAt(9)))		
			return false;		
	// Valida 2o digito	
	add = 0;	
	for (i = 0; i < 10; i ++)		
		add += parseInt(cpf.charAt(i)) * (11 - i);	
	rev = 11 - (add % 11);	
	if (rev == 10 || rev == 11)	
		rev = 0;	
	if (rev != parseInt(cpf.charAt(10)))
		return false;		
	return true;   
}

$('#cpfForm').submit(function() {
	if(validaCPF() == false){
		$('.cpf-invalido').show();
		$('#cpf').css('border-color', 'red');
		return false;
	}
	else {
		$('.cpf-invalido').hide();
		$('#cpf').css('border-color', 'black');
		return true;
	}
});

