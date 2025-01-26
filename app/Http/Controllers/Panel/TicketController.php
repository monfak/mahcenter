<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Models\TicketMessage;
use App\Http\Requests\StoreTicketMessageRequest;
use App\Http\Requests\StoreTicketRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->user()->id)->latest()->paginate();
        return view()->first(['frontend.tickets.index', 'ticket::index'], compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view()->first(['frontend.tickets.create', 'ticket::create']);
    }

    /**
     * Store a new ticket in the resource.
     * @param StoreTicketRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket = new Ticket([
            'title'         => $request->input('title'),
            'user_id'       => auth()->user()->id,
            'slug'          => uniqid(auth()->user()->id),
            'priority'      => $request->input('priority'),
            'status'        => 1,
        ]);

        $ticket->save();

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
            'message' => "تیکت شما به شماره $ticket->slug ایجاد شد"
        ]);
        return redirect()->route('panel.tickets.index');
    }

    /**
     * Show the specified resource.
     *
     * @param Ticket $ticket
     * @return Response
     */
    public function show(Ticket $ticket)
    {
        if ($ticket->user_id !== auth()->user()->id)
        {
            abort(403, 'شما اجازه دسترسی به این تیکت را ندارید.');
        }

        return view()->first(['frontend.tickets.show', 'ticket::show'], compact('ticket'));
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
    public function update(StoreTicketMessageRequest $request, $slug)
    {
        $ticket = Ticket::where(['slug' => $slug, 'user_id' => auth()->user()->id])->get();

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
     * Toggle the specified ticket status.
     * @param Request $request
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        $ticket = Ticket::findorFail($id);

        if ($ticket->user_id !== auth()->user()->id)
        {
            abort(403, 'شما اجازه دسترسی به این تیکت را ندارید.');
        }

        if (isset($data['status'])) {
            $stat = $data['status'];
            $stat = ($stat == 1 ? 1 : 0);
            $ticket->status = $stat;
            $ticket->save();
        }


        doneMessage();
        return redirect()->route('panel.tickets.index');
    }
}
