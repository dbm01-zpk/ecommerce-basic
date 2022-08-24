<?php

namespace App\Src\Users\Application;

use App\Models\User;

class SearchUser {
    const SIZE_PAGE = 10;

    private function query() {
        $queryUser = User::query();
        return $queryUser;
    }

    public function get() {
        return $this->query()->get();
    }

    public function paginate($pageLength = self::SIZE_PAGE, $page = 1) {
        return $this->query()->paginate($pageLength, page:$page);
    }

}
