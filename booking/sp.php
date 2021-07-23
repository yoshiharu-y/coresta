<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8" />
<title>予約・応募フォーム連動 営業日カレンダー</title>
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<meta name="format-detection" content="telephone=no">

<!-- Bootstrap -->
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/font-awesome.min.css" rel="stylesheet">

<link href="../css/owl.carousel.css" rel="stylesheet">
<link href="../css/owl.theme.css" rel="stylesheet">
<link href="../css/owl.transitions.css" rel="stylesheet">
<link href="../css/cs-select.css" rel="stylesheet">
<link href="../css/bootstrap-datepicker3.min.css" rel="stylesheet">
<link href="../css/freepik.hotels.css" rel="stylesheet">
<link href="../css/nivo-lightbox.css" rel="stylesheet">
<link href="../css/nivo-lightbox-theme.css" rel="stylesheet">

<link href="../css/style.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="../js/html5shiv.min.js"></script>
<script src="../js/respond.min.js"></script>
<![endif]-->

<script src="../js/modernizr.custom.min.js"></script>

<style>
h2.sp-title{
	background:#333;
	border-radius:6px;
	color:#fff;
	text-align:center;
	padding:2px;
	text-shadow:none;
	font-size:120%;
	margin:3px;
}
/*土曜の文字色*/
.youbi_6{
	color:#36F;
}
/*祝日と日曜の文字色*/
.youbi_0,.shukujitu{
	color:red;
}
/*本日の背景色　※ただし設定ファイルでの設定が優先されます*/
.today{
	background:#FF9;
}
/*休業日設定した日の背景色　※ただし設定ファイルでの設定が優先されます*/
.holiday{
	background:#FDD;	
}
/*定休日設定した日の背景色　※ただし設定ファイルでの設定が優先されます*/
.closed{
	background:#FDD;	
}
.hidden{
	display:none;	
}
/*休業日テキスト部の左側の四角*/
.holidayCube{
	display:inline-block;
	width:13px;
	height:13px;
	margin:3px 3px 0 3px;
	position:relative;
	top:2px;
}
/*定休日テキスト部の左側の四角*/
.closedCube{
	display:inline-block;
	width:13px;
	height:13px;
	margin:3px 3px 0 3px;
	position:relative;
	top:2px;
}
.scheduleComment{
	font-size:80%;
	font-weight:normal;
	color:#333;
}
.schedulePulldownList{
	font-size:90%;
	font-weight:normal;
	color:#333;
	padding:5px 0 5px;
	border-bottom:2px dotted #aaa;
}
#formWrap{
	margin:0 10px;	
}
.borderless{border:0!important}
</style>

	</head>
	<body>
		<div class="preloader"></div>
		<header class="header transp sticky"> <!-- available class for header: .sticky .center-content .transp -->
			<nav class="navbar navbar-inverse">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#"><img src="../images/logo.png" alt="logo"></a>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<li  class="active"><a href="../index.html">トップ</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">コース内容 <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="../lesson.html">コース一覧</a></li>
									<li><a href="../lesson-1.html">松コース</a></li>
									<li><a href="../lesson-2.html">竹コース</a></li>
									<li><a href="../lesson-3.html">梅コース</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="../price.html">料金</a>
							</li>
							<li><a href="../blog.html">ブログ</a></li>
							<li><a href="../access.html">アクセス</a></li>
							<li><a href="../contact.html">お問い合わせ</a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
					<!--<div class="mg-search-box-cont pull-right">
						<a href="#" class="mg-search-box-trigger"><i class="fa fa-search"></i></a>
						<div class="mg-search-box">
							<form>
								<input type="text" name="s" class="form-control" placeholder="Type Keyword...">
								<button type="submit" class="btn btn-main"><i class="fa fa-search"></i></button>
							</form>
						</div>
					</div>-->
				</div><!-- /.container-fluid -->
			</nav>
		</header>

		<div class="mg-page-title parallax">
			<div class="container">
				<div class="row">
					<div class="col-md-12">

						<h2>予約システム</h2>
						<p>ご予約はこちらから</p>
					</div>
				</div>
			</div>
		</div>

		<div class="mg-page mg-available-rooms">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
<!--　▼▼▼既存のページ等に表示させるにはここからコピペ下さい▼▼▼　-->
<!--<div id="index" data-role="page" data-theme="d">-->
<?php require_once('calendar_form/admin/config.php');//設定ファイルインクルード（config.phpへの相対パス）※設置箇所が変わる場合は要変更?>

<?php if(!isset($_POST["reservSubmit"]) && empty($_GET['mode'])){//▼カレンダーを表示（フォームは非表示）▼ ?>

<?php if(!$copyright) exit($warningMesse); else {$scheduleCalender = scheduleCalenderSp($ym,$timeStamp);?>
<h2 class="sp-title" style="background:<?php echo $headerBgColor;?>;color:<?php echo $headerColor;?>"><?php echo $scheduleCalender['calnderHeaderYm'];?></h2>

<div data-role="controlgroup" data-type="horizontal" style="text-align:center">
<?php if(!empty($scheduleCalender['dspPrev'])){ ?>
<a data-ajax="false" data-role="button" href="?ym=<?php echo $scheduleCalender['dspPrev'];?>">&laquo; 前月へ</a>
<?php } ?>

<?php if(!empty($scheduleCalender['dspNext'])){ ?>
<a data-ajax="false" data-role="button" href="?ym=<?php echo $scheduleCalender['dspNext'];?>">翌月へ &raquo;</a>
<?php } ?>
</div><!-- /controlgroup -->

<!--　▼以下休業日、定休日テキスト箇所。すべて削除してしまってオリジナルでももちろんOKです▼　-->
<p class="small"><?php if($closedText) echo $closedText ;//定休日テキスト（オリジナルも可）?><span class="holidayCube" style="background:<?php echo $holidayBg ;?>"></span>休業日</p>
<!--　▲休業日、定休日テキスト箇所ここまで▲　-->

<ul data-role="listview" data-theme="d">
<?php echo $scheduleCalender['body'];//カレンダー出力（カレンダー自体のタグ等を変更したい場合はfunction.php内を変更下さい）?>
</ul>

<div data-role="controlgroup" data-type="horizontal" style="text-align:center">
<?php if(!empty($scheduleCalender['dspPrev'])){ ?>
<a data-ajax="false" data-role="button" href="?ym=<?php echo $scheduleCalender['dspPrev'];?>">&laquo; 前月へ</a>
<?php } ?>

<?php if(!empty($scheduleCalender['dspNext'])){ ?>
<a data-ajax="false" data-role="button" href="?ym=<?php echo $scheduleCalender['dspNext'];?>">翌月へ &raquo;</a>
<?php } ?>
</div><!-- /controlgroup -->

<?php Uqa4h78r();}//著作権表記リンク無断削除禁止（削除すると全機能、または一部機能が失われます）?>


<?php }else{//▼申し込みフォームを表示（カレンダーは非表示）▼ ?>



<?php
//予約日時をカレンダーから取得（変更不可）
$date = (isset($_GET["date"])) ? calf_h($_GET["date"]) : exit('日付が選択されていません。戻って選択しなおして下さい<br /><a href="javascript:history.back()">戻る&raquo;<a>');
$time = (isset($_GET["time"])) ? calf_h($_GET["time"]) : '';
$dateArray = explode("-",$date);
$dspDate = $dateArray[0]."年".$dateArray[1]."月".$dateArray[2]."日";//日付フォーマットの変更
$dspDate .= ($weekDsp == 1) ? '（'.$weekArray[date('w',strtotime($date))].'）' : '';//曜日を表示する（設定ファイルでONの場合のみ）
$dspDate .= " ".$timeArray[$time];//時間リストの反映
?>

<!-- ▼予約フォーム表示▼ ※デフォルトを参考に項目などは自由に変更下さい。全項目を自動で取得、送信します。（PC（pc.php）、スマホ（sp.php）、ガラケー（i.php）それぞれ変更下さい ※使うデバイスのみでOKです） -->

<div id="formWrap">
<a data-ajax="false" data-role="button" href="?page=back">前画面に戻る</a>

<h2>予約フォーム</h2>
<p>下記フォームに必要事項を入力後、確認ボタンを押してください。</p>
  
  
<form action="calendar_form/mail/sp.php" method="post" data-ajax="false">

<div data-role="fieldcontain">
<?php echo $selectDateText;?> <br />
<?php echo $dspDate;?> <input type="hidden" name="reserv[date]" value="<?php echo $date;?>" /><input type="hidden" name="reserv[time]" value="<?php echo $time;?>" />
</div>


<div data-role="fieldcontain">
お名前 <span class="col19">*</span><br /><input size="20" type="text" name="お名前" />
</div>


<div data-role="fieldcontain">
電話番号（半角） <br /><input size="30" type="text" name="電話番号" />
</div>

<div data-role="fieldcontain">
メールアドレス（半角）<span class="col19">*</span><br /> <input size="30" type="text" name="メールアドレス" />
</div>

<div data-role="fieldcontain">
性別<br>
<fieldset data-role="controlgroup">
<input name="性別" id="men" type="radio" value="男" />
<label for="men">男</label>
<input name="性別" type="radio" value="女" id="female" />
<label for="female">女</label> 
</fieldset>

</div>

<div data-role="fieldcontain">
サイトを知ったきっかけ <br />
<fieldset data-role="controlgroup">
<input name="サイトを知ったきっかけ[]" type="checkbox" value="友人・知人" id="checkbox01" /><label for="checkbox01">友人・知人　</label> 
<input name="サイトを知ったきっかけ[]" type="checkbox" value="検索エンジン" id="checkbox02" /><label for="checkbox02">検索エンジン</label>
</fieldset>

</div>

<div data-role="fieldcontain">
お問い合わせ内容 <br /><textarea name="お問い合わせ内容" cols="50" rows="5"></textarea>
</div>

<div data-role="fieldcontain">
<input type="submit" value="　 確認 　" />
</div>

</form>

</div>
<?php Uqa4h78r();}//著作権表記リンク無断削除禁止（削除すると全機能、または一部機能が失われます）?>



<!--</div>-->
<!-- ▲▲▲コピペここまで▲▲▲ -->
					</div>
				</div>
			</div>
		</div>

		<footer class="mg-footer">
			<div class="mg-footer-widget">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-sm-6">
							<div class="widget">
								<h2 class="mg-widget-title">お問い合わせ</h2>
								<address>
									<strong>コアスタ（CoreSta）</strong><br>
									東京都世田谷区給田1-2-3<br>
									マンション名404
								</address>
				
								<p>
									TEL：03-3304-1548<br>
									FAX：03-3304-1549
								</p>
				
								<p>
									<a href="mailto:info@coresta.co">info@coresta.com</a>
								</p>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="widget">
								<h2 class="mg-widget-title">コンテンツ</h2>
								<ul class="mg-fnav">
									<li><a href="#">コース内容</a></li>
									<li><a href="#">料金</a></li>
									<li><a href="#">ブログ</a></li>
									<li><a href="#">アクセス</a></li>
									<li><a href="#">お問い合わせ</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="widget">
								<h2 class="mg-widget-title">Instagram</h2>
								<ul class="mg-instagram">
									<li><a href="#"><img src="../images/ins-01.png" alt=""></a></li>
									<li><a href="#"><img src="../images/ins-02.png" alt=""></a></li>
									<li><a href="#"><img src="../images/ins-03.png" alt=""></a></li>
									<li><a href="#"><img src="../images/ins-04.png" alt=""></a></li>
									<li><a href="#"><img src="../images/ins-05.png" alt=""></a></li>
									<li><a href="#"><img src="../images/ins-06.png" alt=""></a></li>
									<li><a href="#"><img src="../images/ins-07.png" alt=""></a></li>
									<li><a href="#"><img src="../images/ins-08.png" alt=""></a></li>
									<li><a href="#"><img src="../images/ins-09.png" alt=""></a></li>
								</ul>
							</div>
						</div>						
						<div class="col-md-3 col-sm-6">
							<div class="widget">
								<h2 class="mg-widget-title">ソーシャルメディア</h2>
								<p>twitterやfacebook、Instagramを使うならここにね。</p>
								<ul class="mg-footer-social">
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
									<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="#"><i class="fa fa-rss"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="mg-copyright">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<p style="text-align:center;">&copy; 2017 core-sta.com. All rights reserved.</p>
						</div>
					</div>
				</div>
			</div>
		</footer>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="../js/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/owl.carousel.min.js"></script>
		<script src="../js/jssor.slider.mini.js"></script>
		<script src="../js/classie.js"></script>
		<script src="../js/selectFx.js"></script>
		<script src="../js/bootstrap-datepicker.min.js"></script>
		<script src="../js/starrr.min.js"></script>
		<script src="../js/nivo-lightbox.min.js"></script>
		<script src="../js/jquery.shuffle.min.js"></script>
		<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<script src="../js/gmaps.min.js"></script>
		<script src="../js/jquery.parallax-1.1.3.js"></script>
		<script src="../js/script.js"></script>
		
		<link rel="stylesheet" href="//code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
		<script src="//code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="//code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
	</body>
</html>
