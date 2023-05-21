<nav class="bg-gray-800 py-4">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center">
                    <div>
                    <a href="{{ path('app_user') }}" class="text-white font-bold text-xl ">
                    <img class="mr-20" src="{{asset('geforbis.png')}}">
                    </a>
                     </div>
                     <div>
                    <a href="{{ path('app_user') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-xl font-medium">
                       Mon profil
                    </a>
                    
                    <a href="{{ path('app_profil_edit', {'id': app.user.id}) }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-xl font-medium">
                       Editer
                    </a>
                    <a href="{{ path('app_search') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-xl font-medium">
                       Rechercher
                    </a>
                    <a href="{{ path('app_profil_index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-xl font-medium">
                       Liste Profils
                    </a>
                    
                {% if is_granted('ROLE_ADMIN') %}
                    
                        <a href="{{ path('admin') }}" 
                        class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-xl font-medium">
                        Administration
                        </a>
                    </div>
                    </div>
                    </div>
                </div>
                {% endif %}
            </div>
        </div>
        <script src="https://cdn.tailwindcss.com"></script>
    </div>
</nav>