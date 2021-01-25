/**
 * 탭메뉴를 쉽고 편리하게 사용하기 위해 만든 "rumitab(루미탭)" 입니다.
 * 궁금한 사항이 있으시면 메일로 문의 바랍니다.
 * 제작자 : 루미집사 (조정영)
 * 이메일 : cjy7627@naver.com
 * 홈페이지 : https://www.suu.kr
 * 저작권 : 저작권은 제작자에게 있습니다. 상용으로 사용은 가능하나 본 플러그인만 판매는 불가합니다.
 * 최초제작일 : 2019년 4월 14일
  */
(function($) {
    "use strict";
    $.fn.rumiTab = function(option) {
        var cfg = {
            selectorCl      : "ul.rumitab li",     // 탭메뉴(타이틀) Selector
            conteNt         : "div.rumitab_content",// 탭메뉴의 내용이 표시될 Selector 
            container       : "div.rumitab_container ",// 탭메뉴의 본문 박스 Selector 
            interValtime    : 3000,     // 1000 = 1초
            auTo            : "false",  // 자동탭 (true, false)
            starttabNo      : 0,        // 초기 열려있는 탭번호 ( 0 ~ N)
            activeCl        : "active", // 선택된 탭의 스타일 class (CSS)
            activecCss      : "",       // 아직 사용하지 않음
            autoDirection   : "next",   // 자동탭 스타일 (next, prev, random)
            tabAlign        : "left",   // 탭메뉴 좌,우 정렬 (left, right)
            mEvent          : "click",   // 마우스이벤트 (mouseenter or click)
            containerH      : 250
        };
       
        if(option && typeof option == "object") {
            cfg = $.extend(cfg, option);
        };

        this.interval = null; // interval 초기화.

        var rumiThis    = this;
        var $el     = this.find(cfg.selectorCl); // 탭(타이틀)
        var $content= this.find(cfg.conteNt); // 탭(본문)
        var N = $el.length; 
        var arr = Array.apply(null, {length: N}).map(Number.call, Number); // 0부터 ~ 탭의 마지막번호까지 배열 생성.
        var mouse_event = (cfg.mEvent == "click")?  "click": cfg.mEvent+" click"; // 마우스이벤트감지 (클릭이 아니면 클릭이벤트 추가)

        // 탭에 <a> 링크를 클릭 이동 금지.
        $el.on("click", "a", function(e) {
            e.preventDefault();
        });

        //시작탭번호가 설정되어 있는지 체크
        if(isNaN(cfg.starttabNo)) {
            cfg.starttabNo = 0; //시작탭번호가 없으면 0
        };

        var idx = cfg.starttabNo; // 초기 시작 탭번호
        
        cfg.tabMove = function(e){
            idx = $el.index($(this)); // 선택된 탭 index를 대입.
            var $this   = $(this);
            var rel     = $this.attr("rel");
            
            $el.removeClass(cfg.activeCl).css({"color":"#333"});
            $this.addClass(cfg.activeCl).css({"color":"#333"});
            $content.hide();                       
            rumiThis.hrEf($this, rel); // 클릭한 위치에 a링크가 있으면 href값의 문서를 불러온다.            
            $("#"+rel).fadeIn();           
        };

        // data-url값 구해서 외부문서 불러오기.
        this.hrEf=function(z,rel) {
            var $dataurl = z.attr("data-url"); // 탭에 링크값 구하기.
            if($dataurl!=undefined) { // 클릭한 탭에 a태그의 링크가 비어있지 않다면. (있다면)
                $("#"+rel).load($dataurl); // data-url - 외부문서를 로드
            };
        };

        $el.on(mouse_event, function(e){
            var $this= $(this);
            var link = $this.find("a").attr("href"); // 탭에 링크가 있으면.
            var cLass= $this.hasClass(cfg.activeCl); // 클래스가 존재하면 true 반환
            
            // 선택된 탭을 다시 클릭시 <a>태그의 링크 이동. (마우스로 클릭시에만 링크 이동.)
            if(e.which==1 && cLass==true && link!=undefined){
                location.href=link;
            };
            
            // 탭이 열리지 않은 상태에서만 탭 content내용을 불러온다.
            if(!cLass) {
                cfg.tabMove.apply(this);   
            };
        });

        // true이면 자동탭실행.
        if(cfg.auTo==true){
            this.mouseenter(function(){
                rumiThis.clearTimer();
            }).mouseleave(function(){
                rumiThis.startAuto();
            });
        };

        // 다음 탭으로 이동.
        this.nextTab = function(){
            var nextTabidx = idx + 1;
            if(nextTabidx >= $el.length){
                nextTabidx = 0;
            };
            cfg.tabMove.apply($el.eq(nextTabidx));
        };

        // 이전 탭으로 이동.
        this.prevTab = function(){
            var nextTabidx = idx - 1;
            if(nextTabidx < 0){
                nextTabidx = $el.length - 1;
            };
            cfg.tabMove.apply($el.eq(nextTabidx));
        };

        // 랜덤으로 탭 선택
        this.randomTab = function(){
            var randIdx = arr[Math.floor(Math.random()*arr.length)];
            cfg.tabMove.apply($el.eq(randIdx));
        };

        // interval 시작
        this.startAuto = function(preventControlUpdate){
            var othis = this;
         
            if(othis.interval){
                return;
            };

            if(cfg.interValtime){
                othis.interval = setInterval(function(){
                    switch(cfg.autoDirection) {
                        case "next":
                            othis.nextTab();
                            break;
                        case "prev":
                            othis.prevTab();
                            break;
                        case "random":
                            othis.randomTab();
                            break;
                        default :
                            othis.nextTab();
                            break;                          
                    }
                }, cfg.interValtime);
            };
        };

        // interval 종료
        this.clearTimer = function(){
            var othis = this;
            if( othis.interval ){
                clearInterval(othis.interval);
                othis.interval = null;
            };
        };
    
        this.init = function(){
            var othis = this;
            
            cfg.tabMove.apply($el.eq(idx)); // 최초 탭 활성화
            $(this.selector+" > .rumitab_container").css({"height":cfg.containerH+"px"});

            // 좌측정렬시
            if(cfg.tabAlign=="right"){
                this.css({"text-align":cfg.tabAlign});
                $el.css({"left":"1px"}); // 1픽셀 보정
            };

            if(cfg.auTo==true) {
                setTimeout( function() { othis.startAuto() }, 1 );
            };
        };
        this.init();
        return this;
    };
}(jQuery));