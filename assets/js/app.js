this.app = this.app || {};
(function(window, $, app){
    var linkifyAnchors = function(level, container){
        if (!(level instanceof window.Array))
            level = [level];
        
        $.each(level, function(i, level){
            if(level < 1 || level > 6)
                return;
            
            $(container + ' h' + level + '[id]').each(function(){
                var $this = $(this),
                    h = $this.html(),
                    id = $this.attr('id'),
                    $a;
                
                $a = $('<a>').attr('data-scrollto', id).html(h);
                $this.html($a);
            });
        });
    };
    
    app.linkifyAnchors = linkifyAnchors;
})(window, $, this.app)
;
this.app = this.app || {};

(function(window, $, app){
    var scrollTo = function(location){
        var pos;
        window.history.pushState({}, window.document.title, window.location.pathname + '#' + location);
        
        pos = $('#' + location.replace(/([^a-zA-Z0-9-_])/g, '\\$1')).offset().top - 96;
        pos = Math.ceil(pos);
        
        var distance = window.Math.abs($(window).scrollTop() - pos);
        var speed = 800 / 1000; // in px/ms
        var duration = distance / speed;
        $('body').animate({scrollTop: pos}, duration);
    }
    
    app.scrollTo = scrollTo;
})(window, $, this.app);



this.app = this.app || {};

(function(window, $, app){
    var $body = $('body');
    
    if(window.location.hash){
        var $scrollEl = $(window.location.hash.replace(/([^a-zA-Z0-9-_#])/g, '\\$1'));
        if($scrollEl.length){
            setTimeout(function(){
                var pos = $scrollEl.offset().top - 80 - 32;
                
                window.scrollTo(0, pos);
            }, 1);
        }
    }
    
    app.linkifyAnchors([2, 3, 4, 5, 6], '#content');
    
    $body.on('click', '[data-scrollto], [href^="#"]', function(e){
        e.preventDefault();
        
        var $this = $(this),
            location = $this.data('scrollto') || $this.attr('href').replace('#', '');
        
        app.scrollTo(location);
    });
})(window, $, this.app)
