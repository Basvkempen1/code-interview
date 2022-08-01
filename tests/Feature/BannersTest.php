<?php

namespace Tests\Feature;

use App\Http\Livewire\Banner\Banners;
use App\Models\Banner;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Livewire;
use Tests\TestCase;

class BannersTest extends TestCase
{
    public Collection $bannerCollection;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    public function testAUserCanCreateABanner(): void
    {
        $banner = Banner::factory()->make()->toArray();

        Livewire::test(Banners::class)
            ->set([
                'selectedBanner' => $banner,
            ])
            ->call('store')
            ->assertSee($banner['name'])
            ->assertHasNoErrors('BannerNotFound')
            ->assertHasNoErrors('Banner');

        $this->assertDatabaseHas('new_banners', $banner);
    }

    public function testAUserCanEditABanner(): void
    {
        $banner = Banner::factory()->make();
        $banner->save();

        Livewire::test(Banners::class)
            ->set([
                'selectedBanner' => $banner->toArray(),
            ])
            ->call('update')
            ->assertSee($banner->name)
            ->assertHasNoErrors('BannerNotFound')
            ->assertHasNoErrors('Banner');

        $this->assertDatabaseHas('new_banners', $banner->toArray());

    }

    public function testAUserCanDeleteABanner(): void
    {
        $banner = Banner::factory()->make();
        $banner->save();

        Livewire::test(Banners::class)
            ->call('delete', $banner->id)
            ->assertDontSee($banner->name)
            ->assertSet('selectedBanner', null)
            ->assertSet('edit', null)
            ->assertHasNoErrors('BannerNotFound')
            ->assertHasNoErrors('Banner');

        $this->assertDatabaseMissing('new_banners', $banner->toArray());
    }

}
