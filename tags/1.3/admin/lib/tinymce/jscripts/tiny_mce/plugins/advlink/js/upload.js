window.onload = function() {
	
	var onDialogStart = function () { } 

	var onDialogComplete = function (n_selected, n_queued, n_total) {

	} 

	var onFileQueued = function (file) {
		swfu.startUpload();
	} 
	
	var onUploadStart = function (file) {
		document.getElementById("swfupload_file").style.display = "block";
	}; 

	var onUploadProgress = function (file, complete, total) { 
		elWrapper = document.getElementById("swfupload_file");
		elProgress = document.getElementById("swfupload_file_bar");
		elName = document.getElementById("swfupload_file_name");
		elName.innerHTML = file.name;
		elProgress.style.width = Math.round((complete / total) * elWrapper.clientWidth) + "px";
	}; 

	var onUploadSuccess = function (file, server_data, receivedResponse) {
		var stcResponse = eval("(" + server_data + ")");
		if (stcResponse.path) {
			document.getElementById("href").value = stcResponse.path;
		}
		if (stcResponse.name && document.getElementById("title").value == "") {
			document.getElementById("title").value = stcResponse.name;
		}
		if (stcResponse.error) {
			alert("Error uploading " + file.name + ": " + stcResponse.error);
		}
	}; 

	var onUploadError = function (file, code, message) { 
		alert("Error uploading " + file.name + ": Check that the file type is acceptable."); 
	}; 
	
	var onUploadComplete = function (n_selected, n_queued, n_total) {
		if (swfu.getStats().files_queued > 0) {
			swfu.startUpload();
		} else {
			document.getElementById("swfupload_file").style.display = "none";
		}
	} 
	
	var swfu = new SWFUpload({ 
		upload_url : "../../../../upload.php?type=link&s=" + getSessionString(), 
		flash_url : "../../../swfupload/swfupload.swf", 
		file_post_name : "Filedata",
		file_size_limit : "200 MB", 
		file_dialog_start_handler : onDialogStart,
		file_dialog_complete_handler : onDialogComplete,
		file_queued_handler : onFileQueued,
		upload_start_handler : onUploadStart,
		upload_progress_handler : onUploadProgress,
		upload_success_handler : onUploadSuccess,
		upload_error_handler : onUploadError,
		upload_complete_handler : onUploadComplete,
		button_placeholder_id : "swfupload",
		button_action : SWFUpload.BUTTON_ACTION.SELECT_FILE,
		button_image_url : "../../../swfupload/uploadbutton.png",
		button_width : 61,
		button_height : 22 
	});
};