<?php

namespace App\Traits;

//php artisan make:trait MyTrait 
//command
trait commentRelation
{
protected $paidType = 'paid';
protected $dueType = 'due';
protected $createType = 'create';
protected $editType = 'edit';
protected $changeType = 'change';
protected $removeType = 'remove';

 final public function comments(){return $this->morphMany('App\Model\Comment', 'commentable');}
  final public function scopeWithComments($query){

      $query->with(['comments:id,commentable_id,commentable_type,type,body']);
    }
   final protected  function convertCommentTxt($com , $type){
      $info = implode(",",$com->where('type', $type)->pluck('body')->all());
      return $info? $type.':'.$info:null;
    }
   final public function getCommentTxtAttribute(){
      $com = collect($this->comments);
      $result = [];
    
     $paid = $this->convertCommentTxt($com,$this->paidType);
     $due= $this->convertCommentTxt($com,$this->dueType );
    $create = $this->convertCommentTxt($com,$this->createType);
     $edit = $this->convertCommentTxt($com,$this->editType); 
     $remove = $this->convertCommentTxt($com,$this->changeType);
     $change = $this->convertCommentTxt($com,$this->removeType);

      
      $paid? array_push($result ,$paid):null;
      $due? array_push($result , $due):null;
      $create? array_push($result , $create):null;
      $edit? array_push($result ,$edit):null;
      $remove? array_push($result ,$remove):null;
      $change? array_push($result , $change):null;
      

    return implode("||",$result);

    }
final public function paidCommentAdd($body)
{
  return $this->comments()->create(['type' => $this->paidType,'body'=>$body]);
}
final public function dueCommentAdd($body)
{
  return $this->comments()->create(['type' => $this->dueType,'body'=>$body]);
}

 final public  function createCommentAdd($body)
  {
  	return $this->comments()->create(['type' => $this->createType,'body'=>$body]);
  }
 final public  function editCommentAdd($body)
  {
  	return $this->comments()->create(['type' =>$this->editType,'body'=>$body]);
  }
 final public  function removeCommentAdd($body)
  {
  	return $this->comments()->create(['type' => $this->changeType,'body'=>$body]);
  }
 final public  function changeCommentAdd($body)
  {
  	return $this->comments()->create(['type' => $this->removeType,'body'=>$body]);
  }
}