<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pod;

class PodsController extends Controller
{
    private $pod;

    /**
     * Display a listing of the resource.
     * GET /pods
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $pods = Pod::where('activated','=', 1)
            ->orderBy('favorite', 'desc')
            ->orderBy('population', 'desc')
            ->get();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 200,
                'success' => true,
                'pods' => $pods->toArray()
            ]);
        } else {
            return response()
                ->view('pods.index', [
                    'pods' => Pod::orderBy('favorite', 'desc')
                        ->orderBy('population', 'desc')
                        ->get()
                ]);
        }
    }

    /**
     * Display a listing of the favorite pods
     * GET /pods/favorite
     *
     * @return Response
     */
    public function favorite()
    {
        $pods = Pod::where('activated','=', 1)
            ->where('favorite','=',1)
            ->get();

        if($pods) {
            return response()->json([
                'status' => 200,
                'success' => true,
                'pods' => $pods->toArray()
            ]);

        } else {
            return response()->json([
                'status' => 404,
                'success' => false
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     * GET /pods/create
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     * POST /pods
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'url' => 'required|url|unique:pods',
        ]);

        // We create a test pod
        $this->pod = new Pod;

        $all = $request->all();
        $this->pod->url        = (string)$all['url'];

        $domain = $this->getDomain($this->pod->url);
        $count = Pod::where('domain','=', $domain)->count();

        if($count > 3) {
            return Response::json([
                'status' => 406,
                'success' => false,
                'messages' => 'Too much pods registered for this domain'
            ]);
        }

        $this->request($request);
        $this->geo();

        $this->pod->domain      = $domain;
        $this->pod->activated   = false;
        $this->pod->favorite    = false;

        $this->pod->ip = gethostbyname(parse_url($this->pod->url, PHP_URL_HOST));

        $this->pod->save();

        return response()->json([
            'status' => 200,
            'success' => true,
            'pods' => $this->pod->toArray()
        ]);
    }

    /**
     * Display the specified resource.
     * GET /pods/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $pod = Pod::find($id);

        if($pod) {
            return response()->json([
                'status' => 200,
                'success' => true,
                'pod' => $pod->toArray()
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'success' => false
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * GET /pods/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return response()
            ->view('pods.edit', [
                'pod' => Pod::find($id)
            ]);
    }

    /**
     * Update the specified resource in storage.
     * PUT /pods/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $pod = Pod::find($id);
        $pod->activated     = $request->get('activated', false);
        $pod->description   = $request->get('description');
        $pod->favorite      = $request->get('favorite', false);
        $pod->save();

        return redirect()->action('PodsController@index');
    }

    public function status(Request $request)
    {
        $all = $request->all();
        $pod = Pod::where('url','=', (string)$all['url'])->get()->toArray();

        if($pod != false) {
            $pod = $pod[0];

            return response()->json([
                'status' => 200,
                'success' => true,
                'pod' => $pod
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'success' => false,
                'messages' => 'Pod not found'
            ]);
        }
    }

    public function refresh(Request $request, $id)
    {
        $this->pod = Pod::find($id);
        $this->request($request);
        $this->geo();
        $this->pod->save();

        return redirect()->to(url()->previous() . '#' . $id);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /pods/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $pod = Pod::find($id);
        $pod->delete();

        return redirect()->action('PodsController@index');
    }

    private function getDomain($url)
    {
        $host = parse_url($url, PHP_URL_HOST);
        $parts = explode('.', $host);
        if(count($parts) == 1) {
            return $parts[0];
        } else {
            $parts = array_reverse($parts);
            return $parts[1].'.'.$parts[0];
        }
    }

    private function geo()
    {
        $url = parse_url($this->pod->url);
        $record = geoip_record_by_name($url['host']);
        if ($record) {
            $this->pod->geo_country    = strtolower($record['country_code']);
            $this->pod->geo_city       = '?'; //$record['city'];
        } else {
            $this->pod->geo_country = '?';
            $this->pod->geo_city = '?';
        }
    }

    private function request(request $request)
    {
        $url = $this->pod->url . '/?infos';

        try {
            $response = \Guzzle::get($url, [
                'headers' => [
                    'User-Agent' => 'testing/1.0',
                    'Accept'     => 'application/json',
                ]
            ]);
        } catch (\Exception $e) {
            $request->session()->flash('status',  $e->getMessage());
            return;
        }

        $result = json_decode($response->getBody()->getContents());

        if ($result) {
            $this->pod->description    = $result->description ?? 'Empty description';
            $this->pod->population     = $result->population;
            $this->pod->connected      = $result->connected;
            $this->pod->version        = $result->version;
            $this->pod->php_version    = $result->php_version;
            $this->pod->language       = $result->language;
            $this->pod->jid            = '';

            if($result->unregister == true) {
                $this->destroy($this->pod->id);
            }
        }

        return false;
    }

}
