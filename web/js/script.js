$(document).ready(function(){
	
	var prevTop = 0;
	function ShowHeadbar()
	{
		if($(window).scrollTop() > '160')
		{
			if(prevTop>$(window).scrollTop()) $('#headbar').addClass("show");
				else $('#headbar').removeClass("show");
			prevTop = $(window).scrollTop();
		}
		else $('#headbar').removeClass("show");
		if($(window).scrollTop() > '900') $("a.scroll-top").css("display","block");
			else $("a.scroll-top").css("display","none");
	}
	
	$(window).scroll(ShowHeadbar);

	function addSpaces(nStr){
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + ' ' + '$2');
		}
		return x1 + x2;
	}

	function CountCosts() {
		$(".cabin-row").each(function(){
			sum1 = 0;
			summ = 0;
			var tickets = '';
			$(this).find(".cabin-form .price-variants .price-var-li").each(function(){
				price = $(this).find("input.varprice").val();
				quant = $(this).find("select").val();
				sum1 = price * quant;
				summ += sum1;
				if(quant>0) tickets = tickets + $(this).find(".var-name").text() + ": " + quant + "; ";
			});
			$(this).find(".price-result .summ").html(addSpaces(summ));
			$(this).find(".price-but a.order-button").data('ccost',summ);
			if(tickets>'') $(this).find(".price-but a.order-button").data('tickets',tickets);
			else $(this).find(".price-but a.order-button").data('tickets',"не выбрано");
		});
	};

	$('.navbar-toggle.collapsed').click(function() {
		$('.navbar-collapse').addClass("show");
	});
	
	$('.navbar .navbar-hide').click(function() {
		$('.navbar-collapse').removeClass("show");
	});
	
	$(".main-page .owl-carousel").owlCarousel({loop:true,nav:true,items:1,autoplay:true,autoplayTimeout:10000,navText:[]});

	//lightbox.option({'resizeDuration': 200,'wrapAround': true});
    	
	$(".chosen-select").chosen({
		disable_search: true,
		no_results_text: "Не найдено: ",
		placeholder_text_multiple: "Добавьте по желанию",
		placeholder_text_single: "Выберите"
		
	});
	
	$('.cruise-row .cruise-options-switch').click(function() {
		$(this).toggleClass("expanded");
		$(this).next(".cruise-options").toggleClass("expanded");
		$(this).parent().toggleClass("expanded");
	});

	$('.cabin-row .expand-lnk').click(function() {
		$(this).addClass('hidden');
		$(this).parent().parent().addClass("expanded");
		$(this).parent().find('.close-lnk').removeClass("hidden");
		$(this).parent().find(".cabin-photo .photo-prev").css('display','none');
		$(this).parent().find(".cabin-photo .owl-carousel").addClass('owl-loaded')
		$(this).parent().find(".cabin-photo .owl-carousel").owlCarousel({loop:false,nav:false,items:1,autoplay:false,navText:[]});
	});
	$('.cabin-row .close-lnk').click(function() {
		$(this).addClass('hidden');
		$(this).parent().parent().removeClass("expanded");
		$(this).parent().find('.expand-lnk').removeClass("hidden");
		$(this).parent().find(".cabin-photo .photo-prev").css('display','block');
		//$(this).parent().find(".cabin-photo .owl-carousel").css('display','none');
		$(this).parent().find(".cabin-photo .owl-carousel").removeClass('owl-loaded');
	});

	$('.shipteam-row .expand-lnk').click(function() {
		$(this).addClass('hidden');
		$(this).parent().find('.shipteam-descr').removeClass("hidden");
		$(this).parent().find('.close-lnk').removeClass("hidden");
	});
	$('.shipteam-row .close-lnk').click(function() {
		$(this).addClass('hidden');
		$(this).parent().find('.shipteam-descr').addClass("hidden");
		$(this).parent().find('.expand-lnk').removeClass("hidden");
	});

	CountCosts();
	
	$(".price-var-li select").on("change", function() {
		var sum1 = 0;
		var summ = 0;
		var tickets = '';
		$(this).parent().parent().find(".price-var-li").each(function(){
			price = $(this).find("input.varprice").val();
			quant = $(this).find("select").val();
			sum1 = price * quant;
			summ += sum1;
			//tic1 = $(this).find(".var-name").text() + ": " + quant;
			//console.log(tic1);
			if(quant>0) tickets = tickets + $(this).find(".var-name").text() + ": " + quant + "; ";
		});
		//console.log(tickets);
		$(this).parent().parent().parent().find(".price-result").find(".summ").html(addSpaces(summ));
		$(this).parent().parent().parent().find(".price-but a.order-button").data('ccost',summ);
		if(tickets>'') $(this).parent().parent().parent().find(".price-but a.order-button").data('tickets',tickets);
		else $(this).parent().parent().parent().find(".price-but a.order-button").data('tickets',"не выбрано");
	});
	
	$(".order-button").click(function() {
        var cname = $(this).data('cname');
        var ctickets = $(this).data('tickets');
        var ccost = $(this).data('ccost');
        $('#callback-form .cabin-name').text(cname);
        $('#callback-form .tickets').text(ctickets);
        $('#callback-form .cabin-cost .summ').text(addSpaces(ccost));
        $('#callback-form #ih-cabin').attr('value',cname);
        $('#callback-form #ih-tickets').attr('value',ctickets);
        $('#callback-form #ih-cost').attr('value',ccost);
		$("#callback-form").css("display","block");
	});
	$("#callback-form").click(function(event) {
		event.stopPropagation();
		$("#callback-form").css("display","none");
	});
	$("#callback-form .cbf-container").click(function(event) {
		event.stopPropagation();
	});
	$("#callback-form .closeform").click(function() {
		$("#callback-form").css("display","none");
	});
	
	$(".contacts-item .name").click(function() {
		$(".lbox-mask").css("display","block");
	});

	
	$(".play-button").click(function() {
		var vidlink = "https://www.youtube.com/embed/"+$(this).data("video")+"?rel=0&amp;controls=0&amp;showinfo=0&enablejsapi=1";
		var contwidth = $(this).data("width");
		var contheight = $(this).data("height");
		var prop = contwidth/contheight;
		if((contwidth+80) > $(window).width()){
			contwidth = $(window).width()-80;
			contheight = contwidth/prop;
		}
		if((contheight+80) > $(window).height()){
			contheight = $(window).height()-80;
			contwidth = contheight*prop;
		}
		$(".lbox-mask .lbox-container").css({"width":contwidth+"px","height":contheight+"px"});
		$(".lbox-mask .lbox-container iframe").attr({"width":contwidth,"height":contheight,"src":vidlink});
		$(".lbox-mask").css("display","block");
	});
	$(".lbox-mask").click(function(event) {
		event.stopPropagation();
		$(this).find("iframe").attr("src","back.html");
		$(this).css("display","none");
	});
	$(".lbox-mask .lbox-container").click(function(event) {
		event.stopPropagation();
	});
	$(".lbox-mask .closeform").click(function() {
		$(this).parent().find("iframe").attr("src","back.html");
		$(this).parent().parent().css("display","none");
	});
	
	
	$(".more-but button").click(function(){
		$(this).parent().parent().find(".hidden").removeClass("hidden");
		$(this).parent().css("display","none");
	});

	$(".scroll-top").click(function(){
		$("html, body").animate({scrollTop:680},700,"swing");
	});

	$(".photos-list .list").owlCarousel({loop:true,nav:true,items:1,autoplay:false,navText:[]});

/*

	$('.photos-list .list').slick({
		autoplay: false,
		dots: false,
		arrows: true
	});
	
	
	var prevTop=0;
	var MenuTop=0;
	var MenuHeight = 613;

	function SpColPos(){
		if($(window).width() < '992'){
			if($(window).height() < MenuHeight){
				if($(window).scrollTop()>prevTop){ //scroll down
					if(($(window).height()+$(window).scrollTop())<MenuHeight){
						$('header .navbar .navbar-collapse').addClass("floating");
					}
					else
				}
			}
			else{
				$('header .navbar .navbar-collapse').removeClass("floating");
				
			}

		if($(window).scrollTop() < '105')
			{
				MenuTop=0-$(window).scrollTop();
				$('#sidebar').css("margin-top", MenuTop+"px");
				$('.submenu').css("position", "fixed");
			}
			else
			{
				if($(window).scrollTop()>prevTop)
				{
	
					if(($(window).height()-MenuTop)<MenuHeight)
					{
						MenuTop=MenuTop-$(window).scrollTop()+prevTop;
						$('#sidebar').css("margin-top", MenuTop+"px");
					}
					else
					{
						if ($(window).height()<MenuHeight)
						{
							MenuTop=$(window).height()-MenuHeight;
							$('#sidebar').css("margin-top", MenuTop+"px");
						}
						else
						{
							MenuTop=-105;
							$('#sidebar').css("margin-top", MenuTop+"px");
						}
					}
				}
				else
				{
					MenuTop=MenuTop+prevTop-$(window).scrollTop();
					if(MenuTop<-105)
					{
						$('#sidebar').css("margin-top", MenuTop+"px");
					}
					else
					{
						MenuTop=-105;
						$('#sidebar').css("margin-top", MenuTop+"px");
					}
				}
				$('.submenu').css("position", "fixed");
			}
			prevTop=$(window).scrollTop();
//			$('#js-wid').text(MenuTop);

		}
	}
	
	SpColPos();
	
	$(window).scroll(SpColPos); // при прокрутке

    $('li.tabmenu-entry').click(function(){
        //console.log('щелчок на палубу');
        var profile = $(this).data('profile');
        var deck = $(this).data('deck');
        var title = $(this).data('title');
        //Удалим класс у других li
        $('#decks-tabmenu').find('li').removeClass('active');
        //Делаем класс для кнопки палубы
        $(this).addClass('active');
        
        
        //Не нашел где title менять
        $('#deck-title').text(title);
        $('#ship-deckplan-profile').attr('src',profile);
        $('#ship-deckplan-deck').attr('src',deck);
        
        
    })
    
	function SpColSize(){
//	    $('#js-wid').text($(window).width());
	    if($(window).width() >= '1200') var colwidth = ($(window).width()-1200)/2+292+"px";
		    else var colwidth = ($(window).width()-992)/2+238+"px";
//	    $('#js-col-wid').text(colwidth);
	    $('.offers-side').css("width", colwidth);
	}
	


	$(window).load(SpColSize); // при загрузке
	$(window).resize(SpColSize); // при изменении размеров
	$(window).load(SpColSize); // при загрузке
	$(window).load($('.offers-side').scrollTop(0));
	$(window).scroll(SpColPos); // при прокрутке

	
	
*/
	
});
