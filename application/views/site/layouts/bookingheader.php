<!DOCTYPE html>
<html lang="en">

<?php 
$temple_list=$this->general_model->gettemples();
$getcontact=$this->site_model->getcontact();
$site_settings=$this->site_model->settings();
$bgimage=$site_settings['bgimage'];
?>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="viewport" content="width=device-width, user-scalable=no" />
<title><?php print_r($temple_list[0]['name']);?></title>
<link rel="icon" href="<?php echo base_url(); ?>/assets/new_site/images/fav_icon.png" type="images/png" sizes="35x35" />

<!--Fonts-->
<link href="https://fonts.googleapis.com/css2?family=Lobster&amp;display=swap" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/new_site/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/new_site/css/owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/new_site/css/menu_styles.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/new_site/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/new_site/css/responsive.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/new_site/font-awesome-4.6.3/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/new_site/css/jquery-ui.css" />
</head>
<style>
.main-sec {    padding-left: 1.9rem !important; padding-right: 1.9rem !important;
}
.home_ad .owl-nav {
	display: none
}
.headbg {
/*    background:<?php echo $site_settings['menucolor']; ?>); url('<?php echo $site_settings['bgimage']; ?>'); */
   background:<?php echo $site_settings['menucolor']; ?>; ); url('<?php echo $site_settings['bgimage']; ?>');
}
.home_welcome {
	background:<?php echo $site_settings['menucolor']; ?>;
	background-repeat: no-repeat;
	background-position: top center;
	margin-top:30px;
	padding: 40px;
	float: left;
	width: 100%;
        margin-bottom: 30px;
}
body::after {
	content: "";
	background: #6c1e06 url("<?php echo $bgimage ?>");
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: 600px;
	z-index: 0
	
	
}
</style>
<body class="home-v5 ">
<form method="post" action="#" id="form1">
  <div class="aspNetHidden">
    <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUKMTM3MjA1MDAwMg9kFgJmD2QWAgIDD2QWBgIBDxYCHgRUZXh0BYcCDQogDQoNCiANCg0KPGRpdiBjbGFzcz0nY29udGFjdF9pbmZvJz4NCiAgICAgICAgICAgICAgICA8ZGl2PjxpIGNsYXNzPSdmYSBmYS1waG9uZS1zcXVhcmUnPjwvaT4mbmJzcDsmbmJzcDs4ODkzMzMzMzgyLCA5NzQ2NjQxNjI4IDwvZGl2Pg0KICAgICAgICAgICAgICAgIDxkaXY+PGkgY2xhc3M9J2ZhIGZhLWVudmVsb3BlJz48L2k+Jm5ic3A7Jm5ic3A7bW9va2t1dGhhbGF0ZW1wbGVAZ21haWwuY29tPC9kaXY+DQogICAgICAgICAgICAgIDwvZGl2Pg0KDQogDQpkAgMPZBYMAgEPFgIfAAX0CA0KIDxkaXY+DQogPGRpdiBjbGFzcz0naG9tZXNsaWRlcic+DQogICAgICAgICAgPHVsIGlkPSdzbGlkZXInIGNsYXNzPSdvd2wtY2Fyb3VzZWwgb3dsLXRoZW1lIGluX25hdic+ICAgPGxpPjxpbWcgY2xhc3M9J2ltZy1mbHVpZCcgdGl0bGU9J1NyZWUgTW9va2t1dGhhbGEgQmhhZ2F2YXRoaSBUZW1wbGUnIGFsdD0nJyB3aWR0aD0nJyBoZWlnaHQ9Jycgc3JjPSd1cGxvYWRzL2Jhbm5lci8xNV9iYW5uZXIxLmpwZyAnPiA8L2xpPiAgPGxpPjxpbWcgY2xhc3M9J2ltZy1mbHVpZCcgdGl0bGU9J1NyZWUgTW9va2t1dGhhbGEgQmhhZ2F2YXRoaSBUZW1wbGUnIGFsdD0nJyB3aWR0aD0nJyBoZWlnaHQ9Jycgc3JjPSd1cGxvYWRzL2Jhbm5lci8xNl9iYW5uZXIyLmpwZyAnPiA8L2xpPiAgPGxpPjxpbWcgY2xhc3M9J2ltZy1mbHVpZCcgdGl0bGU9J1NyZWUgTW9va2t1dGhhbGEgQmhhZ2F2YXRoaSBUZW1wbGUnIGFsdD0nJyB3aWR0aD0nJyBoZWlnaHQ9Jycgc3JjPSd1cGxvYWRzL2Jhbm5lci8zNV9iYW5uZXIzLmpwZyAnPiA8L2xpPiAgPGxpPjxpbWcgY2xhc3M9J2ltZy1mbHVpZCcgdGl0bGU9J1NyZWUgTW9va2t1dGhhbGEgQmhhZ2F2YXRoaSBUZW1wbGUnIGFsdD0nJyB3aWR0aD0nJyBoZWlnaHQ9Jycgc3JjPSd1cGxvYWRzL2Jhbm5lci8zNl9iYW5uZXI0LmpwZyAnPiA8L2xpPiAgICA8L3VsPg0KICAgICAgICA8L2Rpdj4NCg0KICA8ZGl2IGNsYXNzPSdob21lX2FkJz4gDQogIDx1bCBpZD0nYWRfc2xpZGVyJyBjbGFzcz0nb3dsLWNhcm91c2VsIG93bC10aGVtZSc+DQoJCQkJPGxpPjxpbWcgY2xhc3M9J2ltZy1mbHVpZCcgc3JjPSdpbWFnZXMvMzcweDQyMC1LdXRoYW1idWxseV93ZWIuanBnJz4gPC9saT4NCgkJCQk8bGk+PGltZyBjbGFzcz0naW1nLWZsdWlkJyBzcmM9J2ltYWdlcy8zNzB4NDIwLUt1dGhhbWJ1bGx5X3dlYjIuanBnJz4gPC9saT4NCgkJCQk8bGk+PGltZyBjbGFzcz0naW1nLWZsdWlkJyBzcmM9J2ltYWdlcy8zNzB4NDIwLXBhbi1lbmVyZ3lfd2ViLmpwZyc+PC9saT4NCgkJCQk8bGk+PGltZyBjbGFzcz0naW1nLWZsdWlkJyBzcmM9J2ltYWdlcy8zNzB4NDIwLXBhbi1lbmVyZ3lfd2ViMi5qcGcnPjwvbGk+DQoJCQkJDQoJCQk8L3VsPg0KCQkJDQogIDwvZGl2Pg0KICAgICAgPC9kaXY+DQoNCmQCAw8WAh8ABa4BDQogICAgICAgICAgICAgICA8YXVkaW8gYXV0b3BsYXkgaWQ9J3RlbXBBdWRpbycgc3JjPSd1cGxvYWRzL211c2ljLzU2X01vb2trdXRoYWxhLm1wZWcnIHByZWxvYWQ9J2F1dG8nPg0KPC9hdWRpbz48YSBvbkNsaWNrPSd0b2dnbGVQbGF5KCknPiA8ZGl2IGNsYXNzPSdhdGRfYnRuJz48L2Rpdj4gPC9hPiAgZAIFDxYCHwAFkwkNCg0KDQogICAgIDxkaXYgY2xhc3M9J2NvbC1sZy04Jz4NCiAgICAgICAgICAgIDxkaXYgY2xhc3M9J2hvbWVfYWJvdXRfYmxvY2snPg0KICAgICAgICAgICAgICA8aDIgY2xhc3M9J3RpdGxlMSB0aXRsZTFfbGVmdCc+QWJvdXQgVGVtcGxlPC9oMj4NCiAgICAgICAgICAgICAgPGgzIGNsYXNzPSdtYi00IG10LTMnIHN0eWxlPScgICAgZm9udC1zaXplOiAyMnB4OyAgICBjb2xvcjogIzcwMjMwODsnPlNyZWUgTW9va2t1dGhhbGEgQmhhZ2F2YXRoeSBLc2hldHJhbTwvaDM+DQogICAgICAgICAgICAgIDxkaXYgY2xhc3M9J3Jvdyc+DQogICAgICAgICAgICAgICAgPGRpdiBjbGFzcz0nY29sLWxnLTQgdGV4dC1jZW50ZXInPiA8aW1nIHRpdGxlPSdNb29rdXRoYWxhIFRlbXBsZScgYWx0PSdNb29rdXRoYWxhIFRlbXBsZSBpbWFnZScgc3JjPSd1cGxvYWRzL2Fib3V0LzFfVGVtcGxlX2ltYWdlcy5qcGcnIGNsYXNzPSdpbWctZmx1aWQnPiA8L2Rpdj4NCiAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPSdjb2wtbGctOCc+DQogICAgICAgICAgICAgICAgICA8cCBjbGFzcz0ndGV4dC1qdXN0aWZ5Jz4NCgkNCgkJDQoJCQlUaGUgZmFtb3VzIFNhbnNrcml0IHNjaG9sYXIgYW5kIHBvZXQgU3JpIE1lbHBhdGh1ciBCaGF0dGF0aGlyaXBhZCBhZnRlciB3cml0aW5nIE5hcmF5YW5lZXlhbSBhbmQgZ2V0dGluZyBjdXJlZCBvZiBoaXMgcmhldW1hdGljIGRpc2Vhc2UsIGNhbWUgdG8gTW9va2t1dGhhbGEgZm9yIHdvcnNoaXAtIHBpbmcgdGhlIERldmkgdG8gYXR0YWluIHNhbHZhdGlvbiBvbiB0aGUgYWR2aWNlIG9mIExvcmQgR3VydXZheXVyYXBwYS4gSGVyZSBoZSB3b3JzaGlwcGVkICZsc3F1bztNb29ra29sYW1tYSZyc3F1bzsgZm9yIHR3ZWx2ZSB5ZWFycyBhbmQgaW4gY291cnNlIG9mIHRoaXMgcGVyaW9kIHdyb3RlICZsc3F1bztTZWVwYWRhc2FwdGhhdGh5JnJzcXVvOyBjb250YWluaW5nIHNldmVudHkgLi4uPC9wPg0KICAgICAgICAgICAgICAgICAgPGEgaHJlZj0nYWJvdXQuYXNweCcgdGl0bGU9J1JlYWQgTW9yZScgY2xhc3M9J2J0biBidG4tbW9yZSc+UmVhZCBNb3JlPC9hPiA8L2Rpdj4NCiAgICAgICAgICAgICAgPC9kaXY+DQogICAgICAgICAgICA8L2Rpdj4NCiAgICAgICAgICA8L2Rpdj4NCg0KDQoNCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgZAIHDxYCHwBlZAIJDxYCHwAFoTENCiAgICAgICAgICAgPGRpdiBjbGFzcz0nY29sLWxnLTEyJz4NCiAgICAgICAgICAgICAgPGgyIGNsYXNzPSd0aXRsZTEgdGV4dC1jZW50ZXIgdGl0bGUxX2NlbnRlcic+QXZhaWxhYmxlIFBvb2phczwvaDI+DQogICAgICAgICAgICAgIDx1bCBpZCA9ICdwb29qYV9pdGVtcycgY2xhc3M9J293bC1jYXJvdXNlbCBvd2wtdGhlbWUgZG90dGVfc2xpZGVyJz4gDQogICAgICAgICAgICAgICAgPGxpPg0KICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz0ncG9vamFfaXRlbSc+DQogICAgICAgICAgICAgICAgICAgIDxkaXY+PGltZyBzcmMgPSAnaW1hZ2VzL2ljb25zNC5wbmcnID48L2RpdiA+DQogICAgICAgICAgICAgICAgICAg4LSq4LWB4LS34LWN4LSq4LS+4LSe4LWN4LSc4LSy4LS/IC1QdXNocGFuamFsaSA8L2RpdiA+DQogICAgICAgICAgICAgICAgPC9saT4gIA0KICAgICAgICAgICAgICAgIDxsaT4NCiAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9J3Bvb2phX2l0ZW0nPg0KICAgICAgICAgICAgICAgICAgICA8ZGl2PjxpbWcgc3JjID0gJ2ltYWdlcy9pY29uczQucG5nJyA+PC9kaXYgPg0KICAgICAgICAgICAgICAgICAgIOC0teC0v+C0tuC1h+C0t+C0vuC1vSDgtIXgtbzgtJrgtY3gtJrgtKgg4LSt4LS+4LSX4LWN4LSv4LS44LWC4LSV4LWN4LSk4LSCICAtIFNQTC4gQVJDSEFOQSBCSEFHWUFTLi4uIDwvZGl2ID4NCiAgICAgICAgICAgICAgICA8L2xpPiAgDQogICAgICAgICAgICAgICAgPGxpPg0KICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz0ncG9vamFfaXRlbSc+DQogICAgICAgICAgICAgICAgICAgIDxkaXY+PGltZyBzcmMgPSAnaW1hZ2VzL2ljb25zNC5wbmcnID48L2RpdiA+DQogICAgICAgICAgICAgICAgICAg4LSo4LWG4LSv4LWNIOC0teC0v+C0s+C0leC1jeC0leC1jSAtICAgTmV5IFZpbGFra3UgPC9kaXYgPg0KICAgICAgICAgICAgICAgIDwvbGk+ICANCiAgICAgICAgICAgICAgICA8bGk+DQogICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPSdwb29qYV9pdGVtJz4NCiAgICAgICAgICAgICAgICAgICAgPGRpdj48aW1nIHNyYyA9ICdpbWFnZXMvaWNvbnM0LnBuZycgPjwvZGl2ID4NCiAgICAgICAgICAgICAgICAgICDgtK7gtL7gtLIgLSBNYWxhIDwvZGl2ID4NCiAgICAgICAgICAgICAgICA8L2xpPiAgDQogICAgICAgICAgICAgICAgPGxpPg0KICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz0ncG9vamFfaXRlbSc+DQogICAgICAgICAgICAgICAgICAgIDxkaXY+PGltZyBzcmMgPSAnaW1hZ2VzL2ljb25zNC5wbmcnID48L2RpdiA+DQogICAgICAgICAgICAgICAgICAg4LSq4LS+4LSv4LS44LSCLSBQQVlBU0FNIDwvZGl2ID4NCiAgICAgICAgICAgICAgICA8L2xpPiAgDQogICAgICAgICAgICAgICAgPGxpPg0KICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz0ncG9vamFfaXRlbSc+DQogICAgICAgICAgICAgICAgICAgIDxkaXY+PGltZyBzcmMgPSAnaW1hZ2VzL2ljb25zNC5wbmcnID48L2RpdiA+DQogICAgICAgICAgICAgICAgICAg4LSk4LWD4LSV4LS+4LSyIOC0quC1guC0nC0gVGhyaWthbGEgUG9vamEJIDwvZGl2ID4NCiAgICAgICAgICAgICAgICA8L2xpPiAgDQogICAgICAgICAgICAgICAgPGxpPg0KICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz0ncG9vamFfaXRlbSc+DQogICAgICAgICAgICAgICAgICAgIDxkaXY+PGltZyBzcmMgPSAnaW1hZ2VzL2ljb25zNC5wbmcnID48L2RpdiA+DQogICAgICAgICAgICAgICAgICAg4LSq4LS+4LW94LSq4LS+4LSv4LS44LSCLSBQYWxwYXlhc2FtCSA8L2RpdiA+DQogICAgICAgICAgICAgICAgPC9saT4gIA0KICAgICAgICAgICAgICAgIDxsaT4NCiAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9J3Bvb2phX2l0ZW0nPg0KICAgICAgICAgICAgICAgICAgICA8ZGl2PjxpbWcgc3JjID0gJ2ltYWdlcy9pY29uczQucG5nJyA+PC9kaXYgPg0KICAgICAgICAgICAgICAgICAgIOC0kuC0sOC1geC0puC0v+C0teC0uOC0pOC1jeC0pOC1hiDgtKjgtYbgtK/gtY0g4LS14LS/4LSz4LSV4LWN4LSV4LWNLSBOZXkgVmlsYWtrdSBmb3IgMSBEYXkJIDwvZGl2ID4NCiAgICAgICAgICAgICAgICA8L2xpPiAgDQogICAgICAgICAgICAgICAgPGxpPg0KICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz0ncG9vamFfaXRlbSc+DQogICAgICAgICAgICAgICAgICAgIDxkaXY+PGltZyBzcmMgPSAnaW1hZ2VzL2ljb25zNC5wbmcnID48L2RpdiA+DQogICAgICAgICAgICAgICAgICAg4LSc4LSo4LWN4LSu4LSo4LSV4LWN4LS34LSk4LWN4LSw4LSq4LWC4LScKOC0kuC0sOC1geC0teC1vOC0t+C0pOC1jeC0pOC1h+C0leC1jeC0leC1jSktIEphbm1hIE5ha3NoYXRocmEgUC4uLiA8L2RpdiA+DQogICAgICAgICAgICAgICAgPC9saT4gIA0KICAgICAgICAgICAgICAgIDxsaT4NCiAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9J3Bvb2phX2l0ZW0nPg0KICAgICAgICAgICAgICAgICAgICA8ZGl2PjxpbWcgc3JjID0gJ2ltYWdlcy9pY29uczQucG5nJyA+PC9kaXYgPg0KICAgICAgICAgICAgICAgICAgIOC0pOC1g+C0muC1jeC0muC0qOC1jeC0puC0qOC0giAtIFRocmljaGFuZGFuYW0gPC9kaXYgPg0KICAgICAgICAgICAgICAgIDwvbGk+ICANCiAgICAgICAgICAgICAgICA8bGk+DQogICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPSdwb29qYV9pdGVtJz4NCiAgICAgICAgICAgICAgICAgICAgPGRpdj48aW1nIHNyYyA9ICdpbWFnZXMvaWNvbnM0LnBuZycgPjwvZGl2ID4NCiAgICAgICAgICAgICAgICAgICDgtK7gtYLgtJXgtY3gtJXgtYfgtL7gtLLgtJXgtY3gtJXgtLLgtY3gtLLgtY0gLQlNb29ra29sYSBLYWxsdSA8L2RpdiA+DQogICAgICAgICAgICAgICAgPC9saT4gIA0KICAgICAgICAgICAgICAgIDxsaT4NCiAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9J3Bvb2phX2l0ZW0nPg0KICAgICAgICAgICAgICAgICAgICA8ZGl2PjxpbWcgc3JjID0gJ2ltYWdlcy9pY29uczQucG5nJyA+PC9kaXYgPg0KICAgICAgICAgICAgICAgICAgIOC0ruC0suC1vCDgtKjgtL/gtLXgtYfgtKbgtY3gtK/gtIIJLSBNYWxhciAgTml2ZWR5YW0JIDwvZGl2ID4NCiAgICAgICAgICAgICAgICA8L2xpPiAgDQogICAgICAgICAgICAgICAgPGxpPg0KICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz0ncG9vamFfaXRlbSc+DQogICAgICAgICAgICAgICAgICAgIDxkaXY+PGltZyBzcmMgPSAnaW1hZ2VzL2ljb25zNC5wbmcnID48L2RpdiA+DQogICAgICAgICAgICAgICAgICAg4LSu4LSy4LW84LSq4LSxIC0gTWFsYXIgUGFyYQkgPC9kaXYgPg0KICAgICAgICAgICAgICAgIDwvbGk+ICANCiAgICAgICAgICAgICAgICA8bGk+DQogICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPSdwb29qYV9pdGVtJz4NCiAgICAgICAgICAgICAgICAgICAgPGRpdj48aW1nIHNyYyA9ICdpbWFnZXMvaWNvbnM0LnBuZycgPjwvZGl2ID4NCiAgICAgICAgICAgICAgICAgICDgtKjgtYbgtK/gtY3gtK/gtKrgtY3gtKrgtIIgMSDgtJXgtYLgtJ/gtY3gtJ/gtY0gLSBOZXl5YXBwYW0gMSBLb290dHUgPC9kaXYgPg0KICAgICAgICAgICAgICAgIDwvbGk+ICANCiAgICAgICAgICAgICAgICA8bGk+DQogICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPSdwb29qYV9pdGVtJz4NCiAgICAgICAgICAgICAgICAgICAgPGRpdj48aW1nIHNyYyA9ICdpbWFnZXMvaWNvbnM0LnBuZycgPjwvZGl2ID4NCiAgICAgICAgICAgICAgICAgICDgtKjgtYbgtK/gtY3gtK/gtKrgtY3gtKrgtIIgMSDgtIfgtJ/gtJngtY3gtJngtLTgtL8gLSBOZXl5YXBwYW0gMSBFZGFuZ2F6aGkJIDwvZGl2ID4NCiAgICAgICAgICAgICAgICA8L2xpPiAgDQogICAgICAgICAgICAgICAgPGxpPg0KICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz0ncG9vamFfaXRlbSc+DQogICAgICAgICAgICAgICAgICAgIDxkaXY+PGltZyBzcmMgPSAnaW1hZ2VzL2ljb25zNC5wbmcnID48L2RpdiA+DQogICAgICAgICAgICAgICAgICAg4LSo4LWC4LSx4LWN4LSx4LWG4LSf4LWN4LSf4LWB4LSu4LS+4LSyCS0gTm9vdHRldHR1IE1hbGEJIDwvZGl2ID4NCiAgICAgICAgICAgICAgICA8L2xpPiAgDQogICAgICAgICAgICAgICAgPGxpPg0KICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz0ncG9vamFfaXRlbSc+DQogICAgICAgICAgICAgICAgICAgIDxkaXY+PGltZyBzcmMgPSAnaW1hZ2VzL2ljb25zNC5wbmcnID48L2RpdiA+DQogICAgICAgICAgICAgICAgICAg4LSa4LWB4LSx4LWN4LSx4LWB4LS14LS/4LSz4LSV4LWN4LSV4LWNCS0gQ2h1dHR1dmlsYWtrdQkgPC9kaXYgPg0KICAgICAgICAgICAgICAgIDwvbGk+ICANCiAgICAgICAgICAgICAgICA8bGk+DQogICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPSdwb29qYV9pdGVtJz4NCiAgICAgICAgICAgICAgICAgICAgPGRpdj48aW1nIHNyYyA9ICdpbWFnZXMvaWNvbnM0LnBuZycgPjwvZGl2ID4NCiAgICAgICAgICAgICAgICAgICDgtJrgtYbgtLHgtL/gtK/gtJrgtYHgtLHgtY3gtLHgtYHgtLXgtL/gtLPgtJXgtY3gtJXgtY0JLSBDaGVyaXlhIENodXR0dXZpbGFra3UgPC9kaXYgPg0KICAgICAgICAgICAgICAgIDwvbGk+ICANCiAgICAgICAgICAgICAgICA8bGk+DQogICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPSdwb29qYV9pdGVtJz4NCiAgICAgICAgICAgICAgICAgICAgPGRpdj48aW1nIHNyYyA9ICdpbWFnZXMvaWNvbnM0LnBuZycgPjwvZGl2ID4NCiAgICAgICAgICAgICAgICAgICDgtKTgtL/gtLDgtYHgtK7gtYHgtJ/gtL/gtK7gtL7gtLIgLSBUaGlydW11ZGkgTWFsYSA8L2RpdiA+DQogICAgICAgICAgICAgICAgPC9saT4gIA0KICAgICAgICAgICAgICAgIDxsaT4NCiAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9J3Bvb2phX2l0ZW0nPg0KICAgICAgICAgICAgICAgICAgICA8ZGl2PjxpbWcgc3JjID0gJ2ltYWdlcy9pY29uczQucG5nJyA+PC9kaXYgPg0KICAgICAgICAgICAgICAgICAgIOC0tuC0guC0luC0vuC0reC0v+C0t+C1h+C0leC0ggktIFNhbmdoYWJoaXNoZWthbQkgPC9kaXYgPg0KICAgICAgICAgICAgICAgIDwvbGk+ICANCiAgICAgICAgICAgICAgICA8bGk+DQogICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPSdwb29qYV9pdGVtJz4NCiAgICAgICAgICAgICAgICAgICAgPGRpdj48aW1nIHNyYyA9ICdpbWFnZXMvaWNvbnM0LnBuZycgPjwvZGl2ID4NCiAgICAgICAgICAgICAgICAgICDgtJLgtLDgtYHgtKbgtL/gtLXgtLjgtKTgtY3gtKTgtYbgtKrgtYLgtJwJLSBPbmUgRGF5IFBvb2phIDwvZGl2ID4NCiAgICAgICAgICAgICAgICA8L2xpPiAgDQogICAgICAgICAgICAgICAgPGxpPg0KICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz0ncG9vamFfaXRlbSc+DQogICAgICAgICAgICAgICAgICAgIDxkaXY+PGltZyBzcmMgPSAnaW1hZ2VzL2ljb25zNC5wbmcnID48L2RpdiA+DQogICAgICAgICAgICAgICAgICAg4LSc4LSo4LWN4LSu4LSo4LSV4LWN4LS34LSk4LWN4LSw4LSq4LWC4LScCS0gSmFubWEgTmFrc2hhdGhyYSBQb29qYQkgPC9kaXYgPg0KICAgICAgICAgICAgICAgIDwvbGk+ICANCiAgICAgICAgICAgICAgICA8bGk+DQogICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPSdwb29qYV9pdGVtJz4NCiAgICAgICAgICAgICAgICAgICAgPGRpdj48aW1nIHNyYyA9ICdpbWFnZXMvaWNvbnM0LnBuZycgPjwvZGl2ID4NCiAgICAgICAgICAgICAgICAgICDgtLXgtL/gtLPgtJXgtY3gtJXgtY0gLSBWaWxha2t1IDwvZGl2ID4NCiAgICAgICAgICAgICAgICA8L2xpPiAgDQogICAgICAgICAgICAgICAgPGxpPg0KICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzcz0ncG9vamFfaXRlbSc+DQogICAgICAgICAgICAgICAgICAgIDxkaXY+PGltZyBzcmMgPSAnaW1hZ2VzL2ljb25zNC5wbmcnID48L2RpdiA+DQogICAgICAgICAgICAgICAgICAg4LSu4LS+4LSyIC0gTWFsYSA8L2RpdiA+DQogICAgICAgICAgICAgICAgPC9saT4gIA0KICAgICAgICAgICAgICAgIDxsaT4NCiAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9J3Bvb2phX2l0ZW0nPg0KICAgICAgICAgICAgICAgICAgICA8ZGl2PjxpbWcgc3JjID0gJ2ltYWdlcy9pY29uczQucG5nJyA+PC9kaXYgPg0KICAgICAgICAgICAgICAgICAgIOC0uOC1jeC0quC1huC0t+C1vSDgtKbgtL/gtLXgtLgg4LSq4LWC4LScIC0gU3BlY2lhbCBEaXZhc2EgUG9vamEgPC9kaXYgPg0KICAgICAgICAgICAgICAgIDwvbGk+ICAgICA8L3VsID4NCiAgICAgICAgICAgIDwvZGl2ID4NCg0KDQoNCg0KDQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGQCCw8WAh8ABZoIDQogIA0KDQoNCiAgIAkJPHVsIGlkPSdnYWxsZXJ5JyBjbGFzcz0nb3dsLWNhcm91c2VsIG93bC10aGVtZSBkb3R0ZV9zbGlkZXInPg0KCQk8bGk+IA0KCQkJCQkJIDxhIGNsYXNzPSdzYicgaHJlZj0nZ2FsbGVyeV9kZXRhaWxzLmFzcHg/aWQ9TURaZk1EZGZNakJmTVRKZk1EQmZaREU0T1dRNE1UWT0mdHlwZT1nYWxsZXJ5JyB0aXRsZT0nZ2FsbGVyeSc+PGltZyBhbHQ9JycgdGl0bGU9J01lbGVra2F2dSBCaGFnYXZhdGhpJyBzcmM9J3VwbG9hZHMvZ2FsbGVyeS8yX2dhbGxlcnkxLmpwZycgLz48L2E+IA0KCTwvbGk+DQoJCQkJDQoJCTxsaT4gDQoJCQkJCQkgPGEgY2xhc3M9J3NiJyBocmVmPSdnYWxsZXJ5X2RldGFpbHMuYXNweD9pZD1NRGRmTURoZk1qQmZNVEpmTURCZlpqVXlaREEwTm1FPSZ0eXBlPWdhbGxlcnknIHRpdGxlPSdnYWxsZXJ5Jz48aW1nIGFsdD0nJyB0aXRsZT0nS2l6aGVrYXZ1IEJoYWdhdmF0aGknIHNyYz0ndXBsb2Fkcy9nYWxsZXJ5LzZfSU1HXzIwMjAwNzAxXzE3MDQyNC5qcGcnIC8+PC9hPiANCgk8L2xpPg0KCQkJCQ0KCQk8bGk+IA0KCQkJCQkJIDxhIGNsYXNzPSdzYicgaHJlZj0nZ2FsbGVyeV9kZXRhaWxzLmFzcHg/aWQ9TURoZk1EaGZNakJmTVRKZk1EQmZNRFU1WlRJNU0yWT0mdHlwZT1nYWxsZXJ5JyB0aXRsZT0nZ2FsbGVyeSc+PGltZyBhbHQ9JycgdGl0bGU9J01lbGVra2F2dSBUZW1wbGUnIHNyYz0ndXBsb2Fkcy9nYWxsZXJ5LzhfTU9PS0tVVEhBTEEgMDUxLmpwZycgLz48L2E+IA0KCTwvbGk+DQoJCQkJDQoJCTxsaT4gDQoJCQkJCQkgPGEgY2xhc3M9J3NiJyBocmVmPSdnYWxsZXJ5X2RldGFpbHMuYXNweD9pZD1NRGhmTURoZk1qQmZNVEpmTURCZk0yUmpaVEF5TnpVPSZ0eXBlPWdhbGxlcnknIHRpdGxlPSdnYWxsZXJ5Jz48aW1nIGFsdD0nJyB0aXRsZT0nTWVsZWtrYXZ1IEluc2lkZScgc3JjPSd1cGxvYWRzL2dhbGxlcnkvOV9NT09LS1VUSEFMQSAwMzEuanBnJyAvPjwvYT4gDQoJPC9saT4NCgkJCQkNCg0KDQogICAgICAgIDwvdWw+DQoNCg0KDQoNCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgZAIFDxYCHwAF1gMNCiANCg0KICAgPGRpdiBzdHlsZT0nICAgIHBhZGRpbmctdG9wOiAxMnB4Oyc+DQogICAgICAgICAgICAgIDxkaXYgc3R5bGU9J2ZvbnQtc2l6ZTogMThweDsNCiAgICBmb250LXdlaWdodDogYm9sZDsNCiAgICBtYXJnaW4tYm90dG9tOiA0cHg7Jz4gU3JlZSBNb29ra3V0aGFsYSBCaGFnYXZhdGhpIFRlbXBsZTwvZGl2Pg0KICAgICAgICAgICAgICA8cD4gTW9va2t1dGhhbGEsIA0KTWFsYXBwdXJhbSBEaXN0LA0KS2VyYWxhLg0KDQoNCg0KIDwvcD4NCiAgICAgICAgICAgICAgICA8ZGl2PjxpIGNsYXNzPSdmYSBmYS1waG9uZS1zcXVhcmUnPjwvaT4mbmJzcDsmbmJzcDs4ODkzMzMzMzgyLCA5NzQ2NjQxNjI4IDwvZGl2Pg0KICAgICAgICAgICAgICAgIDxkaXY+PGkgY2xhc3M9J2ZhIGZhLWVudmVsb3BlJz48L2k+Jm5ic3A7Jm5ic3A7bW9va2t1dGhhbGF0ZW1wbGVAZ21haWwuY29tPC9kaXY+DQo8L2Rpdj4NCg0KDQoNCiANCmRkuiNvOFNka1ImhGsjK8UiRtPfEFo=" />
  </div>
  <div class="aspNetHidden">
    <input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="CA0B0334" />
  </div>
  <main class="main"> 
    <!-- header -->
    <header>
      <div class="container main-sec" >
        <div class="ct_header">
          <div class="row" style="background: <?php echo $site_settings['menucolor']; ?>99;">
            <div class="<?php  if($site_settings['online']=='1') { echo 'col-lg-4'; } else { echo 'col-lg-6'; } ?>">
              <!--<h1 style="color:white;"><a href="<?php echo base_url(); ?>index.php/welcome/" style="color:white;"><?php print_r($temple_list[0]['name']);?></a></h1>-->
            <a class="logo text-center" style="font-size:18px;font-weight:bold;text-transform:uppercase;"><?php print $site_settings['templename_mal']; ?><br><?php print $site_settings['templename_eng']; ?></a></h5>
            </div>
            <div class="col-lg-4">
              <div class="info">
                <div class="info_img"> <img src="<?php echo base_url(); ?>/assets/new_site/images/icons/icons5.png" title="" alt="" width="40px" height="52px"> </div>
                <div class='contact_info'>
                  <div><i class='fa fa-phone-square'></i>&nbsp;&nbsp;<?php print_r($getcontact[0]['land_ph']." , ".$getcontact[0]['mob_ph']);?> </div>
                  <div><i class='fa fa-envelope'></i>&nbsp;&nbsp;<?php print_r($getcontact[0]['email']);?></div>
                </div>
              </div>
            </div>
      	<?php  if($site_settings['online']=='1'){?>    
        <div class="col-lg-4">
        	<div class="d-flex flex-row">
        		<div class="outlined-clickandcollect">  <a href="<?php echo base_url(); ?>index.php/worldline/booking" class="btn_booking">ONLINE BOOKING</a> </div>
            <?php if($_SERVER['HTTP_HOST']=='kaladyshankaramadomts.org'){ ?>
            	<?php if(!$this->session->userdata('member') && !is_object($this->session->userdata('member'))): ?>
        		<div class="outlined-clickandcollect">  <a href="<?php echo base_url(); ?>index.php/membership" class="btn_booking">MEMBERSHIP</a> </div>
            	<?php endif;  }?>
        	</div>
        </div>
          </div><?php } ?>

        </div>
      </div>
      <div class="menu_part">
        <!--<div class="temple_lamp"><img class="rotate-center" title="" alt="" src="<?php echo base_url(); ?>/assets/new_site/images/temple_lamp.png"></div>-->
        <!--<div class="temple_lamp right"><img class="rotate-center2" title="" alt="" src="<?php echo base_url(); ?>/assets/new_site/images/temple_lamp.png"></div>-->
        <div class="container">
          <div class="menu_block">
            <div id="cssmenu" style="background: <?php echo $site_settings['menucolor']; ?>;">
           
            <ul>
                <li><a href="<?php echo base_url(); ?>index.php/welcome/"><span>home</span></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- end of header -->
    