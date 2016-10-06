<?php

namespace App\Database\Seeds;

use Illuminate\Database\Eloquent\Model;
use PHPHtmlParser\Dom;
use App\Rule;
use App\MainMenu;
use App\MainMenuItem;
use App\Description;

class RuleTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rulesDirectory = storage_path()."/app/book";
        $files = collect(scandir($rulesDirectory));
        Model::unguard();
        $parser = new Dom();
        $titledRules = collect();
        foreach($files as $fileName) {
            switch ($fileName) {
                case ".":
                case "..":
                case "index.html":
                case "toc.html":
                case"items":
                    break;
                default:
                    $ruleDescriptionHtml = $parser->load(file_get_contents($rulesDirectory . "/" . $fileName));
                    for ($level = 1; $level < 10; ++$level) {
                        $search = $ruleDescriptionHtml->find('h' . $level);
                        if (count($search)) {
                            $heading = strip_tags($search[0]->innerHtml());
                            $search->delete();
                            unset($search);
                            $heading = preg_replace("/([\s]{2,})/"," ",$heading);
                            if (strtoupper($heading) == $heading)
                                $heading = ucwords(strtolower($heading));
                            break;
                        }
                    }
                    $linksInBody = $ruleDescriptionHtml->find('a');
                    foreach($linksInBody as $a) {
                        if(
                            $a->getAttribute('href') == 'toc.html'
                                ||
                            $a->innerHTML == 'Previous'
                                ||
                            $a->innerHTML == 'Next'
                        ){
                            $a->delete();
                            unset($a);
                        }
                    }
                    $horizontalRulesInBody = $ruleDescriptionHtml->find('hr');
                    foreach($horizontalRulesInBody as $hr) {
                        $hr->delete();
                        unset($hr);
                    }
                    $body = $ruleDescriptionHtml->find('body')[0]->innerHtml();
                    $body = str_replace("&nbsp;","",$body);
                    $body = preg_replace("/<!--span(.*)-->/","",$body);
                    $body = preg_replace("/(\s{2,})/"," ",$body);
                    $titledRules[] = ['title'=>$heading, 'body'=> $body];
                    break;
            }
        }
        $titledRules = $titledRules->transform(function($eachRule)use($rulesDirectory){
            $matches = [];
            $numericWeight = 0;
            if(preg_match("/([0-9\\.]+)/",$eachRule['title'],$matches)) {
                $this->command->info("Heading Number Matches".collect($matches));
                $chapterTitleVerseSection = collect(explode(".",$matches[0]));
                if(empty($chapterTitleVerseSection))
                    $chapterTitleVerseSection = collect($matches[0]);
                $this->command->info("Indices Array for ".$eachRule['title'].":".$chapterTitleVerseSection);
                foreach($chapterTitleVerseSection as $index => $value) {
                    if(is_numeric($value) && is_numeric($index)){
                        $weightFactor = pow(32,((3 - (int)$index)));
                        $numericWeight += (($weightFactor <= 0  ? 1 : $weightFactor) * $value);
                        $this->command->info ("Weight Factor:".$weightFactor." Value: ".$value. " Index: ".$index." Numeric Weight: ".$numericWeight);
                    }
                    elseif(!is_numeric($value))
                        $this->command->info("Value ".$value ." was not numeric.");
                    elseif(!is_numeric($index))
                        $this->command->info("Index ".$index ." was not numeric.");
                }
                $eachRule['sortOrder'] = $numericWeight;
                $this->command->info("Title Heading Number Matches".collect($matches[0]));
                $newTitle = html_entity_decode(substr($eachRule['title'],strlen($matches[0])));
                $newTitle = $this->realTrim(preg_replace("/(\s{2,})/"," ",$newTitle));
                $this->command->info("Old Title: ".$eachRule['title']."; New Title: ".$newTitle);
                $eachRule['title'] = $newTitle;
                $eachRule['level'] = count(explode(".",$matches[0]));
                $this->command->info($matches[0] ." interpreted as level ".$eachRule['level']);
                return $eachRule;
            }
        });
        $titledRules = $titledRules->sortBy('sortOrder');
        Rule::flushEventListeners();
        $ruleMenu = MainMenu::where('name','Rule')->firstOrFail();
        $rule = Rule::create([
            'title'=>'Rulebook',
            'slug'=>str_slug('Rulebook'),
            'level'=>0,
            'sort_order'=>0
        ]);
        $rule->description()->create([
            'body'=>'The Rulebook in all its glory!'
        ]);
        $newItem = new MainMenuItem( ['menu_id' => $ruleMenu->id,'sort_order'=>0]);
        $newItem->navigatable()->associate($rule);
        $newItem->save();
        $priorRule = $rule;
        foreach($titledRules as $eachRule) {
            $rule = Rule::create([
                'title' => $eachRule['title'],
                'slug' => str_slug($eachRule['title']),
                'level' => $eachRule['level'],
                'sort_order' => $eachRule['sortOrder']
            ]);
            if ($priorRule) {
                while ($priorRule->level >= $rule->level) {
                    if ($rule->level == 1 || $priorRule->id == 1)
                        break;
                    if (count($priorRule->parentRule) && $priorRule->parentRule->level <= $priorRule->level)
                        $priorRule = $priorRule->parentRule;
                }
            }
            if ($priorRule && $priorRule->level < $rule->level) {
                //$this->command->info($priorRule->level . " < " . $rule->level);
                $rule->parentRule()->associate($priorRule);
                $rule->save();
            }
            if (!empty($eachRule['body'])){
                $description = Description::firstOrNew(['body'=>$eachRule['body']]);
                $description->syncDocument = false;
                $rule->description()->save($description);
               // $this->command->info("Document Data for description tied to \"".$rule->getTitle()."\"".print_r($description->getDocumentData(),true));
            }
            $newItem = new MainMenuItem( ['menu_id' => $ruleMenu->id,'sort_order'=>$eachRule['sortOrder']]);
            $newItem->navigatable()->associate($rule);
            $newItem->save();
            $priorRule = $rule;
        }
        Model::reguard();
    }
}
