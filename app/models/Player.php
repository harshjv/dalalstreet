<?php

class Player extends Eloquent {

  protected $table = "players";
  public $timestamps = false;
  protected $attrib_delta = null;

  public function companies() {
    return $this->belongsToMany('Company')->withPivot('total_shares');
  }

  public function getDeltaAttribute() {
    if($this->attributes['total_cash_in_hand'] == 0 ) return 0;
    if(is_null($this->attrib_delta)) $this->attrib_delta = round(100 * ( $this->attributes['total_cash_in_hand'] - Config::get('dalalstreet.starting_cash') ) / $this->attributes['total_cash_in_hand'], 2);
    return $this->attrib_delta;
  }

}