jQuery(function($){

    // Accessible Menus: do not use display:none to hide content
    // http://alistapart.com/article/now-you-see-me
    $('.menu-toggle').on('click', function(e) {
        e.preventDefault();
        target = '#'+$(this).attr('data-slide-nav');

        // Hide the siblings
        $(target).siblings().each(function(){
            if (!$(this).hasClass('hidden')){
                $(this).slideUp(500, function(){
                    $(this).addClass('hidden').slideDown(0);
                });
            }
        });

        // Rotate the arrows
        $(this).siblings('i').toggleClass('cuny-icon-swipe_u').toggleClass('cuny-icon-swipe_d');
        $(this).parent().siblings().each(function(){
            $(this).find('i').addClass('cuny-icon-swipe_d').removeClass('cuny-icon-swipe_u');
        });

        // Toggle the target
        if ($(target).hasClass('hidden')){
            $(target).slideUp(0, function(){
                $(target).removeClass('hidden').slideDown(500);
            });
        }
        else{
            $(target).slideUp(500, function(){
                $(target).addClass('hidden').slideDown(0);
            });
        }
    });

    $('.more-toggle').click( function(){
        if ( ( !$(this).attr('data-close-others') || $(this).attr('data-close-others') == 'true' ) && !$(this).hasClass('more-toggle-open') ) {
            $('.more-toggle-open').not(this).each(
                function(){
                    data_label_toggle = $(this).attr('data-label-toggle') ? $(this).attr('data-label-toggle') : 'More';
                    $(this).removeClass('more-toggle-open').attr('data-label-toggle', $(this).html()).html(data_label_toggle);
                    $(this).parents().next('.hidden-content').slideUp(300);
                }
            );
        }

        data_label_toggle = $(this).attr('data-label-toggle') ? $(this).attr('data-label-toggle') : ( $(this).hasClass('more-toggle-open') ? 'More' : 'Less' );
        $(this).toggleClass('more-toggle-open').attr('data-label-toggle', $(this).html()).html(data_label_toggle);
        $(this).parents().next('.hidden-content').slideToggle(300);
    });

    $('.close-sliding-nav').click(function(e){
        e.preventDefault();
        $(this).parent().slideUp(500,function(){
            $(this).addClass('hidden').slideDown(0);
        });

        $('.menu-toggle').siblings('i').each(function(){
            $(this).addClass('cuny-icon-swipe_d').removeClass('cuny-icon-swipe_u');
        });
    });

    enquire.register("screen and (max-width:767px)", {
        match: function(){
            // Main and Role Navs
            if ($('#main-role-nav-content').length == 0) {
                container = $('<div />').attr('id', 'main-role-nav-content').addClass('hidden');
                container.appendTo('#mobile-menu-container');
            }
            $('#main-nav-content').toggleClass('wpb_column vc_col-sm-12').detach().appendTo(container);
            $('#role-nav-content').toggleClass('wpb_column vc_col-sm-12').detach().appendTo(container);

            // Login Nav
            $('#login-nav-content').toggleClass('wpb_column vc_col-sm-12').addClass('hidden').detach().appendTo('#mobile-menu-container');

            // Search Form
            $('#main-search-form').toggleClass('wpb_column vc_col-sm-12').addClass('hidden').detach().appendTo('#mobile-menu-container');

            // Contextual Menu
            nav = $('ul.navigation,ul#menu-side-navigation');
            if (nav.length == 1){
                nav.addClass('hidden').attr('id', 'contextual-nav-content').css('display', 'block').detach().appendTo('#mobile-menu-container');
                $('#mobile-contextual-menu-container').removeClass('hidden');
            }
        },   

        unmatch: function(){
            // Main Nav
            $('#main-nav-content').toggleClass('wpb_column vc_col-sm-12').detach().prependTo('#main-nav');
            $('#role-nav-content').toggleClass('wpb_column vc_col-sm-12').detach().prependTo('#role-nav');

            // Login Nav
            $('#login-nav-content').toggleClass('wpb_column vc_col-sm-12').removeClass('hidden').detach().appendTo('#login-nav ul.inline li:first-child');

            // Search Form
            $('#main-search-form').toggleClass('wpb_column vc_col-sm-12').removeClass('hidden').detach().insertAfter('#main-nav');

            // Contextual Menu
            nav = $('ul.navigation');
            if (nav.length > 0){
                nav.removeClass('hidden').prependTo('.sidebar > .wpb_wrapper:first-child');
                $('#mobile-contextual-menu-container').addClass('hidden');
            }
        }
    });
});

/*!
 * matchMedia() polyfill - Test a CSS media type/query in JS. 
 * Authors & copyright (c) 2012: Scott Jehl, Paul Irish, Nicholas Zakas, David Knight.
 * Dual MIT/BSD license 
 */
window.matchMedia||(window.matchMedia=function(){"use strict";var e=window.styleMedia||window.media;if(!e){var t=document.createElement("style"),n=document.getElementsByTagName("script")[0],r=null;t.type="text/css";t.id="matchmediajs-test";n.parentNode.insertBefore(t,n);r="getComputedStyle"in window&&window.getComputedStyle(t,null)||t.currentStyle;e={matchMedium:function(e){var n="@media "+e+"{ #matchmediajs-test { width: 1px; } }";if(t.styleSheet){t.styleSheet.cssText=n}else{t.textContent=n}return r.width==="1px"}}}return function(t){return{matches:e.matchMedium(t||"all"),media:t||"all"}}}());
(function(){if(window.matchMedia&&window.matchMedia("all").addListener){return false}var e=window.matchMedia,t=e("only all").matches,n=false,r=0,i=[],s=function(t){clearTimeout(r);r=setTimeout(function(){for(var t=0,n=i.length;t<n;t++){var r=i[t].mql,s=i[t].listeners||[],o=e(r.media).matches;if(o!==r.matches){r.matches=o;for(var u=0,a=s.length;u<a;u++){s[u].call(window,r)}}}},30)};window.matchMedia=function(r){var o=e(r),u=[],a=0;o.addListener=function(e){if(!t){return}if(!n){n=true;window.addEventListener("resize",s,true)}if(a===0){a=i.push({mql:o,listeners:u})}u.push(e)};o.removeListener=function(e){for(var t=0,n=u.length;t<n;t++){if(u[t]===e){u.splice(t,1)}}};return o}})();

/*!
 * enquire.js v2.1.2 - Awesome Media Queries in JavaScript
 * Copyright (c) 2014 Nick Williams - http://wicky.nillia.ms/enquire.js
 * License: MIT (http://www.opensource.org/licenses/mit-license.php)
 */

!function(a,b,c){var d=window.matchMedia;"undefined"!=typeof module&&module.exports?module.exports=c(d):"function"==typeof define&&define.amd?define(function(){return b[a]=c(d)}):b[a]=c(d)}("enquire",this,function(a){"use strict";function b(a,b){var c,d=0,e=a.length;for(d;e>d&&(c=b(a[d],d),c!==!1);d++);}function c(a){return"[object Array]"===Object.prototype.toString.apply(a)}function d(a){return"function"==typeof a}function e(a){this.options=a,!a.deferSetup&&this.setup()}function f(b,c){this.query=b,this.isUnconditional=c,this.handlers=[],this.mql=a(b);var d=this;this.listener=function(a){d.mql=a,d.assess()},this.mql.addListener(this.listener)}function g(){if(!a)throw new Error("matchMedia not present, legacy browsers require a polyfill");this.queries={},this.browserIsIncapable=!a("only all").matches}return e.prototype={setup:function(){this.options.setup&&this.options.setup(),this.initialised=!0},on:function(){!this.initialised&&this.setup(),this.options.match&&this.options.match()},off:function(){this.options.unmatch&&this.options.unmatch()},destroy:function(){this.options.destroy?this.options.destroy():this.off()},equals:function(a){return this.options===a||this.options.match===a}},f.prototype={addHandler:function(a){var b=new e(a);this.handlers.push(b),this.matches()&&b.on()},removeHandler:function(a){var c=this.handlers;b(c,function(b,d){return b.equals(a)?(b.destroy(),!c.splice(d,1)):void 0})},matches:function(){return this.mql.matches||this.isUnconditional},clear:function(){b(this.handlers,function(a){a.destroy()}),this.mql.removeListener(this.listener),this.handlers.length=0},assess:function(){var a=this.matches()?"on":"off";b(this.handlers,function(b){b[a]()})}},g.prototype={register:function(a,e,g){var h=this.queries,i=g&&this.browserIsIncapable;return h[a]||(h[a]=new f(a,i)),d(e)&&(e={match:e}),c(e)||(e=[e]),b(e,function(b){d(b)&&(b={match:b}),h[a].addHandler(b)}),this},unregister:function(a,b){var c=this.queries[a];return c&&(b?c.removeHandler(b):(c.clear(),delete this.queries[a])),this}},new g});