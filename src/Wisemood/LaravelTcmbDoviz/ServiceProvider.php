<?php namespace Wisemood\LaravelTcmbDoviz;

class ServiceProvider extends \Illuminate\Support\ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	public function boot()
	{
		$this->package('wisemood/laravel-tcmb-doviz');
		$this->commands([
			'Wisemood\LaravelTcmbDoviz\DovizGetCommand',
			'Wisemood\LaravelTcmbDoviz\DovizInstallCommand'
		]);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

}
