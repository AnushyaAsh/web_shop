<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Products; // Corrected namespace for the Products model

class OrderController extends Controller
{
    protected $shippingDaysOff = [6, 0]; // Saturday and Sunday are days off

    public function showOrderTable()
    {
        $products = Products::all(); // Fetch all products
        return view('products.ordertable', compact('products'));
    }

    public function placeOrder(Request $request)
    {
        $orderDate = Carbon::parse($request->order_date);

        // Check if the order date is a day off
        if ($this->isDayOff($orderDate)) {
            // If it's a day off, adjust the order date to the next available shipping day
            $orderDate = $this->getNextShippingDay($orderDate);
        } else {
            // If it's not a day off, check the cut-off time
            $cutOffTime = Carbon::parse('11:00:00');
            if ($orderDate->gt($cutOffTime)) {
                // If the order is placed after the cut-off time, adjust the order date to the next day
                $orderDate->addDay();
                // Check if the next day is a day off, adjust accordingly
                if ($this->isDayOff($orderDate)) {
                    $orderDate = $this->getNextShippingDay($orderDate);
                }
            }
        }

        // Now $orderDate contains the expected shipping date
        return view('products.ordertable', ['shippingDate' => $orderDate]);
    }

    protected function isDayOff($date)
    {
        return in_array($date->dayOfWeek, $this->shippingDaysOff);
    }

    protected function getNextShippingDay($date)
    {
        $nextShippingDay = $date->copy()->addDay();
        while ($this->isDayOff($nextShippingDay)) {
            $nextShippingDay->addDay();
        }
        return $nextShippingDay;
    }
}
