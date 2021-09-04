<?php

namespace App\Http\Controllers\Api;


use App\Services\NoteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class NoteController extends Controller
{
    /**
     * @var noteService
     */
    protected $noteService;


    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $notes = $this->noteService->getAll();
        return response()->json($notes, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $note = $this->noteService->savePostData($request->all());
        return response()->json($note, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $note = $this->noteService->getById($id);
        return response()->json($note);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $note = $this->noteService->getById($id);
        if(!$note) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        if (! Gate::allows('update-note', $note)) {
            return response()->json(['message' => 'Forbidden'], 403);
        } else {
            $this->noteService->updateNote($request->all(), $id);
            return response()->json(['message' => 'Accepted'], 202);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $note = $this->noteService->getById($id);
        if(!$note) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        if(! Gate::allows('delete-note', $note)) {
            return response()->json(['message' => 'Forbidden'], 403);
        } else {
            $this->noteService->deleteById($id);
            return response()->json([], 204);
        }


    }
}
