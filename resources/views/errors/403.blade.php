<x-app-layout>
    <main class="grid place-items-center bg-transparent px-6 py-24 lg:px-8">
        <div class="text-center">
            <p class="text-5xl font-semibold text-indigo-600">403</p>
            <h1 class="text-5xl font-semibold tracking-tight text-balance text-gray-900 sm:text-7xl">
                Accès refusé
            </h1>
            <p class="mt-6 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8">
                Désolé, vous n'avez pas la permission d’accéder à cette page.
            </p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="{{ route('dashboard') }}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Retour à l’accueil
                </a>
                <a href="mailto:support@votresite.com" class="text-sm font-semibold text-gray-900">
                    Contacter le support <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>
    </main>
</x-app-layout>
