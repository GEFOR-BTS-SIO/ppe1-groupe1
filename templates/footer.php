<footer class="bg-gray-800 py-4">
  <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center">
      <div class="flex justify-center sm:justify-end">
        <a href="{{ path('app_rgpd') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
        RGPD
        </a>
        <a href="{{ path('app_profil_edit', {'id': app.user.id}) }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
          Contact
        </a>
      </div>
    </div>
  </div>
</footer>






