// TREE FUNCTIONS

var aryElement = new Object();

function clickNode(el, path, domElement) {
	if (el.getAttribute("class") == "open") {
		$.get("node-tree.php?ajax=1&close=true&node=" + path, null, tree_closed)
		el.setAttribute("class", "closed");
	} else {
		$(domElement).load("node-tree.php?ajax=1&node=" + path, null, tree_loaded)
		el.setAttribute("class", "loading");
	}
	aryElement[path] = el;
}

function tree_loaded (obj, status, xml) {
	var strResult = obj.replace(/(\r\n|\t)+/g,"[CR]");
	var strPath = strResult.replace(/^.*<!-- Path:\"([^\"]*)\" -->.*$/gim,"$1");
	var numChildren = strResult.replace(/^.*<!-- Children:([0-9]*) -->.*$/gim,"$1");
	if (aryElement[strPath]) {
		if (numChildren > 0) {
			aryElement[strPath].setAttribute("class", "open");
		} else {
			aryElement[strPath].setAttribute("class", "empty");
		}
	}
}

function tree_closed (obj, status, xml) { 
	var strResult = obj.replace(/(\r\n|\t)+/g,"[CR]");
	var strPath = strResult.replace(/^.*<!-- Path:\"([^\"]*)\" -->.*$/gim,"$1");
	var numChildren = strResult.replace(/^.*<!-- Children:([0-9]*) -->.*$/gim,"$1");
	if (aryElement[strPath] && numChildren == 0) {
		aryElement[strPath].setAttribute("class", "empty");
	}
}

function moveNode (path, dir, domElement) {
	$(domElement).load("node-tree.php?ajax=1&move=" + dir + "&node=" + path, null, tree_loaded)
}

function contextMenu_select(action, el, pos) {
	var strNode = $(el).attr("rel");
	var strParentID = $($(el).parent().get(0)).parent().get(0).id;
	switch (action) {
		case "edit":
			window.open("../node-edit.php?node=" + strNode, "main");
			break;
		case "layout": 
			window.open("../node-layout.php?node=" + strNode, "main");
			break;
		case "create": 
			window.open("../node-create.php?node=" + strNode, "main");
			break;
		case "delete": 
			window.open("../node-delete.php?node=" + strNode, "main");
			break;
		case "up":
			moveNode(strNode, -1, "#" + strParentID);
			break;
		case "down": 
			moveNode(strNode, +1, "#" + strParentID);
			break;
	}
};

// debug method - remove as necessary

function dump (o) {
	var msg = "";
	if (typeof(o) == "string") {
		msg = o;
	} else {
		for (var p in o) {
			msg += p;
			msg += ": ";
			try {
				msg += o[p];
			} catch (e) {
				msg += "ERROR";
			}
			msg += "\n"; 
		}
	}
	alert(msg);
}

/*  ******* LICENSE ******* 
 *  
 *  Copyright 2009 Joel Cass 
 *  
 *  Licensed under the Apache License, Version 2.0 (the "License"); 
 *  you may not use this file except in compliance with the License. 
 *  You may obtain a copy of the License at 
 *  
 *  	http://www.apache.org/licenses/LICENSE-2.0 
 *  	
 *  Unless required by applicable law or agreed to in writing, software 
 *  distributed under the License is distributed on an "AS IS" BASIS, 
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. 
 *  See the License for the specific language governing permissions and 
 *  limitations under the License. 
 */

