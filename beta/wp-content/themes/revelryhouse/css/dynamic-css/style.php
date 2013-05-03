/*---------------------- Body --------------------------*/

body {
	background-color: <?php echo $data['body_color']; ?>;
}

body, 
p, 
input,
button,
select,
textarea,
.navbar-search .search-query {
	color: <?php echo $data['body_font']['color']; ?>;
	font-family: <?php echo $data['body_font']['face']; ?>;
	font-size: <?php echo $data['body_font']['size']; ?>;
	font-style: <?php echo $data['body_font']['style']; ?>;
	font-weight: <?php echo $data['body_font']['style']; ?>;
}

.mission-statement h3, .mission-statement h3 a {
	color: <?php echo $data['mission_font']['color']; ?>;
	font-family: <?php echo $data['mission_font']['face']; ?>;
	font-size: <?php echo $data['mission_font']['size']; ?>;
	font-style: <?php echo $data['mission_font']['style']; ?>;
	font-weight: <?php echo $data['mission_font']['style']; ?>;
}

h1, .h1, h1 a, h2, .h2, h2 a, h3, .h3, h3 a, h4, .h4, h4 a, h5, .h5, h5 a, #sidebar h4.widget-title, #sidebar .widgetitle a {
	color: <?php echo $data['headings_font']['color']; ?>;
	font-family: <?php echo $data['headings_font']['face']; ?>;
	font-style: <?php echo $data['headings_font']['style']; ?>;
	font-weight: <?php echo $data['headings_font']['style']; ?>;
}

h1#logo-default, h1#logo-default a {
	color: <?php echo $data['logo_font']['color']; ?>;
	font-family: <?php echo $data['logo_font']['face']; ?>;
	font-size: <?php echo $data['logo_font']['size']; ?>;
	font-style: <?php echo $data['logo_font']['style']; ?>;
	font-weight: <?php echo $data['logo_font']['style']; ?>;
}

#submit, #custom-contact-form #submit-button, #custom-contact-form input, #custom-contact-form select, #custom-contact-form textarea, .respond-form input[type="text"], .respond-form input[type="email"], .respond-form input[type="url"], .respond-form textarea, .page-strapline, #latest-projects h2, #latest-articles h2, .post p:first-of-type:first-letter {
	font-family: <?php echo $data['body_font']['face']; ?>;
}


#header-nav[role=navigation] ul ul {
	border-top: 2px solid <?php echo $data['accent_color']; ?>;
}

#header-nav[role=navigation] ul a:hover,
#header-nav[role=navigation] ul li.sfHover > a,
#header-nav[role=navigation] ul li.current-cat > a,
#header-nav[role=navigation] ul li.current_page_item > a,
#header-nav[role=navigation] ul li.current-menu-item > a,
#back-to-top a:hover,
.view-first:hover .mask,
.double:after,
.pager a:hover {
	background-color: <?php echo $data['accent_color']; ?>; 
}

a,
#footer-global a,
.mission-statement span,
#featured span,
#latest-work h1 a:hover, 
#latest-news h1 a:hover,
.view-more span .icon-plus,
.blog-index h1 a:hover,
.latest-news-excerpt h3 a:hover,
#logo [class^="icon-"],
#header-nav[role=navigation] ul ul li a:hover,
#header-nav[role=navigation] ul ul li.current-cat > a,
#header-nav[role=navigation] ul ul li.current_page_item > a,
#header-nav[role=navigation] ul ul li.current-menu-item > a {
	color: <?php echo $data['accent_color']; ?>;
}

.flex-control-nav li a:hover,
.flex-control-nav li a.active {
	background: <?php echo $data['accent_color']; ?>;
}

.widget img:hover,
#related-projects img:hover {
	border: 1px solid <?php echo $data['accent_color']; ?>;
}

/*---------------------- Custom CSS (Added from the Theme Options panel) --------------------------*/

<?php echo $data['custom_css']; ?>