<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BIROJOVA</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.5/cdn.min.js"></script>
  <style>
    html {
      scroll-behavior: smooth;
    }
    @keyframes float {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-20px); }
      100% { transform: translateY(0px); }
    }
    .float-animation {
      animation: float 6s ease-in-out infinite;
    }
    .gradient-text {
      background: linear-gradient(45deg, #3B82F6, #06B6D4);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }
    .card-hover {
      transition: all 0.3s ease;
    }
    .card-hover:hover {
      transform: translateY(-10px) rotate(2deg);
    }
  </style>
</head>
<body class="bg-slate-50">
  <!-- Header & Navbar -->
  <header x-data="{ isOpen: false }" class="py-4 fixed w-full z-50 backdrop-blur-lg bg-white/80">
    <div class="container mx-auto px-6">
      <div class="flex justify-between items-center">
        <a href="#home" class="text-3xl font-bold gradient-text">BIROJOVA</a>
        
        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-8">
          <a href="#home" class="text-slate-600 hover:text-blue-500 transition-colors duration-300 text-sm uppercase tracking-wider">Home</a>
          <a href="#about" class="text-slate-600 hover:text-blue-500 transition-colors duration-300 text-sm uppercase tracking-wider">About</a>
          <a href="#services" class="text-slate-600 hover:text-blue-500 transition-colors duration-300 text-sm uppercase tracking-wider">Services</a>
          <a href="#contact" class="bg-blue-500 text-white px-6 py-2 rounded-full text-sm uppercase tracking-wider hover:bg-blue-600 transition-colors duration-300">Contact Us</a>
        </nav>

        <!-- Mobile Menu Button -->
        <button @click="isOpen = !isOpen" class="md:hidden text-slate-600">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>

      <!-- Mobile Navigation -->
      <div x-show="isOpen" class="md:hidden mt-4 bg-white rounded-2xl p-4 shadow-lg">
        <a href="#home" class="block py-2 text-slate-600 hover:text-blue-500">Home</a>
        <a href="#about" class="block py-2 text-slate-600 hover:text-blue-500">About</a>
        <a href="#services" class="block py-2 text-slate-600 hover:text-blue-500">Services</a>
        <a href="#contact" class="block py-2 text-slate-600 hover:text-blue-500">Contact</a>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main>
    <!-- Hero Section -->
    <section id="home" class="pt-32 pb-20 overflow-hidden">
      <div class="container mx-auto px-6">
        <div class="relative">
          <!-- Background Elements -->
          <div class="absolute -top-20 -right-20 w-64 h-64 bg-blue-200 rounded-full mix-blend-multiply filter blur-2xl opacity-70"></div>
          <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-purple-200 rounded-full mix-blend-multiply filter blur-2xl opacity-70"></div>
          
          <!-- Content -->
          <div class="relative flex flex-col lg:flex-row items-center gap-12">
            <div class="lg:w-1/2 text-center lg:text-left">
              <h1 class="text-5xl lg:text-7xl font-bold mb-6 leading-tight">
                <span class="gradient-text">Pengurusan Dokumen</span> Jadi Lebih Mudah
              </h1>
              <p class="text-slate-600 text-lg mb-8 max-w-xl">Kami menyediakan layanan pengurusan dokumen seperti SIM, KTP, KK, dan akte dengan proses yang cepat, aman, dan terpercaya.</p>
              <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                <a href="#services" class="bg-blue-500 text-white px-8 py-4 rounded-full font-medium hover:bg-blue-600 transition-colors duration-300 text-center">
                  Mulai Sekarang
                </a>
                <a href="#about" class="bg-white text-slate-800 px-8 py-4 rounded-full font-medium hover:bg-slate-100 transition-colors duration-300 shadow-md text-center">
                  Pelajari Lebih Lanjut
                </a>
              </div>
            </div>
            <div class="lg:w-1/2 float-animation">
                <img src="{{ asset('storage/images/icon-document.png') }}" 
                alt="Document Services" 
                style="width: 40px; height: auto;" 
                class="rounded-5xl shadow-2xl">
           
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white">
      <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
          <h2 class="text-4xl font-bold text-center mb-16 gradient-text">Mengapa Memilih Kami?</h2>
          <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center card-hover">
              <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold mb-4">Cepat</h3>
              <p class="text-slate-600">Proses pengurusan dokumen yang cepat, efisien, dan tanpa ribet, memastikan dokumenmu selesai tepat waktu.</p>
            </div>
            <div class="text-center card-hover">
              <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold mb-4">Aman</h3>
              <p class="text-slate-600">Keamanan data dan dokumenmu adalah prioritas kami, dengan sistem perlindungan yang terjamin.</p>
            </div>
            <div class="text-center card-hover">
              <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
              </div>
              <h3 class="text-xl font-bold mb-4">Terpercaya</h3>
              <p class="text-slate-600">Telah dipercaya oleh ribuan klien dengan layanan profesional dan hasil yang memuaskan.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 relative overflow-hidden">
        <!-- Decorative Background Elements -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full">
          <div class="absolute top-20 left-20 w-72 h-72 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
          <div class="absolute bottom-20 right-20 w-72 h-72 bg-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
        </div>
      
        <div class="container mx-auto px-6 relative">
          <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-16">
              <h2 class="text-4xl font-bold gradient-text mb-4">Layanan Kami</h2>
              <p class="text-slate-600 max-w-2xl mx-auto">Kami menyediakan berbagai layanan pengurusan dokumen yang Anda butuhkan dengan proses yang cepat dan terpercaya</p>
            </div>
      
            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-items-center">
              @foreach ($layanans as $layanan)
                <div class="bg-white w-full max-w-sm rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 relative group">
                  <!-- Decorative Top Pattern -->
                  <div class="absolute top-0 left-0 right-0 h-24 bg-gradient-to-br from-blue-50 to-purple-50 rounded-t-3xl opacity-50"></div>
                  
                  <!-- Icon Container with Animation -->
                  <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-blue-200 rounded-2xl flex items-center justify-center mb-6 transform group-hover:rotate-6 transition-transform duration-300">
                      <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                      </svg>
                    </div>
                  </div>
      
                  <!-- Content -->
                  <div class="relative">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">{{ $layanan->nama_layanan }}</h3>
                    <p class="text-slate-600 mb-6 min-h-[80px]">{{ $layanan->deskripsi }}</p>
                    
                    <!-- Features List -->
                    <ul class="space-y-3 mb-6">
                      <li class="flex items-center text-sm text-slate-600">
                        <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Proses Cepat
                      </li>
                      <li class="flex items-center text-sm text-slate-600">
                        <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Aman & Terpercaya
                      </li>
                      <li class="flex items-center text-sm text-slate-600">
                        <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Konsultasi Gratis
                      </li>
                    </ul>
      
                    <!-- Action Button -->
                    <div class="relative">
                      <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full blur opacity-30 group-hover:opacity-100 transition duration-300"></div>
                      <a href="#contact" class="relative flex items-center justify-between bg-white text-blue-500 font-medium px-6 py-3 rounded-full border border-blue-100 hover:border-blue-300 transition-colors duration-300">
                        <span>Selengkapnya</span>
                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-white">
        <div class="container mx-auto px-6">
          <div class="max-w-5xl mx-auto">
            <h2 class="text-4xl font-bold text-center mb-16 gradient-text">Hubungi Kami</h2>
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-3xl p-2">
              <div class="bg-white rounded-2xl p-8">
                <div class="grid md:grid-cols-2 gap-12">
                  <div>
                    <h3 class="text-2xl font-bold mb-6">Informasi Kontak</h3>
                    <div class="space-y-6">
                      <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                          <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                          </svg>
                        </div>
                        <div>
                          <h4 class="font-medium text-slate-900">WhatsApp</h4>
                          <a href="https://wa.me/+6283167259792" class="text-blue-500 hover:text-blue-600">Nomor WhatsApp</a>
                        </div>
                      </div>
                      <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                          <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                          </svg>
                        </div>
                        <div>
                          <h4 class="font-medium text-slate-900">Email</h4>
                          <a href="mailto:email@birojova@gmail.com" class="text-blue-500 hover:text-blue-600">birojova@gmail.com</a>
                        </div>
                      </div>
                      <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                          <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                          </div>
                          <div>
                            <h4 class="font-medium text-slate-900">Alamat</h4>
                            <a href="https://www.google.com/maps/search/?api=1&query=JOVA+SOFTWARE,+Jl.+Kw.+Industri+Tunas+2+No.7,+Belian,+Kec.+Batam+Kota,+Kota+Batam,+Kepulauan+Riau+29444" 
                               target="_blank" class="text-blue-500 hover:text-blue-600">
                                JOVA SOFTWARE, Jl. Kw. Industri Tunas 2 No.7, Belian, Batam Kota, Batam, Kepulauan Riau 29444
                            </a>
                        </div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <h3 class="text-2xl font-bold mb-6">Jam Operasional</h3>
                      <div class="space-y-4">
                        <div class="flex justify-between items-center p-4 bg-slate-50 rounded-2xl">
                          <span class="font-medium">Senin - Jumat</span>
                          <span class="text-slate-600">08:00 - 17:00</span>
                        </div>
                        <div class="flex justify-between items-center p-4 bg-slate-50 rounded-2xl">
                          <span class="font-medium">Sabtu</span>
                          <span class="text-slate-600">09:00 - 15:00</span>
                        </div>
                        <div class="flex justify-between items-center p-4 bg-slate-50 rounded-2xl">
                          <span class="font-medium">Minggu</span>
                          <span class="text-slate-600">Tutup</span>
                        </div>
                      </div>
                      <div class="mt-8">
                          <a href="https://wa.me/6283167259792?text=Nama%20%3A%20%0AEmail%20%3A%20%0AYang%20diajukan%20%3A%20%0AAlasan%20pengajuan%20%28opsional%29%20%3A%20" 
                          class="block w-full bg-blue-500 text-white text-center py-4 rounded-full font-medium hover:bg-blue-600 transition-colors duration-300">
                          Hubungi via WhatsApp
                       </a>                     
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
    </main>
  
    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-12">
      <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
          <div>
            <span class="text-2xl font-bold text-white gradient-text">BIROJOVA</span>
            <p class="mt-4">Solusi terpercaya untuk pengurusan dokumen Anda.</p>
          </div>
          <div>
            <h4 class="text-white font-bold mb-4">Quick Links</h4>
            <ul class="space-y-2">
              <li><a href="#home" class="hover:text-white transition-colors duration-300">Home</a></li>
              <li><a href="#about" class="hover:text-white transition-colors duration-300">About</a></li>
              <li><a href="#services" class="hover:text-white transition-colors duration-300">Services</a></li>
              <li><a href="#contact" class="hover:text-white transition-colors duration-300">Contact</a></li>
            </ul>
          </div>
          <div>
            <h4 class="text-white font-bold mb-4">Follow Us</h4>
            <div class="flex space-x-4">
              <a href="#" class="w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors duration-300">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
              </a>
              <a href="#" class="w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors duration-300">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                </svg>
              </a>
              <a href="#" class="w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors duration-300">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                </svg>
              </a>
            </div>
          </div>
        </div>
        <div class="border-t border-slate-800 mt-12 pt-8 text-center">
          <p>&copy; {{ date('Y') }} BIROJOVA. All rights reserved.</p>
        </div>
      </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
          const waButton = document.querySelector("a[href^='https://wa.me/']");
          
          waButton.addEventListener("click", function (event) {
            event.preventDefault();
            
            const userName = prompt("Masukkan Nama Anda:");
            const userEmail = prompt("Masukkan Email Anda:");
            const userQuery = prompt("Apa yang ingin Anda ajukan?");
            const userReason = prompt("Alasan pengajuan (Opsional):");
  
            if (userName && userEmail && userQuery) {
              const waLink = `https://wa.me/6283167259792?text=Nama%20%3A%20${encodeURIComponent(userName)}%0AEmail%20%3A%20${encodeURIComponent(userEmail)}%0AYang%20diajukan%20%3A%20${encodeURIComponent(userQuery)}%0AAlasan%20pengajuan%20%28opsional%29%20%3A%20${encodeURIComponent(userReason)}`;
              window.location.href = waLink;
            } else {
              alert("Mohon isi semua data yang diperlukan!");
            }
          });
        });
      </script>

  </body>
  </html>
