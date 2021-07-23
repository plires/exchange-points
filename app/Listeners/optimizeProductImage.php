<?php

namespace App\Listeners;

use App\Events\ProductSaved;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class optimizeProductImage
{
  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Handle the event.
   *
   * @param  ProductSaved  $event
   * @return void
   */
  public function handle(ProductSaved $event)
  {
    $image = Image::make(Storage::get($event->product->image))
    ->resize(400, null, function ($constraint) {
      $constraint->aspectRatio();
    })
    ->encode();

    Storage::put($event->product->image, (string) $image);
  }
}
