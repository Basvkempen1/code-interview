<?php

namespace Tests\Models;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Tag;
use Tests\TestCase;

class BannerTest extends TestCase
{

    public function testDeleteDetachesCategories(): void
    {
        $banner = Banner::factory()->create();
        $category = Category::factory()->create();

        $banner->categories()->attach($category->id);
        $banner->delete();

        $this->assertCount(0, Category::find($category->id)->banners);
    }

    public function testDeleteDetachesTags(): void
    {
        $banner = Banner::factory()->create();
        $tag = Tag::factory()->create();

        $banner->tags()->attach($tag->id);
        $banner->delete();

        $this->assertCount(0, Tag::find($tag->id)->banners);
    }
}
