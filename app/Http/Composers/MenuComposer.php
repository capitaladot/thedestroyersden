<?php namespace App\Http\Composers;

use App\Link;
use App\MainMenuItem;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use App\Repositories\MainMenuRepository;
use App\Presenters\FormattedUnorderedListPresenter;
use App\BaseModel;
use App\MainMenu;
use Illuminate\Support\Facades\Auth;
use App\User;
use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;
use MartinBean\MenuBuilder\UnorderedListPresenter;
use Riari\Forum\Models\Category as Forum;
use Cache;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Jobs\CacheMenus;

class MenuComposer {
	use DispatchesJobs;
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
	protected $linkMenu;
    protected $menus;
	protected $presenters;

	/**
	 * AppComposer constructor.
	 * @param MainMenuRepository $mainMenu
	 */
    public function __construct(MainMenuRepository $mainMenu)
    {
		$this->mainMenu = $mainMenu;
		if(Auth::guest()){
			$this->user = User::findOrFail(1);
		}
		else{
			$this->user = Auth::user();
		}
        // Dependencies automatically resolved by service container...
		$perUser = ['orders','tickets'];
		$this->menus = $this->mainMenu->all();
		if(
			Cache::has($this->user->getSlug().'renderedLinkMenu')
		){
			$this->renderedLinkMenu = Cache::get($this->user->getSlug().'renderedLinkMenu');
			foreach($this->menus as $menu){
				if ($menu->canList($this->user)) {
					$renderedName = 'rendered'.studly_case($menu->name).'Menu';
					$this->$renderedName = Cache::get($this->user->getSlug().$renderedName);
					$this->renderedMenus[$menu->pluralName()] = $this->$renderedName;
				}
			}
		}
		else {
			$baseMenus = [
				'link',
			];
			foreach ($baseMenus as $menuName) {
				$eachMenu = $this->mainMenu->findBy('name', ucfirst($menuName));
				if (isset($this->user)) {
					if ($eachMenu->canCreate($this->user)) {
						$eachMenu = $this->createAddLink($eachMenu);
					}
					if ($eachMenu->canList($this->user)) {
						$eachMenu = $this->createListLink($eachMenu);
					} 
				}
				$this->{$menuName . 'Menu'} = $eachMenu;
			}
			if (!$this->user->isAdmin()) {
				$this->menus = $this->menus->filter(function ($eachMenu) {
					return $eachMenu->canList($this->user);
				});
			}
			$this->menus = $this->menus->transform(function ($eachMenu) {
				if ($eachMenu->canCreate($this->user)) {
					$eachMenu = $this->createAddLink($eachMenu);
				}
				if ($eachMenu->canList($this->user)) {
					if ($eachMenu->name === "Forum") {
						foreach (Forum::all() as $eachForum) {
							$addEntry = new MainMenuItem();
							$addLink = new Link([
								'link' => "/forum/" . $eachForum->id . "-" . str_slug($eachForum->title),
								'slug' => str_slug($eachForum->title),
								'title' => $eachForum->title
							]);
							$addEntry->navigatable = $addLink;
							$eachMenu->appendedItems->push($addEntry);
						}
					}
					$eachMenu = $this->createListLink($eachMenu);
				}
				$this->presenters[$eachMenu->name] = new FormattedUnorderedListPresenter($eachMenu, "dropdown-menu");
				switch ($eachMenu->name) {
					case 'Rule':
						$addEntry = new MainMenuItem();
						$pdfTitle = 'Download PDF';
						$addLink = new Link([
							'link' => "/book/pdf",
							'slug' => str_slug($pdfTitle),
							'title' => $pdfTitle
						]);
						$addEntry->navigatable = $addLink;
						$eachMenu->appendedItems->push($addEntry);
						$this->presenters[$eachMenu->name]->clearSortRules();
						$this->presenters[$eachMenu->name]->addSortRule('menu_items.navigatable_id');
					break;
				}
				return $eachMenu;
			});
			foreach($this->menus as $menu){
				$renderedMenu = $menu->render($this->presenters[$menu->name]);
				$this->renderedMenus[$menu->pluralName()] = $renderedMenu;
				Cache::put($this->user->getSlug().'rendered'.$menu->name.'Menu',$renderedMenu, Carbon::create()->addMinutes(30));
			}
			$this->renderedLinkMenu = $this->linkMenu->render(new FormattedUnorderedListPresenter($this->linkMenu, "dropdown-menu"));
			Cache::put($this->user->getSlug().'rendered'.$this->linkMenu->name.'Menu',$this->renderedLinkMenu, Carbon::create()->addMinutes(30));
			//$this->dispatch(new CacheMenus($this->user,$this->renderedMenus,$this->renderedLinkMenu));
		}
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
    public function compose(View $view){
		$view->with('menus', $this->renderedMenus);
		$view->with('linkMenu', $this->renderedLinkMenu);
    }
}
