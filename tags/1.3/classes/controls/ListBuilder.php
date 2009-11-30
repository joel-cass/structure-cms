<?php

class ListBuilder {

	public static function init() {
		?>
			<script type="text/javascript">
			function selectAll (strField) {
				fld = document.getElementById(strField);
				for (var i = 0; i < fld.options.length; i++) {
					fld.options[i].selected = true;
				}
			}
			function moveUp (strField) {
				fld = document.getElementById(strField);
				for (var i = 0; i < fld.options.length; i++) {
					if (fld.options[i].selected && i > 0) {
						n = i-1;
						t1 = fld.options[i].text; v1=fld.options[i].value; d1=fld.options[i].defaultSelected; s1=fld.options[i].selected; 
						t2 = fld.options[n].text; v2=fld.options[n].value; d2=fld.options[n].defaultSelected; s2=fld.options[n].selected; 
						fld.options[i] = new Option(t2, v2, d2, s2);
						fld.options[n] = new Option(t1, v1, d1, s1);
					}
				}
			}
			function moveDown (strField) {
				fld = document.getElementById(strField);	
				for (var i = fld.options.length-1; i >= 0; i--) {
					if (fld.options[i].selected && i < fld.options.length-1) {
						n = i+1;
						t1 = fld.options[i].text; v1=fld.options[i].value; d1=fld.options[i].defaultSelected; s1=fld.options[i].selected; 
						t2 = fld.options[n].text; v2=fld.options[n].value; d2=fld.options[n].defaultSelected; s2=fld.options[n].selected; 
						fld.options[i] = new Option(t2, v2, d2, s2);
						fld.options[n] = new Option(t1, v1, d1, s1);
					}
				}
			}
			function copy (strSource, strDest) {
				src = document.getElementById(strSource);	
				des = document.getElementById(strDest);	
				for (var i = src.options.length-1; i >= 0; i--) {
					if (src.options[i].selected) {
						des.options[des.options.length] = new Option(src.options[i].text, src.options[i].value, true, true);
					}
				}
			}
			function del (strField) {
				fld = document.getElementById(strField);	
				for (var i = fld.options.length-1; i >= 0; i--) {
					if (fld.options[i].selected) {
						fld.options[i] = null;
					}
				}
			}
			</script>
			<style type="text/css">
			.list-builder img {
				padding: 5px 5px;
			}
			.list-builder select {
				width: 200px;
				height: 250px;
			}
			
			.list-builder div {
				float:left;
			}
			</style>
		<?php
	}
	
	public static function render ($strField, array $aryAvailable, array $arySelected) {
		?>
			<div class="list-builder">
				<div>
					<a href="#" onclick="moveUp('<?php echo $strField; ?>');return false;"><img src="images/go-up.png" width="16" height="16" border="0" alt="Move Up"></a><br>
					<a href="#" onclick="moveDown('<?php echo $strField; ?>');return false;"><img src="images/go-down.png" width="16" height="16" border="0" alt="Move Down"></a><br>
				</div>
				<div>
					<select name="<?php echo $strField; ?>[]" id="<?php echo $strField; ?>" multiple class="list-builder">
						<?php foreach ($arySelected as $option) { 
							echo("<option value=\"$option\" selected>$option</option>");
						} ?>
					</select>
				</div>
				<div>
					<a href="#" onclick="del('<?php echo $strField; ?>');return false;"><img src="images/go-next.png" width="16" height="16" border="0" alt="Remove"></a><br>
					<a href="#" onclick="copy('<?php echo $strField; ?>_available', '<?php echo $strField; ?>');return false;"><img src="images/go-previous.png" width="16" height="16" border="0" alt="Add"></a><br>
				</div>
				<div>
					<select name="<?php echo $strField; ?>_available[]" id="<?php echo $strField; ?>_available" multiple class="list-builder">
						<?php foreach ($aryAvailable as $option) { 
							echo("<option value=\"$option\">$option</option>");
						} ?>
					</select>
				</div>
			</div>
			<script type="text/javascript">
			$("form").submit(function() { selectAll("<?php echo $strField; ?>"); });
			</script>
		<?php
	}

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

?>