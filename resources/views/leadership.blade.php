<x-layout>
  <x-card class="p-8 mx-auto mt-12 max-w-7xl">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">County Leadership</h1>

    <!-- Leadership Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
      @foreach ([
        [
          'name' => 'H.E. Mohamud M. Ali',
          'position' => 'Governor, Marsabit County',
          'image' => asset('images/governor.png'),
          'details' => [
            'bio' => 'Serving since 2017, re-elected in 2022. Focused on peacebuilding, drought mitigation, and infrastructure.',
            'education' => 'BSc in Economics, University of Nairobi.',
            'achievements' => [
              'Built 120km of rural roads.',
              'Implemented Marsabit Drought Recovery Program.',
              'Introduced free maternal health program.'
            ]
          ]
        ],
        [
          'name' => 'Solomon Gubo Riwe',
          'position' => 'Deputy Governor',
          'image' => asset('images/deputygov.jpeg'),
          'details' => [
            'bio' => 'Former Education Officer, currently driving policy coordination and development oversight.',
            'education' => 'BA in Education, Kenyatta University.',
            'achievements' => [
              'Launched county bursary scheme.',
              'Led mobile classroom program in remote areas.'
            ]
          ]
        ],
        [
          'name' => 'Mohamed Chute',
          'position' => 'Senator, Marsabit County',
          'image' => asset('images/seantor.jpg'),
          'details' => [
            'bio' => 'Elected Senator in 2022. Advocates for justice and promotes stronger devolution laws.',
            'education' => 'LLB, Moi University.',
            'achievements' => [
              'Sponsored 4 bills in the Senate.',
              'Pushed for equitable revenue allocation.'
            ]
          ]
        ],
        [
          'name' => 'Abdullahi Galgalo',
          'position' => 'Chief of Staff',
          'image' => asset('images/chstaff.jpeg'),
          'details' => [
            'bio' => 'Manages the governor’s executive agenda and intergovernmental relations.',
            'education' => 'Masters in Public Administration, USIU.',
            'achievements' => [
              'Introduced internal performance audits.',
              'Coordinates executive committee operations.'
            ]
          ]
        ],
        [
          'name' => 'Ambrose Harugura',
          'position' => 'Chairperson, Public Service Board',
          'image' => asset('images/chair.jpeg'),
          'details' => [
            'bio' => 'Oversees recruitment, HR policy, and service quality across departments.',
            'education' => 'HRM Degree, Strathmore University.',
            'achievements' => [
              'Won African Civil Service Excellence Award 2024.',
              'Implemented digital recruitment portal.'
            ]
          ]
        ],
      ] as $leader)
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4 flex flex-col items-center text-center">
          <img src="{{ $leader['image'] }}" alt="{{ $leader['name'] }}" class="w-40 h-40 rounded-full object-cover mb-4 shadow">
          <h2 class="text-lg font-semibold text-gray-800">{{ $leader['name'] }}</h2>
          <p class="text-sm text-gray-600">{{ $leader['position'] }}</p>
          <button
            onclick="showDetails(@js($leader['name']), @js($leader['position']), @js($leader['details']), @js($leader['image']))"
            class="mt-4 text-[#D68C3C] hover:underline"
          >
            Read More
          </button>
        </div>
      @endforeach
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
      <div class="bg-white rounded-lg max-w-md w-full p-6 relative">
        <button onclick="closeModal()" class="absolute top-2 right-3 text-gray-600 hover:text-black text-2xl">&times;</button>
        <img id="modalImage" src="" alt="" class="w-32 h-32 md:w-40 md:h-40 rounded-full mx-auto mb-4 object-cover shadow-md">
        <h3 id="modalName" class="text-xl font-semibold text-center text-gray-800"></h3>
        <p id="modalPosition" class="text-center text-sm text-gray-600 mt-1 mb-4"></p>
        <p id="modalBio" class="text-gray-700 text-sm mb-2"></p>
        <p id="modalEducation" class="text-sm italic text-gray-600 mb-2"></p>
        <ul id="modalAchievements" class="list-disc list-inside text-sm text-gray-700 space-y-1"></ul>
      </div>
    </div>

    <!-- Modal Script -->
    <script>
      function showDetails(name, position, details, image) {
        document.getElementById('modalName').innerText = name;
        document.getElementById('modalPosition').innerText = position;
        document.getElementById('modalImage').src = image;
        document.getElementById('modalBio').innerText = details.bio || '';
        document.getElementById('modalEducation').innerText = details.education ? `Education: ${details.education}` : '';

        const achievementsList = document.getElementById('modalAchievements');
        achievementsList.innerHTML = '';
        if (details.achievements && Array.isArray(details.achievements)) {
          details.achievements.forEach(item => {
            const li = document.createElement('li');
            li.textContent = item;
            achievementsList.appendChild(li);
          });
        }

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
