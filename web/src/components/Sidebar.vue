<template>
  <aside class="w-64 text-white bg-[#171e26] shadow-md">
    <div class="h-16 bg-[#26313c] flex items-center justify-center">
      <img src="/logo.png" alt="TEF Bank Logo" class="h-6">
    </div>
    <nav class="p-4">
      <router-link to="/main" class="block py-2 px-4 rounded hover:bg-[#304053]"
                   active-class="bg-[#1f2935] font-semibold">
        Ínicio
      </router-link>

      <div>
        <button
          @click="toggleReport"
          class="w-full flex justify-between items-center py-2 px-4 rounded hover:bg-[#304053] focus:outline-none"
        >
          <span>Relatórios</span>
          <svg :class="{ 'rotate-90': showReportSubmenu }"
               class="w-4 h-4 transform transition-transform duration-200"
               fill="none"
               stroke="currentColor"
               viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5l7 7-7 7"/>
          </svg>
        </button>
        <div v-if="showReportSubmenu" class="pl-6">
          <router-link to="/reports/synthetic-statement" class="block py-2 px-4 rounded hover:bg-[#304053]">
            Extrato Sintético
          </router-link>

        </div>
      </div>
    </nav>
  </aside>
</template>
<script setup lang="ts">
import { ref } from 'vue';

const showReportSubmenu = ref(false);

function toggleReport() {
  showReportSubmenu.value = !showReportSubmenu.value
}
</script>
