<?php


namespace App\Http\Helper\dropDown;

use App\Http\Helper\dropDown\interfaces\Common;
use  Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

use App\Model\Vendor;

class VendorDrops implements Common
{
    protected static $select = ['id','name'];

    /**
     * @return mixed
     */
    private static function vendorQuery():Builder{
        return Vendor::select(self::$select );
    }

    /**
     * @return Collection
     */
    public static function all():Collection
    {
        return  self::vendorQuery()->get();
    }

    /**
     * @return Collection
     */
    public static function active():Collection  {
        return self::vendorQuery()->where('active',true)->get();
    }

    public static function inActive():Collection   {
        return self::vendorQuery()->where('active',false)->get();
    }
}