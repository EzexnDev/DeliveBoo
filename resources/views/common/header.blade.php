@guest
    <header-guest-component></header-guest-component>
@endguest

@auth
    <header-auth-component :user="{{ Auth::user() }}"></header-auth-component>
@endauth