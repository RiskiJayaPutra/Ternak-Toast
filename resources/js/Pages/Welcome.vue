<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    products: {
        type: Array,
        required: true
    },
    categories: {
        type: Array,
        required: true
    }
});

const formatPrice = (price) => {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(price);
};
</script>

<template>
    <Head title="Katalog Menu" />

    <div class="min-h-screen bg-ternak-snow text-gray-800 font-sans selection:bg-ternak-green selection:text-white">
        <!-- Navigation -->
        <nav class="bg-ternak-cream shadow-sm sticky top-0 z-50 border-b border-yellow-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex-shrink-0 flex items-center gap-2">
                        <span class="text-3xl">🍞</span>
                        <h1 class="text-2xl font-extrabold text-ternak-green tracking-tight">Ternak<span class="text-gray-800">Toast</span></h1>
                    </div>
                    
                    <div v-if="canLogin" class="flex items-center gap-4">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="font-semibold text-ternak-green hover:text-green-800 transition"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="font-semibold text-ternak-green hover:text-green-800 transition"
                            >
                                Masuk
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="bg-ternak-green text-white font-semibold px-5 py-2 rounded-xl hover:bg-green-700 transition shadow-sm hover:shadow"
                            >
                                Daftar
                            </Link>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="bg-ternak-green text-white py-24 px-4 relative overflow-hidden">
            <!-- Decorative circle -->
            <div class="absolute -right-20 -top-20 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl"></div>
            <div class="absolute -left-10 bottom-0 w-48 h-48 bg-ternak-cream opacity-10 rounded-full blur-2xl"></div>
            
            <div class="max-w-7xl mx-auto text-center relative z-10">
                <h2 class="text-4xl md:text-6xl font-black mb-6 tracking-tight">Roti Panggang <span class="text-ternak-cream">Favorit UMKM!</span></h2>
                <p class="text-lg md:text-xl text-ternak-snow max-w-2xl mx-auto opacity-90 leading-relaxed">
                    Nikmati sajian toast hangat dengan isian melimpah dan rasa yang bikin nagih. Dibuat langsung dengan cinta, dipanggang sempurna.
                </p>
                <div class="mt-10">
                    <a href="#menu" class="bg-ternak-cream text-ternak-green font-bold text-lg px-8 py-3 rounded-full hover:bg-white transition shadow-lg hover:shadow-xl inline-block transform hover:-translate-y-1">
                        Lihat Menu Kami 👇
                    </a>
                </div>
            </div>
        </div>

        <!-- Catalog Section -->
        <main id="menu" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-10">
                <h3 class="text-3xl font-extrabold text-gray-800 mb-2">Katalog Rasa</h3>
                <div class="h-1 w-20 bg-ternak-green mx-auto rounded-full"></div>
            </div>

            <!-- Categories Filter -->
            <div class="flex justify-center gap-3 mb-12 flex-wrap">
                <button class="bg-ternak-green text-white px-6 py-2 rounded-full font-bold shadow-sm transition transform active:scale-95">Semua</button>
                <button v-for="category in categories" :key="category.id" class="bg-white border-2 border-ternak-cream text-ternak-green px-6 py-2 rounded-full font-bold hover:bg-ternak-cream transition transform active:scale-95 shadow-sm">
                    {{ category.name }}
                </button>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <div v-for="product in products" :key="product.id" class="bg-white rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-50 group flex flex-col transform hover:-translate-y-2">
                    <div class="relative h-56 overflow-hidden bg-ternak-cream flex items-center justify-center p-4">
                        <!-- Background glow effect -->
                        <div class="absolute inset-0 bg-gradient-to-tr from-ternak-cream to-white opacity-50"></div>
                        
                        <img 
                            :src="`/images/${product.image}`" 
                            :alt="product.name"
                            class="object-contain w-full h-full relative z-10 group-hover:scale-110 transition-transform duration-500 drop-shadow-xl"
                            @error="$event.target.src='https://placehold.co/400x300/FBF1B4/7AB269?text=Roti+Enak'"
                        />
                        <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-ternak-green text-xs font-black px-3 py-1 rounded-full shadow-sm z-20 uppercase tracking-wider">
                            {{ product.category.name }}
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow bg-white">
                        <h4 class="text-xl font-bold text-gray-800 mb-2 leading-tight group-hover:text-ternak-green transition-colors">{{ product.name }}</h4>
                        <p class="text-sm text-gray-500 mb-6 line-clamp-2 flex-grow">{{ product.description }}</p>
                        
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                            <span class="text-2xl font-black text-ternak-green">{{ formatPrice(product.price) }}</span>
                            <button class="bg-ternak-cream text-ternak-green p-3 rounded-2xl hover:bg-ternak-green hover:text-white transition-colors shadow-sm group-hover:shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
        <!-- Footer -->
        <footer class="bg-ternak-green text-ternak-snow py-12 mt-12 border-t-8 border-ternak-cream">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <div class="text-4xl mb-4">🍞</div>
                <p class="font-black text-2xl mb-2 tracking-tight">Ternak Toast UMKM</p>
                <p class="text-md opacity-90 max-w-md mx-auto">Membawa kehangatan di setiap gigitan. Dipanggang segar setiap hari untuk senyum Anda.</p>
                <div class="flex justify-center gap-4 mt-6">
                    <!-- social icons placeholders -->
                    <div class="w-10 h-10 rounded-full bg-ternak-cream/20 flex items-center justify-center hover:bg-ternak-cream hover:text-ternak-green transition cursor-pointer">IG</div>
                    <div class="w-10 h-10 rounded-full bg-ternak-cream/20 flex items-center justify-center hover:bg-ternak-cream hover:text-ternak-green transition cursor-pointer">WA</div>
                </div>
                <p class="text-xs mt-10 opacity-70">&copy; 2026 Ternak Toast. Dibuat dengan cinta untuk UMKM Indonesia.</p>
            </div>
        </footer>
    </div>
</template>
