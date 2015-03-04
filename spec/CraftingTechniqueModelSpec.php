<?php
namespace spec;
use PhpSpec\Laravel\EloquentModelBehavior;

class CraftingTechniqueModelSpec extends EloquentModelBehavior
{

    public function it_should_have_tools ()
    {
        $this->tools()->shouldDefineRelationship('hasMany', 'Tool');
    }

    public function it_should_have_crafting_components ()
    {
        $this->craftingComponents()->shouldDefineRelationship('hasMany',
                'CraftingComponent');
    }
}