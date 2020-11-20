<?php

namespace App\Http\Controllers;

use App\Library\Message;
use App\Http\Requests\CampanhaRequest;
use App\Http\Services\CampanhaService;

class CampanhaController extends Controller
{
    private $campanhaService;

    public function __construct(
        CampanhaService $campanhaService
    )
    {
        $this->campanhaService = $campanhaService;
    }
    public function index()
    {
        $dados = array(
            'campanhas'=> $this->campanhaService->getCampanhas(10),
            'titulo'=>'Campanhas'
        );
        
        return view('admin.campanhas.campanhas', $dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.campanhas.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CampanhaRequest $request)
    {
        $campanha = $this->campanhaService->saveCampanha($request);

        Message::info('Gravado Com Sucesso!');

        return redirect()->route('campanhas.ofertas.index', $campanha->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dados = array(
            'campanha' => $this->campanhaService->findCampanha($id)
        );

        return view ('admin.campanhas.form', $dados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CampanhaRequest $request, $id)
    {
        $this->campanhaService->updateCampanha($request, $id);

        return redirect()->route('campanhas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->campanhaService->deleteCampanha($id);
        
        Message::info('Apagado Com Sucesso');
        return redirect()->route('campanhas.index');
    }
}
