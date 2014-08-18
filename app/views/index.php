<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<title>klubitus</title>

	<link href="/assets/css/klubitus.css" rel="stylesheet">

</head>

<body ng-app="klubitusApp">

	<div ng-include="'assets/templates/mainmenu.html'"></div>

	<div ui-view></div>

	<?php if (App::environment('dev')): ?>
	<script src="/assets/js/vendor.js"></script>
	<script src="/assets/js/klubitus.js?_<?= filemtime('assets/js/klubitus.js') ?>"></script>
	<?php else: ?>
	<script src="/assets/js/vendor.min.js"></script>
	<script src="/assets/js/klubitus.min.js"></script>
	<?php endif; ?>

	<script>
		angular.module('klubitusApp').constant('CSRF_TOKEN', '<?= csrf_token() ?>');
	</script>
</body>

</html>

