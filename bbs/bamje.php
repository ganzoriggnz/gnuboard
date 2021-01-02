<?php

//add_stylesheet('<link rel="stylesheet" href="'.$nt_menu_url.'/menu.css">', 0);
include_once('./_common.php');


include_once('./_head.php');

// submenu 시작 
?>
<div class="col-md-9 pull-right at-col at-main" style="margin-bottom:-30px">		


<script>
	$('body').show();
	NProgress.start();
	setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
</script>
 

<style>
@import url(https://fonts.googleapis.com/css?family=Raleway:300,700);
@import url(https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css);
figure.snip1384 {
  /*font-family: 'Raleway', Arial, sans-serif;*/
  position: relative;
  float: left;
  overflow: hidden;
  color: #ffffff;
  text-align: left;
  font-size: 13px;
  background-color: #000000;
  border-radius: 10px;
}
figure.snip1384 * {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-transition: all 0.35s ease;
  transition: all 0.35s ease;
  border-radius: 10px;
}
figure.snip1384 img {
  max-width: 100%;
  backface-visibility: hidden;
  vertical-align: top;
  border-radius: 10px;
}
figure.snip1384:after,
figure.snip1384 figcaption {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  border-radius: 10px;
}
figure.snip1384:after {
  content: '';
  background-color: rgba(0, 0, 0, 0.55);
  -webkit-transition: all 0.35s ease;
  transition: all 0.35s ease;
  opacity: 0;
  border-radius: 10px;
}
figure.snip1384 figcaption {
  z-index: 1;
  padding: 20px;
  font-family: "Helvetica Neue", Helvetica, Arial, "Malgun Gothic", 돋움, Dotum;
  border-radius: 10px;
}
figure.snip1384 h3,
figure.snip1384 .links {
  width: 100%;
  margin: 5px 0;
  padding: 0;
  border-radius: 10px;
}
figure.snip1384 h3 {
  line-height: 1.1em;
  font-weight: 700;
  font-size: 1.4em;
  text-transform: uppercase;
  opacity: 0;
  border-radius: 10px;
}
figure.snip1384 p {
  font-size: 0.8em;
  font-weight: 300;
  border-radius: 10px;
  letter-spacing: 1px;
  opacity: 0;
  top: 20%;
  -webkit-transform: translateY(20px);
  transform: translateY(20px);
}
figure.snip1384 span {
  position: absolute;
  border-radius: 10px;
  bottom: 10px;
  right: 10px;
  padding: 20px 25px;
  font-size: 14px;
  opacity: 0;
  -webkit-transform: translateX(-10px);
  transform: translateX(-10px);
}
figure.snip1384 a {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 1;
  border-radius: 10px;
}
figure.snip1384:hover img,
figure.snip1384.hover img {
  zoom: 1;
  filter: alpha(opacity=50);
  -webkit-opacity: 0.4;
  opacity: 0.5;
  border-radius: 10px;
}
figure.snip1384:hover:after,
figure.snip1384.hover:after {
  opacity: 1;
  position: absolute;
  top: 10px;
  bottom: 10px;
  left: 10px;
  right: 10px;
  border-radius: 10px;
}
figure.snip1384:hover h3,
figure.snip1384.hover h3,
figure.snip1384:hover p,
figure.snip1384.hover p,
figure.snip1384:hover span,
figure.snip1384.hover i {
  -webkit-transform: translate(0px, 0px);
  transform: translate(0px, 0px);
  opacity: 1;
  border-radius: 10px;
}
	
	
.cat_menu_btn {width:75px; height:42px; border:0; border-radius:20px; text-align:center; background-color:#464446;
				float:left; margin:0 0 10px 10px;color:#f7f7f7; line-height:30px; padding-top:6px; overflow:hidden; font-weight:bold}
.cat_menu_btn_a {width:75px; height:42px; border:0; border-radius:20px; text-align:center; background-color:#86561d;
				float:left; margin:0 0 0 10px;color:#f7f7f7; line-height:15px; padding-top:6px; overflow:hidden; font-weight:bold}
.cat_menu_btn i {font-size:16px; padding-bottom:2px}

.cat_menu_btn:hover {width:75px; height:42px; border:2px solid #464446; border-radius:20px; text-align:center; background-color:#ffffff;
				float:left; margin:0 0 10px 10px;color:#464446; line-height:30px; padding-top:6px; overflow:hidden; font-weight:bold}

.cat_menu_btn2 {width:50px; height:22px; border:0; border-radius:20px; text-align:center; background-color:#757575;
				float:left; margin:2px;color:#f7f7f7; line-height:18px; padding-top:3px; overflow:hidden; font-weight:bold}
.cat_menu_btn2_a {width:50px; height:22px; border:0; border-radius:20px; text-align:center; background-color:#de1010;
				float:left; margin:2px;color:#f7f7f7; line-height:18px; padding-top:3px; overflow:hidden; font-weight:bold}
.cat_menu_btn2 i {font-size:50px; padding-bottom:2px}
	
.cat_menu_btn2:hover {width:50px; height:22px; border:1px solid #757575; border-radius:20px; text-align:center; background-color:#ffffff;
				float:left; margin:2px;color:#757575; line-height:18px; padding-top:3px; overflow:hidden; font-weight:bold}

.Btn {/*width:1020px;*/ height:25px; border:0; margin:2px auto; border-radius:5px; text-align:center; background-color:#1d1d1d; color:#fff; font-weight:900; text-decoration:none; padding-top:1px}
</style>





<div>				

			<a href="<?php echo G5_URL?>/bbs/bamje.php" title="전체">
			<div class="cat_menu_btn">
			전체<br></div></a>

				
				<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC" title="오피">
				<div class="cat_menu_btn_a">
				오피<br><span class="badge pull-center">190</span></div></a>
				
				<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%95%88%EB%A7%88" title="안마">
				<div class="cat_menu_btn">
				안마<br></div></a>
				
				<a href="//cbam1.com/bbs/cbmain.php?stx=%EA%B1%B4%EB%A7%88" title="건마">
				<div class="cat_menu_btn">
				건마<br></div></a>
				
				<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%88%A0%EC%A7%91" title="술집">
				<div class="cat_menu_btn">
				술집<br></div></a>
				
				<a href="//cbam1.com/bbs/cbmain.php?stx=%ED%9C%B4%EA%B2%8C%ED%85%94" title="휴게텔">
				<div class="cat_menu_btn">
				휴게텔<br></div></a>
				
				<a href="//cbam1.com/bbs/cbmain.php?stx=%ED%82%A4%EC%8A%A4%EB%B0%A9" title="키스방">
				<div class="cat_menu_btn">
				키스방<br></div></a>
				
				<a href="//cbam1.com/bbs/cbmain.php?stx=%EB%A6%BD%EC%B9%B4%ED%8E%98" title="립카페">
				<div class="cat_menu_btn">
				립카페<br></div></a>
				
				<a href="//cbam1.com/bbs/cbmain.php?stx=%ED%95%B8%ED%94%8C" title="핸플">
				<div class="cat_menu_btn">
				핸플<br></div></a>
				
				<a href="//cbam1.com/bbs/cbmain.php?stx=%ED%8C%A8%ED%8B%B0%EC%89%AC" title="패티쉬">
				<div class="cat_menu_btn">
				패티쉬<br></div></a>
				
				<a href="//cbam1.com/bbs/cbmain.php?stx=%EB%A6%AC%EC%96%BC%EB%8F%8C" title="리얼돌">
				<div class="cat_menu_btn">
				리얼돌<br></div></a>
				
				<a href="//cbam1.com/bbs/cbmain.php?stx=프로필-선불폰" title="기타">
				<div class="cat_menu_btn">
				기타<br></div></a>
			
</div>	
<div class="clearfix"></div>				


<script>
$(document).ready(function(){ 
    $(".Btn").click(function(){
        $(".2nd_cate").toggle();
    }); 
	
});
</script> 

<div class="2nd_cate" style="margin-left:8px; margin-bottom:5px;">

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EA%B0%95%EB%82%A8" title="강남">
<div class="cat_menu_btn2">
강남</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EA%B0%95%EC%9B%90%EB%8F%84" title="강원도">
<div class="cat_menu_btn2">
강원도</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EA%B4%91%EC%A3%BC" title="광주">
<div class="cat_menu_btn2">
광주</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EA%B5%AC%EB%A1%9C" title="구로">
<div class="cat_menu_btn2">
구로</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EA%B5%AC%EB%AF%B8" title="구미">
<div class="cat_menu_btn2">
구미</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EA%B5%B0%EC%82%B0" title="군산">
<div class="cat_menu_btn2">
군산</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EB%85%BC%EC%82%B0" title="논산">
<div class="cat_menu_btn2">
논산</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EB%8C%80%EA%B5%AC" title="대구">
<div class="cat_menu_btn2">
대구</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EB%8C%80%EC%A0%84" title="대전">
<div class="cat_menu_btn2">
대전</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EB%8F%99%ED%83%84" title="동탄">
<div class="cat_menu_btn2">
동탄</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EB%B3%84%EB%82%B4" title="별내">
<div class="cat_menu_btn2">
별내</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EB%B6%80%EC%82%B0" title="부산">
<div class="cat_menu_btn2">
부산</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EB%B6%80%EC%B2%9C" title="부천">
<div class="cat_menu_btn2">
부천</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EB%B6%84%EB%8B%B9" title="분당">
<div class="cat_menu_btn2">
분당</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%84%9C%EC%82%B0" title="서산">
<div class="cat_menu_btn2">
서산</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%84%9C%EC%9A%B8" title="서울">
<div class="cat_menu_btn2">
서울</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%84%9C%EC%9A%B8%EB%8C%80" title="서울대">
<div class="cat_menu_btn2">
서울대</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%84%A0%EB%A6%89" title="선릉">
<div class="cat_menu_btn2">
선릉</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%84%B8%EC%A2%85" title="세종">
<div class="cat_menu_btn2">
세종</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%86%A1%ED%83%84" title="송탄">
<div class="cat_menu_btn2">
송탄</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%88%98%EC%9B%90" title="수원">
<div class="cat_menu_btn2">
수원</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%8B%A0%EB%A6%BC" title="신림">
<div class="cat_menu_btn2">
신림</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%95%88%EB%8F%99" title="안동">
<div class="cat_menu_btn2">
안동</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%95%88%EC%82%B0" title="안산">
<div class="cat_menu_btn2">
안산</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%97%AD%EC%82%BC" title="역삼">
<div class="cat_menu_btn2">
역삼</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%98%A4%EC%82%B0" title="오산">
<div class="cat_menu_btn2">
오산</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%9A%B8%EC%82%B0" title="울산">
<div class="cat_menu_btn2">
울산</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%9D%80%ED%8F%89" title="은평">
<div class="cat_menu_btn2">
은평</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%9D%98%EC%A0%95%EB%B6%80" title="의정부">
<div class="cat_menu_btn2">
의정부</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%9D%B4%EC%B2%9C" title="이천">
<div class="cat_menu_btn2">
이천</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%9D%B5%EC%82%B0" title="익산">
<div class="cat_menu_btn2">
익산</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%9D%BC%EC%82%B0" title="일산">
<div class="cat_menu_btn2">
일산</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%A0%84%EC%A3%BC" title="전주">
<div class="cat_menu_btn2">
전주</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%A0%9C%EC%A3%BC%EB%8F%84" title="제주도">
<div class="cat_menu_btn2">
제주도</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%B0%BD%EC%9B%90" title="창원">
<div class="cat_menu_btn2">
창원</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%B2%9C%EC%95%88" title="천안">
<div class="cat_menu_btn2">
천안</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%EC%B2%AD%EC%A3%BC" title="청주">
<div class="cat_menu_btn2">
청주</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%ED%8F%89%ED%83%9D" title="평택">
<div class="cat_menu_btn2">
평택</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%ED%8F%AC%ED%95%AD" title="포항">
<div class="cat_menu_btn2">
포항</div></a>
			

<a href="//cbam1.com/bbs/cbmain.php?stx=%EC%98%A4%ED%94%BC&amp;stx2=%ED%95%98%EB%82%A8" title="하남">
<div class="cat_menu_btn2">
하남</div></a>
			
</div>
	
<div class="clearfix"></div>
<div style="margin-top:20px;margin-bottom:15px"></div>


<style>
#xxx {background-color:#f7f7f7; line-height:15px; height:50px; width:100px; text-align:center;padding:5px 0 5px 0;border-left:1px solid #ddde}
#xxx a {text-decoration:none;}
#xxx a:focus, #xxx a:active, #xxx a:hover {text-decoration:none;background-color:#f7f7f7}
</style>

<script src="//cbam1.com/js/jquery.ajax.queue.js"></script>


<table style="margin: auto; width: 100%">
<tbody><tr>
<td>

              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=5396 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=5396 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=5396 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#0000ff;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								포항오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>☀️3만원 할인 이벤트(기본)☀️12월14일 출근부 하니 , 지민  ☀️와꾸마인드최상☀️</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						포항-파인</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										포항터미널 근처					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01073414272</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=5396 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0061&amp;sfl=ca_name&amp;stx=%ED%8F%AC%ED%95%AD-%ED%8C%8C%EC%9D%B8 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=4964 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=4964 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=4964 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#0000ff;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								울산오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>❤️❤️그랜드 오픈❤️❤️❤️꧁✨울산 솜사탕✨꧂ ❤️❤️❤️울산 즐달의 성지❤️❤️❤️</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						울산-솜사탕</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										울산시 남구					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01058520177</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=4964 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0061&amp;sfl=ca_name&amp;stx=%EC%9A%B8%EC%82%B0-%EC%86%9C%EC%82%AC%ED%83%95 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5362 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5362 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5362 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#0000ff;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								대구오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>✡️✡️초특급 매니저 올 체인지✡️❤️✅옹달샘✅완전 대박✅내상제로✅❤️✡️우선클릭✡️✡️</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						대구-옹달샘</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										대구					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01075030702</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5362 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0060&amp;sfl=ca_name&amp;stx=%EB%8C%80%EA%B5%AC-%EC%98%B9%EB%8B%AC%EC%83%98 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=9641 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=9641 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=9641 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#33acf9;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								강남오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								VVIP								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>❤️New O.P.E.N 그랜드오픈❤️⭐️V V I P 스 페 셜 데 이⭐️❤️최고의 만족감을 위한 고퀄리티 매니저⭐️아이돌⭐️연기자⭐️스튜어디스⭐️치어리더⭐️아나운서❤️</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						강남-VVIP스페셜데이</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										강남역					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">0000000000</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=9641 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0010&amp;sfl=ca_name&amp;stx=%EA%B0%95%EB%82%A8-VVIP%EC%8A%A4%ED%8E%98%EC%85%9C%EB%8D%B0%EC%9D%B4 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0020&amp;wr_id=1044 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0020&amp;wr_id=1044 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0020&amp;wr_id=1044 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#ea990b;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								서울오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								타이								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>❤️GRAND OPEN❤️✨꧁상봉 맛집 !!! 프리미엄 오피 ꧂✨신규오픈✨</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						서울-맛집</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										서울 중랑구					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01083614849</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0020&amp;wr_id=1044 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0020&amp;sfl=ca_name&amp;stx=%EC%84%9C%EC%9A%B8-%EB%A7%9B%EC%A7%91 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=5438 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=5438 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=5438 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#0000ff;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								안동오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>❤️안동 도청 근처❤️⭐️VIP마인드⭐️러시아⭐️와꾸&amp;바디⭐️최고의 만족감⭐️내상제로⭐️❤사막의 오아시스❤</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						안동-오아시스</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										안동 도청 2분거리					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01076388827</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=5438 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0061&amp;sfl=ca_name&amp;stx=%EC%95%88%EB%8F%99-%EC%98%A4%EC%95%84%EC%8B%9C%EC%8A%A4 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0062&amp;wr_id=6346 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0062&amp;wr_id=6346 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0062&amp;wr_id=6346 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#0000ff;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								익산오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>༺ৡ ✨ 재방 0 순위 ✨ৡ༻ 예약 폭주!  내상 제로~  와꾸 싸이즈 라인업  미쳣네요 !! ██ 굿 마인드와 핫 서비스  █ █ 실물로 평가하세요! 와서 보시면  압니다!!⎠⎠</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						익산-오렌지</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										익산시 영등동					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01057658288</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0062&amp;wr_id=6346 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0062&amp;sfl=ca_name&amp;stx=%EC%9D%B5%EC%82%B0-%EC%98%A4%EB%A0%8C%EC%A7%80 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0040&amp;wr_id=2 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0040&amp;wr_id=2 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0040&amp;wr_id=2 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#ff0000;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								부천오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>❤️010-9564-4599❤️土야간 와꾸상타매니저 다수출근❤️NF다수영입❤️수질Up,마인드Up❤️와꾸파 거품없는가격❤️단체할인❤️부천1등 놀이터❤️</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						부천-놀이터</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										부천 신중동 부천소방서 맞은편인근					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01095644599</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0040&amp;wr_id=2 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0040&amp;sfl=ca_name&amp;stx=%EB%B6%80%EC%B2%9C-%EB%86%80%EC%9D%B4%ED%84%B0 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=128 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=128 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=128 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#33acf9;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								강남오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>❤️​단체 -3만 할인❤️​러블리❤️200%실사❤️​ㄴㅋ❤️ㅈㅆ❤️핸플❤️스타킹❤️영계천국❤️와꾸끝판❤️20대로리로리❤️</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						강남-러블리</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										강남					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01068239644</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=128 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0010&amp;sfl=ca_name&amp;stx=%EA%B0%95%EB%82%A8-%EB%9F%AC%EB%B8%94%EB%A6%AC " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=3789 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=3789 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=3789 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#0000ff;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								창원오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								타이								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>★유흥탐정안전업소★██ 창원  ██ 태국명품 █████ 나이키 █████즐달보장!</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						창원-나이키</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										창원시 중앙동 인근					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01076849662</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=3789 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0061&amp;sfl=ca_name&amp;stx=%EC%B0%BD%EC%9B%90-%EB%82%98%EC%9D%B4%ED%82%A4 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=10018 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=10018 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=10018 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#33acf9;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								강남오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								VVIP								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>0.1프로 회원제로 운영 *신규회원 모집*</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						강남-VVIP에비앙</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										강남					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01083658819</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=10018 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0010&amp;sfl=ca_name&amp;stx=%EA%B0%95%EB%82%A8-VVIP%EC%97%90%EB%B9%84%EC%95%99 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0050&amp;wr_id=5928 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0050&amp;wr_id=5928 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0050&amp;wr_id=5928 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#64913c;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								대전오피								</div>
							<!-- 2차 카테고리(세부업종) -->
														<!-------------------------->
                
								 <figcaption>
    								<p>■■■♥ 대전 심쿵  대전 서구 ~~ ♥■■■■ 풋풋하고 수줍은 20대 심쿵 (,,•﹏•,,) 아껴주세요 ■■■■ ☎010-7659-9309</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						대전-심쿵</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										대전					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01076599309</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0050&amp;wr_id=5928 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0050&amp;sfl=ca_name&amp;stx=%EB%8C%80%EC%A0%84-%EC%8B%AC%EC%BF%B5 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=9281 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=9281 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=9281 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#33acf9;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								강남오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>[화/야] ♥초대박NF대거영입♥그시절 우리가 좋아했던 소녀♥거품 없는 가격과 가성비믿고 찾는 그우소가 되도록 하겠습니다♥100%셀카실사♥24시간운영♥</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						강남-그우소</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										강남					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01048337611</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=9281 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0010&amp;sfl=ca_name&amp;stx=%EA%B0%95%EB%82%A8-%EA%B7%B8%EC%9A%B0%EC%86%8C " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0020&amp;wr_id=1042 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0020&amp;wr_id=1042 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0020&amp;wr_id=1042 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#ea990b;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								서울대오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								여대생								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>⭐⭐12/15 화요일 ⭐⭐☎ 010-4369-0980 ☎⭐⭐⭐⭐༺ৡ✨❤️서울대-기생❤️༺ৡ✨ ⎝⎝❤️ 매니저 모집중❤️⎠⎠</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						서울대-기생</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										서울대					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01043690980</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0020&amp;wr_id=1042 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0020&amp;sfl=ca_name&amp;stx=%EC%84%9C%EC%9A%B8%EB%8C%80-%EA%B8%B0%EC%83%9D " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=3722 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=3722 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=3722 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#ac7b35;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								의정부오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>♡♡♡초에이급 아가씨 입성♡♡♡다이아.♡이벤트♡애널문의♡♡♡고객만족200%♡♡♡ 최상의 서비스로 보답하겠습니다♡</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						의정부-바나나</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										의정부					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01083989772</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=3722 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0030&amp;sfl=ca_name&amp;stx=%EC%9D%98%EC%A0%95%EB%B6%80-%EB%B0%94%EB%82%98%EB%82%98 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5523 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5523 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5523 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#0000ff;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								대구오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>NEW OPEN ■■■ 20대 한국 출장마사지 ■■■ 대구 전지역 출장가능</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						대구-한국여대출장</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										대구					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01022719116</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5523 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0060&amp;sfl=ca_name&amp;stx=%EB%8C%80%EA%B5%AC-%ED%95%9C%EA%B5%AD%EC%97%AC%EB%8C%80%EC%B6%9C%EC%9E%A5 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5365 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5365 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5365 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#0000ff;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								대구오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>✅❤️1등 마인드❤️NF~ 수진~❤️✅⭕☀️노콘질싸 무료⭕☀️스타킹 무료⭕☀️주간,단체 및 각종 추가할인✅⭕☀️다양한 이벤트⭕☀️</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						대구-스폰지</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										대구					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01064659908</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5365 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0060&amp;sfl=ca_name&amp;stx=%EB%8C%80%EA%B5%AC-%EC%8A%A4%ED%8F%B0%EC%A7%80 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=4642 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=4642 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=4642 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#0000ff;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								대구오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>오전10시부터██████한국오피어때██████</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						대구-한국오피어때</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										대구					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01022014644</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=4642 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0060&amp;sfl=ca_name&amp;stx=%EB%8C%80%EA%B5%AC-%ED%95%9C%EA%B5%AD%EC%98%A4%ED%94%BC%EC%96%B4%EB%95%8C " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=78 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=78 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=78 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#ac7b35;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								수원오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>▂▅▇◈수원마블◈▇▅▂옵션비 무료이벤트!▶☎010-4984-7043☎◀▣어벤져스총출동!▣수원1등업소!▣재방문율100%</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						수원-마블</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										수원					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01043982515</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=78 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0030&amp;sfl=ca_name&amp;stx=%EC%88%98%EC%9B%90-%EB%A7%88%EB%B8%94 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0062&amp;wr_id=6214 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0062&amp;wr_id=6214 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0062&amp;wr_id=6214 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#0000ff;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								제주도오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>❤️✨█✨❤️#와꾸#몸매#마인드❤️✨█✨❤️✅NF+6아라✅NF+4소희✅NF+10한나✅NF+5나은✅NF+4인영✅NF+4지애✅NF+4소영✅NF+5지안❣ 옵션문의 실장믿고오는집❣</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						제주도-갤러리</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										제주 연동 한국오피쓰					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01039049102</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0062&amp;wr_id=6214 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0062&amp;sfl=ca_name&amp;stx=%EC%A0%9C%EC%A3%BC%EB%8F%84-%EA%B0%A4%EB%9F%AC%EB%A6%AC " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=3773 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=3773 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=3773 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#0000ff;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								대구오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								러시아								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>★▓█❤ 대구러시아최초 애널무료!! ❤█▓✨극강하드코어〃✅꧂★████▓◘╋━ACE천국━╋◘▓████★</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						대구-아이코스</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										대구					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01082278902</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=3773 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0060&amp;sfl=ca_name&amp;stx=%EB%8C%80%EA%B5%AC-%EC%95%84%EC%9D%B4%EC%BD%94%EC%8A%A4 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=9687 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=9687 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=9687 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#33acf9;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								강남오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								VVIP								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>⭐❤️NF뉴페이스대거섭외!!⭐▓█▇▅▂⭐❤️*꧁✨【 VVIP크롬하츠 】✨꧂*❤️⭐▂▅▇█▓⭐최고퀄리티 언니 다수보유!❤️⭐</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						강남-VVIP크롬하츠</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										강남					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01059464850</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=9687 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0010&amp;sfl=ca_name&amp;stx=%EA%B0%95%EB%82%A8-VVIP%ED%81%AC%EB%A1%AC%ED%95%98%EC%B8%A0 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=5311 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=5311 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=5311 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#0000ff;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								포항오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>.</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						포항-아로이</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										포항					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01057031790</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=5311 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0061&amp;sfl=ca_name&amp;stx=%ED%8F%AC%ED%95%AD-%EC%95%84%EB%A1%9C%EC%9D%B4 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=37 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=37 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=37 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#ac7b35;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								송탄오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>♥♥[송탄-평택]-누네띠네♥ ♥리얼 여대생 함깨! 100%레알♥NF#파티 #와꾸&amp;마인드#입소문#이게오피다#라인업전화문의~♡</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						송탄-누네띠네</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										송탄					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01084706995</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=37 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0030&amp;sfl=ca_name&amp;stx=%EC%86%A1%ED%83%84-%EB%88%84%EB%84%A4%EB%9D%A0%EB%84%A4 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5284 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5284 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5284 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#0000ff;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								대구오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>███ ⎝⎝ NF 영입! 클릭 1순위! 즐달의 명소! ⎠⎠ ███ ⎝⎝▶편안하게 즐길 수 있는 곳! 제네시스 ! ◀ ⎠⎠ ███</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						대구-제네시스</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										신세계백화점 동대구 5분					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01098608323</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5284 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0060&amp;sfl=ca_name&amp;stx=%EB%8C%80%EA%B5%AC-%EC%A0%9C%EB%84%A4%EC%8B%9C%EC%8A%A4 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=22 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=22 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=22 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#0000ff;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								대구오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>❤️화끈한NF.유진❤️인기쟁이.초이.성아.수영❤️✅노콘.질싸.무료✅❤️화끈한.서비스❤️주간할인❤️</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						대구-드라마</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										대구					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01056453855</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=22 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0060&amp;sfl=ca_name&amp;stx=%EB%8C%80%EA%B5%AC-%EB%93%9C%EB%9D%BC%EB%A7%88 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=9239 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=9239 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=9239 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#ac7b35;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								동탄오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>⎝⎝☀️최강라인업☀️⎠⎠☀️️몸매 와꾸 마인드 보장☀️️내상제로에 도전합니다 ☀️️⎝⎝</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						동탄-ROMANCE</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										동탄					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01021176611</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=9239 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0030&amp;sfl=ca_name&amp;stx=%EB%8F%99%ED%83%84-ROMANCE " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=16 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=16 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=16 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#0000ff;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								대구오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>▇▇▇ 전문유흥설계사 적극 추천업소 빠른예약 재방200% 동대구 킹스걸 !! ▇▇▇</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						대구-킹스걸</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										대구					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01022435587</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=16 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0060&amp;sfl=ca_name&amp;stx=%EB%8C%80%EA%B5%AC-%ED%82%B9%EC%8A%A4%EA%B1%B8 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=9175 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=9175 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=9175 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#ac7b35;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								하남오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>⚡⚡하남미사 델루나⚡⚡010-5512-6636⚡⚡✨━⭐️여름+3 유나+3 사랑⭐️━✨NEW 하남맛집 프리미엄오피스~!!</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						하남-오피델루나</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										하남					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01055126636</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=9175 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0030&amp;sfl=ca_name&amp;stx=%ED%95%98%EB%82%A8-%EC%98%A4%ED%94%BC%EB%8D%B8%EB%A3%A8%EB%82%98 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5404 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5404 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5404 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#0000ff;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								대구오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								타이								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>☀️⎝⎝⎛❤️또떴다 노콘NF!❤️⎞⎠⎠☀️❤️노콘❤️질싸❤️애널❤️입싸❤️얼싸❤️똥까시❤️☀️주간할인☀️단체할인☀️동시6인가능☀️TEL:010-8221-9841</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						대구-오닉스</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										대구					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01082219841</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5404 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0060&amp;sfl=ca_name&amp;stx=%EB%8C%80%EA%B5%AC-%EC%98%A4%EB%8B%89%EC%8A%A4 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5431 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5431 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5431 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#0000ff;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								대구오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>❤️​▄▀▀ 레이디보이 ▀▀▄❤️⭐​애널맛집⭐​역삽+노콘⭐​쉬멜 ⭐​트젠 ⭐​동대구역</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						대구-레이디보이</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										대구					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01059369414</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=5431 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0060&amp;sfl=ca_name&amp;stx=%EB%8C%80%EA%B5%AC-%EB%A0%88%EC%9D%B4%EB%94%94%EB%B3%B4%EC%9D%B4 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=9909 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=9909 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=9909 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#33acf9;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								강남오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								VVIP								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>0.1프로 회원제로 운영하던 그곳!!  최고의 퀄리티로 보답하겠습니다.</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						강남-VVIP구찌</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										강남					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01056455996</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=9909 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0010&amp;sfl=ca_name&amp;stx=%EA%B0%95%EB%82%A8-VVIP%EA%B5%AC%EC%B0%8C " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0040&amp;wr_id=28 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0040&amp;wr_id=28 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0040&amp;wr_id=28 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#ff0000;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								부천오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>[부천-별자리] ★★★★★★★★★★★★★★별 자 리★★★★★★★★★★★★★랜덤할인-2만행사중^&amp;^</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						부천-별자리</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										부천시청역3번출구					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01080887680</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0040&amp;wr_id=28 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0040&amp;sfl=ca_name&amp;stx=%EB%B6%80%EC%B2%9C-%EB%B3%84%EC%9E%90%EB%A6%AC " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=9212 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=9212 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=9212 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#ac7b35;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								이천오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>⭕⎝⎝༺ৡ ✅ 이천 - 슈퍼맨 ✅ৡ༻ ⎠⎠⭕ 1인1실 오피형휴게텔 ⭕ 가성비갑 ⭕ 내상제로 ⭕ 30분 8만원 ⭕</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						이천-슈퍼맨</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										이천					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01097432710</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=9212 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0030&amp;sfl=ca_name&amp;stx=%EC%9D%B4%EC%B2%9C-%EC%8A%88%ED%8D%BC%EB%A7%A8 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0062&amp;wr_id=3795 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0062&amp;wr_id=3795 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0062&amp;wr_id=3795 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#0000ff;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								전주오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>████ 신시가지 신규업소 ████(픽업무료) ⎝⎝⎛주간 무조건!! 2만 할인!!⎞⎠⎠♨♨12월27일 업뎃완료 애널,노콘,입얼싸 다가능합니다!!♨♨</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						전주-원나잇</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										신시가지 부근					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01082396622</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0062&amp;wr_id=3795 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0062&amp;sfl=ca_name&amp;stx=%EC%A0%84%EC%A3%BC-%EC%9B%90%EB%82%98%EC%9E%87 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=9665 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=9665 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=9665 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#33acf9;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								강남오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								VVIP								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>■❤️■ 신.규.오.픈 ■❤️■ ⭐♠히든 스페셜 코스♠⭐ 품격있는 럭셔리 하이엔드 V.V.I.P 히든❤️연기자✅배우✅가수✅아나운서✅스튜어디스✅대학생✅</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						강남-VVIP히든</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										강남 전지역					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01064618053</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=9665 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0010&amp;sfl=ca_name&amp;stx=%EA%B0%95%EB%82%A8-VVIP%ED%9E%88%EB%93%A0 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=2230 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=2230 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=2230 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#33acf9;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								강남오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>████✨[금]✨ ████✨언니24시구인中❤️NF연우+6❤️다경+6❤️열매+3❤️한나+3❤️클라쓰가 다르다!!❤️폭풍라인업!!❤️누굴봐도 즐달!!❤️로리천국❤️쌩초RUSH!!❤️20대 레알 여</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						강남-상류사회</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										강남역					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01055299669</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=2230 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0010&amp;sfl=ca_name&amp;stx=%EA%B0%95%EB%82%A8-%EC%83%81%EB%A5%98%EC%82%AC%ED%9A%8C " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=4705 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=4705 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=4705 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#ac7b35;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								하남오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>➿✨❤️ 하남 - 베스트 ❤️✨➿  NF 보라 / 엘 / 유나 영입　하남No.1 베스트! 가성비갑! 마인드갑! 서비스갑! 　　     　                    　광주,구리,남양주,강동,미사,덕소,송파,잠실,강일동,상</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						하남-베스트</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										하남					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01042766686</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=4705 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0030&amp;sfl=ca_name&amp;stx=%ED%95%98%EB%82%A8-%EB%B2%A0%EC%8A%A4%ED%8A%B8 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0040&amp;wr_id=14 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0040&amp;wr_id=14 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0040&amp;wr_id=14 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#ff0000;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								부천오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>▂▅▇█ 백마부대 █▇▅▂ ❤️100%러시아❤️ NEW NF 항시대기❤️ ▶성향별 맞춤초이스◀ 최고의가성비 ⭐️⭐️내상없는 업소⭐️</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						부천-백마부대</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										부천					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01033563368</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0040&amp;wr_id=14 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0040&amp;sfl=ca_name&amp;stx=%EB%B6%80%EC%B2%9C-%EB%B0%B1%EB%A7%88%EB%B6%80%EB%8C%80 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=3790 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=3790 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=3790 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#0000ff;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								포항오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>[포항-좋아요] 규리 비밀 여름 나현 윤서  &lt; 5월 23일 5명 출근!!! 토요일&gt;</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						포항-좋아요</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										포항					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01099615885</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0061&amp;wr_id=3790 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0061&amp;sfl=ca_name&amp;stx=%ED%8F%AC%ED%95%AD-%EC%A2%8B%EC%95%84%EC%9A%94 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=24 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=24 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=24 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#33acf9;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								강남오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								VVIP								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>⭐신 규 오 픈⭐상상초월 차원이 다른 차별화된 V V I P 력셔리서비스 ⭐ 짜릿한 추억을 만들어 드리겠습니다.⭐</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						강남-vvip오로라</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										강남역 3번출구					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
										</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=24 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0010&amp;sfl=ca_name&amp;stx=%EA%B0%95%EB%82%A8-vvip%EC%98%A4%EB%A1%9C%EB%9D%BC " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=58 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=58 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=58 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#ac7b35;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								의정부오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>█▀ 긴급 달림번호 변경 ▀█금일출근부 주&amp;야 ❤송이+3(한국)❤연희+3(한국)❤리+1(일본)❤캔디(태국)❤슈가(태국)❤메이(태국)❤ 스웨디시 문의</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						의정부-아레나</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										의정부					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01083545180</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=58 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0030&amp;sfl=ca_name&amp;stx=%EC%9D%98%EC%A0%95%EB%B6%80-%EC%95%84%EB%A0%88%EB%82%98 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=7607 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=7607 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=7607 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#33acf9;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								강남오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								VVIP								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>❤️ 크리스마스 Event ❤️ ⭐ V V I P 엔 트 라 ⭐ ❤️ SBS, tvN 등 드라마 위주로 활동중인 연기자 ❤️ ☀️ 유명 패션 브랜드 모델 등 ☀️ 라인업부터 확실히 다른 하이엔드 럭셔리 프리미엄 V V</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						강남-VVIP엔트라</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										강남					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">텔레그램SVVIPS</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0010&amp;wr_id=7607 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0010&amp;sfl=ca_name&amp;stx=%EA%B0%95%EB%82%A8-VVIP%EC%97%94%ED%8A%B8%EB%9D%BC " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0050&amp;wr_id=5934 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0050&amp;wr_id=5934 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0050&amp;wr_id=5934 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#64913c;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								대전오피								</div>
							<!-- 2차 카테고리(세부업종) -->
														<!-------------------------->
                
								 <figcaption>
    								<p>꧁▂▅▇██████✨즐달의명소✨██████▇▅▂꧂단체환영♥ 내상ZERO ♥ 와꾸 TOP ♥</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						대전-데이트</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										대전					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01083709823</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0050&amp;wr_id=5934 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0050&amp;sfl=ca_name&amp;stx=%EB%8C%80%EC%A0%84-%EB%8D%B0%EC%9D%B4%ED%8A%B8 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0050&amp;wr_id=5672 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0050&amp;wr_id=5672 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0050&amp;wr_id=5672 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#64913c;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								청주오피								</div>
							<!-- 2차 카테고리(세부업종) -->
														<!-------------------------->
                
								 <figcaption>
    								<p>★일요일★████✨주2시부터 이쁨✨████+3영지+2?3마리+2?3?NF세나+2NF소연+2NF주희★██████24시면접██████</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						청주-벤틀리</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										청주					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01021741802</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0050&amp;wr_id=5672 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0050&amp;sfl=ca_name&amp;stx=%EC%B2%AD%EC%A3%BC-%EB%B2%A4%ED%8B%80%EB%A6%AC " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=9269 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=9269 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=9269 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#ac7b35;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								의정부오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>※ 랜덤할인2만/※◆★하드코어★마인드＆서비스//굿//풀옵션★소다＆미나＆유리★◆★로리 영계 수정★◆★즐달은 의정부스타일에서....★◆</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						의정부-스타일</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										의정부 시내					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01048389910</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=9269 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0030&amp;sfl=ca_name&amp;stx=%EC%9D%98%EC%A0%95%EB%B6%80-%EC%8A%A4%ED%83%80%EC%9D%BC " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0050&amp;wr_id=5925 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0050&amp;wr_id=5925 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0050&amp;wr_id=5925 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#64913c;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								서산오피								</div>
							<!-- 2차 카테고리(세부업종) -->
														<!-------------------------->
                
								 <figcaption>
    								<p>⎝⎝⎛❤️❤️VVIP 서산-여신강림 VVIP❤️❤️⎞⎠⎠✨✨신규오픈✨한국와꾸걸✨재방문률1등!이유가있겟죠?✨</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						서산-여신강림</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										서산전화주세요					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01021430566</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0050&amp;wr_id=5925 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0050&amp;sfl=ca_name&amp;stx=%EC%84%9C%EC%82%B0-%EC%97%AC%EC%8B%A0%EA%B0%95%EB%A6%BC " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0040&amp;wr_id=4181 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0040&amp;wr_id=4181 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0040&amp;wr_id=4181 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#ff0000;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								부천오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>⎝⎝⎛✨010-7615-9489✨⎞⎠⎠❤️ɞ 월요일 야간/부천NO.1오피스텔 ʚ❤️​100% 무보정 실사!⭐❤️리 얼 20대 천국!!⭐❤️와꾸 서비스 마인드 최고업소!!⭐❤️​재방문율300%⭐❤️​</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						부천-솜사탕</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										부천					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01076159489</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0040&amp;wr_id=4181 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0040&amp;sfl=ca_name&amp;stx=%EB%B6%80%EC%B2%9C-%EC%86%9C%EC%82%AC%ED%83%95 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=6899 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=6899 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=6899 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#ac7b35;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								송탄오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								오피								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>[ 유투브 ]❤️최고와꾸!✔최상마인드✔미친Line UP✔NF무한영입 ✅송탄 1등 업소 ✅ ❤️#20대#상큼#민간인#와꾸#로리#마인드#즐달❤️ 아무나골라잡아 내상제로 100%도전! ❤️</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						송탄-유투브</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										서정리역 인근					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01074951233</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0030&amp;wr_id=6899 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0030&amp;sfl=ca_name&amp;stx=%EC%86%A1%ED%83%84-%EC%9C%A0%ED%88%AC%EB%B8%8C " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>




              

<div style="float:left;width:198px;margin:5px; border:1px solid #adadad; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->

<a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=3772 " id="line-up" class="item" style="text-decoration:none">	</a><div class="list-col"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=3772 " id="line-up" class="item" style="text-decoration:none">
		</a><div class="list-box"><a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=3772 " id="line-up" class="item" style="text-decoration:none">
			<div class="list-front" style="height:130px">
				<div class="list-img">
					<div class="imgframe">
						<div class="img-wrap">
							<div class="img-item">
							
            <figure class="snip1384">
																<img src="//cbam1.com/img/category/s_1.gif">
																<div class="addr" style=" position:absolute;top:-15px;right:-37px; color:#fff; background-color:#0000ff;
								width:100px; height:55px; font-size:12px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height:95px; font-weight:bold; 
								z-index:999; border:0; border-radius:3px; text-align:center; padding: 0 5px 0 5px; -webkit-transform:rotate(45deg); -ms-transform:rotate(45deg);">
								대구오피								</div>
							<!-- 2차 카테고리(세부업종) -->
															<div class="addr" style="position:absolute; bottom:30px; color:#fff; background-color:#1cb976; width:100px; height:30px; font-size:13px; filter:alpha(opacity=85); opacity:0.85; -moz-opacity:0.85; line-height: 30px; font-weight:bold; z-index:999; border:0; border-top-right-radius:15px; border-top-left-radius:0px; border-bottom-right-radius:0px; text-align:center; padding: 0 5px 0 5px; -ms-transform:rotate(45deg);">
								러시아								</div>
														<!-------------------------->
                
								 <figcaption>
    								<p>█♥대구 최상의 퀄리티 러시아 ♥█⎝⎝⎛꧁초특급NF⎞⎠⎠█♡동대구역♡█⎝⎝⎛꧁ ACE Crazy라인업 ꧂⎞⎠⎠███</p>
  								 </figcaption>
							</figure>
<script>
	$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);
</script>								

								
							</div>
						</div>
					</div>
				</div>
			</div>
								<div class="list-text">
										
					<div class="list-desc">
						<div class="list-subject" style="color:#ff0000; font-weight:bold; line-height:20px; font-size:15px; height:20px; max-width:240px; overflow:hidden; text-align:center">
						대구-에쎄체인지</div>

					<div style="color:#000000; font-weight:600; line-height:20px; font-size:13px; height:20px; text-align:center; max-width:240px; overflow:hidden;"><span class="glyphicon glyphicon-map-marker"></span>
										동구 신세계 백화점 부근					</div>
										
					<div style="color:#000000; line-height:20px; font-size:13px; font-weight:600; height:20px; text-align:center; max-width:240px; overflow:hidden; margin-bottom:10px">
					<span class="glyphicon glyphicon-phone" style="color: #808080; font-size: 12px;">01023657712</span>					</div>
				
				</div>				
				
				


				</div>	
</a>				
				<div class="clearfix"></div>
				
				<table style="background-color:#f2f2f2; border-top:1px solid #adadad; width:100%; height:62px; border-radius: 15px"> <!-- 모서리 둥글게 추가 -->
						<tbody><tr>
						<td class="list_2_btn">
                                <a href="//cbam1.com/bbs/board.php?bo_table=lp_0060&amp;wr_id=3772 " id="line-up" class="item" style="text-decoration:none">
                              <div style="width:100%;height:100%;margin-top:10px">기방정보</div></a></td>
						<td class="list_2_btn">
							 <a href=" //cbam1.com/bbs/board.php?bo_table=bo_0060&amp;sfl=ca_name&amp;stx=%EB%8C%80%EA%B5%AC-%EC%97%90%EC%8E%84%EC%B2%B4%EC%9D%B8%EC%A7%80 " id="after-note" class="item" style="text-decoration:none">						<div style="width: 100%; height: 100%; margin-top: 10px">						
						기방야화</div></a>
						</td>
						</tr>
				</tbody></table>
			</div>
		</div>
	</div>





</td></tr></tbody></table>
<nav class="pg_wrap"><span class="pg"><span class="sound_only">열린</span><strong class="pg_current">1</strong><span class="sound_only">페이지</span>
<a href="?&amp;stx=%EC%98%A4%ED%94%BC&amp;stx=오피&amp;stx2=&amp;stx3=&amp;page=2" class="pg_page">2<span class="sound_only">페이지</span></a>
<a href="?&amp;stx=%EC%98%A4%ED%94%BC&amp;stx=오피&amp;stx2=&amp;stx3=&amp;page=3" class="pg_page">3<span class="sound_only">페이지</span></a>
<a href="?&amp;stx=%EC%98%A4%ED%94%BC&amp;stx=오피&amp;stx2=&amp;stx3=&amp;page=4" class="pg_page">4<span class="sound_only">페이지</span></a>
<a href="?&amp;stx=%EC%98%A4%ED%94%BC&amp;stx=오피&amp;stx2=&amp;stx3=&amp;page=4" class="pg_page pg_end">맨끝</a>
</span></nav>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-165006647-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-165006647-1');
</script>
													</div>



                <?php

                include_once('./_tail.php');
                ?>