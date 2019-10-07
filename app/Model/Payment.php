<?php

namespace App\Model;

use App\Exceptions\FetalException;
use Illuminate\Database\Eloquent\Model;
use App\Traits\{commentRelation,CommonQuery,DemoRowModifyer};

use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Payment extends Model
{
  use SoftDeletes,commentRelation;

  protected $hidden= ['deleted_at'];
  protected $fillable = ['paytype','amount','profit','bill'];



       /**
     * Get all of the owning paymentable models.
     */
  
    public function getCreatedTextAttribute()
    {

      // return Carbon::now()->subWeek();
        $dbDate = null;
        if (isset($this->created_at)&& $this->created_at){
            $dbDate  =  $this->created_at;
        }else if(isset($this->updated_at)&& $this->updated_at){
            $dbDate =  $this->updated_at;
        }

      if ($dbDate) {

       $date = Carbon::createFromFormat('Y-m-d H:i:s', $dbDate);
       if ($date->isCurrentHour()) {
        return $date->diffInRealMinutes(Carbon::now()).' min Ago';
       }else if ($date->isToday()){
       
          return $date->diffInHours(Carbon::now()).' Hour Ago';
        }else if($date->isYesterday()) {
           return 'Yesterday';
       } else if( $date->greaterThan(Carbon::now()->subWeek())){
           return $date->englishDayOfWeek;

        }else{
          return date('d M H:i:sA', strtotime($dbDate));
        }
        
      }else{
        return 'none';
      }
      

     }
     

public function repayable()
{
  return $this->hasOne(Repayable::class);
  //->withDefault(['type' => 'payment']);
}

public function scopeRepayablePayments($query,string $type=null){

        $q =  $query->has('repayable');

        if ($type){
            $q->whereHas('repayable',function ($q) use ($type){
               $q->where('group',$type);
            });
        }


}





    public function getCommentAttribute(){return $this->comments->first();}


   /*-------------------------------------------------------

   invoice function

   --------------------------------------------------------*/

    public function invoice(){
        return $this->morphedByMany('App\Model\Invoice', 'paymentable');
    }

    public function scopeInvoiceType($q,string $type){

        return $q->whereHas('invoice',function ($query)use ($type) {
            $query->where($type.'_id','>',0);
        });

    }


    public function statusInInvoice(string $type){


        if ($type == 'customer' || $type == 'vendor'):
           // $pay =  $this->invoice()->get();
        if ($type == 'customer'){
            $pay =  $this->invoice()->whereNotNull('customer_id')->first();
        }else if($type == 'vendor'){
            $pay =  $this->invoice()->whereNotNull('vendor_id')->first();
        }


            if ($pay && $type=='customer'){


                $check = $pay->customer_id;

            }elseif ($pay && $type == 'vendor'){
                $check = $pay->vendor_id;
            }else{
                $check = false;
            }

            if ($pay && $check){

                return $pay->publish ? 'complate':'pending';

            }else{
                return 'push';
            }

        else:

            throw new FetalException('StatusInInvoice param type mustbe customer or vendor');
        endif;



    }

    public function getCustomerStatusInInvoiceAttribute()
    {
        $type = 'customer';

        return $this->statusInInvoice($type);

    }

    public function getVendorStatusInInvoiceAttribute()
    {
        $type = 'vendor';

        return $this->statusInInvoice($type);

    }



    /*-------------------------------------------------------

    invoice function end

    --------------------------------------------------------*/


    public function customers(){return $this->morphedByMany('App\Model\Customer', 'paymentable');}


    public function getCustomerAttribute(){return $this->customers->first();}
    public function scopeWithCustomer($query)
    {
      $query->with('customers:id,name,paymentable_id,paymentable_type');
    }


    public function vendors(){return $this->morphedByMany('App\Model\Vendor', 'paymentable');}
    public function getVendorAttribute(){return $this->vendors->first();}

    public function orders(){return $this->morphedByMany('App\Model\Order', 'paymentable');}
    public function scopeWithOrders($query)
    {
     $query->with(['orders:id,number,payment_id,paymentable_id,paymentable_type']);
    }
    public function getOrderAttribute(){return $this->orders->first();}

    public function scopeActive($query){$query->where('active',true);}
    public function scopeInActive($query){
      $query->where('active',false);
    }



    public function scopeAmount($query,$amount){$query->where('amount',$amount);}

    public function scopeToday($query){$query->where('created_at', Carbon::today());}
    public function scopeYesterday($query){$query->where('created_at', Carbon::today()->subDay());}
    public function scopeCurrentWeek($query){$query->whereDate('created_at','>=', Carbon::today()->subWeekdays(4));}
    public function scopeCurrentMonth($query){ $query->whereDate('created_at','>=', Carbon::today()->firstOfMonth());}

  

    public function  scopeOrder_payment($query){

    return $query->has('orders')->has('customers')->has('vendors');
      
    }



    public function  scopeVendor_payment($query,$active=null){

      $order = $query->doesntHave('orders')->doesntHave('customers')->has('vendors');
      if ($active!=null) {
       $order->whereActive($active);
      }
      return $order;
    }


    public function scopeCredits($query){return $query->where('paytype', 'credit');}
    public function scopeDebits($query){return $query->where('paytype', 'debit');}





    //-------------------------
    public function scopeOrderReportQuery($query)
    {

        return $query->select(['id','amount','profit','bill','created_at'])->latest()->order_payment()
            ->with(['orders:number,type','customers:phone,name','vendors:name']);
    }

    public function scopeCustomerReportQuery($query)
    {

        return $query->select(['id','amount','bill','profit','created_at'])->latest()->order_payment()
            ->with(['customers:phone,name']);
    }

    public function scopeVendorReportQuery($query)
    {
        return $query->select(['id','amount','paytype','created_at'])->latest()->Vendor_payment()
            ->with(['vendors:name']);
    }

    public function scopeFromDate($query,$from){
        return $query->where('created_at','>=',$from);
    }

    public function scopeToDate($query,$to){
        return $query->where('created_at','<=',$to);

    }

    public function scopeVendorIs($query, $vendorId){

        $id = $vendorId;
        return $vendorId? $query->whereHas('vendors', function ($query) use($id) {
            $query->where('id',$id);
        }):$query;

}

    public function scopeSerialFrom($query, $id){


        return $query->where('id','>=',$id);


    }

    public function scopeSerialTo($query,$id){


        return $query->where('id','<=',$id);
    }







//------------------------


}
