<?php

namespace App\Repositories;

use App\Models\Question;
use Illuminate\Support\Collection;

interface QuestionRepositoryInterface
{
    public function find(int $id): ?Question;

    /**
     * @return Collection<Question>
     */
    public function list(): Collection;

}
