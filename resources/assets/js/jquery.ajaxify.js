/**
 * Ajaxified requests.
 *
 * @package    klubitus
 * @author     Antti Qvickström
 * @copyright  (c) 2013-2014 Antti Qvickström
 * @license    http://www.opensource.org/licenses/mit-license.php MIT license
 */
(function ($) {

	/**
	 * Send query via ajax and replace container with response.
	 *
	 * @param    {String}         url
	 * @param    {Object|String}  data
	 * @param    {String}         type  POST|GET
	 * @param    {Function}       success
	 * @returns  {$.fn}
	 */
	$.fn.ajaxify = function(url, data, type, success) {
		var $target = $(this);

		$.ajax({
			type:       (type || '').toUpperCase() === 'POST' ? 'POST' : 'GET',
			url:        url,
			data:       data,
			timeout:    2500,
			beforeSend: function () {
				$target.loading();
			}
		})
				.done(function(data) {
					$target.replaceWith(data);

					if (typeof success == 'function') {
						success(data);
					}
				})

				.fail(function(xhr, status) {
					if (status === 'error') {
						status = xhr.statusText;
					}
					alert('Fail: ' + status);

					$target.loading(true);
				});

		return this;
	};

})(jQuery);
