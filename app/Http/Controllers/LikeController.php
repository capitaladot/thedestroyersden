<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Caffeinated\Flash\Facades\Flash;

/**
 * Class LikeController
 * @package App\Http\Controllers
 */
class LikeController extends Controller{
	/**
	 * @param $likeable_type
	 * @param $likeable_id
	 */
	public function anyToggleLike($likeable_type,$likeable_id){
		$namespacedClass = "App\\".studly_case($likeable_type);
		$likeable = $namespacedClass::findOrFail($likeable_id);
		if($likeable->liked())
			$likeable->unlike(Auth::user()->id);
		else $likeable->like(Auth::user()->id);
		Flash::success(studly_case($likeable_type). ($likeable->liked() ? " liked.": " unliked."));
		return back();
	}
}
