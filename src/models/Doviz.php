<?php namespace Obarlas\TcmbDoviz;

class Doviz extends \Eloquent {

	protected $table = 'doviz';
	public $timestamps = true;

	public static function sonKur()
	{
		if ($data = Doviz::orderBy('tarih', 'desc')->first()) {
			return $data;
		}

		$model = __NAMESPACE__ . "\Doviz";
		return new $model();
	}

	public static function enYakinKur($tarih)
	{
		return Doviz::orderBy('tarih', 'desc')->where('tarih', '<=', date("Y-m-d", strtotime($tarih)))->first();
	}

	public function getTarihAttribute($value = null)
	{
		return empty($value) ? null : date("d.m.Y", strtotime($value));
	}

	public function setTarihAttribute($value = null)
	{
		$this->attributes['tarih'] = empty($value) ? null : date("Y-m-d", strtotime($value));
	}

	public function setDolarAttribute($value = null)
	{
		$this->attributes["dolar"] = empty($value) ? null : (float)$value;
	}

	public function setEuroAttribute($value = null)
	{
		$this->attributes["euro"] = empty($value) ? null : (float)$value;
	}

	public function setPariteAttribute($value = null)
	{
		$this->attributes["parite"] = empty($value) ? $this->attributes["euro"] / $this->attributes["dolar"] : (float)$value;
	}

}
