<?php

namespace App\Repositories;

use App\BaseModel;
use App\Exceptions\RepositoryException;
use Illuminate\Container\Container as App;

abstract class BaseRepository {
	protected $app;
	
	/**
	 *
	 * @var Collection
	 */
	protected $criteria = [ ];
	
	/**
	 *
	 * @var bool
	 */
	protected $skipCriteria = false;
	protected $modelName;
	protected $namespacedModelClass;
	public function __construct(App $app) {
		$this->modelName = class_basename ( get_class ( $this ) );
		$this->modelName = str_replace ( "Repository", "", $this->modelName );
		$this->namespacedModelClass = 'App\\' . $this->modelName;
		$this->app = $app;
		$this->makeModel ();
	}
	public function model() {
		return $this->namespacedModelClass;
	}
	/**
	 *
	 * @return Model
	 * @throws RepositoryException
	 */
	public function makeModel() {
		$model = $this->app->make ( $this->model () );
		
		if (! $model instanceof BaseModel)
			throw new RepositoryException ( "Class {$this->model()} must be an instance of App\\BaseModel" );
		$model->provideRelatables ();
		return $this->model = $model;
	}
	/**
	 *
	 * @param array $columns        	
	 * @return mixed
	 */
	public function all($columns = array('*')) {
		$this->applyCriteria ();
		$this->model->newQuery ( $columns )->eagerLoadRelations ( $this->model->relatedModels );
		return $this->model->get ( $columns );
	}
	
	/**
	 *
	 * @param int $perPage        	
	 * @param array $columns        	
	 * @return mixed
	 */
	public function paginate($perPage = 15, $columns = array('*')) {
		return $this->model->paginate ( $perPage, $columns );
	}
	
	/**
	 *
	 * @param array $data        	
	 * @return mixed
	 */
	public function create(array $data) {
		return $this->model->create ( $data );
	}
	
	/**
	 *
	 * @param array $data        	
	 * @param
	 *        	$id
	 * @param string $attribute        	
	 * @return mixed
	 */
	public function update(array $data, $id, $attribute = "id") {
		return $this->model->where ( $attribute, '=', $id )->update ( $data );
	}
	
	/**
	 *
	 * @param
	 *        	$id
	 * @return mixed
	 */
	public function delete($id) {
		return $this->model->destroy ( $id );
	}
	
	/**
	 *
	 * @param
	 *        	$idOrSlug
	 * @param array $columns        	
	 * @return mixed
	 */
	public function find($idOrSlug, $columns = array('*')) {
		if (is_numeric ( $idOrSlug ))
			return $this->model->find ( $idOrSlug, $columns );
		return $this->findBySlug ( $idOrSlug, $columns );
	}
	public function findBySlug($slug, $columns) {
		$this->model->where ( 'slug', '=', $slug );
		foreach ( $columns as $column ) {
			$this->model->where ( $column );
		}
		return $this->model->firstOrFail ();
	}
	/**
	 *
	 * @param
	 *        	$attribute
	 * @param
	 *        	$value
	 * @param array $columns        	
	 * @return mixed
	 */
	public function findBy($attribute, $value, $columns = array('*')) {
		return $this->model->where ( $attribute, '=', $value )->first ( $columns );
	}
	public function with($relations) {
		if (is_string ( $relations ))
			$relations = func_get_args ();
		
		$this->with = $relations;
		
		return $this;
	}
	protected function eagerLoadRelations() {
		if (! is_null ( $this->with )) {
			foreach ( $this->with as $relation ) {
				$this->model->with ( $relation );
			}
		}
		
		return $this;
	}
	/**
	 *
	 * @return $this
	 */
	public function resetScope() {
		$this->skipCriteria ( false );
		return $this;
	}
	
	/**
	 *
	 * @param bool $status        	
	 * @return $this
	 */
	public function skipCriteria($status = true) {
		$this->skipCriteria = $status;
		return $this;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function getCriteria() {
		return $this->criteria;
	}
	
	/**
	 *
	 * @param Criteria $criteria        	
	 * @return $this
	 */
	public function getByCriteria(Criteria $criteria) {
		$this->model = $criteria->apply ( $this->model, $this );
		return $this;
	}
	
	/**
	 *
	 * @param Criteria $criteria        	
	 * @return $this
	 */
	public function pushCriteria(Criteria $criteria) {
		$this->criteria->push ( $criteria );
		return $this;
	}
	
	/**
	 *
	 * @return $this
	 */
	public function applyCriteria() {
		if ($this->skipCriteria === true)
			return $this;
		
		foreach ( $this->getCriteria () as $criteria ) {
			if ($criteria instanceof Criteria)
				$this->model = $criteria->apply ( $this->model, $this );
		}
		
		return $this;
	}
}