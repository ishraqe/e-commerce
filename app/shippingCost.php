<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shippingCost extends Model
{
  protected  $fillable=['insideDhaka','outsideDhaka'];

  public function getShippingData()
  {
  	return $this->first();
  }
}
