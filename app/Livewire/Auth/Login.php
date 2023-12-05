<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\View\Factory;
use Livewire\Attributes\Rule;
use Livewire\Component;

final class Login extends Component
{
    #[Rule(['required','email','max:255','exists:users,email'])]
    public string $email;

    #[Rule(['required','string','max:255'])]
    public string $password;

    public function submit(): void
    {
        $this->validate();
    }

    public function render(Factory $factory): View
    {
        return $factory->make(
            view: 'livewire.auth.login',
        );
    }
}
