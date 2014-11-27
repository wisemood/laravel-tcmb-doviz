<?php namespace Wisemood\LaravelTcmbDoviz;

use \Illuminate\Console\Command;
use \Illuminate\Filesystem\Filesystem;

class DovizGetCommand extends Command {

   /**
    * The console command name.
    *
    * @var string
    */
   protected $name = 'doviz:get';

   /**
    * The console command description.
    *
    * @var string
    */
   protected $description = 'TCMB web sitesinden son dolar ve euro kurunu alır.';

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
      if (!$content = file_get_contents("http://www.tcmb.gov.tr/kurlar/today.xml")) {
         $this->error("Houston, we have a problem!");
         exit;
      }
      $xml   = (array) simplexml_load_string($content);
      $tarih = date("Y-m-d", strtotime("+1 day", strtotime($xml["@attributes"]["Tarih"])));

      if (!$doviz = Doviz::where('tarih', $tarih)->first()) {
         $doviz        = new Doviz();
         $doviz->tarih = $tarih;
      }

      foreach ($xml["Currency"] as $val) {
         $val = (array) $val;
         if ($val["@attributes"]["CurrencyCode"] == "USD") {
            $doviz->dolar = (float) $val["BanknoteSelling"];
         }
         if ($val["@attributes"]["CurrencyCode"] == "EUR") {
            $doviz->euro = (float) $val["BanknoteSelling"];
         }
      }

      if (empty($doviz->dolar) or empty($doviz->euro)) {
         $this->error("Döviz kurlarını alırken bir sorun oluştu.");
      }

      $doviz->parite = $doviz->euro / $doviz->dolar;
      $doviz->save();

      $this->info(date("d.m.Y", strtotime($tarih)) . " tarihli kurlar başarı ile kaydedilmiştir.");
   }

   /**
    * Get the console command arguments.
    *
    * @return array
    */
   protected function getArguments()
   {
      return [];
   }

   /**
    * Get the console command options.
    *
    * @return array
    */
   protected function getOptions()
   {
      return [];
   }

}
