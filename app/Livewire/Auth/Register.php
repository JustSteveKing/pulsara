<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\View\Factory;
use Livewire\Attributes\Rule;
use Livewire\Component;

final class Register extends Component
{
    #[Rule(['required','string','min:2','max:255'])]
    public string $firstName;

    #[Rule(['required','string','min:2','max:255'])]
    public string $lastName;

    #[Rule(['required','email','min:2','max:255','unique:users,email'])]
    public string $email;

    #[Rule(['required','string','min:2','max:255'])]
    public string $password;

    public function submit(): void
    {
        $this->validate();
    }

    public function render(Factory $factory): View
    {
        return $factory->make(
            view: 'livewire.auth.register',
        );
    }
}
