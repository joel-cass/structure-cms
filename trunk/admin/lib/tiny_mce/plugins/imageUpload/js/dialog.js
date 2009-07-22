tinyMCEPopup.requireLangPack();

var ImageUploadDialog = {
	init : function() {
		var f = document.forms[0];

		// Get the selected contents as text and place it in the input
		f.someval.value = tinyMCEPopup.editor.selection.getContent({format : 'text'});
		f.somearg.value = tinyMCEPopup.getWindowArg('some_custom_arg');
	},

	insert : function(path) {
		var strExt = path.replace(/^.*\./,"").toLowerCase();
		
		if (strExt == "gif" || strExt == "jpg" || strExt == "jpeg" || strExt == "png") {
			tinyMCEPopup.editor.execCommand('mceInsertContent', false, "<img src=\"" + path + "\"/>");
		} else {
			tinyMCEPopup.editor.execCommand('mceInsertContent', false, "<a href=\"" + path + "\">" + path + "</a>");
		}
		tinyMCEPopup.close();
	}
};

tinyMCEPopup.onInit.add(ImageUploadDialog.init, ImageUploadDialog);
