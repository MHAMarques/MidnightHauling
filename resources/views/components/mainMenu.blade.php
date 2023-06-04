@props(['company', 'companyID', 'newAvatar'])

<header class="z-10">
    <aside>
        <section>
            <a href="/hub/{{$companyID}}"><div class="logo_profile"><img src="https://e.truckyapp.com/{{$newAvatar}}" title="{{$company['name']}}" alt="Logotipo da empresa {{$company['name']}}"></div></a>
        </section>
        <section>

            <a href="/drivers/{{$companyID}}"><nav>
                <div class="icon_task"><span class="material-symbols-outlined">account_circle</span></div>
                <h2>Motoristas</h2>
            </nav></a>
            <a href="/market/{{$companyID}}"><nav>
                <div class="icon_task"><span class="material-symbols-outlined">monitoring</span></div>
                <h2>Mercado</h2>
            </nav></a>
            <a href="/routes/{{$companyID}}"><nav>
                <div class="icon_task"><span class="material-symbols-outlined">local_shipping</span></div>
                <h2>Rotas</h2>
            </nav></a>
            <a href="/garage/{{$companyID}}"><nav>
                <div class="icon_task"><span class="material-symbols-outlined">analytics</span></div>
                <h2>Admin</h2>
            </nav></a>

        </section>
    </aside>
</header>