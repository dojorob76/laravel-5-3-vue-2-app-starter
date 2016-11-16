<?php

namespace App\Http\ViewComposers;


use Illuminate\Contracts\View\View;

class GlobalViewComposer
{

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        // List of variables that should be included on every page load
        $siteName = config('app.name');

        // Add each variable to every view
        $view->with([
            'site_name' => $siteName
        ]);
    }
}