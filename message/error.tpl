
<!DOCTYPE html>

<html lang="en">

	<head>

		<meta charset="utf-8" />

		<title>{{$message}}</title>

		 

		<meta name="viewport" content="width=device-width, initial-scale=1.0" />



		<!-- basic styles -->



		<link href="/assets/css/bootstrap.min.css" rel="stylesheet" />

		<link rel="stylesheet" type="text/css" href="http://cdn.bootcss.com/font-awesome/3.2.1/css/font-awesome.min.css">



		<!--[if IE 7]>

		  <link rel="stylesheet" href="/assets/css/font-awesome-ie7.min.css" />

		<![endif]-->



		<!-- page specific plugin styles -->



		<!-- fonts -->



		 



		<!-- ace styles -->



		<link rel="stylesheet" href="/assets/css/ace.min.css" />

		<link rel="stylesheet" href="/assets/css/ace-rtl.min.css" />

		<link rel="stylesheet" href="/assets/css/ace-skins.min.css" />



		<!--[if lte IE 8]>

		  <link rel="stylesheet" href="/assets/css/ace-ie.min.css" />

		<![endif]-->



		<!-- inline styles related to this page -->



		<!-- ace settings handler -->



		<script src="/assets/js/ace-extra.min.js"></script>



		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->



		<!--[if lt IE 9]>

		<script src="/assets/js/html5shiv.js"></script>

		<script src="/assets/js/respond.min.js"></script>

		<![endif]-->

	</head>



	<body>



		<div class="main-container" id="main-container">

			<script type="text/javascript">

				try{ace.settings.check('main-container' , 'fixed')}catch(e){}

			</script>



			<div class="main-container-inner">

				<a class="menu-toggler" id="menu-toggler" href="#">

					<span class="menu-text"></span>

				</a>





				<div class="main-content">

					



					<div class="page-content">

						<div class="row">

							<div class="col-xs-12">

								<!-- PAGE CONTENT BEGINS -->



								<div class="error-container">

									<div class="well">
									<center>
										<h1 class="grey lighter smaller">

											<span class="blue bigger-125">

												<span class="badge badge-warning">X</span>

											</span>
											

											{{$message}}
											<span class="label label label-warning arrowed">E r r o r</span>

										</h1>
									</center>


										<hr />

										<h3 class="lighter smaller" style="text-align: center;">

											页面自动跳转 等待时间 <span id="timeout">3</span> 秒

										<!-- 	<i class="icon-wrench icon-animated-wrench bigger-125"></i>

											on it! -->
										<script type="text/javascript">
											var i = {{$timeout}}
											setInterval(function(){
												$('#timeout').text(i / 1000);
												if(i < 1){
													if('{{$url}}'=='history.go(-1);'){
														history.go(-1);
													}else{
														window.location = '{{$url}}';
													}
												}else{
													i -= 1000;
												}
											},1000);
										</script>
										</h3>



										<div class="space"></div>



										<div>

											<!-- <h4 class="lighter smaller">Meanwhile, try one of the following:</h4> -->



											<ul class="list-unstyled spaced inline bigger-110 margin-15">

<!-- 												<li>

													<i class="icon-hand-right blue"></i>

													Read the faq

												</li>



												<li>

													<i class="icon-hand-right blue"></i>

													Give us more info on how this specific error occurred!

												</li> -->

											</ul>

										</div>



										<hr />

										<div class="space"></div>



										<div class="center">

											<a href="#" class="btn btn-grey">

												<i class="icon-arrow-left"></i>

												返回上一页

											</a>



											<a href="#" class="btn btn-primary">

												<i class="icon-dashboard"></i>

												立即跳转

											</a>

										</div>

									</div>

								</div>



								<!-- PAGE CONTENT ENDS -->

							</div><!-- /.col -->

						</div><!-- /.row -->

					</div><!-- /.page-content -->

				</div><!-- /.main-content -->



				<div class="ace-settings-container" id="ace-settings-container">



					<div class="ace-settings-box" id="ace-settings-box">

						<div>

							<div class="pull-left">

								<select id="skin-colorpicker" class="hide">

									<option data-skin="default" value="#438EB9">#438EB9</option>

									<option data-skin="skin-1" value="#222A2D">#222A2D</option>

									<option data-skin="skin-2" value="#C6487E">#C6487E</option>

									<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>

								</select>

							</div>

							<span>&nbsp; Choose Skin</span>

						</div>



						<div>

							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />

							<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>

						</div>



						<div>

							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />

							<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>

						</div>



						<div>

							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />

							<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>

						</div>



						<div>

							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />

							<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>

						</div>



						<div>

							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />

							<label class="lbl" for="ace-settings-add-container">

								Inside

								<b>.container</b>

							</label>

						</div>

					</div>

				</div><!-- /#ace-settings-container -->

			</div><!-- /.main-container-inner -->



			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">

				<i class="icon-double-angle-up icon-only bigger-110"></i>

			</a>

		</div><!-- /.main-container -->



		<!-- basic scripts -->



		<!--[if !IE]> -->



		<script src="http://www.jq22.com/jquery/jquery-2.1.1.js"></script>



		<!-- <![endif]-->



		<!--[if IE]>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<![endif]-->



		<!--[if !IE]> -->



		<script type="text/javascript">

			window.jQuery || document.write("<script src='/assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");

		</script>



		<!-- <![endif]-->



		<!--[if IE]>

<script type="text/javascript">

 window.jQuery || document.write("<script src='/assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");

</script>

<![endif]-->



		<script type="text/javascript">

			if("ontouchend" in document) document.write("<script src='/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");

		</script>

		<script src="http://www.jq22.com/jquery/bootstrap-3.3.4.js"></script>

		<script src="/assets/js/typeahead-bs2.min.js"></script>



		<!-- page specific plugin scripts -->



		<!-- ace scripts -->



		<script src="/assets/js/ace-elements.min.js"></script>

		<script src="/assets/js/ace.min.js"></script>



		<!-- inline scripts related to this page -->

	

</body>

</html>

