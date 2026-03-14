<?php

namespace App\View\Components\header;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class UserDropdown extends Component
{
    public ?User $user;

    public function __construct()
    {
        /** @var User|null $user */
        $this->user = Auth::user();
    }

    public function render(): View|Closure|string
    {
        return view('components.header.user-dropdown');
    }
}
