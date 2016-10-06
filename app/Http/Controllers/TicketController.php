<?php
/**
 * Created by PhpStorm.
 * User: austi_000
 * Date: 5/31/2016
 * Time: 9:49 AM
 */

namespace App\Http\Controllers;
use App\Repositories\TicketRepository;
use Illuminate\Http\Request;
use Log;
use App\Arc;

class TicketController extends BaseController
{
	public function __construct(TicketRepository $repository)
	{
		$this->repository = $repository;
		return parent::__construct();
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {
		if($this->user->can('create.ticket')) {
			$arcCollection = collect($request->arc);
			foreach($arcCollection as $eachArcId) {
				$data = ['arc'=>$eachArcId,'user_id'=>$request->user_id,'order_id'=>$request->order_id];
				$validate = $this->repository->makeModel();
				$validate->validate($data);
				if ($validate->validator->fails()) {
					return redirect()->back()->withInput()->withErrors($validate->validator);
				}
				else {
					if ($validate->validator->passes() && $validate->saveOrFail() && $validate->push() && $validate->attachRequiredRelations($data)) {
						Log::info("Controller: Saved " . class_basename(get_class($this->repository->model) . " with ID " . $validate->id));
						if($arcCollection->last() == $eachArcId) {
							$url = $validate->order->getUrl();
							return redirect($url);
						}
					} else {
						\ddd($validate);
					}
				}
			}
		}
		abort(403, 'Unauthorized action: create.ticket');
	}

	public function destroy($idOrSlug)
	{
		if($this->user->can('delete.ticket')) {
			if(is_array($idOrSlug)){
				$ticket = $this->repository->find($idOrSlug);
				$order = $ticket->order;
				if (!$ticket->order->approved) {
					$ticket->delete();
					return redirect(strtolower($order->getUrl()));
				}
			}
		}
	}
}
