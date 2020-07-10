<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function changeStatus($id)
    {
        if(intval($id))
        {
            if(isset($id))
            {
                $task = Task::find($id);
                if(isset($task))
                {
                    $task->done = $task->done ? false : true;
                    $task->save();
                    if($task->done)
                    {
                        $message = "Tarefa concluída!";
                    }
                    else
                    {
                        $message = "Tarefa pendente!";
                    }

                    return response()->json(['message'=>$message, 'tarefa'=>['id'=>$task->id]],200);
                }
                else
                {
                    return response()->json(['message'=>'Tarefa não encontrada!', 'tarefa'=>['id'=>$id]],404);
                }
            }
            else
            {
                return response()->json(['message'=>'Tarefa não atualizada, verifique o ID enviado existe!'],400);
            }
        }
        else
        {
            return response()->json(['message'=>'Tarefa não não atualizada, verifique o formato do ID enviado!'],406);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isset($request->description))
        {
        $task = Task::create($request->all());
        return response()->json(
            [
            'message'=>'Tarefa incluida!',
            'tarefa'=>
                [
                    'id'=>$task->id,
                    'description'=>$task->description
                ]
            ],200);
        }
        else
        {
            return response()->json(['message'=>'Tarefa não incluida!, verifique o formato de envio da requisição!'],406);
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(intval($id))
        {
            if(isset($id))
            {
                $task = Task::find($id);
                if(isset($task))
                {
                    $task->delete();
                    return response()->json(['message'=>'Tarefa removida!', 'tarefa'=>['id'=>$task->id]],200);
                }
                else
                {
                    return response()->json(['message'=>'Tarefa não encontrada!', 'tarefa'=>['id'=>$id]],404);
                }

            }
            else
            {
                return response()->json(['message'=>'Tarefa não removida, verifique o ID enviado existe!'],400);
            }
        }
        else
        {
            return response()->json(['message'=>'Tarefa não removida, verifique o formato do ID enviado!'],406);
        }
    }
}
