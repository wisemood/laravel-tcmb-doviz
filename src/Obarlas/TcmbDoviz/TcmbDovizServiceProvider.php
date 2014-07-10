<?php namespace Obarlas\TcmbDoviz;

use Illuminate\Support\ServiceProvider;

class TcmbDovizServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	public function boot()
	{
		$this->package('obarlas/tcmb-doviz');
		$this->commands([
			'Obarlas\TcmbDoviz\GetDovizCommand'
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
