<!doctype html>
<html lang="en" ng-app="klubitusApp">

<head>
	<title>klubitus</title>

	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

	<link href="/assets/css/famous-angular.min.css" rel="stylesheet">
	<link href="/assets/css/klubitus.css" rel="stylesheet">
</head>

<body>

	<fa-app>
		<fa-header-footer-layout fa-options="{ headerSize: 50, footerSize: 50 }">
			<fa-surface>Header</fa-surface>
			<fa-scroll-view fa-pipe-from="eventHandler" fa-options="scrollViewInner">
				<fa-surface fa-pipe-to="eventHandler">
					<ui-view></ui-view>
				</fa-surface>
			</fa-scroll-view>
			<fa-surface>Footer</fa-surface>
		</fa-header-footer-layout>
	</fa-app>

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

