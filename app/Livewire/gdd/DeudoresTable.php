<?php

namespace App\Livewire\Gdd;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DeudoresTable extends Component
{
    public $search = '';
    public $limit = 50;
    public $loadedRows = 0;

    protected $listeners = ['loadMore'];

    public function loadMore()
    {
        $this->loadedRows += $this->limit;
        $this->dispatch('loadMoreFinished');
    }

    public function searchDeudores()
    {
        $this->loadedRows = 0;
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div>
            <span>Cargando...</span>
        </div>
        HTML;
    }

    protected function getDeudoresQuery()
    {
        return DB::table('RAFAM_CC')
            ->select([
                'RECURSO',
                'IMPONIBLE',
                'ANIO',
                'CUOTA',
                'MONTO_TOTAL_ORIGEN',
                'MONTO_TOTAL_INTERES',
                'MONTO_TOTAL_DLNYF',
                'MONTO_TOTAL',
                'FECHA_VTO',
                'SITUACION',
                'NRO_PLAN',
                'ID_GESTION'
            ])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('RECURSO', 'like', "%{$this->search}%")
                        ->orWhere('IMPONIBLE', 'like', "%{$this->search}%");
                });
            })
            ->orderBy('RECURSO', 'DESC')
            ->orderBy('IMPONIBLE', 'DESC');
    }

    public function render()
    {

        $query = $this->getDeudoresQuery();

        $deudores = $query->limit($this->loadedRows + $this->limit)->get();
        $hasMore = $query->count() > ($this->loadedRows + $this->limit);

        return view('gdd.livewire.deudores-table', [
            'deudores'  => $deudores,
            'hasMore'   => $hasMore
        ]);
    }
}
