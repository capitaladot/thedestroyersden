<?php

namespace App;

use App\BaseModel;
use McCool\LaravelAutoPresenter\HasPresenter;
use App\Traits\Fillable;
use App\Traits\Navigatable;
use App\Traits\Presentable;
use SammyK\LaravelFacebookSdk\SyncableGraphNodeTrait;
use MartinBean\MenuBuilder\Contracts\NavigatableContract;

class Event extends BaseModel implements HasPresenter, NavigatableContract {
	use Fillable;
	use Navigatable;
	use Presentable;
	use SyncableGraphNodeTrait;
	protected static $graph_node_field_aliases = [ 
			'id' => 'facebook_id',
			'name' => 'name',
			'start_time' => 'start_time',
			'timezone' => 'timezone',
			'location' => 'location',
			'updated_time' => 'updated_at' 
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
	protected $fillable = [ 
			"name",
			"start_time",
			"timezone",
			"description",
			"facebook_id",
			"title",
			"slug" 
	];
	public $duration;
	public $relationMethods = [ 
			'User' => 'owner',
			'Arc' => 'arcs' 
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
	public function facebookId(){
		return '<a href="https://www.facebook.com/events/'.$this->facebook_id.'">Link</a>';
	}
	public function getDates() {
		return [ 
				'created_at',
				'updated_at',
				'start_time',
				'end_time' 
		];
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
		$daysForArcs = self::explodePeriodByDays($graph_node->start_time,$graph_node->end_time);
		foreach($daysForArcs as $index => $dayForArc){
			$arc{$index} = Arc::create([
				'start_time'=>$dayForArc['start_time'],
				'end_time'=>$dayForArc['end_time'],
				'title'=>$graph_node->title." ".$dayForArc['start_time']->format('l'),
				'slug'=>str_slug($graph_node->title." ".$dayForArc['start_time']->format('l')),
				'event_id'=>$graph_node->id
			]);
		}
	}
	public static function explodePeriodByDays($begin, $end) {
		$days = [];
		$dayInterval = new \DateInterval('P1D');
		$begin = new \DateTime($begin);
		$end = new \DateTime($end);
		$_end = clone $end; 
		$_end->modify('+1 day');
		foreach ((new \DatePeriod($begin, $dayInterval, $_end)) as $i => $period) {
			$_begin = $period;
			if ($i) $_begin->setTime(0, 0, 0);
			if ($_begin > $end) break;
			$_end = clone $_begin;
			$_end->setTime(23, 59, 59);
			if ($end < $_end) $_end = $end;
			$days[] = [
				'start_time' => $_begin,
				'end_time' => $_end,
			];
		}
		return $days;
	}

	public function owner() {
		return $this->belongsTo ( 'App\User' );
	}
	public function arcs() {
		return $this->hasMany ( 'App\Arc' );
	}
}