<?php

namespace App\Http\Livewire;

use App\Models\Graduate;
use App\Models\Monitoring;
use App\Models\Teacher;
use Illuminate\Contracts\Queue\Monitor;
use Livewire\Component;


class CrudMonitoring extends Component
{
    public $institution;
    public $isOpen=false;
    public $search, $monitoring;
    protected $listeners=['render','delete'=>'delete'];

    protected $rules=[

        'monitoring.graduate_id'=>'required',
        'monitoring.teacher_id'=>'required',

    ];

    public function messages(){
        return [

            'monitoring.graduate_id'=>'Seleccione el egresado',
            'monitoring.teacher_id'=>'Seleccione el docente',

        ];
    }
    public function render(){
        $monitorings = Monitoring::where('id','LIKE','%'.$this->search.'%')->latest('id')->paginate(6);
        $teachers = Teacher::all();
        $graduates = Graduate::all();

        return view('institucion.crud-monitoring', compact('monitorings','teachers','graduates'));
    }

    public function create(){
        $this->isOpen=true;
    }

    public function store(){
         $this->validate();
         if(!isset($this->monitoring['id'])){
            Monitoring::create($this->monitoring);
        }else{
            $monitoring=Monitoring::find($this->monitoring['id']);
            $monitoring->graduate_id=$this->monitoring['graduate_id'];
            $monitoring->teacher_id=$this->monitoring['teacher_id'];
            $monitoring->save();
        }
        $this->reset(['isOpen','monitoring']);
        $this->emitTo('CrudMonitoring','render');
        $this->emit('alert','Registro creado satisfactoriamente');

    }

    public function delete($id){
        Monitoring::find($id)->delete();
    }

    public function edit($monitoring){
        //dd($category);
        $this->monitoring=$monitoring;
        $this->isOpen=true;
    }
}
