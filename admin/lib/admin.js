// DEBUG METHODS

function switchDisplay(idTarget, elSource) {
	var elTarget = document.getElementById(idTarget);
	if (elTarget.style.display == "none") {
		elTarget.style.display = "block";
		elSource.className = "open";
		setCookie(idTarget, "open");
	} else {
		elTarget.style.display = "none";
		elSource.className = "closed"
		setCookie(idTarget, "closed");
	}
}

function initDisplay(idTarget, idSource) {
	var elTarget = document.getElementById(idTarget);
	var elSource = document.getElementById(idSource);
	if (getCookie(idTarget) == "closed") {
		elTarget.style.display = "none";
		elSource.className = "closed"
	} else {
		elTarget.style.display = "block";
		elSource.className = "open";
	}
}

// cookie methods

function setCookie( name, value, expires, path, domain, secure )
{
	var today = new Date();
	today.setTime( today.getTime() );
	
	if (expires) {
		expires = expires * 1000 * 60 * 60 * 24;
	}
	var expires_date = new Date(today.getTime() + expires);
	
	document.cookie = name + "=" + escape( value ) +
		(expires ? ";expires=" + expires_date.toGMTString() : "" ) +
		(path ? ";path=" + path : "" ) +
		(domain ? ";domain=" + domain : "" ) +
		(secure ? ";secure" : "" );
}

function getCookie( check_name ) {
	var a_all_cookies = document.cookie.split( ';' );
	var a_temp_cookie = '';
	var cookie_name = '';
	var cookie_value = '';

	for (i = 0; i < a_all_cookies.length; i++) {
		a_temp_cookie = a_all_cookies[i].split( '=' );
		cookie_name = a_temp_cookie[0].replace(/^\s+|\s+$/g, '');

		if (cookie_name == check_name) {
			if (a_temp_cookie.length > 1) {
				cookie_value = unescape( a_temp_cookie[1].replace(/^\s+|\s+$/g, '') );
			}
			return cookie_value;
			break;
		}
		a_temp_cookie = null;
		cookie_name = '';
	}
	return null;
}

function deleteCookie( name, path, domain ) {
	if (getCookie(name)) {
		document.cookie = name + "=" +
		(path ? ";path=" + path : "") +
		(domain ? ";domain=" + domain : "" ) +
		";expires=Thu, 01-Jan-1970 00:00:01 GMT";
	}
}

// utility methods

function dump (obj) {
	var msg = "";
	for (var p in obj) {
		msg += p;
		msg += ": ";
		msg += obj[p];
		msg += "\n";
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

