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
			$event->duration = $event->start_time->diff ( $event->end_time );
		} );
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
		$graph_node->save ();
	}
	
	/**
	 * Like static::firstOrNew() but without mass assignment
	 *
	 * @param array $attributes        	
	 *
	 * @return Model
	 */
	public static function firstOrNewGraphNode(array $attributes) {
		if (is_null ( $facebook_object = static::firstByAttributes ( $attributes ) )) {
			$facebook_object = new static ();
		}
		
		return $facebook_object;
	}
	public function owner() {
		return $this->belongsTo ( 'App\User' );
	}
	public function arcs() {
		return $this->hasMany ( 'App\Arc' );
	}
}