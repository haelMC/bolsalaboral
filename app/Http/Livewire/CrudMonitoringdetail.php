<?php

namespace App\Http\Livewire;

use App\Models\Monitoring;
use App\Models\Graduate;
use App\Models\User;
use App\Models\Monitoringdetail;
use Livewire\Component;
use Illuminate\Support\Str;
class CrudMonitoringdetail extends Component
{

    public $isOpen=false;
    public $search;
    public $monitoringdetail;
    protected $listeners=['render','delete'=>'delete'];

    protected $rules=[
        'monitoringdetail.recommendation' => 'required',
        'monitoringdetail.description' => 'required',
        'monitoringdetail.date_monitoring' => 'required',
        'monitoringdetail.monitoring_id' => 'required',

    ];

    public function messages(){
        return [
            'monitoringdetail.recommendation' => 'Ingrese un recomendacion',
            'monitoringdetail.description' => 'Falta la descripcion',
            'monitoringdetail.date_monitoring' => 'Falta la date_monitoring',
            'monitoringdetail.monitoring_id' => 'Falta la monitoring_id',
        ];
    }
    public function render(){
        $monitoringdetails=Monitoringdetail::where('recommendation','LIKE','%'.$this->search.'%')->latest('id')->paginate(6);
        $monitorings = Monitoring::all();
        $graduates = Graduate::all();
        $users = User::all();
        return view('docente.crud-monitoringdetail',compact('monitoringdetails','monitorings','graduates','users'));
    }

    public function create(){
        $this->isOpen=true;

    }

    public function store(){
        $this->validate();
        // //dd($this->category);
         if(!isset($this->monitoringdetail['id'])){
            Monitoringdetail::create($this->monitoringdetail);
         }else{
            $monitoringdetail=Monitoringdetail::find($this->monitoringdetail['id']);
            $monitoringdetail->recommendation=$this->monitoringdetail['recommendation'];
            $monitoringdetail->description=$this->monitoringdetail['description'];
            $monitoringdetail->date_monitoring=$this->monitoringdetail['date_monitoring'];
            $monitoringdetail->monitoring_id=$this->monitoringdetail['monitoring_id'];
            $monitoringdetail->save();
        }
         $this->reset(['isOpen','monitoringdetail']);
         $this->emitTo('CrudMonitoringdetail','render');
        $this->emit('alert','Registro creado satisfactoriamente');
    }

    public function edit($monitoringdetail){
        //dd($category);
        $this->monitoringdetail=$monitoringdetail;
        $this->isOpen=true;
    }

    public function delete($id){
        Monitoringdetail::find($id)->delete();
    }

    public function updatedMonitoringdetailName(){
       $this->monitoringdetail['description']=Str::description($this->monitoringdetail['recommendation']);
    }

}
