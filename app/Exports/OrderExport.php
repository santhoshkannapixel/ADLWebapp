<?php

namespace App\Exports;

use App\Models\Orders;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Orders::
        selectRaw('users.name,orders.order_id,orders.order_amount,IF(orders.appoinment = 1,"Yes","No") as is_appoinment,
        (CASE 
            WHEN orders.order_status = "0" THEN "Pending" 
            WHEN orders.order_status = "1" THEN "Accepted"
            WHEN orders.order_status = "2" THEN "Denied"
            WHEN orders.order_status = "3" THEN "Cancel Requested"
            WHEN orders.order_status = "4" THEN "Order Cancelled"
            ELSE "Cancel Request Dined" 
            END) AS order_status
        ,IF(orders.payment_status = 1,"Paid","Failed") as payment_status,orders.created_at')
        ->leftJoin('users','users.id','=','orders.user_id')
        ->get();

    }
    public function headings(): array
    {
        return [
            'Name',
            'Order ID',
            'Order Amounts',
            'Is Appoinment',
            'Order Status',
            'Payment Status',
            'Date',
        ];
    }
}
