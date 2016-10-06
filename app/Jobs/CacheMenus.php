<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Cache;
use App\MainMenu;
use App\User;

class CacheMenus extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     * $user User object
	 * $renderedMenus string
	 * $renderedLinkMenu string
     * @return void
     */
    public function __construct(User $user, $renderedMenus,$renderedLinkMenu)
    {
        $this->user = $user;
        $this->renderedMenus = $renderedMenus;
        $this->renderedLinkMenu = $renderedLinkMenu;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       	Cache::put($this->user->getSlug().'renderedMenus',$this->renderedMenus, Carbon::create()->addMinutes(30));
        Cache::put($this->user->getSlug().'renderedLinkMenu',$this->renderedLinkMenu, Carbon::create()->addMinutes(30));
    }
}
