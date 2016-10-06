<?php
/**
 * Created by PhpStorm.
 * User: austi_000
 * Date: 5/31/2016
 * Time: 9:04 AM
 */

namespace App\Http\Controllers;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;

class OrderController extends BaseController
{
	public function __construct(OrderRepository $orderRepository)
	{
		$this->repository = $orderRepository;
		return parent::__construct();
	}
	public function store(Request $request){
		if($this->user->can('create.'.str_slug($this->baseUrl))) {
			$validate = $this->repository->makeModel();
			$validate->validate($request->all());
			if ($validate->validator->fails()) {
				return redirect()->back()->withInput()->withErrors($validate->validator);
			} else {
				if ($validate->validator->passes() && $validate->execute() && $validate->saveOrFail() && $validate->push() && $validate->attachRequiredRelations($request->all())) {
					Log::info("Controller: Saved " . class_basename(get_class($this->repository->model) . " with ID " . $validate->id));
					$url = $validate->implementsInterface(NavigatableContract::class)
						? $validate->getUrl()
						: $this->baseUrl . '/' . $validate->id;
					return redirect($url);
				} else {
					\ddd($validate);
				}
			}
		}
		abort(403, 'Unauthorized action.'.'store.'.str_slug(str_plural($this->baseUrl)));
	}

	/**
	 * @param $idOrSlug
	 * @return Response
	 * @desc Don't destroy orders, just delete tickets.
	 */
	public function destroy($idOrSlug)
	{
		if($this->user->can('create.'.str_slug($this->baseUrl))) {
			$order = $this->repository->find($idOrSlug);
			if (!$order->approved) {
				foreach ($order->tickets as $ticket) {
					$ticket->delete();
				}
			}
			return redirect($order->getUrl());
		}
		abort(403, 'Unauthorized action.'.'delete.order');
	}
}
