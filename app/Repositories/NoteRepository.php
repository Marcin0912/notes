<?php

namespace App\Repositories;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteRepository
{


    /**
     * @var Note
     */
    protected $Note;

    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    /**
     * Get all notes.
     *
     * @return Note $note
     */
    public function getAll()
    {
        return $this->note
            ->get();
    }


    /**
     * Get note by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->note
            ->where('id', $id)
            ->first();
    }

    /**
     * Save Note
     *
     * @param $data
     * @return Note
     */
    public function save($data)
    {
        $note = new $this->note;

        $note->title = $data['title'];
        $note->note = $data['note'];
        $note->user_id = Auth::id();

        $note->save();

        return $note->fresh();
    }

    /**
     * Update Note
     *
     * @param $data
     * @return Note
     */
    public function update($data, $id)
    {

        $note = $this->note->find($id);

        $note->update($data);

        return $note;
    }

    /**
     * Update Post
     *
     * @return Note
     */
    public function delete($id)
    {

        $note = $this->note->find($id);
        $note->delete();

        return $note;
    }

}
