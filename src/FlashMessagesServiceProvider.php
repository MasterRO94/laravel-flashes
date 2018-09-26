<?php

namespace MasterRO\Flash;

use Illuminate\Support\ServiceProvider;

class FlashMessagesServiceProvider extends ServiceProvider
{
	/**
	 * Publish resources
	 */
	public function boot()
	{
		$this->mergeConfigFrom(
			__DIR__ . '/config/flash-messages.php', 'flash-messages'
		);

		$this->loadViewsFrom(__DIR__ . '/resources/views', 'flash-messages');

		$this->publishes([
			__DIR__ . '/config/flash-messages.php' => config_path('flash-messages.php'),
			__DIR__ . '/resources/views'           => resource_path('views/vendor/flash-messages'),
		]);
	}
}
