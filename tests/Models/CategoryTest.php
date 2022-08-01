<?php

namespace Tests\Models;

use App\Models\Banner;
use App\Models\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function testDeleteDetachesBanners(): void
    {
        // SETUP
        $banner1 = Banner::factory()->create();
        $banner2 = Banner::factory()->create();
        $banner3 = Banner::factory()->create();
        $banner4 = Banner::factory()->create();
        $banner5 = Banner::factory()->create();

        $toBeDeletedCategory = Category::factory()->create();
        $category2 = Category::factory()->create();
        $category3 = Category::factory()->create();

        $toBeDeletedCategory->banners()->sync([$banner1->id, $banner2->id, $banner3->id, $banner4->id]);
        $category2->banners()->sync([$banner3->id, $banner4->id, $banner5->id]);
        $category3->banners()->sync([$banner5->id]);

        // METHOD TO BE TESTED
        $toBeDeletedCategory->delete();

        // ASSERTIONS
        $this->assertCount(0, Banner::find($banner1->id)->categories);
        $this->assertCount(0, Banner::find($banner2->id)->categories);

        $this->assertCount(1, Banner::find($banner3->id)->categories);
        $this->assertCount(1, Banner::find($banner4->id)->categories);

        $this->assertCount(2, Banner::find($banner5->id)->categories);
    }

}
