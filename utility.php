<?php
$filename = "utility.html";
$start = 1;
$max = 45;

$file = file_get_contents($filename);

$wrapper_start = <<<END
			<!-- BEGIN new spell page -->
			<div class="sheet-spell-page-utilityPAGENUMBER">
END;

$wrapper_end = <<<END
			</div>
			<!-- END spell page -->
END;

$utility_rows = <<<'END'
	
	<!-- BEGIN utility spell row -->
	<div class="sheet-utility-spell-rowCURRENTROW">
		<div class="sheet-row sheet-grey-row">
			<div class="sheet-col-1-12 sheet-vert-bottom sheet-center sheet-small-label">Row#</div>
			<div class="sheet-col-5-12 sheet-vert-bottom sheet-center sheet-small-label">Spell name</div>
			<div class="sheet-col-1-6 sheet-vert-bottom sheet-center sheet-small-label">Spell Level</div>
			<div class="sheet-col-1-6 sheet-vert-bottom sheet-center sheet-small-label">Gained from</div>
			<div class="sheet-col-1-6 sheet-vert-bottom sheet-center sheet-small-label">Prepared?</div>
		</div>
		
		<div class="sheet-row sheet-grey-row">

			<div class="sheet-col-1-12 sheet-vert-middle sheet-spell-row-number">CURRENTROW</div>
			<div class="sheet-col-5-12 sheet-vert-middle"><input type="text" name="attr_utilityspellnameCURRENTROW"></div>
			<div class="sheet-col-1-6 sheet-vert-middle">
				<select name="attr_utilityspellbaselevelCURRENTROW">
					<option value="0">Cantrip</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
				</select>
			</div>	
			<div class="sheet-col-1-6 sheet-vert-middle" title="Use this field to indicate where you learned or have access to this spell from.  Useful to know if multiclassing or if you gain access to spells your class would not normally have thanks to subclass bonuses">
				<select name="attr_utilityspellgainedfromCURRENTROW">
					<option value="0">None</option>
					<option value="@{bard_spell_dc}">Bard</option>
					<option value="@{cleric_spell_dc}">Cleric</option>
					<option value="@{druid_spell_dc}">Druid</option>
					<option value="@{mage_spell_dc}">Mage</option>
					<option value="@{paladin_spell_dc}">Paladin</option>
					<option value="@{ranger_spell_dc}">Ranger</option>
					<option value="0">Racial Bonus</option>
				</select>
			</div>	
			<div class="sheet-col-1-6 sheet-vert-middle" title="Always prepared means the spell is either a cantrip or one that was provided to you via a method which indicated it would never count against your prepared limit for the day">
				<select name="attr_utilityspellispreparedCURRENTROW">
					<option value="1">Yes</option>
					<option value="0">NO</option>
					<option value="0.0001">Always</option>
				</select>
			</div>
			
		</div>
				
		<div class="sheet-row sheet-grey-row sheet-footer-row">
			<div class="sheet-col-1-10 sheet-vert-middle"><br/>Description<br/></div>
			<div class="sheet-col-4-5"><textarea class="sheet-fluid-textarea" name="attr_utilityspelldescriptionCURRENTROW"></textarea></div>
			<div class="sheet-col-1-10 sheet-vert-middle"><button type="roll" class="sheet-roll" name="roll_UtilitySpellCURRENTROW" value="/em uses @{utilityspellnameCURRENTROW} \n\n@{utilityspelldescriptionCURRENTROW}">Use</button></div>
		</div>
			
	</div>
			
	<!-- END utility spell row -->

END;

$full_output = "";

for ($i=$start; $i<=$max; $i++)
{
	$return_text = "";
	
	if ($i%5==1 && $i<$max)
	{
		//Add start of page wrapper
		$return_text .= $wrapper_start;
	}

	$return_text .= $utility_rows;
	
	if (is_int($i/5) || $i==$max)
	{
		//Add end of page wrapper
		$return_text .= $wrapper_end;
	}
	
	// Replace placeholders with correct values
	$return_text = str_replace("CURRENTROW", $i, $return_text);
	$return_text = str_replace("PAGENUMBER", ceil($i/5), $return_text);

	
	$full_output .= $return_text;
	
}

echo $full_output;

$file = $full_output;
file_put_contents($filename, $file);


?>