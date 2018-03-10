<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
<script>
    // Semicolon (;) to ensure closing of earlier scripting
    // Encapsulation
    // $ is assigned to jQuery
    ;(function($) {

         // DOM Ready
        $(function() {

            // Binding a click event
            // From jQuery v.1.7.0 use .on() instead of .bind()
            $('#checkout_button').bind('click', function(e) {

                // Prevents the default action to be triggered. 
                e.preventDefault();

                // Triggering bPopup when click event is fired
                $('#checkout_div').bPopup();

            });

        });

    })(jQuery);

/*================================================================================
 * @name: bPopup - if you can't get it up, use bPopup
 * @author: (c)Bjoern Klinggaard (twitter@bklinggaard)
 * @demo: http://dinbror.dk/bpopup
 * @version: 0.9.4.min
 ================================================================================*/
 (function(b){b.fn.bPopup=function(z,F){function K(){a.contentContainer=b(a.contentContainer||c);switch(a.content){case "iframe":var h=b('<iframe class="b-iframe" '+a.iframeAttr+"></iframe>");h.appendTo(a.contentContainer);r=c.outerHeight(!0);s=c.outerWidth(!0);A();h.attr("src",a.loadUrl);k(a.loadCallback);break;case "image":A();b("<img />").load(function(){k(a.loadCallback);G(b(this))}).attr("src",a.loadUrl).hide().appendTo(a.contentContainer);break;default:A(),b('<div class="b-ajax-wrapper"></div>').load(a.loadUrl,a.loadData,function(){k(a.loadCallback);G(b(this))}).hide().appendTo(a.contentContainer)}}function A(){a.modal&&b('<div class="b-modal '+e+'"></div>').css({backgroundColor:a.modalColor,position:"fixed",top:0,right:0,bottom:0,left:0,opacity:0,zIndex:a.zIndex+t}).appendTo(a.appendTo).fadeTo(a.speed,a.opacity);D();c.data("bPopup",a).data("id",e).css({left:"slideIn"==a.transition||"slideBack"==a.transition?"slideBack"==a.transition?g.scrollLeft()+u:-1*(v+s):l(!(!a.follow[0]&&m||f)),position:a.positionStyle||"absolute",top:"slideDown"==a.transition||"slideUp"==a.transition?"slideUp"==a.transition?g.scrollTop()+w:x+-1*r:n(!(!a.follow[1]&&p||f)),"z-index":a.zIndex+t+1}).each(function(){a.appending&&b(this).appendTo(a.appendTo)});H(!0)}function q(){a.modal&&b(".b-modal."+c.data("id")).fadeTo(a.speed,0,function(){b(this).remove()});a.scrollBar||b("html").css("overflow","auto");b(".b-modal."+e).unbind("click");g.unbind("keydown."+e);d.unbind("."+e).data("bPopup",0<d.data("bPopup")-1?d.data("bPopup")-1:null);c.undelegate(".bClose, ."+a.closeClass,"click."+e,q).data("bPopup",null);H();return!1}function G(h){var b=h.width(),e=h.height(),d={};a.contentContainer.css({height:e,width:b});e>=c.height()&&(d.height=c.height());b>=c.width()&&(d.width=c.width());r=c.outerHeight(!0);s=c.outerWidth(!0);D();a.contentContainer.css({height:"auto",width:"auto"});d.left=l(!(!a.follow[0]&&m||f));d.top=n(!(!a.follow[1]&&p||f));c.animate(d,250,function(){h.show();B=E()})}function L(){d.data("bPopup",t);c.delegate(".bClose, ."+a.closeClass,"click."+e,q);a.modalClose&&b(".b-modal."+e).css("cursor","pointer").bind("click",q);M||!a.follow[0]&&!a.follow[1]||d.bind("scroll."+e,function(){B&&c.dequeue().animate({left:a.follow[0]?l(!f):"auto",top:a.follow[1]?n(!f):"auto"},a.followSpeed,a.followEasing)}).bind("resize."+e,function(){w=y.innerHeight||d.height();u=y.innerWidth||d.width();if(B=E())clearTimeout(I),I=setTimeout(function(){D();c.dequeue().each(function(){f?b(this).css({left:v,top:x}):b(this).animate({left:a.follow[0]?l(!0):"auto",top:a.follow[1]?n(!0):"auto"},a.followSpeed,a.followEasing)})},50)});a.escClose&&g.bind("keydown."+e,function(a){27==a.which&&q()})}function H(b){function d(e){c.css({display:"block",opacity:1}).animate(e,a.speed,a.easing,function(){J(b)})}switch(b?a.transition:a.transitionClose||a.transition){case "slideIn":d({left:b?l(!(!a.follow[0]&&m||f)):g.scrollLeft()-(s||c.outerWidth(!0))-C});break;case "slideBack":d({left:b?l(!(!a.follow[0]&&m||f)):g.scrollLeft()+u+C});break;case "slideDown":d({top:b?n(!(!a.follow[1]&&p||f)):g.scrollTop()-(r||c.outerHeight(!0))-C});break;case "slideUp":d({top:b?n(!(!a.follow[1]&&p||f)):g.scrollTop()+w+C});break;default:c.stop().fadeTo(a.speed,b?1:0,function(){J(b)})}}function J(b){b?(L(),k(F),a.autoClose&&setTimeout(q,a.autoClose)):(c.hide(),k(a.onClose),a.loadUrl&&(a.contentContainer.empty(),c.css({height:"auto",width:"auto"})))}function l(a){return a?v+g.scrollLeft():v}function n(a){return a?x+g.scrollTop():x}function k(a){b.isFunction(a)&&a.call(c)}function D(){x=p?a.position[1]:Math.max(0,(w-c.outerHeight(!0))/2-a.amsl);v=m?a.position[0]:(u-c.outerWidth(!0))/2;B=E()}function E(){return w>c.outerHeight(!0)&&u>c.outerWidth(!0)}b.isFunction(z)&&(F=z,z=null);var a=b.extend({},b.fn.bPopup.defaults,z);a.scrollBar||b("html").css("overflow","hidden");var c=this,g=b(document),y=window,d=b(y),w=y.innerHeight||d.height(),u=y.innerWidth||d.width(),M=/OS 6(_\d)+/i.test(navigator.userAgent),C=200,t=0,e,B,p,m,f,x,v,r,s,I;c.close=function(){a=this.data("bPopup");e="__b-popup"+d.data("bPopup")+"__";q()};return c.each(function(){b(this).data("bPopup")||(k(a.onOpen),t=(d.data("bPopup")||0)+1,e="__b-popup"+t+"__",p="auto"!==a.position[1],m="auto"!==a.position[0],f="fixed"===a.positionStyle,r=c.outerHeight(!0),s=c.outerWidth(!0),a.loadUrl?K():A())})};b.fn.bPopup.defaults={amsl:50,appending:!0,appendTo:"body",autoClose:!1,closeClass:"b-close",content:"ajax",contentContainer:!1,easing:"swing",escClose:!0,follow:[!0,!0],followEasing:"swing",followSpeed:500,iframeAttr:'scrolling="no" frameborder="0"',loadCallback:!1,loadData:!1,loadUrl:!1,modal:!0,modalClose:!0,modalColor:"#000",onClose:!1,onOpen:!1,opacity:0.7,position:["auto","auto"],positionStyle:"absolute",scrollBar:!0,speed:250,transition:"fadeIn",transitionClose:!1,zIndex:9997}})(jQuery);
 </script>
<style>
#checkout_div { 
    background-color:#fff;
    background: transparent;
    border-radius:15px;
    background: rgba(45, 49, 46, 0.6);
    color:#000;
    display:none; 
    padding:20px;
    text-align:left;
    width: 500px;
    padding:20px;
    transition:1s;
  
    
}
.b-close{
    cursor:pointer;
    position:absolute;
    right:10px;
    top:5px;
}
#element_to_pop_up a {
	color:white;
	color:#FD5353;
	font-family: "open sans";
	text-decoration: none;
	font-size: 40px;

}
#element_to_pop_up a:hover{
	color: #FD5353;
	color:white;
}
#comm{
    float: left;
    height: 70px; 
    width: 500px;
    font-family:arial,sans-serif;
    border:1px solid white;
    font-weight: normal;
    font-family: "open sans";
    font-size:17px;
    padding-left: 5px;
    padding-top:5px;
    outline: none;
    color:#353535;
    resize:none;
    border-radius: 2px;
}
#com_but{
    
    float: left;
    margin-left: 400px;
    width: 100px;
    height: 30px;
    background: #FD5353;
    color:white;
    border:1px solid #FD5353;
    font-weight: bold;
    margin-top: 4px;
}
#com_but:hover{
    background: #DF5745;
    cursor: pointer;
}

#tex{
	color:white;
	font-family: "open sans";
}
#logo1{
	
	font-family: "open sans";
	color:white;
	border-radius: 50%;
	padding-top:15px;
	padding-bottom: 15px;
	padding-right: 10px;
	padding-left: 10px;
	background-color:rgba(196, 85, 73, 0.6);;
	border:1px dashed white;
	-moz-border:1px dashed white;
	margin-left: 00px;

}
#prices_tab{
    text-align: center;
    border-collapse: separate;
    border-spacing: 10px 10px;
    color:white;
    border:none;
    
}
#prices_td{
    border:none;
    font-family: "open sans";
    font-size: 14px;
   
}
#prices_tr_30{
    font-weight: bold;
    color: #45B39C;
}
#prices_td_top{
    border:none;
    font-family: "open sans";
    font-size: 14px;
    color:#F96E5B;
    font-weight: bold;
}
</style>

<center><div id="checkout_div">
	<center><img src="images/media.png" width="80" /></center></br>
     <center> <table id="prices_tab" border="1">
        <tr id="prices_tr">
            <td id="prices_td_top">Size of Slot</td>
            <td id="prices_td_top">Number of Slot</td>
            <td id="prices_td_top">Original Price</td>
            <td id="prices_td_top">Discount</td>
            <td id="prices_td_top">Final Price</td>
        </tr>
        <tr id="prices_tr">
            <td id="prices_td">A8</td>
            <td id="prices_td">1</td>
            <td id="prices_td">£80</td>
            <td id="prices_td">£0</td>
            <td id="prices_td">£80</td>
        </tr>
        <tr id="prices_tr">
            <td id="prices_td">A8</td>
            <td id="prices_td">2</td>
            <td id="prices_td">£160</td>
            <td id="prices_td">£16</td>
            <td id="prices_td">£144</td>
        </tr>
        <tr id="prices_tr">
            <td id="prices_td">A8</td>
            <td id="prices_td">3</td>
            <td id="prices_td">£240</td>
            <td id="prices_td">£36</td>
            <td id="prices_td">£204</td>
        </tr>
        <tr id="prices_tr">
            <td id="prices_td">A8</td>
            <td id="prices_td">4</td>
            <td id="prices_td">£320</td>
            <td id="prices_td">£80</td>
            <td id="prices_td">£240</td>
        </tr>
        <tr id="prices_tr">
            <td id="prices_td">A8</td>
            <td id="prices_td">5</td>
            <td id="prices_td">£400</td>
            <td id="prices_td">£100</td>
            <td id="prices_td">£300</td>
        </tr>
        <tr id="prices_tr">
            <td id="prices_td">A8</td>
            <td id="prices_td">6</td>
            <td id="prices_td">£480</td>
            <td id="prices_td">£120</td>
            <td id="prices_td">£360</td>
        </tr>
        <tr id="prices_tr">
            <td id="prices_td">A8</td>
            <td id="prices_td">7</td>
            <td id="prices_td">£560</td>
            <td id="prices_td">£140</td>
            <td id="prices_td">£420</td>
        </tr>

        <tr id="prices_tr_30">
            <td id="prices_td">A7</td>
            <td id="prices_td">1</td>
            <td id="prices_td">£100</td>
            <td id="prices_td">£0</td>
            <td id="prices_td">£100</td>
        </tr>
        <tr id="prices_tr_30">
            <td id="prices_td">A7</td>
            <td id="prices_td">2</td>
            <td id="prices_td">£200</td>
            <td id="prices_td">£20</td>
            <td id="prices_td">£180</td>
        </tr>
        <tr id="prices_tr_30">
            <td id="prices_td">A7</td>
            <td id="prices_td">3</td>
            <td id="prices_td">£300</td>
            <td id="prices_td">£45</td>
            <td id="prices_td">£255</td>
        </tr>
        <tr id="prices_tr_30">
            <td id="prices_td">A7</td>
            <td id="prices_td">4</td>
            <td id="prices_td">£400</td>
            <td id="prices_td">£100</td>
            <td id="prices_td">£300</td>
        </tr>
       
        <tr id="prices_tr_30">
            <td id="prices_td">A7</td>
            <td id="prices_td">5</td>
            <td id="prices_td">£500</td>
            <td id="prices_td">£125</td>
            <td id="prices_td">£375</td>
        </tr>
        <tr id="prices_tr_30">
            <td id="prices_td">A7</td>
            <td id="prices_td">6</td>
            <td id="prices_td">£600</td>
            <td id="prices_td">£150</td>
            <td id="prices_td">£450</td>
        </tr>
        <tr id="prices_tr_30">
            <td id="prices_td">A7</td>
            <td id="prices_td">7</td>
            <td id="prices_td">£700</td>
            <td id="prices_td">£175</td>
            <td id="prices_td">£525</td>
        </tr>
        

        <tr id="prices_tr">
            <td id="prices_td">A6</td>
            <td id="prices_td">1</td>
            <td id="prices_td">£120</td>
            <td id="prices_td">£0</td>
            <td id="prices_td">£120</td>
        </tr>
         <tr id="prices_tr">
            <td id="prices_td">A6</td>
            <td id="prices_td">2</td>
            <td id="prices_td">£240</td>
            <td id="prices_td">£24</td>
            <td id="prices_td">£216</td>
        </tr>
         <tr id="prices_tr">
            <td id="prices_td">A6</td>
            <td id="prices_td">3</td>
            <td id="prices_td">£360</td>
            <td id="prices_td">£54</td>
            <td id="prices_td">£306</td>
        </tr>
         <tr id="prices_tr">
            <td id="prices_td">A6</td>
            <td id="prices_td">4</td>
            <td id="prices_td">£480</td>
            <td id="prices_td">£120</td>
            <td id="prices_td">£360</td>
        </tr>
         <tr id="prices_tr">
            <td id="prices_td">A6</td>
            <td id="prices_td">5</td>
            <td id="prices_td">£600</td>
            <td id="prices_td">£150</td>
            <td id="prices_td">£450</td>
        </tr>
         <tr id="prices_tr">
            <td id="prices_td">A6</td>
            <td id="prices_td">6</td>
            <td id="prices_td">£720</td>
            <td id="prices_td">£180</td>
            <td id="prices_td">£540</td>
        </tr>
         <tr id="prices_tr">
            <td id="prices_td">A6</td>
            <td id="prices_td">7</td>
            <td id="prices_td">£840</td>
            <td id="prices_td">£210</td>
            <td id="prices_td">£630</td>
        </tr>

         <tr id="prices_tr_30">
            <td id="prices_td">A5</td>
            <td id="prices_td">1</td>
            <td id="prices_td">£350</td>
            <td id="prices_td">£0</td>
            <td id="prices_td">£350</td>
        </tr>
        <tr id="prices_tr_30">
            <td id="prices_td">A5</td>
            <td id="prices_td">2</td>
            <td id="prices_td">£700</td>
            <td id="prices_td">£70</td>
            <td id="prices_td">£630</td>
        </tr>
        <tr id="prices_tr_30">
            <td id="prices_td">A5</td>
            <td id="prices_td">3</td>
            <td id="prices_td">£1050</td>
            <td id="prices_td">£157.5</td>
            <td id="prices_td">£892.5</td>
        </tr>
        <tr id="prices_tr_30">
            <td id="prices_td">A5</td>
            <td id="prices_td">4</td>
            <td id="prices_td">£1400</td>
            <td id="prices_td">£350</td>
            <td id="prices_td">£1050</td>
        </tr>
        <tr id="prices_tr_30">
            <td id="prices_td">A5</td>
            <td id="prices_td">5</td>
            <td id="prices_td">£1750</td>
            <td id="prices_td">£437.5</td>
            <td id="prices_td">£1312.5</td>
        </tr>
        <tr id="prices_tr_30">
            <td id="prices_td">A5</td>
            <td id="prices_td">6</td>
            <td id="prices_td">£2100</td>
            <td id="prices_td">£525</td>
            <td id="prices_td">£1575</td>
        </tr>
        <tr id="prices_tr_30">
            <td id="prices_td">A5</td>
            <td id="prices_td">7</td>
            <td id="prices_td">£2450</td>
            <td id="prices_td">£612.5</td>
            <td id="prices_td">£1837.5</td>
        </tr>

        <tr id="prices_tr">
            <td id="prices_td">A4</td>
            <td id="prices_td">1</td>
            <td id="prices_td">£600</td>
            <td id="prices_td">£0</td>
            <td id="prices_td">£600</td>
        </tr>
        <tr id="prices_tr">
            <td id="prices_td">A4</td>
            <td id="prices_td">2</td>
            <td id="prices_td">£1200</td>
            <td id="prices_td">£120</td>
            <td id="prices_td">£1080</td>
        </tr>
        <tr id="prices_tr">
            <td id="prices_td">A4</td>
            <td id="prices_td">3</td>
            <td id="prices_td">£1800</td>
            <td id="prices_td">£450</td>
            <td id="prices_td">£1650</td>
        </tr>
        <tr id="prices_tr">
            <td id="prices_td">A4</td>
            <td id="prices_td">4</td>
            <td id="prices_td">£2400</td>
            <td id="prices_td">£600</td>
            <td id="prices_td">£1800</td>
        </tr>
        <tr id="prices_tr">
            <td id="prices_td">A4</td>
            <td id="prices_td">5</td>
            <td id="prices_td">£3000</td>
            <td id="prices_td">£750</td>
            <td id="prices_td">£2250</td>
        </tr>
        <tr id="prices_tr">
            <td id="prices_td">A4</td>
            <td id="prices_td">6</td>
            <td id="prices_td">£3600</td>
            <td id="prices_td">£900</td>
            <td id="prices_td">£2700</td>
        </tr>
        <tr id="prices_tr">
            <td id="prices_td">A4</td>
            <td id="prices_td">7</td>
            <td id="prices_td">£4200</td>
            <td id="prices_td">£1050</td>
            <td id="prices_td">£3150</td>
        </tr>

        <tr id="prices_tr_30">
            <td id="prices_td">A3</td>
            <td id="prices_td">1</td>
            <td id="prices_td">£1000</td>
            <td id="prices_td">£0</td>
            <td id="prices_td">£1000</td>
        </tr>
         <tr id="prices_tr_30">
            <td id="prices_td">A3</td>
            <td id="prices_td">2</td>
            <td id="prices_td">£2000</td>
            <td id="prices_td">£200</td>
            <td id="prices_td">£1800</td>
        </tr>
         <tr id="prices_tr_30">
            <td id="prices_td">A3</td>
            <td id="prices_td">3</td>
            <td id="prices_td">£3000</td>
            <td id="prices_td">£450</td>
            <td id="prices_td">£2550</td>
        </tr>
         <tr id="prices_tr_30">
            <td id="prices_td">A3</td>
            <td id="prices_td">4</td>
            <td id="prices_td">£4000</td>
            <td id="prices_td">£1000</td>
            <td id="prices_td">£3000</td>
        </tr>
         <tr id="prices_tr_30">
            <td id="prices_td">A3</td>
            <td id="prices_td">5</td>
            <td id="prices_td">£5000</td>
            <td id="prices_td">£1250</td>
            <td id="prices_td">£2250</td>
        </tr>
         <tr id="prices_tr_30">
            <td id="prices_td">A3</td>
            <td id="prices_td">6</td>
            <td id="prices_td">£6000</td>
            <td id="prices_td">£1500</td>
            <td id="prices_td">£4500</td>
        </tr>
         <tr id="prices_tr_30">
            <td id="prices_td">A3</td>
            <td id="prices_td">7</td>
            <td id="prices_td">£7000</td>
            <td id="prices_td">£1750</td>
            <td id="prices_td">£5250</td>
        </tr>
     </table></center>
</div></center>

