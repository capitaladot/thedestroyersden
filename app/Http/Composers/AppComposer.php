<?php namespace App\Http\Composers;

use App\Link;
use App\MainMenuItem;
use Illuminate\Contracts\View\View;
use App\Repositories\MainMenuRepository;
use App\Presenters\FormattedUnorderedListPresenter;
use App\BaseModel;
use App\MainMenu;
use Illuminate\Support\Facades\Auth;
use App\User;
use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;
use Riari\Forum\Models\Category as Forum;

class AppComposer {

    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
	protected $craftingMenu;
	protected $eventMenu;
	protected $linkMenu;
    protected $menus;

	/**
	 * AppComposer constructor.
	 * @param MainMenuRepository $mainMenu
	 */
    public function __construct(MainMenuRepository $mainMenu)
    {
		if(Auth::guest()){
			$this->user = User::findOrFail(1);
		}
		else{
			$this->user = Auth::user();
		}
        // Dependencies automatically resolved by service container...
		$baseMenus = [
			'link',
		];
		foreach($baseMenus as $menuName) {
			$eachMenu = $mainMenu->findBy ( 'name', ucfirst($menuName) );
			if (isset($this->user)){
				if ($this->canCreate($eachMenu)) {
					$eachMenu = $this->createAddLink($eachMenu);
				}
				if ($this->canList($eachMenu)) {
					$eachMenu = $this->createListLink($eachMenu);
				}
			}
			$this->{$menuName.'Menu'} = $eachMenu;
		}
		$this->menus = $mainMenu->all();
		if (!$this->user->isAdmin()) {
			$this->menus = $this->menus->filter(function ($eachMenu) use ($baseMenus) {
				$permissionString = 'list.' . str_slug(str_plural($eachMenu->name));
				if ($this->user->can($permissionString)) {
					return true;
				}
			});
		}
		$this->menus = $this->menus->transform(function($eachMenu){
			if($this->canCreate($eachMenu)){
				$eachMenu = $this->createAddLink($eachMenu);
			}
			if($this->canList($eachMenu)){
				if($eachMenu->name === "Forum"){
					foreach(Forum::all() as $eachForum){
						$addEntry = new MainMenuItem();
						$addLink = new Link([
							'link' => "/forum/".$eachForum->id."-".str_slug($eachForum->title),
							'slug'=>str_slug($eachForum->title),
							'title' => $eachForum->title
						]);
						$addEntry->navigatable = $addLink;
						$eachMenu->appendedItems->push($addEntry);

					}
				}
				$eachMenu = $this->createListLink($eachMenu);
			}
			return $eachMenu;
		});
    }
	/**
	 * @param MainMenu $menu
	 * @return mixed
	 */
	protected function canCreate(MainMenu $menu){
		$test = $this->user->can('create.'. str_plural(str_slug($menu->properName())));
		return $test;
	}

	/**
	 * @param MainMenu $menu
	 * @return mixed
	 */
	protected function canList(MainMenu $menu){
		$test = $this->user->can('list.'.str_slug($menu->pluralName()));
		return $test;
	}
	protected function createAddLink(MainMenu $menu){
		$addEntry = new MainMenuItem();
		$addLink = new Link([
			'link' => "/".str_slug($menu->properName())."/create",
			'slug'=>str_slug($menu->properName()),
			'title' => "Create a new ".$menu->properName()
		]);
		$addEntry->navigatable = $addLink;
		$menu->appendedItems->push($addEntry);
		return $menu;
	}
	protected function createListLink(MainMenu $menu){
		$listEntry = new MainMenuItem();
		$listLink = new Link([
			'link' => "/".str_slug($menu->properName())."/",
			'slug'=>str_slug($menu->properName()),
			'title' => "List of ".$menu->pluralName()
		]);
		$listEntry->navigatable = $listLink;
		$menu->appendedItems->push($listEntry);
		return $menu;
	}
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {	
		if(!empty($this->linkMenu)){
			$linkPresenter = new FormattedUnorderedListPresenter ( $this->linkMenu, "nav navbar-nav" );
			$view->with ( 'linkPresenter', $linkPresenter );
		}
		$view->with ( 'menus', $this->menus );
    }

}
