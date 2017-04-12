<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<meta name="description" content="web design responsive">
	<meta name="author" content="Maxime Zupka">
	<title>BDE CESI - Lyon</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<header>
		<div class="container">
  			<ul class="list-unstyled">
    			<li><a data-placement="bottom" data-toggle="popover" data-title="Login" data-container="body" type="button" data-html="true" href="#" id="login">Connexion</a></li>
    		<div id="popover-content" class="hide">
      			<form class="form-inline" role="form">
        			<div class="form-group">
          				<input type="text" placeholder="Username" class="form-control" maxlength="30">
          				<input type="password" placeholder="Password" class="form-control">
          				<button type="submit" class="btn btn-primary">Log in</button>
        			</div>
      			</form>
    		</div>
    			<li><a data-placement="bottom" data-toggle="popovers" data-title="Login" data-container="body" type="button" data-html="true" href="#" id="login">Inscription</a></li>
    		<div id="popover-content2" class="hide">
      			<form class="form-inline" role="form">
        			<div class="form-group">
          				<input type="text" name="username" placeholder="Username" class="form-control" maxlength="30">
          				<input type="email" name="email" placeholder="Email" class="form-control">
          				<input type="password" name="pass1" placeholder="Password" class="form-control">
          				<input type="password" name="pass2" placeholder="Repeat password" class="form-control">
          				<button type="submit" class="btn btn-primary">S'inscrire</button>
        			</div>
      			</form>
    		</div>
  			</ul>
		</div>
		<div id="branding">
			<img src="img/logo_bde.png">
		</div>
		<nav>
			<ul>
				<li class="current"><a href="">Home</a></li>
				<li><a href="">Calendar</a></li>
				<li><a href="">Photos</a></li>
				<li><a href="">Shop</a></li>
			</ul>
		</nav>
		</div>
	</header>
	<section>
		
	</section>

	<script type="text/javascript">
		$("[data-toggle=popover]").popover({
    		html: true, 
			content: function() {
          		return $('#popover-content').html();
        		}
		});
		$("[data-toggle=popovers]").popover({
    		html: true, 
			content: function() {
          		return $('#popover-content2').html();
        		}
		});

		//no need to click twice to hide/show popover
		$('body').on('hidden.bs.popover', function (e) {
    	$(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
		});

		var $popover = $('[data-toggle=popover]').popover();
		$(document).on("click", function (e) {
		    var $target = $(e.target),
		        isPopover = $(e.target).is('[data-toggle=popover]'),
		        inPopover = $(e.target).closest('.popover').length > 0

		    //hide only if clicked on button or inside popover
		    if (!isPopover && !inPopover) $popover.popover('hide');
		});

		var $popovers = $('[data-toggle=popovers]').popover();
		$(document).on("click", function (e) {
		    var $target = $(e.target),
		        isPopover = $(e.target).is('[data-toggle=popovers]'),
		        inPopover = $(e.target).closest('.popover').length > 0

		    //hide only if clicked on button or inside popover
		    if (!isPopover && !inPopover) $popovers.popover('hide');
		});

		
	</script>

</body>
</html>
