<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Type;

class TypeObserver
{
    /**
     * Handle the Type "created" event.
     *
     * @param  \App\Models\Type  $type
     * @return void
     */
    public function created(Type $type)
    {
        //
    }

    /**
     * Handle the Type "updated" event.
     *
     * @param  \App\Models\Type  $type
     * @return void
     */
    public function updated(Type $type)
    {
        //
    }

    /**
     * Handle the Brand "deleting" event.
     *
     * @param  \App\Models\Brand  $brand
     * @return void
     */
    public function deleting(Type $type)
    {
        Product::where('type_id', $type->id)->update(['type_id' => null]);
    }

    /**
     * Handle the Type "deleted" event.
     *
     * @param  \App\Models\Type  $type
     * @return void
     */
    public function deleted(Type $type)
    {
        //
    }

    /**
     * Handle the Type "restored" event.
     *
     * @param  \App\Models\Type  $type
     * @return void
     */
    public function restored(Type $type)
    {
        //
    }

    /**
     * Handle the Type "force deleted" event.
     *
     * @param  \App\Models\Type  $type
     * @return void
     */
    public function forceDeleted(Type $type)
    {
        //
    }
}
