<?php

namespace App;

use App\Traits\Describable;
use App\Traits\Owned;
use App\Traits\Relatable;
use McCool\LaravelAutoPresenter\HasPresenter;
use App\Traits\Fillable;
use App\Traits\Navigatable;
use App\Traits\Presentable;
use SammyK\LaravelFacebookSdk\SyncableGraphNodeTrait;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use vendocrat\Addresses\Traits\AddressableTrait as Addressable;
use vendocrat\Addresses\Contracts\AddressableInterface;

class Event extends BaseModel implements AddressableInterface, HasPresenter, NavigatableContract {
	use Addressable;
	use Describable;
	use Fillable;
	use Navigatable;
	use Owned;
	use Presentable;
	use Relatable;
	use SyncableGraphNodeTrait;
	const dateIntervalString = '+8 hours';
	protected static $graph_node_field_aliases = [
		'id' => 'facebook_id',
		'name' => 'name',
		'start_time' => 'start_time',
		'timezone' => 'timezone',
		'location' => 'location',
		'updated_time' => 'updated_at'
	];
	public $hidden =[
		'timezone'
	];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'events';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	public $fillable = [
		"name",
		"start_time",
		"timezone",
		"facebook_id",
		"title",
		"slug"
	];
	public $duration;
	public $relationMethods = [
			'addresses',
			'Owner' => 'owner',
			'Arcs' => 'arcs'
	];
	public $dates = [
		'created_at',
		'updated_at',
		'start_time',
		'end_time'
	];
	public $casts =	[
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
		'start_time' => 'datetime',
		'end_time' => 'datetime'
	];
	public function __construct($values = array()) {
		parent::__construct ( $values );
		static::saving ( function (Event $event) {
			if(!is_null($event->start_time) && !is_null($event->end_time))
				$event->duration = $event->start_time->diff ( $event->end_time );
		} );
	}
	public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery()->orderBy('start_time','ASC');
    }
	public function getFacebookId(){
		return '<a href="https://www.facebook.com/events/'.$this->facebook_id.'">Link</a>';
	}
	public function getDates() {
		return $this->dates;
	}
	/**
	 * Inserts or updates the Graph node to the local database
	 *
	 * @param array|GraphObject $data        	
	 *
	 * @return Model
	 *
	 * @throws \InvalidArgumentException
	 */
	public static function createOrUpdateGraphNode($data) {
		// @todo this will be GraphNode soon
		if (is_object ( $data )) {
			$data = $data->asArray ();
			$parsedData = [ ];
			foreach ( $data as $key => $value ) {
				if ($value instanceof \DateTime)
					$parsedData [$key] = $value->format ( \DB::getQueryGrammar ()->getDateFormat () );
				else
					$parsedData [$key] = $value;
			}
			$data = $parsedData;
		}
		if (! isset ( $data ['id'] )) {
			throw new \InvalidArgumentException ( 'Graph node id is missing' );
		}
		
		$attributes = [ 
				static::getGraphNodeKeyName () => $data ['id'] 
		];
		
		$graph_node = static::firstOrNewGraphNode ( $attributes );
		
		static::mapGraphNodeFieldNamesToDatabaseColumnNames ( $graph_node, $data );
		// dd ( $graph_node );
		$graph_node->title = $graph_node->name;
		$graph_node->slug = str_slug($graph_node->name);
		$graph_node->save ();
		$daysForArcs = self::explodePeriodByInterval($graph_node->start_time,$graph_node->end_time);
		$lastDay = '';
		$counter = 1;
		foreach($daysForArcs as $index => $dayForArc){
			if($dayForArc['start_time']->format('l') == $lastDay)
				++$counter;
			else
				$counter = 1;
			$lastDay = $dayForArc['start_time']->format('l');
			$title = $graph_node->title." ".$dayForArc['start_time']->format('l') ." #". $counter;
			$arc{$index} = Arc::create([
				'start_time'=>$dayForArc['start_time'],
				'end_time'=>$dayForArc['end_time'],
				'title'=>$title,
				'slug'=>str_slug($title),
				'event_id'=>$graph_node->id
			]);
		}
	}
	public static function explodePeriodByInterval($begin, $end) {
		$arcs = [];
		$arcInterval = \DateInterval::createFromDateString(self::dateIntervalString);
		$begin = new \DateTime($begin);
		$end = new \DateTime($end);
		$_end = clone $end; 
		$_end->modify(self::dateIntervalString);
		foreach ((new \DatePeriod($begin, $arcInterval, $_end)) as $i => $period) {
			$_begin = $period;
			if ($_begin >= $end)
				break;
			$_end = clone $_begin;
			if ($end < $_end)
				$_end = $end;
			else
				$_end->add($arcInterval);
			$arcs[] = [
				'start_time' => $_begin,
				'end_time' => $_end,
			];
		}
		return $arcs;
	}
	//relations
	public function owner() {
		return $this->belongsTo ( 'App\User' );
	}
	public function arcs() {
		return $this->hasMany ( 'App\Arc' );
	}
}
