var editor;
KindEditor.ready(function (K1) {
	editor = K1.create("textarea[name='content,description']", {
		allowFileManager: true,
		allowImageRemote: false,
	});
});
KindEditor.ready(function (K) {
	var editor = K.editor({
		allowFileManager: true,

	});
	K('#image').click(function () {
		editor.loadPlugin('image', function () {
			editor.plugin.imageDialog({
				showRemote: false,
				imageUrl: K('#picurl').val(),
				clickFn: function (url, title, width, height, border, align) {
					K('#picurl').val(url);
					editor.hideDialog();
				}
			});
		});
	});
});
$(document).ready(function (e) {
	$('#duo').hide();
	$("#bt1,#bt2").click(function () {
		$('#author').attr("value", $(this).val());
	});
	$('#radio2').click(function () {

		$('#dan').hide();
		$('#duo').show();

	});
	$('#radio').click(function () {

		$('#dan').show();
		$('#duo').hide();

	});

});
