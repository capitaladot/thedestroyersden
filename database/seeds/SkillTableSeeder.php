<?php
namespace App\Database\Seeds;

use App\SkillType;
use Illuminate\Database\Eloquent\Model;
use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\HtmlNode;
use App\CharacterClass;
use App\Craft;
use App\Deity;
use App\Description;
use App\Devotional;
use App\Homeland;
use App\Magic;
use App\Race;
use App\Requirement;
use App\RequirementGroup;
use App\Rule;
use App\Skill;
use App\Spell;
use App\MainMenuItem;

class SkillTableSeeder extends BaseSeeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		$parser = new Dom;
		foreach(Rule::with('description')->with('parentRule')->get() as $eachRule){
			$eachDescription = $eachRule->description->first();
			if(!count($eachDescription))
				continue;
			$parser->loadStr($eachDescription->body,[]);
			$paragraphs = collect($parser->find("p")->toArray());
			$newParagraphs = collect([]);
			foreach($paragraphs as $eachParagraph){
				if(FALSE  !== strpos("<br />",$eachParagraph->outerHTML())){
					$splitParagraphs = explode("<br />",$eachParagraph->outerHTML());
					foreach($splitParagraphs as $eachSplitParagraph) {
						$eachSplitParagraph = $this->realTrim($eachSplitParagraph);
						if($eachSplitParagraph[0] != "<")
							$eachSplitParagraph = "<p>".$eachSplitParagraph;
						elseif($eachSplitParagraph[count($eachSplitParagraph)-1] != ">")
							$eachSplitParagraph = $eachSplitParagraph."</p>";
						$newParagraphs[] = $parser->loadStr($eachSplitParagraph,[]);
					}
					$eachParagraph->delete();
					unset($eachParagraph);
				}
				else $newParagraphs[] = $eachParagraph;
			}
			foreach($newParagraphs as $eachParagraph){
				$reParsed = $parser->loadStr($eachParagraph->innerHTML(),[])->find('p');
				if(count($reParsed)){
					foreach($reParsed as $eachSplitParagraph) {
						$paragraphs[] = $eachSplitParagraph;
						$eachSplitParagraph->delete();
						unset($eachSplitParagraph);
					}
					if(!empty($eachParagraph->innerText())){
						$paragraphs[] = $parser->loadStr("<p>".$eachParagraph."</p>",[]);
					}
				}
			}
			$paragraphs = $paragraphs->transform(function($eachParagraph,$paragraphIndex)use($eachRule,$paragraphs){
				$returnValue = null;
				$this->command
					->info("============================="
						."Start of \"".$eachRule->getTitle()."\" Paragraph Index: ".$paragraphIndex
						."==============================="
					);
				$strippedParagraph = $this->realTrim(html_entity_decode($eachParagraph->innerHTML()));
				$skillSplit = explode(" - ",$strippedParagraph,3);
				if(count($skillSplit) <= 2)
					$skillSplit = explode(" -",implode(" -",$skillSplit),3);
				if(count($skillSplit) <= 2)
					$skillSplit = explode("- ",implode("- ",$skillSplit),3);
				$this->command->info("Split Array Length: ".count($skillSplit));
				if(
					count($skillSplit) == 1
						&&
					count($eachRule->parentRule)
						&&
					str_is('List of Crafting Techniques (and Tools, Raw Resources and Crafting Components Used)',$this->realTrim($eachRule->parentRule->getTitle()))
				){
					$costValue = 1;
					$deParen = explode("(",$eachParagraph->innerHTML(),2);
					if(count($deParen) == 2){
						$this->command->info("Setting up variables for: ".$this->realTrim($eachRule->parentRule->getTitle()));
						$title = $this->realTrim(strip_tags(html_entity_decode(strip_tags($deParen[0]))));
						//strip trailing )
						$deParen[1] = substr($deParen[1],0,-1);
						$body = $this->realTrim($deParen[1]);
						$skill = Skill::firstOrCreate([
							'title' => $title,
							'level' => 1,
							'max_purchases' => 1
						]);
						$skillType =  SkillType::firstOrCreate(['model_class'=>Craft::class]);
						$skill->skillType()->associate($skillType);
						$cost = $skill->costs()->create(['value' => 1]);
						$craft = Craft::firstOrCreate(['title' => $eachRule->title]);
						$craft->ruled()->save($eachRule,['ruled_id'=>$craft->id,'ruled_type'=>Craft::class]);
						$requirement = Requirement::create();
						$requirement->skillRequirer()->save($skill,['requirement_id'=>$requirement->id,'requirable_id'=>$craft->id,'requirable_type'=>Craft::class]);
					}
				}
				elseif(count($skillSplit) == 2){
					$childMatch = false;
					$firstGeneration = [
						'Homeland',
						'Race'
					];
					if(count($eachRule->parentRule)){
						$childMatch = array_search($this->realTrim($eachRule->parentRule->getTitle()),$firstGeneration);
						if($childMatch !== FALSE)
							$this->command->info("Setting up variables for: ".$firstGeneration[$childMatch]);
					}
					$grandChildMatch = false;
					$secondGeneration = ['Class'];
					if(
						count($eachRule->parentRule)
							&&
						count($eachRule->parentRule->parentRule)
					){
						$grandChildMatch = array_search($this->realTrim($eachRule->parentRule->parentRule->getTitle()),$secondGeneration);
						if($grandChildMatch !== FALSE)
							$this->command->info("Setting up variables for: ".$secondGeneration[$grandChildMatch]);
					}
					if($childMatch !== FALSE || $grandChildMatch !== FALSE){
						$title = $this->realTrim(strip_tags(html_entity_decode(strip_tags($skillSplit[0]))));
						$xpAtIndex = strpos($title,"XP");
						if(FALSE !== $xpAtIndex) {
							$costValue = $this->realTrim(html_entity_decode(str_replace("XP","",$title)));
							$this->command->info("Parsed cost value: ".$costValue);
							$title = $this->realTrim(html_entity_decode(substr($title,$xpAtIndex+1)));
						}
						else
							$costValue = 0;
						$body = $this->realTrim($skillSplit[1]);
					}
					else {
						switch ($this->realTrim($eachRule->title)) {
							case'General Physical Abilities':
							case'Universal Abilities':
								$this->command->info("Setting up variables for: ".$this->realTrim($eachRule->title));
								$title = $this->realTrim(strip_tags(html_entity_decode(strip_tags($skillSplit[0]))));
								$xpAtIndex = strpos($title,"XP");
								if(FALSE !== $xpAtIndex) {
									$costValue = $this->realTrim(html_entity_decode(str_replace("XP","",$title)));
									$this->command->info("Parsed cost value: ".$costValue);
									$title = $this->realTrim(strip_tags(html_entity_decode(substr($title,$xpAtIndex+1))));
								}
								else
									$returnValue = $eachParagraph;
								break;
							default:
								$returnValue = $eachParagraph;
						}
					}
				}
				elseif(count($skillSplit) == 3) {
					if(FALSE !== strpos($skillSplit[0],"XP"))
						$skillSplit[0] = str_replace("XP","",$skillSplit[0]);
					$costValue = $this->realTrim($skillSplit[0]);
					$this->command->info("Parsed cost value: ".$costValue);
					if (!is_numeric($costValue))
						$returnValue = $eachParagraph;
					$title = $this->realTrim(html_entity_decode(strip_tags($this->realTrim($skillSplit[1]))));
					$body = $this->realTrim(html_entity_decode(strip_tags($this->realTrim($skillSplit[2]))));
				}
				if(isset($title))
					$title = $this->realTrim(preg_replace("/(\s{2,})/"," ",$title));
				if(empty($body) || (isset($costValue) && !is_numeric($costValue))){
					$this->command->info("Parsed cost value: ".(isset($costValue) ? $costValue :"(unset)")
						.", body was \"".(isset($body) ? $body :"(unset)")."\", so returning paragraph.");
					$returnValue = $eachParagraph;
				}
				elseif(
					is_null($returnValue)
						&&
					isset($title)
						&&
					isset($body)
						&&
					count($eachRule->parentRule)
				) {
					if (count($eachRule->parentRule->parentRule)) {
						switch ($this->realTrim($eachRule->parentRule->parentRule->title)) {
							case 'Class':
								$this->command->info($this->realTrim($eachRule->parentRule->parentRule->title));
								if ($title == "Bonus HP") {
									$characterClass = CharacterClass::firstOrCreate([
										'title' => $eachRule->title
									]);
									$characterClass->ruled()->save($eachRule->parentRule->parentRule,['ruled_id'=>$characterClass->id,'ruled_type'=>CharacterClass::class]);
									$characterClass->hitpoints = $body;
									$characterClass->save();
								}
								elseif ($title == "Mana Pool") {
									$characterClass = CharacterClass::firstOrCreate([
										'title' => $eachRule->title
									]);
									$characterClass->ruled()->save($eachRule->parentRule->parentRule,['ruled_id'=>$characterClass->id,'ruled_type'=>CharacterClass::class]);
									$characterClass->manapool = $body;
									$characterClass->save();
								}
								elseif(isset($costValue)) {
									switch ($this->realTrim($eachRule->title)) {
										case'Innate Abilities':
											$level = 1;
											break;
										case'Advanced Abilities':
											$level = 2;
											break;
										case'Superior Abilities':
											$level = 3;
											break;
									}
									$skill = Skill::firstOrCreate([
										'title' => $title
									]);
									$skill->level = $level;
									$skillType =  SkillType::firstOrCreate(['model_class' => CharacterClass::class]);
									$skill->skillType()->associate($skillType);
									$skill->save();
									$cost = $skill->costs()->create(['value' => $costValue]);
									$characterClass = CharacterClass::firstOrCreate([
										'title' => $eachRule->title
									]);
									$cost->characterClass()
										->associate($characterClass);
									$cost->save();
									$requirement = Requirement::create();
									$requirement->skillRequirer()->save($skill,['requirement_id'=>$requirement->id,'requirable_id'=>$characterClass->id,'requirable_type'=>CharacterClass::class]);
								}
								break;
							case 'Grimoire':
								$this->command->info($this->realTrim($eachRule->parentRule->parentRule->title));
								switch ($this->realTrim($eachRule->title)) {
									case'Basic Spells: 1 Mana - 3 second cast time':
										$level = 1;
										break;
									case'Intermediate Spells: 2 Mana - 5 second cast time':
										$level = 2;
										break;
									case'Master Spells: 3 Mana - 8 second cast time':
										$level = 3;
										break;
								}
								$skill = Spell::firstOrCreate([
									'title' => $title
								]);
								$skill->level = $level;
								$skill->max_purchases = 1;
								$skillType =  SkillType::firstOrCreate(['model_class' => Spell::class]);
								$skill->skillType()->associate($skillType);
								$skill->save();
								$cost = $skill->costs()->create(['value' => $costValue]);
								$magic = Magic::firstOrCreate(['title' => $eachRule->parentRule->title]);
								$magicRequirement = Requirement::create();
								$sorcery = Skill::where('title','Conjuration')->firstOrFail();
								$magicRequirement->magicRequirer()->save($magic,['requirable_id'=>$sorcery->id,'requirable_type'=>Skill::class]);
								$requirement = Requirement::create();
								$requirement->skillRequirer()->save($skill,['requirement_id'=>$requirement->id,'requirable_id'=>$magic->id,'requirable_type'=>Magic::class]);
								break;
							case 'Pantheon':
								$this->command->info($this->realTrim($eachRule->parentRule->parentRule->title).": ".$title);
								if ($title == "Title") {
									$deity = Deity::firstOrCreate(['title' => $eachRule->title]);
									$deity->clerical_title = $body;
									$deity->ruled()->save($eachRule->parentRule->parentRule,['ruled_id'=>$deity->id,'ruled_type'=>Deity::class]);
									$deity->save();
								}
								elseif ($title == "Symbols") {
									$deity = Deity::firstOrCreate(['title' => $eachRule->title]);
									$deity->symbols = $body;
									$deity->save();
								}
								else {
									$tier = explode(" ",$this->realTrim($eachRule->title))[1];
									switch ($tier) {
										case'1':
											$level = 1;
											break;
										case'2':
											$level = 2;
											break;
										case'3':
											$level = 3;
											break;
									}
									$skill = Devotional::firstOrCreate([
										'title' => $title
									]);
									$skill->level = $level;
									$skillType =  SkillType::firstOrCreate(['model_class' => Deity::class]);
									$skill->skillType()->associate($skillType);
									$skill->save();
									$cost = $skill->costs()->create(['value' => $costValue]);
									$deity = Deity::firstOrCreate(['title' => $eachRule->parentRule->title]);
									$deityRequirement = Requirement::create();
									$devotion = Skill::where('title','Devotion')->firstOrFail();
									$deityRequirement->deityRequirer()->save($deity,['requirement_id'=>$deityRequirement->id,'requirable_id'=>$devotion->id,'requirable_type'=>Skill::class]);
									$requirement = Requirement::create();
									$requirement->skillRequirer()->save($skill,['requirement_id'=>$requirement->id,'requirable_id'=>$deity->id,'requirable_type'=>Deity::class]);
								}
								break;
						}
					} else {
						switch ($this->realTrim($eachRule->parentRule->getTitle())) {
							case 'Race':
								$this->command->info($this->realTrim($eachRule->parentRule->title));
								if ($title == "Base HP") {
									$race = Race::firstOrCreate([
										'title' => $eachRule->title
									]);
									$race->hitpoints = $body;
									$race->ruled()->save($eachRule->parentRule,['ruled_id'=>$race->id,'ruled_type'=>Race::class]);
									$race->save();
								}
								elseif(isset($costValue)){
									$skill = Skill::firstOrCreate([
										'title' => $title
									]);
									$skillType =  SkillType::firstOrCreate(['model_class' => Race::class]);
									$skill->skillType()->associate($skillType);
									switch ($costValue) {
										case 0:
											$level = 1;
											break;
										default:
											$level = 2;
											break;
									}
									$skill->level = $level;
									$skill->save();
									$race = Race::firstOrCreate(['title' => $eachRule->title]);
									$cost = $skill->costs()->create(['value' => $costValue]);
									$cost->race()->associate($race);
									$cost->save();
									$requirement = Requirement::create();
									$requirement->skillRequirer()->save($skill,['requirement_id'=>$requirement->id,'requirable_id'=>$race->id,'requirable_type'=>Race::class]);
								}
								break;
							case 'Homeland':
								$this->command->info($this->realTrim($eachRule->parentRule->title));
								$skill = Skill::firstOrCreate([
									'title' => $title
								]);
								$cost = $skill->costs()->create(['value' => $costValue]);
								switch (empty($costValue)) {
									case true:
										$level = 1;
										break;
									default:
										$level = 2;
										break;
								}
								$skill->level = $level;
								$skillType =  SkillType::firstOrCreate(['model_class' => Homeland::class]);
								$skill->save();
								$skill->skillType()->associate($skillType);
								$homeland = Homeland::firstOrCreate(['title' => $eachRule->title]);
								$homeland->ruled()->save($eachRule->parentRule,['ruled_id'=>$homeland->id,'ruled_type'=>Homeland::class]);
								$cost->homeland()
									->associate($homeland);
								$cost->save();
								$requirement = Requirement::create();
								$requirement->skillRequirer()->save($skill,['requirement_id'=>$requirement->id,'requirable_id'=>$homeland->id,'requirable_type'=>Homeland::class]);
								break;
							default:
								switch ($this->realTrim($eachRule->title)) {
									case'General Physical Abilities':
									case'Universal Abilities':
										$this->command->info($this->realTrim($eachRule->title));
										$skill = Skill::firstOrCreate([
											'title' => $title
										]);
										$skill->level = 1;
										$skillType =  SkillType::firstOrCreate(['model_class' => "App\\".studly_case($eachRule->getTitle())]);
										$skill->skillType()->associate($skillType);
										$skill->save();
										$skill->costs()->create(['value' => $costValue]);
										break;
								}
								break;
						}
					}
				}
				//might not be set if doing clerical title, hitpoints, non-ability
				if(isset($title))
					$this->command->info("Title: \"".$title."\"");
				//might not be set if doing clerical title, hitpoints
				if(is_null($returnValue) && isset($body) && isset($skill)){
					$requirementSearch = strpos($body,"Requires:");
					if(FALSE !== $requirementSearch){
						$bodyPieces = explode("Requires:",$body);
						$requirementNames = last($bodyPieces);
						$splitType = false;
						foreach([' or ',' OR ',' and ',' AND', ', '] as $splitType) {
							$requirementNames = explode($splitType, last($bodyPieces));
							if(count($requirementNames) > 1){
								if($splitType == ', ')
									$splitType = "and";
								break;
							}
							else
								$splitType = false;
						}
						if(count($requirementNames > 1)){
							$requirementGroup = RequirementGroup::create(['conjunction'=>strtolower($this->realTrim($splitType))]);
							foreach($requirementNames as $namesIndex => $eachRequirementName){
								$eachRequirementName = $this->realTrim($eachRequirementName);
								$this->command->info("Searching for required skill named: \"".$eachRequirementName."\" from body \"".$body."\"");
								$requiredSkill = Skill::firstOrCreate(['title'=>$eachRequirementName]);
								$requirement =  Requirement::create();
								$requirement->skillRequirer()->save($skill,[
									'requirement_id'=>$requirement->id,
									'requirable_id'=>$requiredSkill->id,
									'requirable_type'=>Skill::class
								]);
								$requirementGroup->requirements()->save($requirement);
								$requirementGroup->save();
							}
						}
						else{
							$requirementName = $this->realTrim(last($bodyPieces));
							$this->command->info("Searching for required skill named: \"".$requirementName."\" from body \"".$body."\"");
							$requiredSkill = Skill::firstOrCreate(['title'=>$requirementName]);
							$requirement = Requirement::create();
							$requirement->skillRequirer()->save($skill,[
								'requirement_id'=>$requirement->id,'requirable_id'=>$requiredSkill->id,'requirable_type'=>Skill::class
							]);
						}
						$body = substr($body,0,(-1*$requirementSearch));
					}
					$newLevel = $eachRule->level+1;
					$newSortOrder = $eachRule->sort_order + ($paragraphIndex * pow(32,4-$newLevel));
					$newRule = Rule::create([
						'title'=>$title,'level'=>$newLevel,'slug'=>str_slug($title),'sort_order'=>$newSortOrder
					]);
					$body = $this->realTrim($body);
					if(!empty($body)){
						$description = Description::firstOrNew(['body'=>$body]);
						$description->syncDocument = false;
						$newRule->description()->save($description);
						//$this->command->info("Document Data for description tied to \"".$newRule->getTitle()."\"".print_r($description->getDocumentData(),true));
						$description->document()->save();
					}
					$eachRule->childRules()->save($newRule);
					$skill->ruled()->save($newRule,['ruled_id'=>$skill->id,'ruled_type'=>Skill::class]);
					$this->command->info("Created Skill: ".$title." at ID #".$skill->id);
				}
				$this->command
					->info("=============================="
						."End of \"".$eachRule->getTitle()."\" Paragraph Index: ".$paragraphIndex
						."================================"
					);
				return $returnValue;
			});
			$paragraphs = $paragraphs->filter(function($eachParagraph){
				return !is_null($eachParagraph) && !empty($eachParagraph->innerHTML());
			});
			$this->command->info("==============================".
						"Old:\n".$eachDescription->body.
			"\n==============================");
			$newBody = "";
			foreach($paragraphs as $paragraph){
				$newBody .= $paragraph->outerHTML()."\n";
			}
			$this->command->info("=============================="."New:\n".$newBody.
			"\n==============================");
			$eachDescription->body = $newBody;
			$eachDescription->save();
		}
	}
}
