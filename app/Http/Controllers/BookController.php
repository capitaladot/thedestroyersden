<?php
namespace App\Http\Controllers;
use PDF;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Rule;
use Carbon\Carbon;

class BookController extends Controller{
	 public function getPdf(){
		set_time_limit(60);
		$body = ["<html><head>"];
		$body[] = "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
		$body[] = "<style type=\"text/css\">
@font-face {
    font-family: Raleway;
    font-style: normal;
    font-weight: 400;
    src: url(data:font/opentype;charset=utf-8;base64,".base64_encode(file_get_contents(storage_path()."/fonts/Raleway.woff2")).") format(\"woff\"),
    url(data:font/truetype;charset=utf-8;base64,".base64_encode(file_get_contents(storage_path()."/fonts/Raleway-Regular.ttf")).") format(\"truetype\");
}
body,p,h1,h2,h3,h4,h5,h6{
	font-family: Raleway;
}
html,body{
	margin: 0 0 0 0;
	padding: 0 0 0 0;
	font-size:11px;
}
h1 { font-size: 3em; }
h2 { font-size: 2.25em; }
h3 { font-size: 1.625em; }
h4 { font-size: 1.25em; }
h5 { font-size: 1.125em; }
h6 { font-size: 1em; }
h1,h2,h3{
	text-align: center;
}
h4,h5,h6{
	display:inline-block;
}
h4:after,h5:after,h6:after{
	content: \": \";
}
</style>";
		$wroteTitle = false;
		 foreach(Rule::orderBy('sort_order')->get() as $eachRule){
			if(!$wroteTitle && $eachRule->level == 0){
				$downloadedString = " (downloaded ".Carbon::now().")";
				$body[] = "<title>The Destroyer's Den - ".$eachRule->getTitle().$downloadedString.": ".strip_tags($eachRule->description->first()->body)."</title>";
				$body[] = "</head><body>";
				$body[]="<center><img src=\"".url("/")."/images/red-destroyers-den-logo-text.png\" alt =\"The Destroyer's Den\"></center>";
				$body[]="<center><img src=\"".url("/")."/images/DD Dragon.jpg\" alt=\"The Destroyer's Den\"></center>";
				$body[] = "<h".($eachRule->level+1).">".$eachRule->getTitle().$downloadedString."</h".($eachRule->level+1).">";
				$body[] = "<center>".$eachRule->description->first()->body."</center>";
				$wroteTitle = true;
			}
			else {
				if($eachRule->level + 1 > 3)
					$body[] = "<br>";
				$body[] = "<h" . ($eachRule->level + 1) . ">" . $eachRule->getTitle() . "</h" . ($eachRule->level + 1) . ">";
				if(count($eachRule->ruled)){
					switch($eachRule->ruled->class){
						case 'App\Skill':
						case 'App\Spell':
						case 'App\Craft':
							if(count($eachRule->ruled->costs))
								$body[] ='<strong>Cost:&nbsp;'.$eachRule->ruled->costs->first()->value.'&nbsp;XP</strong><br>';
						break;
						case 'App\CharacterClass':
							$body[] ='<strong>Bonus Hit Points:&nbsp;'.$eachRule->ruled->hitpoints.'</strong><br>';
							if(!empty($eachRule->ruled->manapool))
								$body[] ='<strong>Base Mana Points:&nbsp;'.$eachRule->ruled->manapool.'</strong><br>';
						break;
						case 'App\Race':
							$body[] ='<strong>Base Hit Points:&nbsp;'.$eachRule->ruled->hitpoints.'</strong><br>';
						break;
					}
				}
				if(count($eachRule->description))
					$body[] = $eachRule->description->first()->body;
			}
		}
		$body[] = "</body></html>";
		//return response(implode("\n",$body));
		$datedTitle = "* [page] The Destroyer's Den Rulebook ".Carbon::now();
		return PDF::HTML('book',[
			'book'=>implode("\n",$body)
		],$datedTitle)
			->footerCenter($datedTitle)
			->toc()
			->printMediaType();
	 }
 }
