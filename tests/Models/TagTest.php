<?php

namespace Tests\Models;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Tag;
use Tests\TestCase;

class TagTest extends TestCase
{
    public function testDeleteDetachesBanners(): void
    {
        // SETUP
        $banner1 = Banner::factory()->create();
        $banner2 = Banner::factory()->create();
        $banner3 = Banner::factory()->create();
        $banner4 = Banner::factory()->create();
        $banner5 = Banner::factory()->create();

        $toBeDeletedTag = Tag::factory()->create();
        $tag2 = Tag::factory()->create();
        $tag3 = Tag::factory()->create();

        $toBeDeletedTag->banners()->sync([$banner1->id, $banner2->id, $banner3->id, $banner4->id]);
        $tag2->banners()->sync([$banner3->id, $banner4->id, $banner5->id]);
        $tag3->banners()->sync([$banner5->id]);

        // METHOD TO BE TESTED
        $toBeDeletedTag->delete();

        // ASSERTIONS
        $this->assertCount(0, Banner::find($banner1->id)->tags);
        $this->assertCount(0, Banner::find($banner2->id)->tags);

        $this->assertCount(1, Banner::find($banner3->id)->tags);
        $this->assertCount(1, Banner::find($banner4->id)->tags);

        $this->assertCount(2, Banner::find($banner5->id)->tags);
    }

}
