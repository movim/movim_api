<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Server;

class ServersController extends Controller
{
    /**
     * Display a listing of servers
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $servers = Server::all();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 200,
                'success' => true,
                'servers' => $servers->toArray()
            ]);
        } else {
            return response()
                ->view('servers.index', [
                    'servers' => $servers
                ]);
        }
    }

    /**
     * Show the form for creating a new server
     *
     * @return Response
     */
    public function create()
    {
        return response()->view('servers.create');
    }

    /**
     * Store a newly created server in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'domain'    => 'required',
            'url'       => 'required|url',
            'title'     => 'required'
        ]);

        $server = new Server;
        $server->title      = $request->get('title');
        $server->domain     = $request->get('domain');
        $server->url        = $request->get('url');
        $server->description= $request->get('description');
        $server->geo_country= $request->get('geo_country');
        $server->geo_city   = $request->get('geo_city');

        $server->save();

        return redirect()->action('ServersController@index');
    }

    /**
     * Display the specified server.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $server = Server::findOrFail($id);

        return View::make('servers.show', compact('server'));
    }

    /**
     * Show the form for editing the specified server.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return response()->view('servers.edit', ['server' => Server::find($id)]);
    }

    /**
     * Update the specified server in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'url'       => 'required|url',
            'title'     => 'required'
        ]);

        $server = Server::findOrFail($id);
        $server->title      = $request->get('title');
        $server->url        = $request->get('url');
        $server->description= $request->get('description');
        $server->geo_country= $request->get('geo_country');
        $server->geo_city   = $request->get('geo_city');

        $server->save();

        return redirect()->action('ServersController@index');
    }

    /**
     * Remove the specified server from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Server::destroy($id);

        return redirect()->action('ServersController@index');
    }

}
