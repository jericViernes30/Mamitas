<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Customer;
use App\Models\Tickets;
use PHPUnit\Framework\Attributes\Ticket;

class MenuController extends Controller
{
    public function dashboard(){
        $menu = Menu::all();
        $lastTicket = Customer::latest('ticket')->first(); // Retrieve the latest ticket
        $ticket = $lastTicket->ticket + 1;
        return view('dashboard', ['menus' => $menu, 'ticket' => $ticket]);
    }

    public function ticketDetails(Request $request){
        $menu = Menu::all();

        $customer = $request->input('customer');
        $ticket = $request->input('ticket');
        $data = ([
            'ticket' => $ticket,
            'name' => $customer
        ]);
        Customer::create($data);

        $foodNames = $request->input('food_name');
        foreach ($foodNames as $foodName) {
            // Create a new Food instance
            $food = new Tickets();
            
            // Set the name attribute
            $food->food_name = $foodName;

            // Set the ticket_number attribute
            $food->ticket = $ticket; // Or whatever the specific ticket number is
            
            // Save the record to the database
            $food->save();
        }

        $foods = Tickets::select('food_name')
            ->selectRaw('COUNT(*) as count')
            ->where('ticket', $ticket)
            ->groupBy('food_name')
            ->get();

        return view('order_details', [
            'ticket' => $ticket,
            'customer' => $customer,
            'foods' => $foods
        ]);
    }
}
