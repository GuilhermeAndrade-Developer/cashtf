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

	}()); 



    // ---------------------------------------------- 
    // Fun facts
    // ---------------------------------------------- 
	(function () {
		$('.st-counter').counterUp({
		    delay: 10,
		    time: 1500
		});
	}()); 



    // ---------------------------------------------- 
    //  Isotope Filter 
    // ---------------------------------------------- 
	(function () {
		var winDow = $(window);
		var $container=$('.portfolio-items');
		var $filter=$('.filter');

		try{
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
		$container.masonry({
		  itemSelector: '.work-grid'
		});
    }());

    // ----------------------------------------------
    // Owl Carousel
    // ----------------------------------------------
	(function () {

		$(".st-testimonials").owlCarousel({
		singleItem:true,
		lazyLoad : true,
		pagination:false,
		navigation : false,
		autoPlay: true,
		});

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
			$("#testimonial").parallax("50%", 0.3);
		}	
		parallaxInit();
	}());

	

    // ----------------------------------------------
    // fitvids js
    // ----------------------------------------------
    (function () {

        $(".post-video").fitVids();

    }()); 	

});

// ACTIVE TOOLTIP INTO BOOTSTRAP 3
$(window).on('load',function(){
	jQuery.noConflict();
	$('[data-toggle="tooltip"]').tooltip(); 
	$('.alerts[data-toggle="tooltip"]').tooltip('show');
	$('input').on('click', function(){$('.alerts[data-toggle="tooltip"]').tooltip('destroy')})
});

// JS BY FOOTERS (CALL ONE TIME)
    $(document).ready(function(){
      $(window).scroll(function() { // check if scroll event happened
        if ($(document).scrollTop() > 50) { // check if user scrolled more than 50 from top of the browser window
            $(".second_top").css("background-color", "#1fc8db");
            $(".second_top").css("background-image", "linear-gradient(95deg, #F11070 -20%, #9649A6 55%, #2cb5e8 100%)");
            $(".logo").hide();
            $(".logo2").show();
            $(".navbar-nav").css("background-color", "transparent");
            $(".icone_menu").css("color", "#fff");
            $(".link_menu > li > a").css("color", "#fff");
            $(".link_menu > li > a").css("text-shadow", "none");
            $(".link_menu > li > a.active").css("border-bottom", "3px solid #fff");
            $(".navbar-fixed-top").css("background-color", "#54c9ef");
            $(".navbar-fixed-top").css("transition", "background-color 200ms linear");
            $("nav").css("box-shadow", "0px 0px 22px 1px rgba(0, 0, 0, 0.15)");
            // box-shadow: 0px 0px 22px 1px rgba(0, 0, 0, 0.15);
            // $(".primeiro_topo").css("background-color", "#000000");
            $(".primeiro_topo").css("transition", "background-color 200ms linear");
            $(".primeiro_topo").hide();
            $(".carousel-indicators").hide();
            $(".just_fixed").addClass("just_fixed_show");
        } else {
            $(".second_top").css("background-color", "transparent");
            $(".second_top").css("background-image", "none");
            $(".logo").show();
            $(".logo2").hide();
            $(".navbar-nav").css("background-color", "transparent");
            // $(".link_menu > li > a").css("text-shadow", "0px 1px 3px #52c5ee");
            $("nav").css("box-shadow", "none");
            $(".icone_menu").css("color", "#000");
            $(".link_menu > li > a").css("color", "#fff");
            $(".link_menu > li > a.active").css("border-bottom", "4px solid #F11070");
            $(".primeiro_topo").show();
            // $(".primeiro_topo").css("background-color", "#000000");
            $(".navbar-fixed-top").css("background-color", "#fff"); // if not, change it back to transparent
            $(".carousel-indicators").show();
            $(".just_fixed").removeClass("just_fixed_show");
        }
      });
    });

// alefsilva’s peexell’s customization | 12/2017
function scrollOnBottom(){

    var jsScrollTop = jQuery(window).scrollTop() + jQuery(window).height(),
        heightOfDocument = jQuery(document).height(),
        classChatFooter = 'zopim-footer';

    // design responsive
    if(jQuery(window).width() <= 979){
        heightOfDocument = heightOfDocument - 56;

        classChatFooter = 'zopim-footer-tablet';
        jQuery('.zopim').removeClass('zopim-footer-retina');
    }if(jQuery(window).width() <= 479){
        classChatFooter = 'zopim-footer-retina';
        jQuery('.zopim').removeClass('zopim-footer-tablet');
    }

    // adds .zopim-footer
    if(jsScrollTop >= heightOfDocument)
        jQuery('.zopim').addClass(classChatFooter);
    else
        jQuery('.zopim').removeClass(classChatFooter);

}   
jQuery(window).on('scroll', function(){ scrollOnBottom(); });
jQuery(window).on('orientationchange', function(){ scrollOnBottom(); });
// end alefsilva’s peexell’s customization | 12/2017


// new WOW().init();

	function openNav() {
		document.getElementById("myNav").style.width = "100%";
	}

	function closeNav() {
		document.getElementById("myNav").style.width = "0%";
	}
    $(document).ready(function(){
	  	//$('.codigo_procedimento').mask('0.00.0000-0');
		$('.data').mask('00/00/0000');
		$('.data_padrao').mask('00/00/0000');
		$('.time').mask('00:00');
		$('.cep').mask('00000-000');
		$('.phone').mask('0000-0000');
		$('.phone_with_ddd').mask('(00) 00000-0000');
		$('.cpf').mask('000.000.000-00', {reverse: true});
		$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
	});
    function moeda(z){
        v = z.value;
        v=v.replace(/\D/g,"");
        v=v.replace(/[0-9]{12}/,"inválido");
        v=v.replace(/(\d{1})(\d{8})$/,"$1.$2");
      	v=v.replace(/(\d{1})(\d{5})$/,"$1.$2");
        v=v.replace(/(\d{1})(\d{1,2})$/,"$1,$2");
        z.value = v;
    }

    function togglePergunta(v){
        if($('.item-conteudo'+v).css('display') == 'block'){
            $('.div-conteudo').hide();
            $('.seta_baixo').show();
            $('.seta_cima').hide();
            $('#setaC'+v).hide();
            $('#setaB'+v).show();
            $('.item-conteudo'+v).hide();
            $('.item-conteudo'+v).css('position', 'absolute');
            $('.item-conteudo'+v).css('z-index', '99');
            $('.item-conteudo'+v).css('opacity', '0');
        }else{
            $('.div-conteudo').hide();
            $('.seta_baixo').show();
            $('.seta_cima').hide();
            $('#setaC'+v).show();
            $('#setaB'+v).hide();
            $('.item-conteudo'+v).show();
            $('.item-conteudo'+v).css('position', 'absolute');
            $('.item-conteudo'+v).css('z-index', '99');
            $('.item-conteudo'+v).css('opacity', '1');
        }
    }

    function atualizaCampo(v){
        if ($("#"+v).val() != "") {
            console.log('teste', $("#"+v).val())
            $("#"+v).addClass("pink")
        } else {
            $("#"+v).removeClass("pink")
        }
    }

    function atualizaCor(){
        var valor = $('#m_prefix_pt_br').val();
        var valor_refinado = valor.split('R$ ');
        if(valor_refinado.length > 1){
            var valor_final = valor_refinado[1];
            var separado = valor_final.split(',');
            valor = separado[0];
            valor = valor.replace(/[^a-z\d\s]+/gi, '');
            if(valor >= 1000){
                if(valor >= 1000 && valor <= 29000){
                    $('#m_prefix_pt_br').css('background-color', '#F11070')
                    $('#m_prefix_pt_br').css('color', '#FFF')
                }else if(valor >= 30000 && valor <= 99000){
                    $('#m_prefix_pt_br').css('background-color', '#00BEF6')
                    $('#m_prefix_pt_br').css('color', '#FFF')
                }else if(valor >= 100000 && valor <= 999999){
                    $('#m_prefix_pt_br').css('background-color', '#008AD3')
                    $('#m_prefix_pt_br').css('color', '#FFF')
                }else{
                    $('#m_prefix_pt_br').css('background-color', '#00466A')
                    $('#m_prefix_pt_br').css('color', '#FFF')
                }
            }else{
                $('#m_prefix_pt_br').css('background-color', '#F4F4F4')
                $('#m_prefix_pt_br').css('color', '#151515')
            }
        }else{
            $('#m_prefix_pt_br').css('background-color', '#F4F4F4')
            $('#m_prefix_pt_br').css('color', '#151515')
        }
    }
