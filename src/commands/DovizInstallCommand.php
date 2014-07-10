<?php namespace Wisemood\LaravelTcmbDoviz;

use \Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use \Symfony\Component\Console\Input\InputOption;
use \Symfony\Component\Console\Input\InputArgument;
use \Illuminate\Filesystem\Filesystem;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Whoops\Example\Exception;

class DovizInstallCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'doviz:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'DB kurulumunu yapar.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(Filesystem $files)
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		if (!Schema::hasTable('doviz')) {
			try {
				Schema::create('doviz', function (Blueprint $table) {
					$table->increments('id');
					$table->date('tarih')->index();
					$table->decimal('dolar', 10, 6);
					$table->decimal('euro', 10, 6);
					$table->decimal('parite', 10, 6);
					$table->timestamps();
				});
			} catch (\Exception $ex) {
				$this->error('Tablo kurulumu yapılırken bir hata oluştu!');
				$this->error($ex->getMessage());
				exit;
			}

			$this->info('Döviz tablo kurulumu başarı ile tamamlanmıştır.');
		} else {
			$this->info('Döviz tablosu var olduğu için herhangi bir işlem yapmıyorum.');
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
		];
	}

}
