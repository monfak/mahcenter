<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Models\TicketMessage;
use App\Http\Requests\StoreTicketMessageRequest;

class TicketController extends Controller
{
    /**
     * TicketController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:tickets-manage');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $tickets = Ticket::latest()->paginate();
        return view()->first(['admin.tickets.index', 'ticket::index'], compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('ticket::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view()->first(['admin.tickets.show', 'ticket::show'], compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('ticket::edit');
    }

    /**
     * Add a reply to the specific ticket.
     *
     * @param StoreTicketMessageRequest $request
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreTicketMessageRequest $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $message = new TicketMessage([
            'user_id' => auth()->user()->id,
            'ticket_id' => $ticket->id,
            'body' => $request->input('message'),
        ]);

        $message->save();

        if($request->hasfile('attachment'))
        {
            $date = date('Y/m');
            foreach($request->file('attachment') as $key => $attachment)
            {
                $name = Str::random(64);
                if($attachment->storeAs('public/images/attachments/' . $date, $name . '.' . $attachment->extension()))
                {
                    $attachments[] = [
                        'message_id' => $message->id,
                        'client_name'   => $attachment->getClientOriginalName(),
                        'name'          => $name,
                        'mime'          => $attachment->extension(),
                        'url'           => 'storage/images/attachments/' . $date . '/' . $name . '.' . $attachment->extension(),
                    ];
                }
            }
            TicketAttachment::insert($attachments);
        }

        session()->flash('msg', [
            'status' => 'success',
            'title' => '',
            'message' => "پیام شما با موفقیت ثبت گردید."
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        $ticket = Ticket::findorFail($id);

        if (isset($data['status'])) {
            $stat = $data['status'];
            $stat = ($stat == 1 ? 1 : 0);
            $ticket->status = $stat;
            $ticket->save();
        }

        if ( isset($data['delete'] ))
            $ticket->delete();


        success();
        return redirect()->route('admin.tickets.index');
    }
}
