<?php

namespace App\Http\Livewire;

use App\Models\Institution;
use Livewire\Component;
use App\Models\Teacher;
use App\Models\User;

class CrudTeacher extends Component
{
    public $isOpen=false;
    public $search, $teacher;
    protected $listeners=['render','delete'=>'delete'];

    protected $rules=[
        'teacher.academic_degree'=>'required',
        'teacher.specialty'=>'required',
        'teacher.email'=>'required',
        'teacher.user_id'=>'required',
        'teacher.institution_id'=>'required',
    ];

    public function messages(){
        return [
            'teacher.academic_degree'=>'Seleccione el egresado',
            'teacher.specialty'=>'Seleccione el egresado',
            'teacher.email'=>'Seleccione el correo',
            'teacher.user_id'=>'Seleccione el egresado',
            'teacher.institution_id'=>'Seleccione el docente',
        ];
    }
    public function render(){
        $teachers=Teacher::where('academic_degree','LIKE','%'.$this->search.'%')->latest('id')->paginate(6);
        $users = User::all();
        $institutions = Institution::all();
        return view('institucion.crud-teacher',compact('teachers','users','institutions'));


    }

    public function create(){
        $this->isOpen=true;
        $this->resetValidation();
    }

    public function store(){
         $this->validate();
         if(!isset($this->teacher['id'])){
            Teacher::create($this->teacher);
        }else{
            $teacher=Teacher::find($this->teacher['id']);
            $teacher->academic_degree=$this->teacher['academic_degree'];
            $teacher->specialty=$this->teacher['specialty'];
            $teacher->email=$this->teacher['email'];
            $teacher->user_id=$this->teacher['user_id'];
            $teacher->institution_id=$this->teacher['institution_id'];
            $teacher->save();
        }
        $this->reset(['isOpen','teacher']);
        $this->emitTo('CrudTeacher','render');
        $this->emit('alert','Registro creado satisfactoriamente');

    }

    public function edit($teacher){
        //dd($category);
        $this->teacher=$teacher;
        $this->isOpen=true;
    }


    public function delete($id){
        Teacher::find($id)->delete();
    }
}
