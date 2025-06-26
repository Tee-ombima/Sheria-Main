<x-layout>
  <x-card class="p-8 mx-auto mt-12 max-w-7xl">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">County Leadership</h1>

    <!-- Leadership Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
      @foreach ([
        [
  'name' => 'H.E. Mohamud M. Ali',
  'position' => 'Governor, Marsabit County',
  'image' => asset('images/governor.png'), // Save image as 'governor.jpg'
  'details' => 'Serving since 2017, re-elected in 2022. Focused on peacebuilding, drought mitigation, and infrastructure.'
],
[
  'name' => 'Solomon Gubo Riwe',
  'position' => 'Deputy Governor',
  'image' => asset('images/deputygov.jpeg'),
  'details' => 'Former Education Officer, now supporting county strategic functions and development agendas.'
],
[
  'name' => 'Mohamed Chute',
  'position' => 'Senator, Marsabit County',
  'image' => asset('images/senator.jpeg'),
  'details' => 'Advocate for justice and equality, elected Senator in 2022. Voice in devolution matters.'
],
[
  'name' => 'Abdullahi Galgalo',
  'position' => 'Chief of Staff',
  'image' => asset('images/chstaff.jpeg'),
  'details' => 'Manages governors agenda, cabinet coordination, and intergovernmental affairs.'
],
[
  'name' => 'Halake Wario',
  'position' => 'Chairperson, Public Service Board',
  'image' => asset('images/chair.jpeg'),
  'details' => 'Oversees recruitment, HR practices, and performance management across county departments.'
],

        
      ] as $leader)
      <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4 flex flex-col items-center text-center">
        <img src="{{ $leader['image'] }}" alt="{{ $leader['name'] }}" class="w-32 h-32 rounded-full object-cover mb-4">
        <h2 class="text-lg font-semibold text-gray-800">{{ $leader['name'] }}</h2>
        <p class="text-sm text-gray-600">{{ $leader['position'] }}</p>
        <button onclick="showDetails(`{{ $leader['name'] }}`, `{{ $leader['position'] }}`, `{{ $leader['details'] }}`, `{{ $leader['image'] }}`)" class="mt-4 text-[#D68C3C] hover:underline">Read More</button>
      </div>
      @endforeach
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
      <div class="bg-white rounded-lg max-w-md w-full p-6 relative">
        <button onclick="closeModal()" class="absolute top-2 right-3 text-gray-600 hover:text-black">&times;</button>
        <img id="modalImage" src="" alt="" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
        <h3 id="modalName" class="text-xl font-semibold text-center text-gray-800"></h3>
        <p id="modalPosition" class="text-center text-sm text-gray-600 mt-1 mb-4"></p>
        <p id="modalDetails" class="text-gray-700 text-sm leading-relaxed"></p>
      </div>
    </div>

    <script>
      function showDetails(name, position, details, image) {
        document.getElementById('modalName').innerText = name;
        document.getElementById('modalPosition').innerText = position;
        document.getElementById('modalDetails').innerText = details;
        document.getElementById('modalImage').src = image;
        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('modal').classList.add('flex');
      }
      function closeModal() {
        document.getElementById('modal').classList.add('hidden');
        document.getElementById('modal').classList.remove('flex');
      }
    </script>
  </x-card>
</x-layout>
