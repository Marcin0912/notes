<?php

namespace App\Services;

use App\Repositories\NoteRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class NoteService
{
    /**
     * @var $noteRepository
     */
    protected $noteRepository;

    public function __construct(NoteRepository $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    /**
     * Get all note.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->noteRepository->getAll();
    }


    /**
     * Get note by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->noteRepository->getById($id);
    }



    /**
     * Validate note data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function savePostData($data)
    {

        $result = $this->noteRepository->save($data);

        return $result;
    }



    public function updateNote($data, $id)
    {

        $note = $this->noteRepository->update($data, $id);

        return $note;

    }


    /**
     * Delete note by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById($id)
    {

        $note = $this->noteRepository->delete($id);

        return $note;

    }

}
